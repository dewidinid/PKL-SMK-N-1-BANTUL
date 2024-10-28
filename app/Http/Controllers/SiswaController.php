<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Models\Siswa;
use App\Models\Dudi;
use App\Models\LaporanJurnal;
use App\Models\Ploting;
use App\Models\Pengajuan;
use App\Models\LaporanPengimbasan; 
use App\Models\LaporanAkhir;


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
    // Validasi input termasuk password lama dan baru
    $request->validate([
        'kelompok' => 'required|string|max:255',
        'nis' => 'required|string|max:255',
        'nama' => 'required|string|max:255',
        'konsentrasi_keahlian' => 'required|string|max:255',
        'tahun' => 'required|string|max:255',
        'current_password' => 'required|string|min:6', // Validasi password lama
        'password' => 'nullable|string|min:6', // Password baru opsional
    ]);

    // Mendapatkan data siswa yang sedang login
    $siswa = Auth::user(); // Pastikan ini mengembalikan objek Siswa yang valid

    // Jika siswa tidak ditemukan
    if (!$siswa) {
        return redirect()->back()->withErrors(['message' => 'Siswa tidak ditemukan']);
    }

    // Validasi password lama
    if (!Hash::check($request->input('current_password'), $siswa->password)) {
        return redirect()->back()->withErrors(['current_password' => 'Password lama yang Anda masukkan salah.']);
    }

    // Memperbarui informasi profil lainnya
    $siswa->kode_kelompok = $request->input('kelompok');
    $siswa->NIS = $request->input('nis');
    $siswa->nama_siswa = $request->input('nama');
    $siswa->konsentrasi_keahlian = $request->input('konsentrasi_keahlian');
    $siswa->tahun = $request->input('tahun');

    // Hanya update password jika password baru diisi
    if ($request->filled('password')) {
        // Memperbarui password dengan password baru
        $siswa->password = bcrypt($request->input('password'));
    }

    // Simpan perubahan
    $siswa->save();

    // Set flash message
    $request->session()->flash('success', 'Data berhasil diperbarui!');
    $request->session()->flash('from', 'update_profile'); // Tandai dari update profil

    return redirect()->route('profil_siswa')->with('success', 'Profil berhasil diperbarui!');
}



    // Method to display the PKL form
    public function showMandiri()
    {
        return view('mandiri'); 
    }

    public function showPemetaan()
    {
        // Ambil semua data ploting beserta relasinya
        $plotingData = Ploting::with('siswa', 'pembimbing', 'dudi')->get();

        // Kirim data ploting ke view
        return view('pemetaan', compact('plotingData'));
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

    // Kirimkan data siswa dan dudiList ke view
    return view('formpengajuan', compact('siswa', 'dudiList'));
}


