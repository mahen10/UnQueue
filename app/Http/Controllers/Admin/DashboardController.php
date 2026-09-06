<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $shop = $request->attributes->get('shop');
        
        $today = Carbon::today();
        $startOfMonth = Carbon::now()->startOfMonth();

        // Stats Hari Ini
        $todayRevenue = Order::where('shop_id', $shop->id)
            ->whereDate('created_at', $today)
            ->whereNotIn('status', ['pending', 'cancelled'])
            ->sum('total');

        $todayOrdersCount = Order::where('shop_id', $shop->id)
            ->whereDate('created_at', $today)
            ->whereNotIn('status', ['pending', 'cancelled'])
            ->count();

        // Stats Bulan Ini
        $monthlyRevenue = Order::where('shop_id', $shop->id)
            ->where('created_at', '>=', $startOfMonth)
            ->whereNotIn('status', ['pending', 'cancelled'])
            ->sum('total');

        $monthlyOrdersCount = Order::where('shop_id', $shop->id)
            ->where('created_at', '>=', $startOfMonth)
            ->whereNotIn('status', ['pending', 'cancelled'])
            ->count();

        // Item Terlaris Bulan Ini
        $topItems = OrderItem::select('item_name', DB::raw('SUM(quantity) as total_sold'))
            ->whereHas('order', function ($q) use ($shop, $startOfMonth) {
                $q->where('shop_id', $shop->id)
                  ->where('created_at', '>=', $startOfMonth)
                  ->whereNotIn('status', ['pending', 'cancelled']);
            })
            ->groupBy('item_name')
            ->orderByDesc('total_sold')
            ->take(5)
            ->get();

        // Recent Orders
        $recentOrders = Order::with('table')
            ->where('shop_id', $shop->id)
            ->latest()
            ->take(5)
            ->get();

        // Chart Data: Last 7 Days
        $chartDates = [];
        $chartRevenue = [];
        $chartOrders = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $chartDates[] = $date->format('d M');

            $dayData = Order::where('shop_id', $shop->id)
                ->whereDate('created_at', $date)
                ->whereNotIn('status', ['pending', 'cancelled']);

            $chartRevenue[] = (clone $dayData)->sum('total');
            $chartOrders[] = (clone $dayData)->count();
        }

        return view('admin.dashboard', compact(
            'shop', 
            'todayRevenue', 'todayOrdersCount', 
            'monthlyRevenue', 'monthlyOrdersCount',
            'topItems', 'recentOrders',
            'chartDates', 'chartRevenue', 'chartOrders'
        ));
    }
}
