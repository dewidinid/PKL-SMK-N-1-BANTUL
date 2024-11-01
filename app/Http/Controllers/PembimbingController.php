<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Http\Request;
use Rap2hpoutre\FastExcel\FastExcel;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Siswa;
use App\Models\Monitoring;
use App\Models\monitoringPerSiswa;
use App\Models\Evaluasi;
use App\Models\NilaiPKL;
use App\Models\LaporanPengimbasan;
use App\Models\LaporanJurnal;
use App\Models\LaporanAkhir;
use App\Models\Ploting;

class PembimbingController extends Controller
{
    public function indexPembimbing()
    {
        // Mendapatkan NIP/NIK dari pembimbing yang sedang login
        $nipNikPembimbing = Auth::user()->nip_nik;
    
        // Ambil data siswa yang dibimbing oleh pembimbing yang login melalui tabel ploting
        $siswaList = Ploting::with('siswa')->where('NIP_NIK', $nipNikPembimbing)->get();
    
        // Kirim data pembimbing dan daftar siswa ke view 'home_pembimbing'
        return view('home_pembimbing', compact('siswaList'));
    }

public function monitoringPKL()
{
    // Cek apakah pembimbing sudah login
    if (!auth('pembimbing')->check()) {
        return redirect()->route('login')->withErrors('Anda harus login terlebih dahulu.');
    }

    // Ambil nip_nik pembimbing yang sedang login
    $nipNik = auth('pembimbing')->user()->NIP_NIK;

    // Ambil data dari tabel ploting berdasarkan nip_nik pembimbing yang login
    $plotingData = Ploting::with('siswa')
        ->where('NIP_NIK', $nipNik) // Filter data berdasarkan nip_nik pembimbing yang login
        ->get();

    // Looping data ploting untuk disimpan ke dalam tabel monitoring
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

    // Ambil data monitoring berdasarkan pembimbing yang login
    $monitoring = Monitoring::with('siswa')
        ->where('NIP_NIK', $nipNik) // Filter monitoring berdasarkan nip_nik
        ->get();

    // Ambil data tahun unik dari monitoring
    $tahun = Monitoring::select('tahun')->distinct()->pluck('tahun');

    // Ambil data konsentrasi keahlian unik dari monitoring
    $konsentrasi_keahlian = Monitoring::select('konsentrasi_keahlian')->distinct()->pluck('konsentrasi_keahlian');

    // Kirim data monitoring, tahun, dan konsentrasi ke view monitoring
    return view('monitoring', [
        'monitoring' => $monitoring,
        'tahun' => $tahun,
        'konsentrasi_keahlian' => $konsentrasi_keahlian
    ]);
}

public function filterMonitoring(Request $request)
    {
        // Ambil data tahun unik dari monitoring
        $tahun = Monitoring::select('tahun')->distinct()->pluck('tahun');

        // Ambil data konsentrasi keahlian unik dari monitoring
        $konsentrasi_keahlian = Monitoring::select('konsentrasi_keahlian')->distinct()->pluck('konsentrasi_keahlian');

        // Ambil data ploting yang sudah ada di monitoring
        $query = Monitoring::with('siswa');

        // Filter berdasarkan tahun jika dipilih
        if ($request->filled('tahun') && $request->tahun != 'Tahun') {
            $query->where('tahun', $request->tahun);
        }

        // Filter berdasarkan konsentrasi keahlian jika dipilih
        if ($request->filled('konsentrasi_keahlian') && $request->konsentrasi_keahlian != 'Konsentrasi Keahlian') {
            $query->where('konsentrasi_keahlian', $request->konsentrasi_keahlian);
        }

        // Eksekusi query untuk mendapatkan hasil filter
        $monitoring = $query->get();

        // Kirim data monitoring, tahun, dan konsentrasi_keahlian ke view
        return view('monitoring', compact('monitoring', 'tahun', 'konsentrasi_keahlian'));
    }

    public function monitoringPerSiswa($nis)
    {
        // Ambil data monitoring berdasarkan NIS siswa
        $monitoringPerSiswa = MonitoringPerSiswa::where('NIS', $nis)->get();
        $siswa = Siswa::where('NIS', $nis)->first(); 

        // Debugging untuk memastikan data ada sebelum di-render
        // dd($monitoringPerSiswa, $siswa); 

        return view('monitoring_persiswa', compact('monitoringPerSiswa', 'siswa', 'nis'));
    }

