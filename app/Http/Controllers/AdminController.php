<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Rap2hpoutre\FastExcel\FastExcel;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Siswa;
use App\Models\Kelompok;
use App\Models\Pembimbing;
use App\Models\Dudi;
use App\Models\Ploting;
use App\Models\NilaiPkl;
use App\Models\Pengajuan;
use App\Models\PengajuanSiswa;

class AdminController extends Controller
{
    public function indexAdmin()
    {
        // Menghitung jumlah siswa dari database
        $jumlahSiswa = Siswa::count();
        $jumlahPembimbing = Pembimbing::count();
        $jumlahDudi = Dudi::count();

        // Kirim jumlah siswa ke view
        return view('home_admin', compact('jumlahSiswa', 'jumlahPembimbing', 'jumlahDudi'));
    }
    
    public function dataSiswa()
    {
        $siswa = Siswa::with( 'kelompok', 'dudi')->get();
        //dd($siswa);
        // Anda dapat mengirimkan data ke view jika diperlukan
        return view('data_siswa', ['siswa' => $siswa]);
    }

    public function importSiswa(Request $request)
    {
        // Validasi file upload
        $request->validate([
            'file' => 'required|mimes:xlsx'
        ]);

        // Import data dari file Excel
        $file = $request->file('file');
        $imported = false; // Flag untuk menandai apakah ada data yang diimport
        $duplicate = false; // Flag untuk menandai apakah ada data duplikat

        (new FastExcel)->import($file, function ($line) use (&$imported, &$duplicate) {
            // Cek apakah NIS sudah ada di database
            $existingSiswa = Siswa::where('NIS', $line['NIS'])->first();

            if ($existingSiswa) {
                $duplicate = true; // Tandai jika data duplikat ditemukan
            } else {
                // Menyimpan data baru ke dalam tabel siswa
                Siswa::create([
                    'NIS' => $line['NIS'],
                    'nama_siswa' => $line['Nama'],
                    'konsentrasi_keahlian' => $line['Konsentrasi Keahlian'],
                    'kelas' => $line['Kelas'],
                    'tahun' => $line['Tahun'],
                    // Tambahkan kolom lain sesuai kebutuhan
                ]);
                $imported = true; // Tandai jika ada data yang berhasil diimport
            }
        });

        // Kondisi jika ada data duplikat dan tidak ada yang diimport
        if ($duplicate && !$imported) {
            return redirect()->back()->with('error', "Data sudah ditemukan. Upload tidak bertambah.");
        }

        // Kondisi jika ada data yang berhasil diimport
        if ($imported) {
            return redirect()->back()->with('success', 'Data siswa berhasil diimport.');
        }

        // Kondisi jika tidak ada data yang ditambahkan (semua data sudah ada)
        return redirect()->back()->with('error', 'Data sudah ditemukan (upload tidak bertambah).');
    }

    public function insertToMonitoring()
    {
        // Ambil semua data dari tabel Ploting
        $plotingData = Ploting::with('siswa', 'pembimbing', 'dudi')->get();

        foreach ($plotingData as $ploting) {
            Monitoring::create([
                'NIS' => $ploting->siswa->NIS,
                'kode_kelompok' => $ploting->kode_kelompok,
                'kode_dudi' => $ploting->dudi->kode_dudi,
                'nama_siswa' => $ploting->siswa->nama_siswa,
                'konsentrasi_keahlian' => $ploting->siswa->konsentrasi_keahlian,
                'NIP_NIK' => $ploting->pembimbing->NIP_NIK,
                'nama_pembimbing' => $ploting->pembimbing->nama_pembimbing,
                'nama_dudi' => $ploting->dudi->nama_dudi,
                'kelas' => $ploting->siswa->kelas,
                'tahun' => $ploting->siswa->tahun,
            ]);
        }

        return redirect()->route('monitoring')->with('success', 'Data berhasil dimasukkan ke Monitoring.');
    }
    
    public function updateSiswa(Request $request)
    {
        // Validasi input
        $request->validate([
            'NIS' => 'required|string|max:255',
            'nama_siswa' => 'required|string|max:255',
            'konsentrasi_keahlian' => 'required|string|max:255',
            'kelas' => 'required|string|max:255',
            'tahun' => 'required|string|max:255',
        ]);

        // Cari siswa berdasarkan NIS
        $siswa = Siswa::where('NIS', $request->input('NIS'))->first();

        // Update data siswa
        if ($siswa) {
            $siswa->update([
                'nama_siswa' => $request->input('nama_siswa'),
                'konsentrasi_keahlian' => $request->input('konsentrasi_keahlian'),
                'kelas' => $request->input('kelas'),
                'tahun' => $request->input('tahun'),
            ]);

            return redirect()->back()->with('success', 'Data siswa berhasil diupdate.');
        }

        return redirect()->back()->with('error', 'Siswa tidak ditemukan.');
    }


