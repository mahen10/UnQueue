@extends('layouts.customer')
@section('title', 'Menu ' . ($shopName ?? ''))

@section('content')
<div x-data="itemModal()" x-init="init()">
    
    {{-- Category & Search Bar (Sticky) --}}
    <div class="sticky top-[80px] bg-white/95 backdrop-blur-md z-30 pt-2 pb-4 px-5">
        <div class="flex items-center gap-3 overflow-x-auto hide-scrollbar">
            {{-- Search Bar (Lebar) --}}
            <div class="flex-shrink-0 relative w-48">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <input type="text" placeholder="Cari menu..." class="block w-full pl-9 pr-4 py-2.5 bg-gray-100 border-transparent rounded-full text-[13px] font-medium focus:border-gray-500 focus:bg-white focus:ring-0 transition">
            </div>
            
            {{-- Category Pills --}}
            <div class="flex items-center gap-2" x-data="{ active: 'cat-{{ $categories->first()?->id }}' }">
                @foreach($categories as $category)
                    <a href="#cat-{{ $category->id }}" 
                       @click="active = 'cat-{{ $category->id }}'"
                       :class="active === 'cat-{{ $category->id }}' ? 'bg-[#111] text-white' : 'bg-gray-100 text-gray-900'"
                       class="flex-shrink-0 px-5 py-2.5 rounded-full text-[13px] font-bold transition">
                        {{ $category->name }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Menu Grid Sections --}}
    <div class="px-5 mt-2 space-y-12 pb-10">
        @foreach($categories as $category)
            @if($category->menuItems->count() > 0)
            <div id="cat-{{ $category->id }}" class="scroll-mt-[150px]">
                <h2 class="text-[22px] font-extrabold text-gray-900 tracking-tight mb-5">{{ $category->name }}</h2>
                
                <div class="grid grid-cols-2 gap-x-4 gap-y-8">
                    @foreach($category->menuItems as $item)
                        <div class="flex flex-col items-center group cursor-pointer" x-data="menuItem({{ $item->id }})" @click="openModal">
                            {{-- Image Card (Dikunci Ukurannya) --}}
                            <div class="w-full aspect-square max-w-[160px] bg-gray-50/80 rounded-[28px] p-4 flex items-center justify-center relative mb-3 transition-colors group-hover:bg-gray-100">
                                @if($item->photo)
                                    <img src="{{ asset('storage/' . $item->photo) }}" alt="{{ $item->name }}" class="object-contain w-full h-full drop-shadow-xl group-hover:scale-105 transition-transform duration-300">
                                @else
                                    <div class="w-20 h-20 bg-gray-200 rounded-full flex items-center justify-center">
                                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    </div>
                                @endif
                            </div>
                            
                            {{-- Item Info --}}
                            <h3 class="text-[14px] font-bold text-gray-900 text-center leading-tight mb-1 line-clamp-2">{{ $item->name }}</h3>
                            <p class="text-[12px] font-medium text-gray-400 mb-3">{{ $item->description ? Str::limit($item->description, 20) : '1 Porsi' }}</p>
                            
                            {{-- Price Button --}}
                            <button class="bg-gray-100 text-gray-900 text-[13px] font-extrabold px-4 py-2 rounded-full flex items-center justify-center w-max group-hover:bg-gray-200 transition mt-auto">
                                + Rp {{ number_format($item->price, 0, ',', '.') }}
                            </button>
                        </div>
                    @endforeach
                </div>
            </div>
            @endif
        @endforeach
    </div>

    {{-- Floating Bottom Action Bar (Khusus Keranjang) --}}
    @if(isset($cartCount) && $cartCount > 0)
    <div class="fixed bottom-6 left-0 right-0 z-40 flex justify-center pointer-events-none px-4">
        <div class="relative pointer-events-auto w-full max-w-sm flex items-center bg-[#111] text-white p-2 rounded-full shadow-2xl border border-gray-800 ring-1 ring-black/5">
            <a href="{{ route('customer.cart') }}" class="flex-1 flex items-center justify-between px-4 py-2 rounded-full hover:bg-black transition active:scale-95">
                <div class="flex items-center gap-3">
                    <div class="relative">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                        <span class="absolute -top-1.5 -right-1.5 bg-red-500 text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full border-2 border-[#111]">{{ $cartCount }}</span>
                    </div>
                    <span class="text-[14px] font-bold">Lihat Keranjang</span>
                </div>
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path></svg>
            </a>
        </div>
    </div>
    @endif

    {{-- Item Detail Modal (Slide Up Drawer) --}}
    <div id="item-modal" class="fixed inset-0 z-[60] hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true" x-show="open" x-transition.opacity>
        <!-- Background overlay -->
        <div class="fixed inset-0 bg-black/40 backdrop-blur-sm transition-opacity" @click="close()"></div>

        <!-- Modal panel -->
        <div class="fixed inset-x-0 bottom-0 z-10 w-full transform transition-transform duration-300 max-h-[90vh] flex flex-col bg-white rounded-t-3xl shadow-2xl max-w-md mx-auto"
             x-show="open"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="translate-y-full"
             x-transition:enter-end="translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="translate-y-0"
             x-transition:leave-end="translate-y-full">
            
            <!-- Handle indicator -->
            <div class="w-full flex justify-center pt-3 pb-1" @click="close()">
                <div class="w-12 h-1.5 bg-gray-300 rounded-full cursor-pointer hover:bg-gray-400"></div>
            </div>

            <!-- Loading State -->
            <div x-show="loading" class="p-8 flex justify-center items-center min-h-[300px]">
                <div class="animate-spin rounded-full h-10 w-10 border-b-2 border-gray-900"></div>
            </div>

            <!-- Item Content -->
            <div x-show="!loading && item" class="flex-1 overflow-y-auto px-6 pb-28 custom-scrollbar">
                
                {{-- Image --}}
                <div class="w-full aspect-square bg-gray-50 rounded-[32px] p-8 flex items-center justify-center mb-6 mt-2 relative">
                    <template x-if="item && item.photo">
                        <img :src="item.photo" :alt="item.name" class="object-contain w-full h-full drop-shadow-2xl">
                    </template>
                </div>

                {{-- Title & Price --}}
                <h2 class="text-2xl font-extrabold text-gray-900 tracking-tight" x-text="item ? item.name : ''"></h2>
                <p class="text-gray-500 font-medium text-sm mt-2" x-text="item ? item.description : ''"></p>
                <p class="text-xl font-black text-gray-900 mt-4" x-text="'Rp ' + (item ? item.price.toLocaleString('id-ID') : 0)"></p>

                {{-- Modifiers --}}
                <template x-if="item && item.modifiers.length > 0">
                    <div class="mt-8 space-y-6">
                        <template x-for="modifier in item.modifiers" :key="modifier.id">
                            <div>
                                <h4 class="font-bold text-[15px] text-gray-900 mb-3 flex items-center justify-between">
                                    <span x-text="modifier.name"></span>
                                    <span x-show="modifier.is_required" class="bg-red-50 text-red-600 text-[10px] uppercase tracking-wider px-2.5 py-1 rounded-full font-bold">Wajib</span>
                                </h4>
                                <div class="space-y-2">
                                    <template x-for="(opt, i) in modifier.options" :key="i">
                                        <label class="flex items-center justify-between border-2 rounded-2xl px-4 py-3 cursor-pointer transition-colors"
                                               :class="isSelected(modifier.id, opt.label) ? 'border-gray-900 bg-gray-50' : 'border-gray-100 hover:border-gray-200'">
                                            <div class="flex items-center gap-3">
                                                <input type="radio" :name="'mod_' + modifier.id" :value="opt.label"
                                                       class="w-5 h-5 text-gray-900 focus:ring-gray-900 border-gray-300"
                                                       @change="selectModifier(modifier, opt)">
                                                <span class="text-sm font-bold text-gray-900" x-text="opt.label"></span>
                                            </div>
                                            <span class="text-sm font-medium text-gray-500" x-text="opt.price > 0 ? '+ Rp ' + Number(opt.price).toLocaleString('id-ID') : 'Gratis'"></span>
                                        </label>
                                    </template>
                                </div>
                            </div>
                        </template>
                    </div>
                </template>

                {{-- Notes --}}
                <div class="mt-8">
                    <label class="block text-[15px] font-bold text-gray-900 mb-3">Catatan (Opsional)</label>
                    <textarea x-model="note" rows="2" placeholder="Misal: Kurangi es, tidak pedas..."
                           class="w-full bg-gray-50 border-0 rounded-2xl px-4 py-3 text-sm focus:ring-2 focus:ring-gray-900 transition resize-none"></textarea>
                </div>
            </div>

            <!-- Sticky Bottom Add To Cart -->
            <div x-show="!loading && item" class="absolute bottom-0 left-0 right-0 bg-white border-t border-gray-100 px-6 py-4 pb-8 flex items-center gap-4">
                <div class="flex items-center bg-gray-100 rounded-full overflow-hidden h-14">
                    <button @click="qty > 1 && qty--" class="w-12 h-full text-gray-600 hover:bg-gray-200 font-bold text-xl flex items-center justify-center transition">-</button>
                    <span class="w-10 font-black text-lg text-center leading-[56px]" x-text="qty"></span>
                    <button @click="qty++" class="w-12 h-full text-gray-600 hover:bg-gray-200 font-bold text-xl flex items-center justify-center transition">+</button>
                </div>
                <button @click="addToCart()" :disabled="adding"
                        class="flex-1 bg-[#111] text-white h-14 rounded-full font-bold text-[15px] shadow-lg hover:bg-black active:scale-95 transition-all disabled:opacity-70 flex justify-between items-center px-6">
                    <span x-show="!adding">Tambah</span>
                    <span x-show="adding">Loading...</span>
                    <span class="bg-white/20 px-3 py-1 rounded-full text-sm" x-text="'Rp ' + totalPrice.toLocaleString('id-ID')"></span>
                </button>
            </div>
        </div>
    </div>
</div>

<script>
function menuItem(itemId) {
    return {
        id: itemId,
        openModal() {
            window.dispatchEvent(new CustomEvent('open-item-modal', { 
                detail: { id: this.id } 
            }));
        }
    };
}

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
                
                try {
                    const res = await fetch(`/order/menu/${e.detail.id}`);
                    this.item = await res.json();
                } catch (err) {
                    console.error("Gagal load item", err);
                } finally {
                    this.loading = false;
                }
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
            }, 300);
        },
        
        async addToCart() {
            for (const mod of this.item.modifiers) {
                if (mod.is_required && !this.selectedModifiers[mod.id]) {
                    alert(`Pilih dulu: ${mod.name}`);
                    return;
                }
            }
            
            this.adding = true;
            
            try {
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
                
                if (data.success) {
                    this.close();
                    setTimeout(() => location.reload(), 300);
                }
            } catch (err) {
                console.error("Gagal tambah keranjang", err);
            } finally {
                this.adding = false;
            }
        }
    };
}
</script>

<style>
    .custom-scrollbar::-webkit-scrollbar { width: 0px; }
    .custom-scrollbar { scrollbar-width: none; }
</style>
@endsection
