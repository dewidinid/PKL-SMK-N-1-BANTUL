<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DudiController extends Controller
{
    
    public function indexDudi()
    {
        // Anda dapat mengirimkan data ke view jika diperlukan
        return view('home_dudi');
    }

    public function nilaiPKL()
    {
        // Anda dapat mengirimkan data ke view jika diperlukan
        return view('nilai_pkl');
    }

    public function hasilLaporanJurnal()
    {
        return view('hasil_laporanjurnal');
    }

}
