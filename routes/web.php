<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

// Route untuk menampilkan dashboard
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

