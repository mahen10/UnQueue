@extends('layouts.app')
@section('title', 'Dashboard Owner')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Dashboard {{ $shop->name }}</h1>
            <p class="text-sm text-gray-500 mt-1">Ringkasan performa restoran Anda</p>
        </div>
        <div>
            <a href="{{ route('owner.reports.index') }}" class="inline-flex items-center gap-2 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 text-sm font-medium">
                Lihat Laporan Lengkap →
            </a>
        </div>
    </div>

    {{-- Kartu Metrik --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        {{-- Hari ini --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <p class="text-sm font-medium text-gray-500 mb-1">Pendapatan Hari Ini</p>
            <p class="text-2xl font-bold text-gray-900">Rp {{ number_format($todayRevenue, 0, ',', '.') }}</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <p class="text-sm font-medium text-gray-500 mb-1">Pesanan Hari Ini</p>
            <p class="text-2xl font-bold text-gray-900">{{ $todayOrdersCount }}</p>
        </div>

        {{-- Bulan ini --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <p class="text-sm font-medium text-gray-500 mb-1">Pendapatan Bulan Ini</p>
            <p class="text-2xl font-bold text-blue-600">Rp {{ number_format($monthlyRevenue, 0, ',', '.') }}</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <p class="text-sm font-medium text-gray-500 mb-1">Pesanan Bulan Ini</p>
            <p class="text-2xl font-bold text-blue-600">{{ $monthlyOrdersCount }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Pesanan Terbaru --}}
        <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-gray-100">
            <div class="px-6 py-5 border-b border-gray-100 flex justify-between items-center">
                <h3 class="font-bold text-gray-900">Pesanan Terbaru</h3>
                <a href="{{ route('kasir.pos') }}" class="text-sm text-blue-600 hover:underline">Buka POS Kasir</a>
            </div>
            <div class="divide-y divide-gray-100">
                @forelse($recentOrders as $order)
                <div class="px-6 py-4 flex justify-between items-center">
                    <div>
                        <p class="font-medium text-sm text-gray-900">#{{ $order->order_number }}</p>
                        <p class="text-xs text-gray-500 mt-1">{{ $order->table->name ?? 'Manual' }} · {{ $order->created_at->diffForHumans() }}</p>
                    </div>
                    <div class="text-right">
                        <p class="font-bold text-gray-900 text-sm">Rp {{ number_format($order->total, 0, ',', '.') }}</p>
                        <span class="text-xs px-2 py-0.5 rounded-full inline-block mt-1
                            {{ match($order->status) {
                                'pending' => 'bg-yellow-100 text-yellow-700',
                                'paid' => 'bg-blue-100 text-blue-700',
                                'processing' => 'bg-orange-100 text-orange-700',
                                'ready' => 'bg-green-100 text-green-700',
                                'delivered' => 'bg-gray-100 text-gray-700',
                                'cancelled' => 'bg-red-100 text-red-700',
                                default => 'bg-gray-100 text-gray-500'
                            } }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </div>
                </div>
                @empty
                <div class="px-6 py-8 text-center text-gray-500 text-sm">
                    Belum ada pesanan masuk.
                </div>
                @endforelse
            </div>
        </div>

        {{-- Menu Terlaris --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100">
            <div class="px-6 py-5 border-b border-gray-100">
                <h3 class="font-bold text-gray-900">Menu Terlaris (Bulan Ini)</h3>
            </div>
            <div class="p-6">
                @if($topItems->isEmpty())
                    <p class="text-center text-gray-500 text-sm py-4">Belum ada data penjualan.</p>
                @else
                    <div class="space-y-4">
                        @foreach($topItems as $item)
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-medium text-gray-700">{{ $item->item_name }}</span>
                            <span class="text-sm text-gray-500 font-bold">{{ $item->total_sold }} terjual</span>
                        </div>
                        @if(!$loop->last)
                            <div class="w-full bg-gray-100 h-px"></div>
                        @endif
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
