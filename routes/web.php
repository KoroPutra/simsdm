<?php

use App\Livewire\Chat;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TabelController;
use App\Http\Controllers\KonselerController;
use App\Http\Controllers\KonsultasiController;

Route::view('/', 'welcome');

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

Route::get('tabel/chat/{user}', Chat::class)
    ->middleware(['auth', 'verified', 'check.role:1,2,3'])
    ->name('chat');

    Route::middleware(['auth', 'verified', 'admin'])->group(function () {
        Route::get('tabel', [TabelController::class, 'index'])->name('tabel');
        Route::post('tabel/assign-konseler/{konsultasi}', [TabelController::class, 'assignKonseler'])->name('konsultasi.assignKonseler');
        
    });

    Route::middleware(['auth', 'verified', 'user'])->group(function () {
        Route::get('dashboard', [UserController::class, 'pesanMasuk'])->name('dashboard');
        Route::get('konseling/create', [KonsultasiController::class, 'create'])->name('konsultasi.create');
        Route::get('konseling', [KonsultasiController::class, 'getUserId'])->name('konseling');
        Route::post('konseling', [KonsultasiController::class, 'store'])->name('konsultasi.store');
        Route::get('tabel-user', [UserController::class, 'index'])->name('tabel-user');
    });
    Route::middleware(['auth', 'verified', 'konseler'])->group(function () {
        Route::get('konseler/konsultasi', [KonselerController::class, 'index'])->name('konseler.konsultasi');
    });

require __DIR__ . '/auth.php';
