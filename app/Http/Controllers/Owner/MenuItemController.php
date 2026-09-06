<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\MenuItem;
use App\Models\Category;
use App\Models\MenuModifier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuItemController extends Controller
{
    public function index(Request $request)
    {
        $shop = $request->attributes->get('shop');
        $categories = Category::where('shop_id', $shop->id)
            ->with(['menuItems' => function($q) {
                $q->orderBy('sort_order');
            }])
            ->orderBy('sort_order')
            ->get();

        return view('owner.menu_items.index', compact('categories'));
    }

    public function create(Request $request)
    {
        $shop = $request->attributes->get('shop');
        $categories = Category::where('shop_id', $shop->id)->orderBy('sort_order')->get();
        return view('owner.menu_items.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $shop = $request->attributes->get('shop');
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'photo' => 'nullable|image|max:2048',
            'labels' => 'nullable|array', // e.g., ["Signature", "Spicy"]
            'modifiers' => 'nullable|array', // JSON input from frontend
        ]);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('menu_photos', 'public');
        }

        $menuItem = MenuItem::create([
            'shop_id' => $shop->id,
            'category_id' => $request->category_id,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'photo' => $photoPath,
            'is_available' => $request->has('is_available'),
            'labels' => $request->labels,
        ]);

        $this->syncModifiers($menuItem, $request->modifiers);

        return redirect()->route(request()->attributes->get('shopUser')->role . '.menu-items.index')->with('success', 'Menu berhasil ditambahkan.');
    }

    public function edit(MenuItem $menuItem)
    {
        $shop = request()->attributes->get('shop');
        $categories = Category::where('shop_id', $shop->id)->orderBy('sort_order')->get();
        $menuItem->load('modifiers');
        return view('owner.menu_items.edit', compact('menuItem', 'categories'));
    }

    public function update(Request $request, MenuItem $menuItem)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'photo' => 'nullable|image|max:2048',
            'labels' => 'nullable|array',
            'modifiers' => 'nullable|array',
        ]);

        if ($request->hasFile('photo')) {
            if ($menuItem->photo) {
                Storage::disk('public')->delete($menuItem->photo);
            }
            $menuItem->photo = $request->file('photo')->store('menu_photos', 'public');
        }

        $menuItem->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'is_available' => $request->has('is_available'),
            'labels' => $request->labels,
        ]);

        $this->syncModifiers($menuItem, $request->modifiers);

        return redirect()->route(request()->attributes->get('shopUser')->role . '.menu-items.index')->with('success', 'Menu berhasil diperbarui.');
    }

    public function destroy(MenuItem $menuItem)
    {
        if ($menuItem->photo) {
            Storage::disk('public')->delete($menuItem->photo);
        }
        $menuItem->delete();
        return redirect()->route(request()->attributes->get('shopUser')->role . '.menu-items.index')->with('success', 'Menu berhasil dihapus.');
    }

    public function toggleStock(MenuItem $menuItem)
    {
        $menuItem->update(['is_available' => !$menuItem->is_available]);
        return back()->with('success', 'Status ketersediaan diubah.');
    }

    private function syncModifiers(MenuItem $menuItem, ?array $modifiersInput)
    {
        $menuItem->modifiers()->delete(); // Clear old modifiers
        
        if (!$modifiersInput) return;

        foreach ($modifiersInput as $index => $mod) {
            // format: ['name' => 'Size', 'is_required' => 1, 'options' => [['label' => 'M', 'price' => 0]]]
            if (empty($mod['name']) || empty($mod['options'])) continue;

            MenuModifier::create([
                'menu_item_id' => $menuItem->id,
                'name' => $mod['name'],
                'is_required' => isset($mod['is_required']) && $mod['is_required'],
                'options' => $mod['options'], // Automatically cast to JSON
                'sort_order' => $index,
            ]);
        }
    }
}