public function submitForm(Request $request)
{
    // Validasi input form
    $validated = $request->validate([
        'nis' => 'required|string|max:255',
        'nama_siswa' => 'required|string',
        'konsentrasi_keahlian' => 'required|string',
        'no_telp' => 'required|string',
        'tempat_pkl' => 'required|string',
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
            'tempat_pkl' => $request->input('tempat_pkl'),
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
        return redirect()->route('formpengajuan')->with('success', 'Pengajuan PKL berhasil dikirim!');

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

        // Ambil data jurnal berdasarkan NIS siswa yang sedang login
        $jurnals = LaporanJurnal::where('NIS', $siswa->NIS)->get(); 

        return view('laporanpkl_jurnal', compact('jurnals', 'siswa'))->render();
    }

    public function submitJurnal(Request $request)
    {
        // Debug data yang diterima dari form
        //dd($request->all());
        
        // Lanjutkan jika validasi berhasil
        $siswa = Auth::user();

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
                'nama_dudi' => $siswa->nama_dudi,
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

       // Cek apakah laporan pengimbasan sudah diupload (ambil dari tabel laporan_pengimbasan)
        $isLaporanPengimbasanUploaded = DB::table('laporan_pengimbasan')
            ->where('NIS', $siswa->NIS)
            ->exists();

        // Cek apakah laporan akhir sudah diupload (ambil dari tabel laporan_akhir)
        $isLaporanAkhirUploaded = DB::table('laporan_akhir')
            ->where('NIS', $siswa->NIS)
            ->exists();
        
        // Path file nilai PKL berdasarkan NIS siswa
        $nilaiPklFilePath = 'public/nilai_pkl/nilai_pkl_' . $siswa->NIS . '.xlsx';
        
        // Cek apakah file nilai PKL ada di storage
        $isNilaiPklAvailable = Storage::exists($nilaiPklFilePath);
        
        // Mengembalikan view dengan data yang diperlukan
        return view('verifikasi_akhir_pkl', [
            'siswa' => $siswa,
            'isLaporanPengimbasanUploaded' => $isLaporanPengimbasanUploaded,
            'isLaporanAkhirUploaded' => $isLaporanAkhirUploaded,
            'isNilaiPklAvailable' => $isNilaiPklAvailable,
            'nilaiPklFilePath' => $nilaiPklFilePath,
        ]);
    }

    // Fungsi untuk upload laporan pengimbasan dan laporan akhir
    public function uploadLaporan(Request $request)
    {
        $siswa = Auth::user();

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
                $pengimbasanPath = $request->file('laporan_pengimbasan')->storeAs(
                    'public/laporan_pengimbasan',
                    'laporan_pengimbasan_' . $siswa->NIS . '.' . $request->file('laporan_pengimbasan')->getClientOriginalExtension()
                );

                // Update atau insert data ke tabel laporan_pengimbasan
                DB::table('laporan_pengimbasan')->updateOrInsert(
                    ['NIS' => $siswa->NIS], 
                    [
                        'laporan_pengimbasan' => $pengimbasanPath,
                        // 'kode_kelompok' => $siswa->kode_kelompok,
                        // 'kode_dudi' => $siswa->kode_dudi,
                        'konsentrasi_keahlian' => $siswa->konsentrasi_keahlian,
                        'nama' => $siswa->nama_siswa,
                        'kelas' => $siswa->kelas,
                        'nama_dudi' => $siswa->nama_dudi,
                    ]
                );

                $messages[] = 'Laporan pengimbasan berhasil diunggah!';
            }

            // Simpan laporan akhir jika diupload
            if ($request->hasFile('laporan_akhir')) {
                $akhirPath = $request->file('laporan_akhir')->storeAs(
                    'public/laporan_akhir',
                    'laporan_akhir_' . $siswa->NIS . '.' . $request->file('laporan_akhir')->getClientOriginalExtension()
                );

                // Update atau insert data ke tabel laporan_akhir
                DB::table('laporan_akhir')->updateOrInsert(
                    ['NIS' => $siswa->NIS], 
                    [
                        'laporan_akhir' => $akhirPath,
                        // 'kode_kelompok' => $siswa->kode_kelompok,
                        // 'kode_dudi' => $siswa->kode_dudi,
                        'konsentrasi_keahlian' => $siswa->konsentrasi_keahlian,
                        'nama' => $siswa->nama_siswa,
                        'kelas' => $siswa->kelas,
                        'nama_dudi' => $siswa->nama_dudi,
                    ]
                );

                $messages[] = 'Laporan akhir berhasil diunggah!';
            }

            // Gabungkan pesan sukses dan kirim ke view
            return redirect()->back()->with('success', implode(' ', $messages));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengunggah laporan: ' . $e->getMessage());
        }
    }


   
   // Fungsi untuk menampilkan file nilai PKL
//    public function previewNilaiPkl()
//    {
//        // Mengambil data siswa yang sedang login
//        $siswa = Auth::user(); // Menggunakan variabel $siswa

//        // Path file nilai PKL berdasarkan NIS siswa
//        $nilaiPklPath = storage_path('app/public/nilai_pkl/nilai_pkl_' . $siswa->NIS . '.xlsx');

//        // Cek apakah file ada
//        if (!file_exists($nilaiPklPath)) {
//            return redirect()->back()->with('error', 'File nilai PKL tidak ditemukan.');
//        }

//        // Menampilkan file nilai PKL dalam tab baru
//        return response()->file($nilaiPklPath, [
//            'Content-Disposition' => 'inline; filename="Nilai_PKL_' . $siswa->NIS . '.xlsx"'
//        ]);
//    }


}
