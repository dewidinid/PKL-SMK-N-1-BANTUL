<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Rap2hpoutre\FastExcel\FastExcel;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon; 
use App\Models\NilaiPkl;
use App\Models\LaporanJurnal;
use App\Models\Siswa;

class DudiController extends Controller
{
    
    public function indexDudi()
    {
        // Ambil tanggal hari ini
        $today = Carbon::today();

        // Filter laporan jurnal yang diunggah pada hari ini
        $laporan_jurnal = LaporanJurnal::whereDate('tanggal', $today)
                        ->with(['kelompok', 'siswa', 'konsentrasiKeahlian', 'siswaByKelas', 'siswaByTahun'])
                        ->get();

        // Kirimkan data yang difilter ke view 'home_dudi'
        return view('home_dudi', compact('laporan_jurnal'));
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
        // Validasi file Excel
        $request->validate([
            'nilai_pkl' => 'required|mimes:xlsx,xls|max:2048',
        ]);

        // Simpan file Excel
        $file = $request->file('nilai_pkl');
        $filePath = 'public/nilai_pkl/nilai_pkl_' . time() . '.xlsx';
        $file->storeAs('public/nilai_pkl', $filePath);

        // Ambil isi file Excel
        $fileContent = (new FastExcel)->import(Storage::path($filePath));

        // Ambil header kolom dari Excel
        $headers = array_keys($fileContent->first()->toArray());

        // Ambil nilai total dari setiap siswa
        $nilaiPkl = [];
        foreach ($fileContent as $row) {
            $nilaiPkl[] = [
                'NIS' => $row['NIS'],
                'Nama' => $row['Nama'],
                // Asumsikan 'Total Nilai' adalah kolom dalam file Excel
                'Total Nilai' => $row['Total Nilai'],
            ];
        }

        // Kirim data header dan nilai ke view 'nilai_pkl'
        return view('nilai_pkl', [
            'headers' => $headers,
            'nilai_pkl' => $nilaiPkl,
        ])->with('success', 'File Nilai PKL berhasil di-upload.');
    }


    public function exportNilai()
    {
        // Ambil data yang ingin diekspor
        $nilai = Siswa::with('nilai')->get()->map(function ($siswa) {
            return [
                'NIS' => $siswa->NIS,
                'Nama Siswa' => $siswa->nama_siswa,
                'Softskills' => $siswa->nilai->softskills,
                'Teknical Skills' => $siswa->nilai->technical_skills,
                'Total Nilai' => $siswa->nilai->total_nilai,
            ];
        });

        // Ekspor data ke Excel
        return (new FastExcel($nilai))->download('nilai_pkl.xlsx');
    }

    public function dudiLaporanJurnal()
    {
        // Ambil semua data laporan jurnal beserta relasinya
        $laporan_jurnal = LaporanJurnal::with(['kelompok', 'siswa', 'konsentrasiKeahlian', 'siswaByKelas', 'siswaByTahun'])->get();

        // Kirimkan data ke view
        return view('dudi_laporanjurnal', compact('laporan_jurnal'));
    }

    // Tambahkan metode baru untuk laporan jurnal per siswa
    public function dudiLaporanJurnalPerSiswa()
    //$nis
    {
        // Ambil data siswa berdasarkan NIS
        // $siswa = Siswa::where('NIS', $nis)->firstOrFail();

        // Ambil laporan jurnal siswa berdasarkan NIS
        // $jurnals = LaporanJurnal::where('NIS', $nis)->get();

        // Kirimkan data siswa dan jurnal ke view
        return view('dudi_laporanjurnal_persiswa');
        //, compact('siswa', 'jurnals')
    }
 

}
