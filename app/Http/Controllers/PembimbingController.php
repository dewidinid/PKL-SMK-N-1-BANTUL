<?php

namespace App\Http\Controllers;

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
        return view('monitoring');
    }

    public function monitoringPerSiswa()
    {
        return view('monitoring_persiswa');
    }

    public function evaluasiPKL()
    {
        return view('evaluasi');
    }

    public function evaluasiPerSiswa()
    {
        return view('evaluasi_persiswa');

    }
    
    public function hasilNilaiPKL()
    {
        // Anda dapat mengirimkan data ke view jika diperlukan
        return view('hasil_nilaipkl');
    }

    public function hasilLaporanPengimbasan()
    {
        // Anda dapat mengirimkan data ke view jika diperlukan
        return view('hasil_laporanpengimbasan');
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