    public function filterSiswa(Request $request)
    {
        // Mengambil input filter dari form
        $tahun = $request->input('tahun');
        $konsentrasiKeahlian = $request->input('konsentrasi_keahlian');

        // Membangun query untuk mengambil data siswa
        $query = Siswa::query();

        // Menambahkan filter tahun jika dipilih
        if ($tahun && $tahun != 'Tahun') {
            $query->where('tahun', $tahun);
        }

        // Menambahkan filter konsentrasi keahlian jika dipilih
        if ($konsentrasiKeahlian && $konsentrasiKeahlian != 'Konsentrasi Keahlian') {
            $query->where('konsentrasi_keahlian', $konsentrasiKeahlian);
        }

        // Menjalankan query dan mengambil data
        $siswa = $query->with('konsentrasiKeahlian', 'kelompok', 'dudi')->get();

        // Mengembalikan view dengan data siswa yang telah difilter
        return view('data_siswa', ['siswa' => $siswa]);
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
        $importedData = []; // Nama variabel diubah untuk konsistensi
        $duplicates = []; // Array untuk menyimpan kode Dudi yang sudah ada

        (new FastExcel)->import($file, function ($line) use (&$importedData, &$duplicates) {
            // Mengecek apakah data Dudi sudah ada
            $dudi = Dudi::where('kode_dudi', $line['Kode Dudi'])->first();

            if (!$dudi) {
                // Data tidak ada, tambahkan
                $importedData[] = Dudi::create([
                    'kode_dudi' => $line['Kode Dudi'],
                    'nama_dudi' => $line['Nama Dudi'],
                    'bidang_usaha' => $line['Bidang Usaha'],
                    'notelp_dudi' => $line['No Telp'],
                    'alamat_dudi' => $line['Alamat Dudi'],
                    'password' => bcrypt('password-default'), // Bisa diubah sesuai kebutuhan
                ]);
            } else {
                // Data sudah ada, simpan dalam array duplicates
                $duplicates[] = $line['Kode Dudi'];
            }
        });

        // Mengembalikan respon berdasarkan hasil upload
        if (count($importedData) > 0) {
            return redirect()->back()->with('success', 'Data mitra Dudi berhasil diimpor.');
        } elseif (count($duplicates) > 0) {
            $duplicateCodes = implode(', ', $duplicates);
            return redirect()->back()->with('error', "Data sudah ditemukan (kode Dudi: $duplicateCodes). Upload tidak bertambah.");
        }

        return redirect()->back()->with('error', 'Data sudah ditemukan (upload tidak bertambah).');
    }


    public function storeDudi(Request $request)
    {
        // Validasi input tanpa validasi unik
        $request->validate([
            'kode_dudi' => 'required|string',
            'nama_dudi' => 'required|string',
            'bidang_usaha' => 'required|string',
            'notelp_dudi' => 'required|string',
            'alamat_dudi' => 'required|string',
        ]);

        // Cek apakah kode Dudi sudah ada di database
        $existingDudi = Dudi::where('kode_dudi', $request->kode_dudi)->first();

        if ($existingDudi) {
            // Jika data sudah ada, kembalikan dengan error message
            return redirect()->back()->with('error', 'Data sudah ada, tidak bisa menambahkan data yang sama.');
        }

        // Simpan data ke database
        Dudi::create([
            'kode_dudi' => $request->kode_dudi,
            'nama_dudi' => $request->nama_dudi,
            'bidang_usaha' => $request->bidang_usaha,
            'notelp_dudi' => $request->notelp_dudi,
            'alamat_dudi' => $request->alamat_dudi,
            'password' => bcrypt('password-default'), // Password default
        ]);

        return redirect()->back()->with('success', 'Data Dudi berhasil ditambahkan.');
    }

