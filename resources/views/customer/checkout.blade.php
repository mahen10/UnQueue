@extends('layouts.customer')
@section('title', 'Ringkasan Pesanan')

@section('content')
<div class="px-4 py-4">
    <h1 class="text-xl font-bold text-gray-900 mb-4">Ringkasan Pesanan</h1>

    {{-- Daftar item --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 mb-4 divide-y divide-gray-100">
        @foreach($cart as $item)
        <div class="px-4 py-3 flex justify-between items-start gap-4">
            <div class="flex-grow">
                <p class="font-medium text-gray-900 text-sm">
                    <span class="text-gray-400 mr-1">{{ $item['qty'] }}×</span>{{ $item['name'] }}
                </p>
                @if($item['modifier_label'])
                    <p class="text-xs text-gray-400 mt-0.5">{{ $item['modifier_label'] }}</p>
                @endif
                @if($item['note'])
                    <p class="text-xs text-gray-300 italic mt-0.5">{{ $item['note'] }}</p>
                @endif
            </div>
            <p class="text-sm font-semibold text-gray-800 flex-shrink-0">
                Rp {{ number_format($item['unit_price'] * $item['qty'], 0, ',', '.') }}
            </p>
        </div>
        @endforeach
    </div>

    {{-- Rincian Biaya --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 mb-4">
        <h3 class="font-semibold text-gray-800 mb-3 text-sm">Rincian Pembayaran</h3>
        <div class="space-y-2 text-sm">
            <div class="flex justify-between text-gray-600">
                <span>Subtotal</span>
                <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
            </div>
            @if($taxAmount > 0)
            <div class="flex justify-between text-gray-500">
                <span>PPN {{ $shop->tax_percent }}%</span>
                <span>Rp {{ number_format($taxAmount, 0, ',', '.') }}</span>
            </div>
            @endif
            @if($serviceCharge > 0)
            <div class="flex justify-between text-gray-500">
                <span>Service Charge {{ $shop->service_charge_percent }}%</span>
                <span>Rp {{ number_format($serviceCharge, 0, ',', '.') }}</span>
            </div>
            @endif
            <div class="border-t border-gray-100 pt-2 flex justify-between font-bold text-gray-900 text-base">
                <span>Total</span>
                <span class="text-blue-600">Rp {{ number_format($total, 0, ',', '.') }}</span>
            </div>
        </div>
    </div>

    {{-- Catatan order --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 mb-24">
        <label class="block text-sm font-medium text-gray-700 mb-1">Catatan untuk Dapur</label>
        <textarea id="order-note" name="order_note" rows="2"
            placeholder="Misal: alergi kacang, pisahkan saus..."
            class="w-full text-sm border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
    </div>
</div>

{{-- Bottom CTA --}}
<div class="fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 p-4 bottom-bar">
    <div class="max-w-lg mx-auto">
        <form id="checkout-form" action="{{ route('customer.checkout.place') }}" method="POST">
            @csrf
            <input type="hidden" name="order_note" id="hidden-note">
            <button type="submit"
                onclick="document.getElementById('hidden-note').value = document.getElementById('order-note').value"
                class="block w-full bg-blue-600 text-white text-center font-semibold py-3.5 rounded-xl hover:bg-blue-700 active:scale-95 transition">
                Bayar Sekarang — Rp {{ number_format($total, 0, ',', '.') }}
            </button>
        </form>
        <a href="{{ route('customer.cart') }}" class="block text-center text-sm text-gray-400 mt-2">← Kembali ke Keranjang</a>
    </div>
</div>
@endsection
