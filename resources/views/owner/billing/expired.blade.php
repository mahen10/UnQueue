@extends('layouts.app')
@section('title', 'Langganan Berakhir')
@section('content')
<div class="max-w-lg mx-auto px-4 py-16 text-center">
    <div class="w-20 h-20 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-6">
        <svg class="w-10 h-10 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
        </svg>
    </div>
    <h1 class="text-2xl font-bold text-gray-900">Langganan Anda Telah Berakhir</h1>
    <p class="text-gray-500 mt-3 text-sm leading-relaxed">
        Semua operasional sistem UnQueue untuk <strong>{{ $shop->name }}</strong> telah dinonaktifkan. 
        Perpanjang langganan Anda untuk mengaktifkan kembali QR pemesanan, laporan, dan manajemen staf.
    </p>
    <form action="{{ route('owner.billing.subscribe') }}" method="POST" class="mt-8">
        @csrf
        <button type="submit" class="bg-blue-600 text-white px-8 py-3 rounded-xl text-base font-semibold hover:bg-blue-700 shadow-lg">
            Perpanjang Sekarang
        </button>
    </form>
    <form method="POST" action="{{ route('logout') }}" class="mt-4">
        @csrf
        <button type="submit" class="text-sm text-gray-400 hover:text-gray-600">Logout</button>
    </form>
</div>
@endsection
