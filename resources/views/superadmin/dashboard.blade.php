@extends('layouts.app')
@section('title', 'Dashboard Super Admin')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-900">Dashboard Super Admin</h1>
        <p class="text-sm text-gray-500 mt-1">Ringkasan platform UnQueue secara keseluruhan.</p>
    </div>

    {{-- Kartu Metrik --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <p class="text-sm font-medium text-gray-500 mb-1">Total Restoran</p>
            <p class="text-2xl font-bold text-gray-900">{{ $totalShops }}</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <p class="text-sm font-medium text-gray-500 mb-1">Total Pengguna</p>
            <p class="text-2xl font-bold text-gray-900">{{ $totalUsers }}</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <p class="text-sm font-medium text-gray-500 mb-1">Total Transaksi</p>
            <p class="text-2xl font-bold text-blue-600">{{ $totalOrders }}</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <p class="text-sm font-medium text-gray-500 mb-1">Langganan Aktif</p>
            <p class="text-2xl font-bold text-green-600">{{ $activeSubscriptions }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Pendaftaran Terbaru --}}
        <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-gray-100">
            <div class="px-6 py-5 border-b border-gray-100 flex justify-between items-center">
                <h3 class="font-bold text-gray-900">Restoran Terbaru</h3>
                <a href="{{ route('superadmin.tenants.index') }}" class="text-sm text-blue-600 hover:underline">Kelola Semua</a>
            </div>
            <div class="divide-y divide-gray-100">
                @forelse($recentShops as $shop)
                <div class="px-6 py-4 flex justify-between items-center hover:bg-gray-50">
                    <div>
                        <p class="font-medium text-sm text-gray-900">{{ $shop->name }}</p>
                        <p class="text-xs text-gray-500 mt-1">Owner: {{ $shop->owner->name ?? 'N/A' }} · Dibuat {{ $shop->created_at->diffForHumans() }}</p>
                    </div>
                    <div>
                        @if($shop->subscription_override === 'active' || ($shop->subscription_end_date && $shop->subscription_end_date->isFuture()))
                            <span class="bg-green-100 text-green-800 text-xs px-2.5 py-1 rounded-full font-medium">Aktif</span>
                        @else
                            <span class="bg-red-100 text-red-800 text-xs px-2.5 py-1 rounded-full font-medium">Tidak Aktif</span>
                        @endif
                    </div>
                </div>
                @empty
                <div class="px-6 py-8 text-center text-gray-500 text-sm">
                    Belum ada restoran yang mendaftar.
                </div>
                @endforelse
            </div>
        </div>

        {{-- Tindakan Cepat --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100">
            <div class="px-6 py-5 border-b border-gray-100">
                <h3 class="font-bold text-gray-900">Tindakan Cepat</h3>
            </div>
            <div class="p-4 space-y-2">
                <a href="{{ route('superadmin.tenants.index') }}" class="block px-4 py-3 rounded-lg bg-gray-50 hover:bg-gray-100 text-sm font-medium text-gray-700 transition">
                    🏢 Kelola Restoran & Subscription
                </a>
                <a href="{{ route('superadmin.users.index') }}" class="block px-4 py-3 rounded-lg bg-gray-50 hover:bg-gray-100 text-sm font-medium text-gray-700 transition">
                    👥 Kelola Semua Pengguna
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
