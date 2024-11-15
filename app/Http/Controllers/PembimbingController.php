<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Http\Request;
use Rap2hpoutre\FastExcel\FastExcel;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Siswa;
use App\Models\Monitoring;
use App\Models\MonitoringPerSiswa;
use App\Models\Evaluasi;
use App\Models\NilaiPKL;
use App\Models\LaporanPengimbasan;
use App\Models\LaporanJurnal;
use App\Models\LaporanAkhir;
use App\Models\Pembimbing;
use App\Models\Ploting;

class PembimbingController extends Controller
{
    public function indexPembimbing()
    {
        $nipNikPembimbing = Auth::user()->nip_nik;
    
        $siswaList = Ploting::with('siswa')->where('NIP_NIK', $nipNikPembimbing)->get();
    
        return view('home_pembimbing', compact('siswaList'));
    }

    public function monitoringPKL(Request $request)
{
    if (!auth('pembimbing')->check()) {
        return redirect()->route('login')->withErrors('Anda harus login terlebih dahulu.');
    }

    $nipNik = auth('pembimbing')->user()->NIP_NIK;

    // Sinkronisasi data ploting ke tabel monitoring
    $plotingData = Ploting::with('siswa', 'pembimbing')
        ->where('NIP_NIK', $nipNik)
        ->get();

    // Update atau insert data monitoring berdasarkan ploting
    foreach ($plotingData as $ploting) {
        Monitoring::updateOrCreate(
            ['NIS' => $ploting->siswa->NIS],
            [
                'NIS' => $ploting->siswa->NIS,
                'kode_kelompok' => $ploting->kode_kelompok,
                'nama_siswa' => $ploting->siswa->nama_siswa,
                'konsentrasi_keahlian' => $ploting->siswa->konsentrasi_keahlian,
                'kelas' => $ploting->siswa->kelas,
                'kode_dudi' => $ploting->kode_dudi,
                'nama_dudi' => $ploting->nama_dudi,
                'NIP_NIK' => $ploting->pembimbing->NIP_NIK,
                'nama_pembimbing' => $ploting->pembimbing->nama_pembimbing,
                'tahun' => $ploting->siswa->tahun,
            ]
        );
    }

    // Mengambil opsi filter
    $tahunOptions = Siswa::whereHas('ploting', function($query) use ($nipNik) {
        $query->where('NIP_NIK', $nipNik);
    })->distinct()->pluck('tahun');

    $konsentrasiOptions = Siswa::whereHas('ploting', function($query) use ($nipNik) {
        $query->where('NIP_NIK', $nipNik);
    })->distinct()->pluck('konsentrasi_keahlian');

    $kodeKelompokOptions = Ploting::where('NIP_NIK', $nipNik)->distinct()->pluck('kode_kelompok');


    // Query Monitoring sesuai dengan filter
    $query = Monitoring::with('siswa')->where('NIP_NIK', $nipNik);

    if ($request->has('tahun') && $request->tahun !== 'Tahun') {
        $query->whereHas('siswa', function ($q) use ($request) {
            $q->where('tahun', $request->tahun);
        });
    }

    if ($request->has('konsentrasi_keahlian') && $request->konsentrasi_keahlian !== 'Konsentrasi Keahlian') {
        $query->whereHas('siswa', function ($q) use ($request) {
            $q->where('konsentrasi_keahlian', $request->konsentrasi_keahlian);
        });
    }

    if ($request->has('kode_kelompok') && $request->kode_kelompok !== 'Kode Kelompok') {
        $query->where('kode_kelompok', $request->kode_kelompok);
    }

    // Mengambil hasil query
    $monitoring = $query->get();

    return view('monitoring', compact('monitoring', 'tahunOptions', 'konsentrasiOptions', 'kodeKelompokOptions'));
}

    
    // public function filterMonitoring(Request $request)
    // {
    //     if (!auth('pembimbing')->check()) {
    //         return redirect()->route('login')->withErrors('Anda harus login terlebih dahulu.');
    //     }

    //     $nipNik = auth('pembimbing')->user()->NIP_NIK;

    //     $tahun = Monitoring::where('NIP_NIK', $nipNik)->select('tahun')->distinct()->pluck('tahun');
    //     $konsentrasi_keahlian = Monitoring::where('NIP_NIK', $nipNik)->select('konsentrasi_keahlian')->distinct()->pluck('konsentrasi_keahlian');
    //     $kodeKelompokOptions = Ploting::where('NIP_NIK', $nipNik)->distinct()->pluck('kode_kelompok');

        
    //     $query = Monitoring::with('siswa')->where('NIP_NIK', $nipNik);

    //     if ($request->filled('tahun') && $request->tahun != 'Tahun') {
    //         $query->where('tahun', $request->tahun);
    //     }

    //     if ($request->filled('konsentrasi_keahlian') && $request->konsentrasi_keahlian != 'Konsentrasi Keahlian') {
    //         $query->where('konsentrasi_keahlian', $request->konsentrasi_keahlian);
    //     }

    //     if ($request->filled('kode_kelompok') && $request->kode_kelompok != 'Kode Kelompok') {
    //         $query->where('kode_kelompok', $request->kode_kelompok);
    //     }

