<?php

namespace App\Http\Controllers;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Rap2hpoutre\FastExcel\FastExcel;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon; 
use App\Models\NilaiPkl;
use App\Models\LaporanJurnal;
use App\Models\Siswa;
use App\Models\Ploting;

class DudiController extends Controller
{
    
    public function indexDudi(Request $request)
    {

        if (!Auth::guard('dudi')->check()) {
            return redirect()->route('login')->withErrors('Anda tidak memiliki akses ke halaman ini.');
        }
    
        // Ambil data Dudi yang sedang login
        $dudi = Auth::guard('dudi')->user();
        $namaDudi = $dudi->nama_dudi;
    
        // Hitung jumlah siswa yang magang di Dudi ini
        $jumlahSiswa = Ploting::where('nama_dudi', $namaDudi)->count();

        $request->session()->put('nama_dudi', $dudi->nama_dudi);

        // Ambil tanggal hari ini
        // $today = Carbon::today();

        // $laporan_jurnal = LaporanJurnal::whereDate('tanggal', $today)
        //     ->whereHas('siswa', function ($query) use ($namaDudi) {
        //         $query->where('nama_dudi', $namaDudi);
        //     })
        //     ->with(['siswa'])
        //     ->get();

        // $laporan_jurnal = LaporanJurnal::whereDate('tanggal', $today)->with('siswa')->get();

         // Ambil tanggal hari ini
        $today = Carbon::today();

        // Ambil jurnal yang terkait dengan siswa magang di DUDI yang sedang login dan tanggal hari ini
        $laporan_jurnal = LaporanJurnal::whereDate('tanggal', $today)
            ->where('nama_dudi', $namaDudi) // Pastikan nama DUDI terkait
            ->with('siswa') // Eager load relasi siswa
            ->get();

        // dd($laporan_jurnal);
    

        // Kirimkan data yang difilter ke view 'home_dudi'
        return view('home_dudi', compact('laporan_jurnal', 'dudi', 'jumlahSiswa'));
    }

    public function daftarSiswaPKL(Request $request)
    {
        if (!Auth::guard('dudi')->check()) {
            return redirect()->route('login')->withErrors('Anda tidak memiliki akses ke halaman ini.');
        }

        // Ambil data Dudi yang sedang login
        $dudi = Auth::guard('dudi')->user();
        $namaDudi = $dudi->nama_dudi;

        // Ambil filter tahun dari request
        $tahun = $request->input('tahun');
        $kodeKelompok = $request->input('kode_kelompok'); 

        // Ambil data siswa dari tabel ploting berdasarkan nama_dudi dan filter tahun jika ada
        $query = Ploting::where('nama_dudi', $namaDudi)
            ->with('siswa'); // Mengambil relasi dengan model Siswa

        if ($tahun) {
            // Jika ada filter tahun, tambahkan ke query
            $query->whereHas('siswa', function($q) use ($tahun) {
                $q->where('tahun', $tahun);
            });
        }

        if ($kodeKelompok) {
            $query->where('kode_kelompok', $kodeKelompok); // Filter berdasarkan kode kelompok
        }


        // Dapatkan hasil query
        $ploting = $query->get();

        // Ambil semua tahun yang tersedia di data siswa untuk dropdown filter
        $availableYears = Ploting::where('nama_dudi', $namaDudi)
            ->with('siswa')
            ->get()
            ->pluck('siswa.tahun')
            ->unique()
            ->sortDesc();

        $availableKelompok = Ploting::where('nama_dudi', $namaDudi)
            ->pluck('kode_kelompok')
            ->unique();

        return view('daftar_pkl', compact('ploting', 'availableYears', 'availableKelompok' , 'tahun'));
    }

