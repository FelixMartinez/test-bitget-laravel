<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BitgetController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }
    return redirect()->route('login');
});

Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update')->middleware('throttle:6,1'); // Máximo 6 actualizaciones por minuto
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy')->middleware('throttle:3,1'); // Máximo 3 intentos por minuto

    // Rutas de Bitget
    Route::get('/bitget/balance', [BitgetController::class, 'showBalance'])->name('bitget.balance');
    Route::post('/bitget/refresh', [BitgetController::class, 'refreshBalance'])->name('bitget.refresh')->middleware('throttle:10,1'); // Máximo 10 refreshes por minuto

    // Gestión de Cuentas Bitget - con rate limiting para prevenir abuso
    Route::prefix('bitget/accounts')->name('bitget.accounts.')->group(function () {
        Route::get('/', [\App\Http\Controllers\BitgetAccountController::class, 'index'])->name('index');
        Route::get('/create', [\App\Http\Controllers\BitgetAccountController::class, 'create'])->name('create');
        Route::post('/', [\App\Http\Controllers\BitgetAccountController::class, 'store'])->name('store')->middleware('throttle:5,1'); // Máximo 5 cuentas por minuto
        Route::get('/{account}/edit', [\App\Http\Controllers\BitgetAccountController::class, 'edit'])->name('edit');
        Route::patch('/{account}', [\App\Http\Controllers\BitgetAccountController::class, 'update'])->name('update')->middleware('throttle:10,1');
        Route::delete('/{account}', [\App\Http\Controllers\BitgetAccountController::class, 'destroy'])->name('destroy')->middleware('throttle:5,1');
        Route::patch('/{account}/activate', [\App\Http\Controllers\BitgetAccountController::class, 'activate'])->name('activate')->middleware('throttle:20,1');
    });
});

require __DIR__.'/auth.php';
