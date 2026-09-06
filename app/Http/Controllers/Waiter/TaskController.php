<?php

namespace App\Http\Controllers\Waiter;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Table;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Daftar pesanan yang sudah siap untuk diantar ke meja.
     */
    public function index(Request $request)
    {
        $shop = $request->attributes->get('shop');

        $readyOrders = Order::with(['items', 'table'])
            ->where('shop_id', $shop->id)
            ->where('status', 'ready')
            ->latest()
            ->get();

        $recentDelivered = Order::with(['items', 'table'])
            ->where('shop_id', $shop->id)
            ->where('status', 'delivered')
            ->whereDate('created_at', today())
            ->latest()
            ->take(10)
            ->get();

        return view('waiter.tasks', compact('shop', 'readyOrders', 'recentDelivered'));
    }

    /**
     * Tandai pesanan sudah diantar ke meja (ready → delivered).
     */
    public function markDelivered(Request $request, Order $order)
    {
        $shop = $request->attributes->get('shop');
        abort_if($order->shop_id !== $shop->id, 403);

        $order->update(['status' => 'delivered']);

        return response()->json(['success' => true]);
    }
}
