<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;;


// Route untuk menampilkan dashboard
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Route::get('/login', [showLoginForm::class, 'index'])->name('login');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

// Route::get('/login', function () {
//     return view('login');
// })->name('login');

