<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Siswa;
use App\Models\Dudi;
use App\Models\LaporanJurnal;
use App\Models\Ploting;
use App\Models\Pengajuan;
use App\Models\LaporanPengimbasan; 
use App\Models\LaporanAkhir;
use App\Models\NilaiPkl;
use App\Models\Monitoring;
use App\Models\MonitoringPerSiswa;


class SiswaController extends Controller
{

    public function home()
    {
        if (Auth::user()->role !== 'siswa') {
            return redirect()->route('login')->withErrors('Anda tidak memiliki akses ke halaman ini.');
        }

        // Ambil data siswa yang sedang login
        $siswa = Auth::user();

        return view('home_siswa', compact('siswa'));
    }

    // Menampilkan halaman profil
    public function showProfile(Request $request)
    {
        // Mengambil data siswa yang sedang login
        $siswa = Auth::user();

        if (!$siswa) {
            return redirect()->route('login')->withErrors(['login' => 'Silakan login terlebih dahulu.']);
        }

        // Tidak perlu melakukan query lagi, karena data siswa sudah ada di $siswa
        return view('profil_siswa', compact('siswa'));
    }
 


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'NIS' => 'required|digits:6|unique:siswa,NIS',
            'nama_siswa' => 'required|string|max:255',
        ]);

        // Membuat siswa baru dengan password default
        Siswa::create([
            'NIS' => $validatedData['NIS'],
            'nama_siswa' => $validatedData['nama_siswa'],
            'password' => bcrypt('pw' . $validatedData['NIS']),
        ]);

        return redirect()->route('some_route')->with('success', 'Siswa berhasil ditambahkan dengan password default.');
    }

    // Meng-update foto profil
    public function updateProfilePicture(Request $request)
    {
        // Mendapatkan data siswa yang sedang login menggunakan guard 'siswa'
        $siswa = Auth::guard('siswa')->user();

        // Jika siswa tidak ditemukan (belum login), redirect ke login
        if (!$siswa) {
            return redirect()->route('login')->withErrors(['login' => 'Silakan login terlebih dahulu.']);
        }

        // Validasi input
        $request->validate([
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/profile_pictures', $filename);
        
            $siswa->profile_picture = 'profile_pictures/' . $filename;
            $siswa->save();
        }

        $request->session()->flash('success', 'Foto profil berhasil diperbarui!');
        $request->session()->flash('from', 'update_profile_picture'); // Tandai dari update foto profil


        return redirect()->route('profil_siswa')->with('success', 'Foto profil berhasil diperbarui!');
    }




    // Meng-update data profil lainnya
    public function updateProfile(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string|min:6',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $siswa = Auth::user();

        if (!Hash::check($request->input('current_password'), $siswa->password)) {
            return response()->json(['success' => false, 'message' => 'Password lama yang Anda masukkan salah.']);
        }

        // Update password dan ubah status is_default_password menjadi false
        $siswa->password = Hash::make($request->input('password'));
        $siswa->is_default_password = false;

        // Simpan perubahan dan cek apakah berhasil
        if ($siswa->save()) {
            // Refresh instance untuk memastikan data terbaru tersimpan
            $siswa->refresh();
            Auth::logout();
            return response()->json(['success' => true, 'message' => 'Password berhasil diubah.']);
        }

        return response()->json(['success' => false, 'message' => 'Gagal mengubah password.']);
    }



    public function validatePassword(Request $request)
    {
        try {
            // Mengambil pengguna yang sedang login
            $siswa = Auth::guard('siswa')->user();

            // Jika pengguna tidak ditemukan
            if (!$siswa) {
                return response()->json(['valid' => false, 'message' => 'Pengguna tidak ditemukan'], 404);
            }

            // Validasi password lama
            if (Hash::check($request->input('current_password'), $siswa->password)) {
                return response()->json(['valid' => true, 'message' => 'Password lama valid'], 200);
            } else {
                return response()->json(['valid' => false, 'message' => 'Password lama salah'], 200);
            }
        } catch (\Exception $e) {
            // Jika terjadi error, tampilkan pesan error
            return response()->json(['valid' => false, 'message' => 'Kesalahan server: ' . $e->getMessage()], 500);
        }
    }




    // Method to display the PKL form
    public function showMandiri()
    {
        return view('mandiri'); 
    }

    public function showPemetaan(Request $request)
    {
        // Ambil tahun yang dipilih dari request
        $tahun = $request->input('tahun');

        // Dapatkan data tahun yang tersedia dari data Siswa untuk diisi ke dropdown
        $availableYears = Siswa::with('siswa')->select('tahun')->distinct()->pluck('tahun');

        // Ambil data ploting berdasarkan filter tahun jika ada
        $query = Ploting::with('siswa', 'pembimbing', 'dudi');
        if ($tahun) {
            $query->whereHas('siswa', function($q) use ($tahun) {
                $q->where('tahun', $tahun);
            });
        }
        $plotingData = $query->get();

        // Kirim data ploting dan tahun ke view
        return view('pemetaan', compact('plotingData', 'availableYears'));
    }



    public function FormPengajuan()
    {
        // Ambil data siswa yang sedang login
        $siswa = Auth::user();

        // Jika siswa tidak ditemukan (belum login)
        if (!$siswa) {
            return redirect()->route('login')->withErrors(['login' => 'Silakan login terlebih dahulu.']);
        }

        // Ambil data Dudi dari tabel dudi
        $dudiList = Dudi::all(); // Dapatkan semua data Dudi

        // Ambil daftar konsentrasi keahlian unik dari tabel siswa
        $konsentrasiKeahlianList = Siswa::select('konsentrasi_keahlian')->distinct()->pluck('konsentrasi_keahlian');

        // Kirimkan data siswa, dudiList, dan konsentrasiKeahlianList ke view
        return view('formpengajuan', compact('siswa', 'dudiList', 'konsentrasiKeahlianList'));
    }


    public function submitForm(Request $request)
    {
        // Validasi input form
        $validated = $request->validate([
            'nis' => 'required|string|max:255',
            'nama_siswa' => 'required|string',
            'konsentrasi_keahlian' => 'required|string',
            'no_telp' => 'required|string',
            'nama_dudi' => 'required|string',
            'proposal_pkl' => 'required|file|mimes:pdf,doc,docx|max:2048',
            'notelp_dudi' => 'nullable|string',
        ]);

        try {
            DB::beginTransaction(); // Mulai transaksi database

            // Simpan file proposal
            $originalFileName = $request->file('proposal_pkl')->getClientOriginalName();
            $filePath = $request->file('proposal_pkl')->storeAs('public/proposals', $originalFileName);

            // Simpan data pengajuan
            $pengajuan = Pengajuan::create([
                'nama_siswa' => $request->input('nama_siswa'),
                'konsentrasi_keahlian' => $request->input('konsentrasi_keahlian'),
                'no_telp' => $request->input('no_telp'),
                'nama_dudi' => $request->input('nama_dudi'),
                'notelp_dudi' => $request->input('notelp_dudi'),
                'proposal_pkl' => $originalFileName,
                'created_by' => Auth::user()->NIS,
            ]);

            // Pisahkan NIS dan bersihkan spasi
            $nisList = array_filter(array_map('trim', explode(',', $request->input('nis'))));

            // Validasi setiap NIS
            foreach ($nisList as $nis) {
                // Periksa apakah NIS ada di tabel siswa
                $siswa = DB::table('siswa')->where('NIS', $nis)->first();
                
                if (!$siswa) {
                    throw new \Exception("NIS $nis tidak ditemukan dalam database.");
                }

                // Insert ke tabel pengajuan_siswa
                DB::table('pengajuan_siswa')->insert([
                    'id_pengajuan' => $pengajuan->id_pengajuan,
                    'nis' => $nis,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            DB::commit(); // Commit transaksi jika semua berhasil
            return redirect()->route('home_siswa')->with('success', 'Pengajuan PKL berhasil dikirim!');

        } catch (\Exception $e) {
            DB::rollBack(); // Rollback jika terjadi error
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    


    public function laporanJurnal() 
    {
        // Ambil data siswa yang sedang login
        $siswa = Auth::user();

        // Jika siswa tidak ditemukan (belum login)
        if (!$siswa) {
            return redirect()->route('login')->withErrors(['login' => 'Silakan login terlebih dahulu.']);
        }

        // Ambil data jurnal berdasarkan NIS siswa yang sedang login dengan eager loading relasi `ploting`
        $jurnals = LaporanJurnal::with('ploting')->where('NIS', $siswa->NIS)->get(); 

        // Ambil data ploting untuk nama_dudi
        $ploting = Ploting::where('NIS', $siswa->NIS)->first();

        return view('laporanpkl_jurnal', compact('jurnals', 'siswa', 'ploting'));
    }


    public function submitJurnal(Request $request)
    {
        // Debug data yang diterima dari form
        //dd($request->all());
        
        // Lanjutkan jika validasi berhasil
        $siswa = Auth::user();

        // $ploting = Ploting::where('NIS', $siswa->NIS)->first();

        // Cek apakah siswa sudah di ploting
        $ploting = Ploting::where('NIS', $siswa->NIS)->first();
        if (!$ploting) {
            return redirect()->route('laporanpkl_jurnal')->with('error', 'Anda belum terploting, tidak dapat menambahkan jurnal.');
        }

        // Validasi input lainnya (kegiatan, tempat dudi, dll.)
        $validated = $request->validate([
            'nis' => 'required',
            'kegiatan' => 'required|string',
            'lokasi' => 'required|string',
        ]);

        try {
            LaporanJurnal::create([
                'tanggal' => now(),  // Menyimpan tanggal saat ini
                'NIS' => $siswa->NIS,
                'nama_siswa' => $siswa->nama_siswa,
                'konsentrasi_keahlian' => $siswa->konsentrasi_keahlian,
                // 'kode_kelompok' => $siswa->kode_kelompok,
                'kelas' => $siswa->kelas,
                'nama_dudi' => $ploting ? $ploting->nama_dudi : 'DUDI tidak terdaftar',
                'kegiatan' => $request->input('kegiatan'),
                'lokasi' => $request->input('lokasi'),
            ]);
        
            return redirect()->route('laporanpkl_jurnal')->with('success', 'Jurnal berhasil disimpan!');
        } catch (\Exception $e) {
            // Menangkap pesan error yang lebih detail
            return redirect()->route('laporanpkl_jurnal')->with('error', 'Gagal menyimpan laporan jurnal: ' . $e->getMessage());
        }        
    }


    public function verifikasiAkhirPKL()
    {
        // Mengambil data siswa yang sedang login
        $siswa = Auth::user();
        
        if (!$siswa) {
            return redirect()->route('login')->withErrors(['login' => 'Silakan login terlebih dahulu.']);
        }    

        // Cek apakah laporan pengimbasan sudah diupload dan ambil nama filenya
        $laporanPengimbasan = DB::table('laporan_pengimbasan')
            ->where('NIS', $siswa->NIS)
            ->first();

        $isLaporanPengimbasanUploaded = $laporanPengimbasan !== null && !empty($laporanPengimbasan->laporan_pengimbasan);
        $laporanPengimbasanUrl = $isLaporanPengimbasanUploaded ? asset('storage/laporan_pengimbasan/' . $laporanPengimbasan->laporan_pengimbasan) : null;

        // Cek apakah laporan akhir sudah diupload dan ambil nama filenya
        $laporanAkhir = DB::table('laporan_akhir')
            ->where('NIS', $siswa->NIS)
            ->first();

        $isLaporanAkhirUploaded = $laporanAkhir !== null && !empty($laporanAkhir->laporan_akhir);
        $laporanAkhirUrl = $isLaporanAkhirUploaded ? asset('storage/laporan_akhir/' . $laporanAkhir->laporan_akhir) : null;

        // Path file nilai PKL berdasarkan NIS siswa
        $nilaiPklFilePath = 'public/nilai_pkl/nilai_pkl_' . $siswa->NIS . '.xlsx';
        $isNilaiPklAvailable = Storage::exists($nilaiPklFilePath);
        
        // Mengembalikan view dengan data yang diperlukan
        return view('verifikasi_akhir_pkl', [
            'siswa' => $siswa,
            'isLaporanPengimbasanUploaded' => $isLaporanPengimbasanUploaded,
            'isLaporanAkhirUploaded' => $isLaporanAkhirUploaded,
            'laporanPengimbasanUrl' => $laporanPengimbasanUrl,
            'laporanAkhirUrl' => $laporanAkhirUrl,
            'isNilaiPklAvailable' => $isNilaiPklAvailable,
            'nilaiPklFilePath' => $nilaiPklFilePath,
        ]);
    }


    // Fungsi untuk upload laporan pengimbasan dan laporan akhir
    public function uploadLaporan(Request $request)
    {
        $siswa = Auth::user();
        $dudi = $siswa->ploting->nama_dudi ?? null; 
        $ploting = Ploting::where('NIS', $siswa->NIS)->first();

        // Validasi file laporan pengimbasan dan laporan akhir
        $request->validate([
            'laporan_pengimbasan' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'laporan_akhir' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        try {
            // Pesan sukses yang berbeda untuk tiap laporan
            $messages = [];

            // Simpan laporan pengimbasan jika diupload
            if ($request->hasFile('laporan_pengimbasan')) {
                $pengimbasanFileName = 'laporan_pengimbasan_' . $siswa->NIS . '.' . $request->file('laporan_pengimbasan')->getClientOriginalExtension();
                $pengimbasanPath = $request->file('laporan_pengimbasan')->storeAs(
                    'public/laporan_pengimbasan',
                    $pengimbasanFileName
                );
            
                // Update atau insert data ke tabel laporan_pengimbasan
                DB::table('laporan_pengimbasan')->updateOrInsert(
                    ['NIS' => $siswa->NIS], 
                    [
                        'laporan_pengimbasan' => $pengimbasanFileName,
                        'konsentrasi_keahlian' => $siswa->konsentrasi_keahlian,
                        'nama' => $siswa->nama_siswa,
                        'kelas' => $siswa->kelas,
                        'nama_dudi' => $dudi, // Menggunakan variabel $dudi
                        'kode_kelompok' => $siswa->kode_kelompok, // Memasukkan kode_kelompok
                        'kode_dudi' => $ploting->kode_dudi, // Memasukkan kode_dudi
                    ]
                );

                // Menambahkan pesan sukses untuk laporan pengimbasan
                $messages[] = 'Berhasil mengunggah laporan pengimbasan.';
            }
            

            // Simpan laporan akhir jika diupload
            if ($request->hasFile('laporan_akhir')) {
                $akhirFileName = 'laporan_akhir_' . $siswa->NIS . '.' . $request->file('laporan_akhir')->getClientOriginalExtension();
                $akhirPath = $request->file('laporan_akhir')->storeAs(
                    'public/laporan_akhir',
                    $akhirFileName
                );
            
                // Update atau insert data ke tabel laporan_akhir
                DB::table('laporan_akhir')->updateOrInsert(
                    ['NIS' => $siswa->NIS], 
                    [
                        'laporan_akhir' => $akhirFileName,
                        'konsentrasi_keahlian' => $siswa->konsentrasi_keahlian,
                        'nama_siswa' => $siswa->nama_siswa,
                        'kelas' => $siswa->kelas,
                        'nama_dudi' => $dudi, // Menggunakan variabel $dudi
                        'kode_kelompok' => $siswa->kode_kelompok, // Memasukkan kode_kelompok
                        'kode_dudi' => $ploting->kode_dudi, // Memasukkan kode_dudi
                    ]
                );

                // Menambahkan pesan sukses untuk laporan akhir
                $messages[] = 'Berhasil mengunggah laporan akhir.';
            }

            // Gabungkan pesan sukses dan kirim ke view
            return redirect()->back()->with('success', implode(' ', $messages));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengunggah laporan: ' . $e->getMessage());
        }
    }

    public function lihatNilaiPkl()
    {
        $siswa = Auth::user(); // Mendapatkan data siswa yang sedang login

        $nis = $siswa->NIS;

        // Ambil nilai-nilai dari evaluasi per siswa (sama seperti di PembimbingController)
        $jurnal = LaporanJurnal::where('NIS', $nis)->count();
        $jurnalTotal = 6 * 20;
        $persentaseJurnal = ($jurnal / $jurnalTotal) * 10;
        $nilaiJurnalFull = min(($jurnal / $jurnalTotal) * 100, 100);

        $nilaiPklDudi = NilaiPkl::where('NIS', $nis)->first();
        $nilaiAkhirDudi = $nilaiPklDudi ? ($nilaiPklDudi->nilai * 50) / 100 : 0;
        $nilaiDudiFull = $nilaiPklDudi ? $nilaiPklDudi->nilai : 0;

        // Mengambil data monitoring per siswa
        $monitoringPerSiswa = MonitoringPerSiswa::where('NIS', $nis)->get();
        $jumlahUploadMonitoring = $monitoringPerSiswa->count();

        // Nilai akhir monitoring (rata-rata nilai monitoring jika ada)
        $nilaiAkhirMonitoring = $monitoringPerSiswa->avg('nilai_monitoring');

        // Menghitung nilai Monitoring berdasarkan rata-rata nilai akhir
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

        $pengimbasanUploaded = LaporanPengimbasan::where('NIS', $nis)->exists();
        $nilaiPengimbasan = $pengimbasanUploaded ? 10 : 0;
        $nilaiPengimbasanFull = $pengimbasanUploaded ? 100 : 0;

        $laporanAkhirUploaded = LaporanAkhir::where('NIS', $nis)->exists();
        $nilaiAkhirPKL = $laporanAkhirUploaded ? 10 : 0;
        $nilaiAkhirPKLFull = $laporanAkhirUploaded ? 100 : 0;

        // Hitung total nilai
        $totalNilai = $persentaseJurnal + $nilaiAkhirDudi + $nilaiMonitoring + $nilaiPengimbasan + $nilaiAkhirPKL;

        return view('lihatNilaiPkl', [
            'nilaiPkl' => (object) [
                'persentase_jurnal' => $nilaiJurnalFull,
                'nilai_akhir_dudi' => $nilaiDudiFull,
                'monitoring_pembimbing' => $nilaiMonitoringFull,
                'nilai_pengimbasan' => $nilaiPengimbasanFull,
                'nilai_akhir_pkl' => $nilaiAkhirPKLFull
            ],
            'totalNilai' => $totalNilai,
            'statusMonitoringColor' => $statusMonitoringColor
        ]);
    }


    


}
