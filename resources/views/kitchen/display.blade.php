<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>KDS Dapur — {{ $shop->name }}</title>
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style type="text/tailwindcss">
        @keyframes pulse-border {
            0%, 100% { border-color: rgb(59 130 246); }
            50%       { border-color: rgb(147 197 253); }
        }
        .new-order { animation: pulse-border 1.5s ease-in-out infinite; }
    </style>
</head>
<body class="bg-gray-900 text-white min-h-screen" x-data="kds()">

{{-- Header --}}
<div class="bg-gray-800 px-6 py-3 flex justify-between items-center border-b border-gray-700">
    <div class="flex items-center gap-3">
        <span class="text-2xl">👨‍🍳</span>
        <div>
            <h1 class="font-bold text-lg">Kitchen Display</h1>
            <p class="text-xs text-gray-400">{{ $shop->name }}</p>
        </div>
    </div>
    <div class="flex items-center gap-4">
        {{-- Legenda --}}
        <div class="hidden sm:flex items-center gap-3 text-xs text-gray-400">
            <span class="flex items-center gap-1"><span class="w-3 h-3 rounded-full bg-blue-500 inline-block"></span> Pesanan Baru</span>
            <span class="flex items-center gap-1"><span class="w-3 h-3 rounded-full bg-orange-500 inline-block"></span> Dimasak</span>
            <span class="flex items-center gap-1"><span class="w-3 h-3 rounded-full bg-green-500 inline-block"></span> Siap</span>
        </div>
        <div class="text-right">
            <p class="text-xs text-gray-400">Auto refresh</p>
            <p class="text-sm font-mono font-bold text-green-400" x-text="countdown + 's'"></p>
        </div>
    </div>
</div>

{{-- Ringkasan Cepat --}}
<div class="px-6 py-3 bg-gray-800 border-b border-gray-700 flex gap-6 text-sm">
    <div class="flex items-center gap-2">
        <span class="w-2.5 h-2.5 rounded-full bg-blue-500"></span>
        <span class="text-gray-300">Baru:</span>
        <span class="font-bold text-blue-400">{{ $newOrders->count() }}</span>
    </div>
    <div class="flex items-center gap-2">
        <span class="w-2.5 h-2.5 rounded-full bg-orange-500"></span>
        <span class="text-gray-300">Dimasak:</span>
        <span class="font-bold text-orange-400">{{ $processingOrders->count() }}</span>
    </div>
    <div class="flex items-center gap-2">
        <span class="w-2.5 h-2.5 rounded-full bg-green-500"></span>
        <span class="text-gray-300">Siap:</span>
        <span class="font-bold text-green-400">{{ $readyOrders->count() }}</span>
    </div>
</div>

{{-- KDS Board --}}
<div class="p-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">

    {{-- PESANAN BARU (paid) --}}
    @forelse($newOrders as $order)
    <div class="bg-gray-800 border-2 border-blue-500 new-order rounded-xl overflow-hidden flex flex-col"
         id="order-{{ $order->id }}">
        {{-- Card Header --}}
        <div class="bg-blue-600 px-4 py-2 flex justify-between items-center">
            <div>
                <p class="font-bold text-sm">#{{ $order->order_number }}</p>
                <p class="text-xs text-blue-200">{{ $order->table->name }}</p>
            </div>
            <div class="text-right">
                <span class="bg-blue-800 text-blue-200 text-xs px-2 py-0.5 rounded-full font-medium">BARU</span>
                <p class="text-xs text-blue-300 mt-1">{{ $order->created_at->format('H:i') }}</p>
            </div>
        </div>

        {{-- Items --}}
        <div class="flex-grow px-4 py-3 space-y-2">
            @foreach($order->items as $item)
            <div class="flex gap-2">
                <span class="font-bold text-blue-400 text-sm w-6 flex-shrink-0">{{ $item->quantity }}×</span>
                <div>
                    <p class="text-sm font-medium text-white">{{ $item->item_name }}</p>
                    @if($item->modifiers && count($item->modifiers) > 0)
                        <p class="text-xs text-gray-400">
                            @foreach($item->modifiers as $mod)
                                {{ $mod['option_label'] ?? '' }}@if(!$loop->last), @endif
                            @endforeach
                        </p>
                    @endif
                    @if($item->notes)
                        <p class="text-xs text-yellow-400 italic">⚠️ {{ $item->notes }}</p>
                    @endif
                </div>
            </div>
            @endforeach

            @if($order->notes)
            <div class="mt-2 bg-yellow-900/40 rounded-lg p-2 text-xs text-yellow-300">
                📝 {{ $order->notes }}
            </div>
            @endif
        </div>

        {{-- Action --}}
        <div class="px-4 pb-3">
            <button onclick="updateOrder({{ $order->id }}, 'process', this)"
                class="w-full bg-orange-500 hover:bg-orange-600 text-white font-bold py-2.5 rounded-lg text-sm transition active:scale-95">
                👨‍🍳 Mulai Masak
            </button>
        </div>
    </div>
    @empty
    @endforelse

    {{-- SEDANG DIMASAK (processing) --}}
    @foreach($processingOrders as $order)
    <div class="bg-gray-800 border-2 border-orange-500 rounded-xl overflow-hidden flex flex-col"
         id="order-{{ $order->id }}">
        <div class="bg-orange-600 px-4 py-2 flex justify-between items-center">
            <div>
                <p class="font-bold text-sm">#{{ $order->order_number }}</p>
                <p class="text-xs text-orange-200">{{ $order->table->name }}</p>
            </div>
            <div class="text-right">
                <span class="bg-orange-800 text-orange-200 text-xs px-2 py-0.5 rounded-full font-medium">DIMASAK</span>
                <p class="text-xs text-orange-300 mt-1">{{ $order->created_at->format('H:i') }}</p>
            </div>
        </div>

        <div class="flex-grow px-4 py-3 space-y-2">
            @foreach($order->items as $item)
            <div class="flex gap-2">
                <span class="font-bold text-orange-400 text-sm w-6 flex-shrink-0">{{ $item->quantity }}×</span>
                <div>
                    <p class="text-sm font-medium text-white">{{ $item->item_name }}</p>
                    @if($item->modifiers && count($item->modifiers) > 0)
                        <p class="text-xs text-gray-400">
                            @foreach($item->modifiers as $mod)
                                {{ $mod['option_label'] ?? '' }}@if(!$loop->last), @endif
                            @endforeach
                        </p>
                    @endif
                    @if($item->notes)
                        <p class="text-xs text-yellow-400 italic">⚠️ {{ $item->notes }}</p>
                    @endif
                </div>
            </div>
            @endforeach

            @if($order->notes)
            <div class="mt-2 bg-yellow-900/40 rounded-lg p-2 text-xs text-yellow-300">
                📝 {{ $order->notes }}
            </div>
            @endif
        </div>

        <div class="px-4 pb-3">
            <button onclick="updateOrder({{ $order->id }}, 'ready', this)"
                class="w-full bg-green-500 hover:bg-green-600 text-white font-bold py-2.5 rounded-lg text-sm transition active:scale-95">
                🛎️ Siap Diantar!
            </button>
        </div>
    </div>
    @endforeach

    {{-- SIAP (ready) — tampil lebih kecil --}}
    @foreach($readyOrders as $order)
    <div class="bg-gray-800 border-2 border-green-600 rounded-xl overflow-hidden flex flex-col opacity-70"
         id="order-{{ $order->id }}">
        <div class="bg-green-700 px-4 py-2 flex justify-between items-center">
            <div>
                <p class="font-bold text-sm">#{{ $order->order_number }}</p>
                <p class="text-xs text-green-200">{{ $order->table->name }}</p>
            </div>
            <span class="bg-green-900 text-green-300 text-xs px-2 py-0.5 rounded-full font-medium">✅ SIAP</span>
        </div>
        <div class="px-4 py-2 text-xs text-gray-400">
            Menunggu pelayan mengambil...
        </div>
    </div>
    @endforeach

    {{-- Empty state --}}
    @if($newOrders->isEmpty() && $processingOrders->isEmpty() && $readyOrders->isEmpty())
    <div class="col-span-full py-20 text-center">
        <div class="text-6xl mb-4">🍽️</div>
        <p class="text-gray-400 text-lg font-medium">Tidak ada pesanan aktif</p>
        <p class="text-gray-600 text-sm mt-1">Pesanan baru akan muncul otomatis di sini</p>
    </div>
    @endif

