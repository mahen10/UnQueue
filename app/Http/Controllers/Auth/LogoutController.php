<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function logout(Request $request)
    {
        // Simpan dulu data sesi pelanggan (jika ada di browser yang sama)
        // agar pelanggan yang sedang memesan tidak terganggu saat owner/staff logout
        $customerKeys = [
            'customer_table_id',
            'customer_shop_id',
            'customer_table_name',
            'customer_shop_name',
            'cart',
        ];
        $customerData = [];
        foreach ($customerKeys as $key) {
            if ($request->session()->has($key)) {
                $customerData[$key] = $request->session()->get($key);
            }
        }

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Restore data sesi pelanggan setelah session di-regenerate
        foreach ($customerData as $key => $value) {
            $request->session()->put($key, $value);
        }

        return redirect()->route('landing');
    }
}
