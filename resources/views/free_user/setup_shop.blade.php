@extends('layouts.app')
@section('title', 'Setup Restoran')

@section('content')
<div class="max-w-md mx-auto mt-12 p-6 bg-white rounded-xl shadow-sm border border-gray-100">
    <div class="text-center mb-8">
        <h1 class="text-2xl font-bold text-gray-900">Setup Restoran</h1>
        <p class="text-gray-500 text-sm mt-1">Lengkapi data restoran Anda</p>
    </div>

    <form method="POST" action="{{ route('shop.setup.store') }}" class="space-y-5">
        @csrf

        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Nama Restoran</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" required autofocus
                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm px-4 py-2.5 border"
                placeholder="Contoh: Kopi Senja">
            @error('name')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="slug" class="block text-sm font-medium text-gray-700">URL Pendek (Slug)</label>
            <div class="mt-1 flex rounded-md shadow-sm">
                <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm">
                    uq.app/t/
                </span>
                <input type="text" name="slug" id="slug" value="{{ old('slug') }}" required
                    class="flex-1 min-w-0 block w-full px-3 py-2.5 rounded-none rounded-r-lg focus:ring-blue-500 focus:border-blue-500 sm:text-sm border-gray-300 border"
                    placeholder="kopi-senja">
            </div>
            <p class="mt-1 text-xs text-gray-500">Gunakan huruf, angka, dan strip (-). Tidak boleh ada spasi.</p>
            @error('slug')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="w-full flex justify-center py-2.5 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition">
            Simpan & Lanjutkan
        </button>
    </form>
</div>

<!-- Auto-generate slug dari nama menggunakan AlpineJS -->
<script>
    document.addEventListener('alpine:init', () => {
        // Simple script to auto slugify if slug is empty
        const nameInput = document.getElementById('name');
        const slugInput = document.getElementById('slug');
        
        nameInput.addEventListener('input', function() {
            if (document.activeElement === nameInput) {
                let slug = this.value.toLowerCase()
                    .replace(/[^\w\s-]/g, '') // Remove non-word chars
                    .replace(/[\s_-]+/g, '-') // Replace spaces and underscores with dashes
                    .replace(/^-+|-+$/g, ''); // Trim dashes
                slugInput.value = slug;
            }
        });
    });
</script>
@endsection
