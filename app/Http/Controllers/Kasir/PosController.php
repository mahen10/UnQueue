<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use App\Models\MenuItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PosController extends Controller
{
    /**
     * Dashboard kasir: lihat semua order aktif + ringkasan hari ini.
     */
    public function index(Request $request)
    {
        $shop = $request->attributes->get('shop');

        // Order aktif (sudah bayar, belum delivered)
        $activeOrders = Order::with(['items', 'table', 'payment'])
            ->where('shop_id', $shop->id)
            ->whereIn('status', ['paid', 'processing', 'ready'])
            ->latest()
            ->get();

        // Riwayat hari ini (semua status, 50 terakhir)
        $todayOrders = Order::with(['items', 'table', 'payment'])
            ->where('shop_id', $shop->id)
            ->whereDate('created_at', today())
            ->latest()
            ->take(50)
            ->get();

        // Statistik hari ini
        $todayRevenue = Order::where('shop_id', $shop->id)
            ->whereDate('created_at', today())
            ->whereNotIn('status', ['pending', 'cancelled'])
            ->sum('total');

        $todayOrderCount = Order::where('shop_id', $shop->id)
            ->whereDate('created_at', today())
            ->whereNotIn('status', ['pending', 'cancelled'])
            ->count();

        // Data untuk form Order Manual
        $tables    = Table::where('shop_id', $shop->id)->orderBy('name')->get();
        $menuItems = MenuItem::where('shop_id', $shop->id)
            ->where('is_available', true)
            ->with('category')
            ->orderBy('name')
            ->get();

        return view('kasir.pos', compact(
            'shop', 'activeOrders', 'todayOrders', 'todayRevenue', 'todayOrderCount',
            'tables', 'menuItems'
        ));
    }

    /**
     * Kasir tandai order sudah diantar (ready → delivered).
     */
    public function markDelivered(Request $request, Order $order)
    {
        $shop = $request->attributes->get('shop');
        abort_if($order->shop_id !== $shop->id, 403);

        $order->update(['status' => 'delivered']);

        return response()->json(['success' => true]);
    }

    /**
     * Buat order manual oleh kasir (pelanggan menyebutkan meja, kasir input pesanan).
     * Order langsung masuk dengan status 'paid' (sudah dibayar tunai di kasir).
     */
    public function createOrder(Request $request)
    {
        $shop = $request->attributes->get('shop');

        $request->validate([
            'table_id'       => 'required|exists:tables,id',
            'items'          => 'required|array|min:1',
            'items.*.id'     => 'required|exists:menu_items,id',
            'items.*.qty'    => 'required|integer|min:1|max:99',
            'notes'          => 'nullable|string|max:500',
            'payment_method' => 'required|in:cash,qris,transfer',
        ]);

        // Verifikasi meja milik toko ini
        $table = Table::where('shop_id', $shop->id)->findOrFail($request->table_id);

        // Ambil menu items yang dipilih
        $menuItemIds = collect($request->items)->pluck('id');
        $menuItems   = MenuItem::where('shop_id', $shop->id)
            ->whereIn('id', $menuItemIds)
            ->get()
            ->keyBy('id');

        // Hitung subtotal
        $cartItems = [];
        $subtotal  = 0;
        foreach ($request->items as $item) {
            $menuItem = $menuItems->get($item['id']);
            if (!$menuItem) continue;

            $unitPrice  = (float) $menuItem->price;
            $qty        = (int) $item['qty'];
            $lineTotal  = $unitPrice * $qty;
            $subtotal  += $lineTotal;

            $cartItems[] = [
                'menu_item' => $menuItem,
                'qty'       => $qty,
                'unit_price'=> $unitPrice,
                'note'      => $item['note'] ?? null,
            ];
        }

        if (empty($cartItems)) {
            return response()->json(['error' => 'Tidak ada item valid.'], 422);
        }

        $taxAmount     = round($subtotal * ($shop->tax_percent / 100), 2);
        $serviceCharge = round($subtotal * ($shop->service_charge_percent / 100), 2);
        $total         = $subtotal + $taxAmount + $serviceCharge;

        $orderNumber = 'MNL-' . now()->format('Ymd') . '-' . strtoupper(Str::random(4));

        $order = Order::create([
            'shop_id'               => $shop->id,
            'table_id'              => $table->id,
            'order_number'          => $orderNumber,
            'type'                  => 'manual',
            'status'                => 'paid',        // langsung masuk dapur
            'subtotal'              => $subtotal,
            'tax_amount'            => $taxAmount,
            'service_charge_amount' => $serviceCharge,
            'total'                 => $total,
            'notes'                 => $request->notes,
            'handled_by'            => auth()->id(),
        ]);

        foreach ($cartItems as $ci) {
            OrderItem::create([
                'order_id'     => $order->id,
                'menu_item_id' => $ci['menu_item']->id,
                'item_name'    => $ci['menu_item']->name,
                'item_price'   => $ci['unit_price'],
                'quantity'     => $ci['qty'],
                'modifiers'    => [],
                'notes'        => $ci['note'],
                'status'       => 'pending',
            ]);
        }

        return response()->json([
            'success'      => true,
            'order_number' => $order->order_number,
            'total'        => $total,
        ]);
    }
}
