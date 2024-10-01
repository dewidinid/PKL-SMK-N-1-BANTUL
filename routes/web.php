<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DudiController;
use App\Http\Controllers\PembimbingController;
use App\Http\Controllers\CetakController;

// Route untuk menampilkan dashboard
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

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
Route::get('/preview-nilai-pkl', [SiswaController::class, 'previewNilaiPkl'])->name('previewNilaiPkl');

Route::post('/upload-laporan-pengimbasan', [SiswaController::class, 'uploadLaporanPengimbasan'])->name('upload_laporan_pengimbasan');
Route::post('/upload-laporan-akhir', [SiswaController::class, 'uploadLaporanAkhir'])->name('upload_laporan_akhir');

Route::get('/formpengajuan', [SiswaController::class, 'submitForm'])->name('formpengajuan');

Route::get('/formpengajuan', [SiswaController::class, 'FormPengajuan'])->name('formpengajuan');

// Route to display the Siswa form
Route::get('/mandiri', [SiswaController::class, 'showMandiri'])->name('mandiri');
Route::get('/pemetaan', [SiswaController::class, 'showPemetaan'])->name('pemetaan');

Route::get('/laporan-jurnal', [SiswaController::class, 'laporanJurnal'])->name('laporanpkl_jurnal');
Route::post('/laporan-jurnal/submit', [SiswaController::class, 'submitJurnal'])->name('submitJurnal');


Route::get('/home_admin', [AdminController::class, 'indexAdmin'])->name('home_admin');
Route::post('/upload-laporan-pengimbasan', [SiswaController::class, 'uploadLaporanPengimbasan'])->name('uploadLaporanPengimbasan');
Route::post('/upload-laporan-akhir', [SiswaController::class, 'uploadLaporanAkhir'])->name('upload.laporan.akhir');

Route::get('/data_siswa', [AdminController::class, 'dataSiswa'])->name('data_siswa');

Route::get('/data_mitradudi', [AdminController::class, 'dataMitraDudi'])->name('data_mitradudi');
Route::post('/import-dudi', [AdminController::class, 'importDudi'])->name('import.dudi');

Route::get('/ploting_siswa', [AdminController::class, 'plotingSiswa'])->name('ploting_siswa');
Route::post('/upload-laporan-pengimbasan', [SiswaController::class, 'uploadLaporanPengimbasan'])->name('uploadLaporanPengimbasan');
Route::post('/upload-laporan-akhir', [SiswaController::class, 'uploadLaporanAkhir'])->name('upload.laporan.akhir');

Route::get('/home_admin', [AdminController::class, 'indexAdmin'])->name('home_admin');

Route::get('/surat-pengajuan', [AdminController::class, 'suratPengajuan'])->name('suratPengajuan');
Route::post('/approve-pengajuan', [AdminController::class, 'approvePengajuan'])->name('approvePengajuan');

Route::get('/guru_pembimbing', [AdminController::class, 'guruPembimbing'])->name('guru_pembimbing');
Route::post('/import-pembimbing', [AdminController::class, 'importPembimbing'])->name('import.pembimbing');

// Home Dudi
Route::get('/home_dudi', [DudiController::class, 'indexDudi'])->name('home_dudi');
Route::get('/nilai_pkl', [DudiController::class, 'nilaiPKL'])->name('nilai_pkl');
Route::get('/dudi/export-nilai', [DudiController::class, 'exportNilai'])->name('dudi.export.nilai');

// Route untuk DUDI - Laporan Jurnal
Route::get('/dudi_laporanjurnal', [DudiController::class, 'dudiLaporanJurnal'])->name('dudi_laporanjurnal');

// Route untuk laporan jurnal per siswa di DUDI
Route::get('/dudi_laporanjurnal_persiswa', [DudiController::class, 'dudiLaporanJurnalPerSiswa'])->name('dudi_laporanjurnal_persiswa');
// /{nis}


// Home Pembimbing
Route::get('/home_pembimbing', [PembimbingController::class, 'indexPembimbing'])->name('home_pembimbing');
// Rute untuk halaman monitoring
Route::get('/monitoring', [PembimbingController::class, 'monitoringPKL'])->name('monitoring');

// Rute untuk halaman monitoring per siswa dengan parameter NIS
Route::get('/monitoring_persiswa', [PembimbingController::class, 'monitoringPerSiswa'])->name('monitoring_persiswa');
// /{nis}

// Rute untuk mengimpor monitoring per siswa
Route::post('/monitoring_persiswa/{nis}/import', [PembimbingController::class, 'importMonitoring'])->name('monitoring_persiswa.import');

Route::get('/evaluasi', [PembimbingController::class, 'evaluasiPKL'])->name('evaluasi');

Route::get('/evaluasi_persiswa', [PembimbingController::class, 'evaluasiPerSiswa'])->name('evaluasi_persiswa');
// /{nis}

Route::get('/hasil_nilaipkl', [PembimbingController::class, 'hasilNilaiPKL'])->name('hasil_nilaipkl');
Route::get('/hasil_laporanpengimbasan', [PembimbingController::class, 'hasilLaporanPengimbasan'])->name('hasil_laporanpengimbasan');

Route::get('/pembimbing_laporanjurnal', [PembimbingController::class, 'pembimbingLaporanJurnal'])->name('pembimbing_laporanjurnal');

// Tambahkan route baru untuk laporan jurnal per siswa
Route::get('/pembimbing_laporanjurnal_persiswa', [PembimbingController::class, 'pembimbingLaporanJurnalPerSiswa'])->name('pembimbing_laporanjurnal_persiswa');
// /{nis}

Route::get('/hasil_laporanakhir', [PembimbingController::class, 'hasilLaporanAkhir'])->name('hasil_laporanakhir');

// Route for exporting Excel
Route::get('/monitoring_persiswa/{nis}/export/excel', [CetakController::class, 'exportMonitoringExcel'])->name('monitoring.export.excel');

// Route for exporting PDF
Route::get('/monitoring_persiswa/{nis}/export/pdf', [CetakController::class, 'exportMonitoringPDF'])->name('monitoring.export.pdf');

// Rute untuk export evaluasi PKL ke Excel dan PDF
Route::get('/export_evaluasi_excel/{nis}', [CetakController::class, 'exportEvaluasiExcel'])->name('export_evaluasi_excel');
Route::get('/export_evaluasi_pdf/{nis}', [CetakController::class, 'exportEvaluasiPDF'])->name('export_evaluasi_pdf');
