<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Waiter\TaskController;
use App\Http\Controllers\Waiter\TableMapController;

Route::prefix('waiter')
    ->name('waiter.')
    ->middleware(['auth', 'verified', 'role:waiter', 'subscription'])
    ->group(function () {
        Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
        Route::patch('/orders/{order}/delivered', [TaskController::class, 'markDelivered'])->name('orders.delivered');

        Route::get('/table-map', [TableMapController::class, 'index'])->name('table-map');
        Route::patch('/tables/{table}/clean', [TableMapController::class, 'markClean'])->name('tables.clean');
    });
