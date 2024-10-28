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

// Route::get('/phpinfo', function () {
//     return phpinfo();
// });

// Route untuk menampilkan dashboard
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

// Proses login
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Halaman home siswa setelah login berhasil
Route::get('/home-siswa', function () {
    return view('home_siswa');
})->name('home_siswa')->middleware('auth:siswa');

Route::get('/profil', [SiswaController::class, 'showProfile'])->name('profil_siswa')->middleware('auth:siswa');

Route::post('/profile/update-picture', [SiswaController::class, 'updateProfilePicture'])->name('update.profile.picture')->middleware('auth:siswa');

Route::post('/profile/update', [SiswaController::class, 'updateProfile'])->name('update.profile')->middleware('auth:siswa');

// Route untuk halaman verifikasi akhir PKL
Route::get('/verifikasi_akhir_pkl', [SiswaController::class, 'verifikasiAkhirPKL'])->name('verifikasi_akhir_pkl')->middleware('auth:siswa');
Route::post('/upload-laporan', [SiswaController::class, 'uploadLaporan'])->name('upload_laporan')->middleware('auth:siswa');
// Route::get('/preview-nilai-pkl', [SiswaController::class, 'previewNilaiPkl'])->name('previewNilaiPkl')->middleware('auth:siswa');

Route::post('/formpengajuan', [SiswaController::class, 'submitForm'])->name('formpengajuan')->middleware('auth:siswa');
Route::get('/formpengajuan', [SiswaController::class, 'FormPengajuan'])->name('formpengajuan')->middleware('auth:siswa');

// Route to display the Siswa form
Route::get('/mandiri', [SiswaController::class, 'showMandiri'])->name('mandiri')->middleware('auth:siswa');
Route::get('/pemetaan', [SiswaController::class, 'showPemetaan'])->name('pemetaan')->middleware('auth:siswa');

Route::get('/laporan-jurnal', [SiswaController::class, 'laporanJurnal'])->name('laporanpkl_jurnal')->middleware('auth:siswa');
Route::post('/laporan-jurnal/submit', [SiswaController::class, 'submitJurnal'])->name('submitJurnal')->middleware('auth:siswa');

Route::get('/home_admin', [AdminController::class, 'indexAdmin'])->name('home_admin')->middleware('auth:admin');

Route::get('/data_siswa', [AdminController::class, 'dataSiswa'])->name('data_siswa')->middleware('auth:admin');
Route::get('/filter-siswa', [AdminController::class, 'filterSiswa'])->name('filterSiswa')->middleware('auth:admin');
Route::post('/siswa/import', [AdminController::class, 'importSiswa'])->name('siswa.import')->middleware('auth:admin');
Route::put('/siswa/update', [AdminController::class, 'updateSiswa'])->name('siswa.update')->middleware('auth:admin');

Route::get('/data_mitradudi', [AdminController::class, 'dataMitraDudi'])->name('data_mitradudi')->middleware('auth:admin');
Route::post('/import-dudi', [AdminController::class, 'importDudi'])->name('import.dudi')->middleware('auth:admin');
Route::post('/dudi/store', [AdminController::class, 'storeDudi'])->name('store.dudi')->middleware('auth:admin');
Route::put('/dudi/update/{kode_dudi}', [AdminController::class, 'updateDudi'])->name('update.dudi')->middleware('auth:admin');

Route::get('/ploting_siswa', [AdminController::class, 'plotingSiswa'])->name('ploting_siswa')->middleware('auth:admin');
Route::post('/admin/import-ploting', [AdminController::class, 'importPloting'])->name('admin.importPloting')->middleware('auth:admin');
Route::get('/admin/ploting-siswa', [AdminController::class, 'plotingSiswa'])->name('admin.plotingSiswa')->middleware('auth:admin');

Route::get('/surat-pengajuan', [AdminController::class, 'suratPengajuan'])->name('suratPengajuan')->middleware('auth:admin');
Route::post('/approve-pengajuan', [AdminController::class, 'approvePengajuan'])->name('approvePengajuan')->middleware('auth:admin');

Route::get('/guru_pembimbing', [AdminController::class, 'guruPembimbing'])->name('guru_pembimbing')->middleware('auth:admin');
Route::post('/import-pembimbing', [AdminController::class, 'importPembimbing'])->name('import.pembimbing')->middleware('auth:admin');
Route::post('/store-pembimbing', [AdminController::class, 'storePembimbing'])->name('store.pembimbing')->middleware('auth:admin');
Route::put('/pembimbing/{NIP_NIK}/update', [AdminController::class, 'updatePembimbing'])->name('update.pembimbing')->middleware('auth:admin');

// Home Dudi
Route::get('/home_dudi', [DudiController::class, 'indexDudi'])->name('home_dudi')->middleware('auth:dudi');
Route::get('/daftar_siswa_pkl', [DudiController::class, 'daftarSiswaPKL'])->name('daftar_siswa_pkl')->middleware('auth:dudi');
Route::get('/nilai_pkl', [DudiController::class, 'nilaiPKL'])->name('nilai_pkl')->middleware('auth:dudi');
Route::post('/import_excel/{nis}', [DudiController::class, 'uploadNilaiPKL'])->name('import_excel')->middleware('auth:dudi');
Route::get('/nilai-pkl/show/{fileName}', [DudiController::class, 'showNilaiPKLFile'])->name('nilai.pkl.show')->middleware('auth:dudi');


// Route untuk DUDI - Laporan Jurnal
Route::get('/dudi_laporanjurnal', [DudiController::class, 'dudiLaporanJurnal'])->name('dudi_laporanjurnal')->middleware('auth:dudi');

// Route untuk laporan jurnal per siswa di DUDI
Route::get('/dudi_laporanjurnal_persiswa/{nis}', [DudiController::class, 'dudiLaporanJurnalPerSiswa'])->name('dudi_laporanjurnal_persiswa')->middleware('auth:dudi');


// Home Pembimbing
Route::get('/home_pembimbing', [PembimbingController::class, 'indexPembimbing'])->name('home_pembimbing')->middleware('auth:pembimbing');
// Rute untuk halaman monitoring
Route::get('/monitoring', [PembimbingController::class, 'monitoringPKL'])->name('monitoring');

// Route filter monitoring
Route::get('/monitoring', [PembimbingController::class, 'filterMonitoring'])->name('filterMonitoring');

// Rute untuk halaman monitoring per siswa dengan parameter NIS
Route::get('/monitoring_persiswa/{nis}', [PembimbingController::class, 'monitoringPerSiswa'])->name('monitoring_persiswa');

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

Route::get('/export/detail-nilai-excel', [CetakController::class, 'exportDetailNilaiExcel'])->name('export.detail.nilai.excel');
Route::get('/export/detail-nilai-pdf', [CetakController::class, 'exportDetailNilaiPDF'])->name('export.detail.nilai.pdf');

Route::get('/admin/insert-to-monitoring', [AdminController::class, 'insertToMonitoring'])->name('admin.insertToMonitoring');

Route::post('/monitoring/{nis}', [PembimbingController::class, 'uploadMonitoring'])->name('monitoring.upload');
