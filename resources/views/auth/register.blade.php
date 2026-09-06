@extends('layouts.auth')
@section('title', 'Daftar - UnQueue')

@section('content')
<div class="text-center mb-8">
    <h1 class="text-3xl font-extrabold text-gray-900 mb-2">Buat Akun Gratis</h1>
    <p class="text-gray-500 font-medium">Langkah pertama digitalisasi restoran Anda.</p>
</div>

@if($errors->any())
    <div class="bg-red-50 text-red-700 p-4 rounded-xl mb-6 font-medium text-sm border border-red-200">
        {{ $errors->first() }}
    </div>
@endif

<form method="POST" action="{{ route('register') }}" class="space-y-4">
    @csrf
    
    <div>
        <label class="block text-sm font-bold text-gray-900 mb-2">Nama Lengkap</label>
        <input type="text" name="name" value="{{ old('name') }}" required autofocus
            class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:border-brand focus:ring-1 focus:ring-brand focus:bg-white transition"
            placeholder="John Doe">
    </div>

    <div>
        <label class="block text-sm font-bold text-gray-900 mb-2">Nomor Telepon</label>
        <input type="text" name="phone" value="{{ old('phone') }}" required
            class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:border-brand focus:ring-1 focus:ring-brand focus:bg-white transition"
            placeholder="0812xxxx">
    </div>

    <div>
        <label class="block text-sm font-bold text-gray-900 mb-2">Password</label>
        <input type="password" name="password" required
            class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:border-brand focus:ring-1 focus:ring-brand focus:bg-white transition"
            placeholder="Minimal 8 karakter">
    </div>

    <div>
        <label class="block text-sm font-bold text-gray-900 mb-2">Konfirmasi Password</label>
        <input type="password" name="password_confirmation" required
            class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:border-brand focus:ring-1 focus:ring-brand focus:bg-white transition"
            placeholder="Ketik ulang password">
    </div>

    <button type="submit" class="w-full bg-brand hover:bg-indigo-600 text-white font-bold py-3.5 px-4 rounded-xl shadow-lg shadow-indigo-500/30 transition hover:-translate-y-0.5 mt-4">
        Daftar Sekarang
    </button>
</form>

<p class="text-center text-sm text-gray-500 mt-8 font-medium">
    Sudah punya akun? 
    <a href="{{ route('login') }}" class="text-brand font-bold hover:underline">Masuk di sini</a>
</p>
@endsection
