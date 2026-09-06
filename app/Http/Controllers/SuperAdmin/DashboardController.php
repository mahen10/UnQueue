<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Shop;
use App\Models\User;
use App\Models\Order;
use App\Models\Subscription;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalShops = Shop::count();
        $totalUsers = User::count();
        $totalOrders = Order::count();
        
        $activeSubscriptions = Subscription::where('status', 'active')->count();

        // Riwayat toko terbaru
        $recentShops = Shop::with('owner')->latest()->take(5)->get();

        return view('superadmin.dashboard', compact(
            'totalShops', 'totalUsers', 'totalOrders', 'activeSubscriptions', 'recentShops'
        ));
    }
}