    //     $monitoring = $query->get();

    //     return view('monitoring', compact('monitoring', 'tahun', 'konsentrasi_keahlian', 'kode_kelompok'));
    // }

//     public function filterMonitoring(Request $request)
// {
//     if (!auth('pembimbing')->check()) {
//         return redirect()->route('login')->withErrors('Anda harus login terlebih dahulu.');
//     }

//     $nipNik = auth('pembimbing')->user()->NIP_NIK;

//     // Ambil data filter berdasarkan pembimbing login
//     $tahun = Ploting::where('NIP_NIK', $nipNik)->distinct()->pluck('tahun');
//     $konsentrasi_keahlian = Ploting::where('NIP_NIK', $nipNik)->distinct()->pluck('konsentrasi_keahlian');
//     $kodeKelompokOptions = Ploting::where('NIP_NIK', $nipNik)->distinct()->pluck('kode_kelompok');

//     // Query Monitoring sesuai dengan filter
//     $query = Monitoring::with('siswa')->where('NIP_NIK', $nipNik);

//     if ($request->filled('tahun')) {
//         $query->where('tahun', $request->tahun);
//     }

//     if ($request->filled('konsentrasi_keahlian')) {
//         $query->where('konsentrasi_keahlian', $request->konsentrasi_keahlian);
//     }

//     if ($request->filled('kode_kelompok')) {
//         $query->where('kode_kelompok', $request->kode_kelompok);
//     }

//     // Dapatkan hasil query
//     $monitoring = $query->get();

//     return view('monitoring', [
//         'monitoring' => $monitoring,
//         'tahun' => $tahun,
//         'konsentrasi_keahlian' => $konsentrasi_keahlian,
//         'kodeKelompokOptions' => $kodeKelompokOptions
//     ]);
// }


    public function monitoringPerSiswa($nis)
    {
        $monitoringPerSiswa = MonitoringPerSiswa::where('NIS', $nis)->get();
        $siswa = Siswa::where('NIS', $nis)->first(); 
        $ploting = Ploting::all();
        

        // Debugging untuk memastikan data ada sebelum di-render
        // dd($monitoringPerSiswa, $siswa); 

        return view('monitoring_persiswa', compact('monitoringPerSiswa', 'siswa', 'nis', 'ploting'));
    }

