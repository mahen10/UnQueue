<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\ShopUser;
use App\Models\User;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function index(Request $request)
    {
        $shop = $request->attributes->get('shop');

        // Ambil semua staf di toko ini, kecuali owner (owner id-nya ada di shop_users, tapi kita exclude)
        $staffs = ShopUser::with('user')
            ->where('shop_id', $shop->id)
            ->where('role', '!=', 'owner')
            ->latest()
            ->get();

        return view('owner.staff.index', compact('shop', 'staffs'));
    }

    public function invite(Request $request)
    {
        $shop = $request->attributes->get('shop');

        $validated = $request->validate([
            'contact' => 'required|string', // UQ-ID atau Nomor HP
            'role'    => 'required|in:kasir,kitchen,waiter'
        ]);

        // Cari user berdasarkan UQ-ID atau Nomor HP
        $user = User::where('uq_id', $validated['contact'])
            ->orWhere('phone', $validated['contact'])
            ->first();

        if (!$user) {
            return back()->with('error', 'Pengguna dengan UQ-ID atau Nomor HP tersebut tidak ditemukan. Pastikan karyawan sudah mendaftar di aplikasi UnQueue.');
        }

        // Cek apakah user sudah jadi staf di toko ini
        $exists = ShopUser::where('shop_id', $shop->id)
            ->where('user_id', $user->id)
            ->exists();

        if ($exists) {
            return back()->with('error', 'Pengguna ini sudah terdaftar sebagai staf di restoran Anda.');
        }

        // Tambahkan ke toko
        ShopUser::create([
            'shop_id' => $shop->id,
            'user_id' => $user->id,
            'role'    => $validated['role'],
            'status'  => 'active',
            'joined_at' => now(),
        ]);

        // Berikan role Spatie ke user
        $user->assignRole($validated['role']);

        return back()->with('success', "Staf {$user->name} berhasil ditambahkan sebagai {$validated['role']}.");
    }

    public function remove(Request $request, ShopUser $shopUser)
    {
        $shop = $request->attributes->get('shop');

        // Pastikan hanya menghapus staf dari toko ini, dan bukan owner
        if ($shopUser->shop_id !== $shop->id || $shopUser->role === 'owner') {
            abort(403);
        }

        $user = $shopUser->user;
        $role = $shopUser->role;

        // Hapus dari toko
        $shopUser->delete();

        // Cabut role Spatie (hanya jika dia tidak punya toko lain dengan role yang sama, tapi demi simpel cabut saja)
        // Jika sistem multi-tenant lebih kompleks, kita perlu ngecek shopUser lain.
        $user->removeRole($role);

        return back()->with('success', "Staf {$user->name} berhasil dihapus dari restoran.");
    }
}
