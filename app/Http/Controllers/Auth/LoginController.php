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
        $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ]);

        $loginType = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';

        // Deteksi apakah ini format UQ-ID (misal UQ123456)
        if (preg_match('/^UQ[0-9]{6}$/i', $request->login)) {
            $loginType = 'uq_id';
        }

        $credentials = [
            $loginType => $request->login,
            'password' => $request->password
        ];

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            return $this->redirectBasedOnRole(Auth::user());
        }

        return back()->withErrors([
            'login' => 'Email / No. HP / UQ-ID atau password salah.',
        ])->onlyInput('login');
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
