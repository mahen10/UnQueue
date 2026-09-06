@extends('layouts.owner')
@section('title', 'Manajemen Karyawan')

@section('content')
<div class="py-6 max-w-7xl mx-auto">
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-900">Manajemen Karyawan</h1>
        <p class="text-sm text-gray-500 mt-1">Tambahkan kasir, pelayan, atau staf dapur ke restoran Anda.</p>
    </div>

    @if(session('success'))
        <div class="mb-4 bg-green-50 text-green-700 p-4 rounded-xl border border-green-200">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="mb-4 bg-red-50 text-red-700 p-4 rounded-xl border border-red-200">
            {{ session('error') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Form Tambah Karyawan --}}
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="font-bold text-gray-900 mb-4">Tambah Karyawan Baru</h3>
                <p class="text-xs text-gray-500 mb-4">Pastikan karyawan sudah mengunduh/mendaftar aplikasi UnQueue terlebih dahulu.</p>

                <form action="{{ route('owner.staff.invite') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">UQ-ID atau Nomor HP</label>
                        <input type="text" name="contact" required placeholder="Contoh: UQ-123456 atau 08123..." class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm">
                        <p class="text-[11px] text-gray-400 mt-1">Karyawan dapat melihat UQ-ID di halaman profil mereka.</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Pilih Posisi / Role</label>
                        <select name="role" required class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm">
                            <option value="admin">Admin Resto (Manajemen Menu & Meja)</option>
                            <option value="kasir">Kasir (POS & Pembayaran)</option>
                            <option value="kitchen">Dapur (Kitchen Display System)</option>
                            <option value="waiter">Pelayan (Order Taker & Pengantar)</option>
                        </select>
                    </div>
                    <button type="submit" class="w-full bg-blue-600 text-white font-medium py-2 rounded-lg hover:bg-blue-700 transition">
                        Tambahkan Karyawan
                    </button>
                </form>
            </div>
        </div>

        {{-- Daftar Karyawan --}}
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                    <h3 class="font-bold text-gray-900">Daftar Karyawan Aktif</h3>
                </div>
                <div class="divide-y divide-gray-100">
                    @forelse($staffs as $staff)
                    <div class="px-6 py-4 flex justify-between items-center hover:bg-gray-50">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-bold">
                                {{ strtoupper(substr($staff->user->name, 0, 1)) }}
                            </div>
                            <div>
                                <p class="font-medium text-gray-900">{{ $staff->user->name }}</p>
                                <p class="text-xs text-gray-500">{{ $staff->user->phone }} • {{ $staff->user->uq_id }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4">
                            <span class="px-2.5 py-1 text-xs font-semibold rounded-full 
                                {{ match($staff->role) {
                                    'admin' => 'bg-teal-100 text-teal-800',
                                    'kasir' => 'bg-green-100 text-green-800',
                                    'kitchen' => 'bg-orange-100 text-orange-800',
                                    'waiter' => 'bg-purple-100 text-purple-800',
                                    default => 'bg-gray-100 text-gray-800'
                                } }}">
                                {{ ucfirst($staff->role) }}
                            </span>
                            <form action="{{ route('owner.staff.remove', $staff) }}" method="POST" onsubmit="return confirm('Hapus karyawan ini dari restoran?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 text-sm font-medium">Hapus</button>
                            </form>
                        </div>
                    </div>
                    @empty
                    <div class="px-6 py-12 text-center text-gray-500">
                        <p class="text-4xl mb-3">👥</p>
                        <p class="text-sm font-medium">Belum ada karyawan yang ditambahkan.</p>
                        <p class="text-xs mt-1">Gunakan form di samping untuk mulai merekrut tim Anda.</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
