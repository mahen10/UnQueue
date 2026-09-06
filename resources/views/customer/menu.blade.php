@extends('layouts.customer')
@section('title', 'Menu')

@section('content')
{{-- Pesan sukses ditambah ke keranjang --}}
<div x-data="{ toast: '', show: false }" @cart-added.window="toast = $event.detail.message; show = true; setTimeout(() => show = false, 2500)">
    <div x-show="show" x-transition
        class="fixed top-20 left-1/2 -translate-x-1/2 z-50 bg-gray-900 text-white text-sm px-5 py-2.5 rounded-full shadow-lg whitespace-nowrap"
        style="display:none">
        ✅ <span x-text="toast"></span>
    </div>
</div>

{{-- Kategori Quick Nav --}}
<div class="bg-white px-4 py-3 flex gap-3 overflow-x-auto sticky top-16 z-40 shadow-sm scrollbar-hide">
    @foreach($categories as $cat)
        @if($cat->menuItems->count() > 0)
        <a href="#cat-{{ $cat->id }}" class="flex-shrink-0 text-sm font-medium text-gray-600 hover:text-blue-600 bg-gray-100 px-3 py-1.5 rounded-full whitespace-nowrap">
            {{ $cat->name }}
        </a>
        @endif
    @endforeach
</div>

{{-- Daftar Menu Per Kategori --}}
<div class="px-4 py-4 space-y-8">
    @forelse($categories as $cat)
        @if($cat->menuItems->count() > 0)
        <div id="cat-{{ $cat->id }}">
            <h2 class="text-lg font-bold text-gray-800 mb-4 border-b-2 border-blue-500 pb-2">{{ $cat->name }}</h2>
            
            <div class="space-y-3">
                @foreach($cat->menuItems as $item)
                <div class="bg-white rounded-xl shadow-sm overflow-hidden flex gap-3 p-3 cursor-pointer"
                     x-data="menuItem({{ $item->id }}, '{{ addslashes($item->name) }}', {{ $item->price }})"
                     @click="openModal()">
                    
                    {{-- Foto --}}
                    <div class="flex-shrink-0 w-24 h-24 rounded-lg overflow-hidden bg-gray-200">
                        @if($item->photo)
                            <img src="{{ asset('storage/' . $item->photo) }}" alt="{{ $item->name }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-400">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                        @endif
                    </div>
                    
                    {{-- Info --}}
                    <div class="flex-grow flex flex-col justify-between py-0.5">
                        <div>
                            <h3 class="font-semibold text-gray-900 text-sm leading-tight">{{ $item->name }}</h3>
                            @if($item->labels)
                            <div class="flex gap-1 mt-1 flex-wrap">
                                @foreach($item->labels as $label)
                                <span class="text-xs bg-blue-50 text-blue-600 px-1.5 py-0.5 rounded">{{ $label }}</span>
                                @endforeach
                            </div>
                            @endif
                            @if($item->description)
                            <p class="text-xs text-gray-400 mt-1 line-clamp-2">{{ $item->description }}</p>
                            @endif
                        </div>
                        <div class="flex justify-between items-center mt-2">
                            <span class="font-bold text-blue-600 text-sm">Rp {{ number_format($item->price, 0, ',', '.') }}</span>
                            <div class="w-7 h-7 rounded-full bg-blue-600 flex items-center justify-center text-white">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    @empty
        <div class="py-16 text-center text-gray-400">
            <svg class="w-16 h-16 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
            <p>Menu belum tersedia.</p>
        </div>
    @endforelse
</div>

{{-- ========================
     MODAL DETAIL ITEM
     ======================== --}}
