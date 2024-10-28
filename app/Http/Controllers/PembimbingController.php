<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Rap2hpoutre\FastExcel\FastExcel;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Siswa;
use App\Models\Monitoring;
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

        // Mendapatkan Pembimbing yang sedang login
        $pembimbing = Auth::user(); // Mengambil data Pembimbing yang sedang login
        
        // Mendapatkan data yang relevan, misalnya, siswa yang dibimbing
        $siswaList = Siswa::where('id_pembimbing', $pembimbing->NIP_NIK)->get(); // Contoh query

        return view('home_pembimbing'); // Mengirim data ke view
        // , compact('pembimbing', 'siswaList')
    }

    public function monitoringPKL()
    {
        // Ambil semua data dari tabel ploting
        $plotingData = Ploting::with('siswa')->get();

        // Looping data ploting untuk disimpan ke dalam tabel monitoring
        foreach ($plotingData as $ploting) {
            Monitoring::updateOrCreate(
                ['NIS' => $ploting->siswa->NIS], // Kondisi untuk update jika data sudah ada
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

        // Setelah proses copy selesai, ambil data dari tabel monitoring
        $monitoring = Monitoring::with('siswa')->get();

        // Kirim data ke view monitoring
        return view('monitoring', ['monitoring' => $monitoring]);
    }


    // public function filterMonitoring(Request $request)
    // {
    //     // Ambil data ploting yang sudah ada di monitoring
    //     $query = Monitoring::with('siswa');

    //     // Filter berdasarkan tahun jika dipilih
    //     if ($request->filled('tahun') && $request->tahun != 'Tahun') {
    //         $query->where('tahun', $request->tahun);
    //     }

    //     // Filter berdasarkan konsentrasi keahlian jika dipilih
    //     if ($request->filled('konsentrasi_keahlian') && $request->konsentrasi_keahlian != 'Konsentrasi Keahlian') {
    //         $query->where('konsentrasi_keahlian', $request->konsentrasi_keahlian);
    //     }

    //     // Eksekusi query untuk mendapatkan hasil filter
    //     $monitoring = $query->get();

    //     // Kirim data monitoring yang sudah difilter ke view
    //     return view('monitoring', compact('monitoring'));
    // }

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
        $monitoring = Monitoring::where('NIS', $nis)->get();  // Ambil data monitoring siswa terkait
        $siswa = Monitoring::where('NIS', $nis)->first();  // Ambil data siswa terkait

        // Kirim data ke view monitoring persiswa
        return view('monitoring_persiswa', compact('monitoring', 'siswa'));
    }

    public function uploadMonitoring(Request $request, $nis)
{
    // Validasi file yang diupload
    $request->validate([
        'file' => 'required|file|mimes:xlsx,xls,csv',
    ]);

    // Mendapatkan file yang diupload
    $file = $request->file('file');
    
    // Menggunakan FastExcel untuk membaca file
    $rows = (new FastExcel)->import($file);

    // Pastikan baris dan kolom yang diinginkan ada di file
    if (isset($rows[20], $rows[29], $rows[38], $rows[48], $rows[50])) {
        // Ambil data dari sel yang diinginkan
        $data = [
            'nilai_tp1' => $rows[20]['F'], // Nilai TP1
            'nilai_tp2' => $rows[29]['F'], // Nilai TP2
            'nilai_tp3' => $rows[38]['F'], // Nilai TP3
            'nilai_tp4' => $rows[48]['F'], // Nilai TP4
            'nilai_akhir' => $rows[50]['F'], // Nilai Akhir
        ];

        // Update atau buat data monitoring baru berdasarkan NIS
        Monitoring::updateOrCreate(
            ['NIS' => $nis], 
            $data
        );

        // Redirect ke monitoring persiswa dengan pesan sukses
        return redirect()->route('monitoring_persiswa', ['nis' => $nis])->with('success', 'File berhasil diunggah dan disimpan.');
    }

    return redirect()->route('monitoring_persiswa', ['nis' => $nis])->with('error', 'Gagal membaca file, pastikan format sesuai.');
}


    // public function uploadMonitoring(Request $request)
    // {
    //     // Validasi file yang diupload
    //     $request->validate([
    //         'file' => 'required|file|mimes:xlsx,xls,csv',
    //     ]);

    //     // Mendapatkan file yang diupload
    //     $file = $request->file('file');
    //     // dd('test');

    //     // Menggunakan FastExcel untuk membaca file
    //     $rows = (new FastExcel)->import($file);

    //     // if (empty($rows)) {
    //     //     dd('File tidak terbaca atau kosong');
    //     // } else {
    //     //     dd($rows);  // Tampilkan isi $rows
    //     // }
        


    //     if (isset($rows[3], $rows[4], $rows[5], $rows[7], $rows[20], $rows[29], $rows[38], $rows[48], $rows[50])) {
    //         $data = [
    //             // 'NIS' => $rows[3]['E'], // Kolom E di baris 4
    //             // 'nama_siswa' => $rows[4]['E'], // Kolom E di baris 5
    //             // 'konsentrasi_keahlian' => $rows[5]['E'], // Kolom E di baris 6
    //             // 'nama_dudi' => $rows[7]['E'], // Kolom E di baris 8
    //             'nilai_tp1' => $rows[20]['F'], // Kolom F di baris 21
    //             'nilai_tp2' => $rows[29]['F'], // Kolom F di baris 30
    //             'nilai_tp3' => $rows[38]['F'], // Kolom F di baris 39
    //             'nilai_tp4' => $rows[48]['F'], // Kolom F di baris 49
    //             'nilai_akhir' => $rows[50]['F'], // Kolom F di baris 51
    //         ];

    //     // Mengambil data dari sel yang ditentukan
    //     // $row4 = $rows[3];  // Baris ke-4
    //     // $row5 = $rows[4];  // Baris ke-5
    //     // $row6 = $rows[5];  // Baris ke-6
    //     // $row8 = $rows[7];  // Baris ke-8
    //     // $row21 = $rows[20];  // Baris ke-21
    //     // $row30 = $rows[29];  // Baris ke-30
    //     // $row39 = $rows[38];  // Baris ke-39
    //     // $row49 = $rows[48];  // Baris ke-49
    //     // $row51 = $rows[50];  // Baris ke-51

    //     // Ambil data dari kolom tertentu di setiap baris
    //     // $data = [
    //     //     // 'NIS' => $row4['E'], // Kolom E di baris 4
    //     //     // 'nama_siswa' => $row5['E'], // Kolom E di baris 5
    //     //     // 'konsentrasi_keahlian' => $row6['E'], // Kolom E di baris 6
    //     //     // 'nama_dudi' => $row8['E'], // Kolom E di baris 8
    //     //     'nilai_tp1' => $row21['F'], // Kolom F di baris 21
    //     //     'nilai_tp2' => $row30['F'], // Kolom F di baris 30
    //     //     'nilai_tp3' => $row39['F'], // Kolom F di baris 39
    //     //     'nilai_tp4' => $row49['F'], // Kolom F di baris 49
    //     //     'nilai_akhir' => $row51['F'], // Kolom F di baris 51
    //     // ];

    //     // Simpan data ke database
    //     Monitoring::create($data);

    //     // Redirect ke halaman monitoring persiswa dengan pesan sukses
    //     return view('monitoring_persiswa')->with('success', 'Data berhasil diunggah dan disimpan.');
    // }}

        public function importMonitoring(Request $request)
        //, $nis
        {
            // Validasi file yang diupload
            $request->validate([
                'file' => 'required|file|mimes:xlsx,xls,csv',
            ]);

            $path = $request->file('file')->getRealPath();

            // Import data menggunakan FastExcel
            $excelData = (new FastExcel)->import($path);

            // Ambil header dari baris pertama
            $headers = $excelData->first();
            $headerNames = array_keys($headers);

            // Simpan header dan data ke session untuk ditampilkan di view
            session(['headerNames' => $headerNames, 'excelData' => $excelData]);

            // Aktifkan tombol import dengan data di session
            return redirect()->route('monitoring_persiswa', ['nis' => $nis])->with('success', 'File berhasil diunggah. Silakan klik Import.');
        }

    public function evaluasiPKL()
    {
        // Ambil semua data evaluasi
        $evaluasi = Evaluasi::all();
    
        // Return ke view evaluasi dengan data evaluasi
        return view('evaluasi', compact('evaluasi'));
    }

    public function evaluasiPerSiswa()
    //$nis
    {
        // Ambil data siswa
        //$siswa = Siswa::where('NIS', $nis)->firstOrFail();
        
        // Hitung nilai jurnal
        //$jurnal = LaporanJurnal::where('NIS', $nis)->count();
        //$jurnalTotal = 6 * 20; // Total 120 input untuk 6 bulan
        //$persentaseJurnal = ($jurnal / $jurnalTotal) * 10; // Bobot 10%

        // Ambil nilai PKL Dudi
        // $nilaiPklDudi = NilaiPkl::where('NIS', $nis)->first()->nilai;
        // $nilaiAkhirDudi = ($nilaiPklDudi * 50) / 100; // Bobot 50%

        // Ambil nilai monitoring pembimbing
        // $monitoring = Monitoring::where('NIS', $nis)->first();
        // $nilaiMonitoring = ($monitoring->nilai_total * 20) / 100; // Bobot 20%

        // // Cek apakah laporan pengimbasan diunggah
        // $pengimbasanUploaded = LaporanPengimbasan::where('NIS', $nis)->exists();
        // $nilaiPengimbasan = $pengimbasanUploaded ? 10 : 0; // Bobot 10%

        // // Cek apakah laporan akhir diunggah
        // $laporanAkhirUploaded = LaporanAkhir::where('NIS', $nis)->exists();
        // $nilaiAkhirPKL = $laporanAkhirUploaded ? 10 : 0; // Bobot 10%

        // // Hitung total nilai
        // $totalNilai = $persentaseJurnal + $nilaiAkhirDudi + $nilaiMonitoring + $nilaiPengimbasan + $nilaiAkhirPKL;

        // Kirim data ke view
        return view('evaluasi_persiswa');
        //, compact('siswa', 'persentaseJurnal', 'nilaiAkhirDudi', 'nilaiMonitoring', 'nilaiPengimbasan', 'nilaiAkhirPKL', 'totalNilai')
    }

    
    public function hasilNilaiPKL()
    {
        // Ambil semua data nilai PKL termasuk total nilai dari file Excel atau database
        $nilaiPkl = NilaiPkl::with('kelompok', 'siswaByNama', 'konsentrasiKeahlian', 'siswaByKelas', 'siswaByTahun')->get();

        // Kirim data ke view 'hasil_nilaipkl'
        return view('hasil_nilaipkl', ['nilaiPkl' => $nilaiPkl]);
    }

    public function hasilLaporanPengimbasan()
    {
        // Ambil semua data laporan pengimbasan
        $laporanPengimbasan = LaporanPengimbasan::with('kelompok', 'siswaByNama', 'konsentrasiKeahlian', 'siswaByKelas', 'dudi')->get();

        // Kirim data ke view
        return view('hasil_laporanpengimbasan', ['laporanPengimbasan' => $laporanPengimbasan]);
    }

    public function pembimbingLaporanJurnal()
    {
        $laporan_jurnal = LaporanJurnal::with(['kelompok', 'siswa', 'konsentrasiKeahlian', 'siswaByKelas', 'siswaByTahun'])->get();
        return view('pembimbing_laporanjurnal', compact('laporan_jurnal'));
    }

    // Tambahkan metode baru untuk laporan jurnal per siswa
    public function pembimbingLaporanJurnalPerSiswa()
    //$nis
    {
        // Ambil data siswa berdasarkan NIS
        //$siswa = Siswa::where('NIS', $nis)->firstOrFail();

        // Ambil laporan jurnal siswa
        //$jurnals = LaporanJurnal::where('NIS', $nis)->get();

        return view('pembimbing_laporanjurnal_persiswa');
        //, compact('siswa', 'jurnals')
    }

    public function hasilLaporanAkhir()
    {
        return view('hasil_laporanakhir');
    }
}