@extends('layouts.app')
@section('title', 'Analytics - ' . $shop->name)

@section('content')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 bg-[#F8FAFC]">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Analytics</h1>
            <p class="mt-1 text-sm text-gray-500 font-medium">Overview for {{ $shop->name }}</p>
        </div>
        <div class="flex items-center gap-3">
            <span class="text-sm text-gray-500 bg-white border border-gray-200 px-4 py-2 rounded-xl shadow-sm font-medium">
                {{ \Carbon\Carbon::now()->startOfMonth()->format('d.m.Y') }} - {{ \Carbon\Carbon::now()->format('d.m.Y') }}
            </span>
            <a href="{{ route('kasir.pos') }}" class="bg-orange-600 text-white px-5 py-2 rounded-xl text-sm font-bold hover:bg-orange-700 transition shadow-md">
                Buka Kasir
            </a>
        </div>
    </div>

    {{-- Metrics Row --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        {{-- Pesanan Hari Ini --}}
        <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100 flex flex-col justify-between hover:shadow-md transition">
            <div class="flex justify-between items-start mb-4">
                <span class="text-sm font-semibold text-gray-500">Orders Today</span>
                <div class="p-2 bg-blue-50 rounded-lg text-blue-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                </div>
            </div>
            <div>
                <h3 class="text-3xl font-extrabold text-gray-900">{{ $todayOrdersCount }}</h3>
                <p class="text-xs font-medium text-green-500 mt-2 flex items-center gap-1">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg>
                    Updated today
                </p>
            </div>
        </div>

        {{-- Pesanan Bulan Ini --}}
        <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100 flex flex-col justify-between hover:shadow-md transition">
            <div class="flex justify-between items-start mb-4">
                <span class="text-sm font-semibold text-gray-500">Orders This Month</span>
                <div class="p-2 bg-orange-50 rounded-lg text-orange-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                </div>
            </div>
            <div>
                <h3 class="text-3xl font-extrabold text-gray-900">{{ $monthlyOrdersCount }}</h3>
                <p class="text-xs font-medium text-green-500 mt-2 flex items-center gap-1">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg>
                    Running total
                </p>
            </div>
        </div>

        {{-- Pendapatan Hari Ini --}}
        <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100 flex flex-col justify-between hover:shadow-md transition">
            <div class="flex justify-between items-start mb-4">
                <span class="text-sm font-semibold text-gray-500">Today's Revenue</span>
                <div class="p-2 bg-green-50 rounded-lg text-green-600">
                    <span class="font-bold text-lg leading-none">Rp</span>
                </div>
            </div>
            <div>
                <h3 class="text-3xl font-extrabold text-gray-900">{{ number_format($todayRevenue, 0, ',', '.') }}</h3>
                <p class="text-xs font-medium text-green-500 mt-2 flex items-center gap-1">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg>
                    Daily sales
                </p>
            </div>
        </div>

        {{-- Pendapatan Bulan Ini --}}
        <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100 flex flex-col justify-between hover:shadow-md transition">
            <div class="flex justify-between items-start mb-4">
                <span class="text-sm font-semibold text-gray-500">Monthly Revenue</span>
                <div class="p-2 bg-purple-50 rounded-lg text-purple-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
            </div>
            <div>
                <h3 class="text-3xl font-extrabold text-gray-900">{{ number_format($monthlyRevenue, 0, ',', '.') }}</h3>
                <p class="text-xs font-medium text-green-500 mt-2 flex items-center gap-1">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg>
                    This month
                </p>
            </div>
        </div>
    </div>

    {{-- Charts & Activity Row --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        {{-- Bar Chart: Sales Dynamics --}}
        <div class="lg:col-span-2 bg-white rounded-3xl p-6 shadow-sm border border-gray-100">
            <div class="flex justify-between items-center mb-6">
                <h3 class="font-bold text-gray-900 text-lg">Sales Dynamics</h3>
                <span class="text-xs font-medium bg-gray-100 text-gray-600 px-3 py-1 rounded-full">Last 7 Days</span>
            </div>
            <div class="h-64">
                <canvas id="salesChart"></canvas>
            </div>
        </div>

        {{-- Donut Chart: Top Items --}}
        <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100 flex flex-col">
            <div class="flex justify-between items-center mb-4">
                <h3 class="font-bold text-gray-900 text-lg">Top Items</h3>
                <span class="text-xs font-medium bg-gray-100 text-gray-600 px-3 py-1 rounded-full">This Month</span>
            </div>
            <div class="flex-grow flex items-center justify-center relative">
                @if($topItems->isEmpty())
                    <p class="text-gray-400 text-sm">No sales data yet.</p>
                @else
                    <canvas id="topItemsChart" class="max-h-48"></canvas>
                @endif
            </div>
        </div>
    </div>

    {{-- Recent Orders Table --}}
    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-100 flex justify-between items-center">
            <h3 class="font-bold text-gray-900 text-lg">Customer order</h3>
            <button class="text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
            </button>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-100">
                <thead class="bg-gray-50/50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Order ID</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Table</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">Price</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @forelse($recentOrders as $order)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center text-xs font-bold">
                                    {{ substr($order->order_number, -2) }}
                                </div>
                                <span class="text-sm font-bold text-gray-900">#{{ $order->order_number }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 font-medium">
                            {{ $order->table->name ?? 'Takeaway / Manual' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $order->created_at->format('d.m.Y H:i') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full 
                                {{ match($order->status) {
                                    'pending' => 'bg-yellow-100 text-yellow-700',
                                    'paid' => 'bg-indigo-100 text-indigo-700',
                                    'processing' => 'bg-blue-100 text-blue-700',
                                    'ready' => 'bg-orange-100 text-orange-700',
                                    'delivered' => 'bg-green-100 text-green-700',
                                    'cancelled' => 'bg-red-100 text-red-700',
                                    default => 'bg-gray-100 text-gray-500'
                                } }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-extrabold text-gray-900">
                            Rp {{ number_format($order->total, 0, ',', '.') }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-gray-500 text-sm">No recent orders found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Prepare data from controller
        const dates = {!! json_encode(array_reverse($chartDates)) !!};
        const revenue = {!! json_encode(array_reverse($chartRevenue)) !!};
        const orderCounts = {!! json_encode(array_reverse($chartOrders)) !!};
        
        // Sales Bar Chart
        const ctxSales = document.getElementById('salesChart');
        if(ctxSales) {
            new Chart(ctxSales, {
                type: 'bar',
                data: {
                    labels: dates,
                    datasets: [{
                        label: 'Revenue (Rp)',
                        data: revenue,
                        backgroundColor: '#3b82f6', // blue-500
                        borderRadius: 4,
                        barThickness: 16,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: '#f1f5f9', // slate-100
                                drawBorder: false,
                            },
                            border: { display: false }
                        },
                        x: {
                            grid: { display: false },
                            border: { display: false }
                        }
                    }
                }
            });
        }

        // Top Items Donut Chart
        const topItemsLabels = {!! json_encode($topItems->pluck('item_name')) !!};
        const topItemsData = {!! json_encode($topItems->pluck('total_sold')) !!};
        
        const ctxTop = document.getElementById('topItemsChart');
        if(ctxTop && topItemsLabels.length > 0) {
            new Chart(ctxTop, {
                type: 'doughnut',
                data: {
                    labels: topItemsLabels,
                    datasets: [{
                        data: topItemsData,
                        backgroundColor: [
                            '#f97316', // orange-500
                            '#3b82f6', // blue-500
                            '#8b5cf6', // violet-500
                            '#eab308', // yellow-500
                            '#22c55e', // green-500
                        ],
                        borderWidth: 0,
                        cutout: '75%'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'right',
                            labels: {
                                usePointStyle: true,
                                boxWidth: 8,
                                font: {
                                    size: 11,
                                    family: "'Inter', sans-serif"
                                }
                            }
                        }
                    }
                }
            });
        }
    });
</script>
@endsection