<div id="item-modal" class="fixed inset-0 z-50 hidden" x-data="itemModal()">
    {{-- Backdrop --}}
    <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" @click="close()"></div>

    {{-- Sheet dari bawah --}}
    <div class="absolute bottom-0 left-0 right-0 bg-white rounded-t-2xl max-h-[90vh] overflow-y-auto"
         id="modal-sheet"
         x-show="open"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="translate-y-full"
         x-transition:enter-end="translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="translate-y-0"
         x-transition:leave-end="translate-y-full">

        {{-- Loading state --}}
        <div x-show="loading" class="p-8 text-center text-gray-400">
            <p class="animate-pulse">Memuat...</p>
        </div>

        {{-- Item loaded --}}
        <div x-show="!loading && item">
            {{-- Foto Item --}}
            <div class="relative">
                <template x-if="item && item.photo">
                    <img :src="item.photo" :alt="item.name" class="w-full h-56 object-cover">
                </template>
                <template x-if="item && !item.photo">
                    <div class="w-full h-40 bg-gray-100 flex items-center justify-center text-gray-400">
                        <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                </template>
                <button @click="close()" class="absolute top-3 right-3 bg-white/80 rounded-full p-1.5 shadow">
                    <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <div class="p-4">
                <h2 class="text-xl font-bold text-gray-900" x-text="item.name"></h2>
                <p class="text-blue-600 font-bold text-lg mt-1" x-text="'Rp ' + totalPrice.toLocaleString('id-ID')"></p>
                <p class="text-sm text-gray-500 mt-2" x-text="item.description"></p>

                {{-- Modifiers --}}
                <template x-if="item && item.modifiers.length > 0">
                    <div class="mt-4 space-y-4">
                        <template x-for="modifier in item.modifiers" :key="modifier.id">
                            <div>
                                <h4 class="font-semibold text-sm text-gray-800 mb-2">
                                    <span x-text="modifier.name"></span>
                                    <span x-show="modifier.is_required" class="ml-1 text-xs font-normal text-red-500">(Wajib)</span>
                                </h4>
                                <div class="grid grid-cols-2 gap-2">
                                    <template x-for="(opt, i) in modifier.options" :key="i">
                                        <label class="flex items-center gap-2 border rounded-lg px-3 py-2 cursor-pointer"
                                               :class="isSelected(modifier.id, opt.label) ? 'border-blue-500 bg-blue-50' : 'border-gray-200'">
                                            <input type="radio" :name="'mod_' + modifier.id" :value="opt.label"
                                                   class="hidden"
                                                   @change="selectModifier(modifier, opt)">
                                            <div class="flex flex-col">
                                                <span class="text-sm font-medium text-gray-900" x-text="opt.label"></span>
                                                <span class="text-xs text-gray-500" x-text="opt.price > 0 ? '+Rp ' + Number(opt.price).toLocaleString('id-ID') : 'Gratis'"></span>
                                            </div>
                                        </label>
                                    </template>
                                </div>
                            </div>
                        </template>
                    </div>
                </template>

                {{-- Catatan --}}
                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Catatan (Opsional)</label>
                    <input type="text" x-model="note" placeholder="Misal: tidak pedas, tanpa es..."
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                {{-- Qty & Tombol Tambah --}}
                <div class="mt-5 flex items-center gap-4">
                    <div class="flex items-center border border-gray-300 rounded-lg overflow-hidden">
                        <button @click="qty > 1 && qty--" class="px-4 py-3 text-gray-600 hover:bg-gray-100 font-bold text-lg">−</button>
                        <span class="px-4 py-3 font-semibold text-lg min-w-[3rem] text-center" x-text="qty"></span>
                        <button @click="qty++" class="px-4 py-3 text-gray-600 hover:bg-gray-100 font-bold text-lg">+</button>
                    </div>
                    <button @click="addToCart()" :disabled="adding"
                            class="flex-grow bg-blue-600 text-white font-semibold py-3 rounded-lg hover:bg-blue-700 active:scale-95 transition disabled:opacity-60">
                        <span x-show="!adding">Tambah ke Keranjang</span>
                        <span x-show="adding">Menambahkan...</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// AlpineJS Component untuk tiap item di list menu
function menuItem(itemId, itemName, itemPrice) {
    return {
        id: itemId,
        openModal() {
            window.dispatchEvent(new CustomEvent('open-item-modal', { 
                detail: { id: this.id } 
            }));
        }
    };
}

// AlpineJS Component untuk modal detail item
function itemModal() {
    return {
        open: false,
        loading: false,
        item: null,
        qty: 1,
        note: '',
        selectedModifiers: {},
        adding: false,
        
        get totalPrice() {
            if (!this.item) return 0;
            let modTotal = Object.values(this.selectedModifiers).reduce((sum, m) => sum + parseFloat(m.option_price || 0), 0);
            return (this.item.price + modTotal) * this.qty;
        },
        
        init() {
            window.addEventListener('open-item-modal', async (e) => {
                this.open = true;
                this.loading = true;
                this.item = null;
                this.qty = 1;
                this.note = '';
                this.selectedModifiers = {};
                
                document.getElementById('item-modal').classList.remove('hidden');
                
                const res = await fetch(`/order/menu/${e.detail.id}`);
                this.item = await res.json();
                this.loading = false;
            });
        },
        
        isSelected(modifierId, optionLabel) {
            return this.selectedModifiers[modifierId]?.option_label === optionLabel;
        },
        
        selectModifier(modifier, opt) {
            this.selectedModifiers[modifier.id] = {
                modifier_id: modifier.id,
                modifier_name: modifier.name,
                option_label: opt.label,
                option_price: opt.price,
            };
        },
        
        close() {
            this.open = false;
            setTimeout(() => {
                document.getElementById('item-modal').classList.add('hidden');
            }, 200);
        },
        
        async addToCart() {
            // Validasi modifier wajib
            for (const mod of this.item.modifiers) {
                if (mod.is_required && !this.selectedModifiers[mod.id]) {
                    alert(`Pilih dulu: ${mod.name}`);
                    return;
                }
            }
            
            this.adding = true;
            
            const res = await fetch('/order/cart/add', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                },
                body: JSON.stringify({
                    menu_item_id: this.item.id,
                    qty: this.qty,
                    note: this.note,
                    selected_modifiers: Object.values(this.selectedModifiers),
                })
            });
            
            const data = await res.json();
            this.adding = false;
            
            if (data.success) {
                // Update badge keranjang di header
                const badge = document.querySelector('[data-cart-badge]');
                if (badge) badge.textContent = data.cart_count;
                
                // Reload halaman agar badge terlihat
                this.close();
                setTimeout(() => {
                    window.dispatchEvent(new CustomEvent('cart-added', {
                        detail: { message: data.message }
                    }));
                    // Refresh halaman setelah toast
                    setTimeout(() => location.reload(), 1000);
                }, 200);
            }
        }
    };
}
</script>
@endsection
