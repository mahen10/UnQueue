<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            // Cek apakah user sudah terdaftar dengan google_id atau email ini
            $user = User::where('google_id', $googleUser->id)->orWhere('email', $googleUser->email)->first();

            if ($user) {
                // Update google_id jika belum ada (misal sebelumnya daftar manual dengan email ini)
                if (!$user->google_id) {
                    $user->update([
                        'google_id' => $googleUser->id,
                        'google_token' => $googleUser->token,
                        'email_verified_at' => now(), // otomatis verified
                    ]);
                }
                
                Auth::login($user, true);
            } else {
                // Buat user baru
                $newUser = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'google_id' => $googleUser->id,
                    'google_token' => $googleUser->token,
                    // Karena OAuth Google, otomatis terverifikasi
                    'email_verified_at' => now(),
                    // password dan phone boleh kosong
                ]);

                Auth::login($newUser, true);
            }

            // Redirect sesuai logic role
            return redirect()->route('dashboard');

        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Gagal masuk dengan Google: ' . $e->getMessage());
        }
    }
}
