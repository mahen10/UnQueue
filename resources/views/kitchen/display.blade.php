@extends('layouts.staff', ['darkMode' => true, 'noPadding' => true])
@section('title', 'KDS Dapur - ' . $shop->name)
@section('header_title', 'Kitchen Display System')

@push('styles')
<style>
    @keyframes pulse-border {
        0%, 100% { border-color: rgb(99 102 241); } /* indigo-500 */
        50%       { border-color: rgb(165 180 252); } /* indigo-300 */
    }
    .new-order { animation: pulse-border 1.5s ease-in-out infinite; }
</style>
@endpush

@section('header_actions')
<div class="hidden sm:flex items-center gap-2 px-3 py-1.5 bg-slate-700/50 rounded-lg text-xs font-semibold text-slate-300 mr-2" x-data="kdsRefresh()">
    <svg class="w-4 h-4 animate-spin text-indigo-400" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
    Refresh: <span x-text="countdown">20</span>s
</div>
@endsection

@section('content')
<div class="p-4 sm:p-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 sm:gap-6 auto-rows-max min-h-full items-start" x-data="kdsApp()">

    {{-- BARU MASUK (paid) --}}
    @forelse($newOrders as $order)
    <div class="bg-slate-800 rounded-2xl overflow-hidden flex flex-col border-2 border-indigo-500 shadow-lg shadow-indigo-900/20 new-order"
         id="order-{{ $order->id }}">
        <div class="bg-indigo-600 px-5 py-3 flex justify-between items-center text-white">
            <div>
                <p class="font-black text-lg tracking-tight">#{{ $order->order_number }}</p>
                <p class="text-xs font-semibold text-indigo-100 uppercase tracking-wider mt-0.5">Meja: {{ $order->table->name }}</p>
            </div>
            <div class="text-right flex flex-col items-end">
                <span class="bg-indigo-900/50 text-indigo-100 text-[10px] px-2 py-0.5 rounded font-bold uppercase tracking-wide">BARU MASUK</span>
                <p class="text-xs font-medium text-indigo-200 mt-1">{{ $order->created_at->format('H:i') }}</p>
            </div>
        </div>

        <div class="flex-grow px-5 py-4 space-y-3 bg-slate-800">
            @foreach($order->items as $item)
            <div class="flex items-start gap-3">
                <span class="font-black text-indigo-400 text-lg w-6 flex-shrink-0 leading-none">{{ $item->quantity }}<span class="text-xs font-normal ml-0.5">x</span></span>
                <div>
                    <p class="text-base font-bold text-slate-100 leading-tight mb-1">{{ $item->item_name }}</p>
                    @if($item->modifiers && count($item->modifiers) > 0)
                        <p class="text-xs font-medium text-slate-400 mb-0.5">
                            @foreach($item->modifiers as $mod)
                                {{ $mod['option_label'] ?? '' }}@if(!$loop->last), @endif
                            @endforeach
                        </p>
                    @endif
                    @if($item->notes)
                        <p class="text-xs font-bold text-amber-400 italic flex items-center gap-1 mt-1">
                            <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                            {{ $item->notes }}
                        </p>
                    @endif
                </div>
            </div>
            @if(!$loop->last)
                <div class="h-px w-full bg-slate-700/50"></div>
            @endif
            @endforeach

            @if($order->notes)
            <div class="mt-4 bg-amber-900/20 border border-amber-500/30 rounded-xl p-3 text-xs font-medium text-amber-300">
                <span class="block font-bold text-amber-400 mb-1">Catatan Order:</span>
                {{ $order->notes }}
            </div>
            @endif
        </div>

        {{-- Action --}}
        <div class="px-5 pb-5 pt-2 bg-slate-800">
            <button onclick="updateOrder({{ $order->id }}, 'process', this)"
                class="w-full bg-indigo-500 hover:bg-indigo-400 text-white font-black py-3 rounded-xl text-sm transition-colors shadow-md flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 14v6m-3-3h6M6 10h2a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2zm10 0h2a2 2 0 002-2V6a2 2 0 00-2-2h-2a2 2 0 00-2 2v2a2 2 0 002 2zM6 20h2a2 2 0 002-2v-2a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2z"/></svg>
                MULAI MASAK
            </button>
        </div>
    </div>
    @empty
    @endforelse

    {{-- SEDANG DIMASAK (processing) --}}
    @foreach($processingOrders as $order)
    <div class="bg-slate-800 rounded-2xl overflow-hidden flex flex-col border-2 border-amber-500 shadow-lg shadow-amber-900/10"
         id="order-{{ $order->id }}">
        <div class="bg-amber-500 px-5 py-3 flex justify-between items-center text-amber-950">
            <div>
                <p class="font-black text-lg tracking-tight">#{{ $order->order_number }}</p>
                <p class="text-xs font-bold text-amber-900 uppercase tracking-wider mt-0.5">Meja: {{ $order->table->name }}</p>
            </div>
            <div class="text-right flex flex-col items-end">
                <span class="bg-amber-900/10 text-amber-950 text-[10px] px-2 py-0.5 rounded font-black uppercase tracking-wide">DIMASAK</span>
                <p class="text-xs font-bold text-amber-900 mt-1 flex items-center gap-1">
                    <svg class="w-3 h-3 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                    {{ $order->created_at->format('H:i') }}
                </p>
            </div>
        </div>

        <div class="flex-grow px-5 py-4 space-y-3 bg-slate-800">
            @foreach($order->items as $item)
            <div class="flex items-start gap-3 opacity-90">
                <span class="font-black text-amber-500 text-lg w-6 flex-shrink-0 leading-none">{{ $item->quantity }}<span class="text-xs font-normal ml-0.5">x</span></span>
                <div>
                    <p class="text-base font-bold text-slate-100 leading-tight mb-1">{{ $item->item_name }}</p>
                    @if($item->modifiers && count($item->modifiers) > 0)
                        <p class="text-xs font-medium text-slate-400 mb-0.5">
                            @foreach($item->modifiers as $mod)
                                {{ $mod['option_label'] ?? '' }}@if(!$loop->last), @endif
                            @endforeach
                        </p>
                    @endif
                    @if($item->notes)
                        <p class="text-xs font-bold text-amber-400 italic flex items-center gap-1 mt-1">
                            <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                            {{ $item->notes }}
                        </p>
                    @endif
                </div>
            </div>
            @if(!$loop->last)
                <div class="h-px w-full bg-slate-700/50"></div>
            @endif
            @endforeach

            @if($order->notes)
            <div class="mt-4 bg-amber-900/20 border border-amber-500/30 rounded-xl p-3 text-xs font-medium text-amber-300">
                {{ $order->notes }}
            </div>
            @endif
        </div>

        <div class="px-5 pb-5 pt-2 bg-slate-800">
            <button onclick="updateOrder({{ $order->id }}, 'ready', this)"
                class="w-full bg-emerald-500 hover:bg-emerald-400 text-white font-black py-3 rounded-xl text-sm transition-colors shadow-md flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                SIAP DIANTAR!
            </button>
        </div>
    </div>
    @endforeach

    {{-- SIAP (ready) - Tampil lebih minimalis --}}
    @foreach($readyOrders as $order)
    <div class="bg-slate-800/80 border border-emerald-500/30 rounded-2xl overflow-hidden flex flex-col opacity-60 hover:opacity-100 transition-opacity"
         id="order-{{ $order->id }}">
        <div class="bg-emerald-900/40 px-4 py-3 flex justify-between items-center">
            <div>
                <p class="font-bold text-sm text-slate-300">#{{ $order->order_number }}</p>
                <p class="text-xs text-emerald-400 font-medium">Meja: {{ $order->table->name }}</p>
            </div>
            <span class="bg-emerald-500/20 text-emerald-400 border border-emerald-500/30 text-[10px] px-2 py-0.5 rounded font-bold uppercase tracking-wider flex items-center gap-1">
                <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                SIAP
            </span>
        </div>
        <div class="px-4 py-3 text-xs font-medium text-slate-500 flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            Menunggu pelayan mengambil...
        </div>
    </div>
    @endforeach

    {{-- Empty state --}}
    @if($newOrders->isEmpty() && $processingOrders->isEmpty() && $readyOrders->isEmpty())
    <div class="col-span-full py-32 text-center flex flex-col items-center">
        <div class="w-24 h-24 bg-slate-800 rounded-full flex items-center justify-center mb-6 border border-slate-700">
            <svg class="w-12 h-12 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
        </div>
        <p class="text-slate-300 text-xl font-bold tracking-tight">Dapur Sedang Kosong</p>
        <p class="text-slate-500 text-sm mt-2 font-medium">Pesanan baru akan muncul secara otomatis di sini.</p>
    </div>
    @endif