</div>

{{-- Toggle Stok Cepat (sudut kanan bawah) --}}
<div class="fixed bottom-4 right-4" x-data="{ open: false }">
    <button @click="open = !open"
        class="bg-gray-700 hover:bg-gray-600 text-white px-4 py-2.5 rounded-full shadow-lg text-sm font-medium flex items-center gap-2">
        <span>📦</span> Stok Menu
    </button>

    <div x-show="open" @click.outside="open = false"
        class="absolute bottom-14 right-0 bg-gray-800 rounded-xl shadow-xl border border-gray-700 p-4 w-72 max-h-80 overflow-y-auto">
        <h3 class="font-semibold text-sm mb-3">Toggle Ketersediaan Menu</h3>
        <div class="space-y-2">
            @foreach($menuItems as $item)
            <div class="flex justify-between items-center">
                <span class="text-sm text-gray-300 flex-grow mr-2 truncate">{{ $item->name }}</span>
                <button onclick="toggleStock({{ $item->id }}, this)"
                    data-available="{{ $item->is_available ? '1' : '0' }}"
                    class="flex-shrink-0 text-xs px-3 py-1 rounded-full font-medium {{ $item->is_available ? 'bg-green-600 text-white' : 'bg-red-900 text-red-300' }}">
                    {{ $item->is_available ? 'Tersedia' : 'Habis' }}
                </button>
            </div>
            @endforeach
        </div>
    </div>
</div>

<script>
const csrf = document.querySelector('meta[name="csrf-token"]').content;

async function updateOrder(orderId, action, btn) {
    btn.disabled = true;
    btn.textContent = 'Memproses...';

    const url = action === 'process'
        ? `/kitchen/orders/${orderId}/process`
        : `/kitchen/orders/${orderId}/ready`;

    const res = await fetch(url, {
        method: 'PATCH',
        headers: { 'X-CSRF-TOKEN': csrf, 'Content-Type': 'application/json' }
    });

    if (res.ok) {
        // Langsung reload untuk update tampilan
        location.reload();
    } else {
        btn.disabled = false;
        btn.textContent = 'Coba lagi';
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
            btn.textContent = 'Tersedia';
            btn.className = btn.className.replace('bg-red-900 text-red-300', 'bg-green-600 text-white');
        } else {
            btn.textContent = 'Habis';
            btn.className = btn.className.replace('bg-green-600 text-white', 'bg-red-900 text-red-300');
        }
    }
}

// Alpine KDS component — auto refresh countdown
function kds() {
    return {
        countdown: 20,
        init() {
            setInterval(() => {
                this.countdown--;
                if (this.countdown <= 0) {
                    location.reload();
                }
            }, 1000);
        }
    };
}
</script>
</body>
</html>
