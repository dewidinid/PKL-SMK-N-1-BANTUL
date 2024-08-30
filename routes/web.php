<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SiswaController;

// Route untuk menampilkan dashboard
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Route::get('/login', [showLoginForm::class, 'index'])->name('login');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

// Halaman home siswa
Route::get('/home_siswa', [SiswaController::class, 'home'])->name('home_siswa');

// Halaman profil siswa
Route::get('/profil_siswa', [SiswaController::class, 'showProfile'])->name('profil_siswa');

// Route to update profile form data
Route::post('/update-profile', [SiswaController::class, 'updateProfile'])->name('updateProfile');

// Route untuk halaman verifikasi akhir PKL
Route::get('/verifikasi_akhir_pkl', [SiswaController::class, 'verifikasiAkhirPKL'])->name('verifikasi_akhir_pkl');

Route::get('/formpengajuan', [SiswaController::class, 'submitForm'])->name('formpengajuan');

// Route to display the Siswa form
Route::get('/mandiri', [SiswaController::class, 'showMandiri'])->name('mandiri');
Route::get('/pemetaan', [SiswaController::class, 'showPemetaan'])->name('pemetaan');

Route::get('/laporanpkl_jurnal', [SiswaController::class, 'laporanJurnal'])->name('laporanpkl_jurnal');
