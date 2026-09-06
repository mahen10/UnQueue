@extends('layouts.customer')
@section('title', 'Keranjang')

@section('content')
<div class="px-4 py-4" x-data="cartPage()">
    
    <h1 class="text-xl font-bold text-gray-900 mb-4">Keranjang Pesanan</h1>
    
    @if(empty($cart))
        {{-- Empty cart --}}
        <div class="py-16 text-center text-gray-400">
            <svg class="w-16 h-16 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-9H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
            </svg>
            <p class="font-medium">Keranjang masih kosong</p>
            <a href="{{ route('customer.menu') }}" class="mt-3 inline-block text-blue-600 font-medium text-sm">← Kembali ke Menu</a>
        </div>
    @else
        {{-- Cart Items --}}
        <div class="space-y-3 mb-6">
            @foreach($cart as $key => $item)
            <div class="bg-white rounded-xl shadow-sm p-4 flex gap-4 items-start" id="cart-item-{{ $key }}">
                <div class="flex-grow">
                    <h3 class="font-semibold text-gray-900 text-sm">{{ $item['name'] }}</h3>
                    @if($item['modifier_label'])
                        <p class="text-xs text-gray-500 mt-0.5">{{ $item['modifier_label'] }}</p>
                    @endif
                    @if($item['note'])
                        <p class="text-xs text-gray-400 mt-0.5 italic">Catatan: {{ $item['note'] }}</p>
                    @endif
                    <p class="text-blue-600 font-bold text-sm mt-1">
                        Rp {{ number_format($item['unit_price'], 0, ',', '.') }}
                    </p>
                </div>
                
                {{-- Qty controls --}}
                <div class="flex items-center gap-2 flex-shrink-0">
                    <button @click="updateQty('{{ $key }}', {{ $item['qty'] }} - 1)"
                            class="w-7 h-7 rounded-full border border-gray-300 flex items-center justify-center text-gray-600 hover:bg-gray-100 font-bold">
                        −
                    </button>
                    <span class="text-sm font-semibold w-6 text-center">{{ $item['qty'] }}</span>
                    <button @click="updateQty('{{ $key }}', {{ $item['qty'] }} + 1)"
                            class="w-7 h-7 rounded-full border border-gray-300 flex items-center justify-center text-gray-600 hover:bg-gray-100 font-bold">
                        +
                    </button>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Order Summary --}}
        <div class="bg-white rounded-xl shadow-sm p-4 mb-4">
            <h3 class="font-semibold text-gray-800 mb-3">Ringkasan Pesanan</h3>
            <div class="space-y-1.5">
                <div class="flex justify-between text-sm text-gray-600">
                    <span>Subtotal</span>
                    <span id="subtotal-display">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between text-sm text-gray-500">
                    <span>Pajak & biaya layanan</span>
                    <span>Dihitung saat checkout</span>
                </div>
                <div class="border-t border-gray-100 pt-1.5 mt-1.5 flex justify-between font-bold text-gray-900">
                    <span>Total (estimasi)</span>
                    <span id="total-display">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

        {{-- Catatan Tambahan --}}
        <div class="bg-white rounded-xl shadow-sm p-4 mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-1">Catatan untuk Dapur</label>
            <textarea name="order_note" rows="2" placeholder="Misal: alergi kacang, pisahkan saus..."
                class="w-full text-sm border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                id="order-note"></textarea>
        </div>

        {{-- Bottom Action Bar --}}
        <div class="fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 p-4 bottom-bar">
            <div class="max-w-lg mx-auto">
                <a href="{{ route('customer.checkout') }}"
                   class="block w-full bg-blue-600 text-white text-center font-semibold py-3.5 rounded-xl hover:bg-blue-700 active:scale-95 transition">
                    Lanjut ke Pembayaran
                </a>
                <a href="{{ route('customer.menu') }}" class="block text-center text-sm text-gray-500 mt-2">
                    ← Tambah lagi
                </a>
            </div>
        </div>
    @endif
</div>

<script>
function cartPage() {
    return {
        async updateQty(key, newQty) {
            const res = await fetch(`/order/cart/${key}`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                },
                body: JSON.stringify({ qty: newQty })
            });
            const data = await res.json();
            if (data.success) {
                // Reload halaman untuk update tampilan
                location.reload();
            }
        }
    };
}
</script>
@endsection
