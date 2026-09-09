<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FreeUserController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        
        if ($user->isSuperAdmin()) {
            return redirect()->route('superadmin.dashboard');
        }

        $activeShop = $user->activeShop();

        if ($activeShop) {
            $shopUser = \App\Models\ShopUser::where('shop_id', $activeShop->id)
                ->where('user_id', $user->id)
                ->where('status', 'active')
                ->first();

            if ($shopUser) {
                return match ($shopUser->role) {
                    'owner' => redirect()->route('owner.dashboard'),
                    'admin' => redirect()->route('admin.dashboard'),
                    'kasir' => redirect()->route('kasir.pos'),
                    'kitchen' => redirect()->route('kitchen.display'),
                    'waiter' => redirect()->route('waiter.tasks.index'),
                    default => view('free_user.dashboard'),
                };
            }
        }

        return view('free_user.dashboard');
    }
}
