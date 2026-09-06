@extends('layouts.app')
@section('title', 'Menu Item')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Manajemen Menu</h1>
        <a href="{{ route('owner.menu-items.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700">Tambah Menu</a>
    </div>

    @if(session('success'))
        <div class="mb-4 bg-green-50 text-green-700 p-4 rounded-lg text-sm border border-green-100">
            {{ session('success') }}
        </div>
    @endif

    @foreach($categories as $category)
        <div class="mb-8">
            <h2 class="text-xl font-bold text-gray-800 mb-4">{{ $category->name }}</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($category->menuItems as $item)
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden flex flex-col">
                        @if($item->photo)
                            <img src="{{ Storage::url($item->photo) }}" alt="{{ $item->name }}" class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-400">
                                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                        @endif
                        
                        <div class="p-4 flex-grow">
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="font-bold text-gray-900">{{ $item->name }}</h3>
                                <span class="font-semibold text-blue-600">Rp {{ number_format($item->price, 0, ',', '.') }}</span>
                            </div>
                            
                            @if($item->labels)
                                <div class="flex gap-1 flex-wrap mb-2">
                                    @foreach($item->labels as $label)
                                        <span class="px-2 py-0.5 bg-blue-50 text-blue-700 text-xs rounded">{{ $label }}</span>
                                    @endforeach
                                </div>
                            @endif
                            
                            <p class="text-sm text-gray-500 line-clamp-2">{{ $item->description }}</p>
                        </div>
                        
                        <div class="px-4 py-3 bg-gray-50 border-t border-gray-100 flex justify-between items-center">
                            <form action="{{ route('owner.menu-items.toggle-stock', $item) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="text-sm font-medium {{ $item->is_available ? 'text-green-600' : 'text-red-600' }}">
                                    {{ $item->is_available ? 'Tersedia' : 'Habis' }}
                                </button>
                            </form>
                            
                            <div class="flex items-center gap-3">
                                <a href="{{ route('owner.menu-items.edit', $item) }}" class="text-gray-500 hover:text-blue-600">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                </a>
                                <form action="{{ route('owner.menu-items.destroy', $item) }}" method="POST" onsubmit="return confirm('Yakin hapus menu ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-gray-500 hover:text-red-600">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            @if($category->menuItems->isEmpty())
                <div class="text-sm text-gray-500 italic">Belum ada menu di kategori ini.</div>
            @endif
        </div>
    @endforeach

</div>
@endsection