    public function uploadMonitoring(Request $request, $nis)
    {
        // Validasi file yang diupload
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls,csv',
        ]);

        // Cek jumlah upload sebelumnya untuk siswa ini
        $uploadCount = MonitoringPerSiswa::where('NIS', $nis)->count();
        if ($uploadCount >= 6) {
            return redirect()->route('monitoring_persiswa', ['nis' => $nis])->with('error', 'Maksimal 6 kali upload.');
        }

        // Mendapatkan file yang diupload
        $file = $request->file('file');

        // Baca file Excel menggunakan PhpSpreadsheet
        $spreadsheet = IOFactory::load($file->getPathname());
        $worksheet = $spreadsheet->getActiveSheet();

        // Ambil nilai dari sel yang diinginkan
        $nilai_tp1 = $worksheet->getCell('F21')->getCalculatedValue();
        $nilai_tp2 = $worksheet->getCell('F30')->getCalculatedValue();
        $nilai_tp3 = $worksheet->getCell('F39')->getCalculatedValue();
        $nilai_tp4 = $worksheet->getCell('F49')->getCalculatedValue();
        $nilai = $worksheet->getCell('F51')->getCalculatedValue();

        // Simpan data ke dalam database monitoring_per_siswa
        $data = [
            'NIS' => $nis,
            'nilai_tp1' => $nilai_tp1,
            'nilai_tp2' => $nilai_tp2,
            'nilai_tp3' => $nilai_tp3,
            'nilai_tp4' => $nilai_tp4,
            'nilai' => $nilai,
        ];

        MonitoringPerSiswa::create($data);

        // Jika sudah 6 kali upload, hitung nilai akhir
        if ($uploadCount == 5) { // ini adalah upload ke-6
            $monitoringPerSiswa = MonitoringPerSiswa::where('NIS', $nis)->get();

            // Hitung total semua nilai
            $totalNilai = $monitoringPerSiswa->sum('nilai');

            // Hitung rata-rata nilai (nilai akhir)
            $nilai_akhir = $totalNilai / 6;  // Rata-rata dari 6 kali upload

            // Update nilai_akhir di semua record monitoring_per_siswa untuk siswa ini
            foreach ($monitoringPerSiswa as $monitoringsiswa) {
                $monitoringsiswa->update(['nilai_akhir' => $nilai_akhir]);
            }
        }

        // Redirect ke halaman monitoring dengan data monitoring_per_siswa
        return redirect()->route('monitoring_persiswa', ['nis' => $nis])->with('success', 'File berhasil diunggah dan disimpan.');
    }

    public function evaluasiPKL(Request $request)
    {
        // Cek apakah pembimbing sudah login
        if (!auth('pembimbing')->check()) {
            return redirect()->route('login')->withErrors('Anda harus login terlebih dahulu.');
        }

        // Ambil nip_nik pembimbing yang sedang login
        $nipNik = auth('pembimbing')->user()->NIP_NIK;

        // Ambil parameter filter dari request
        $tahun = $request->input('tahun');
        $konsentrasi_keahlian = $request->input('konsentrasi_keahlian');

        // Query data evaluasi dari model Ploting dengan filter berdasarkan relasi Siswa dan nip_nik pembimbing
        $dataEvaluasi = Ploting::with('siswa')
            ->where('NIP_NIK', $nipNik) // Filter berdasarkan NIP_NIK pembimbing yang login
            ->whereHas('siswa', function ($query) use ($tahun, $konsentrasi_keahlian) {
                if ($tahun) {
                    $query->where('tahun', $tahun);
                }
                if ($konsentrasi_keahlian) {
                    $query->where('konsentrasi_keahlian', $konsentrasi_keahlian);
                }
            })
            ->get();

        // Ambil semua tahun dan konsentrasi keahlian dari tabel siswa untuk dropdown
        $tahunOptions = Siswa::select('tahun')->distinct()->pluck('tahun');
        $keahlianOptions = Siswa::select('konsentrasi_keahlian')->distinct()->pluck('konsentrasi_keahlian');

        // Return ke view evaluasi dengan data evaluasi dan opsi filter
        return view('evaluasi', compact('dataEvaluasi', 'tahunOptions', 'keahlianOptions'));
    }

    public function evaluasiPerSiswa($nis)
    {
        // dd($nis);
        // Ambil data siswa dan ploting berdasarkan NIS
        $siswa = Siswa::with('ploting')->where('NIS', $nis)->firstOrFail();

        // Ambil data dari siswa dan ploting
        //  $dataSiswa = $siswa->ploting; // Mengakses data di Ploting
        //  $namaSiswa = $siswa->nama; // Contoh mengakses data di Siswa

        // Hitung persentase masing-masing komponen evaluasi
        $jurnal = LaporanJurnal::where('NIS', $nis)->count();
        $jurnalTotal = 6 * 20; 
        $persentaseJurnal = ($jurnal / $jurnalTotal) * 10;

        $nilaiPklDudi = NilaiPkl::where('NIS', $nis)->first()->nilai ?? 0;
        $nilaiAkhirDudi = ($nilaiPklDudi * 50) / 100;

        $monitoring = Monitoring::where('NIS', $nis)->first();
        $nilaiMonitoring = ($monitoring->nilai_total * 20) / 100;

        $pengimbasanUploaded = LaporanPengimbasan::where('NIS', $nis)->exists();
        $nilaiPengimbasan = $pengimbasanUploaded ? 10 : 0;

        $laporanAkhirUploaded = LaporanAkhir::where('NIS', $nis)->exists();
        $nilaiAkhirPKL = $laporanAkhirUploaded ? 10 : 0;

        $totalNilai = $persentaseJurnal + $nilaiAkhirDudi + $nilaiMonitoring + $nilaiPengimbasan + $nilaiAkhirPKL;

        return view('evaluasi_persiswa', compact('siswa', 'persentaseJurnal', 'nilaiAkhirDudi', 'nilaiMonitoring', 'nilaiPengimbasan', 'nilaiAkhirPKL', 'totalNilai'));
    }    

    public function hasilNilaiPKL(Request $request)
    {
        // Cek apakah pembimbing sudah login
        if (!auth('pembimbing')->check()) {
            return redirect()->route('login')->withErrors('Anda harus login terlebih dahulu.');
        }

        // Ambil nip_nik pembimbing yang sedang login
        $nipNik = auth('pembimbing')->user()->NIP_NIK;

        // Ambil data tahun dan konsentrasi keahlian untuk dropdown
        $tahunOptions = Siswa::distinct()->pluck('tahun');
        $konsentrasiOptions = Siswa::distinct()->pluck('konsentrasi_keahlian');
        
        // Ambil data ploting dan siswa berdasarkan nip_nik pembimbing yang login
        $query = Ploting::with(['siswa' => function ($query) {
            // Hanya pilih kolom yang diperlukan dari tabel siswa
            $query->select('NIS', 'nama_siswa', 'konsentrasi_keahlian', 'kelas', 'tahun');
        }])->where('NIP_NIK', $nipNik);

        // Filter berdasarkan tahun jika dipilih
        if ($request->filled('tahun') && $request->tahun !== 'Tahun') {
            $query->whereHas('siswa', function ($q) use ($request) {
                $q->where('tahun', $request->tahun);
            });
        }

        // Filter berdasarkan konsentrasi keahlian jika dipilih
        if ($request->filled('konsentrasi_keahlian') && $request->konsentrasi_keahlian !== 'Konsentrasi Keahlian') {
            $query->whereHas('siswa', function ($q) use ($request) {
                $q->where('konsentrasi_keahlian', $request->konsentrasi_keahlian);
            });
        }

        // Eksekusi query untuk mendapatkan hasil filter
        $hasil_nilaipkl = $query->get();
        
        // Kirim data hasil_nilaipkl, tahun, dan konsentrasi_keahlian ke view
        return view('hasil_nilaipkl', [
            'hasil_nilaipkl' => $hasil_nilaipkl,
            'tahun' => $tahunOptions,
            'konsentrasi_keahlian' => $konsentrasiOptions,
        ]);
    }

 public function pembimbingLaporanJurnal(Request $request)
    {
        // Cek apakah pengguna sudah login
        if (!auth('pembimbing')->check()) {
            return redirect()->route('login')->withErrors('Anda harus login terlebih dahulu.');
        }

        // Ambil NIP/NIK dari pembimbing yang login
        $nipNik = auth('pembimbing')->user()->NIP_NIK;

        // Ambil data tahun dan konsentrasi keahlian untuk dropdown
        $tahunOptions = Siswa::distinct()->pluck('tahun');
        $konsentrasiOptions = Siswa::distinct()->pluck('konsentrasi_keahlian');

        // Ambil data ploting dan siswa berdasarkan NIP/NIK pembimbing
        $query = Ploting::with(['siswa' => function ($query) {
            // Ambil field yang diperlukan dari tabel siswa
            $query->select('NIS', 'nama_siswa', 'konsentrasi_keahlian', 'kelas', 'tahun'); 
        }])
        ->where('NIP_NIK', $nipNik);

        // Filter berdasarkan tahun dan konsentrasi keahlian jika ada
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

        $laporan_jurnal = $query->get();

        // Kirim data ke view
        return view('pembimbing_laporanjurnal', compact('laporan_jurnal', 'tahunOptions', 'konsentrasiOptions'));
    }

    public function pembimbingLaporanJurnalPerSiswa($nis)
    {
        // Ambil NIP/NIK pembimbing yang sedang login
        $nipNik = auth('pembimbing')->user()->NIP_NIK;

        // Cari siswa berdasarkan NIS hanya jika mereka dibimbing oleh pembimbing ini
        $siswa = Siswa::with(['ploting' => function($query) use ($nipNik) {
            $query->where('NIP_NIK', $nipNik);
        }])->where('NIS', $nis)->firstOrFail();

        // Ambil data jurnal siswa
        $jurnals = LaporanJurnal::where('NIS', $nis)->get();

        // Pastikan Anda mengirimkan variabel yang benar ke view
        return view('pembimbing_laporanjurnal_persiswa', compact('siswa', 'jurnals'));
    }



    public function sinkronisasiLaporanPengimbasan()
    {
        $plotingData = Ploting::with('siswa')->get();
    
        foreach ($plotingData as $ploting) {
            $siswa = $ploting->siswa;
    
            if ($siswa) {
                $existingLaporan = LaporanPengimbasan::where('NIS', $siswa->NIS)->first();
    
                if (!$existingLaporan) {
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
    }

    public function hasilLaporanPengimbasan(Request $request)
{
    if (!auth('pembimbing')->check()) {
        return redirect()->route('login')->withErrors('Anda harus login terlebih dahulu.');
    }

    $nipNik = auth('pembimbing')->user()->NIP_NIK;

    $tahunOptions = Siswa::distinct()->pluck('tahun');
    $konsentrasiOptions = Siswa::distinct()->pluck('konsentrasi_keahlian');

    // Filter laporan_pengimbasan berdasarkan NIP_NIK pembimbing yang login
    $laporanPengimbasan = LaporanPengimbasan::with('siswa')
        ->whereHas('siswa.ploting', function ($query) use ($nipNik) {
            $query->where('NIP_NIK', $nipNik);
        });

    if ($request->has('tahun') && $request->tahun !== '') {
        $laporanPengimbasan->whereHas('siswa', function ($q) use ($request) {
            $q->where('tahun', $request->tahun);
        });
    }
    if ($request->has('konsentrasi_keahlian') && $request->konsentrasi_keahlian !== '') {
        $laporanPengimbasan->whereHas('siswa', function ($q) use ($request) {
            $q->where('konsentrasi_keahlian', $request->konsentrasi_keahlian);
        });
    }

    $laporanPengimbasan = $laporanPengimbasan->get();

    return view('hasil_laporanpengimbasan', compact('laporanPengimbasan', 'tahunOptions', 'konsentrasiOptions'));
}

public function updateLaporanPengimbasan()
{
    // Ambil semua data dari tabel ploting beserta relasi siswa
    $plotingData = Ploting::with('siswa')->get();

    foreach ($plotingData as $ploting) {
        $siswa = $ploting->siswa;

        if ($siswa) {
            // Cari entri yang sesuai di laporan_pengimbasan berdasarkan NIS siswa
            $laporanPengimbasan = LaporanPengimbasan::where('NIS', $siswa->NIS)->first();

            if ($laporanPengimbasan) {
                // Perbarui data jika sudah ada, dan set default jika kolom laporan_pengimbasan kosong
                $laporanPengimbasan->kode_kelompok = $ploting->kode_kelompok;
                $laporanPengimbasan->nama_siswa = $siswa->nama_siswa;
                $laporanPengimbasan->konsentrasi_keahlian = $siswa->konsentrasi_keahlian;
                $laporanPengimbasan->kelas = $siswa->kelas;
                $laporanPengimbasan->kode_dudi = $ploting->kode_dudi;

                // Jika kolom laporan_pengimbasan kosong, isi dengan nilai default
                if (empty($laporanPengimbasan->laporan_pengimbasan)) {
                    $laporanPengimbasan->laporan_pengimbasan = 'Belum diunggah';
                }

                $laporanPengimbasan->save(); // Simpan perubahan
            } else {
                // Jika data NIS belum ada di laporan_pengimbasan, buat entri baru
                LaporanPengimbasan::create([
                    'kode_kelompok' => $ploting->kode_kelompok,
                    'NIS' => $siswa->NIS,
                    'konsentrasi_keahlian' => $siswa->konsentrasi_keahlian,
                    'nama_siswa' => $siswa->nama_siswa,
                    'kelas' => $siswa->kelas,
                    'kode_dudi' => $ploting->kode_dudi,
                    'laporan_pengimbasan' => 'Belum diunggah',
                    'approved' => false
                ]);
            }
        }
    }

    return redirect()->route('hasil_laporanpengimbasan')->with('success', 'Data laporan pengimbasan berhasil diperbarui.');
}

public function approveLaporanPengimbasan(Request $request)
{
    // Validate input NIS
    $request->validate([
        'NIS' => 'required|exists:siswa,NIS',
    ]);

    // Find report by NIS
    $laporanPengimbasan = LaporanPengimbasan::where('NIS', $request->NIS)->first();

    if ($laporanPengimbasan) {
        // Update approved field to 1 (approved)
        $laporanPengimbasan->approved = 1;
        $laporanPengimbasan->save();

        // Update evaluation table
        $evaluasi = Evaluasi::firstOrCreate(
            ['NIS' => $request->NIS], 
            [
                'nilai_lap_pengimbasan' => 100, 
                // Update other evaluation columns as needed
            ]
        );

        return redirect()->route('hasil_laporanpengimbasan')->with('success', 'Laporan pengimbasan berhasil di-approve.');
    }

    return redirect()->route('hasil_laporanpengimbasan')->withErrors('Laporan pengimbasan tidak ditemukan untuk NIS ini.');
}


    public function hasilLaporanAkhir(Request $request)
    {
        if (!auth('pembimbing')->check()) {
            return redirect()->route('login')->withErrors('Anda harus login terlebih dahulu.');
        }

        // Sinkronisasi data ploting ke laporan_akhir
        $this->sinkronisasiLaporanAkhir();

        // Ambil NIP/NIK pembimbing yang login
        $nipNik = auth('pembimbing')->user()->NIP_NIK;

        // Data dropdown untuk filter tahun dan konsentrasi
        $tahunOptions = Siswa::distinct()->pluck('tahun');
        $konsentrasiOptions = Siswa::distinct()->pluck('konsentrasi_keahlian');

        // Query data laporan akhir berdasarkan pembimbing yang login
        $query = LaporanAkhir::with(['siswa' => function ($query) {
            $query->select('NIS', 'nama_siswa', 'konsentrasi_keahlian', 'kelas', 'tahun');
        }])->whereHas('siswa.ploting', function ($q) use ($nipNik) {
            $q->where('NIP_NIK', $nipNik);
        });

        // Filter berdasarkan tahun dan konsentrasi jika tersedia
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

        $laporanAkhir = $query->get();

        return view('hasil_laporanakhir', compact('laporanAkhir', 'tahunOptions', 'konsentrasiOptions'));
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
                    // Isi kolom lainnya jika diperlukan
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
                // Logika untuk mendapatkan data yang sesuai
                // Misalnya, kita ingin mengisi dengan teks default atau nilai lain
                $laporan->laporan_akhir = 'Belum diunggah'; // Atau ambil dari sumber lain jika ada
                $laporan->save(); // Simpan perubahan
            }
        }

        return redirect()->route('hasil_laporanakhir')->with('success', 'Data laporan akhir berhasil diperbarui.');
    }

    public function sinkronisasiLaporanAkhir()
    {
        // Ambil semua data dari tabel ploting
        $plotingData = Ploting::with('siswa')->get();

        foreach ($plotingData as $ploting) {
            $siswa = $ploting->siswa;

            if ($siswa) {
                // Cek apakah siswa sudah ada di laporan_akhir
                $existingLaporan = LaporanAkhir::where('NIS', $siswa->NIS)->first();
                if (!$existingLaporan) {
                    // Jika tidak ada, tambahkan data ke dalam laporan_akhir
                    LaporanAkhir::create([
                        'kode_kelompok' => $ploting->kode_kelompok,
                        'NIS' => $siswa->NIS,
                        'konsentrasi_keahlian' => $siswa->konsentrasi_keahlian,
                        'nama' => $siswa->nama_siswa,
                        'kelas' => $siswa->kelas,
                        'nama_dudi' => $ploting->kode_dudi,
                        'laporan_akhir' => '', // atau 'Belum diunggah'
                        'approved' => false
                    ]);
                }
            }
        }
    }

}