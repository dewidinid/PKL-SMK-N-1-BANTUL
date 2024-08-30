<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SiswaController;

// Route untuk menampilkan dashboard
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

Route::get('/formpengajuan', [SiswaController::class, 'submitForm'])->name('formpengajuan');

// Route to display the Siswa form
Route::get('/mandiri', [SiswaController::class, 'showMandiri'])->name('mandiri');
Route::get('/pemetaan', [SiswaController::class, 'showPemetaan'])->name('pemetaan');

Route::get('/laporanpkl_jurnal', [SiswaController::class, 'laporanJurnal'])->name('laporanpkl_jurnal');


// // Route to handle PKL form submission
// Route::post('/mandiri/submit', [PKLController::class, 'submitForm'])->name('mandiri.submit');