    public function nilaiPKL(Request $request)
    {
        // Ambil Dudi yang sedang login
        $dudi = Auth::guard('dudi')->user();
        $namaDudi = $dudi->nama_dudi;

        // Filter berdasarkan tahun dan konsentrasi keahlian
        $tahun = $request->input('tahun');
        $konsentrasiKeahlian = $request->input('konsentrasi_keahlian');
        $kodeKelompok = $request->input('kode_kelompok'); 

        // Query ke tabel ploting untuk mengambil data siswa
        $query = Ploting::with('siswa', 'nilaiPkl')->where('nama_dudi', $namaDudi);

        // Filter tahun dan konsentrasi keahlian
        if ($tahun) {
            $query->whereHas('siswa', function($q) use ($tahun) {
                $q->where('tahun', $tahun);
            });
        }

        if ($konsentrasiKeahlian) {
            $query->whereHas('siswa', function($q) use ($konsentrasiKeahlian) {
                $q->where('konsentrasi_keahlian', $konsentrasiKeahlian);
            });
        }

        if ($kodeKelompok) {
            $query->where('kode_kelompok', $kodeKelompok); // Filter berdasarkan kode kelompok
        }

        $nilai_pkl = $query->with('nilaiPkl')->get();

        $availableYears = Ploting::where('nama_dudi', $namaDudi)
            ->with('siswa')
            ->get()
            ->pluck('siswa.tahun')
            ->unique()
            ->sortDesc();

        $availableKonsentrasi = Ploting::where('nama_dudi', $namaDudi)
            ->with('siswa')
            ->get()
            ->pluck('siswa.konsentrasi_keahlian')
            ->unique();

        $availableKelompok = Ploting::where('nama_dudi', $namaDudi)
            ->pluck('kode_kelompok')
            ->unique();

        // Ambil total nilai untuk detail nilai
        $detail_nilai = $nilai_pkl->map(function ($item) {
            return [
                'NIS' => $item->siswa->NIS ?? 'N/A', // Mengambil NIS dari relasi siswa
                'Nama' => $item->siswa->nama_siswa ?? 'N/A', // Nama siswa dari relasi
                'Kelompok' => $item->siswa->kode_kelompok ?? 'N/A',
                'tp1_soft_skills' => $item->nilaiPkl->tp1_soft_skills ?? 0, 
                'tp2_norma_pos' => $item->nilaiPkl->tp2_norma_pos ?? 0,
                'tp3_kompetensi_teknis' => $item->nilaiPkl->tp3_kompetensi_teknis ?? 0,
                'tp4_wawasan_wirausaha' => $item->nilaiPkl->tp4_wawasan_wirausaha ?? 0,
                'Total Nilai' => $item->nilaiPkl->nilai ?? 0, // Total nilai dari nilaiPkl
            ];
        });        


        // Filter dan kirim data ke view
        return view('nilai_pkl', compact('nilai_pkl', 'detail_nilai', 'availableYears', 'availableKelompok' , 'availableKonsentrasi', 'tahun', 'konsentrasiKeahlian'));    
    }

    public function uploadNilaiPKL(Request $request, $nis)
    {
        // Validasi file Excel
        $request->validate([
            'file' => 'required|mimes:xlsx,xls|max:2048',
        ]);
    
        // Simpan file yang di-upload
        $file = $request->file('file');
        $fileName = $file->getClientOriginalName();
    
        // Simpan file ke direktori storage
        $filePath = 'public/nilai_pkl/' . $fileName;
        Storage::putFileAs('public/nilai_pkl', $file, $fileName);
    
        // Membaca file Excel dengan PHPSpreadsheet
        $spreadsheet = IOFactory::load(storage_path('app/' . $filePath));
        $sheet = $spreadsheet->getActiveSheet();
    
        // Ambil nilai dari masing-masing TP dengan validasi
        try {
            $tp1 = $sheet->rangeToArray('F15:F20', null, true, true, true);
            $tp1Score = array_sum(array_column($tp1, 'F')) / (count($tp1) ?: 1);
    
            $tp2 = $sheet->rangeToArray('F24:F29', null, true, true, true);
            $tp2Score = array_sum(array_column($tp2, 'F')) / (count($tp2) ?: 1);
    
            $tp3 = $sheet->rangeToArray('F33:F38', null, true, true, true);
            $tp3Score = array_sum(array_column($tp3, 'F')) / (count($tp3) ?: 1);
    
            $tp4 = $sheet->rangeToArray('F42:F48', null, true, true, true);
            $tp4Score = array_sum(array_column($tp4, 'F')) / (count($tp4) ?: 1);
    
            // Total nilai dari 4 TP
            $totalNilai = ($tp1Score + $tp2Score + $tp3Score + $tp4Score) / 4;
    
        } catch (\Exception $e) {
            return back()->withErrors('Gagal membaca nilai dari file. Pastikan format sesuai.');
        }
    
        // Simpan ke database
        $nilaiPkl = NilaiPkl::where('NIS', $nis)->first();
        if (!$nilaiPkl) {
            $nilaiPkl = new NilaiPkl();
            $nilaiPkl->NIS = $nis;
        }
        $nilaiPkl->file_path = $fileName;
        $nilaiPkl->tp1_soft_skills = $tp1Score;
        $nilaiPkl->tp2_norma_pos = $tp2Score;
        $nilaiPkl->tp3_kompetensi_teknis = $tp3Score;
        $nilaiPkl->tp4_wawasan_wirausaha = $tp4Score;
        $nilaiPkl->nilai = $totalNilai;
        $nilaiPkl->is_imported = 1;
        $nilaiPkl->save();
    
        // Redirect dengan pesan sukses
        return back()->with('success', 'File Nilai PKL berhasil di-upload.');
    }
    


