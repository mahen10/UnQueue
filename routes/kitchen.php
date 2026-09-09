<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Kitchen\KdsController;

Route::prefix('kitchen')
    ->name('kitchen.')
    ->middleware(['auth', 'verified', 'role:kitchen', 'subscription'])
    ->group(function () {
        Route::get('/display', [KdsController::class, 'index'])->name('display');
        Route::patch('/orders/{order}/process', [KdsController::class, 'markProcessing'])->name('orders.process');
        Route::patch('/orders/{order}/ready', [KdsController::class, 'markReady'])->name('orders.ready');
        Route::patch('/menu-items/{menuItem}/toggle-stock', [KdsController::class, 'toggleStock'])->name('menu.toggle-stock');
    });
