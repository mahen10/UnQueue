<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuperAdmin\DashboardController;
use App\Http\Controllers\SuperAdmin\TenantController;
use App\Http\Controllers\SuperAdmin\UserController;

Route::prefix('superadmin')
    ->name('superadmin.')
    ->middleware(['auth', 'verified', 'superadmin'])
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Manajemen Tenant (Restoran)
        Route::get('/tenants', [TenantController::class, 'index'])->name('tenants.index');
        Route::get('/tenants/{shop}', [TenantController::class, 'show'])->name('tenants.show');
        Route::patch('/tenants/{shop}/override', [TenantController::class, 'override'])->name('tenants.override');

        // Manajemen User Global
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::patch('/users/{user}/ban', [UserController::class, 'ban'])->name('users.ban');
        Route::patch('/users/{user}/unban', [UserController::class, 'unban'])->name('users.unban');
        Route::patch('/users/{user}/reset-password', [UserController::class, 'resetPassword'])->name('users.reset-password');
    });
