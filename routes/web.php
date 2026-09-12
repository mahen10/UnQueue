<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\FreeUserController;
use App\Http\Controllers\ShopSetupController;

// ─── Landing Page ─────────────────────────────────────────────────────────────
Route::get('/', function () {
    return view('landing');
})->name('landing');

// ─── Autentikasi (Guest only) ─────────────────────────────────────────────────
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);

    Route::get('/register', [RegisterController::class, 'showForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);

    // Google OAuth
    Route::get('/auth/google', [\App\Http\Controllers\Auth\GoogleController::class, 'redirectToGoogle'])->name('auth.google');
    Route::get('/auth/google/callback', [\App\Http\Controllers\Auth\GoogleController::class, 'handleGoogleCallback']);
});

Route::post('/logout', [LogoutController::class, 'logout'])->name('logout')->middleware('auth');

// ─── Email Verification ───────────────────────────────────────────────────────
Route::middleware('auth')->group(function () {
    Route::get('/email/verify', function (Illuminate\Http\Request $request) {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->route('dashboard');
        }
        return view('auth.verify-email');
    })->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', [\App\Http\Controllers\Auth\VerifyEmailController::class, '__invoke'])
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('/email/verification-notification', [\App\Http\Controllers\Auth\EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');
});

// ─── Free User (sudah login, belum punya shop aktif) ──────────────────────────
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [FreeUserController::class, 'index'])->name('dashboard');

    // Buat resto baru
    Route::get('/setup/shop', [ShopSetupController::class, 'create'])->name('shop.setup.create');
    Route::post('/setup/shop', [ShopSetupController::class, 'store'])->name('shop.setup.store');
});

// ─── QR Code Scan (pelanggan) ─────────────────────────────────────────────────
Route::get('/t/{token}', [\App\Http\Controllers\Customer\MenuController::class, 'scan'])
    ->name('customer.scan');

// ─── Include route files per role ─────────────────────────────────────────────
require __DIR__ . '/owner.php';
require __DIR__ . '/admin.php';
require __DIR__ . '/kasir.php';
require __DIR__ . '/kitchen.php';
require __DIR__ . '/waiter.php';
require __DIR__ . '/customer.php';
require __DIR__ . '/superadmin.php';
