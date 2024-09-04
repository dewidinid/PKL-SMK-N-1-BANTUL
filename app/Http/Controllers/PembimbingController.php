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
}
