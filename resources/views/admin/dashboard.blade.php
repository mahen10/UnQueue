@extends('layouts.admin')
@section('title', 'Dashboard Operasional')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="py-4 sm:py-6 max-w-7xl mx-auto px-0 sm:px-2 space-y-5 pb-24 md:pb-8">

    {{-- ===== HEADER ===== --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <div class="flex items-center gap-2 flex-wrap">
                <h1 class="text-2xl sm:text-3xl font-extrabold text-gray-900 tracking-tight">Dashboard Operasional</h1>
                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200/60">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                    Live
                </span>
            </div>
            <p class="mt-1 text-xs sm:text-sm text-gray-500 font-medium">Ringkasan pesanan dan operasional {{ $shop->name }} hari ini</p>
        </div>
        <div class="flex items-center gap-2">
            <div class="flex items-center gap-2 bg-white border border-gray-200 px-3.5 py-2 rounded-xl shadow-sm text-xs sm:text-sm font-semibold text-gray-700">
                <svg class="w-4 h-4 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                <span>{{ now()->format('d M Y') }}</span>
            </div>
            <a href="{{ route('kasir.pos') }}" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-xl text-xs sm:text-sm font-bold transition shadow-sm shadow-blue-500/25">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7H7a2 2 0 00-2 2v9a2 2 0 002 2h10a2 2 0 002-2V9a2 2 0 00-2-2h-2M9 7a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                <span class="hidden sm:inline">Buka Kasir</span>
                <span class="sm:hidden">Kasir</span>
            </a>
        </div>
    </div>

    {{-- ===== MOBILE CTA ===== --}}
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

    {{-- ===== STATS: 2-col mobile, 4-col desktop ===== --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4 lg:gap-5">

        {{-- Pesanan Hari Ini --}}
        <div class="bg-white rounded-2xl sm:rounded-3xl p-4 sm:p-5 lg:p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all group flex flex-col justify-between gap-3">
            <div class="flex justify-between items-start">
                <div>
                    <span class="text-xs sm:text-sm font-semibold text-gray-500">Pesanan Hari Ini</span>
                    <p class="text-[10px] sm:text-xs text-gray-400 hidden sm:block">Struk transaksi</p>
                </div>
                <div class="p-2 sm:p-2.5 bg-orange-50 rounded-xl text-orange-500 group-hover:scale-110 transition-transform">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                </div>
            </div>
            <div>
                <h3 class="text-2xl sm:text-3xl font-extrabold text-gray-900 tracking-tight">{{ number_format($todayOrdersCount, 0, ',', '.') }}</h3>
                <div class="flex items-center justify-between mt-2 pt-2 border-t border-gray-100">
                    <span class="text-xs font-semibold text-emerald-600 flex items-center gap-1">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 10l7-7m0 0l7 7m-7-7v18"/></svg>
                        Live
                    </span>
                    <span class="text-[10px] font-medium text-gray-400 hidden sm:block">Hari ini</span>
                </div>
            </div>
        </div>

        {{-- Pesanan Bulan Ini --}}
        <div class="bg-white rounded-2xl sm:rounded-3xl p-4 sm:p-5 lg:p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all group flex flex-col justify-between gap-3">
            <div class="flex justify-between items-start">
                <div>
                    <span class="text-xs sm:text-sm font-semibold text-gray-500">Bulan Ini</span>
                    <p class="text-[10px] sm:text-xs text-gray-400 hidden sm:block">Akumulasi pesanan</p>
                </div>
                <div class="p-2 sm:p-2.5 bg-green-50 rounded-xl text-green-600 group-hover:scale-110 transition-transform">
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

        {{-- Active Tables (Meja Aktif) --}}
        <div class="bg-white rounded-2xl sm:rounded-3xl p-4 sm:p-5 lg:p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all group flex flex-col justify-between gap-3">
            <div class="flex justify-between items-start">
                <div>
                    <span class="text-xs sm:text-sm font-semibold text-gray-500">Meja Aktif</span>
                    <p class="text-[10px] sm:text-xs text-gray-400 hidden sm:block">Sedang dipakai</p>
                </div>
                <div class="p-2 sm:p-2.5 bg-blue-50 rounded-xl text-blue-600 group-hover:scale-110 transition-transform">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                </div>
            </div>
            <div>
                <h3 class="text-2xl sm:text-3xl font-extrabold text-gray-900 tracking-tight">{{ $activeTables ?? '-' }}</h3>
                <div class="flex items-center justify-between mt-2 pt-2 border-t border-gray-100">
                    <span class="text-xs font-semibold text-blue-600 flex items-center gap-1">
                        <span class="w-2 h-2 rounded-full bg-blue-500 animate-pulse"></span>
                        Live
                    </span>
                    <span class="text-[10px] font-medium text-gray-400 hidden sm:block">Sekarang</span>
                </div>
            </div>
        </div>

        {{-- Menu Items --}}
        <div class="bg-white rounded-2xl sm:rounded-3xl p-4 sm:p-5 lg:p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all group flex flex-col justify-between gap-3">
            <div class="flex justify-between items-start">
                <div>
                    <span class="text-xs sm:text-sm font-semibold text-gray-500">Total Menu</span>
                    <p class="text-[10px] sm:text-xs text-gray-400 hidden sm:block">Item aktif tersedia</p>
                </div>
                <div class="p-2 sm:p-2.5 bg-purple-50 rounded-xl text-purple-600 group-hover:scale-110 transition-transform">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                </div>
            </div>
            <div>
                <h3 class="text-2xl sm:text-3xl font-extrabold text-gray-900 tracking-tight">{{ $totalMenuItems ?? '-' }}</h3>
                <div class="flex items-center justify-between mt-2 pt-2 border-t border-gray-100">
                    <a href="{{ route('admin.menu-items.index') }}" class="text-xs font-semibold text-blue-600 hover:text-blue-700">Kelola &rarr;</a>
                </div>
            </div>
        </div>
    </div>

    {{-- ===== CHARTS + TABLE ROW ===== --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 sm:gap-5 lg:gap-6">

        {{-- Recent Orders: 2/3 width desktop --}}
        <div class="lg:col-span-2 bg-white rounded-2xl sm:rounded-3xl shadow-sm border border-gray-100 overflow-hidden flex flex-col">
            <div class="px-4 sm:px-6 py-4 sm:py-5 border-b border-gray-100 flex items-center justify-between">
                <div>
                    <h3 class="font-bold text-gray-900 text-base sm:text-lg">Pesanan Terakhir</h3>
                    <p class="text-xs text-gray-400 mt-0.5">Aktivitas transaksi terkini</p>
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
                            <th class="px-4 sm:px-6 py-3.5 text-xs font-bold text-gray-500 uppercase tracking-wider">Meja</th>
                            <th class="px-4 sm:px-6 py-3.5 text-xs font-bold text-gray-500 uppercase tracking-wider">Waktu</th>
                            <th class="px-4 sm:px-6 py-3.5 text-xs font-bold text-gray-500 uppercase tracking-wider">Status</th>
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
                                {{ $order->created_at->format('H:i') }}
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
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-10 text-center text-gray-400 text-sm">Belum ada pesanan masuk hari ini.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Mobile Card List --}}
            <div class="sm:hidden divide-y divide-gray-100">
                @forelse($recentOrders as $order)
                <div class="flex items-center justify-between p-4 hover:bg-gray-50">
                    <div class="flex flex-col min-w-0 flex-1 pr-3">
                        <div class="flex items-center gap-2 flex-wrap">
                            <span class="text-sm font-bold text-gray-900">#{{ $order->order_number }}</span>
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
                    <span class="text-xs font-bold text-gray-500 shrink-0">Rp {{ number_format($order->total, 0, ',', '.') }}</span>
                </div>
                @empty
                <div class="py-10 text-center text-gray-400 text-sm">Belum ada pesanan masuk.</div>
                @endforelse
            </div>
        </div>

        {{-- Top Items Donut --}}
        <div class="bg-white rounded-2xl sm:rounded-3xl shadow-sm border border-gray-100 p-4 sm:p-5 lg:p-6 flex flex-col">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h3 class="font-bold text-gray-900 text-base sm:text-lg">Menu Terlaris</h3>
                    <p class="text-xs text-gray-400 mt-0.5">Bulan ini</p>
                </div>
                <span class="text-xs font-medium bg-gray-100 text-gray-600 px-2.5 py-1 rounded-full">Top 5</span>
            </div>
            <div class="flex-1 flex items-center justify-center min-h-[180px]">
                @if($topItems->isEmpty())
                    <p class="text-gray-400 text-sm text-center">Belum ada data penjualan.</p>
                @else
                    <div class="w-full h-48 relative">
                        <canvas id="topItemsChart"></canvas>
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- ===== QUICK LINKS GRID ===== --}}
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 sm:gap-4">
        <a href="{{ route('admin.menu-items.index') }}" class="flex flex-col items-center gap-2.5 p-4 bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-md hover:border-blue-100 transition-all group active:scale-[0.98]">
            <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
            </div>
            <span class="text-xs font-semibold text-gray-700 text-center">Kelola Menu</span>
        </a>
        <a href="{{ route('admin.categories.index') }}" class="flex flex-col items-center gap-2.5 p-4 bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-md hover:border-orange-100 transition-all group active:scale-[0.98]">
            <div class="w-10 h-10 rounded-xl bg-orange-50 text-orange-500 flex items-center justify-center group-hover:scale-110 transition-transform">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
            </div>
            <span class="text-xs font-semibold text-gray-700 text-center">Kategori</span>
        </a>
        <a href="{{ route('admin.tables.index') }}" class="flex flex-col items-center gap-2.5 p-4 bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-md hover:border-green-100 transition-all group active:scale-[0.98]">
            <div class="w-10 h-10 rounded-xl bg-green-50 text-green-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
            </div>
            <span class="text-xs font-semibold text-gray-700 text-center">Kelola Meja</span>
        </a>
        <a href="{{ route('kasir.pos') }}" class="flex flex-col items-center gap-2.5 p-4 bg-blue-600 rounded-2xl border border-blue-700 shadow-sm hover:shadow-md hover:bg-blue-700 transition-all group active:scale-[0.98]">
            <div class="w-10 h-10 rounded-xl bg-white/20 text-white flex items-center justify-center group-hover:scale-110 transition-transform">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7H7a2 2 0 00-2 2v9a2 2 0 002 2h10a2 2 0 002-2V9a2 2 0 00-2-2h-2M9 7a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2"/></svg>
            </div>
            <span class="text-xs font-semibold text-white text-center">Buka Kasir</span>
        </a>
    </div>

</div>

{{-- ===== MOBILE BOTTOM NAV ===== --}}
<div class="md:hidden fixed bottom-0 left-0 right-0 z-40 bg-white/95 backdrop-blur-md border-t border-gray-200 flex items-center justify-around px-4 py-2.5 shadow-lg">
    <a href="{{ route('admin.dashboard') }}" class="flex flex-col items-center gap-1 {{ request()->routeIs('admin.dashboard') ? 'text-blue-600 font-bold' : 'text-gray-400' }} text-[10px]">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
        Dashboard
    </a>
    <a href="{{ route('admin.menu-items.index') }}" class="flex flex-col items-center gap-1 {{ request()->routeIs('admin.menu-items.*') ? 'text-blue-600 font-bold' : 'text-gray-400' }} text-[10px]">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
        Menu
    </a>
    <a href="{{ route('kasir.pos') }}" class="flex flex-col items-center gap-1 text-gray-400 text-[10px]">
        <div class="w-10 h-10 -mt-5 bg-blue-600 rounded-full flex items-center justify-center shadow-lg shadow-blue-500/30">
            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7H7a2 2 0 00-2 2v9a2 2 0 002 2h10a2 2 0 002-2V9a2 2 0 00-2-2h-2M9 7a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2"/></svg>
        </div>
        Kasir
    </a>
    <a href="{{ route('admin.tables.index') }}" class="flex flex-col items-center gap-1 {{ request()->routeIs('admin.tables.*') ? 'text-blue-600 font-bold' : 'text-gray-400' }} text-[10px]">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
        Meja
    </a>
    <a href="{{ route('admin.categories.index') }}" class="flex flex-col items-center gap-1 {{ request()->routeIs('admin.categories.*') ? 'text-blue-600 font-bold' : 'text-gray-400' }} text-[10px]">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
        Kategori
    </a>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
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
                            position: 'bottom',
                            labels: {
                                usePointStyle: true,
                                pointStyle: 'circle',
                                boxWidth: 8, boxHeight: 8,
                                padding: 10,
                                font: { size: 11, family: "'Inter', sans-serif", weight: '600' },
                                color: '#475569'
                            }
                        },
                        tooltip: {
                            backgroundColor: '#0f172a',
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
