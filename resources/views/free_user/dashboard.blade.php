@extends('layouts.auth')
@section('title', 'Dashboard - UnQueue')

@section('content')
<div class="text-center mb-8">
    <div class="w-20 h-20 bg-orange-100 text-brand rounded-full flex items-center justify-center mx-auto mb-6">
        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
    </div>
    <h1 class="text-3xl font-extrabold text-gray-900 mb-2">Halo, {{ Auth::user()->name }}!</h1>
    <p class="text-gray-500 font-medium">Selamat datang di ekosistem UnQueue.</p>
</div>

<div class="bg-gray-50 border border-gray-200 rounded-2xl p-6 mb-8 text-center">
    <p class="text-sm text-gray-500 mb-2 font-bold uppercase tracking-wider">UnQueue ID (UQ-ID) Anda</p>
    <p class="text-3xl font-mono font-black text-brand tracking-widest">{{ Auth::user()->uq_id }}</p>
    <p class="text-xs text-gray-400 mt-3 font-medium">
        Berikan ID ini kepada Owner restoran jika Anda akan didaftarkan sebagai Karyawan (Kasir/Pelayan/Dapur).
    </p>
</div>

<div class="relative">
    <div class="absolute inset-0 flex items-center">
        <div class="w-full border-t border-gray-200"></div>
    </div>
    <div class="relative flex justify-center text-sm">
        <span class="px-2 bg-white text-gray-400 font-bold">ATAU</span>
    </div>
</div>

<div class="mt-8 text-center">
    <p class="text-gray-600 font-medium mb-6">
        Apakah Anda seorang pemilik usaha? Buat restoran pertama Anda untuk mulai menggunakan sistem.
    </p>
    <a href="{{ route('shop.setup.create') }}" class="w-full flex items-center justify-center gap-2 bg-gray-900 hover:bg-black text-white font-bold py-4 px-4 rounded-xl shadow-lg transition hover:-translate-y-0.5">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
        Buat Restoran Baru
    </a>
</div>
@endsection
