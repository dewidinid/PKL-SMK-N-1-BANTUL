<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Dudi;
use App\Models\Pembimbing;

class DashboardController extends Controller
{
    public function index()
    {
        $jumlahSiswa = Siswa::count();
        $jumlahPembimbing = Pembimbing::count();
        $jumlahDudi = Dudi::count();
        // Anda dapat mengirimkan data ke view jika diperlukan
        return view('dashboard', compact('jumlahSiswa', 'jumlahPembimbing', 'jumlahDudi'));
    }
}
