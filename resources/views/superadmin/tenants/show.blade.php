@extends('layouts.superadmin')
@section('title', 'Detail Restoran - ' . $shop->name . ' - CORE')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <a href="{{ route('superadmin.tenants.index') }}" class="text-indigo-600 hover:text-indigo-800 text-sm mb-2 flex items-center gap-1.5 font-medium transition-colors">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                Kembali ke Daftar
            </a>
            <h1 class="text-3xl font-bold text-slate-900 tracking-tight flex items-center gap-3">
                {{ $shop->name }}
            </h1>
            <p class="text-slate-500 text-sm mt-1 font-mono">ID Restoran: {{ $shop->id }}</p>
        </div>
        <div>
            @if($shop->subscription_override === 'active' || ($shop->subscription_end_date && $shop->subscription_end_date->isFuture()))
                <span class="inline-flex items-center px-4 py-2 rounded-xl text-sm font-bold bg-emerald-50 text-emerald-700 border border-emerald-200 shadow-sm">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 mr-2 animate-pulse"></span>
                    STATUS: AKTIF
                </span>
            @else
                <span class="inline-flex items-center px-4 py-2 rounded-xl text-sm font-bold bg-rose-50 text-rose-700 border border-rose-200 shadow-sm">
                    <span class="w-2 h-2 rounded-full bg-rose-500 mr-2"></span>
                    STATUS: TIDAK AKTIF
                </span>
            @endif
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Info Profil --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200/60 p-6 relative overflow-hidden group">
            <div class="absolute top-0 right-0 p-4 opacity-5 text-indigo-900 pointer-events-none group-hover:scale-110 transition-transform">
                <svg class="w-24 h-24" fill="currentColor" viewBox="0 0 24 24"><path d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
            </div>
            <h3 class="font-bold text-slate-900 border-b border-slate-100 pb-3 mb-5 flex items-center gap-2 relative z-10">
                <svg class="w-5 h-5 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                Informasi Profil
            </h3>
            <div class="space-y-4 text-sm relative z-10">
                <div>
                    <span class="text-slate-500 block mb-0.5 font-medium text-xs uppercase tracking-wider">Pemilik (Owner)</span>
                    <span class="font-bold text-slate-900">{{ $shop->owner->name ?? 'Belum Ditentukan' }}</span>
                    @if(isset($shop->owner->phone))
                        <span class="text-slate-500 block text-xs mt-0.5">{{ $shop->owner->phone }}</span>
                    @endif
                </div>
                <div>
                    <span class="text-slate-500 block mb-0.5 font-medium text-xs uppercase tracking-wider">Alamat Fisik</span>
                    <span class="text-slate-800 font-medium">{{ $shop->address ?: 'Belum diisi oleh pemilik' }}</span>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-slate-50 p-3 rounded-xl border border-slate-100">
                        <span class="text-slate-500 block mb-1 text-xs font-semibold">Pajak PPN</span>
                        <span class="text-slate-900 font-bold text-lg">{{ $shop->tax_percent }}%</span>
                    </div>
                    <div class="bg-slate-50 p-3 rounded-xl border border-slate-100">
                        <span class="text-slate-500 block mb-1 text-xs font-semibold">Service Charge</span>
                        <span class="text-slate-900 font-bold text-lg">{{ $shop->service_charge_percent }}%</span>
                    </div>
                </div>
                <div class="pt-2">
                    <span class="text-slate-500 block mb-1.5 font-medium text-xs uppercase tracking-wider">Integrasi Xendit</span>
                    @if($shop->xendit_secret_key)
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-emerald-50 text-emerald-700 text-xs font-bold rounded-lg border border-emerald-200">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            TERHUBUNG
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-rose-50 text-rose-700 text-xs font-bold rounded-lg border border-rose-200">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            BELUM TERHUBUNG
                        </span>
                    @endif
                </div>
            </div>
        </div>

        {{-- Statistik Data --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200/60 p-6 lg:col-span-2">
            <h3 class="font-bold text-slate-900 border-b border-slate-100 pb-3 mb-5 flex items-center gap-2">
                <svg class="w-5 h-5 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" /></svg>
                Statistik Operasional
            </h3>
            
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                <div class="bg-slate-50 rounded-xl p-4 border border-slate-100 text-center hover:bg-indigo-50 hover:border-indigo-100 transition-colors">
                    <div class="w-10 h-10 mx-auto bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center mb-2">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                    </div>
                    <span class="text-2xl font-bold text-slate-900 block">{{ $shop->users->count() }}</span>
                    <span class="text-xs text-slate-500 font-semibold uppercase tracking-wider">Total Staf</span>
                </div>
                
                <div class="bg-slate-50 rounded-xl p-4 border border-slate-100 text-center hover:bg-indigo-50 hover:border-indigo-100 transition-colors">
                    <div class="w-10 h-10 mx-auto bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center mb-2">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" /></svg>
                    </div>
                    <span class="text-2xl font-bold text-slate-900 block">{{ $shop->categories->count() }}</span>
                    <span class="text-xs text-slate-500 font-semibold uppercase tracking-wider">Kategori</span>
                </div>
                
                <div class="bg-slate-50 rounded-xl p-4 border border-slate-100 text-center hover:bg-indigo-50 hover:border-indigo-100 transition-colors">
                    <div class="w-10 h-10 mx-auto bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center mb-2">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" /></svg>
                    </div>
                    <span class="text-2xl font-bold text-slate-900 block">{{ $shop->menuItems->count() }}</span>
                    <span class="text-xs text-slate-500 font-semibold uppercase tracking-wider">Item Menu</span>
                </div>
                
                <div class="bg-slate-50 rounded-xl p-4 border border-slate-100 text-center hover:bg-indigo-50 hover:border-indigo-100 transition-colors">
                    <div class="w-10 h-10 mx-auto bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center mb-2">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" /></svg>
                    </div>
                    <span class="text-2xl font-bold text-slate-900 block">{{ $shop->tables->count() }}</span>
                    <span class="text-xs text-slate-500 font-semibold uppercase tracking-wider">Meja QR</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
