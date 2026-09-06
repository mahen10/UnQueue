@extends('layouts.app')
@section('title', 'Menu Item')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Manajemen Menu</h1>
            <p class="mt-1 text-sm text-gray-500">Kelola semua hidangan dan minuman restoran Anda.</p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('owner.categories.index') }}" class="bg-white text-gray-700 px-4 py-2 rounded-xl text-sm font-semibold hover:bg-gray-50 border border-gray-200 transition shadow-sm">Atur Kategori</a>
            <a href="{{ route('owner.menu-items.create') }}" class="bg-orange-500 text-white px-5 py-2 rounded-xl text-sm font-bold hover:bg-orange-600 transition hover:-translate-y-0.5 shadow-md hover:shadow-lg flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
                Tambah Menu
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-6 bg-green-50 text-green-700 p-4 rounded-xl text-sm border border-green-200 shadow-sm flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            {{ session('success') }}
        </div>
    @endif

    @forelse($categories as $category)
        <div class="mb-10">
            <div class="flex items-center gap-3 mb-5 border-b border-gray-200 pb-3">
                <h2 class="text-xl font-bold text-gray-800">{{ $category->name }}</h2>
                <span class="bg-gray-100 text-gray-600 text-xs px-2.5 py-0.5 rounded-full font-medium">{{ $category->menuItems->count() }} item</span>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($category->menuItems as $item)
                    <div class="bg-white rounded-2xl shadow-sm hover:shadow-xl border border-gray-100 overflow-hidden flex flex-col transition-all duration-300 group hover:-translate-y-1">
                        <div class="relative overflow-hidden">
                            @if($item->photo)
                                <img src="{{ Storage::url($item->photo) }}" alt="{{ $item->name }}" class="w-full h-48 object-cover transition-transform duration-500 group-hover:scale-105">
                            @else
                                <div class="w-full h-48 bg-orange-50 flex items-center justify-center text-orange-200 transition-transform duration-500 group-hover:scale-105">
                                    <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                            @endif
                            <div class="absolute top-3 right-3">
                                <form action="{{ route('owner.menu-items.toggle-stock', $item) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="text-xs font-bold px-3 py-1 rounded-full shadow-sm backdrop-blur-sm transition-colors
                                        {{ $item->is_available ? 'bg-green-500/90 text-white hover:bg-green-600' : 'bg-red-500/90 text-white hover:bg-red-600' }}">
                                        {{ $item->is_available ? 'Tersedia' : 'Habis' }}
                                    </button>
                                </form>
                            </div>
                        </div>
                        
                        <div class="p-5 flex-grow">
                            <div class="flex justify-between items-start mb-2 gap-2">
                                <h3 class="font-bold text-gray-900 leading-tight group-hover:text-orange-600 transition-colors">{{ $item->name }}</h3>
                                <span class="font-extrabold text-orange-600 whitespace-nowrap">Rp {{ number_format($item->price, 0, ',', '.') }}</span>
                            </div>
                            
                            @if($item->description)
                                <p class="text-sm text-gray-500 line-clamp-2 mt-1">{{ $item->description }}</p>
                            @endif
                            
                            @if($item->labels)
                                <div class="flex gap-1 flex-wrap mt-3">
                                    @foreach($item->labels as $label)
                                        <span class="px-2 py-0.5 bg-orange-50 text-orange-700 text-[10px] font-bold uppercase tracking-wider rounded-md">{{ $label }}</span>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                        
                        <div class="px-5 py-4 bg-gray-50/80 border-t border-gray-100 flex justify-between items-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <span class="text-xs text-gray-400 font-medium">Aksi Cepat</span>
                            <div class="flex items-center gap-2">
                                <a href="{{ route('owner.menu-items.edit', $item) }}" class="p-2 bg-white rounded-lg text-gray-500 hover:text-blue-600 shadow-sm hover:shadow transition border border-gray-200">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                </a>
                                <form action="{{ route('owner.menu-items.destroy', $item) }}" method="POST" onsubmit="return confirm('Yakin hapus menu ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 bg-white rounded-lg text-gray-500 hover:text-red-600 shadow-sm hover:shadow transition border border-gray-200">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            @if($category->menuItems->isEmpty())
                <div class="bg-white rounded-xl border border-dashed border-gray-300 p-8 text-center text-sm text-gray-500 mb-4">
                    <p class="mb-2">Belum ada menu di kategori ini.</p>
                    <a href="{{ route('owner.menu-items.create', ['category_id' => $category->id]) }}" class="text-orange-600 font-bold hover:underline">+ Tambah Menu Pertama</a>
                </div>
            @endif
        </div>
    @empty
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-12 text-center max-w-lg mx-auto mt-12">
            <div class="w-20 h-20 bg-orange-100 text-orange-500 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path></svg>
            </div>
            <h2 class="text-xl font-bold text-gray-900 mb-2">Restoran Anda masih kosong!</h2>
            <p class="text-gray-500 mb-6 text-sm">Mari mulai dengan membuat kategori menu terlebih dahulu, seperti "Makanan Utama" atau "Minuman".</p>
            <a href="{{ route('owner.categories.create') }}" class="inline-flex items-center gap-2 bg-orange-500 text-white px-6 py-3 rounded-xl font-bold hover:bg-orange-600 transition hover:-translate-y-0.5 shadow-md">
                Buat Kategori Pertama
            </a>
        </div>
    @endforelse
</div>
@endsection
