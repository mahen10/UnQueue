@extends('layouts.staff')
@section('title', 'Riwayat Transaksi')
@section('header_title', 'Riwayat Transaksi')

@section('header_actions')
    <a href="{{ route('kasir.pos') }}" class="inline-flex items-center gap-2 px-3 py-1.5 text-xs font-semibold bg-slate-100 text-slate-700 border border-slate-200 rounded-lg hover:bg-slate-200 transition-colors">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        Kembali ke POS
    </a>
@endsection

@section('content')
<div class="max-w-6xl mx-auto w-full space-y-5">

    @if(session('success'))
    <div class="flex items-center gap-3 bg-emerald-50 text-emerald-800 border border-emerald-200 px-4 py-3 rounded-xl text-sm font-medium">
        <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        {{ session('success') }}
    </div>
    @endif

    {{-- Stats Cards --}}
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
        <div class="bg-white rounded-2xl p-4 shadow-sm border border-slate-200/60">
            <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">Total Order</p>
            <p class="text-2xl font-black text-slate-800">{{ $stats->total_orders ?? 0 }}</p>
        </div>
        <div class="bg-white rounded-2xl p-4 shadow-sm border border-slate-200/60">
            <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">Pendapatan</p>
            <p class="text-xl font-black text-emerald-600 truncate">Rp {{ number_format($stats->total_revenue ?? 0, 0, ',', '.') }}</p>
        </div>
        <div class="bg-white rounded-2xl p-4 shadow-sm border border-slate-200/60">
            <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">Selesai</p>
            <p class="text-2xl font-black text-indigo-600">{{ $stats->delivered_count ?? 0 }}</p>
        </div>
        <div class="bg-white rounded-2xl p-4 shadow-sm border border-slate-200/60">
            <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">Dibatalkan</p>
            <p class="text-2xl font-black text-rose-600">{{ $stats->cancelled_count ?? 0 }}</p>
        </div>
    </div>

    {{-- Filter --}}
    <form method="GET" action="{{ route('kasir.transactions.index') }}" class="bg-white rounded-2xl p-4 shadow-sm border border-slate-200/60 flex flex-col sm:flex-row gap-3 items-end">
        <div class="flex-1">
            <label class="block text-xs font-bold text-slate-600 mb-1.5 uppercase tracking-wider">Tanggal</label>
            <input type="date" name="date" value="{{ $filterDate }}"
                class="w-full rounded-xl border border-slate-200 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 font-medium">
        </div>
        <div class="flex-1">
            <label class="block text-xs font-bold text-slate-600 mb-1.5 uppercase tracking-wider">Status</label>
            <select name="status" class="w-full rounded-xl border border-slate-200 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 font-medium bg-white">
                <option value="">Semua Status</option>
                <option value="pending"    {{ $filterStatus === 'pending'    ? 'selected' : '' }}>Pending</option>
                <option value="paid"       {{ $filterStatus === 'paid'       ? 'selected' : '' }}>Dibayar</option>
                <option value="processing" {{ $filterStatus === 'processing' ? 'selected' : '' }}>Diproses</option>
                <option value="ready"      {{ $filterStatus === 'ready'      ? 'selected' : '' }}>Siap Antar</option>
                <option value="delivered"  {{ $filterStatus === 'delivered'  ? 'selected' : '' }}>Selesai</option>
                <option value="cancelled"  {{ $filterStatus === 'cancelled'  ? 'selected' : '' }}>Dibatalkan</option>
            </select>
        </div>
        <button type="submit" class="px-5 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-sm font-bold transition-colors shadow-sm">
            Filter
        </button>
        <a href="{{ route('kasir.transactions.index') }}" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-xl text-sm font-semibold transition-colors">
            Reset
        </a>
    </form>

    {{-- Table --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200/60 overflow-hidden">
        <div class="px-5 py-4 border-b border-slate-100 flex items-center justify-between">
            <h3 class="font-bold text-slate-900">
                Transaksi — <span class="text-indigo-600">{{ \Carbon\Carbon::parse($filterDate)->translatedFormat('d F Y') }}</span>
            </h3>
            <span class="text-xs text-slate-500 font-medium">{{ $orders->total() }} transaksi</span>
        </div>

        {{-- Desktop table --}}
        <div class="hidden sm:block overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-100 text-left">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-5 py-3 text-xs font-bold text-slate-500 uppercase tracking-wider">Order</th>
                        <th class="px-4 py-3 text-xs font-bold text-slate-500 uppercase tracking-wider">Meja</th>
                        <th class="px-4 py-3 text-xs font-bold text-slate-500 uppercase tracking-wider">Item</th>
                        <th class="px-4 py-3 text-xs font-bold text-slate-500 uppercase tracking-wider">Waktu</th>
                        <th class="px-4 py-3 text-xs font-bold text-slate-500 uppercase tracking-wider">Status</th>
                        <th class="px-5 py-3 text-right text-xs font-bold text-slate-500 uppercase tracking-wider">Total</th>
                        <th class="px-4 py-3 text-xs font-bold text-slate-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($orders as $order)
                    <tr class="hover:bg-slate-50/60 transition-colors {{ $order->status === 'cancelled' ? 'opacity-60' : '' }}">
                        <td class="px-5 py-3.5 whitespace-nowrap">
                            <div class="flex items-center gap-2.5">
                                <div class="w-8 h-8 rounded-xl bg-indigo-100 text-indigo-700 flex items-center justify-center text-xs font-extrabold shrink-0">
                                    {{ substr($order->order_number, -2) }}
                                </div>
                                <div>
                                    <p class="font-bold text-slate-900 text-sm">#{{ $order->order_number }}</p>
                                    @if($order->type === 'manual')
                                    <span class="text-[10px] bg-amber-100 text-amber-700 font-bold px-1.5 py-0.5 rounded">Manual</span>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-3.5 whitespace-nowrap text-sm font-medium text-slate-700">
                            {{ $order->table->name ?? 'Takeaway' }}
                        </td>
                        <td class="px-4 py-3.5">
                            <div class="text-xs text-slate-600 space-y-0.5 max-w-[180px]">
                                @foreach($order->items->take(2) as $item)
                                <div>{{ $item->quantity }}x {{ Str::limit($item->item_name, 22) }}</div>
                                @endforeach
                                @if($order->items->count() > 2)
                                <div class="text-indigo-500 font-semibold">+{{ $order->items->count() - 2 }} lainnya</div>
                                @endif
                            </div>
                        </td>
                        <td class="px-4 py-3.5 whitespace-nowrap text-sm text-slate-500">
                            {{ $order->created_at->format('H:i') }}
                        </td>
                        <td class="px-4 py-3.5 whitespace-nowrap">
                            @php
                                $statusMap = [
                                    'pending'    => ['bg-yellow-100 text-yellow-700', 'Pending'],
                                    'paid'       => ['bg-indigo-100 text-indigo-700', 'Dibayar'],
                                    'processing' => ['bg-amber-100 text-amber-700', 'Diproses'],
                                    'ready'      => ['bg-blue-100 text-blue-700', 'Siap Antar'],
                                    'delivered'  => ['bg-emerald-100 text-emerald-700', 'Selesai'],
                                    'cancelled'  => ['bg-rose-100 text-rose-700', 'Batal'],
                                ];
                                [$cls, $label] = $statusMap[$order->status] ?? ['bg-slate-100 text-slate-600', $order->status];
                            @endphp
                            <span class="px-2.5 py-1 rounded-full text-xs font-bold {{ $cls }}">{{ $label }}</span>
                        </td>
                        <td class="px-5 py-3.5 whitespace-nowrap text-right text-sm font-extrabold text-slate-900">
                            Rp {{ number_format($order->total, 0, ',', '.') }}
                        </td>
                        <td class="px-4 py-3.5 whitespace-nowrap">
                            @if(in_array($order->status, ['pending', 'paid']))
                            <form method="POST" action="{{ route('kasir.transactions.void', $order) }}" onsubmit="return confirm('Void order #{{ $order->order_number }}?')">
                                @csrf
                                <button type="submit" class="text-xs px-2.5 py-1.5 bg-rose-50 hover:bg-rose-100 text-rose-700 rounded-lg font-bold border border-rose-100 transition-colors">Void</button>
                            </form>
                            @elseif($order->status === 'delivered')
                            <form method="POST" action="{{ route('kasir.transactions.refund', $order) }}" onsubmit="return confirm('Refund order #{{ $order->order_number }}?')">
                                @csrf
                                <button type="submit" class="text-xs px-2.5 py-1.5 bg-slate-50 hover:bg-slate-100 text-slate-600 rounded-lg font-bold border border-slate-100 transition-colors">Refund</button>
                            </form>
                            @else
                            <span class="text-slate-300 text-xs">—</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center text-slate-400 text-sm">Tidak ada transaksi untuk tanggal ini.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Mobile card list --}}
        <div class="sm:hidden divide-y divide-slate-100">
            @forelse($orders as $order)
            <div class="p-4 {{ $order->status === 'cancelled' ? 'opacity-60' : '' }}">
                <div class="flex items-start justify-between gap-3">
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center gap-2 flex-wrap mb-1">
                            <span class="font-bold text-slate-900 text-sm">#{{ $order->order_number }}</span>
                            @php [$cls, $label] = $statusMap[$order->status] ?? ['bg-slate-100 text-slate-600', $order->status]; @endphp
                            <span class="px-2 py-0.5 rounded-full text-xs font-bold {{ $cls }}">{{ $label }}</span>
                            @if($order->type === 'manual')
                            <span class="text-[10px] bg-amber-100 text-amber-700 font-bold px-1.5 py-0.5 rounded">Manual</span>
                            @endif
                        </div>
                        <p class="text-xs text-slate-500 mb-1.5">{{ $order->table->name ?? 'Takeaway' }} • {{ $order->created_at->format('H:i') }}</p>
                        <div class="text-xs text-slate-600">
                            @foreach($order->items->take(2) as $item)
                            <div>{{ $item->quantity }}x {{ Str::limit($item->item_name, 25) }}</div>
                            @endforeach
                        </div>
                    </div>
                    <div class="text-right shrink-0">
                        <p class="font-extrabold text-slate-900 text-sm">Rp {{ number_format($order->total, 0, ',', '.') }}</p>
                        @if(in_array($order->status, ['pending', 'paid']))
                        <form method="POST" action="{{ route('kasir.transactions.void', $order) }}" onsubmit="return confirm('Void?')" class="mt-1.5">
                            @csrf
                            <button type="submit" class="text-xs px-2.5 py-1 bg-rose-50 text-rose-700 rounded-lg font-bold border border-rose-100">Void</button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
            @empty
            <div class="py-12 text-center text-slate-400 text-sm">Tidak ada transaksi.</div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if($orders->hasPages())
        <div class="px-5 py-4 border-t border-slate-100">
            {{ $orders->links() }}
        </div>
        @endif
    </div>

</div>
@endsection
