@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8 text-center max-w-2xl mx-auto">
        <div class="w-16 h-16 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
        </div>
        <h1 class="text-2xl font-bold text-gray-900">Halo, {{ Auth::user()->name }}!</h1>
        <div class="mt-4 mb-4 bg-gray-50 border border-gray-200 rounded-lg p-4 inline-block">
            <p class="text-sm text-gray-500 mb-1">UnQueue ID (UQ-ID) Anda:</p>
            <p class="text-2xl font-mono font-bold text-blue-600">{{ Auth::user()->uq_id }}</p>
            <p class="text-xs text-gray-400 mt-2">Berikan ID ini kepada Owner jika Anda ingin didaftarkan sebagai Karyawan (Kasir/Pelayan/Dapur).</p>
        </div>
        <p class="text-gray-500 mt-2">Atau, jika Anda adalah pemilik usaha, silakan buat restoran pertama Anda untuk mulai menggunakan sistem UnQueue.</p>
        
        <div class="mt-8">
            <a href="{{ route('shop.setup.create') }}" class="inline-flex justify-center items-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700 shadow-sm transition">
                Buat Restoran Baru
            </a>
        </div>
    </div>
</div>
@endsection
