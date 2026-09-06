@extends('layouts.owner')
@section('title', 'Pengaturan Toko')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-900">Pengaturan Toko</h1>
        <p class="text-sm text-gray-500 mt-1">Kelola profil toko, pajak, dan integrasi pembayaran</p>
    </div>

    @if(session('success'))
        <div class="mb-4 bg-green-50 text-green-700 p-4 rounded-xl border border-green-200">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('owner.settings.update') }}" method="POST" class="space-y-6">
        @csrf
        @method('PATCH')

        {{-- Profil Toko --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                <h3 class="font-bold text-gray-900">Profil Restoran</h3>
            </div>
            <div class="p-6 space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Restoran *</label>
                    <input type="text" name="name" value="{{ old('name', $shop->name) }}" required class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Singkat</label>
                    <textarea name="description" rows="2" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('description', $shop->description) }}</textarea>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon</label>
                        <input type="text" name="phone" value="{{ old('phone', $shop->phone) }}" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                        <textarea name="address" rows="2" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('address', $shop->address) }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        {{-- Biaya Tambahan --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                <h3 class="font-bold text-gray-900">Pajak & Biaya Layanan</h3>
                <p class="text-xs text-gray-500">Biaya ini akan ditambahkan otomatis saat pelanggan checkout.</p>
            </div>
            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Pajak (PB1) (%)</label>
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <input type="number" step="0.01" name="tax_percent" value="{{ old('tax_percent', $shop->tax_percent) }}" required class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <span class="text-gray-500 sm:text-sm">%</span>
                        </div>
                    </div>
                    <p class="text-xs text-gray-500 mt-1">Umumnya 10% atau 11%</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Service Charge (%)</label>
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <input type="number" step="0.01" name="service_charge_percent" value="{{ old('service_charge_percent', $shop->service_charge_percent) }}" required class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <span class="text-gray-500 sm:text-sm">%</span>
                        </div>
                    </div>
                    <p class="text-xs text-gray-500 mt-1">Isi 0 jika tidak ada</p>
                </div>
            </div>
        </div>

        {{-- Integrasi Pembayaran --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 bg-blue-50 flex justify-between items-center">
                <div>
                    <h3 class="font-bold text-gray-900 flex items-center gap-2">
                        💳 Integrasi Pembayaran (Xendit/Midtrans)
                    </h3>
                    <p class="text-xs text-gray-600 mt-1">Dapatkan API Key dari dashboard payment gateway Anda.</p>
                </div>
                @if($shop->xendit_secret_key)
                    <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full border border-green-200">Terhubung</span>
                @else
                    <span class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full border border-red-200">Belum Disetup</span>
                @endif
            </div>
            <div class="p-6 space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Public Key</label>
                    <input type="text" name="xendit_public_key" value="{{ old('xendit_public_key', $shop->xendit_public_key) }}" placeholder="xnd_public_..." class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 font-mono text-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Secret Key</label>
                    <input type="password" name="xendit_secret_key" placeholder="{{ $shop->xendit_secret_key ? '•••••••••••••••••••••••••••• (sudah diatur)' : 'xnd_production_...' }}" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 font-mono text-sm">
                    <p class="text-xs text-gray-500 mt-1">Kosongkan jika tidak ingin mengubah secret key yang sudah ada.</p>
                </div>
            </div>
        </div>

        <div class="flex justify-end pt-4">
            <button type="submit" class="bg-blue-600 text-white px-6 py-2.5 rounded-lg hover:bg-blue-700 font-medium">
                Simpan Pengaturan
            </button>
        </div>
    </form>
</div>
@endsection
