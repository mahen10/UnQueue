<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Customer\MenuController;
use App\Http\Controllers\Customer\CartController;
use App\Http\Controllers\Customer\CheckoutController;
use App\Http\Controllers\Customer\OrderTrackingController;

// Semua route pelanggan di-prefix dengan session meja
Route::prefix('order')
    ->name('customer.')
    ->group(function () {
        // Katalog menu (sudah scan QR, session meja aktif)
        Route::get('/menu', [MenuController::class, 'index'])->name('menu');
        Route::get('/menu/{menuItem}', [MenuController::class, 'show'])->name('menu.show'); // Returns JSON for modal

        // Keranjang
        Route::get('/cart', [CartController::class, 'index'])->name('cart');
        Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
        Route::patch('/cart/{key}', [CartController::class, 'update'])->name('cart.update');
        Route::delete('/cart/{key}', [CartController::class, 'remove'])->name('cart.remove');

        // Checkout & Pembayaran
        Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
        Route::post('/checkout', [CheckoutController::class, 'placeOrder'])->name('checkout.place');
        Route::get('/checkout/pending/{order}', [CheckoutController::class, 'pending'])->name('checkout.pending');

        // Live Tracking
        Route::get('/track/{order}', [OrderTrackingController::class, 'index'])->name('track');
    });

// Webhook dari Xendit (tanpa auth)
Route::post('/webhook/xendit/order', [\App\Http\Controllers\Webhook\XenditOrderController::class, 'handle'])
    ->name('webhook.xendit.order');

Route::post('/webhook/xendit/subscription', [\App\Http\Controllers\Webhook\XenditSubscriptionController::class, 'handle'])
    ->name('webhook.xendit.subscription');
