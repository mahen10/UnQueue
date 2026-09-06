@extends('layouts.app')
@section('title', 'Manajemen Restoran')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Manajemen Restoran</h1>
            <p class="text-sm text-gray-500 mt-1">Daftar semua restoran (tenant) di platform UnQueue.</p>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-4 bg-green-50 text-green-700 p-4 rounded-xl border border-green-200">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 mb-6">
        <form method="GET" action="{{ route('superadmin.tenants.index') }}" class="flex gap-4">
            <input type="text" name="search" value="{{ $search }}" placeholder="Cari nama restoran atau nomor HP owner..." class="flex-grow border-gray-300 rounded-lg text-sm shadow-sm focus:ring-blue-500 focus:border-blue-500">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 text-sm font-medium">
                Cari
            </button>
            <a href="{{ route('superadmin.tenants.index') }}" class="px-4 py-2 text-sm text-gray-500 hover:underline flex items-center">Reset</a>
        </form>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Restoran</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Owner / Kontak</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status Langganan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Override Akses</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($shops as $shop)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <div class="text-sm font-bold text-gray-900">{{ $shop->name }}</div>
                            <div class="text-xs text-gray-500">Terdaftar: {{ $shop->created_at->format('d M Y') }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900">{{ $shop->owner->name ?? '-' }}</div>
                            <div class="text-xs text-gray-500">{{ $shop->owner->phone ?? '-' }}</div>
                        </td>
                        <td class="px-6 py-4">
                            @if($shop->subscription_end_date && $shop->subscription_end_date->isFuture())
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Aktif s.d {{ $shop->subscription_end_date->format('d M Y') }}</span>
                            @else
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Kedaluwarsa / Belum Aktif</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <form action="{{ route('superadmin.tenants.override', $shop) }}" method="POST" class="flex gap-2">
                                @csrf
                                @method('PATCH')
                                <select name="override_status" onchange="this.form.submit()" class="text-xs border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 py-1 pl-2 pr-8">
                                    <option value="null" {{ $shop->subscription_override === null ? 'selected' : '' }}>Otomatis (Sesuai Tanggal)</option>
                                    <option value="active" {{ $shop->subscription_override === 'active' ? 'selected' : '' }}>🟢 Paksa Aktif</option>
                                    <option value="suspended" {{ $shop->subscription_override === 'suspended' ? 'selected' : '' }}>🔴 Suspend / Blokir</option>
                                </select>
                            </form>
                        </td>
                        <td class="px-6 py-4 text-right text-sm font-medium">
                            <a href="{{ route('superadmin.tenants.show', $shop) }}" class="text-blue-600 hover:text-blue-900">Detail</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-gray-500 text-sm">
                            Tidak ada restoran yang ditemukan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $shops->links() }}
        </div>
    </div>
</div>
@endsection
