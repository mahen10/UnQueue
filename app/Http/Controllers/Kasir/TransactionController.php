<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TransactionController extends Controller
{
    /**
     * Halaman riwayat transaksi kasir.
     */
    public function index(Request $request)
    {
        $shop = $request->attributes->get('shop');

        $filterDate = $request->get('date', today()->toDateString());
        $filterStatus = $request->get('status', '');

        $query = Order::with(['items', 'table', 'payment'])
            ->where('shop_id', $shop->id)
            ->whereDate('created_at', $filterDate)
            ->latest();

        if ($filterStatus) {
            $query->where('status', $filterStatus);
        }

        $orders = $query->paginate(30)->withQueryString();

        // Statistik hari filter
        $stats = Order::where('shop_id', $shop->id)
            ->whereDate('created_at', $filterDate)
            ->selectRaw("
                COUNT(*) as total_orders,
                SUM(CASE WHEN status NOT IN ('pending','cancelled') THEN total ELSE 0 END) as total_revenue,
                SUM(CASE WHEN status = 'cancelled' THEN 1 ELSE 0 END) as cancelled_count,
                SUM(CASE WHEN status = 'delivered' THEN 1 ELSE 0 END) as delivered_count
            ")
            ->first();

        return view('kasir.transactions', compact('shop', 'orders', 'filterDate', 'filterStatus', 'stats'));
    }

    public function void(Request $request, Order $order)
    {
        $shop = $request->attributes->get('shop');
        abort_if($order->shop_id !== $shop->id, 403);
        abort_if(!in_array($order->status, ['pending', 'paid']), 422, 'Order tidak bisa di-void.');

        $order->update(['status' => 'cancelled']);

        return back()->with('success', "Order #{$order->order_number} berhasil di-void.");
    }

    public function refund(Request $request, Order $order)
    {
        $shop = $request->attributes->get('shop');
        abort_if($order->shop_id !== $shop->id, 403);

        $order->update(['status' => 'cancelled']);

        return back()->with('success', "Order #{$order->order_number} berhasil di-refund.");
    }
}
