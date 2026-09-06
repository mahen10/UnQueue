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
});

Route::post('/logout', [LogoutController::class, 'logout'])->name('logout')->middleware('auth');

// ─── Free User (sudah login, belum punya shop aktif) ──────────────────────────
Route::middleware(['auth'])->group(function () {
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
