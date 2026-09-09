@extends('layouts.auth')

@section('title', 'Verifikasi Email')

@section('content')
<div class="text-center">
    <div class="w-16 h-16 bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center mx-auto mb-6">
        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
    </div>
    
    <h1 class="text-2xl font-bold text-gray-900 mb-2">Cek Kotak Masuk Anda</h1>
    <p class="text-gray-500 mb-8 text-sm">
        Terima kasih telah mendaftar! Sebelum memulai, silakan verifikasi alamat email Anda dengan mengeklik tautan yang baru saja kami kirimkan.
    </p>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-8 font-medium text-sm text-green-600 bg-green-50 py-3 px-4 rounded-xl">
            Tautan verifikasi baru telah dikirim ke alamat email yang Anda berikan saat pendaftaran.
        </div>
    @endif

    <form method="POST" action="{{ route('verification.send') }}" class="mb-4">
        @csrf
        <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-4 rounded-xl transition duration-200 shadow-sm shadow-indigo-200">
            Kirim Ulang Tautan
        </button>
    </form>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="text-sm font-semibold text-indigo-600 hover:text-indigo-800 transition">
            Keluar
        </button>
    </form>
</div>
@endsection
