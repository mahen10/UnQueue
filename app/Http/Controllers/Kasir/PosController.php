<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

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

        return view('kasir.pos', compact(
            'shop', 'activeOrders', 'todayOrders', 'todayRevenue', 'todayOrderCount'
        ));
    }

    /**
     * Kasir tandai order sudah diantar (ready → delivered).
     * Juga bisa dari POS ini langsung.
     */
    public function markDelivered(Request $request, Order $order)
    {
        $shop = $request->attributes->get('shop');
        abort_if($order->shop_id !== $shop->id, 403);

        $order->update(['status' => 'delivered']);

        return response()->json(['success' => true]);
    }

    /**
     * Buat order manual oleh kasir (untuk pelanggan yang langsung ke kasir).
     * Fase selanjutnya — stub untuk sekarang.
     */
    public function createOrder(Request $request)
    {
        return response()->json(['message' => 'Manual order — coming soon']);
    }
}
