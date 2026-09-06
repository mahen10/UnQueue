@extends('layouts.admin')
@section('title', 'Admin Dashboard')

@section('content')
<div class="py-6 max-w-7xl mx-auto space-y-8">
    
    {{-- Header --}}
    <div class="flex justify-between items-end">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Dashboard Operasional</h1>
            <p class="text-sm text-gray-500 mt-1">Ringkasan pesanan dan operasional {{ $shop->name }} hari ini.</p>
        </div>
        <div class="flex items-center gap-3">
            <div class="px-4 py-2 bg-white border border-gray-200 rounded-lg text-sm font-medium text-gray-700 shadow-sm">
                {{ now()->format('d M Y') }}
            </div>
        </div>
    </div>

    {{-- Stats Cards (Operasional Saja) --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
        
        <!-- Pesanan Hari Ini -->
        <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100 flex items-center gap-5 hover:shadow-md transition">
            <div class="w-14 h-14 rounded-2xl bg-orange-50 text-orange-500 flex items-center justify-center shrink-0">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500 mb-1">Pesanan Hari Ini</p>
                <h3 class="text-2xl font-black text-gray-900">{{ number_format($todayOrdersCount, 0, ',', '.') }}</h3>
            </div>
        </div>

        <!-- Pesanan Bulan Ini -->
        <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100 flex items-center gap-5 hover:shadow-md transition">
            <div class="w-14 h-14 rounded-2xl bg-green-50 text-green-500 flex items-center justify-center shrink-0">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500 mb-1">Total Pesanan (Bulan Ini)</p>
                <h3 class="text-2xl font-black text-gray-900">{{ number_format($monthlyOrdersCount, 0, ',', '.') }}</h3>
            </div>
        </div>

    </div>

    {{-- Top Items & Recent Orders --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Recent Orders Table --}}
        <div class="lg:col-span-2 bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-100 flex justify-between items-center">
                <h3 class="font-bold text-gray-900 text-lg">Pesanan Terakhir</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-100">
                    <thead class="bg-gray-50/50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Order ID</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Meja</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Waktu</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
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
                                {{ $order->created_at->format('H:i') }}
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
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-8 text-center text-gray-500 text-sm">Belum ada pesanan masuk.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Top Items Donut Chart --}}
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6 flex flex-col h-full">
            <h3 class="font-bold text-gray-900 text-lg mb-6">Menu Terlaris (Bulan Ini)</h3>
            <div class="flex-grow flex items-center justify-center relative">
                @if($topItems->isEmpty())
                    <p class="text-gray-400 text-sm">Belum ada data penjualan.</p>
                @else
                    <canvas id="topItemsChart" class="max-h-48"></canvas>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
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
                            position: 'bottom',
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
