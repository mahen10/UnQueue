<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class MenuCategoryController extends Controller
{
    public function index(Request $request)
    {
        $shop = $request->attributes->get('shop');
        $categories = Category::where('shop_id', $shop->id)->orderBy('sort_order')->get();
        return view('owner.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('owner.categories.create');
    }

    public function store(Request $request)
    {
        $shop = $request->attributes->get('shop');
        $request->validate([
            'name' => 'required|string|max:255',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $sortOrder = $request->sort_order;
        if (is_null($sortOrder)) {
            $maxOrder = Category::where('shop_id', $shop->id)->max('sort_order');
            $sortOrder = $maxOrder ? $maxOrder + 1 : 1;
        }

        Category::create([
            'shop_id' => $shop->id,
            'name' => $request->name,
            'sort_order' => $sortOrder,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('owner.categories.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit(Category $category)
    {
        return view('owner.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'sort_order' => 'nullable|integer',
        ]);

        $category->update([
            'name' => $request->name,
            'sort_order' => $request->sort_order ?? 0,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('owner.categories.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('owner.categories.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
