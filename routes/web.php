<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\TabelController;
use App\Http\Controllers\KonsultasiController;

Route::view('/', 'welcome');

// route user
Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified', 'user'])
    ->name('dashboard');

// route admin
Route::view('admin', 'admin')
    ->middleware(['auth', 'verified', 'admin'])
    ->name('admin');

// route konseler
Route::view('konseler', 'konseler')
    ->middleware(['auth', 'verified', 'konseler'])
    ->name('konseler');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

    Route::middleware(['auth', 'verified', 'admin'])->group(function () {
        Route::get('tabel', [TabelController::class, 'index'])->name('tabel');
        Route::get('/chat/{user}', [ChatController::class, 'show'])->name('chat');

    });

    Route::middleware(['auth', 'verified', 'user'])->group(function () {
        Route::get('konseling/create', [KonsultasiController::class, 'create'])->name('konsultasi.create');
        Route::get('konseling', [KonsultasiController::class, 'getUserId'])->name('konseling');
        Route::post('konseling', [KonsultasiController::class, 'store'])->name('konsultasi.store');
    });

require __DIR__ . '/auth.php';
