<?php

namespace App\Http\Controllers;

use App\Models\nilaiPKL;
use App\Models\LaporanJurnal;
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
        
        // Ambil semua data nilai PKL beserta relasinya
        $nilai_pkl = NilaiPkl::with('kelompok', 'siswa', 'siswaByNama', 'konsentrasiKeahlian', 'siswaByKelas', 'siswaByTahun')->get();

        // Kirimkan data ke view
        return view('nilai_pkl', ['nilai_pkl' => $nilai_pkl]);
    }

    public function uploadNilaiPKL(Request $request)
    {
        $request->validate([
            'nilai_pkl' => 'required|mimes:xlsx,xls|max:2048',  // Validate file type and size
        ]);

        $file = $request->file('nilai_pkl');
        $nis = $request->input('nis');  // Assuming NIS is passed as a form input

        // Define the file path
        $filePath = 'public/nilai_pkl/nilai_pkl_' . $nis . '.xlsx';

        // Store the file in storage/app/public/nilai_pkl directory
        $file->storeAs('public/nilai_pkl', 'nilai_pkl_' . $nis . '.xlsx');

        return back()->with('success', 'File Nilai PKL berhasil di-upload.');
    }

    public function dudiLaporanJurnal()
    {   
        // Ambil semua data laporan jurnal beserta relasinya
        $laporan_jurnal = LaporanJurnal::with('siswa', 'siswaByNama', 'dudi')->get();

        // Kirimkan data ke view
        return view('dudi_laporanjurnal', ['laporan_jurnal' => $laporan_jurnal]);
    }    

}
