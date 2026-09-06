<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Shop;

class CheckSubscriptionStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Ada dua kemungkinan entry point: 
        // 1. Dari route pegawai (owner, kasir, dll) -> shop diambil dari request attribute yang di-set oleh CheckRole
        // 2. Dari route pelanggan -> shop_id mungkin ada di route atau session
        
        $shop = $request->attributes->get('shop');

        if (!$shop) {
            // Jika pelanggan, biasanya mengakses lewat token meja
            if ($request->route('token')) {
                $table = \App\Models\Table::where('qr_token', $request->route('token'))->first();
                if ($table) {
                    $shop = $table->shop;
                }
            }
        }

        // Jika masih tidak ketemu shop, bisa jadi request invalid
        if (!$shop) {
            return $next($request);
        }

        if (!$shop->isSubscriptionActive()) {
            // Logika berdasarkan jenis user
            
            // Pelanggan
            if ($request->is('t/*') || $request->is('order/*')) {
                return response()->view('errors.subscription_expired_customer', ['shop' => $shop], 403);
            }

            // Staf (selain owner)
            $shopUser = $request->attributes->get('shopUser');
            if ($shopUser && $shopUser->role !== 'owner') {
                return response()->view('errors.subscription_expired_staff', ['shop' => $shop], 403);
            }

            // Owner: Boleh akses billing, route lain arahkan ke billing
            if ($shopUser && $shopUser->role === 'owner') {
                if (!$request->is('owner/billing*')) {
                    return redirect()->route('owner.billing.expired');
                }
            }
        }

        return $next($request);
    }
}
