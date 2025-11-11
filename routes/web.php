<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

// Route untuk halaman welcome (default Laravel)
// Route::get('/', function () {
//     return view('welcome');
// });

// Route untuk login
Route::get('/', [PageController::class, 'login'])->name('login');
Route::post('/', [PageController::class, 'processLogin'])->name('login.process');

// Route untuk dashboard
Route::get('/dashboard', [PageController::class, 'dashboard'])->name('dashboard');

// Route untuk profile
Route::get('/profile', [PageController::class, 'profile'])->name('profile');

// Route untuk pengelolaan
Route::get('/pengelolaan', [PageController::class, 'pengelolaan'])->name('pengelolaan');