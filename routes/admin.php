<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;

// All Owner controllers that are reused by Admin
use App\Http\Controllers\Owner\CategoryController;
use App\Http\Controllers\Owner\MenuItemController;
use App\Http\Controllers\Owner\TableController;

Route::middleware(['auth', 'role:admin', 'subscription'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // CRUD Menu & Kategori (Reuse Owner Controllers)
        Route::resource('/categories', CategoryController::class)->except(['show']);
        Route::resource('/menu-items', MenuItemController::class)->except(['show']);

        // CRUD Meja (Reuse Owner Controller)
        Route::resource('/tables', TableController::class)->except(['show']);
        Route::get('/tables/print-qr', [TableController::class, 'printAllQr'])->name('tables.print-qr');
    });
