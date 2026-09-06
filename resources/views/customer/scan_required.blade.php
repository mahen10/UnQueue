@extends('layouts.customer')
@section('title', 'Scan QR Dulu')

@section('content')
<div class="min-h-screen flex flex-col items-center justify-center px-8 text-center">
    <div class="w-20 h-20 bg-orange-100 rounded-full flex items-center justify-center mb-6">
        <svg class="w-10 h-10 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 3.5a.5.5 0 010 1H3.5a.5.5 0 010-1H20zM4 4h4v4H4V4zm12 0h4v4h-4V4zm0 12h4v4h-4v-4z"></path>
        </svg>
    </div>
    <h2 class="text-xl font-bold text-gray-900">Scan QR Code Meja Dulu</h2>
    <p class="text-gray-500 text-sm mt-2 leading-relaxed">
        Untuk memesan, silakan pindai QR Code yang tersedia di meja Anda.
    </p>
    <p class="text-xs text-gray-400 mt-4">
        Jika halaman ini muncul setelah scan, kemungkinan sesi Anda sudah berakhir. Silakan scan ulang.
    </p>
</div>
@endsection
