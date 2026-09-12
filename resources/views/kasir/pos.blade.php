@extends('layouts.staff')
@section('title', 'POS Kasir - ' . $shop->name)
@section('header_title', 'POS Kasir')

@section('header_actions')
    <a href="#" class="hidden sm:inline-flex items-center gap-2 px-3 py-1.5 text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200 rounded-lg shadow-sm hover:bg-emerald-100 transition-colors">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
        Order Manual
    </a>
    <a href="{{ route('kasir.transactions.index') }}" class="hidden sm:inline-flex items-center gap-2 px-3 py-1.5 text-xs font-semibold bg-slate-100 text-slate-700 border border-slate-200 rounded-lg shadow-sm hover:bg-slate-200 transition-colors">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
        Riwayat Transaksi
    </a>
@endsection

@section('content')
<div class="max-w-7xl mx-auto w-full">

    {{-- Stats Hari Ini --}}
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-6">
        <div class="bg-white rounded-2xl p-5 shadow-sm border border-slate-200/60 relative overflow-hidden group hover:border-indigo-200 transition-colors">
            <div class="absolute right-0 top-0 p-4 opacity-5 group-hover:scale-110 transition-transform">
                <svg class="w-16 h-16" fill="currentColor" viewBox="0 0 24 24"><path d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">Pendapatan Hari Ini</p>
            <p class="text-2xl font-black text-emerald-600 tracking-tight">Rp {{ number_format($todayRevenue, 0, ',', '.') }}</p>
        </div>
        <div class="bg-white rounded-2xl p-5 shadow-sm border border-slate-200/60 relative overflow-hidden group hover:border-indigo-200 transition-colors">
            <div class="absolute right-0 top-0 p-4 opacity-5 group-hover:scale-110 transition-transform">
                <svg class="w-16 h-16" fill="currentColor" viewBox="0 0 24 24"><path d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            </div>
            <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">Total Pesanan</p>
            <p class="text-2xl font-black text-indigo-600 tracking-tight">{{ $todayOrderCount }}</p>
        </div>
        <div class="bg-white rounded-2xl p-5 shadow-sm border border-slate-200/60 relative overflow-hidden group hover:border-indigo-200 transition-colors">
            <div class="absolute right-0 top-0 p-4 opacity-5 group-hover:scale-110 transition-transform">
                <svg class="w-16 h-16" fill="currentColor" viewBox="0 0 24 24"><path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">Aktif Sekarang</p>
            <p class="text-2xl font-black text-amber-600 tracking-tight">{{ $activeOrders->count() }}</p>
        </div>
        <div class="bg-white rounded-2xl p-5 shadow-sm border border-slate-200/60 relative overflow-hidden group hover:border-indigo-200 transition-colors">
            <div class="absolute right-0 top-0 p-4 opacity-5 group-hover:scale-110 transition-transform">
                <svg class="w-16 h-16" fill="currentColor" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7"/></svg>
            </div>
            <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">Siap Diantar</p>
            <p class="text-2xl font-black text-rose-600 tracking-tight">{{ $activeOrders->where('status', 'ready')->count() }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">

        {{-- Panel Kiri: Order Aktif (Lebih besar) --}}
        <div class="lg:col-span-7 space-y-4">
            <div class="flex items-center justify-between">
                <h2 class="text-lg font-bold text-slate-900 flex items-center gap-2">
                    <svg class="w-5 h-5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                    Daftar Order Aktif
                </h2>
                <span class="text-xs font-medium text-slate-500 bg-slate-200 px-2.5 py-1 rounded-md">Auto-refresh 15s</span>
            </div>

            @if($activeOrders->isEmpty())
                <div class="bg-white rounded-2xl p-12 text-center shadow-sm border border-slate-200/60 flex flex-col items-center justify-center">
                    <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-10 h-10 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/></svg>
                    </div>
                    <p class="text-slate-600 font-bold text-lg">Tidak ada pesanan aktif</p>
                    <p class="text-slate-400 text-sm mt-1">Pesanan baru akan muncul di sini secara otomatis.</p>
                </div>
            @else
                <div class="space-y-4">
                    @foreach($activeOrders as $order)
                    <div class="bg-white rounded-2xl shadow-sm border border-slate-200/60 overflow-hidden relative group">
                        <!-- Left colored bar -->
                        <div class="absolute left-0 top-0 bottom-0 w-1.5 
                            {{ $order->status === 'paid' ? 'bg-indigo-500' : ($order->status === 'processing' ? 'bg-amber-500' : 'bg-emerald-500') }}">
                        </div>
                        
                        <div class="p-5 pl-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                            <div class="flex-grow w-full">
                                <div class="flex items-center justify-between sm:justify-start gap-3 mb-2">
                                    <div class="flex items-center gap-2">
                                        <p class="font-black text-slate-900 text-lg">#{{ $order->order_number }}</p>
                                        <span class="text-xs px-2.5 py-1 rounded-md font-bold tracking-wide uppercase
                                            {{ $order->status === 'paid' ? 'bg-indigo-50 text-indigo-700 border border-indigo-200' : 
                                              ($order->status === 'processing' ? 'bg-amber-50 text-amber-700 border border-amber-200' : 
                                               'bg-emerald-50 text-emerald-700 border border-emerald-200') }}">
                                            {{ $order->status === 'paid' ? 'Antre Dapur' : ($order->status === 'processing' ? 'Sedang Dimasak' : 'Siap Diantar') }}
                                        </span>
                                    </div>
                                </div>
                                <div class="flex items-center gap-3 text-xs font-semibold text-slate-500 mb-4">
                                    <span class="flex items-center gap-1"><svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg> {{ $order->table->name }}</span>
                                    <span>•</span>
                                    <span class="flex items-center gap-1"><svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg> {{ $order->created_at->diffForHumans() }}</span>
                                </div>

                                <div class="bg-slate-50 rounded-xl p-3 border border-slate-100">
                                    <div class="text-sm text-slate-700 font-medium space-y-1.5">
                                        @foreach($order->items->take(3) as $item)
                                        <div class="flex items-start gap-2">
                                            <span class="bg-slate-200 text-slate-700 text-[10px] font-bold px-1.5 py-0.5 rounded">{{ $item->quantity }}x</span>
                                            <span class="leading-tight">{{ $item->item_name }}</span>
                                        </div>
                                        @endforeach
                                        @if($order->items->count() > 3)
                                        <p class="text-indigo-600 text-xs font-bold mt-2 hover:underline cursor-pointer">Lihat {{ $order->items->count() - 3 }} item lainnya...</p>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="flex sm:flex-col items-center sm:items-end justify-between w-full sm:w-auto gap-3">
                                <div class="text-left sm:text-right">
                                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-0.5">Total Bayar</p>
                                    <p class="font-black text-slate-900 text-xl tracking-tight">Rp {{ number_format($order->total, 0, ',', '.') }}</p>
                                </div>
                                @if($order->status === 'ready')
                                <button onclick="markDelivered({{ $order->id }}, this)"
                                    class="text-sm bg-emerald-600 text-white px-5 py-2.5 rounded-xl hover:bg-emerald-700 font-bold transition-all shadow-sm hover:shadow flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    Tandai Diantar
                                </button>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- Panel Kanan: Riwayat Hari Ini --}}
        <div class="lg:col-span-5 space-y-4">
            <h2 class="text-lg font-bold text-slate-900 flex items-center gap-2">
                <svg class="w-5 h-5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Order Selesai / Riwayat
            </h2>
            
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200/60 overflow-hidden relative">
                @if($todayOrders->isEmpty())
                    <div class="p-10 text-center text-slate-500 font-medium">Belum ada pesanan masuk hari ini.</div>
                @else
                    <div class="divide-y divide-slate-100 max-h-[600px] overflow-y-auto custom-scrollbar">
                        @foreach($todayOrders as $order)
                        <div class="px-5 py-4 flex justify-between items-center hover:bg-slate-50 transition-colors">
                            <div>
                                <div class="flex items-center gap-2 mb-1">
                                    <p class="font-bold text-sm text-slate-900">#{{ $order->order_number }}</p>
                                    @if($order->status === 'cancelled')
                                        <span class="text-[10px] px-2 py-0.5 rounded font-bold bg-rose-100 text-rose-700 uppercase tracking-wider">Batal</span>
                                    @endif
                                </div>
                                <p class="text-xs text-slate-500 font-medium flex items-center gap-1.5">
                                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    {{ $order->created_at->format('H:i') }} • {{ $order->table->name }}
                                </p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-bold text-slate-900 mb-1">Rp {{ number_format($order->total, 0, ',', '.') }}</p>
                                @if($order->status === 'delivered')
                                    <span class="text-[10px] px-2 py-0.5 rounded bg-slate-100 text-slate-600 font-bold uppercase tracking-wider flex items-center gap-1 justify-end">
                                        <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                        Selesai
                                    </span>
                                @elseif($order->status !== 'cancelled')
                                    <span class="text-[10px] px-2 py-0.5 rounded font-bold uppercase tracking-wider
                                        {{ $order->status === 'ready' ? 'bg-emerald-100 text-emerald-700' : 'bg-indigo-100 text-indigo-700' }}">
                                        {{ $order->status === 'ready' ? 'Siap' : 'Aktif' }}
                                    </span>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                @endif
                <!-- Bottom fade for scroll -->
                <div class="absolute bottom-0 left-0 right-0 h-6 bg-gradient-to-t from-white to-transparent pointer-events-none"></div>
            </div>
        </div>

    </div>
</div>
@endsection

@push('scripts')
<script>
const csrf = document.querySelector('meta[name="csrf-token"]').content;

async function markDelivered(orderId, btn) {
    const originalText = btn.innerHTML;
    btn.disabled = true;
    btn.innerHTML = '<svg class="animate-spin w-4 h-4 mr-2" viewBox="0 0 24 24" fill="none"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Memproses...';
    try {
        await fetch(`/kasir/pos/${orderId}/deliver`, {
            method: 'PATCH',
            headers: { 'X-CSRF-TOKEN': csrf, 'Content-Type': 'application/json' }
        });
        location.reload();
    } catch (e) {
        btn.disabled = false;
        btn.innerHTML = originalText;
    }
}

// Auto refresh setiap 15 detik
setTimeout(() => location.reload(), 15000);
</script>
@endpush
