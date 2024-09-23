<?php

namespace App\Http\Controllers;

use App\Models\Monitoring;
use App\Models\evaluasi;
use App\Models\NilaiPKL;
use App\Models\LaporanPengimbasan;
use Illuminate\Http\Request;

class PembimbingController extends Controller
{
    public function indexPembimbing()
    {
        // Anda dapat mengirimkan data ke view jika diperlukan
        return view('home_pembimbing');
    }

    public function monitoringPKL()
    {
        // Ambil data monitoring beserta relasinya
        $monitoring = Monitoring::with('siswa', 'kelompok', 'siswaByNama', 'konsentrasiKeahlian', 'siswaByKelas', 'siswaByTahun')->get();

        // Kirim data ke view
        return view('monitoring', ['monitoring' => $monitoring]);
    }

    public function monitoringPerSiswa($nis)
    {
        $monitoring = Monitoring::with('siswa', 'kelompok', 'siswaByNama', 'konsentrasiKeahlian', 'siswaByKelas', 'siswaByTahun')->where('NIS', $nis)->get();

        // Ambil data detail monitoring (contoh untuk detail per bulan)
        $detailMonitoring = MonitoringDetail::where('NIS', $nis)->get();

        // Hitung total nilai dan rata-rata
        $totalNilai = $detailMonitoring->sum('nilai_akhir');
        $rataRata = $detailMonitoring->avg('nilai_akhir');

        // Kirim data monitoring, detail monitoring, total nilai, dan rata-rata ke view
        return view('monitoring_persiswa', [
            'monitoring' => $monitoring,
            'detailMonitoring' => $detailMonitoring,
            'totalNilai' => $totalNilai,
            'rataRata' => $rataRata
        ]);

    }

    public function evaluasiPKL()
    {
        // Ambil semua data evaluasi
        $evaluasi = Evaluasi::all();
    
        // Return ke view evaluasi dengan data evaluasi
        return view('evaluasi', compact('evaluasi'));
    }

    public function evaluasiPerSiswa($nis)
    {
        // Ambil data evaluasi berdasarkan NIS siswa
        $siswa = Siswa::where('NIS', $nis)->first();
        $evaluasi = Evaluasi::where('NIS', $nis)->get();
        
        // Kirim data siswa dan evaluasi ke view
        return view('evaluasi_persiswa', compact('siswa', 'evaluasi'));
    }
    
    public function hasilNilaiPKL()
    {
        // Ambil semua data nilai PKL
        $nilaiPkl = NilaiPkl::with('kelompok', 'siswaByNama', 'konsentrasiKeahlian', 'siswaByKelas', 'siswaByTahun')->get();

        // Kirim data ke view
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
        return view('pembimbing_laporanjurnal');
    }

    public function hasilLaporanAkhir()
    {
        return view('hasil_laporanakhir');
    }
}
