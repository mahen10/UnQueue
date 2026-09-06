<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Shop;
use Illuminate\Http\Request;

class TenantController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');

        $shops = Shop::with('owner')
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                      ->orWhereHas('owner', function ($q) use ($search) {
                          $q->where('phone', 'like', "%{$search}%");
                      });
            })
            ->latest()
            ->paginate(20)
            ->withQueryString();

        return view('superadmin.tenants.index', compact('shops', 'search'));
    }

    public function show(Shop $shop)
    {
        $shop->load(['owner', 'users', 'tables', 'categories', 'menuItems']);
        return view('superadmin.tenants.show', compact('shop'));
    }

    public function override(Request $request, Shop $shop)
    {
        $validated = $request->validate([
            'override_status' => 'required|in:active,suspended,null'
        ]);

        $status = $validated['override_status'] === 'null' ? null : $validated['override_status'];

        $shop->update([
            'subscription_override' => $status
        ]);

        return back()->with('success', "Status override untuk restoran {$shop->name} berhasil diubah.");
    }
}
