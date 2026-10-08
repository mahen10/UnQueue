@extends('layouts.staff')
@section('title', 'POS Kasir - ' . $shop->name)
@section('header_title', 'POS Kasir')

@section('header_actions')
    {{-- Tombol Order Manual --}}
    <button onclick="openManualOrder()"
        class="inline-flex items-center gap-2 px-3 py-1.5 text-xs font-semibold bg-amber-500 hover:bg-amber-600 text-white rounded-lg shadow-sm transition-colors">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
        Order Manual
    </button>
    <a href="{{ route('kasir.transactions.index') }}" class="inline-flex items-center gap-2 px-3 py-1.5 text-xs font-semibold bg-slate-100 text-slate-700 border border-slate-200 rounded-lg shadow-sm hover:bg-slate-200 transition-colors">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
        Riwayat
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

        {{-- Panel Kiri: Order Aktif --}}
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
                    <button onclick="openManualOrder()" class="mt-5 inline-flex items-center gap-2 px-5 py-2.5 bg-amber-500 hover:bg-amber-600 text-white rounded-xl text-sm font-bold transition-colors shadow-sm">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                        Buat Order Manual
                    </button>
                </div>
            @else
                <div class="space-y-4">
                    @foreach($activeOrders as $order)
                    <div class="bg-white rounded-2xl shadow-sm border border-slate-200/60 overflow-hidden relative group">
                        <div class="absolute left-0 top-0 bottom-0 w-1.5 
                            {{ $order->status === 'paid' ? 'bg-indigo-500' : ($order->status === 'processing' ? 'bg-amber-500' : 'bg-emerald-500') }}">
                        </div>
                        
                        <div class="p-5 pl-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                            <div class="flex-grow w-full">
                                <div class="flex items-center justify-between sm:justify-start gap-3 mb-2">
                                    <div class="flex items-center gap-2 flex-wrap">
                                        <p class="font-black text-slate-900 text-lg">#{{ $order->order_number }}</p>
                                        <span class="text-xs px-2.5 py-1 rounded-md font-bold tracking-wide uppercase
                                            {{ $order->status === 'paid' ? 'bg-indigo-50 text-indigo-700 border border-indigo-200' : 
                                              ($order->status === 'processing' ? 'bg-amber-50 text-amber-700 border border-amber-200' : 
                                               'bg-emerald-50 text-emerald-700 border border-emerald-200') }}">
                                            {{ $order->status === 'paid' ? 'Antre Dapur' : ($order->status === 'processing' ? 'Sedang Dimasak' : 'Siap Diantar') }}
                                        </span>
                                        @if($order->type === 'manual')
                                        <span class="text-[10px] px-2 py-0.5 rounded bg-amber-100 text-amber-700 font-bold">Manual</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="flex items-center gap-3 text-xs font-semibold text-slate-500 mb-4">
                                    <span class="flex items-center gap-1">
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                                        {{ $order->table->name ?? 'Takeaway' }}
                                    </span>
                                    <span>•</span>
                                    <span class="flex items-center gap-1">
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        {{ $order->created_at->diffForHumans() }}
                                    </span>
                                </div>

                                <div class="bg-slate-50 rounded-xl p-3 border border-slate-100">
                                    <div class="text-sm text-slate-700 font-medium space-y-1.5">
                                        @foreach($order->items->take(3) as $item)
                                        <div class="flex items-center justify-between gap-2">
                                            <div class="flex items-start gap-2">
                                                <span class="bg-slate-200 text-slate-700 text-[10px] font-bold px-1.5 py-0.5 rounded shrink-0">{{ $item->quantity }}x</span>
                                                <span class="leading-tight">{{ $item->item_name }}</span>
                                            </div>
                                            <span class="text-xs text-slate-500 shrink-0">Rp {{ number_format($item->item_price * $item->quantity, 0, ',', '.') }}</span>
                                        </div>
                                        @endforeach
                                        @if($order->items->count() > 3)
                                        <p class="text-indigo-600 text-xs font-bold mt-2">+{{ $order->items->count() - 3 }} item lainnya...</p>
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
                Riwayat Hari Ini
            </h2>
            
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200/60 overflow-hidden relative">
                @if($todayOrders->isEmpty())
                    <div class="p-10 text-center text-slate-500 font-medium">Belum ada pesanan masuk hari ini.</div>
                @else
                    <div class="divide-y divide-slate-100 max-h-[600px] overflow-y-auto">
                        @foreach($todayOrders as $order)
                        <div class="px-5 py-4 flex justify-between items-center hover:bg-slate-50 transition-colors">
                            <div>
                                <div class="flex items-center gap-2 mb-1 flex-wrap">
                                    <p class="font-bold text-sm text-slate-900">#{{ $order->order_number }}</p>
                                    @if($order->type === 'manual')
                                    <span class="text-[10px] bg-amber-100 text-amber-700 font-bold px-1.5 py-0.5 rounded">Manual</span>
                                    @endif
                                    @if($order->status === 'cancelled')
                                        <span class="text-[10px] px-2 py-0.5 rounded font-bold bg-rose-100 text-rose-700 uppercase tracking-wider">Batal</span>
                                    @endif
                                </div>
                                <p class="text-xs text-slate-500 font-medium flex items-center gap-1.5">
                                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    {{ $order->created_at->format('H:i') }} • {{ $order->table->name ?? 'Takeaway' }}
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
                <div class="absolute bottom-0 left-0 right-0 h-6 bg-gradient-to-t from-white to-transparent pointer-events-none"></div>
            </div>
        </div>

    </div>
