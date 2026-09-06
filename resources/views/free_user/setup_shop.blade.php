@extends('layouts.auth')
@section('title', 'Setup Restoran - UnQueue')

@section('content')
<div class="text-center mb-8">
    <div class="w-16 h-16 bg-orange-100 text-brand rounded-full flex items-center justify-center mx-auto mb-4">
        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
    </div>
    <h1 class="text-3xl font-extrabold text-gray-900 mb-2">Setup Restoran</h1>
    <p class="text-gray-500 font-medium">Lengkapi profil untuk membuat toko Anda.</p>
</div>

<form method="POST" action="{{ route('shop.setup.store') }}" class="space-y-5">
    @csrf

    <div>
        <label for="name" class="block text-sm font-bold text-gray-900 mb-2">Nama Restoran / Kafe</label>
        <input type="text" name="name" id="name" value="{{ old('name') }}" required autofocus
            class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:border-brand focus:ring-1 focus:ring-brand focus:bg-white transition font-medium"
            placeholder="Contoh: Kopi Senja">
        @error('name')
            <p class="mt-2 text-sm text-red-600 font-medium">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="slug" class="block text-sm font-bold text-gray-900 mb-2">URL Link UnQueue</label>
        <div class="flex rounded-xl shadow-sm overflow-hidden border border-gray-200 focus-within:border-brand focus-within:ring-1 focus-within:ring-brand transition">
            <span class="inline-flex items-center px-4 bg-gray-100 text-gray-500 font-medium text-sm border-r border-gray-200">
                uq.app/s/
            </span>
            <input type="text" name="slug" id="slug" value="{{ old('slug') }}" required
                class="flex-1 min-w-0 w-full px-4 py-3 bg-gray-50 focus:bg-white text-sm font-medium border-0 focus:ring-0"
                placeholder="kopi-senja">
        </div>
        <p class="mt-2 text-xs text-gray-400 font-medium">Ini akan jadi link yang dipindai pelanggan Anda.</p>
        @error('slug')
            <p class="mt-2 text-sm text-red-600 font-medium">{{ $message }}</p>
        @enderror
    </div>

    <button type="submit" class="w-full flex items-center justify-center gap-2 bg-brand hover:bg-orange-600 text-white font-bold py-4 px-4 rounded-xl shadow-lg shadow-orange-500/30 transition hover:-translate-y-0.5 mt-6">
        Simpan & Lanjutkan
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
    </button>
</form>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const nameInput = document.getElementById('name');
        const slugInput = document.getElementById('slug');
        
        nameInput.addEventListener('input', function() {
            if (document.activeElement === nameInput) {
                let slug = this.value.toLowerCase()
                    .replace(/[^\w\s-]/g, '') 
                    .replace(/[\s_-]+/g, '-') 
                    .replace(/^-+|-+$/g, ''); 
                slugInput.value = slug;
            }
        });
    });
</script>
@endsection
