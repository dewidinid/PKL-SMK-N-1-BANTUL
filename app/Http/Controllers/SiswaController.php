<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiswaController extends Controller
{

    public function home()
    {
        return view('home_siswa');
    }

 // Menampilkan halaman profil
 public function showProfile()
 {
     $user = Auth::user(); // Mendapatkan data pengguna yang sedang login
     return view('profil_siswa', compact('user'));
 }

 // Meng-update foto profil
 public function updateProfilePicture(Request $request)
 {
     $request->validate([
         'profile_picture' => 'required|image|mimes:jpeg,png,jpg|max:2048',
     ]);

     $user = Auth::user();
     $file = $request->file('profile_picture');
     $path = $file->store('profile_pictures', 'public');

     // Update URL foto profil di database
     $user->profile_picture = Storage::url($path);
     $user->save();

     return redirect()->route('profil_siswa')->with('success', 'Foto profil berhasil diperbarui!');
 }

 // Meng-update data profil lainnya
 public function updateProfile(Request $request)
 {
     $request->validate([
         'kelompok' => 'required|string|max:255',
         'nis' => 'required|string|max:255',
         'nama' => 'required|string|max:255',
         'jurusan' => 'required|string|max:255',
         'tahun' => 'required|string|max:255',
         'password' => 'nullable|string|min:8',
     ]);

     $user = Auth::user();
     $user->kelompok = $request->input('kelompok');
     $user->nis = $request->input('nis');
     $user->nama = $request->input('nama');
     $user->jurusan = $request->input('jurusan');
     $user->tahun = $request->input('tahun');
     
     if ($request->filled('password')) {
         $user->password = bcrypt($request->input('password'));
     }

     $user->save();

     return redirect()->route('profil_siswa')->with('success', 'Profil berhasil diperbarui!');
 }

 // Method untuk menampilkan halaman verifikasi akhir
public function verifikasiAkhirPKL()
{
    return view('verifikasi_akhir_pkl');
}


    // Method to display the PKL form
    public function showMandiri()
    {
        return view('mandiri'); 
    }

    public function showPemetaan()
    {
        return view('pemetaan'); 
    }

    public function submitForm(Request $request)
{
    $validated = $request->validate([
        'nis' => 'required|string',
        'name' => 'required|string',
        'jurusan' => 'required|string',
        'no_handphone' => 'required|string',
        'rencana_tempat_pkl' => 'required|string',
        'proposal_pkl' => 'required|file|mimes:pdf,doc,docx|max:2048',
    ]);

    // Menyimpan file proposal
    $filePath = $request->file('proposal_pkl')->store('proposals');

    // Menyimpan data pengajuan ke database
    PengajuanPkl::create([
        'nis' => $request->input('nis'),
        'name' => $request->input('name'),
        'jurusan' => $request->input('jurusan'),
        'no_handphone' => $request->input('no_handphone'),
        'rencana_tempat_pkl' => $request->input('rencana_tempat_pkl'),
        'proposal_pkl' => $filePath,
    ]);

        return redirect()->route('formpengajuan')->with('Berhasil', 'Pengajuan PKL berhasil dikirim!');
        return view ('mandiri');
    }

    public function laporanJurnal() 
    {
        return view ('laporanpkl_jurnal');
    }

    public function nextJurnal(Request $request)
    {
        // Mengambil data jurnal dengan pagination, sesuaikan modelnya
        $jurnals = Jurnal::paginate(10); // Menampilkan 10 item per halaman

        // Mengembalikan view dengan data jurnal
        if ($request->ajax()) {
            return view('partials.jurnal_table', compact('jurnals'))->render();
        }

        return view('jurnal.nextJurnal', compact('jurnals'));
    }

    public function verifikasiAkhir()
{
    $isUploaded = true; // Ganti dengan logika cek apakah file sudah diupload
    return view('verifikasi_akhir', compact('isUploaded'));
}

public function uploadLaporanPengimbasan(Request $request)
{
    $request->validate([
        'laporan_pengimbasan' => 'required|file|mimes:pdf,doc,docx|max:2048',
    ]);

    // Proses penyimpanan file
    $file = $request->file('laporan_pengimbasan');
    $path = $file->store('laporan_pengimbasan', 'public');

    // Simpan path atau informasi lainnya di database jika perlu
    // Misalnya:
    // Auth::user()->update(['laporan_pengimbasan' => $path]);

    // Redirect kembali dengan pesan sukses
    return back()->with('success', 'Laporan pengimbasan berhasil diupload!');
}

public function uploadLaporanAkhir(Request $request)
    {
        $request->validate([
            'laporan_akhir' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);

        // Proses penyimpanan file
        $file = $request->file('laporan_akhir');
        $path = $file->store('laporan_akhir', 'public');

        // Simpan path atau informasi lainnya di database jika perlu
        // Misalnya:
        // Auth::user()->update(['laporan_akhir' => $path]);

        // Redirect kembali dengan pesan sukses
        return back()->with('success_laporan_akhir', 'Laporan akhir berhasil diupload!');
    }

}
