<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderTrackingController extends Controller
{
    public function index(Order $order)
    {
        if (! session('customer_shop_id')) {
            return view('customer.scan_required');
        }

        // Pastikan order ini memang milik sesi meja ini
        if ($order->shop_id !== session('customer_shop_id')) {
            abort(403);
        }

        $order->load('items', 'payment');

        $shopName  = session('customer_shop_name');
        $tableName = session('customer_table_name');
        $cartCount = array_sum(array_column(session('cart', []), 'qty'));

        return view('customer.tracking', compact('order', 'shopName', 'tableName', 'cartCount'));
    }
}