</div>

{{-- Toggle Stok Cepat (sudut kanan bawah) --}}
<div class="fixed bottom-6 right-6 z-50" x-data="{ open: false }">
    <button @click="open = !open"
        class="bg-indigo-600 hover:bg-indigo-500 text-white px-5 py-3 rounded-full shadow-lg shadow-indigo-600/30 text-sm font-bold flex items-center gap-2 transition-colors border border-indigo-400/30">
        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
        Kelola Stok Menu
    </button>

    <div x-show="open" @click.outside="open = false"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 translate-y-2 scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0 scale-100"
        x-transition:leave-end="opacity-0 translate-y-2 scale-95"
        class="absolute bottom-16 right-0 bg-slate-800 rounded-2xl shadow-2xl border border-slate-700 p-5 w-80 max-h-96 overflow-y-auto custom-scrollbar" style="display: none;">
        
        <h3 class="font-bold text-slate-100 text-sm mb-4 flex items-center gap-2">
            <svg class="w-4 h-4 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
            Ketersediaan Menu Harian
        </h3>
        
        <div class="space-y-1">
            @foreach($menuItems as $item)
            <div class="flex justify-between items-center py-2 border-b border-slate-700/50 last:border-0">
                <span class="text-sm font-medium text-slate-300 flex-grow mr-3 truncate">{{ $item->name }}</span>
                <button onclick="toggleStock({{ $item->id }}, this)"
                    class="flex-shrink-0 text-[10px] px-2.5 py-1 rounded font-bold uppercase tracking-wider transition-colors {{ $item->is_available ? 'bg-emerald-500/20 text-emerald-400 border border-emerald-500/30' : 'bg-rose-500/20 text-rose-400 border border-rose-500/30' }}">
                    {{ $item->is_available ? 'Tersedia' : 'Habis' }}
                </button>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
