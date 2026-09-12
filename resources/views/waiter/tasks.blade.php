@extends('layouts.staff', ['noPadding' => true])
@section('title', 'Tugas Pelayan - ' . $shop->name)
@section('header_title', 'Tugas Pelayan')

@section('header_actions')
    @if($readyOrders->count() > 0)
    <div class="flex items-center gap-2 px-3 py-1.5 bg-rose-50 border border-rose-200 rounded-lg shadow-sm">
        <span class="w-2 h-2 rounded-full bg-rose-500 animate-pulse block"></span>
        <span class="text-xs font-bold text-rose-700 tracking-wide uppercase">{{ $readyOrders->count() }} Siap</span>
    </div>
    @endif
@endsection

@section('content')
<div class="max-w-lg mx-auto w-full">
    <div class="px-4 py-6">

        {{-- Pesanan Siap Diantar --}}
        @if($readyOrders->isNotEmpty())
        <div class="mb-8">
            <h2 class="text-sm font-bold text-slate-500 mb-3 flex items-center gap-2 uppercase tracking-wider">
                <svg class="w-4 h-4 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                Siap Diantar ({{ $readyOrders->count() }})
            </h2>

            <div class="space-y-4">
                @foreach($readyOrders as $order)
                <div class="bg-white rounded-2xl border-2 border-emerald-500 shadow-md shadow-emerald-900/5 overflow-hidden"
                     id="order-{{ $order->id }}">
                    <div class="bg-emerald-50 px-5 py-3 flex justify-between items-center border-b border-emerald-100/50">
                        <div>
                            <p class="font-black text-slate-900 text-lg">#{{ $order->order_number }}</p>
                            <p class="text-xs font-bold text-emerald-700 uppercase tracking-wide mt-0.5">Meja: {{ $order->table->name }}</p>
                        </div>
                        <div class="text-right flex flex-col items-end">
                            <span class="bg-emerald-200/50 text-emerald-700 text-[10px] px-2 py-0.5 rounded font-black uppercase tracking-wide">WAITING</span>
                            <p class="text-[11px] font-bold text-emerald-600 mt-1">{{ $order->created_at->format('H:i') }}</p>
                        </div>
                    </div>
                    <div class="px-5 py-4">
                        <div class="space-y-2 mb-4 bg-slate-50 rounded-xl p-3 border border-slate-100">
                            @foreach($order->items as $item)
                            <div class="text-sm text-slate-700 flex items-start gap-2">
                                <span class="font-black text-emerald-600 w-5 flex-shrink-0">{{ $item->quantity }}x</span>
                                <span class="font-medium leading-tight">{{ $item->item_name }}</span>
                            </div>
                            @endforeach
                        </div>
                        <button onclick="markDelivered({{ $order->id }}, this)"
                            class="w-full bg-emerald-500 text-white font-black py-3 rounded-xl text-sm hover:bg-emerald-600 transition-colors shadow-sm active:scale-[0.98] flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                            TANDAI SUDAH DIANTAR
                        </button>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @else
        <div class="bg-white rounded-2xl border border-slate-200/60 p-12 text-center mb-8 shadow-sm flex flex-col items-center justify-center">
            <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mb-4">
                <svg class="w-10 h-10 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 13l4 4L19 7"/></svg>
            </div>
            <p class="font-bold text-slate-700 text-lg">Tidak ada pesanan siap</p>
            <p class="text-xs text-slate-400 mt-1 font-medium">Santai dulu, halaman ini otomatis refresh (10s)</p>
        </div>
        @endif

        {{-- Terakhir Diantar Hari Ini --}}
        @if($recentDelivered->isNotEmpty())
        <div>
            <h2 class="text-xs font-bold text-slate-400 mb-3 flex items-center gap-2 uppercase tracking-wider">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Riwayat Antar Terakhir
            </h2>
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200/60 overflow-hidden">
                <div class="divide-y divide-slate-100">
                    @foreach($recentDelivered as $order)
                    <div class="px-5 py-3.5 flex justify-between items-center opacity-70 hover:opacity-100 transition-opacity">
                        <div>
                            <div class="flex items-center gap-2">
                                <p class="text-sm font-bold text-slate-900">#{{ $order->order_number }}</p>
                                <span class="bg-slate-100 text-slate-500 text-[10px] px-1.5 py-0.5 rounded font-bold uppercase">{{ $order->table->name }}</span>
                            </div>
                        </div>
                        <span class="text-[10px] px-2 py-0.5 rounded bg-emerald-50 text-emerald-600 font-bold uppercase tracking-wider border border-emerald-100 flex items-center gap-1">
                            <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            Selesai
                        </span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
const csrf = document.querySelector('meta[name="csrf-token"]').content;

async function markDelivered(orderId, btn) {
    const originalText = btn.innerHTML;
    btn.disabled = true;
    btn.innerHTML = '<svg class="animate-spin w-5 h-5" viewBox="0 0 24 24" fill="none"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> <span class="ml-2">Memproses...</span>';

    try {
        await fetch(`/waiter/orders/${orderId}/delivered`, {
            method: 'PATCH',
            headers: { 'X-CSRF-TOKEN': csrf, 'Content-Type': 'application/json' }
        });
        location.reload();
    } catch(e) {
        btn.disabled = false;
        btn.innerHTML = originalText;
    }
}

setTimeout(() => location.reload(), 10000);
</script>
@endpush
