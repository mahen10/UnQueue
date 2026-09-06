@extends('layouts.admin')
@section('title', 'Manajemen Meja')

@section('content')
<div class="py-6 max-w-7xl mx-auto">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
        <h1 class="text-2xl font-bold text-gray-900">Manajemen Meja</h1>
        <div class="flex gap-2">
            <a href="{{ route('admin.tables.export-pdf') }}" class="bg-gray-100 text-gray-700 px-4 py-2 rounded-lg text-sm font-medium hover:bg-gray-200 flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                Export Semua QR
            </a>
            <a href="{{ route('admin.tables.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700">Tambah Meja</a>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-4 bg-green-50 text-green-700 p-4 rounded-lg text-sm border border-green-100">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @forelse($tables as $table)
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden flex flex-col">
            <div class="p-5 flex-grow">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <h3 class="font-bold text-lg text-gray-900">{{ $table->name }}</h3>
                        <p class="text-sm text-gray-500">Nomor: {{ $table->number }}</p>
                    </div>
                    <div>
                        @if($table->isAvailable())
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Tersedia</span>
                        @elseif($table->isOccupied())
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Terisi</span>
                        @else
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">Kotor</span>
                        @endif
                    </div>
                </div>
                
                <div class="bg-gray-50 rounded-lg p-3 flex flex-col items-center justify-center mb-4">
                    <p class="text-xs text-gray-500 mb-2">Token QR: <span class="font-mono font-bold text-gray-800">{{ $table->qr_token }}</span></p>
                    <!-- Ini hanya preview QR sederhana, yang asli ada di PDF -->
                    <div class="bg-white p-2 rounded shadow-sm">
                        {!! \SimpleSoftwareIO\QrCode\Facades\QrCode::size(120)->generate($table->qr_url) !!}
                    </div>
                </div>
            </div>
            
            <div class="bg-gray-50 px-5 py-3 border-t border-gray-100 flex justify-between items-center">
                <a href="{{ route('admin.tables.qr', $table) }}" class="text-sm font-medium text-blue-600 hover:text-blue-800" title="Download QR PDF">
                    Unduh QR
                </a>
                
                <div class="flex items-center gap-3">
                    <a href="{{ route('admin.tables.edit', $table) }}" class="text-gray-500 hover:text-blue-600" title="Edit">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                    </a>
                    
                    <form action="{{ route('admin.tables.regenerate-token', $table) }}" method="POST" onsubmit="return confirm('Yakin ingin reset token QR? QR lama tidak akan bisa dipakai lagi.');">
                        @csrf
                        <button type="submit" class="text-gray-500 hover:text-yellow-600" title="Reset Token QR">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                        </button>
                    </form>

                    <form action="{{ route('admin.tables.destroy', $table) }}" method="POST" onsubmit="return confirm('Yakin hapus meja ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-gray-500 hover:text-red-600" title="Hapus">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full bg-white rounded-xl shadow-sm border border-gray-100 p-8 text-center">
            <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
            <p class="text-gray-500">Belum ada meja. Tambahkan meja pertama Anda.</p>
        </div>
        @endforelse
    </div>
</div>
@endsection
