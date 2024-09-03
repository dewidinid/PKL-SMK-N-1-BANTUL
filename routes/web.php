<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\AdminController;

// Route untuk menampilkan dashboard
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Route::get('/login', [showLoginForm::class, 'index'])->name('login');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

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

Route::post('/upload-laporan-pengimbasan', [SiswaController::class, 'uploadLaporanPengimbasan'])->name('uploadLaporanPengimbasan');
Route::post('/upload-laporan-akhir', [SiswaController::class, 'uploadLaporanAkhir'])->name('upload.laporan.akhir');

Route::get('/home_admin', [AdminController::class, 'indexAdmin'])->name('home_admin');

Route::get('/surat-pengajuan', [AdminController::class, 'suratPengajuan'])->name('suratPengajuan');
Route::get('/guru_pembimbing', [AdminController::class, 'guruPembimbing'])->name('guru_pembimbing');