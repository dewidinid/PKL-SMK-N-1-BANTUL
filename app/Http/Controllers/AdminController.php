<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $currentAdmin = Auth::user()->kode_admin;

        // Hitung jumlah data sesuai admin yang login
        $jumlahSiswa = Siswa::where('created_by', $currentAdmin)->count();
        $jumlahPembimbing = Pembimbing::where('created_by', $currentAdmin)->count();
        $jumlahDudi = Dudi::where('created_by', $currentAdmin)->count();

        // Kirim jumlah siswa ke view
        return view('home_admin', compact('jumlahSiswa', 'jumlahPembimbing', 'jumlahDudi'));
    }
    
    public function dataSiswa()
    {
        $currentAdmin = Auth::user()->kode_admin;

        // Ambil data siswa sesuai dengan created_by admin yang login
        $siswa = Siswa::with('kelompok', 'dudi')
                      ->where('created_by', $currentAdmin)
                      ->get();
        //dd($siswa);
        // Anda dapat mengirimkan data ke view jika diperlukan
        return view('data_siswa', ['siswa' => $siswa]);
    }

    public function importSiswa(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx'
        ]);

        $file = $request->file('file');
        $imported = false;
        $duplicate = false;
        $createdBy = Auth::user()->kode_admin; 

        (new FastExcel)->import($file, function ($line) use (&$imported, &$duplicate, $createdBy) {
            $existingSiswa = Siswa::where('NIS', $line['NIS'])->first();

            if ($existingSiswa) {
                $duplicate = true;
            } else {
                Siswa::create([
                    'NIS' => $line['NIS'],
                    'nama_siswa' => $line['Nama'],
                    'konsentrasi_keahlian' => $line['Konsentrasi Keahlian'],
                    'kelas' => $line['Kelas'],
                    'tahun' => $line['Tahun'],
                    'created_by' => $createdBy
                ]);
                $imported = true;
            }
        });

        return $duplicate && !$imported
            ? redirect()->back()->with('error', "Data sudah ditemukan. Upload tidak bertambah.")
            : redirect()->back()->with('success', 'Data siswa berhasil diimport.');
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
        $request->validate([
            'NIS' => 'required|string|max:255',
            'nama_siswa' => 'required|string|max:255',
            'konsentrasi_keahlian' => 'required|string|max:255',
            'kelas' => 'required|string|max:255',
            'tahun' => 'required|string|max:255',
        ]);

        $siswa = Siswa::where('NIS', $request->input('NIS'))->first();

        if ($siswa) {
            $siswa->update([
                'nama_siswa' => $request->input('nama_siswa'),
                'konsentrasi_keahlian' => $request->input('konsentrasi_keahlian'),
                'kelas' => $request->input('kelas'),
                'tahun' => $request->input('tahun'),
                'created_by' => Auth::user()->kode_admin
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
        $currentAdmin = Auth::user()->kode_admin;

        // Ambil data Dudi yang sesuai dengan admin yang login
        $dudi = Dudi::where('created_by', $currentAdmin)->get();

        // Mengirimkan data ke view
        return view('data_mitradudi', compact('dudi'));
    }

    public function importDudi(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx'
        ]);

        $file = $request->file('file');
        $importedData = [];
        $duplicates = [];
        $createdBy = Auth::user()->kode_admin;

        (new FastExcel)->import($file, function ($line) use (&$importedData, &$duplicates, $createdBy) {
            $dudi = Dudi::where('kode_dudi', $line['Kode Dudi'])->first();

            if (!$dudi) {
                $importedData[] = Dudi::create([
                    'kode_dudi' => $line['Kode Dudi'],
                    'nama_dudi' => $line['Nama Dudi'],
                    'bidang_usaha' => $line['Bidang Usaha'],
                    'notelp_dudi' => $line['No Telp'],
                    'alamat_dudi' => $line['Alamat Dudi'],
                    'password' => bcrypt('password-default'),
                    'created_by' => $createdBy
                ]);
            } else {
                $duplicates[] = $line['Kode Dudi'];
            }
        });

        return count($importedData) > 0
            ? redirect()->back()->with('success', 'Data mitra Dudi berhasil diimpor.')
            : redirect()->back()->with('error', 'Data sudah ditemukan (upload tidak bertambah).');
    }


    public function storeDudi(Request $request)
    {
        $request->validate([
            'kode_dudi' => 'required|string',
            'nama_dudi' => 'required|string',
            'bidang_usaha' => 'required|string',
            'notelp_dudi' => 'required|string',
            'alamat_dudi' => 'required|string',
        ]);

        $existingDudi = Dudi::where('kode_dudi', $request->kode_dudi)->first();

        if ($existingDudi) {
            return redirect()->back()->with('error', 'Data sudah ada, tidak bisa menambahkan data yang sama.');
        }

        Dudi::create([
            'kode_dudi' => $request->kode_dudi,
            'nama_dudi' => $request->nama_dudi,
            'bidang_usaha' => $request->bidang_usaha,
            'notelp_dudi' => $request->notelp_dudi,
            'alamat_dudi' => $request->alamat_dudi,
            'password' => bcrypt('password-default'),
            'created_by' => Auth::user()->kode_admin
        ]);

        return redirect()->back()->with('success', 'Data Dudi berhasil ditambahkan.');
    }

        public function updateDudi(Request $request, $kode_dudi)
    {
        $request->validate([
            'kode_dudi' => 'required|string',
            'nama_dudi' => 'required|string',
            'bidang_usaha' => 'required|string',
            'notelp_dudi' => 'required|string',
            'alamat_dudi' => 'required|string',
        ]);

        $dudi = Dudi::where('kode_dudi', $kode_dudi)->firstOrFail();
        $dudi->update([
            'kode_dudi' => $request->kode_dudi,
            'nama_dudi' => $request->nama_dudi,
            'bidang_usaha' => $request->bidang_usaha,
            'notelp_dudi' => $request->notelp_dudi,
            'alamat_dudi' => $request->alamat_dudi,
            'created_by' => Auth::user()->kode_admin
        ]);

        return redirect()->route('data_mitradudi')->with('success', 'Data Dudi berhasil diperbarui.');
    }

    public function guruPembimbing()
    {
        $currentAdmin = Auth::user()->kode_admin;

        // Mengirimkan data guru pembimbing ke view
        $pembimbing = Pembimbing::where('created_by', $currentAdmin)->get();

        return view('guru_pembimbing', compact('pembimbing'));
    }

    public function importPembimbing(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx'
        ]);

        $file = $request->file('file');
        $imported = false;
        $duplicate = false;
        $createdBy = Auth::user()->kode_admin;

        (new FastExcel)->import($file, function ($line) use (&$imported, &$duplicate, $createdBy) {
            $existingPembimbing = Pembimbing::where('NIP_NIK', $line['NIP_NIK'])->first();

            if ($existingPembimbing) {
                $duplicate = true;
            } else {
                Pembimbing::create([
                    'NIP_NIK' => $line['NIP_NIK'],
                    'nama_pembimbing' => $line['Nama'],
                    'jabatan' => $line['Jabatan'],
                    'jenis_kelamin' => $line['Jenis Kelamin'],
                    'notelp_pembimbing' => $line['No Telp'],
                    'alamat' => $line['Alamat'],
                    'password' => bcrypt('password-default'),
                    'created_by' => $createdBy
                ]);
                $imported = true;
            }
        });

        return $duplicate && !$imported
            ? redirect()->back()->with('error', 'Data sudah ada, tidak bisa menambahkan data yang sama.')
            : redirect()->back()->with('success', 'Data guru pembimbing berhasil diimport.');
    }


    public function storePembimbing(Request $request)
    {
        $request->validate([
            'NIP_NIK' => 'required|string',
            'nama_pembimbing' => 'required|string',
            'jenis_kelamin' => 'required|string',
            'jabatan' => 'required|string',
            'alamat' => 'required|string',
            'no_telp' => 'required|string',
        ]);

        $existingPembimbing = Pembimbing::where('NIP_NIK', $request->NIP_NIK)->first();

        if ($existingPembimbing) {
            return redirect()->back()->with('error', 'Data sudah ada, tidak bisa menambahkan data yang sama.');
        }

        Pembimbing::create([
            'NIP_NIK' => $request->NIP_NIK,
            'nama_pembimbing' => $request->nama_pembimbing,
            'jenis_kelamin' => $request->jenis_kelamin,
            'jabatan' => $request->jabatan,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
            'password' => bcrypt('password-default'),
            'created_by' => Auth::user()->kode_admin
        ]);

        return redirect()->back()->with('success', 'Data pembimbing berhasil ditambahkan.');
    }

    public function updatePembimbing(Request $request, $NIP_NIK)
    {
        $request->validate([
            'nama_pembimbing' => 'required|string',
            'jenis_kelamin' => 'required|string',
            'jabatan' => 'required|string',
            'no_telp' => 'required|string',
            'alamat' => 'required|string',
        ]);

        $pembimbing = Pembimbing::where('NIP_NIK', $NIP_NIK)->first();

        if ($pembimbing) {
            $pembimbing->update([
                'nama_pembimbing' => $request->input('nama_pembimbing'),
                'jenis_kelamin' => $request->input('jenis_kelamin'),
                'jabatan' => $request->input('jabatan'),
                'no_telp' => $request->input('no_telp'),
                'alamat' => $request->input('alamat'),
                'created_by' => Auth::user()->kode_admin
            ]);

            return redirect()->back()->with('success', 'Data pembimbing berhasil diperbarui.');
        }

        return redirect()->back()->with('error', 'Data pembimbing tidak ditemukan.');
    }


    public function plotingSiswa(Request $request)
    {
         $currentAdmin = Auth::user()->kode_admin;

        // Ambil data tahun dan kode kelompok untuk filter
        $tahun = Siswa::select('tahun')
                      ->where('created_by', $currentAdmin)
                      ->distinct()->pluck('tahun'); 

        $kelompok = Ploting::select('kode_kelompok')
                           ->where('created_by', $currentAdmin)
                           ->distinct()->pluck('kode_kelompok'); 

       // Ambil data ploting sesuai filter jika ada
       $query = Ploting::with('siswa', 'pembimbing', 'dudi')->where('created_by', $currentAdmin);

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
        $request->validate([
            'file' => 'required|mimes:xlsx'
        ]);

        $file = $request->file('file');
        $importedData = [];
        $duplicateData = [];
        $createdBy = Auth::user()->kode_admin;

        (new FastExcel)->import($file, function ($line) use (&$importedData, &$duplicateData, $createdBy) {
            $ploting = Ploting::where('NIS', $line['NIS'])->first();

            if (!$ploting) {
                $importedData[] = Ploting::create([
                    'kode_kelompok' => $line['Kode Kelompok'],
                    'NIS' => $line['NIS'],
                    'nama_siswa' => $line['Nama'],
                    'kelas' => $line['Kelas'],
                    'nama_pembimbing' => $line['Pembimbing'],
                    'nama_dudi' => $line['Dudi'],
                    'alamat_dudi' => $line['Alamat Dudi'],
                    'created_by' => $createdBy
                ]);
            } else {
                $duplicateData[] = $line['NIS'];
            }
        });

        return count($importedData) > 0
            ? redirect()->back()->with('success', 'Data berhasil ditambahkan.')
            : redirect()->back()->with('error', 'Data sudah ditemukan (upload tidak bertambah).');
    }

    // Method untuk menampilkan halaman surat pengajuan
        public function suratPengajuan()
    {
        $currentAdmin = Auth::user()->kode_admin;
        $admintiKeahlian = ['Teknik Komputer dan Jaringan (TKJ)', 'Rekayasa Perangkat Lunak (RPL)', 'Desain Komunikasi Visual (DKV)'];
    
        if ($currentAdmin === 'ADMINTI') {
            $pengajuans = Pengajuan::with(['siswa', 'dudi'])
                ->whereHas('siswa', function ($query) use ($admintiKeahlian) {
                    $query->whereIn('konsentrasi_keahlian', $admintiKeahlian);
                })
                ->where('status_acc', 0) // Tambahkan kondisi ini
                ->get();
        } else {
            $pengajuans = Pengajuan::with(['siswa', 'dudi'])
                ->whereHas('siswa', function ($query) use ($admintiKeahlian) {
                    $query->whereNotIn('konsentrasi_keahlian', $admintiKeahlian);
                })
                ->where('status_acc', 0) // Tambahkan kondisi ini
                ->get();
        }
    
        $pembimbings = Pembimbing::where('created_by', $currentAdmin)->get();
        $dudi = Dudi::all();
    
        foreach ($pengajuans as $pengajuan) {
            $pengajuan->kode_kelompok = $this->generateKodeKelompok($pengajuan->siswa->first()->konsentrasi_keahlian);
        }
    
        return view('suratpengajuanmandiri', compact('pengajuans', 'pembimbings', 'dudi'));
    }
    


    
    public function approvePengajuan(Request $request)
    {
        $selectedIds = $request->input('check', []);
        $currentAdmin = Auth::user()->kode_admin;
    
        // Validasi
        if (empty($selectedIds)) {
            return redirect()->back()->with('error', 'Pilih setidaknya satu pengajuan untuk disetujui.');
        }
    
        foreach ($selectedIds as $id) {
            $pembimbingNIP = $request->input("pembimbing_{$id}");
            if (empty($pembimbingNIP)) {
                return redirect()->back()->with('error', 'Pembimbing harus dipilih untuk setiap pengajuan.');
            }
        }
    
        // Proses persetujuan
        foreach ($selectedIds as $id) {
            $pengajuan = Pengajuan::with('siswa')->find($id);
    
            if ($pengajuan && $pengajuan->siswa->isNotEmpty()) {
                $pembimbingNIP = $request->input("pembimbing_{$id}");
                $kodeKelompok = $request->input("kode_kelompok_{$id}");
    
                // Buat ploting untuk setiap siswa dalam pengajuan
                foreach ($pengajuan->siswa as $siswa) {
                    Ploting::create([
                        'kode_kelompok' => $kodeKelompok,
                        'nama_pembimbing' => $pembimbingNIP,
                        'NIS' => $siswa->NIS,
                        'nama_siswa' => $siswa->nama_siswa,
                        'kelas' => $siswa->kelas,
                        'nama_dudi' => $pengajuan->tempat_pkl,
                        'alamat_dudi' => $pengajuan->alamat_dudi ?? 'Alamat belum tersedia',
                        'created_by' => $currentAdmin
                    ]);
                }
    
                // Update status pengajuan
                $pengajuan->update([
                    'status_acc' => 1,
                    'approved_by' => $currentAdmin
                ]);
            }
        }
    
        return redirect()->route('suratPengajuan')->with('success', 'Pengajuan PKL berhasil disetujui dan ditambahkan ke Ploting.');
    }


    private function getSingkatan($konsentrasi_keahlian)
{
    // Buat array map untuk konsentrasi keahlian dan singkatannya
    $map = [
        'Teknik Komputer dan Jaringan (TKJ)' => 'TKJ',
        'Rekayasa Perangkat Lunak (RPL)' => 'RPL',
        'Desain Komunikasi Visual (DKV)' => 'DKV'
    ];

    // Kembalikan singkatan yang sesuai atau konsentrasi keahlian asli jika tidak ada
    return $map[$konsentrasi_keahlian] ?? strtoupper($konsentrasi_keahlian);
}


