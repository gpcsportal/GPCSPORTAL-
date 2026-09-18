<?php

use App\Http\Controllers\Admin\{
    AdminAccountController,
    AdminContentController,
    AdminDashboardController,
    AdminLogController,
    AdminReportController,
    AdminSettingsController,
    AdminSubjectController,
    AdminUserController
};
use App\Http\Controllers\Admin\Auth\AdminLoginController;
use Illuminate\Support\Facades\Route;

Route::post('/admin/hidden-login', [AdminLoginController::class, 'login'])
    ->middleware('throttle:5,1')
    ->name('admin.hidden.login');

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'admin', 'admin.idle'])
    ->group(function (): void {
        Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::post('/logout', [AdminLoginController::class, 'logout'])->name('logout');

        Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
        Route::get('/users/create', [AdminUserController::class, 'create'])->name('users.create');
        Route::post('/users', [AdminUserController::class, 'store'])->name('users.store');
        Route::get('/users/{user}/edit', [AdminUserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{user}', [AdminUserController::class, 'update'])->name('users.update');
        Route::patch('/users/{user}/toggle', [AdminUserController::class, 'toggle'])->name('users.toggle');
        Route::delete('/users/{user}', [AdminUserController::class, 'destroy'])->name('users.destroy');

        Route::get('/subjects', [AdminSubjectController::class, 'index'])->name('subjects.index');
        Route::get('/subjects/create', [AdminSubjectController::class, 'create'])->name('subjects.create');
        Route::post('/subjects', [AdminSubjectController::class, 'store'])->name('subjects.store');
        Route::get('/subjects/{subject}/edit', [AdminSubjectController::class, 'edit'])->name('subjects.edit');
        Route::put('/subjects/{subject}', [AdminSubjectController::class, 'update'])->name('subjects.update');
        Route::delete('/subjects/{subject}', [AdminSubjectController::class, 'destroy'])->name('subjects.destroy');

        Route::get('/content/{type}', [AdminContentController::class, 'index'])->name('content.index');
        Route::get('/content/{type}/create', [AdminContentController::class, 'create'])->name('content.create');
        Route::post('/content/{type}', [AdminContentController::class, 'store'])->name('content.store');
        Route::get('/content/{type}/{id}/edit', [AdminContentController::class, 'edit'])->name('content.edit');
        Route::put('/content/{type}/{id}', [AdminContentController::class, 'update'])->name('content.update');
        Route::patch('/content/{type}/{id}/status', [AdminContentController::class, 'status'])->name('content.status');
        Route::delete('/content/{type}/{id}', [AdminContentController::class, 'destroy'])->name('content.destroy');

        Route::get('/settings', [AdminSettingsController::class, 'edit'])->name('settings.edit');
        Route::put('/settings', [AdminSettingsController::class, 'update'])->name('settings.update');

        Route::get('/reports', [AdminReportController::class, 'index'])->name('reports.index');
        Route::get('/reports.csv', [AdminReportController::class, 'csv'])->name('reports.csv');
        Route::get('/logs', [AdminLogController::class, 'index'])->name('logs.index');

        Route::get('/account', [AdminAccountController::class, 'edit'])->name('account.edit');
        Route::put('/account', [AdminAccountController::class, 'update'])->name('account.update');
    });
