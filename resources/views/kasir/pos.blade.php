<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>POS Kasir — {{ $shop->name }}</title>
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-100 min-h-screen">

{{-- Top Nav --}}
<div class="bg-white border-b border-gray-200 px-6 py-3 flex justify-between items-center">
    <div class="flex items-center gap-3">
        <span class="text-2xl">🧾</span>
        <div>
            <h1 class="font-bold text-gray-900">Dashboard Kasir</h1>
            <p class="text-xs text-gray-400">{{ $shop->name }}</p>
        </div>
    </div>
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button class="text-sm text-gray-500 hover:text-red-600">Logout</button>
    </form>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

    {{-- Stats Hari Ini --}}
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-6">
        <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100">
            <p class="text-xs text-gray-500">Pendapatan Hari Ini</p>
            <p class="text-xl font-bold text-green-600 mt-1">Rp {{ number_format($todayRevenue, 0, ',', '.') }}</p>
        </div>
        <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100">
            <p class="text-xs text-gray-500">Total Pesanan</p>
            <p class="text-xl font-bold text-blue-600 mt-1">{{ $todayOrderCount }}</p>
        </div>
        <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100">
            <p class="text-xs text-gray-500">Aktif Sekarang</p>
            <p class="text-xl font-bold text-orange-600 mt-1">{{ $activeOrders->count() }}</p>
        </div>
        <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100">
            <p class="text-xs text-gray-500">Siap Diantar</p>
            <p class="text-xl font-bold text-purple-600 mt-1">{{ $activeOrders->where('status', 'ready')->count() }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        {{-- Panel Kiri: Order Aktif --}}
        <div>
            <h2 class="text-lg font-bold text-gray-900 mb-3">⚡ Order Aktif</h2>

            @if($activeOrders->isEmpty())
                <div class="bg-white rounded-xl p-8 text-center text-gray-400 shadow-sm border border-gray-100">
                    <p class="text-4xl mb-2">✅</p>
                    <p>Tidak ada pesanan aktif</p>
                </div>
            @else
                <div class="space-y-3">
                    @foreach($activeOrders as $order)
                    <div class="bg-white rounded-xl shadow-sm border-l-4 overflow-hidden
                        {{ $order->status === 'paid' ? 'border-blue-500' : ($order->status === 'processing' ? 'border-orange-500' : 'border-green-500') }}">
                        <div class="px-4 py-3 flex justify-between items-start gap-3">
                            <div class="flex-grow">
                                <div class="flex items-center gap-2 mb-1">
                                    <p class="font-bold text-gray-900 text-sm">#{{ $order->order_number }}</p>
                                    <span class="text-xs px-2 py-0.5 rounded-full font-medium
                                        {{ $order->status === 'paid' ? 'bg-blue-100 text-blue-700' : ($order->status === 'processing' ? 'bg-orange-100 text-orange-700' : 'bg-green-100 text-green-700') }}">
                                        {{ $order->status === 'paid' ? 'Menunggu Dapur' : ($order->status === 'processing' ? 'Sedang Dimasak' : '✅ Siap Diantar') }}
                                    </span>
                                </div>
                                <p class="text-xs text-gray-500 mb-2">{{ $order->table->name }} · {{ $order->created_at->diffForHumans() }}</p>

                                <div class="text-sm text-gray-700 space-y-0.5">
                                    @foreach($order->items->take(3) as $item)
                                    <p>{{ $item->quantity }}× {{ $item->item_name }}</p>
                                    @endforeach
                                    @if($order->items->count() > 3)
                                    <p class="text-gray-400 text-xs">+{{ $order->items->count() - 3 }} item lainnya</p>
                                    @endif
                                </div>
                            </div>

                            <div class="text-right flex-shrink-0">
                                <p class="font-bold text-gray-900">Rp {{ number_format($order->total, 0, ',', '.') }}</p>
                                @if($order->status === 'ready')
                                <button onclick="markDelivered({{ $order->id }}, this)"
                                    class="mt-2 text-xs bg-green-600 text-white px-3 py-1.5 rounded-lg hover:bg-green-700 font-medium">
                                    Antar ✓
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
        <div>
            <h2 class="text-lg font-bold text-gray-900 mb-3">📋 Riwayat Hari Ini</h2>
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                @if($todayOrders->isEmpty())
                    <div class="p-8 text-center text-gray-400">Belum ada pesanan hari ini.</div>
                @else
                    <div class="divide-y divide-gray-100">
                        @foreach($todayOrders as $order)
                        <div class="px-4 py-3 flex justify-between items-center">
                            <div>
                                <p class="font-medium text-sm text-gray-900">#{{ $order->order_number }}</p>
                                <p class="text-xs text-gray-400">{{ $order->table->name }} · {{ $order->created_at->format('H:i') }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-bold text-gray-900">Rp {{ number_format($order->total, 0, ',', '.') }}</p>
                                <span class="text-xs px-2 py-0.5 rounded-full
                                    {{ $order->status === 'delivered' ? 'bg-gray-100 text-gray-500' :
                                       ($order->status === 'cancelled' ? 'bg-red-100 text-red-600' :
                                        'bg-blue-100 text-blue-600') }}">
                                    {{ match($order->status) {
                                        'delivered' => 'Selesai',
                                        'cancelled' => 'Batal',
                                        'ready' => 'Siap',
                                        'processing' => 'Dimasak',
                                        default => 'Aktif'
                                    } }}
                                </span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

    </div>
</div>

<script>
const csrf = document.querySelector('meta[name="csrf-token"]').content;

async function markDelivered(orderId, btn) {
    btn.disabled = true;
    btn.textContent = '...';
    await fetch(`/kasir/pos/${orderId}/deliver`, {
        method: 'PATCH',
        headers: { 'X-CSRF-TOKEN': csrf, 'Content-Type': 'application/json' }
    });
    location.reload();
}

// Auto refresh setiap 15 detik
setTimeout(() => location.reload(), 15000);
</script>
</body>
</html>
