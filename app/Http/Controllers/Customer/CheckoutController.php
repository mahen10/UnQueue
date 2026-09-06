<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Shop;
use App\Models\Table;
use App\Services\PaymentService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    /**
     * Halaman ringkasan pesanan sebelum bayar.
     */
    public function index()
    {
        if (! session('customer_shop_id')) {
            return view('customer.scan_required');
        }

        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect()->route('customer.cart');
        }

        $shop = Shop::findOrFail(session('customer_shop_id'));

        // Hitung total
        $subtotal       = array_sum(array_map(fn($i) => $i['unit_price'] * $i['qty'], $cart));
        $taxAmount      = round($subtotal * ($shop->tax_percent / 100), 2);
        $serviceCharge  = round($subtotal * ($shop->service_charge_percent / 100), 2);
        $total          = $subtotal + $taxAmount + $serviceCharge;

        $shopName  = session('customer_shop_name');
        $tableName = session('customer_table_name');
        $cartCount = array_sum(array_column($cart, 'qty'));

        return view('customer.checkout', compact(
            'cart', 'shop', 'subtotal', 'taxAmount', 'serviceCharge',
            'total', 'shopName', 'tableName', 'cartCount'
        ));
    }

    /**
     * Buat order + payment lalu redirect ke halaman bayar.
     */
    public function placeOrder(Request $request)
    {
        if (! session('customer_shop_id')) {
            return redirect()->route('customer.menu');
        }

        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect()->route('customer.cart');
        }

        $shop    = Shop::findOrFail(session('customer_shop_id'));
        $tableId = session('customer_table_id');

        // Hitung total
        $subtotal      = array_sum(array_map(fn($i) => $i['unit_price'] * $i['qty'], $cart));
        $taxAmount     = round($subtotal * ($shop->tax_percent / 100), 2);
        $serviceCharge = round($subtotal * ($shop->service_charge_percent / 100), 2);
        $total         = $subtotal + $taxAmount + $serviceCharge;

        // Buat nomor order unik: INV-YYYYMMDD-XXXX
        $orderNumber = 'INV-' . now()->format('Ymd') . '-' . strtoupper(Str::random(4));

        // Buat Order
        $order = Order::create([
            'shop_id'               => $shop->id,
            'table_id'              => $tableId,
            'order_number'          => $orderNumber,
            'type'                  => 'dine_in',
            'status'                => 'pending',
            'subtotal'              => $subtotal,
            'tax_amount'            => $taxAmount,
            'service_charge_amount' => $serviceCharge,
            'total'                 => $total,
            'notes'                 => $request->order_note,
        ]);

        // Buat OrderItems (SNAPSHOT — salin nama, harga, modifier saat ini)
        foreach ($cart as $item) {
            OrderItem::create([
                'order_id'    => $order->id,
                'menu_item_id' => $item['menu_item_id'],
                'item_name'   => $item['name'],
                'item_price'  => $item['unit_price'],
                'quantity'    => $item['qty'],
                'modifiers'   => $item['modifiers'] ?? [],
                'notes'       => $item['note'],
                'status'      => 'pending',
            ]);
        }

        // Hapus keranjang dari session
        session()->forget('cart');

        // Buat invoice dan dapatkan URL pembayaran
        $paymentUrl = PaymentService::createInvoice($order);

        return redirect($paymentUrl);
    }

    /**
     * Halaman menunggu / dummy payment page.
     */
    public function pending(Order $order)
    {
        // Kalau sudah bayar, langsung ke tracking
        if ($order->isPaid() || $order->isProcessing() || $order->isReady() || $order->isDelivered()) {
            return redirect()->route('customer.track', $order);
        }

        $order->load('payment', 'items', 'table');
        $isDummy   = config('app.payment_mode', 'dummy') === 'dummy';
        $shopName  = $order->shop->name;
        $tableName = $order->table->name;
        $cartCount = 0; // Keranjang sudah dikosongkan

        return view('customer.payment_pending', compact('order', 'isDummy', 'shopName', 'tableName', 'cartCount'));
    }

    /**
     * Simulasi bayar sukses (HANYA di mode dummy/development).
     */
    public function simulateSuccess(Order $order)
    {
        if (env('PAYMENT_MODE', 'dummy') !== 'dummy') {
            abort(403, 'Fitur simulasi tidak tersedia di production.');
        }

        PaymentService::markAsPaid($order, ['method' => 'other', 'simulated' => true]);

        return redirect()->route('customer.track', $order);
    }

    /**
     * Simulasi bayar gagal (HANYA di mode dummy/development).
     */
    public function simulateFail(Order $order)
    {
        if (env('PAYMENT_MODE', 'dummy') !== 'dummy') {
            abort(403);
        }

        PaymentService::markAsFailed($order);

        return redirect()->route('customer.checkout.pending', $order)
            ->with('error', 'Pembayaran gagal disimulasikan.');
    }
}
