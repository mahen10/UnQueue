@extends('layouts.app')
@section('title', 'Masuk')

@section('content')
<div class="max-w-md mx-auto mt-16 p-6 bg-white rounded-xl shadow-sm border border-gray-100">
    <div class="text-center mb-8">
        <h1 class="text-2xl font-bold text-gray-900">Selamat Datang Kembali</h1>
        <p class="text-gray-500 text-sm mt-1">Masuk untuk mengelola restoran Anda</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <div>
            <label for="phone" class="block text-sm font-medium text-gray-700">Nomor Handphone</label>
            <input type="text" name="phone" id="phone" value="{{ old('phone') }}" required autofocus
                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm px-4 py-2.5 border"
                placeholder="Contoh: 08123456789">
            @error('phone')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <input type="password" name="password" id="password" required
                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm px-4 py-2.5 border">
            @error('password')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <input id="remember" name="remember" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                <label for="remember" class="ml-2 block text-sm text-gray-700">Ingat Saya</label>
            </div>
            
            <!-- Optional: Forgot password link -->
            <div class="text-sm">
                <a href="#" class="font-medium text-blue-600 hover:text-blue-500">Lupa password?</a>
            </div>
        </div>

        <button type="submit" class="w-full flex justify-center py-2.5 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition">
            Masuk
        </button>
    </form>

    <div class="mt-6 text-center text-sm text-gray-500 border-t border-gray-100 pt-6">
        Belum punya akun? 
        <a href="{{ route('register') }}" class="font-medium text-blue-600 hover:text-blue-500">Daftar sekarang</a>
    </div>
</div>
@endsection