    // Method untuk menyimpan perubahan data Dudi
    public function updateDudi(Request $request, $kode_dudi)
    {
        
        // Ambil data kelompok dan tahun untuk filter
        //$kelompok = Kelompok::all(); // Pastikan model Kelompok sudah ada
        //dd($kelompok); 

        $tahun = Siswa::select('tahun')->distinct()->pluck('tahun'); // Ambil tahun yang unik dari tabel siswa

        // Ambil data kelompok unik dari tabel ploting
        $kelompok = Ploting::select('kode_kelompok')->distinct()->pluck('kode_kelompok'); // Mengambil kode_kelompok unik dari ploting

        $konsentrasi_keahlian = Siswa::select('konsentrasi_keahlian')->distinct()->pluck('konsentrasi_keahlian'); // Ambil konsentrasi keahlian unik

        // Ambil data ploting sesuai filter jika ada
        $query = Ploting::with('siswa', 'pembimbing', 'dudi');

        //Filter tahun
        if ($request->filled('tahun') && $request->tahun != 'Tahun') {
            $query->whereHas('siswa', function ($q) use ($request) {
                $q->where('tahun', $request->tahun);
            });
        }

        //Filter Kelompok
        if ($request->filled('kelompok') && $request->kelompok != 'Kelompok') {
            $query->where('kode_kelompok', $request->kelompok); // Perbaiki untuk menggunakan kode_kelompok
        }  
        
        // Filter berdasarkan konsentrasi keahlian jika ada
        if ($request->filled('konsentrasi_keahlian') && $request->konsentrasi_keahlian != 'Konsentrasi Keahlian') {
            $query->whereHas('siswa', function ($q) use ($request) {
                $q->where('konsentrasi_keahlian', $request->konsentrasi_keahlian);
            });
        }

        $ploting = $query->get();

        return view('ploting_siswa', compact('ploting', 'kelompok', 'tahun', 'konsentrasi_keahlian'));
    }

    public function importPloting(Request $request)
    {
        // Validasi file yang diupload
        // Validasi input dari form
        $request->validate([
            'kode_dudi' => 'required|string',
            'nama_dudi' => 'required|string',
            'bidang_usaha' => 'required|string',
            'notelp_dudi' => 'required|string',
            'alamat_dudi' => 'required|string',
        ]);

        // Update data Dudi berdasarkan kode_dudi
        $dudi = Dudi::where('kode_dudi', $kode_dudi)->firstOrFail();
        $dudi->update([
            'kode_dudi' => $request->kode_dudi,
            'nama_dudi' => $request->nama_dudi,
            'bidang_usaha' => $request->bidang_usaha,
            'notelp_dudi' => $request->notelp_dudi,
            'alamat_dudi' => $request->alamat_dudi,
        ]);

        // Redirect kembali dengan pesan sukses
        return redirect()->route('data_mitradudi')->with('success', 'Data Dudi berhasil diperbarui.');
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
        $imported = false; // Flag untuk menandai apakah ada data yang diimport
        $duplicate = false; // Flag untuk menandai apakah ada data duplikat

        (new FastExcel)->import($file, function ($line) use (&$imported, &$duplicate) {
            // Cek apakah NIP_NIK sudah ada di database
            $existingPembimbing = Pembimbing::where('NIP_NIK', $line['NIP_NIK'])->first();
            
            if ($existingPembimbing) {
                $duplicate = true; // Tandai jika data duplikat ditemukan
            } else {
                // Menyimpan data baru ke dalam tabel pembimbing
                Pembimbing::create([
                    'NIP_NIK' => $line['NIP_NIK'],
                    'nama_pembimbing' => $line['Nama'],
                    'jabatan' => $line['Jabatan'],
                    'jenis_kelamin' => $line['Jenis Kelamin'],
                    'notelp_pembimbing' => $line['No Telp'],
                    'alamat' => $line['Alamat'],
                    'password' => bcrypt('password-default'), // Bisa diubah sesuai kebutuhan
                ]);
                $imported = true; // Tandai jika ada data yang berhasil diimport
            }
        });

        // Kondisi jika ada data duplikat dan tidak ada yang diimport
        if ($duplicate && !$imported) {
            return redirect()->back()->with('error', 'Data sudah ada, tidak bisa menambahkan data yang sama.');
        }

        // Kondisi jika ada data yang berhasil diimport
        if ($imported) {
            return redirect()->back()->with('success', 'Data guru pembimbing berhasil diimport.');
        }

        // Kondisi jika tidak ada data yang ditambahkan (semua data sudah ada)
        return redirect()->back()->with('error', 'Data sudah ditemukan (upload tidak bertambah).');
    }


    public function storePembimbing(Request $request)
    {
        // Validasi input
        $request->validate([
            'NIP_NIK' => 'required|string',
            'nama_pembimbing' => 'required|string',
            'jenis_kelamin' => 'required|string',
            'jabatan' => 'required|string',
            'alamat' => 'required|string',
            'no_telp' => 'required|string',
        ]);

        // Cek apakah NIP/NIK sudah ada di database
        $existingPembimbing = Pembimbing::where('NIP_NIK', $request->NIP_NIK)->first();

        if ($existingPembimbing) {
            // Jika data sudah ada, kembalikan dengan error message
            return redirect()->back()->with('error', 'Data sudah ada, tidak bisa menambahkan data yang sama.');
        }

        // Simpan data ke database
        Pembimbing::create([
            'NIP_NIK' => $request->NIP_NIK,
            'nama_pembimbing' => $request->nama_pembimbing,
            'jenis_kelamin' => $request->jenis_kelamin,
            'jabatan' => $request->jabatan,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
            'password' => bcrypt('password-default'), // Bisa diubah sesuai kebutuhan
        ]);

        return redirect()->back()->with('success', 'Data pembimbing berhasil ditambahkan.');
    }

