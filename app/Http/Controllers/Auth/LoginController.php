<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'phone' => 'required|string',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            return $this->redirectBasedOnRole(Auth::user());
        }

        return back()->withErrors([
            'phone' => 'No. HP atau password salah.',
        ])->onlyInput('phone');
    }

    protected function redirectBasedOnRole($user)
    {
        if ($user->isSuperAdmin()) {
            return redirect()->route('superadmin.dashboard');
        }

        $activeShop = $user->activeShop();

        if (!$activeShop) {
            return redirect()->route('dashboard'); // Free user dashboard
        }

        // Cek role di shop aktif
        $shopUser = \App\Models\ShopUser::where('shop_id', $activeShop->id)
            ->where('user_id', $user->id)
            ->where('status', 'active')
            ->first();

        if (!$shopUser) {
            return redirect()->route('dashboard');
        }

        return match ($shopUser->role) {
            'owner' => redirect()->route('owner.dashboard'),
            'admin' => redirect()->route('admin.dashboard'),
            'kasir' => redirect()->route('kasir.pos'),
            'kitchen' => redirect()->route('kitchen.display'),
            'waiter' => redirect()->route('waiter.tasks.index'),
            default => redirect()->route('dashboard'),
        };
    }
}
