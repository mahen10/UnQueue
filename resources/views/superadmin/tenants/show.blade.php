@extends('layouts.app')
@section('title', 'Detail Restoran - ' . $shop->name)

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-6 flex justify-between items-center">
        <div>
            <a href="{{ route('superadmin.tenants.index') }}" class="text-blue-600 hover:underline text-sm mb-2 inline-block">← Kembali ke Daftar</a>
            <h1 class="text-2xl font-bold text-gray-900">{{ $shop->name }}</h1>
        </div>
        <div>
            @if($shop->subscription_override === 'active' || ($shop->subscription_end_date && $shop->subscription_end_date->isFuture()))
                <span class="bg-green-100 text-green-800 text-sm px-3 py-1 rounded-full font-bold">STATUS AKTIF</span>
            @else
                <span class="bg-red-100 text-red-800 text-sm px-3 py-1 rounded-full font-bold">TIDAK AKTIF</span>
            @endif
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        {{-- Info Profil --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h3 class="font-bold text-gray-900 border-b border-gray-100 pb-2 mb-4">Informasi Profil</h3>
            <div class="space-y-3 text-sm">
                <div>
                    <span class="text-gray-500 block">Owner</span>
                    <span class="font-medium text-gray-900">{{ $shop->owner->name ?? '-' }} ({{ $shop->owner->phone ?? '-' }})</span>
                </div>
                <div>
                    <span class="text-gray-500 block">Alamat</span>
                    <span class="text-gray-900">{{ $shop->address ?: 'Belum diisi' }}</span>
                </div>
                <div>
                    <span class="text-gray-500 block">Pajak / Service</span>
                    <span class="text-gray-900">{{ $shop->tax_percent }}% / {{ $shop->service_charge_percent }}%</span>
                </div>
                <div>
                    <span class="text-gray-500 block">Xendit Terhubung?</span>
                    <span class="text-gray-900 font-bold {{ $shop->xendit_secret_key ? 'text-green-600' : 'text-red-600' }}">
                        {{ $shop->xendit_secret_key ? 'YA' : 'TIDAK' }}
                    </span>
                </div>
            </div>
        </div>

        {{-- Statistik Data --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h3 class="font-bold text-gray-900 border-b border-gray-100 pb-2 mb-4">Statistik Data</h3>
            <div class="space-y-3 text-sm">
                <div class="flex justify-between">
                    <span class="text-gray-500">Jumlah Staf</span>
                    <span class="font-bold text-gray-900">{{ $shop->users->count() }} orang</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500">Kategori Menu</span>
                    <span class="font-bold text-gray-900">{{ $shop->categories->count() }} kategori</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500">Item Menu</span>
                    <span class="font-bold text-gray-900">{{ $shop->menuItems->count() }} item</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500">Jumlah Meja</span>
                    <span class="font-bold text-gray-900">{{ $shop->tables->count() }} meja</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