</div>

{{-- ===== MODAL ORDER MANUAL ===== --}}
<div id="manualOrderModal" class="fixed inset-0 z-50 hidden" aria-modal="true">
    {{-- Backdrop --}}
    <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" onclick="closeManualOrder()"></div>

    {{-- Modal Panel --}}
    <div class="absolute inset-0 flex items-center justify-center p-4 pointer-events-none">
        <div class="bg-white rounded-3xl shadow-2xl w-full max-w-2xl max-h-[90vh] flex flex-col pointer-events-auto overflow-hidden">

            {{-- Header --}}
            <div class="flex items-center justify-between px-6 py-5 border-b border-slate-100 shrink-0">
                <div>
                    <h3 class="text-lg font-black text-slate-900">Order Manual Kasir</h3>
                    <p class="text-xs text-slate-500 mt-0.5">Input pesanan untuk pelanggan yang bayar tunai / QRIS langsung</p>
                </div>
                <button onclick="closeManualOrder()" class="p-2 hover:bg-slate-100 rounded-xl transition-colors">
                    <svg class="w-5 h-5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            {{-- Body --}}
            <div class="flex-1 overflow-y-auto px-6 py-5 space-y-5">

                {{-- Pilih Meja --}}
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-2 uppercase tracking-wider">Meja Pelanggan <span class="text-rose-500">*</span></label>
                    <select id="mo_table" class="w-full rounded-xl border border-slate-200 px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 font-medium bg-white">
                        <option value="">— Pilih Meja —</option>
                        @foreach($tables as $table)
                        <option value="{{ $table->id }}">{{ $table->name }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Pilih Item --}}
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-2 uppercase tracking-wider">Pilih Menu</label>
                    
                    {{-- Search --}}
                    <input type="text" id="mo_search" oninput="filterMenu(this.value)" placeholder="Cari menu..." 
                        class="w-full rounded-xl border border-slate-200 px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 mb-3">

                    {{-- Menu List --}}
                    <div id="mo_menu_list" class="space-y-1.5 max-h-52 overflow-y-auto pr-1">
                        @foreach($menuItems as $item)
                        <div class="menu-item-row flex items-center justify-between gap-3 p-3 rounded-xl border border-slate-100 hover:border-amber-200 hover:bg-amber-50/40 transition-colors cursor-pointer"
                             data-name="{{ strtolower($item->name) }}"
                             onclick="addToCart({{ $item->id }}, '{{ addslashes($item->name) }}', {{ (int) $item->price }})">
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-semibold text-slate-800 truncate">{{ $item->name }}</p>
                                <p class="text-xs text-slate-400">{{ $item->category->name ?? '' }}</p>
                            </div>
                            <span class="text-sm font-bold text-slate-900 shrink-0">Rp {{ number_format($item->price, 0, ',', '.') }}</span>
                            <div class="w-7 h-7 rounded-lg bg-amber-500 text-white flex items-center justify-center shrink-0">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                {{-- Cart Items --}}
                <div id="mo_cart_section" class="hidden">
                    <label class="block text-xs font-bold text-slate-700 mb-2 uppercase tracking-wider">Keranjang</label>
                    <div id="mo_cart" class="space-y-2"></div>

                    {{-- Total --}}
                    <div class="mt-3 pt-3 border-t border-slate-100 flex items-center justify-between">
                        <span class="text-sm font-bold text-slate-600">Total</span>
                        <span id="mo_total_display" class="text-lg font-black text-slate-900">Rp 0</span>
                    </div>
                </div>

                {{-- Metode Bayar --}}
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-2 uppercase tracking-wider">Metode Pembayaran <span class="text-rose-500">*</span></label>
                    <div class="grid grid-cols-3 gap-2">
                        @foreach(['cash' => 'Tunai', 'qris' => 'QRIS', 'transfer' => 'Transfer'] as $val => $label)
                        <label class="flex items-center justify-center gap-2 p-3 rounded-xl border-2 cursor-pointer transition-all
                            has-[:checked]:border-amber-500 has-[:checked]:bg-amber-50 border-slate-200 hover:border-amber-300">
                            <input type="radio" name="mo_payment" value="{{ $val }}" {{ $val === 'cash' ? 'checked' : '' }} class="sr-only">
                            <span class="text-sm font-semibold text-slate-700">{{ $label }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>

                {{-- Catatan --}}
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-2 uppercase tracking-wider">Catatan (opsional)</label>
                    <textarea id="mo_notes" rows="2" placeholder="Misal: tidak pakai es, minta plastik, dll"
                        class="w-full rounded-xl border border-slate-200 px-3.5 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 resize-none"></textarea>
                </div>
            </div>

            {{-- Footer --}}
            <div class="px-6 py-4 border-t border-slate-100 shrink-0 flex items-center gap-3">
                <button onclick="closeManualOrder()" class="flex-1 py-2.5 rounded-xl border border-slate-200 text-slate-700 font-semibold text-sm hover:bg-slate-50 transition-colors">
                    Batal
                </button>
                <button id="mo_submit_btn" onclick="submitManualOrder()" class="flex-1 py-2.5 rounded-xl bg-amber-500 hover:bg-amber-600 text-white font-bold text-sm transition-colors shadow-sm disabled:opacity-50 disabled:cursor-not-allowed">
                    Kirim ke Dapur
                </button>
            </div>
        </div>
    </div>
</div>

{{-- Success Toast --}}
<div id="toast" class="fixed bottom-6 right-6 z-[60] hidden">
    <div class="bg-emerald-600 text-white px-5 py-3.5 rounded-2xl shadow-xl flex items-center gap-3 font-semibold text-sm">
        <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        <span id="toast_msg">Order berhasil dikirim!</span>
    </div>
</div>

@endsection

@push('scripts')
<script>
const csrf = document.querySelector('meta[name="csrf-token"]').content;

// ===== Mark Delivered =====
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

// ===== Manual Order =====
let cart = {}; // { menuItemId: { name, price, qty } }

function openManualOrder() {
    document.getElementById('manualOrderModal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeManualOrder() {
    document.getElementById('manualOrderModal').classList.add('hidden');
    document.body.style.overflow = '';
    resetCart();
}

function filterMenu(q) {
    const rows = document.querySelectorAll('.menu-item-row');
    const lower = q.toLowerCase().trim();
    rows.forEach(r => {
        r.style.display = (!lower || r.dataset.name.includes(lower)) ? '' : 'none';
    });
}

function addToCart(id, name, price) {
    if (cart[id]) {
        cart[id].qty++;
    } else {
        cart[id] = { name, price, qty: 1 };
    }
    renderCart();
}

function changeQty(id, delta) {
    if (!cart[id]) return;
    cart[id].qty += delta;
    if (cart[id].qty <= 0) delete cart[id];
    renderCart();
}

function renderCart() {
    const container = document.getElementById('mo_cart');
    const section   = document.getElementById('mo_cart_section');
    const totalEl   = document.getElementById('mo_total_display');

    const items = Object.entries(cart);
    if (items.length === 0) {
        section.classList.add('hidden');
        container.innerHTML = '';
        totalEl.textContent = 'Rp 0';
        return;
    }

    section.classList.remove('hidden');

    let total = 0;
    container.innerHTML = items.map(([id, item]) => {
        const lineTotal = item.price * item.qty;
        total += lineTotal;
        return `<div class="flex items-center gap-3 bg-slate-50 rounded-xl px-3 py-2.5 border border-slate-100">
            <div class="flex-1 min-w-0">
                <p class="text-sm font-semibold text-slate-800 truncate">${item.name}</p>
                <p class="text-xs text-slate-500">Rp ${item.price.toLocaleString('id-ID')} × ${item.qty} = <strong>Rp ${lineTotal.toLocaleString('id-ID')}</strong></p>
            </div>
            <div class="flex items-center gap-2 shrink-0">
                <button onclick="changeQty(${id}, -1)" class="w-7 h-7 rounded-lg bg-slate-200 hover:bg-slate-300 text-slate-700 font-bold text-lg flex items-center justify-center leading-none transition-colors">−</button>
                <span class="text-sm font-bold text-slate-900 w-5 text-center">${item.qty}</span>
                <button onclick="changeQty(${id}, 1)" class="w-7 h-7 rounded-lg bg-amber-500 hover:bg-amber-600 text-white font-bold text-lg flex items-center justify-center leading-none transition-colors">+</button>
            </div>
        </div>`;
    }).join('');

    totalEl.textContent = 'Rp ' + total.toLocaleString('id-ID');
}

function resetCart() {
    cart = {};
    document.getElementById('mo_table').value = '';
    document.getElementById('mo_search').value = '';
    document.getElementById('mo_notes').value = '';
    document.querySelector('input[name="mo_payment"][value="cash"]').checked = true;
    renderCart();
    filterMenu('');
}

async function submitManualOrder() {
    const tableId = document.getElementById('mo_table').value;
    const items   = Object.entries(cart).map(([id, item]) => ({ id: parseInt(id), qty: item.qty }));
    const payment = document.querySelector('input[name="mo_payment"]:checked').value;
    const notes   = document.getElementById('mo_notes').value;

    if (!tableId) { alert('Pilih meja terlebih dahulu!'); return; }
    if (items.length === 0) { alert('Tambahkan minimal 1 menu!'); return; }

    const btn = document.getElementById('mo_submit_btn');
    btn.disabled = true;
    btn.textContent = 'Mengirim...';

    try {
        const res = await fetch('{{ route("kasir.pos.order") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrf,
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify({ table_id: tableId, items, payment_method: payment, notes })
        });

        const data = await res.json();

        if (res.ok && data.success) {
            closeManualOrder();
            showToast(`Order #${data.order_number} berhasil dikirim ke dapur! Total: Rp ${Math.round(data.total).toLocaleString('id-ID')}`);
            setTimeout(() => location.reload(), 2000);
        } else {
            alert(data.message || data.error || 'Terjadi kesalahan.');
        }
    } catch (e) {
        alert('Gagal mengirim order. Coba lagi.');
    } finally {
        btn.disabled = false;
        btn.textContent = 'Kirim ke Dapur';
    }
}

function showToast(msg) {
    const toast = document.getElementById('toast');
    document.getElementById('toast_msg').textContent = msg;
    toast.classList.remove('hidden');
    setTimeout(() => toast.classList.add('hidden'), 4000);
}
</script>
@endpush
