@extends('layouts.customer')
@section('title', 'Status Pesanan')

@section('content')
<div class="px-4 py-6">

    {{-- Header Status --}}
    <div class="text-center mb-6">
        @if($order->isPaid())
            <div class="w-20 h-20 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-3">
                <svg class="w-10 h-10 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <h2 class="text-xl font-bold text-gray-900">Pesanan Sedang Diproses</h2>
            <p class="text-sm text-gray-500 mt-1">Menunggu konfirmasi dari dapur...</p>

        @elseif($order->isProcessing())
            <div class="w-20 h-20 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-3">
                <span class="text-4xl">👨‍🍳</span>
            </div>
            <h2 class="text-xl font-bold text-gray-900">Sedang Dimasak!</h2>
            <p class="text-sm text-gray-500 mt-1">Dapur sedang menyiapkan pesanan Anda</p>

        @elseif($order->isReady())
            <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-3">
                <span class="text-4xl">🛎️</span>
            </div>
            <h2 class="text-xl font-bold text-green-700">Pesanan Siap!</h2>
            <p class="text-sm text-gray-500 mt-1">Pelayan akan segera mengantarkan ke meja Anda</p>

        @elseif($order->isDelivered())
            <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-3">
                <span class="text-4xl">✅</span>
            </div>
            <h2 class="text-xl font-bold text-gray-900">Selamat Menikmati!</h2>
            <p class="text-sm text-gray-500 mt-1">Pesanan sudah diantarkan. Terima kasih!</p>

        @elseif($order->isCancelled())
            <div class="w-20 h-20 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-3">
                <span class="text-4xl">❌</span>
            </div>
            <h2 class="text-xl font-bold text-red-700">Pesanan Dibatalkan</h2>
            <p class="text-sm text-gray-500 mt-1">Pesanan ini telah dibatalkan</p>
        @endif
    </div>

    {{-- Progress Steps --}}
    <div class="flex items-center justify-between px-4 mb-6">
        @php
            $steps = [
                ['icon' => '💳', 'label' => 'Bayar', 'done' => !$order->isPending()],
                ['icon' => '👨‍🍳', 'label' => 'Masak', 'done' => $order->isProcessing() || $order->isReady() || $order->isDelivered()],
                ['icon' => '🛎️', 'label' => 'Siap', 'done' => $order->isReady() || $order->isDelivered()],
                ['icon' => '✅', 'label' => 'Sampai', 'done' => $order->isDelivered()],
            ];
        @endphp
        @foreach($steps as $i => $step)
            <div class="flex flex-col items-center">
                <div class="w-10 h-10 rounded-full flex items-center justify-center text-lg
                    {{ $step['done'] ? 'bg-blue-500' : 'bg-gray-100' }}">
                    {{ $step['icon'] }}
                </div>
                <span class="text-xs mt-1 {{ $step['done'] ? 'text-blue-600 font-semibold' : 'text-gray-400' }}">
                    {{ $step['label'] }}
                </span>
            </div>
            @if(!$loop->last)
            <div class="flex-grow h-0.5 mx-1 {{ $step['done'] ? 'bg-blue-300' : 'bg-gray-200' }}"></div>
            @endif
        @endforeach
    </div>

    {{-- Info Order --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 mb-4">
        <div class="flex justify-between text-sm mb-2">
            <span class="text-gray-500">No. Order</span>
            <span class="font-mono font-bold text-gray-900">#{{ $order->order_number }}</span>
        </div>
        <div class="flex justify-between text-sm mb-2">
            <span class="text-gray-500">Meja</span>
            <span class="font-medium text-gray-900">{{ $order->table->name }}</span>
        </div>
        <div class="flex justify-between text-sm">
            <span class="text-gray-500">Total Bayar</span>
            <span class="font-bold text-blue-600">Rp {{ number_format($order->total, 0, ',', '.') }}</span>
        </div>
    </div>

    {{-- Detail Item Pesanan --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 mb-4">
        <h3 class="font-semibold text-gray-800 text-sm mb-3">Detail Pesanan</h3>
        <div class="space-y-3">
            @foreach($order->items as $item)
            <div class="flex justify-between items-start">
                <div class="flex-grow">
                    <p class="text-sm font-medium text-gray-900">
                        {{ $item->quantity }}× {{ $item->item_name }}
                    </p>
                    @if($item->modifiers && count($item->modifiers) > 0)
                        <p class="text-xs text-gray-400 mt-0.5">
                            @foreach($item->modifiers as $mod)
                                {{ $mod['modifier_name'] ?? '' }}: {{ $mod['option_label'] ?? '' }}@if(!$loop->last), @endif
                            @endforeach
                        </p>
                    @endif
                    @if($item->notes)
                        <p class="text-xs text-gray-400 italic mt-0.5">{{ $item->notes }}</p>
                    @endif
                </div>
                <span class="text-sm font-medium text-gray-700 ml-2 flex-shrink-0">
                    Rp {{ number_format($item->item_price * $item->quantity, 0, ',', '.') }}
                </span>
            </div>
            @endforeach
        </div>
    </div>

    {{-- Auto refresh setiap 10 detik kalau masih belum delivered --}}
    @if(!$order->isDelivered() && !$order->isCancelled())
    <p class="text-center text-xs text-gray-400 mb-4">
        Halaman ini otomatis refresh setiap 10 detik...
    </p>
    <script>
        setTimeout(() => location.reload(), 10000);
    </script>
    @endif

    {{-- Tombol pesan lagi --}}
    @if($order->isDelivered())
    <a href="{{ route('customer.menu') }}"
       class="block w-full bg-blue-600 text-white text-center font-semibold py-3.5 rounded-xl hover:bg-blue-700">
        Pesan Lagi 🍽️
    </a>
    @endif

</div>
@endsection
