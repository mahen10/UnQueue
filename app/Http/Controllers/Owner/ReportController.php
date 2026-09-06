<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $shop = $request->attributes->get('shop');

        // Default: bulan ini
        $startDate = $request->query('start_date', Carbon::now()->startOfMonth()->format('Y-m-d'));
        $endDate = $request->query('end_date', Carbon::now()->endOfMonth()->format('Y-m-d'));

        $query = Order::with(['items', 'payment'])
            ->where('shop_id', $shop->id)
            ->whereNotIn('status', ['pending', 'cancelled'])
            ->whereBetween('created_at', [
                Carbon::parse($startDate)->startOfDay(),
                Carbon::parse($endDate)->endOfDay()
            ]);

        // Hitung total ringkasan
        $totalRevenue = (clone $query)->sum('total');
        $totalOrders = (clone $query)->count();
        $totalTax = (clone $query)->sum('tax_amount');
        $totalServiceCharge = (clone $query)->sum('service_charge_amount');
        $netRevenue = (clone $query)->sum('subtotal');

        // Ambil data (paginate 50 per halaman)
        $orders = $query->latest()->paginate(50)->withQueryString();

        return view('owner.reports.index', compact(
            'shop', 'orders', 'startDate', 'endDate',
            'totalRevenue', 'totalOrders', 'totalTax', 'totalServiceCharge', 'netRevenue'
        ));
    }

    public function export(Request $request)
    {
        // TODO: Fase lanjut — Export ke CSV/Excel. Sementara redirect back.
        return back()->with('info', 'Fitur export CSV akan segera hadir.');
    }
}