private function generateKodeKelompok($konsentrasi_keahlian)
{
    // Ambil singkatan konsentrasi keahlian
    $singkatan = $this->getSingkatan($konsentrasi_keahlian);
    $currentAdmin = Auth::user()->kode_admin; // Dapatkan admin yang sedang login

    // Ambil kode kelompok terakhir untuk admin yang sedang login
    $lastGroup = DB::table('ploting')
        ->where('kode_kelompok', 'LIKE', $singkatan . '%')
        ->where('created_by', $currentAdmin) // Filter berdasarkan admin yang login
        ->orderBy('kode_kelompok', 'desc')
        ->first();

    // Tentukan index baru
    if ($lastGroup) {
        // Ambil angka terakhir dari kode kelompok
        $lastIndex = (int) filter_var($lastGroup->kode_kelompok, FILTER_SANITIZE_NUMBER_INT);
        $newIndex = $lastIndex + 1;
    } else {
        $newIndex = 1;
    }

    // Buat kode kelompok baru dengan format singkatan dan angka
    return $singkatan . $newIndex;
}

// public function approveSelected(Request $request)
// {
//     // Tangkap semua data dari form
//     $input = $request->all();

//     // Ambil ID pengajuan yang di-checklist
//     $selectedIds = $request->input('check', []);
//     $currentAdmin = Auth::user()->kode_admin;

