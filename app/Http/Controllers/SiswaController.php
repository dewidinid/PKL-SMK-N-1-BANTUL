<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Siswa;
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
        $request->validate([
            'kelompok' => 'required|string|max:255',
            'nis' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'konsentrasi_keahlian' => 'required|string|max:255',
            'tahun' => 'required|string|max:255',
            'password' => 'nullable|string|min:6',
        ]);

        // Mendapatkan data siswa yang sedang login
        $siswa = Auth::user(); // Pastikan ini mengembalikan objek Siswa yang valid

        // Jika siswa tidak ditemukan
        if (!$siswa) {
            return redirect()->back()->withErrors(['message' => 'Siswa tidak ditemukan']);
        }

        // Memperbarui informasi profil lainnya
        $siswa->kode_kelompok = $request->input('kelompok');
        $siswa->NIS = $request->input('nis');
        $siswa->nama_siswa = $request->input('nama');
        $siswa->konsentrasi_keahlian = $request->input('konsentrasi_keahlian');
        $siswa->tahun = $request->input('tahun');

        // Hanya update password jika ada input
        if ($request->filled('password')) {
            // Memperbarui password
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


    public function FormPengajuan(){
        // Ambil data siswa yang sedang login
        $siswa = Auth::user();

        // Jika siswa tidak ditemukan (belum login)
        if (!$siswa) {
            return redirect()->route('login')->withErrors(['login' => 'Silakan login terlebih dahulu.']);
        }

        return view('formpengajuan', compact('siswa'));
    }


    public function submitForm(Request $request)
    {
         // Ambil data siswa yang sedang login
         $siswa = Auth::user();

        // Validasi input form
        $validated = $request->validate([
            'nis' => 'required|string|max:255', // Pisahkan NIS dengan koma
            'nama_siswa' => 'required|string',
            'konsentrasi_keahlian' => 'required|string',
            'no_telp' => 'required|string',
            'tempat_pkl' => 'required|string',
            'proposal_pkl' => 'required|file|mimes:pdf,doc,docx',
        ]);

        // Menyimpan file proposal
        $filePath = $request->file('proposal_pkl')->store('proposals');

        // Simpan data pengajuan ke tabel 'pengajuan'
        $pengajuan = Pengajuan::create([
            'nama_siswa' => $request->input('nama_siswa'),
            'konsentrasi_keahlian' => $request->input('konsentrasi_keahlian'),
            'no_telp' => $request->input('no_telp'),
            'tempat_pkl' => $request->input('tempat_pkl'),
            'proposal_pkl' => $filePath,
        ]);

        // Pisahkan NIS berdasarkan koma dan simpan ke tabel pivot 'pengajuan_siswa'
        $nisList = explode(',', $request->input('nis'));

        foreach ($nisList as $nis) {
            DB::table('pengajuan_siswa')->insert([
                'id_pengajuan' => $pengajuan->id_pengajuan, // Mengambil ID dari pengajuan yang baru dibuat
                'nis' => trim($nis), // NIS dipisahkan koma dan disimpan
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Redirect dengan pesan berhasil
        return redirect()->route('formpengajuan')->with('success', 'Pengajuan PKL berhasil dikirim!');
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

        // Cek apakah laporan pengimbasan sudah diupload
        $isLaporanPengimbasanUploaded = !empty($siswa->laporan_pengimbasan);
        
        // Cek apakah laporan akhir sudah diupload
        $isLaporanAkhirUploaded = !empty($siswa->laporan_akhir);
        
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
        // Mengambil data siswa yang sedang login
        $siswa = Auth::user();

        // Validasi file laporan pengimbasan dan laporan akhir
        $request->validate([
            'laporan_pengimbasan' => 'required|file|mimes:pdf,doc,docx|max:2048',
            'laporan_akhir' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);

        // Simpan laporan pengimbasan
        if ($request->hasFile('laporan_pengimbasan')) {
            $pengimbasanPath = $request->file('laporan_pengimbasan')->storeAs(
                'public/laporan_pengimbasan',
                'laporan_pengimbasan_' . $siswa->NIS . '.' . $request->file('laporan_pengimbasan')->getClientOriginalExtension()
            );
        }

        // Simpan laporan akhir
        if ($request->hasFile('laporan_akhir')) {
            $akhirPath = $request->file('laporan_akhir')->storeAs(
                'public/laporan_akhir',
                'laporan_akhir_' . $siswa->NIS . '.' . $request->file('laporan_akhir')->getClientOriginalExtension()
            );
        }

        // Berikan pesan sukses setelah upload berhasil
        return redirect()->back()->with('success', 'Laporan berhasil diunggah.');
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
