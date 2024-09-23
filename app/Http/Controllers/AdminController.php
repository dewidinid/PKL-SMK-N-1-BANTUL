<?php

namespace App\Http\Controllers;
use App\Models\Siswa;
use App\Models\Pembimbing;
use App\Models\Dudi;
use App\Models\Ploting;
use App\Models\NilaiPkl;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function indexAdmin()
    {
        // Anda dapat mengirimkan data ke view jika diperlukan
        return view('home_admin');
    }
    
    public function dataSiswa()
    {
        $siswa = Siswa::with('konsentrasiKeahlian', 'kelompok', 'dudi')->get();

        // Anda dapat mengirimkan data ke view jika diperlukan
        return view('data_siswa', ['siswa' => $siswa]);
    }


    public function plotingSiswa()
    {
        $ploting = Ploting::with('kelompok', 'siswa', 'pembimbing', 'dudi')->get();
        // Anda dapat mengirimkan data ke view jika diperlukan
        return view('ploting_siswa', ['ploting' => $ploting]);
    }


}