//     // Validasi untuk memastikan setiap pembimbing telah dipilih
//     foreach ($selectedIds as $id) {
//         $pembimbingNIP = $request->input("pembimbing_{$id}");
//         if (empty($pembimbingNIP)) {
//             return redirect()->back()->with('error', 'Pembimbing harus dipilih untuk setiap pengajuan.');
//         }
//     }

//     // Jika validasi lolos, lanjutkan dengan proses persetujuan
//     foreach ($approvedIds as $id) {
//         $pengajuan = Pengajuan::with('siswa')->find($id);
    
//         if ($pengajuan && $pengajuan->siswa->isNotEmpty()) {
//             $pembimbingNIP = $request->input("pembimbing_{$id}");
    
//             // Iterasi melalui setiap siswa yang terkait dengan pengajuan ini
//             foreach ($pengajuan->siswa as $siswa) {
//                 Ploting::create([
//                     'kode_kelompok' => $pengajuan->kode_kelompok,
//                     'nama_pembimbing' => $pembimbingNIP,
//                     'NIS' => $siswa->NIS,
//                     'nama_dudi' => $pengajuan->tempat_pkl,
//                     'alamat_dudi' => $siswa->alamat_dudi ?? 'Alamat belum tersedia',
//                     'created_by' => $currentAdmin
//                 ]);
//             }
    
//             // Tandai pengajuan sebagai disetujui setelah semua siswa diproses
//             $pengajuan->update([
//                 'status_acc' => 1,
//                 'approved_by' => $currentAdmin
//             ]);
//         }
//     }
    

//     return redirect()->route('suratPengajuan')->with('success', 'Pengajuan PKL berhasil disetujui dan ditambahkan ke Ploting.');
// }


}

