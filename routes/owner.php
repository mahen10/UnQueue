<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Owner\DashboardController;
use App\Http\Controllers\Owner\StaffController;
use App\Http\Controllers\Owner\ReportController;
use App\Http\Controllers\Owner\SettingController;
use App\Http\Controllers\Owner\BillingController;

// Group 1: Owner Only
Route::prefix('owner')
    ->name('owner.')
    ->middleware(['auth', 'role:owner', 'subscription'])
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Staf & Undangan
        Route::get('staff', [StaffController::class, 'index'])->name('staff.index');
        Route::post('staff/invite', [StaffController::class, 'invite'])->name('staff.invite');
        Route::delete('staff/{shopUser}', [StaffController::class, 'remove'])->name('staff.remove');

        // Laporan (Finansial / Strategis)
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