    public function uploadMonitoring(Request $request, $nis)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls,csv',
        ]);

        $uploadCount = MonitoringPerSiswa::where('NIS', $nis)->count();
        if ($uploadCount >= 6) {
            return redirect()->route('monitoring_persiswa', ['nis' => $nis])->with('error', 'Maksimal 6 kali upload.');
        }

        // dapat file yang diupload
        $file = $request->file('file');

        // Baca file Excel menggunakan PhpSpreadsheet
        $spreadsheet = IOFactory::load($file->getPathname());
        $worksheet = $spreadsheet->getActiveSheet();

        $nilai_tp1 = $worksheet->getCell('F21')->getCalculatedValue();
        $nilai_tp2 = $worksheet->getCell('F30')->getCalculatedValue();
        $nilai_tp3 = $worksheet->getCell('F39')->getCalculatedValue();
        $nilai_tp4 = $worksheet->getCell('F49')->getCalculatedValue();
        $nilai_monitoring = $worksheet->getCell('F51')->getCalculatedValue();

        $data = [
            'NIS' => $nis,
            'nilai_tp1' => $nilai_tp1,
            'nilai_tp2' => $nilai_tp2,
            'nilai_tp3' => $nilai_tp3,
            'nilai_tp4' => $nilai_tp4,
            'nilai_monitoring' => $nilai_monitoring,
        ];

        MonitoringPerSiswa::create($data);

        // Jika sudah 6 kali upload, hitung nilai akhir
        if ($uploadCount == 5) { 
            $monitoringPerSiswa = MonitoringPerSiswa::where('NIS', $nis)->get();

            $totalNilai = $monitoringPerSiswa->sum('nilai');

            $nilai_akhir = $totalNilai / 6;  

            foreach ($monitoringPerSiswa as $monitoringsiswa) {
                $monitoringsiswa->update(['nilai_akhir' => $nilai_akhir]);
            }
        }

        return redirect()->route('monitoring_persiswa', ['nis' => $nis])->with('success', 'File berhasil diunggah dan disimpan.');
    }

    public function evaluasiPKL(Request $request)
    {
        if (!auth('pembimbing')->check()) {
            return redirect()->route('login')->withErrors('Anda harus login terlebih dahulu.');
        }

        $nipNik = auth('pembimbing')->user()->NIP_NIK;

        $tahun = $request->input('tahun');
        $konsentrasi_keahlian = $request->input('konsentrasi_keahlian');
        $kode_kelompok = $request->input('kode_kelompok');

        $dataEvaluasi = Ploting::with('siswa')
            ->where('NIP_NIK', $nipNik) // Filter berdasarkan NIP_NIK pembimbing yang login
            ->when($kode_kelompok, function ($query) use ($kode_kelompok) {
                $query->where('kode_kelompok', $kode_kelompok);
            })
            ->whereHas('siswa', function ($query) use ($tahun, $konsentrasi_keahlian) {
                if ($tahun) {
                    $query->where('tahun', $tahun);
                }
                if ($konsentrasi_keahlian) {
                    $query->where('konsentrasi_keahlian', $konsentrasi_keahlian);
                }
            })
            ->get();

        $tahunOptions = Siswa::select('tahun')->distinct()->pluck('tahun');
        $keahlianOptions = Siswa::select('konsentrasi_keahlian')->distinct()->pluck('konsentrasi_keahlian');
        $kodeKelompokOptions = Ploting::where('NIP_NIK', $nipNik)->distinct()->pluck('kode_kelompok');

        return view('evaluasi', compact('dataEvaluasi', 'tahunOptions', 'keahlianOptions', 'kodeKelompokOptions'));
    }

    public function evaluasiPerSiswa($nis)
    {
        // Ambil data siswa dan ploting berdasarkan NIS
        $siswa = Siswa::with('ploting')->where('NIS', $nis)->firstOrFail();
        $ploting = Ploting::all();

        // Hitung komponen evaluasi lainnya
        $jurnal = LaporanJurnal::where('NIS', $nis)->count();
        $jurnalTotal = 6 * 20;
        $nilaiJurnal = ($jurnal >= $jurnalTotal) ? 100 : ($jurnal / $jurnalTotal) * 100;
        $persentaseJurnal = ($nilaiJurnal * 10) / 100;
        $nilaiJurnalFull = min(($jurnal / $jurnalTotal) * 100, 100);

        $nilaiPklDudi = NilaiPkl::where('NIS', $nis)->first();
        $nilaiAkhirDudi = $nilaiPklDudi ? ($nilaiPklDudi->nilai * 50) / 100 : 0;
        $nilaiDudiFull = $nilaiPklDudi ? $nilaiPklDudi->nilai : 0;

        // Ambil data monitoring dan hitung rata-rata
        $monitoringPerSiswa = MonitoringPerSiswa::where('NIS', $nis)->get();
        $jumlahUploadMonitoring = $monitoringPerSiswa->count();

        $nilaiAkhirMonitoring = $monitoringPerSiswa->avg('nilai_monitoring');
        $nilaiMonitoring = $nilaiAkhirMonitoring ? ($nilaiAkhirMonitoring * 20) / 100 : 0;
        $nilaiMonitoringFull = min(($jumlahUploadMonitoring / 6) * 100, 100);

        // Tentukan status warna untuk monitoring
        if ($jumlahUploadMonitoring >= 6) {
            $statusMonitoringColor = 'text-success'; // Hijau jika sudah 6 kali upload
        } elseif ($jumlahUploadMonitoring > 0 && $jumlahUploadMonitoring < 6) {
            $statusMonitoringColor = 'text-warning'; // Kuning jika belum mencapai 6 kali upload
        } else {
            $statusMonitoringColor = 'text-danger'; // Merah jika belum ada upload
        }

        // Nilai Laporan Pengimbasan (10% dari 100 jika sudah di-approve)
        $laporanPengimbasan = LaporanPengimbasan::where('NIS', $nis)->first();
        $nilaiPengimbasan = ($laporanPengimbasan && $laporanPengimbasan->approved) ? 10 : 0;
        $nilaiPengimbasanFull = ($laporanPengimbasan && $laporanPengimbasan->approved) ? 100 : 0;

        // Nilai Laporan Akhir (10% dari 100 jika sudah di-approve)
        $laporanAkhir = LaporanAkhir::where('NIS', $nis)->first();
        $nilaiAkhirPKL = ($laporanAkhir && $laporanAkhir->approved) ? 10 : 0;
        $nilaiAkhirPKLFull = ($laporanAkhir && $laporanAkhir->approved) ? 100 : 0;

        // Total Nilai Akhir
        $totalNilai = $persentaseJurnal + $nilaiAkhirDudi + $nilaiMonitoring + $nilaiPengimbasan + $nilaiAkhirPKL;

        // Simpan atau perbarui data evaluasi di tabel `Evaluasi`
        Evaluasi::updateOrCreate(
            ['NIS' => $nis],
            [
                'kode_kelompok' => $siswa->ploting->kode_kelompok,
                'kode_dudi' => $siswa->ploting->kode_dudi,
                'nama' => $siswa->nama_siswa,
                'konsentrasi_keahlian' => $siswa->konsentrasi_keahlian,
                'kelas' => $siswa->kelas,
                'tahun' => $siswa->tahun,
                'nama_dudi' => $siswa->ploting->nama_dudi,
                'nilai_laporan_jurnalpkl' => $nilaiJurnal,
                'nilai_pkldudi' => $nilaiAkhirDudi,
                'nilai_akhir_monitoring' => $nilaiMonitoring,
                'nilai_pengimbasan' => $nilaiPengimbasanFull,
                'nilai_lap_akhir' => $nilaiAkhirPKLFull,
                'nilai_akhir' => $totalNilai,
            ]
        );

        return view('evaluasi_persiswa', compact(
            'siswa', 
            'nilaiJurnal', 
            'persentaseJurnal', 
            'nilaiAkhirDudi', 
            'nilaiDudiFull',
            'nilaiMonitoringFull', 
            'statusMonitoringColor',
            'nilaiPengimbasan', 
            'nilaiAkhirPKL', 
            'totalNilai', 
            'nilaiPengimbasanFull', 
            'nilaiAkhirPKLFull'
        ));
    }

    public function hasilNilaiPKL(Request $request)
    {
        if (!auth('pembimbing')->check()) {
            return redirect()->route('login')->withErrors('Anda harus login terlebih dahulu.');
        }

        $nipNik = auth('pembimbing')->user()->NIP_NIK;

        $tahunOptions = Siswa::distinct()->pluck('tahun');
        $konsentrasiOptions = Siswa::distinct()->pluck('konsentrasi_keahlian');
        $kodeKelompokOptions = Ploting::where('NIP_NIK', $nipNik)->distinct()->pluck('kode_kelompok');

        $query = Ploting::with([
            'siswa' => function ($query) {
                $query->select('NIS', 'nama_siswa', 'konsentrasi_keahlian', 'kelas', 'tahun');
            },
            'nilaiPkl' 
        ])->where('NIP_NIK', $nipNik);

        if ($request->filled('tahun') && $request->tahun !== 'Tahun') {
            $query->whereHas('siswa', function ($q) use ($request) {
                $q->where('tahun', $request->tahun);
            });
        }

        if ($request->filled('konsentrasi_keahlian') && $request->konsentrasi_keahlian !== 'Konsentrasi Keahlian') {
            $query->whereHas('siswa', function ($q) use ($request) {
                $q->where('konsentrasi_keahlian', $request->konsentrasi_keahlian);
            });
        }

        if ($request->filled('kode_kelompok') && $request->kode_kelompok !== 'Kode Kelompok') {
            $query->where('kode_kelompok', $request->kode_kelompok);
        }

        $hasil_nilaipkl = $query->get();

        return view('hasil_nilaipkl', [
            'hasil_nilaipkl' => $hasil_nilaipkl,
            'tahun' => $tahunOptions,
            'konsentrasi_keahlian' => $konsentrasiOptions,
            'kode_kelompok' => $kodeKelompokOptions,
        ]);
    }

    public function pembimbingLaporanJurnal(Request $request)
    {
        if (!auth('pembimbing')->check()) {
            return redirect()->route('login')->withErrors('Anda harus login terlebih dahulu.');
        }

        $nipNik = auth('pembimbing')->user()->NIP_NIK;

        $tahunOptions = Siswa::whereHas('ploting', function($query) use ($nipNik) {
            $query->where('NIP_NIK', $nipNik);
        })->distinct()->pluck('tahun');

        $konsentrasiOptions = Siswa::whereHas('ploting', function($query) use ($nipNik) {
            $query->where('NIP_NIK', $nipNik);
        })->distinct()->pluck('konsentrasi_keahlian');

        $kodeKelompokOptions = Ploting::where('NIP_NIK', $nipNik)->distinct()->pluck('kode_kelompok');

        $query = Ploting::with(['siswa' => function ($query) {
            $query->select('NIS', 'nama_siswa', 'konsentrasi_keahlian', 'kelas', 'tahun'); 
        }])->where('NIP_NIK', $nipNik);

        if ($request->has('tahun') && $request->tahun !== 'Tahun') {
            $query->whereHas('siswa', function ($q) use ($request) {
                $q->where('tahun', $request->tahun);
            });
        }

        if ($request->has('konsentrasi_keahlian') && $request->konsentrasi_keahlian !== 'Konsentrasi Keahlian') {
            $query->whereHas('siswa', function ($q) use ($request) {
                $q->where('konsentrasi_keahlian', $request->konsentrasi_keahlian);
            });
        }

        if ($request->has('kode_kelompok') && $request->kode_kelompok !== 'Kode Kelompok') {
            $query->where('kode_kelompok', $request->kode_kelompok);
        }

        $laporan_jurnal = $query->get();

        return view('pembimbing_laporanjurnal', compact('laporan_jurnal', 'tahunOptions', 'konsentrasiOptions', 'kodeKelompokOptions'));
    }


    public function pembimbingLaporanJurnalPerSiswa(Request $request, $nis)
    {
        $nipNik = auth('pembimbing')->user()->NIP_NIK;
        $ploting = Ploting::all();

        $siswa = Siswa::with(['ploting' => function($query) use ($nipNik) {
            $query->where('NIP_NIK', $nipNik);
        }])->where('NIS', $nis)->firstOrFail();

        $bulanOptions = LaporanJurnal::where('NIS', $nis)
            ->distinct()
            ->selectRaw('MONTH(tanggal) as bulan')
            ->pluck('bulan');

        $tahunOptions = LaporanJurnal::where('NIS', $nis)
            ->distinct()
            ->selectRaw('YEAR(tanggal) as tahun')
            ->pluck('tahun');

        $namaBulan = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];

        $query = LaporanJurnal::where('NIS', $nis);

        if ($request->has('bulan') && $request->bulan !== 'Bulan') {
            $query->whereMonth('tanggal', $request->bulan);
        }

        if ($request->has('tahun') && $request->tahun !== 'Tahun') {
            $query->whereYear('tanggal', $request->tahun);
        }

        $jurnals = $query->get();

        return view('pembimbing_laporanjurnal_persiswa', compact('siswa', 'jurnals', 'bulanOptions', 'tahunOptions', 'namaBulan'));
    }

    // public function sinkronisasiLaporanPengimbasan()
    // {
    //     $plotingData = Ploting::with('siswa')->get();

    //     foreach ($plotingData as $ploting) {
    //         $siswa = $ploting->siswa;

    //         if ($siswa) {
    //             $laporanPengimbasan = LaporanPengimbasan::where('NIS', $siswa->NIS)->first();

    //             if ($laporanPengimbasan) {
    //                 // Jika sudah ada, perbarui data terbaru dari tabel ploting
    //                 $laporanPengimbasan->kode_kelompok = $ploting->kode_kelompok;
    //                 $laporanPengimbasan->nis = $siswa->NIS;
    //                 $laporanPengimbasan->nama = $siswa->nama_siswa;
    //                 $laporanPengimbasan->konsentrasi_keahlian = $siswa->konsentrasi_keahlian;
    //                 $laporanPengimbasan->kelas = $siswa->kelas;
    //                 $laporanPengimbasan->kode_dudi = $ploting->kode_dudi;
    //                 $laporanPengimbasan->nama_dudi = $ploting->nama_dudi;

    //                 if (empty($laporanPengimbasan->laporan_pengimbasan)) {
    //                     $laporanPengimbasan->laporan_pengimbasan = null; 
    //                 }

    //                 $laporanPengimbasan->save(); 
    //             } else {
    //                 // Jika belum ada, entri baru di laporan_pengimbasan
    //                 LaporanPengimbasan::create([
    //                     'kode_kelompok' => $ploting->kode_kelompok,
    //                     'NIS' => $siswa->NIS,
    //                     'konsentrasi_keahlian' => $siswa->konsentrasi_keahlian,
    //                     'nama' => $ploting->nama_siswa,
    //                     'kelas' => $siswa->kelas,
    //                     'kode_dudi' => $ploting->kode_dudi,
    //                     'nama_dudi' => $ploting->nama_dudi,
    //                     'laporan_pengimbasan' => null ,
    //                     'approved' => false
    //                 ]);
    //             }
    //         }
    //     }
    // }

