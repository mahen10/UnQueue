<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Kasir\PosController;
use App\Http\Controllers\Kasir\TransactionController;
use App\Http\Controllers\Kasir\ShiftController;

Route::prefix('kasir')
    ->name('kasir.')
    ->middleware(['auth', 'role:kasir', 'subscription'])
    ->group(function () {
        Route::get('/pos', [PosController::class, 'index'])->name('pos');
        Route::post('/pos/order', [PosController::class, 'createOrder'])->name('pos.order');
        Route::patch('/pos/{order}/deliver', [PosController::class, 'markDelivered'])->name('pos.deliver');

        Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
        Route::post('/transactions/{order}/void', [TransactionController::class, 'void'])->name('transactions.void');
        Route::post('/transactions/{order}/refund', [TransactionController::class, 'refund'])->name('transactions.refund');

        Route::get('/shift', [ShiftController::class, 'index'])->name('shift.index');
        Route::post('/shift/close', [ShiftController::class, 'close'])->name('shift.close');
    });
