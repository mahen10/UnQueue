<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Tugas Pelayan — {{ $shop->name }}</title>
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-100 min-h-screen">

<div class="max-w-lg mx-auto">
    {{-- Header --}}
    <div class="bg-white border-b border-gray-200 px-4 py-3 flex justify-between items-center sticky top-0 z-10">
        <div class="flex items-center gap-2">
            <span class="text-xl">🛎️</span>
            <div>
                <h1 class="font-bold text-gray-900 text-sm">Tugas Pelayan</h1>
                <p class="text-xs text-gray-400">{{ $shop->name }}</p>
            </div>
        </div>
        <div class="flex items-center gap-3">
            @if($readyOrders->count() > 0)
            <span class="bg-red-500 text-white text-xs font-bold px-2.5 py-1 rounded-full animate-pulse">
                {{ $readyOrders->count() }} siap!
            </span>
            @endif
            <form action="{{ route('logout') }}" method="POST" class="inline">
                @csrf
                <button class="text-xs text-gray-400">Logout</button>
            </form>
        </div>
    </div>

    <div class="px-4 py-4">

        {{-- Pesanan Siap Diantar --}}
        @if($readyOrders->isNotEmpty())
        <div class="mb-6">
            <h2 class="text-base font-bold text-gray-900 mb-3 flex items-center gap-2">
                <span class="w-3 h-3 rounded-full bg-green-500 animate-pulse inline-block"></span>
                Siap Diantar ({{ $readyOrders->count() }})
            </h2>

            <div class="space-y-3">
                @foreach($readyOrders as $order)
                <div class="bg-white rounded-xl border-2 border-green-500 shadow-sm overflow-hidden"
                     id="order-{{ $order->id }}">
                    <div class="bg-green-50 px-4 py-2 flex justify-between items-center">
                        <div>
                            <p class="font-bold text-gray-900 text-sm">#{{ $order->order_number }}</p>
                            <p class="text-xs text-gray-500">{{ $order->table->name }}</p>
                        </div>
                        <p class="text-xs text-gray-400">{{ $order->created_at->format('H:i') }}</p>
                    </div>
                    <div class="px-4 py-3">
                        <div class="space-y-1.5 mb-3">
                            @foreach($order->items as $item)
                            <div class="text-sm text-gray-700">
                                <span class="font-bold text-green-600">{{ $item->quantity }}×</span>
                                {{ $item->item_name }}
                            </div>
                            @endforeach
                        </div>
                        <button onclick="markDelivered({{ $order->id }}, this)"
                            class="w-full bg-green-600 text-white font-bold py-2.5 rounded-lg text-sm hover:bg-green-700 active:scale-95 transition">
                            ✅ Sudah Diantar ke {{ $order->table->name }}
                        </button>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @else
        <div class="bg-white rounded-xl border border-gray-100 p-10 text-center mb-6">
            <p class="text-3xl mb-2">😴</p>
            <p class="font-medium text-gray-700">Tidak ada pesanan siap</p>
            <p class="text-xs text-gray-400 mt-1">Halaman ini refresh otomatis tiap 10 detik</p>
        </div>
        @endif

        {{-- Terakhir Diantar Hari Ini --}}
        @if($recentDelivered->isNotEmpty())
        <div>
            <h2 class="text-sm font-bold text-gray-500 mb-2 uppercase tracking-wide">Sudah Diantar Hari Ini</h2>
            <div class="space-y-2">
                @foreach($recentDelivered as $order)
                <div class="bg-white rounded-lg px-4 py-2.5 flex justify-between items-center opacity-60">
                    <div>
                        <p class="text-sm font-medium text-gray-700">#{{ $order->order_number }}</p>
                        <p class="text-xs text-gray-400">{{ $order->table->name }}</p>
                    </div>
                    <span class="text-xs text-green-600 font-medium">✓ Diantar</span>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>

<script>
const csrf = document.querySelector('meta[name="csrf-token"]').content;

async function markDelivered(orderId, btn) {
    btn.disabled = true;
    btn.textContent = 'Mengkonfirmasi...';

    await fetch(`/waiter/orders/${orderId}/delivered`, {
        method: 'PATCH',
        headers: { 'X-CSRF-TOKEN': csrf, 'Content-Type': 'application/json' }
    });

    location.reload();
}

setTimeout(() => location.reload(), 10000);
</script>
</body>
</html>