//     public function sinkronisasiLaporanPengimbasan()
// {
//     $plotingData = Ploting::with('siswa')->get();

//     foreach ($plotingData as $ploting) {
//         $siswa = $ploting->siswa;

//         if ($siswa) {
//             // Ambil data dari laporan_pengimbasan
//             $laporanPengimbasan = LaporanPengimbasan::where('NIS', $siswa->NIS)->first();

//             // Perbarui data hanya jika laporan_pengimbasan sudah ada dan file laporan sudah diunggah
//             if ($laporanPengimbasan && !empty($laporanPengimbasan->laporan_pengimbasan)) {
//                 $laporanPengimbasan->kode_kelompok = $ploting->kode_kelompok;
//                 $laporanPengimbasan->nama = $siswa->nama_siswa;
//                 $laporanPengimbasan->konsentrasi_keahlian = $siswa->konsentrasi_keahlian;
//                 $laporanPengimbasan->kelas = $siswa->kelas;
//                 $laporanPengimbasan->kode_dudi = $ploting->kode_dudi;
//                 $laporanPengimbasan->nama_dudi = $ploting->nama_dudi;
//                 $laporanPengimbasan->save(); 
//             }
//         }
//     }
// }


    // public function hasilLaporanPengimbasan(Request $request)
    // {
    //     // Panggil fungsi sinkronisasi agar data selalu diperbarui
    //     $this->sinkronisasiLaporanPengimbasan();

    //     if (!auth('pembimbing')->check()) {
    //         return redirect()->route('login')->withErrors('Anda harus login terlebih dahulu.');
    //     }

    //     $nipNik = auth('pembimbing')->user()->NIP_NIK;

    //     $tahunOptions = Siswa::distinct()->pluck('tahun');
    //     $konsentrasiOptions = Siswa::distinct()->pluck('konsentrasi_keahlian');
    //     $kodeKelompokOptions = Ploting::where('NIP_NIK', $nipNik)->distinct()->pluck('kode_kelompok');

    //     $laporanPengimbasan = LaporanPengimbasan::with('siswa')
    //         ->whereHas('siswa.ploting', function ($query) use ($nipNik) {
    //             $query->where('NIP_NIK', $nipNik);
    //         });

    //     if ($request->has('tahun') && $request->tahun !== '') {
    //         $laporanPengimbasan->whereHas('siswa', function ($q) use ($request) {
    //             $q->where('tahun', $request->tahun);
    //         });
    //     }
    //     if ($request->has('konsentrasi_keahlian') && $request->konsentrasi_keahlian !== '') {
    //         $laporanPengimbasan->whereHas('siswa', function ($q) use ($request) {
    //             $q->where('konsentrasi_keahlian', $request->konsentrasi_keahlian);
    //         });
    //     }
    //         if ($request->has('kode_kelompok') && $request->kode_kelompok !== '') {
    //         $laporanPengimbasan->where('kode_kelompok', $request->kode_kelompok);
    //     }

    //     $laporanPengimbasan = $laporanPengimbasan->get();

    //     return view('hasil_laporanpengimbasan', compact('laporanPengimbasan', 'tahunOptions', 'konsentrasiOptions', 'kodeKelompokOptions'));
    // }

    // public function hasilLaporanPengimbasan(Request $request)
    // {
    //     if (!auth('pembimbing')->check()) {
    //         return redirect()->route('login')->withErrors('Anda harus login terlebih dahulu.');
    //     }
    
    //     $nipNik = auth('pembimbing')->user()->NIP_NIK;
    
    //      // Mengambil opsi filter
    //     $tahunOptions = Siswa::distinct()->pluck('tahun');
    //     $konsentrasiOptions = Siswa::distinct()->pluck('konsentrasi_keahlian');
    //     $kodeKelompokOptions = Ploting::where('NIP_NIK', $nipNik)->distinct()->pluck('kode_kelompok');


    //     if ($request->has('tahun') && $request->tahun !== 'Tahun') {
    //         $query->whereHas('siswa', function ($q) use ($request) {
    //             $q->where('tahun', $request->tahun);
    //         });
    //     }

    //     if ($request->has('konsentrasi_keahlian') && $request->konsentrasi_keahlian !== 'Konsentrasi Keahlian') {
    //         $query->whereHas('siswa', function ($q) use ($request) {
    //             $q->where('konsentrasi_keahlian', $request->konsentrasi_keahlian);
    //         });
    //     }

    //     if ($request->has('kode_kelompok') && $request->kode_kelompok !== 'Kode Kelompok') {
    //         $query->where('kode_kelompok', $request->kode_kelompok);
    //     }

    
    //     // Query siswa yang dibimbing oleh pembimbing yang sedang login
    //     $laporanPengimbasan = DB::table('ploting')
    //         ->leftJoin('siswa', 'ploting.NIS', '=', 'siswa.NIS')
    //         ->leftJoin('laporan_pengimbasan', 'ploting.NIS', '=', 'laporan_pengimbasan.NIS')
    //         ->where('ploting.NIP_NIK', $nipNik)
    //         ->select(
    //             'siswa.nama_siswa as nama',
    //             'siswa.kelas',
    //             'siswa.konsentrasi_keahlian',
    //             'siswa.NIS',
    //             'siswa.tahun',
    //             'ploting.kode_kelompok',
    //             'laporan_pengimbasan.laporan_pengimbasan',
    //             'laporan_pengimbasan.approved'
    //         )
    //         ->get();
            
    
    //     return view('hasil_laporanpengimbasan', compact('laporanPengimbasan', 'tahunOptions', 'konsentrasiOptions', 'kodeKelompokOptions'));
    // }

    public function hasilLaporanPengimbasan(Request $request)
{
    if (!auth('pembimbing')->check()) {
        return redirect()->route('login')->withErrors('Anda harus login terlebih dahulu.');
    }

    $nipNik = auth('pembimbing')->user()->NIP_NIK;

    // Mengambil opsi filter
    $tahunOptions = Siswa::distinct()->pluck('tahun');
    $konsentrasiOptions = Siswa::distinct()->pluck('konsentrasi_keahlian');
    $kodeKelompokOptions = Ploting::where('NIP_NIK', $nipNik)->distinct()->pluck('kode_kelompok');

    // Query siswa yang dibimbing oleh pembimbing yang sedang login
    $query = DB::table('ploting')
        ->leftJoin('siswa', 'ploting.NIS', '=', 'siswa.NIS')
        ->leftJoin('laporan_pengimbasan', 'ploting.NIS', '=', 'laporan_pengimbasan.NIS')
        ->where('ploting.NIP_NIK', $nipNik)
        ->select(
            'siswa.nama_siswa as nama',
            'siswa.kelas',
            'siswa.konsentrasi_keahlian',
            'siswa.NIS',
            'siswa.tahun',
            'ploting.kode_kelompok',
            'laporan_pengimbasan.laporan_pengimbasan',
            'laporan_pengimbasan.approved'
        );

    // Filter berdasarkan input dari view
    if ($request->filled('tahun')) {
        $query->where('siswa.tahun', $request->tahun);
    }

    if ($request->filled('konsentrasi_keahlian')) {
        $query->where('siswa.konsentrasi_keahlian', $request->konsentrasi_keahlian);
    }

    if ($request->filled('kode_kelompok')) {
        $query->where('ploting.kode_kelompok', $request->kode_kelompok);
    }

    // Mengambil hasil query
    $laporanPengimbasan = $query->get();

    return view('hasil_laporanpengimbasan', compact('laporanPengimbasan', 'tahunOptions', 'konsentrasiOptions', 'kodeKelompokOptions'));
}

    


    public function updateLaporanPengimbasan()
    {
        $plotingData = Ploting::with('siswa')->get();

        foreach ($plotingData as $ploting) {
            $siswa = $ploting->siswa;

            if ($siswa) {
                $laporanPengimbasan = LaporanPengimbasan::where('NIS', $siswa->NIS)->first();

                if ($laporanPengimbasan) {
                    // Perbarui data jika sudah ada, dan set default jika kolom laporan_pengimbasan kosong
                    $laporanPengimbasan->kode_kelompok = $ploting->kode_kelompok;
                    $laporanPengimbasan->nama_siswa = $siswa->nama_siswa;
                    $laporanPengimbasan->konsentrasi_keahlian = $siswa->konsentrasi_keahlian;
                    $laporanPengimbasan->kelas = $siswa->kelas;
                    $laporanPengimbasan->kode_dudi = $ploting->kode_dudi;

                    if (empty($laporanPengimbasan->laporan_pengimbasan)) {
                        $laporanPengimbasan->laporan_pengimbasan = null; 
                    }

                    $laporanPengimbasan->save(); 
                } else {
                    // Jika data NIS belum ada di laporan_pengimbasan, buat entri baru
                    LaporanPengimbasan::create([
                        'kode_kelompok' => $ploting->kode_kelompok,
                        'NIS' => $siswa->NIS,
                        'konsentrasi_keahlian' => $siswa->konsentrasi_keahlian,
                        'nama_siswa' => $siswa->nama_siswa,
                        'kelas' => $siswa->kelas,
                        'kode_dudi' => $ploting->kode_dudi,
                        'laporan_pengimbasan' => '',
                        'approved' => false
                    ]);
                }
            }
        }

        return redirect()->route('hasil_laporanpengimbasan')->with('success', 'Data laporan pengimbasan berhasil diperbarui.');
    }

    public function approveLaporanPengimbasan(Request $request)
    {
        // Validasi input NIS
        $request->validate([
            'NIS' => 'required|exists:siswa,NIS',
        ]);

        $laporanPengimbasan = LaporanPengimbasan::where('NIS', $request->NIS)->first();

        if ($laporanPengimbasan) {
            // Ubah status approved menjadi 1 tanpa menambah entri baru
            $laporanPengimbasan->approved = 1;
            $laporanPengimbasan->save();

            // Perbarui tabel evaluasi
            $evaluasi = Evaluasi::firstOrCreate(
                ['NIS' => $request->NIS], 
                [
                    'nilai_lap_pengimbasan' => 100, 
                ]
            );

            return redirect()->route('hasil_laporanpengimbasan')->with('success', 'Laporan pengimbasan berhasil di-approve.');
        }

        return redirect()->route('hasil_laporanpengimbasan')->withErrors('Laporan pengimbasan tidak ditemukan untuk NIS ini.');
    }


    // public function hasilLaporanAkhir(Request $request)
    // {
    //     if (!auth('pembimbing')->check()) {
    //         return redirect()->route('login')->withErrors('Anda harus login terlebih dahulu.');
    //     }

    //     // Sinkronisasi data ploting ke laporan_akhir
    //     $this->sinkronisasiLaporanAkhir();

    //     $nipNik = auth('pembimbing')->user()->NIP_NIK;

    //     $tahunOptions = Siswa::distinct()->pluck('tahun');
    //     $konsentrasiOptions = Siswa::distinct()->pluck('konsentrasi_keahlian');
    //     $kodeKelompokOptions = Ploting::where('NIP_NIK', $nipNik)->distinct()->pluck('kode_kelompok');

    //     // Query data laporan akhir berdasarkan pembimbing yang login
    //     $query = LaporanAkhir::with(['siswa' => function ($query) {
    //         $query->select('NIS', 'nama_siswa', 'konsentrasi_keahlian', 'kelas', 'tahun');
    //     }])->whereHas('siswa.ploting', function ($q) use ($nipNik) {
    //         $q->where('NIP_NIK', $nipNik);
    //     });

    //     if ($request->has('tahun') && $request->tahun !== 'Tahun') {
    //         $query->whereHas('siswa', function ($q) use ($request) {
    //             $q->where('tahun', $request->tahun);
    //         });
    //     }

    //     if ($request->has('konsentrasi_keahlian') && $request->konsentrasi_keahlian !== 'Konsentrasi Keahlian') {
    //         $query->whereHas('siswa', function ($q) use ($request) {
    //             $q->where('konsentrasi_keahlian', $request->konsentrasi_keahlian);
    //         });
    //     }

    //     if ($request->has('kode_kelompok') && $request->kode_kelompok !== 'Kode Kelompok') {
    //         $query->whereHas('siswa.ploting', function ($q) use ($request) {
    //             $q->where('kode_kelompok', $request->kode_kelompok);
    //         });
    //     }

    //     $laporanAkhir = $query->get();

    //     return view('hasil_laporanakhir', compact('laporanAkhir', 'tahunOptions', 'konsentrasiOptions','kodeKelompokOptions'));
    // }

    public function hasilLaporanAkhir(Request $request)
{
    if (!auth('pembimbing')->check()) {
        return redirect()->route('login')->withErrors('Anda harus login terlebih dahulu.');
    }

    $nipNik = auth('pembimbing')->user()->NIP_NIK;

    // Mengambil opsi filter
    $tahunOptions = Siswa::distinct()->pluck('tahun');
    $konsentrasiOptions = Siswa::distinct()->pluck('konsentrasi_keahlian');
    $kodeKelompokOptions = Ploting::where('NIP_NIK', $nipNik)->distinct()->pluck('kode_kelompok');

    // Query siswa yang dibimbing oleh pembimbing yang sedang login
    $query = DB::table('ploting')
        ->leftJoin('siswa', 'ploting.NIS', '=', 'siswa.NIS')
        ->leftJoin('laporan_akhir', 'ploting.NIS', '=', 'laporan_akhir.NIS')
        ->where('ploting.NIP_NIK', $nipNik)
        ->select(
            'siswa.nama_siswa as nama',
            'siswa.kelas',
            'siswa.konsentrasi_keahlian',
            'siswa.NIS',
            'siswa.tahun',
            'ploting.kode_kelompok',
            'laporan_akhir.laporan_akhir',
            'laporan_akhir.approved'
        );

    // Filter berdasarkan input dari view
    if ($request->filled('tahun')) {
        $query->where('siswa.tahun', $request->tahun);
    }

    if ($request->filled('konsentrasi_keahlian')) {
        $query->where('siswa.konsentrasi_keahlian', $request->konsentrasi_keahlian);
    }

    if ($request->filled('kode_kelompok')) {
        $query->where('ploting.kode_kelompok', $request->kode_kelompok);
    }

    // Mengambil hasil query
    $laporanAkhir = $query->get();

    return view('hasil_laporanakhir', compact('laporanAkhir', 'tahunOptions', 'konsentrasiOptions', 'kodeKelompokOptions'));
}

    


    public function approveLaporanAkhir(Request $request)
    {
        // Validasi input NIS
        $request->validate([
            'NIS' => 'required|exists:siswa,NIS',
        ]);

        // Cari laporan akhir berdasarkan NIS
        $laporanAkhir = LaporanAkhir::where('NIS', $request->NIS)->first();

        if ($laporanAkhir) {
            // Update kolom 'approved'
            $laporanAkhir->approved = 1;
            $laporanAkhir->save();

            // Periksa apakah evaluasi sudah ada untuk NIS ini
            $evaluasi = Evaluasi::firstOrCreate(
                ['NIS' => $request->NIS], // Kondisi NIS sebagai kunci identifikasi
                [
                    'nilai_lap_akhir' => 100,
                    'nilai_akhir' => 10,  // 10% bobot nilai
                ]
            );

            return redirect()->route('hasil_laporanakhir')->with('success', 'Laporan akhir berhasil di-approve.');
        }

        return redirect()->route('hasil_laporanakhir')->withErrors('Laporan akhir tidak ditemukan untuk NIS ini.');
    }


    public function updateLaporanAkhir()
    {
        // Ambil semua data dari laporan_akhir
        $laporanAkhirData = LaporanAkhir::all();

        foreach ($laporanAkhirData as $laporan) {
            // Periksa jika kolom laporan_akhir kosong
            if (empty($laporan->laporan_akhir)) {
                $laporan->laporan_akhir = 'Belum diunggah'; // Atau ambil dari sumber lain jika ada
                $laporan->save(); // Simpan perubahan
            }
        }

        return redirect()->route('hasil_laporanakhir')->with('success', 'Data laporan akhir berhasil diperbarui.');
    }

    // public function sinkronisasiLaporanAkhir()
    // {
    //     // Ambil data dari tabel ploting
    //     $plotingData = Ploting::with('siswa')->get();

    //     foreach ($plotingData as $ploting) {
    //         $siswa = $ploting->siswa;

    //         if ($siswa) {
    //             // Cek apakah siswa sudah ada di laporan_akhir
    //             $existingLaporan = LaporanAkhir::where('NIS', $siswa->NIS)->first();
    //             if (!$existingLaporan) {
    //                 // Jika tidak ada, tambahkan data ke dalam laporan_akhir
    //                 LaporanAkhir::create([
    //                     'kode_kelompok' => $ploting->kode_kelompok,
    //                     'kode_dudi' => $ploting->kode_dudi,
    //                     'NIS' => $siswa->NIS,
    //                     'konsentrasi_keahlian' => $siswa->konsentrasi_keahlian,
    //                     'nama_siswa' => $siswa->nama_siswa,
    //                     'kelas' => $siswa->kelas,
    //                     'nama_dudi' => $ploting->nama_dudi,
    //                     'laporan_akhir' => null, 
    //                     'approved' => false
    //                 ]);
    //             }
    //         }
    //     }
    // }

//     public function sinkronisasiLaporanAkhir()
// {
//     $plotingData = Ploting::with('siswa')->get();

//     foreach ($plotingData as $ploting) {
//         $siswa = $ploting->siswa;

//         if ($siswa) {
//             // Ambil data dari laporan_akhir
//             $existingLaporan = LaporanAkhir::where('NIS', $siswa->NIS)->first();

//             // Perbarui data hanya jika laporan_akhir sudah ada dan file laporan sudah diunggah
//             if ($existingLaporan && !empty($existingLaporan->laporan_akhir)) {
//                 $existingLaporan->kode_kelompok = $ploting->kode_kelompok;
//                 $existingLaporan->nama_siswa = $siswa->nama_siswa;
//                 $existingLaporan->konsentrasi_keahlian = $siswa->konsentrasi_keahlian;
//                 $existingLaporan->kelas = $siswa->kelas;
//                 $existingLaporan->kode_dudi = $ploting->kode_dudi;
//                 $existingLaporan->nama_dudi = $ploting->nama_dudi;
//                 $existingLaporan->save();
//             }
//         }
//     }
// }


}