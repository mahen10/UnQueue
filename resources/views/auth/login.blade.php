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
        <label class="block text-sm font-bold text-gray-900 mb-2">Nomor Telepon</label>
        <input type="text" name="phone" value="{{ old('phone') }}" required autofocus
            class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:border-brand focus:ring-1 focus:ring-brand focus:bg-white transition"
            placeholder="0812xxxx">
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

<p class="text-center text-sm text-gray-500 mt-8 font-medium">
    Belum punya akun? 
    <a href="{{ route('register') }}" class="text-brand font-bold hover:underline">Daftar Gratis</a>
</p>
@endsection
