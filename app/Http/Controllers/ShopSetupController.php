<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShopSetupController extends Controller
{
    public function create()
    {
        return view('free_user.setup_shop');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:50|unique:shops,slug|alpha_dash',
        ]);

        $shop = \App\Models\Shop::create([
            'owner_id' => $request->user()->id,
            'name' => $request->name,
            'slug' => $request->slug,
            'tax_percent' => 11, // default PPN
        ]);

        \App\Models\ShopUser::create([
            'shop_id' => $shop->id,
            'user_id' => $request->user()->id,
            'role' => 'owner',
            'status' => 'active',
            'joined_at' => now(),
        ]);

        return redirect()->route('owner.dashboard')->with('success', 'Restoran berhasil dibuat! Silakan mulai berlangganan.');
    }
}
