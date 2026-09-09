<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MenuCategoryController;
use App\Http\Controllers\Admin\MenuItemController;
use App\Http\Controllers\Admin\TableController;

Route::middleware(['auth', 'verified', 'role:admin', 'subscription'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // CRUD Menu & Kategori
        Route::resource('/categories', MenuCategoryController::class)->except(['show']);
        Route::resource('/menu-items', MenuItemController::class)->except(['show']);
        Route::patch('menu-items/{menuItem}/toggle-stock', [MenuItemController::class, 'toggleStock'])->name('menu-items.toggle-stock');

        // CRUD Meja
        Route::resource('/tables', TableController::class)->except(['show']);
        Route::get('/tables/{table}/qr', [TableController::class, 'downloadQr'])->name('tables.qr');
        Route::post('/tables/{table}/regenerate-token', [TableController::class, 'regenerateToken'])->name('tables.regenerate-token');
        Route::get('/tables/export-pdf', [TableController::class, 'exportAllPdf'])->name('tables.export-pdf');
    });
