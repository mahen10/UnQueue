<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Owner\DashboardController;
use App\Http\Controllers\Owner\MenuCategoryController;
use App\Http\Controllers\Owner\MenuItemController;
use App\Http\Controllers\Owner\TableController;
use App\Http\Controllers\Owner\StaffController;
use App\Http\Controllers\Owner\ReportController;
use App\Http\Controllers\Owner\SettingController;
use App\Http\Controllers\Owner\BillingController;

Route::prefix('owner')
    ->name('owner.')
    ->middleware(['auth', 'role:owner', 'subscription'])
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Menu
        Route::resource('categories', MenuCategoryController::class);
        Route::resource('menu-items', MenuItemController::class);
        Route::patch('menu-items/{menuItem}/toggle-stock', [MenuItemController::class, 'toggleStock'])->name('menu-items.toggle-stock');

        // Meja & QR Code
        Route::resource('tables', TableController::class);
        Route::get('tables/{table}/qr', [TableController::class, 'downloadQr'])->name('tables.qr');
        Route::post('tables/{table}/regenerate-token', [TableController::class, 'regenerateToken'])->name('tables.regenerate-token');
        Route::get('tables/export-pdf', [TableController::class, 'exportAllPdf'])->name('tables.export-pdf');

        // Staf & Undangan
        Route::get('staff', [StaffController::class, 'index'])->name('staff.index');
        Route::post('staff/invite', [StaffController::class, 'invite'])->name('staff.invite');
        Route::delete('staff/{shopUser}', [StaffController::class, 'remove'])->name('staff.remove');

        // Laporan
        Route::get('reports', [ReportController::class, 'index'])->name('reports.index');
        Route::get('reports/export', [ReportController::class, 'export'])->name('reports.export');

        // Pengaturan Resto
        Route::get('settings', [SettingController::class, 'edit'])->name('settings.edit');
        Route::patch('settings', [SettingController::class, 'update'])->name('settings.update');

        // Billing & Langganan
        Route::get('billing', [BillingController::class, 'index'])->name('billing.index');
        Route::post('billing/subscribe', [BillingController::class, 'subscribe'])->name('billing.subscribe');
    });

// Billing tetap bisa diakses walau langganan expired (tanpa middleware subscription)
Route::prefix('owner')
    ->name('owner.')
    ->middleware(['auth', 'role:owner'])
    ->group(function () {
        Route::get('billing/expired', [BillingController::class, 'expired'])->name('billing.expired');
    });
