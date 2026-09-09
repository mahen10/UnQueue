@extends('layouts.auth')
@section('title', 'Sign In - UnQueue')

@section('content')
<div class="text-center mb-8">
    <h1 class="text-3xl font-extrabold text-gray-900 mb-2">Selamat Datang</h1>
    <p class="text-gray-500 font-medium">Masuk ke akun UnQueue Anda.</p>
</div>

@if(session('success'))
    <div class="bg-green-50 text-green-700 p-4 rounded-xl mb-6 font-medium text-sm border border-green-200">
        {{ session('success') }}
    </div>
@endif
@if($errors->any())
    <div class="bg-red-50 text-red-700 p-4 rounded-xl mb-6 font-medium text-sm border border-red-200">
        {{ $errors->first() }}
    </div>
@endif

<form method="POST" action="{{ route('login') }}" class="space-y-5">
    @csrf
    <div>
        <label class="block text-sm font-bold text-gray-900 mb-2">Email / No. HP / UQ-ID</label>
        <input type="text" name="login" value="{{ old('login') }}" required autofocus
            class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:border-brand focus:ring-1 focus:ring-brand focus:bg-white transition"
            placeholder="Masukkan ID Anda">
    </div>

    <div>
        <div class="flex justify-between items-center mb-2">
            <label class="block text-sm font-bold text-gray-900">Password</label>
            <a href="#" class="text-brand text-xs font-bold hover:underline">Lupa Password?</a>
        </div>
        <input type="password" name="password" required
            class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:border-brand focus:ring-1 focus:ring-brand focus:bg-white transition"
            placeholder="••••••••">
    </div>

    <button type="submit" class="w-full bg-brand hover:bg-indigo-600 text-white font-bold py-3.5 px-4 rounded-xl shadow-lg shadow-indigo-500/30 transition hover:-translate-y-0.5 mt-2">
        Sign In
    </button>
</form>

<div class="mt-6">
    <div class="relative">
        <div class="absolute inset-0 flex items-center">
            <div class="w-full border-t border-gray-200"></div>
        </div>
        <div class="relative flex justify-center text-sm">
            <span class="px-3 bg-white text-gray-500 font-medium">atau masuk dengan</span>
        </div>
    </div>

    <div class="mt-6">
        <a href="{{ route('auth.google') }}" class="w-full flex items-center justify-center gap-3 bg-white border border-gray-200 text-gray-700 font-bold py-3 px-4 rounded-xl hover:bg-gray-50 transition shadow-sm">
            <svg class="w-5 h-5" viewBox="0 0 24 24">
                <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
            </svg>
            Google
        </a>
    </div>
</div>

<p class="text-center text-sm text-gray-500 mt-8 font-medium">
    Belum punya akun? 
    <a href="{{ route('register') }}" class="text-brand font-bold hover:underline">Daftar Gratis</a>
</p>
@endsection
