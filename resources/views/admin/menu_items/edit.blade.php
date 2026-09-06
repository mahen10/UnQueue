@extends('layouts.admin')
@section('title', 'Edit Menu')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8" x-data="menuForm()">
    <div class="flex items-center gap-4 mb-6">
        <a href="{{ route('admin.menu-items.index') }}" class="text-gray-500 hover:text-gray-900">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        </a>
        <h1 class="text-2xl font-bold text-gray-900">Edit Menu</h1>
    </div>

    <form action="{{ route('admin.menu-items.update', $menuItem) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 space-y-6">
        @csrf
        @method('PATCH')
        
        <!-- Basic Info -->
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
            <div class="sm:col-span-2">
                <label for="name" class="block text-sm font-medium text-gray-700">Nama Menu</label>
                <input type="text" name="name" id="name" value="{{ old('name', $menuItem->name) }}" required
                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm px-4 py-2 border">
            </div>

            <div>
                <label for="category_id" class="block text-sm font-medium text-gray-700">Kategori</label>
                <select name="category_id" id="category_id" required
                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm px-4 py-2 border">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $menuItem->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="price" class="block text-sm font-medium text-gray-700">Harga (Rp)</label>
                <input type="number" name="price" id="price" value="{{ old('price', $menuItem->price) }}" required min="0"
                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm px-4 py-2 border">
            </div>

            <div class="sm:col-span-2">
                <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                <textarea name="description" id="description" rows="3"
                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm px-4 py-2 border">{{ old('description', $menuItem->description) }}</textarea>
            </div>

            <div class="sm:col-span-2">
                <label for="photo" class="block text-sm font-medium text-gray-700">Ganti Foto Menu (Opsional)</label>
                @if($menuItem->photo)
                    <div class="mb-2">
                        <img src="{{ Storage::url($menuItem->photo) }}" class="h-20 w-20 object-cover rounded shadow-sm border border-gray-200">
                    </div>
                @endif
                <input type="file" name="photo" id="photo" accept="image/*"
                    class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
            </div>
            
            <div class="sm:col-span-2 flex items-center">
                <input type="checkbox" name="is_available" id="is_available" value="1" {{ $menuItem->is_available ? 'checked' : '' }}
                    class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                <label for="is_available" class="ml-2 block text-sm text-gray-700">Tersedia (Bisa dipesan)</label>
            </div>
        </div>

        <hr class="border-gray-100">

        <!-- Modifiers Builder (AlpineJS) -->
        <div>
            <div class="flex justify-between items-center mb-4">
                <div>
                    <h3 class="text-lg font-medium text-gray-900">Varian & Tambahan (Modifiers)</h3>
                </div>
                <button type="button" @click="addModifier()" class="bg-gray-100 text-gray-700 px-3 py-1.5 rounded text-sm font-medium hover:bg-gray-200">
                    + Tambah Grup Varian
                </button>
            </div>

            <div class="space-y-4">
                <template x-for="(mod, index) in modifiers" :key="index">
                    <div class="border border-gray-200 rounded-lg p-4 bg-gray-50">
                        <div class="flex justify-between items-start mb-3">
                            <div class="flex-grow grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-medium text-gray-700">Nama Grup</label>
                                    <input type="text" x-model="mod.name" :name="`modifiers[${index}][name]`" required class="mt-1 block w-full rounded border-gray-300 sm:text-sm px-3 py-1.5 border">
                                </div>
                                <div class="flex items-end pb-2">
                                    <label class="inline-flex items-center">
                                        <input type="checkbox" x-model="mod.is_required" :name="`modifiers[${index}][is_required]`" value="1" class="rounded border-gray-300 text-blue-600 shadow-sm">
                                        <span class="ml-2 text-sm text-gray-600">Wajib Dipilih</span>
                                    </label>
                                </div>
                            </div>
                            <button type="button" @click="removeModifier(index)" class="ml-4 text-red-500 hover:text-red-700">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </div>

                        <div class="ml-4 pl-4 border-l-2 border-gray-200 space-y-2">
                            <label class="block text-xs font-medium text-gray-700">Pilihan (Options)</label>
                            <template x-for="(opt, optIndex) in mod.options" :key="optIndex">
                                <div class="flex gap-2 items-center">
                                    <input type="text" x-model="opt.label" :name="`modifiers[${index}][options][${optIndex}][label]`" required class="block w-full rounded border-gray-300 sm:text-sm px-3 py-1 border">
                                    <input type="number" x-model="opt.price" :name="`modifiers[${index}][options][${optIndex}][price]`" class="block w-32 rounded border-gray-300 sm:text-sm px-3 py-1 border">
                                    <button type="button" @click="removeOption(index, optIndex)" class="text-red-400 hover:text-red-600">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                    </button>
                                </div>
                            </template>
                            <button type="button" @click="addOption(index)" class="text-xs text-blue-600 hover:text-blue-800 mt-2 font-medium">
                                + Tambah Pilihan
                            </button>
                        </div>
                    </div>
                </template>
            </div>
        </div>

        <div class="pt-4 border-t border-gray-100 flex justify-end">
            <button type="submit" class="w-full sm:w-auto bg-blue-600 text-white px-6 py-2 rounded-lg text-sm font-medium hover:bg-blue-700">Simpan Perubahan</button>
        </div>
    </form>
</div>

<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('menuForm', () => ({
        modifiers: {!! json_encode($menuItem->modifiers->map(function($m) { 
            return [
                'name' => $m->name, 
                'is_required' => $m->is_required ? true : false, 
                'options' => $m->options
            ]; 
        })) !!},
        addModifier() {
            this.modifiers.push({
                name: '',
                is_required: false,
                options: [{ label: '', price: 0 }]
            });
        },
        removeModifier(index) {
            this.modifiers.splice(index, 1);
        },
        addOption(modIndex) {
            this.modifiers[modIndex].options.push({ label: '', price: 0 });
        },
        removeOption(modIndex, optIndex) {
            this.modifiers[modIndex].options.splice(optIndex, 1);
        }
    }));
});
</script>
@endsection
