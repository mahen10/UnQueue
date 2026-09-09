@extends('layouts.superadmin')
@section('title', 'Manajemen Pengguna - CORE')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex justify-between items-end mb-8">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Manajemen Pengguna Global</h1>
            <p class="text-sm text-slate-500 mt-1">Kelola seluruh akun (Owner, Manajer, Kasir, Dapur) dari satu tempat.</p>
        </div>
        <div class="flex items-center gap-2">
             <span class="px-3 py-1 bg-slate-100 text-slate-700 text-xs font-semibold rounded-lg border border-slate-200">
                Total: {{ $users->total() }} Akun
            </span>
        </div>
    </div>

    <!-- Toolbar Pencarian -->
    <div class="bg-white p-5 rounded-2xl shadow-sm border border-slate-200/60 mb-6 flex flex-col sm:flex-row gap-4">
        <form method="GET" action="{{ route('superadmin.users.index') }}" class="flex-grow flex gap-3">
            <div class="relative flex-grow">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-slate-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" /></svg>
                </div>
                <input type="text" name="search" value="{{ $search }}" placeholder="Cari nama, email, nomor HP, atau UQ-ID..." class="block w-full pl-10 pr-3 py-2.5 border border-slate-200 rounded-xl leading-5 bg-slate-50 text-slate-900 placeholder-slate-400 focus:outline-none focus:bg-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition-all">
            </div>
            <button type="submit" class="bg-slate-900 text-white px-5 py-2.5 rounded-xl hover:bg-slate-800 text-sm font-semibold transition-colors shadow-sm">
                Cari Akun
            </button>
            @if($search)
                <a href="{{ route('superadmin.users.index') }}" class="px-4 py-2.5 text-sm font-medium text-slate-600 bg-slate-100 rounded-xl hover:bg-slate-200 transition-colors flex items-center">Reset</a>
            @endif
        </form>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200/60 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200">
                <thead class="bg-slate-50/80">
                    <tr>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Profil / Identitas</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Informasi Kontak</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Afiliasi Restoran</th>
                        <th scope="col" class="px-6 py-4 text-center text-xs font-semibold text-slate-500 uppercase tracking-wider">Status</th>
                        <th scope="col" class="px-6 py-4 text-right text-xs font-semibold text-slate-500 uppercase tracking-wider">Aksi Keamanan</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-slate-100">
                    @forelse($users as $user)
                    <tr class="hover:bg-slate-50/50 transition-colors group {{ $user->is_banned ? 'bg-red-50/50 hover:bg-red-50' : '' }}">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full {{ $user->is_super_admin ? 'bg-gradient-to-tr from-indigo-600 to-purple-600 text-white' : 'bg-slate-100 text-slate-600' }} flex items-center justify-center font-bold text-sm shadow-inner shrink-0 relative">
                                    {{ substr($user->name, 0, 1) }}
                                    @if($user->is_super_admin)
                                        <div class="absolute -top-1 -right-1 w-3.5 h-3.5 bg-yellow-400 border-2 border-white rounded-full" title="Super Admin"></div>
                                    @endif
                                </div>
                                <div>
                                    <div class="text-sm font-bold {{ $user->is_super_admin ? 'text-indigo-700' : 'text-slate-900' }} flex items-center gap-2">
                                        {{ $user->name }}
                                        @if($user->is_super_admin)
                                            <span class="px-1.5 py-0.5 rounded text-[9px] font-bold tracking-widest bg-indigo-100 text-indigo-700 uppercase">SA</span>
                                        @endif
                                    </div>
                                    <div class="text-xs text-slate-500 mt-0.5 font-mono bg-slate-100 px-1.5 py-0.5 rounded inline-block">ID: {{ $user->uq_id }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-slate-900 flex items-center gap-1.5">
                                <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                                {{ $user->email ?? 'Belum ada email' }}
                            </div>
                            <div class="text-xs text-slate-500 mt-1 flex items-center gap-1.5">
                                <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" /></svg>
                                {{ $user->phone ?? 'Belum ada HP' }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($user->is_super_admin)
                                <span class="text-sm font-medium text-indigo-600">Administrator Sistem</span>
                            @elseif($user->activeShop())
                                <div class="text-sm font-medium text-slate-900">{{ $user->activeShop()->name }}</div>
                                <div class="text-xs font-semibold text-indigo-600 mt-0.5 uppercase tracking-wider">{{ $user->activeShop()->pivot->role ?? 'Owner' }}</div>
                            @else
                                <span class="text-sm text-slate-500 italic">User Gratis / Belum ada afiliasi</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            @if($user->is_banned)
                                <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-semibold bg-rose-100 text-rose-800 border border-rose-200">
                                    <svg class="w-3 h-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                                    Terblokir
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                    <svg class="w-3 h-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                    Aman
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex justify-end gap-2">
                                <form action="{{ route('superadmin.users.reset-password', $user) }}" method="POST" onsubmit="return confirm('Reset sandi akun ini ke: 12345678?')">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="p-2 bg-slate-100 text-slate-600 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-colors tooltip-btn" title="Reset Sandi">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" /></svg>
                                    </button>
                                </form>
                                
                                @if(!$user->is_super_admin)
                                    @if($user->is_banned)
                                        <form action="{{ route('superadmin.users.unban', $user) }}" method="POST" onsubmit="return confirm('Buka blokir akun ini?')">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="p-2 bg-emerald-50 border border-emerald-200 text-emerald-600 hover:text-emerald-700 hover:bg-emerald-100 rounded-lg transition-colors" title="Buka Blokir">
                                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z" /></svg>
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{ route('superadmin.users.ban', $user) }}" method="POST" onsubmit="return confirm('Peringatan: Memblokir akun ini akan memutus akses ke semua toko yang dipegangnya. Lanjutkan?')">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="p-2 bg-rose-50 border border-rose-200 text-rose-600 hover:text-rose-700 hover:bg-rose-100 rounded-lg transition-colors" title="Blokir (Banned)">
                                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" /></svg>
                                            </button>
                                        </form>
                                    @endif
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-16 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mb-3">
                                    <svg class="w-8 h-8 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                                </div>
                                <p class="text-slate-500 font-medium">Pencarian tidak menemukan akun pengguna.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($users->hasPages())
        <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/50">
            {{ $users->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
