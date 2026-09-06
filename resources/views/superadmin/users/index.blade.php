@extends('layouts.app')
@section('title', 'Manajemen Pengguna')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-900">Manajemen Pengguna</h1>
        <p class="text-sm text-gray-500 mt-1">Kelola semua akun pengguna terdaftar (owner, kasir, pelayan, dll).</p>
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

    <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 mb-6">
        <form method="GET" action="{{ route('superadmin.users.index') }}" class="flex gap-4">
            <input type="text" name="search" value="{{ $search }}" placeholder="Cari nama atau nomor HP..." class="flex-grow border-gray-300 rounded-lg text-sm shadow-sm focus:ring-blue-500 focus:border-blue-500">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 text-sm font-medium">
                Cari
            </button>
            <a href="{{ route('superadmin.users.index') }}" class="px-4 py-2 text-sm text-gray-500 hover:underline flex items-center">Reset</a>
        </form>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama / UQ-ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kontak</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role Terakhir</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($users as $user)
                    <tr class="hover:bg-gray-50 {{ $user->is_banned ? 'bg-red-50' : '' }}">
                        <td class="px-6 py-4">
                            <div class="text-sm font-bold text-gray-900 flex items-center gap-2">
                                {{ $user->name }}
                                @if($user->is_super_admin)
                                    <span class="bg-purple-100 text-purple-800 text-[10px] px-2 py-0.5 rounded-full uppercase font-bold">Super Admin</span>
                                @endif
                            </div>
                            <div class="text-xs text-gray-500 font-mono">{{ $user->uq_id }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900">{{ $user->phone }}</div>
                            <div class="text-xs text-gray-500">{{ $user->email ?? '-' }}</div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500">
                            {{ $user->getRoleNames()->first() ?? 'Belum ada role' }}
                        </td>
                        <td class="px-6 py-4">
                            @if($user->is_banned)
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Diblokir</span>
                            @else
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Aktif</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right text-sm font-medium">
                            <div class="flex justify-end gap-2">
                                <form action="{{ route('superadmin.users.reset-password', $user) }}" method="POST" onsubmit="return confirm('Reset password user ini menjadi 12345678?')">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="text-blue-600 hover:text-blue-900">Reset Pass</button>
                                </form>
                                <span class="text-gray-300">|</span>
                                @if($user->is_banned)
                                    <form action="{{ route('superadmin.users.unban', $user) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="text-green-600 hover:text-green-900">Buka Blokir</button>
                                    </form>
                                @else
                                    <form action="{{ route('superadmin.users.ban', $user) }}" method="POST" onsubmit="return confirm('Yakin ingin memblokir user ini?')">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="text-red-600 hover:text-red-900">Blokir</button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-gray-500 text-sm">
                            Tidak ada pengguna yang ditemukan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection
