<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');

        $users = User::when($search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                      ->orWhere('phone', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(20)
            ->withQueryString();

        return view('superadmin.users.index', compact('users', 'search'));
    }

    public function ban(User $user)
    {
        // Jangan biarkan super admin mem-ban dirinya sendiri
        if (auth()->id() === $user->id) {
            return back()->with('error', 'Anda tidak bisa memblokir akun Anda sendiri.');
        }

        $user->update(['is_banned' => true]);
        return back()->with('success', "User {$user->name} berhasil diblokir.");
    }

    public function unban(User $user)
    {
        $user->update(['is_banned' => false]);
        return back()->with('success', "Blokir user {$user->name} berhasil dibuka.");
    }

    public function resetPassword(User $user)
    {
        // Reset password ke default (misal: 12345678)
        $user->update(['password' => bcrypt('12345678')]);
        return back()->with('success', "Password user {$user->name} berhasil direset menjadi '12345678'.");
    }
}
