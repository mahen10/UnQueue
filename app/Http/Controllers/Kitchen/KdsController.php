<?php

namespace App\Http\Controllers\Kitchen;

use App\Http\Controllers\Controller;
use App\Models\MenuItem;
use App\Models\Order;
use Illuminate\Http\Request;

class KdsController extends Controller
{
    /**
     * Layar utama KDS dapur — tampil semua order yang perlu diproses.
     */
    public function index(Request $request)
    {
        $shop = $request->attributes->get('shop');

        // Ambil order yang sudah dibayar & sedang diproses (bukan yg sudah ready/delivered)
        $newOrders = Order::with(['items', 'table'])
            ->where('shop_id', $shop->id)
            ->where('status', 'paid')
            ->latest()
            ->get();

        $processingOrders = Order::with(['items', 'table'])
            ->where('shop_id', $shop->id)
            ->where('status', 'processing')
            ->latest()
            ->get();

        $readyOrders = Order::with(['items', 'table'])
            ->where('shop_id', $shop->id)
            ->where('status', 'ready')
            ->latest()
            ->take(10)
            ->get();

        // Menu items untuk toggle stok cepat dari dapur
        $menuItems = MenuItem::where('shop_id', $shop->id)
            ->orderBy('is_available')
            ->get();

        return view('kitchen.display', compact(
            'shop', 'newOrders', 'processingOrders', 'readyOrders', 'menuItems'
        ));
    }

    /**
     * Tandai order sedang dimasak (paid → processing).
     */
    public function markProcessing(Request $request, Order $order)
    {
        $shop = $request->attributes->get('shop');
        abort_if($order->shop_id !== $shop->id, 403);

        $order->update(['status' => 'processing']);

        // Update semua order items jadi processing
        $order->items()->where('status', 'pending')->update(['status' => 'processing']);

        return response()->json(['success' => true, 'status' => 'processing']);
    }

    /**
     * Tandai order sudah siap (processing → ready).
     */
    public function markReady(Request $request, Order $order)
    {
        $shop = $request->attributes->get('shop');
        abort_if($order->shop_id !== $shop->id, 403);

        $order->update(['status' => 'ready']);
        $order->items()->where('status', 'processing')->update(['status' => 'done']);

        return response()->json(['success' => true, 'status' => 'ready']);
    }

    /**
     * Toggle ketersediaan menu (habis/tersedia) langsung dari KDS.
     */
    public function toggleStock(Request $request, MenuItem $menuItem)
    {
        $shop = $request->attributes->get('shop');
        abort_if($menuItem->shop_id !== $shop->id, 403);

        $menuItem->update(['is_available' => ! $menuItem->is_available]);

        return response()->json([
            'success'      => true,
            'is_available' => $menuItem->is_available,
        ]);
    }
}
