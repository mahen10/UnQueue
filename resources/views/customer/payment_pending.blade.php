@extends('layouts.customer')
@section('title', 'Pembayaran')

@section('content')
<div class="px-4 py-8 flex flex-col items-center min-h-screen">

    @if(session('error'))
    <div class="w-full bg-red-50 border border-red-100 text-red-600 text-sm p-3 rounded-lg mb-4">
        {{ session('error') }}
    </div>
    @endif

    {{-- Nomor Order --}}
    <p class="text-xs text-gray-400 mb-2">Order #{{ $order->order_number }}</p>

    @if($isDummy)
    {{-- ============================================================
         MODE SIMULASI — tampil hanya di development/local
         ============================================================ --}}
    <div class="w-full max-w-sm bg-amber-50 border-2 border-dashed border-amber-300 rounded-2xl p-6 text-center mb-6">
        <div class="text-4xl mb-3">🧪</div>
        <p class="text-xs font-bold uppercase tracking-widest text-amber-600 mb-1">Mode Simulasi</p>
        <h2 class="text-xl font-bold text-gray-900 mb-1">
            Rp {{ number_format($order->total, 0, ',', '.') }}
        </h2>
        <p class="text-xs text-gray-500 mb-5">
            Meja: {{ $order->table->name }} · {{ $order->items->count() }} item
        </p>

        <p class="text-xs text-gray-400 mb-4">
            Di production, halaman ini akan menampilkan QRIS dari Xendit/Midtrans.
            Untuk sekarang, pilih simulasi di bawah:
        </p>

        <div class="space-y-3">
            <form action="{{ route('customer.checkout.simulate.success', $order) }}" method="POST">
                @csrf
                <button type="submit"
                    class="w-full bg-green-500 text-white font-bold py-3.5 rounded-xl hover:bg-green-600 active:scale-95 transition flex items-center justify-center gap-2">
                    <span class="text-xl">✅</span>
                    Simulasi Bayar Berhasil
                </button>
            </form>

            <form action="{{ route('customer.checkout.simulate.fail', $order) }}" method="POST">
                @csrf
                <button type="submit"
                    class="w-full bg-gray-100 text-gray-600 font-medium py-3 rounded-xl hover:bg-gray-200 active:scale-95 transition flex items-center justify-center gap-2">
                    <span>❌</span>
                    Simulasi Bayar Gagal
                </button>
            </form>
        </div>
    </div>

    @else
    {{-- ============================================================
         PRODUCTION — Tampil QRIS/Midtrans di sini
         ============================================================ --}}
    <div class="w-full max-w-sm bg-white rounded-2xl shadow-sm border border-gray-100 p-6 text-center mb-6">
        <div class="w-16 h-16 bg-blue-50 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8 text-blue-500 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
        </div>
        <h2 class="text-xl font-bold text-gray-900">Menunggu Pembayaran</h2>
        <p class="text-3xl font-bold text-blue-600 mt-2">
            Rp {{ number_format($order->total, 0, ',', '.') }}
        </p>
        <p class="text-sm text-gray-500 mt-2">Order #{{ $order->order_number }}</p>

        @if($order->payment && $order->payment->xendit_invoice_url)
        <a href="{{ $order->payment->xendit_invoice_url }}"
           class="mt-6 block w-full bg-blue-600 text-white font-bold py-3.5 rounded-xl hover:bg-blue-700">
            Buka Halaman Pembayaran
        </a>
        @endif
    </div>
    @endif

    {{-- Daftar Item Pesanan --}}
    <div class="w-full max-w-sm bg-white rounded-xl shadow-sm border border-gray-100 p-4">
        <h3 class="font-semibold text-gray-800 text-sm mb-3">Pesanan Anda</h3>
        <div class="space-y-2">
            @foreach($order->items as $item)
            <div class="flex justify-between text-sm">
                <span class="text-gray-600">
                    {{ $item->quantity }}× {{ $item->item_name }}
                    @if($item->notes)
                        <span class="text-gray-400 italic text-xs block ml-4">{{ $item->notes }}</span>
                    @endif
                </span>
                <span class="text-gray-800 font-medium flex-shrink-0 ml-2">
                    Rp {{ number_format($item->item_price * $item->quantity, 0, ',', '.') }}
                </span>
            </div>
            @endforeach
        </div>
    </div>

</div>
@endsection
