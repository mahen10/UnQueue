<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Table;
use App\Models\Category;
use App\Models\MenuItem;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Entry point ketika pelanggan scan QR Code.
     * Tugas: Validasi token meja → cek subscription → simpan sesi ke session → tampilkan menu.
     */
    public function scan(string $token)
    {
        // Cari meja berdasarkan token QR
        $table = Table::with('shop')->where('qr_token', $token)->firstOrFail();
        $shop  = $table->shop;

        // Cek subscription (langsung dari model — tidak lewat middleware agar error lebih informatif)
        if (! $shop->isSubscriptionActive()) {
            return view('errors.subscription_expired_customer', compact('shop'));
        }

        // Simpan context meja ke session (inilah yang menggantikan "login" untuk pelanggan)
        session([
            'customer_table_id'  => $table->id,
            'customer_shop_id'   => $shop->id,
            'customer_table_name' => $table->name,
            'customer_shop_name'  => $shop->name,
        ]);

        // Update status meja jadi occupied kalau sebelumnya available
        if ($table->isAvailable()) {
            $table->update(['status' => 'occupied']);
        }

        return redirect()->route('customer.menu');
    }

    /**
     * Tampilkan halaman menu digital (menu katalog pelanggan).
     */
    public function index(Request $request)
    {
        // Pastikan sesi meja aktif — kalau tidak, minta scan ulang
        if (! session('customer_shop_id')) {
            return view('customer.scan_required');
        }

        $shopId = session('customer_shop_id');

        $categories = Category::with(['menuItems' => function($q) {
            $q->where('is_available', true)->orderBy('sort_order');
        }])
        ->where('shop_id', $shopId)
        ->where('is_active', true)
        ->orderBy('sort_order')
        ->get();

        $shopName  = session('customer_shop_name');
        $tableName = session('customer_table_name');
        $cart      = session('cart', []);
        $cartCount = array_sum(array_column($cart, 'qty'));

        return view('customer.menu', compact('categories', 'shopName', 'tableName', 'cart', 'cartCount'));
    }

    /**
     * Detail satu menu item (untuk modal atau halaman pilih modifier).
     */
    public function show(MenuItem $menuItem)
    {
        if (! session('customer_shop_id')) {
            return response()->json(['error' => 'Session expired'], 403);
        }

        $menuItem->load('modifiers');

        return response()->json([
            'id'          => $menuItem->id,
            'name'        => $menuItem->name,
            'description' => $menuItem->description,
            'price'       => $menuItem->price,
            'photo'       => $menuItem->photo ? asset('storage/' . $menuItem->photo) : null,
            'labels'      => $menuItem->labels,
            'modifiers'   => $menuItem->modifiers->map(fn($m) => [
                'id'          => $m->id,
                'name'        => $m->name,
                'is_required' => $m->is_required,
                'options'     => $m->options,
            ]),
        ]);
    }
}