    public function updatePembimbing(Request $request, $NIP_NIK)
    {
        // Validasi input
        $request->validate([
            'nama_pembimbing' => 'required|string',
            'jenis_kelamin' => 'required|string',
            'jabatan' => 'required|string',
            'no_telp' => 'required|string',
            'alamat' => 'required|string',
        ]);

        // Cari data pembimbing berdasarkan NIP/NIK
        $pembimbing = Pembimbing::where('NIP_NIK', $NIP_NIK)->first();

        // Update data pembimbing
        if ($pembimbing) {
            $pembimbing->update([
                'nama_pembimbing' => $request->input('nama_pembimbing'),
                'jenis_kelamin' => $request->input('jenis_kelamin'),
                'jabatan' => $request->input('jabatan'),
                'no_telp' => $request->input('no_telp'),
                'alamat' => $request->input('alamat'),
            ]);

            return redirect()->back()->with('success', 'Data pembimbing berhasil diperbarui.');
        }

        return redirect()->back()->with('error', 'Data pembimbing tidak ditemukan.');
    }


    public function plotingSiswa(Request $request)
    {
        
        // Ambil data kelompok dan tahun untuk filter
        //$kelompok = Kelompok::all(); // Pastikan model Kelompok sudah ada
        //dd($kelompok); 

        $tahun = Siswa::select('tahun')->distinct()->pluck('tahun'); // Ambil tahun yang unik dari tabel siswa

        // Ambil data kelompok unik dari tabel ploting
        $kelompok = Ploting::select('kode_kelompok')->distinct()->pluck('kode_kelompok'); // Mengambil kode_kelompok unik dari ploting

        // Ambil data ploting sesuai filter jika ada
        $query = Ploting::with('siswa', 'pembimbing', 'dudi');

        if ($request->filled('tahun') && $request->tahun != 'Tahun') {
            $query->whereHas('siswa', function ($q) use ($request) {
                $q->where('tahun', $request->tahun);
            });
        }

        if ($request->filled('kelompok') && $request->kelompok != 'Kelompok') {
            $query->where('kode_kelompok', $request->kelompok); // Perbaiki untuk menggunakan kode_kelompok
        }                     

        $ploting = $query->get();

        return view('ploting_siswa', compact('ploting', 'kelompok', 'tahun'));
    }

    public function importPloting(Request $request)
    {
        // Validasi file yang diupload
        $request->validate([
            'file' => 'required|mimes:xlsx'
        ]);

        // Proses import file Excel ke database
        $file = $request->file('file');
        $importedData = []; // Ganti uploadedData dengan importedData
        $duplicateData = []; // Menyimpan data yang duplikat

        (new FastExcel)->import($file, function ($line) use (&$importedData, &$duplicateData) {
            // Pastikan data tidak duplikat berdasarkan NIS atau identifier lain
            $ploting = Ploting::where('NIS', $line['NIS'])->first();

            if (!$ploting) {
                // Data tidak ada, tambahkan
                $importedData[] = Ploting::create([
                    'kode_kelompok' => $line['Kode Kelompok'], // Ganti dengan kolom yang sesuai
                    'NIS' => $line['NIS'], // Ganti dengan kolom yang sesuai
                    'nama_siswa' => $line['Nama'],
                    'kelas' => $line['Kelas'],
                    'nama_pembimbing' => $line['Pembimbing'],
                    'nama_dudi' => $line['Dudi'],
                    'alamat_dudi' => $line['Alamat Dudi'],
                ]);
            } else {
                // Jika data sudah ada, simpan dalam array duplicateData
                $duplicateData[] = $line['NIS'];
            }
        });

        // Mengembalikan respon berdasarkan hasil upload
        if (count($importedData) > 0 && count($duplicateData) > 0) {
            return redirect()->back()->with('success', 'Data berhasil ditambahkan, tetapi beberapa NIS sudah ada: ' . implode(', ', $duplicateData));
        } elseif (count($importedData) > 0) {
            return redirect()->back()->with('success', 'Data berhasil ditambahkan.');
        } else {
            return redirect()->back()->with('error', 'Data sudah ditemukan (upload tidak bertambah).');
        }
    }

    // Method untuk menampilkan halaman surat pengajuan
    public function suratPengajuan()
    {
        // Ambil semua data pengajuan beserta siswa yang terkait
        $pengajuan = Pengajuan::with('siswa')->get();

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

    
 

}

