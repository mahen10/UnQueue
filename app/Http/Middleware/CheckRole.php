<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\ShopUser;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        $user = $request->user();

        if (!$user) {
            return redirect()->route('login');
        }

        // Banned user tidak bisa akses
        if ($user->isBanned()) {
            auth()->logout();
            return redirect()->route('login')->with('error', 'Akun Anda telah ditangguhkan.');
        }

        $activeShop = clone $user->activeShop(); // This returns the shop model

        if (!$activeShop) {
            // User belum punya shop
            return redirect()->route('dashboard');
        }

        // Cek peran user di shop ini
        $shopUser = ShopUser::where('shop_id', $activeShop->id)
            ->where('user_id', $user->id)
            ->where('status', 'active')
            ->first();

        if (!$shopUser || $shopUser->role !== $role) {
            abort(403, 'Akses ditolak. Anda tidak memiliki izin untuk halaman ini.');
        }

        // Inject shop dan role ke request agar mudah diakses di controller
        $request->attributes->set('shop', $activeShop);
        $request->attributes->set('shopUser', $shopUser);

        return $next($request);
    }
}
