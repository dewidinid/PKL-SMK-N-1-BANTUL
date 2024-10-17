<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Rap2hpoutre\FastExcel\FastExcel;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Siswa;
use App\Models\Monitoring;
use App\Models\Evaluasi;
use App\Models\NilaiPKL;
use App\Models\LaporanPengimbasan;
use App\Models\LaporanJurnal;
use App\Models\LaporanAkhir;


class PembimbingController extends Controller
{
    public function indexPembimbing()
    {
        // Mendapatkan Pembimbing yang sedang login
        //$pembimbing = Auth::user(); // Mengambil data Pembimbing yang sedang login
        
        // Mendapatkan data yang relevan, misalnya, siswa yang dibimbing
        //$siswaList = Siswa::where('id_pembimbing', $pembimbing->NIP_NIK)->get(); // Contoh query

        return view('home_pembimbing'); // Mengirim data ke view
        // , compact('pembimbing', 'siswaList')
    }

    public function monitoringPKL()
    {
        // Ambil data monitoring beserta relasinya
        $monitoring = Monitoring::with('siswa', 'kelompok', 'konsentrasiKeahlian', 'siswaByKelas', 'siswaByTahun')->get();

        // Kirim data ke view
        return view('monitoring', ['monitoring' => $monitoring]);
    }

    public function monitoringPerSiswa()
    //$nis
    {
        // Ambil data siswa berdasarkan NIS
        //$siswa = Siswa::where('NIS', $nis)->firstOrFail();

        // Ambil data monitoring terkait siswa
        //$monitoring = Monitoring::where('NIS', $nis)->get();

        // Hitung total nilai dan rata-rata
        //$totalNilai = $monitoring->sum('nilai');
        //$rataRata = $monitoring->avg('nilai');

        // Jika ada data yang diimpor, ambil header dan data Excel
        //$headerNames = session('headerNames') ?? [];
        //$excelData = session('excelData') ?? [];

        // Clear session setelah data ditampilkan
        session()->forget(['headerNames', 'excelData']);

        return view('monitoring_persiswa');
        //, compact('siswa', 'monitoring', 'totalNilai', 'rataRata', 'headerNames', 'excelData')
    }

    public function importMonitoring(Request $request)
    //, $nis
    {
        // Validasi file yang diupload
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls,csv',
        ]);

        $path = $request->file('file')->getRealPath();

        // Import data menggunakan FastExcel
        $excelData = (new FastExcel)->import($path);

        // Ambil header dari baris pertama
        $headers = $excelData->first();
        $headerNames = array_keys($headers);

        // Simpan header dan data ke session untuk ditampilkan di view
        session(['headerNames' => $headerNames, 'excelData' => $excelData]);

        // Aktifkan tombol import dengan data di session
        return redirect()->route('monitoring_persiswa', ['nis' => $nis])->with('success', 'File berhasil diunggah. Silakan klik Import.');
    }

    public function evaluasiPKL()
    {
        // Ambil semua data evaluasi
        $evaluasi = Evaluasi::all();
    
        // Return ke view evaluasi dengan data evaluasi
        return view('evaluasi', compact('evaluasi'));
    }

    public function evaluasiPerSiswa()
    //$nis
    {
        // Ambil data siswa
        //$siswa = Siswa::where('NIS', $nis)->firstOrFail();
        
        // Hitung nilai jurnal
        //$jurnal = LaporanJurnal::where('NIS', $nis)->count();
        //$jurnalTotal = 6 * 20; // Total 120 input untuk 6 bulan
        //$persentaseJurnal = ($jurnal / $jurnalTotal) * 10; // Bobot 10%

        // Ambil nilai PKL Dudi
        // $nilaiPklDudi = NilaiPkl::where('NIS', $nis)->first()->nilai;
        // $nilaiAkhirDudi = ($nilaiPklDudi * 50) / 100; // Bobot 50%

        // Ambil nilai monitoring pembimbing
        // $monitoring = Monitoring::where('NIS', $nis)->first();
        // $nilaiMonitoring = ($monitoring->nilai_total * 20) / 100; // Bobot 20%

        // // Cek apakah laporan pengimbasan diunggah
        // $pengimbasanUploaded = LaporanPengimbasan::where('NIS', $nis)->exists();
        // $nilaiPengimbasan = $pengimbasanUploaded ? 10 : 0; // Bobot 10%

        // // Cek apakah laporan akhir diunggah
        // $laporanAkhirUploaded = LaporanAkhir::where('NIS', $nis)->exists();
        // $nilaiAkhirPKL = $laporanAkhirUploaded ? 10 : 0; // Bobot 10%

        // // Hitung total nilai
        // $totalNilai = $persentaseJurnal + $nilaiAkhirDudi + $nilaiMonitoring + $nilaiPengimbasan + $nilaiAkhirPKL;

        // Kirim data ke view
        return view('evaluasi_persiswa');
        //, compact('siswa', 'persentaseJurnal', 'nilaiAkhirDudi', 'nilaiMonitoring', 'nilaiPengimbasan', 'nilaiAkhirPKL', 'totalNilai')
    }

    
    public function hasilNilaiPKL()
    {
        // Ambil semua data nilai PKL termasuk total nilai dari file Excel atau database
        $nilaiPkl = NilaiPkl::with('kelompok', 'siswaByNama', 'konsentrasiKeahlian', 'siswaByKelas', 'siswaByTahun')->get();

        // Kirim data ke view 'hasil_nilaipkl'
        return view('hasil_nilaipkl', ['nilaiPkl' => $nilaiPkl]);
    }


    public function hasilLaporanPengimbasan()
    {
        // Ambil semua data laporan pengimbasan
        $laporanPengimbasan = LaporanPengimbasan::with('kelompok', 'siswaByNama', 'konsentrasiKeahlian', 'siswaByKelas', 'dudi')->get();

        // Kirim data ke view
        return view('hasil_laporanpengimbasan', ['laporanPengimbasan' => $laporanPengimbasan]);
    }

    public function pembimbingLaporanJurnal()
    {
        $laporan_jurnal = LaporanJurnal::with(['kelompok', 'siswa', 'konsentrasiKeahlian', 'siswaByKelas', 'siswaByTahun'])->get();
        return view('pembimbing_laporanjurnal', compact('laporan_jurnal'));
    }

    // Tambahkan metode baru untuk laporan jurnal per siswa
    public function pembimbingLaporanJurnalPerSiswa()
    //$nis
    {
        // Ambil data siswa berdasarkan NIS
        //$siswa = Siswa::where('NIS', $nis)->firstOrFail();

        // Ambil laporan jurnal siswa
        //$jurnals = LaporanJurnal::where('NIS', $nis)->get();

        return view('pembimbing_laporanjurnal_persiswa');
        //, compact('siswa', 'jurnals')
    }


    public function hasilLaporanAkhir()
    {
        return view('hasil_laporanakhir');
    }
}
