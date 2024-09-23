<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembimbing;
use App\Models\Dudi;
use App\Models\Pengajuan;

class AdminController extends Controller
{
    public function indexAdmin()
    {
        // Anda dapat mengirimkan data ke view jika diperlukan
        return view('home_admin');
    }
    
    public function dataSiswa()
    {
        // Anda dapat mengirimkan data ke view jika diperlukan
        return view('data_siswa');
    }

    public function dataMitraDudi()
    {
        // Mengambil semua data Dudi dari database
        $dudi = Dudi::all();

        // Mengirimkan data ke view
        return view('data_mitradudi', compact('dudi'));
    }

    public function importDudi(Request $request)
    {
        // Validasi file upload
        $request->validate([
            'file' => 'required|mimes:xlsx'
        ]);

        // Import data dari file Excel
        $file = $request->file('file');

        (new FastExcel)->import($file, function ($line) {
            // Menyimpan setiap baris data ke dalam tabel dudi
            Dudi::create([
                'kode_dudi' => $line['Kode Dudi'],
                'nama_dudi' => $line['Nama Dudi'],
                'alamat_dudi' => $line['Alamat Dudi'],
                'notelp_dudi' => $line['No Handphone'],
                'posisi_pkl' => $line['Posisi PKL'],
                'password' => bcrypt('password-default'), // Bisa diubah sesuai kebutuhan
            ]);
        });

        return redirect()->back()->with('success', 'Data mitra dudi berhasil diimport.');
    }

    public function plotingSiswa()
    {
        // Anda dapat mengirimkan data ke view jika diperlukan
        return view('ploting_siswa');
    }

    // Method untuk menampilkan halaman surat pengajuan
    public function suratPengajuan()
    {
        // Mengambil semua data pengajuan PKL dari database
        $pengajuan = Pengajuan::all();

        // Mengirimkan data pengajuan ke view
        return view('suratpengajuanmandiri', compact('pengajuan'));
    }
    
    // Method untuk menyetujui pengajuan PKL
    public function approvePengajuan(Request $request)
    {
        // Mendapatkan daftar ID pengajuan yang disetujui dari checkbox
        $approvedIds = $request->input('check', []);

        // Update status pengajuan menjadi disetujui berdasarkan ID yang dipilih
        Pengajuan::whereIn('id_pengajuan', $approvedIds)
                 ->update(['status_acc' => 1]);

        return redirect()->back()->with('success', 'Pengajuan PKL berhasil disetujui.');
    }

    public function guruPembimbing()
    {
        // Mengirimkan data guru pembimbing ke view
        $pembimbing = Pembimbing::all();
        return view('guru_pembimbing', compact('pembimbing'));
    }

    public function importPembimbing(Request $request)
    {
        // Validasi file upload
        $request->validate([
            'file' => 'required|mimes:xlsx'
        ]);

        // Import data dari file Excel
        $file = $request->file('file');

        (new FastExcel)->import($file, function ($line) {
            // Menyimpan setiap baris data ke dalam tabel pembimbing
            Pembimbing::create([
                'NIP_NIK' => $line['NIP_NIK'],
                'nama_pembimbing' => $line['Nama'],
                'notelp_pembimbing' => $line['No.Handphone'],
                'password' => bcrypt('password-default'), // Bisa diubah sesuai kebutuhan
            ]);
        });

        return redirect()->back()->with('success', 'Data guru pembimbing berhasil diimport.');
    }
}

