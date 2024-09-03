<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function indexAdmin()
    {
        // Anda dapat mengirimkan data ke view jika diperlukan
        return view('home_admin');
    }
    
    public function suratPengajuan()
    {
        // Mengambil data pengajuan PKL dari database
        // $pengajuanPkl = PengajuanPkl::all(); // Ambil semua data pengajuan PKL

        // Mengirimkan data ke view
        return view('suratpengajuanmandiri');
    }

    public function guruPembimbing()
    {
        // Mengirimkan data ke view
        return view('guru_pembimbing');
    }
}