const csrf = document.querySelector('meta[name="csrf-token"]').content;

async function updateOrder(orderId, action, btn) {
    const originalText = btn.innerHTML;
    btn.disabled = true;
    btn.innerHTML = '<svg class="animate-spin w-5 h-5" viewBox="0 0 24 24" fill="none"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> <span class="ml-2">Memproses...</span>';

    const url = action === 'process'
        ? `/kitchen/orders/${orderId}/process`
        : `/kitchen/orders/${orderId}/ready`;

    try {
        const res = await fetch(url, {
            method: 'PATCH',
            headers: { 'X-CSRF-TOKEN': csrf, 'Content-Type': 'application/json' }
        });

        if (res.ok) {
            location.reload();
        } else {
            throw new Error('Gagal');
        }
    } catch(e) {
        btn.disabled = false;
        btn.innerHTML = originalText;
    }
}

async function toggleStock(itemId, btn) {
    const res = await fetch(`/kitchen/menu-items/${itemId}/toggle-stock`, {
        method: 'PATCH',
        headers: { 'X-CSRF-TOKEN': csrf, 'Content-Type': 'application/json' }
    });
    const data = await res.json();
    if (data.success) {
        if (data.is_available) {
            btn.textContent = 'TERSEDIA';
            btn.className = 'flex-shrink-0 text-[10px] px-2.5 py-1 rounded font-bold uppercase tracking-wider transition-colors bg-emerald-500/20 text-emerald-400 border border-emerald-500/30';
        } else {
            btn.textContent = 'HABIS';
            btn.className = 'flex-shrink-0 text-[10px] px-2.5 py-1 rounded font-bold uppercase tracking-wider transition-colors bg-rose-500/20 text-rose-400 border border-rose-500/30';
        }
    }
}

// Alpine component for Auto Refresh Countdown
document.addEventListener('alpine:init', () => {
    Alpine.data('kdsRefresh', () => ({
        countdown: 20,
        init() {
            setInterval(() => {
                this.countdown--;
                if (this.countdown <= 0) {
                    location.reload();
                }
            }, 1000);
        }
    }));
    Alpine.data('kdsApp', () => ({}));
});
</script>
@endpush