    public function showNilaiPKLFile($fileName)
    {
        // Path file di storage
        $filePath = storage_path('app/public/nilai_pkl/' . $fileName);

        // Cek apakah file ada
        if (!file_exists($filePath)) {
            abort(404, 'File not found.');
        }

        // Mengirim response file untuk dilihat di browser
        return response()->file($filePath, [
            'Content-Disposition' => 'inline; filename="' . $fileName . '"'
        ]);
    }


    public function dudiLaporanJurnal(Request $request)
    {
        // Ambil data Dudi yang sedang login
        $dudi = Auth::guard('dudi')->user();
        $namaDudi = $dudi->nama_dudi;

        // Filter berdasarkan tahun dan konsentrasi keahlian
        $tahun = $request->input('tahun');
        $konsentrasiKeahlian = $request->input('konsentrasi_keahlian');
        $kodeKelompok = $request->input('kode_kelompok'); 

        // Ambil data siswa dari tabel ploting berdasarkan nama_dudi dan filter tahun jika ada
        $query = Ploting::where('nama_dudi', $namaDudi)
        ->with('siswa'); // Mengambil relasi dengan model Siswa

        // Filter tahun dan konsentrasi keahlian
        if ($tahun) {
            $query->whereHas('siswa', function($q) use ($tahun) {
                $q->where('tahun', $tahun);
            });
        }

        if ($konsentrasiKeahlian) {
            $query->whereHas('siswa', function($q) use ($konsentrasiKeahlian) {
                $q->where('konsentrasi_keahlian', $konsentrasiKeahlian);
            });
        }

        if ($kodeKelompok) {
            $query->where('kode_kelompok', $kodeKelompok); // Filter berdasarkan kode kelompok
        }

        // Dapatkan hasil query
        $ploting = $query->get();

        $availableYears = Ploting::where('nama_dudi', $namaDudi)
            ->with('siswa')
            ->get()
            ->pluck('siswa.tahun')
            ->unique()
            ->sortDesc();

        $availableKonsentrasi = Ploting::where('nama_dudi', $namaDudi)
            ->with('siswa')
            ->get()
            ->pluck('siswa.konsentrasi_keahlian')
            ->unique();

        $availableKelompok = Ploting::where('nama_dudi', $namaDudi)
            ->pluck('kode_kelompok')
            ->unique();


        // Kirimkan data ke view
        return view('dudi_laporanjurnal', compact('ploting', 'availableYears', 'availableKelompok' , 'availableKonsentrasi', 'tahun', 'konsentrasiKeahlian'));
    }


    public function dudiLaporanJurnalPerSiswa(Request $request, $nis)
    {
        // Ambil data Dudi yang sedang login
        $dudi = Auth::guard('dudi')->user();
        $namaDudi = $dudi->nama_dudi;

        // Ambil data siswa berdasarkan NIS dan pastikan siswa terkait dengan DUDI yang login
        $siswa = Siswa::where('NIS', $nis)
            ->whereHas('ploting', function($query) use ($namaDudi) {
                $query->where('nama_dudi', $namaDudi);
            })
            ->firstOrFail();

        $ploting = Ploting::where('NIS', $siswa->NIS)->first();

        // Ambil filter bulan dan tahun dari request
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');

        // Ambil laporan jurnal siswa berdasarkan NIS, bulan, dan tahun
        $query = LaporanJurnal::where('NIS', $nis);

        if ($bulan) {
            $query->whereMonth('tanggal', $bulan);
        }

        if ($tahun) {
            $query->whereYear('tanggal', $tahun);
        }

        // Eksekusi query
        $jurnals = $query->get();

        $availableYears = LaporanJurnal::where('NIS', $nis)
            ->selectRaw('YEAR(tanggal) as year')
            ->distinct()
            ->pluck('year');
        
            //dd($availableYears);


        // Kirimkan data siswa dan jurnal ke view
        return view('dudi_laporanjurnal_persiswa', compact('siswa', 'ploting','jurnals', 'bulan', 'tahun', 'availableYears'));
    }   
 

}
