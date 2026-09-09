@extends('layouts.superadmin')
@section('title', 'Pusat Kendali - CORE')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    <!-- Page Header -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Pusat Kendali</h1>
            <p class="text-sm text-slate-500 mt-1">Ringkasan statistik dan aktivitas platform UnQueue secara *real-time*.</p>
        </div>
        <div class="flex items-center gap-3">
            <span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-emerald-50 text-emerald-700 border border-emerald-200">
                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                Sistem Aktif
            </span>
        </div>
    </div>

    {{-- Kartu Metrik Utama --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        
        <!-- Metric 1 -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200/60 p-6 flex items-start gap-4 hover:shadow-md transition-shadow">
            <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-500 mb-1">Total Restoran</p>
                <p class="text-3xl font-bold text-slate-900 tracking-tight">{{ $totalShops }}</p>
            </div>
        </div>

        <!-- Metric 2 -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200/60 p-6 flex items-start gap-4 hover:shadow-md transition-shadow">
            <div class="w-12 h-12 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center shrink-0">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-500 mb-1">Total Pengguna</p>
                <p class="text-3xl font-bold text-slate-900 tracking-tight">{{ $totalUsers }}</p>
            </div>
        </div>

        <!-- Metric 3 -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200/60 p-6 flex items-start gap-4 hover:shadow-md transition-shadow">
            <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                </svg>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-500 mb-1">Langganan Aktif</p>
                <p class="text-3xl font-bold text-slate-900 tracking-tight">{{ $activeSubscriptions }}</p>
            </div>
        </div>

        <!-- Metric 4 -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200/60 p-6 flex items-start gap-4 hover:shadow-md transition-shadow">
            <div class="w-12 h-12 rounded-xl bg-orange-50 text-orange-600 flex items-center justify-center shrink-0">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                </svg>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-500 mb-1">Total Transaksi</p>
                <p class="text-3xl font-bold text-slate-900 tracking-tight">{{ $totalOrders }}</p>
            </div>
        </div>

    </div>

    <!-- Grid Kolom -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        {{-- Pendaftaran Terbaru --}}
        <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-slate-200/60 overflow-hidden flex flex-col">
            <div class="px-6 py-5 border-b border-slate-100 flex justify-between items-center bg-white/50 backdrop-blur-sm">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                    <h3 class="font-bold text-slate-900">Restoran Terbaru</h3>
                </div>
                <a href="{{ route('superadmin.tenants.index') }}" class="text-sm font-semibold text-indigo-600 hover:text-indigo-800 transition">Lihat Semua &rarr;</a>
            </div>
            <div class="divide-y divide-slate-100 flex-1">
                @forelse($recentShops as $shop)
                <div class="px-6 py-4 flex justify-between items-center hover:bg-slate-50 transition-colors group">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-slate-100 to-slate-200 flex items-center justify-center text-slate-500 font-bold text-sm shadow-inner">
                            {{ substr($shop->name, 0, 1) }}
                        </div>
                        <div>
                            <p class="font-semibold text-sm text-slate-900 group-hover:text-indigo-600 transition-colors">{{ $shop->name }}</p>
                            <p class="text-xs text-slate-500 mt-0.5">Oleh: <span class="font-medium text-slate-700">{{ $shop->owner->name ?? 'N/A' }}</span> ? Didaftarkan {{ $shop->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                    <div>
                        @if($shop->subscription_override === 'active' || ($shop->subscription_end_date && $shop->subscription_end_date->isFuture()))
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800">
                                Aktif
                            </span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-slate-100 text-slate-600">
                                Tidak Aktif
                            </span>
                        @endif
                    </div>
                </div>
                @empty
                <div class="px-6 py-12 text-center flex flex-col items-center justify-center">
                    <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mb-3">
                        <svg class="w-8 h-8 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" /></svg>
                    </div>
                    <p class="text-slate-500 text-sm font-medium">Belum ada restoran yang terdaftar di platform.</p>
                </div>
                @endforelse
            </div>
        </div>

        {{-- Tindakan Cepat --}}
        <div class="bg-slate-900 rounded-2xl shadow-xl border border-slate-800 overflow-hidden relative group">
            <div class="absolute inset-0 bg-gradient-to-br from-indigo-500/20 to-purple-500/20 opacity-50 group-hover:opacity-100 transition-opacity"></div>
            
            <div class="relative px-6 py-5 border-b border-slate-800/50">
                <h3 class="font-bold text-white flex items-center gap-2">
                    <svg class="w-5 h-5 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                    Akses Cepat
                </h3>
            </div>
            
            <div class="relative p-5 space-y-3">
                <a href="{{ route('superadmin.tenants.index') }}" class="flex items-center p-3 rounded-xl bg-slate-800/80 hover:bg-indigo-500/20 hover:ring-1 hover:ring-indigo-500/50 text-sm font-medium text-slate-200 transition-all backdrop-blur-sm group/btn">
                    <div class="w-8 h-8 rounded-lg bg-slate-700 flex items-center justify-center mr-3 group-hover/btn:bg-indigo-500/50 transition-colors">
                        <svg class="w-4 h-4 text-slate-300 group-hover/btn:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                    </div>
                    Manajemen Restoran
                    <svg class="w-4 h-4 ml-auto text-slate-500 group-hover/btn:text-indigo-400 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                </a>
                
                <a href="{{ route('superadmin.users.index') }}" class="flex items-center p-3 rounded-xl bg-slate-800/80 hover:bg-indigo-500/20 hover:ring-1 hover:ring-indigo-500/50 text-sm font-medium text-slate-200 transition-all backdrop-blur-sm group/btn">
                    <div class="w-8 h-8 rounded-lg bg-slate-700 flex items-center justify-center mr-3 group-hover/btn:bg-indigo-500/50 transition-colors">
                        <svg class="w-4 h-4 text-slate-300 group-hover/btn:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                    </div>
                    Manajemen Pengguna
                    <svg class="w-4 h-4 ml-auto text-slate-500 group-hover/btn:text-indigo-400 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                </a>
            </div>
            
            <!-- Graphic Element -->
            <div class="absolute -bottom-10 -right-10 w-32 h-32 bg-indigo-500 rounded-full blur-3xl opacity-30 pointer-events-none"></div>
        </div>

    </div>
</div>
@endsection
