@extends('layouts.owner')
@section('title', 'Analytics - ' . $shop->name)

@section('content')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="py-4 sm:py-6 max-w-7xl mx-auto px-0 sm:px-2 space-y-5 pb-24 md:pb-8">

    {{-- ===== HEADER: Page Title + Quick Actions ===== --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <div class="flex items-center gap-2 flex-wrap">
                <h1 class="text-2xl sm:text-3xl font-extrabold text-gray-900 tracking-tight">Analytics</h1>
                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200/60">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                    Live Toko
                </span>
            </div>
            <p class="mt-1 text-xs sm:text-sm text-gray-500 font-medium">Ringkasan performa &amp; transaksi gerai {{ $shop->name }}</p>
        </div>

        <div class="flex flex-wrap items-center gap-2 sm:gap-3">
            <div class="flex items-center gap-2 bg-white border border-gray-200 px-3.5 py-2 rounded-xl shadow-sm text-xs sm:text-sm font-semibold text-gray-700">
                <svg class="w-4 h-4 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <span>{{ \Carbon\Carbon::now()->startOfMonth()->format('d.m.Y') }} - {{ \Carbon\Carbon::now()->format('d.m.Y') }}</span>
            </div>
            <a href="{{ route('kasir.pos') }}" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-xl text-xs sm:text-sm font-bold transition shadow-sm shadow-blue-500/25 active:scale-[0.98]">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7H7a2 2 0 00-2 2v9a2 2 0 002 2h10a2 2 0 002-2V9a2 2 0 00-2-2h-2M9 7a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                <span class="hidden sm:inline">Buka Kasir</span>
                <span class="sm:hidden">Kasir</span>
            </a>
        </div>
    </div>

    {{-- ===== MOBILE CTA (only on small screens) ===== --}}
    <div class="md:hidden">
        <a href="{{ route('kasir.pos') }}" class="w-full flex items-center justify-between px-4 py-3.5 rounded-2xl bg-blue-600 text-white shadow-md active:scale-[0.99] transition-all">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-white/20 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7H7a2 2 0 00-2 2v9a2 2 0 002 2h10a2 2 0 002-2V9a2 2 0 00-2-2h-2M9 7a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                </div>
                <div>
                    <p class="font-bold text-sm leading-tight">Buka Kasir POS</p>
                    <p class="text-xs text-white/80">Terminal Kasir Siap Pakai</p>
                </div>
            </div>
            <div class="flex items-center gap-1 bg-white/20 px-3 py-1.5 rounded-xl text-sm font-semibold">
                <span>Mulai</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </div>
        </a>
    </div>

    {{-- ===== METRICS: 2-col mobile, 4-col desktop ===== --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4 lg:gap-5">

        {{-- Orders Today --}}
        <div class="bg-white rounded-2xl sm:rounded-3xl p-4 sm:p-5 lg:p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all group flex flex-col justify-between gap-3">
            <div class="flex justify-between items-start">
                <div>
                    <span class="text-xs sm:text-sm font-semibold text-gray-500">Orders Today</span>
                    <p class="text-[10px] sm:text-xs text-gray-400 hidden sm:block">Total struk transaksi</p>
                </div>
                <div class="p-2 sm:p-2.5 bg-blue-50 rounded-xl text-blue-600 group-hover:scale-110 transition-transform">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                </div>
            </div>
            <div>
                <h3 class="text-2xl sm:text-3xl font-extrabold text-gray-900 tracking-tight">{{ $todayOrdersCount }}</h3>
                <div class="flex items-center justify-between mt-2 pt-2 border-t border-gray-100">
                    <span class="text-xs font-semibold text-emerald-600 flex items-center gap-1">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 10l7-7m0 0l7 7m-7-7v18"/></svg>
                        Updated
                    </span>
                    <span class="text-[10px] font-medium text-gray-400 hidden sm:block">Hari ini</span>
                </div>
            </div>
        </div>

        {{-- Orders This Month --}}
        <div class="bg-white rounded-2xl sm:rounded-3xl p-4 sm:p-5 lg:p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all group flex flex-col justify-between gap-3">
            <div class="flex justify-between items-start">
                <div>
                    <span class="text-xs sm:text-sm font-semibold text-gray-500">Bulan Ini</span>
                    <p class="text-[10px] sm:text-xs text-gray-400 hidden sm:block">Akumulasi pesanan</p>
                </div>
                <div class="p-2 sm:p-2.5 bg-amber-50 rounded-xl text-amber-600 group-hover:scale-110 transition-transform">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                </div>
            </div>
            <div>
                <h3 class="text-2xl sm:text-3xl font-extrabold text-gray-900 tracking-tight">{{ number_format($monthlyOrdersCount, 0, ',', '.') }}</h3>
                <div class="flex items-center justify-between mt-2 pt-2 border-t border-gray-100">
                    <span class="text-xs font-semibold text-emerald-600 flex items-center gap-1">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 10l7-7m0 0l7 7m-7-7v18"/></svg>
                        Total
                    </span>
                    <span class="text-[10px] font-medium text-gray-400 hidden sm:block">Running</span>
                </div>
            </div>
        </div>

        {{-- Today's Revenue --}}
        <div class="bg-white rounded-2xl sm:rounded-3xl p-4 sm:p-5 lg:p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all group flex flex-col justify-between gap-3">
            <div class="flex justify-between items-start">
                <div>
                    <span class="text-xs sm:text-sm font-semibold text-gray-500">Revenue Hari Ini</span>
                    <p class="text-[10px] sm:text-xs text-gray-400 hidden sm:block">Penjualan bersih</p>
                </div>
                <div class="p-2 sm:p-2.5 bg-emerald-50 rounded-xl text-emerald-600 group-hover:scale-110 transition-transform">
                    <span class="font-black text-xs sm:text-sm leading-none">Rp</span>
                </div>
            </div>
            <div>
                <div class="flex items-baseline gap-1">
                    <span class="text-xs font-bold text-gray-400 hidden sm:block">Rp</span>
                    <h3 class="text-base sm:text-2xl lg:text-3xl font-extrabold text-gray-900 tracking-tight">{{ number_format($todayRevenue, 0, ',', '.') }}</h3>
                </div>
                <div class="flex items-center justify-between mt-2 pt-2 border-t border-gray-100">
                    <span class="text-xs font-semibold text-emerald-600 flex items-center gap-1">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 10l7-7m0 0l7 7m-7-7v18"/></svg>
                        Daily
                    </span>
                    <span class="text-[10px] font-medium text-gray-400 hidden sm:block">Sales</span>
                </div>
            </div>
        </div>

        {{-- Monthly Revenue --}}
        <div class="bg-white rounded-2xl sm:rounded-3xl p-4 sm:p-5 lg:p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all group flex flex-col justify-between gap-3">
            <div class="flex justify-between items-start">
                <div>
                    <span class="text-xs sm:text-sm font-semibold text-gray-500">Omzet Bulan Ini</span>
                    <p class="text-[10px] sm:text-xs text-gray-400 hidden sm:block">Pendapatan bulanan</p>
                </div>
                <div class="p-2 sm:p-2.5 bg-purple-50 rounded-xl text-purple-600 group-hover:scale-110 transition-transform">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
            </div>
            <div>
                <div class="flex items-baseline gap-1">
                    <span class="text-xs font-bold text-gray-400 hidden sm:block">Rp</span>
                    <h3 class="text-base sm:text-2xl lg:text-3xl font-extrabold text-gray-900 tracking-tight">{{ number_format($monthlyRevenue, 0, ',', '.') }}</h3>
                </div>
                <div class="flex items-center justify-between mt-2 pt-2 border-t border-gray-100">
                    <span class="text-xs font-semibold text-emerald-600 flex items-center gap-1">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 10l7-7m0 0l7 7m-7-7v18"/></svg>
                        Total
                    </span>
                    <span class="text-[10px] font-medium text-gray-400 hidden sm:block">Bulan ini</span>
                </div>
            </div>
        </div>
    </div>

    {{-- ===== CHARTS ROW: Bar (2/3) + Donut (1/3) ===== --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 sm:gap-5 lg:gap-6">

        {{-- Sales Bar Chart --}}
        <div class="lg:col-span-2 bg-white rounded-2xl sm:rounded-3xl p-4 sm:p-5 lg:p-6 shadow-sm border border-gray-100 flex flex-col">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-5">
                <div>
                    <h3 class="font-bold text-gray-900 text-base sm:text-lg">Sales Dynamics</h3>
                    <p class="text-xs text-gray-400 mt-0.5">Pendapatan harian 7 hari terakhir</p>
                </div>
                <span class="text-xs font-semibold bg-blue-50 text-blue-700 px-3 py-1 rounded-full border border-blue-100 self-start sm:self-auto">Last 7 Days</span>
            </div>
            <div class="relative w-full h-52 sm:h-64 lg:h-72">
                <canvas id="salesChart"></canvas>
            </div>
        </div>

        {{-- Top Items Donut --}}
        <div class="bg-white rounded-2xl sm:rounded-3xl p-4 sm:p-5 lg:p-6 shadow-sm border border-gray-100 flex flex-col">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h3 class="font-bold text-gray-900 text-base sm:text-lg">Top Menu Items</h3>
                    <p class="text-xs text-gray-400 mt-0.5">Produk paling laris bulan ini</p>
                </div>
                <span class="text-xs font-medium bg-gray-100 text-gray-600 px-2.5 py-1 rounded-full">Bulan Ini</span>
            </div>
            <div class="flex-1 flex items-center justify-center min-h-[200px] sm:min-h-[220px]">
                @if($topItems->isEmpty())
                    <p class="text-gray-400 text-sm text-center">Belum ada data penjualan.</p>
                @else
                    <div class="w-full h-48 sm:h-52 relative">
                        <canvas id="topItemsChart"></canvas>
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- ===== RECENT ORDERS TABLE ===== --}}
    <div class="bg-white rounded-2xl sm:rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-4 sm:px-6 py-4 sm:py-5 border-b border-gray-100 flex items-center justify-between">
            <div>
                <h3 class="font-bold text-gray-900 text-base sm:text-lg">Customer Orders</h3>
                <p class="text-xs text-gray-400 mt-0.5">Daftar transaksi pesanan terkini</p>
            </div>
            <button type="button" onclick="location.reload()" class="p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-50 rounded-xl transition" title="Refresh">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
            </button>
        </div>

        {{-- Desktop Table --}}
        <div class="hidden sm:block overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-100 text-left">
                <thead class="bg-gray-50/75">
                    <tr>
                        <th class="px-5 sm:px-6 py-3.5 text-xs font-bold text-gray-500 uppercase tracking-wider">Order ID</th>
                        <th class="px-4 sm:px-6 py-3.5 text-xs font-bold text-gray-500 uppercase tracking-wider">Meja / Tipe</th>
                        <th class="px-4 sm:px-6 py-3.5 text-xs font-bold text-gray-500 uppercase tracking-wider">Waktu</th>
                        <th class="px-4 sm:px-6 py-3.5 text-xs font-bold text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-5 sm:px-6 py-3.5 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">Total</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @forelse($recentOrders as $order)
                    <tr class="hover:bg-gray-50/80 transition-colors">
                        <td class="px-5 sm:px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center text-xs font-extrabold shrink-0">
                                    {{ substr($order->order_number, -2) }}
                                </div>
                                <span class="text-sm font-bold text-gray-900">#{{ $order->order_number }}</span>
                            </div>
                        </td>
                        <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm text-gray-600 font-medium">
                            {{ $order->table->name ?? 'Takeaway / Manual' }}
                        </td>
                        <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $order->created_at->format('d.m.Y H:i') }}
                        </td>
                        <td class="px-4 sm:px-6 py-4 whitespace-nowrap">
                            <span class="px-2.5 py-1 inline-flex text-xs leading-none font-bold rounded-full
                                {{ match($order->status) {
                                    'pending'    => 'bg-yellow-100 text-yellow-700',
                                    'paid'       => 'bg-indigo-100 text-indigo-700',
                                    'processing' => 'bg-blue-100 text-blue-700',
                                    'ready'      => 'bg-amber-100 text-amber-800',
                                    'delivered'  => 'bg-emerald-100 text-emerald-800',
                                    'cancelled'  => 'bg-red-100 text-red-700',
                                    default      => 'bg-gray-100 text-gray-500'
                                } }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                        <td class="px-5 sm:px-6 py-4 whitespace-nowrap text-right text-sm font-extrabold text-gray-900">
                            Rp {{ number_format($order->total, 0, ',', '.') }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-10 text-center text-gray-400 text-sm">Belum ada pesanan terbaru.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Mobile Card List --}}
        <div class="sm:hidden divide-y divide-gray-100">
            @forelse($recentOrders as $order)
            <div class="flex items-center justify-between p-4 hover:bg-gray-50 active:scale-[0.99] transition-all cursor-pointer">
                <div class="flex flex-col min-w-0 flex-1 pr-3">
                    <div class="flex items-center gap-2 flex-wrap">
                        <span class="text-sm font-bold text-gray-900 truncate">#{{ $order->order_number }}</span>
                        <span class="px-2 py-0.5 rounded-full text-xs font-bold shrink-0
                            {{ match($order->status) {
                                'pending'    => 'bg-yellow-100 text-yellow-700',
                                'paid'       => 'bg-indigo-100 text-indigo-700',
                                'processing' => 'bg-blue-100 text-blue-700',
                                'ready'      => 'bg-amber-100 text-amber-800',
                                'delivered'  => 'bg-emerald-100 text-emerald-800',
                                'cancelled'  => 'bg-red-100 text-red-700',
                                default      => 'bg-gray-100 text-gray-500'
                            } }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </div>
                    <div class="flex items-center gap-1.5 mt-1 text-gray-500 text-xs">
                        <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16"/></svg>
                        <span>{{ $order->table->name ?? 'Takeaway' }}</span>
                        <span>•</span>
                        <span>{{ $order->created_at->format('H:i') }}</span>
                    </div>
                </div>
                <div class="flex flex-col items-end shrink-0">
                    <span class="text-sm font-extrabold text-gray-900">Rp {{ number_format($order->total, 0, ',', '.') }}</span>
                </div>
            </div>
            @empty
            <div class="py-10 text-center text-gray-400 text-sm">Belum ada pesanan terbaru.</div>
            @endforelse
        </div>

        <div class="px-4 sm:px-6 py-3.5 bg-gray-50/50 border-t border-gray-100 flex items-center justify-between text-xs text-gray-500">
            <span>Menampilkan {{ $recentOrders->count() }} pesanan terbaru</span>
            <a href="{{ route('owner.reports.index') }}" class="font-semibold text-blue-600 hover:text-blue-700">Lihat Semua &rarr;</a>
        </div>
    </div>

</div>

{{-- ===== MOBILE BOTTOM NAV ===== --}}
<div class="md:hidden fixed bottom-0 left-0 right-0 z-40 bg-white/95 backdrop-blur-md border-t border-gray-200 flex items-center justify-around px-4 py-2.5 shadow-lg">
    <a href="{{ route('owner.dashboard') }}" class="flex flex-col items-center gap-1 {{ request()->routeIs('owner.dashboard') ? 'text-blue-600 font-bold' : 'text-gray-400' }} text-[10px]">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
        Analytics
    </a>
    <a href="{{ route('owner.reports.index') }}" class="flex flex-col items-center gap-1 {{ request()->routeIs('owner.reports.*') ? 'text-blue-600 font-bold' : 'text-gray-400' }} text-[10px]">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
        Laporan
    </a>
    <a href="{{ route('kasir.pos') }}" class="flex flex-col items-center gap-1 text-gray-400 text-[10px]">
        <div class="w-10 h-10 -mt-5 bg-blue-600 rounded-full flex items-center justify-center shadow-lg shadow-blue-500/30">
            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7H7a2 2 0 00-2 2v9a2 2 0 002 2h10a2 2 0 002-2V9a2 2 0 00-2-2h-2M9 7a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2"/></svg>
        </div>
        Kasir
    </a>
    <a href="{{ route('owner.staff.index') }}" class="flex flex-col items-center gap-1 {{ request()->routeIs('owner.staff.*') ? 'text-blue-600 font-bold' : 'text-gray-400' }} text-[10px]">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
        Karyawan
    </a>
    <a href="{{ route('owner.settings.edit') }}" class="flex flex-col items-center gap-1 {{ request()->routeIs('owner.settings.*') ? 'text-blue-600 font-bold' : 'text-gray-400' }} text-[10px]">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
        Setelan
    </a>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const dates   = {!! json_encode(array_reverse($chartDates)) !!};
        const revenue = {!! json_encode(array_reverse($chartRevenue)) !!};

        const ctxSales = document.getElementById('salesChart');
        if (ctxSales) {
            new Chart(ctxSales, {
                type: 'bar',
                data: {
                    labels: dates,
                    datasets: [{
                        label: 'Pendapatan (Rp)',
                        data: revenue,
                        backgroundColor: '#3b82f6',
                        hoverBackgroundColor: '#2563eb',
                        borderRadius: 6,
                        barThickness: window.innerWidth < 640 ? 12 : 20,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: '#0f172a',
                            titleFont: { size: 12, family: "'Inter', sans-serif" },
                            bodyFont:  { size: 12, family: "'Inter', sans-serif" },
                            padding: 10,
                            cornerRadius: 8,
                            callbacks: {
                                label: ctx => ' Rp ' + ctx.parsed.y.toLocaleString('id-ID')
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: { color: '#f1f5f9', drawBorder: false },
                            border: { display: false },
                            ticks: {
                                font: { size: 11, family: "'Inter', sans-serif" },
                                color: '#94a3b8',
                                callback: v => v >= 1000000 ? (v / 1000000) + 'jt' : v.toLocaleString('id-ID')
                            }
                        },
                        x: {
                            grid: { display: false },
                            border: { display: false },
                            ticks: { font: { size: 11, family: "'Inter', sans-serif" }, color: '#64748b' }
                        }
                    }
                }
            });
        }

        const topItemsLabels = {!! json_encode($topItems->pluck('item_name')) !!};
        const topItemsData   = {!! json_encode($topItems->pluck('total_sold')) !!};

        const ctxTop = document.getElementById('topItemsChart');
        if (ctxTop && topItemsLabels.length > 0) {
            new Chart(ctxTop, {
                type: 'doughnut',
                data: {
                    labels: topItemsLabels,
                    datasets: [{
                        data: topItemsData,
                        backgroundColor: ['#f97316','#3b82f6','#8b5cf6','#eab308','#10b981'],
                        borderWidth: 2,
                        borderColor: '#ffffff',
                        hoverOffset: 4,
                        cutout: '72%'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: window.innerWidth < 640 ? 'bottom' : 'right',
                            labels: {
                                usePointStyle: true,
                                pointStyle: 'circle',
                                boxWidth: 8, boxHeight: 8,
                                padding: 12,
                                font: { size: 11, family: "'Inter', sans-serif", weight: '600' },
                                color: '#475569'
                            }
                        },
                        tooltip: {
                            backgroundColor: '#0f172a',
                            titleFont: { size: 12, family: "'Inter', sans-serif" },
                            bodyFont:  { size: 12, family: "'Inter', sans-serif" },
                            padding: 10,
                            cornerRadius: 8
                        }
                    }
                }
            });
        }
    });
</script>
@endsection
