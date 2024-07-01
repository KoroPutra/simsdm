<?php

use App\Http\Controllers\KonsultasiController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('konseling', 'konseling')
    ->middleware(['auth', 'verified'])
    ->name('konseling');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('konseling/create', [KonsultasiController::class, 'create'])->name('consultations.create');
Route::get('konseling', [KonsultasiController::class, 'getUserId'])->name('konseling');
Route::post('konseling', [KonsultasiController::class, 'store'])->name('consultations.store');

require __DIR__ . '/auth.php';
