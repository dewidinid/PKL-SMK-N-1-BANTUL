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
        // Hitung jumlah data
        $jumlahSiswa = Siswa::count();
        $jumlahPembimbing = Pembimbing::count();
        $jumlahDudi = Dudi::count();

        return view('home_admin', compact('jumlahSiswa', 'jumlahPembimbing', 'jumlahDudi'));
    }
    
    public function dataSiswa()
    {
        // Ambil semua siswa dengan relasi dan urutkan berdasarkan nama_siswa
        $siswa = Siswa::with('kelompok', 'dudi')->orderBy('nama_siswa', 'asc')->get();
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

        (new FastExcel)->import($file, function ($line) use (&$imported, &$duplicate) {
            $existingSiswa = Siswa::where('NIS', $line['NIS'])->first();

            if ($existingSiswa) {
                $duplicate = true;
            } else {
                Siswa::create([
                    'NIS' => $line['NIS'],
                    'nama_siswa' => $line['Nama'],
                    'konsentrasi_keahlian' => $line['Konsentrasi Keahlian'],
                    'kelas' => $line['Kelas'],
                    'tahun' => $line['Tahun']
                ]);
                $imported = true;
            }
        });

        return $duplicate && !$imported
            ? redirect()->back()->with('error', "Data sudah ditemukan. Upload tidak bertambah.")
            : redirect()->back()->with('success', 'Data siswa berhasil diimport.');
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
                'tahun' => $request->input('tahun')
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

        // Membangun query untuk mengambil data siswa dengan urutan nama_siswa
        $query = Siswa::query()->orderBy('nama_siswa', 'asc');

        // Menambahkan filter tahun jika dipilih
        if ($tahun) {
            $query->where('tahun', $tahun);
        }

        // Menambahkan filter konsentrasi keahlian jika dipilih
        if ($konsentrasiKeahlian) {
            $query->where('konsentrasi_keahlian', $konsentrasiKeahlian);
        }

        // Menjalankan query dan mengambil data siswa
        $siswa = $query->with('kelompok', 'dudi')->get();

        // Mengembalikan view dengan data siswa yang telah difilter
        return view('data_siswa', ['siswa' => $siswa]);
    }


    public function dataMitraDudi()
    {
        $dudi = Dudi::all();
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

        (new FastExcel)->import($file, function ($line) use (&$importedData, &$duplicates) {
            $dudi = Dudi::where('kode_dudi', $line['Kode Dudi'])->first();

            if (!$dudi) {
                $importedData[] = Dudi::create([
                    'kode_dudi' => $line['Kode Dudi'],
                    'nama_dudi' => $line['Nama Dudi'],
                    'bidang_usaha' => $line['Bidang Usaha'],
                    'notelp_dudi' => $line['No Telp'],
                    'alamat_dudi' => $line['Alamat Dudi'],
                    'password' => bcrypt('password-default')
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
            'password' => bcrypt('password-default')
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
            'alamat_dudi' => $request->alamat_dudi
        ]);

        return redirect()->route('data_mitradudi')->with('success', 'Data Dudi berhasil diperbarui.');
    }

    public function guruPembimbing()
    {
        $pembimbing = Pembimbing::all();
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

        (new FastExcel)->import($file, function ($line) use (&$imported, &$duplicate) {
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
                    'password' => bcrypt('password-default')
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
            ]);

            return redirect()->back()->with('success', 'Data pembimbing berhasil diperbarui.');
        }

        return redirect()->back()->with('error', 'Data pembimbing tidak ditemukan.');
    }


    public function plotingSiswa(Request $request)
    {
        $tahun = Siswa::select('tahun')->distinct()->pluck('tahun');
        $kelompok = Ploting::select('kode_kelompok')->distinct()->pluck('kode_kelompok');

        $query = Ploting::with('siswa', 'pembimbing', 'dudi');

        if ($request->filled('tahun') && $request->tahun != 'Tahun') {
            $query->whereHas('siswa', function ($q) use ($request) {
                $q->where('tahun', $request->tahun);
            });
        }

        if ($request->filled('kelompok') && $request->kelompok != 'Kelompok') {
            $query->where('kode_kelompok', $request->kelompok);
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

        (new FastExcel)->import($file, function ($line) use (&$importedData, &$duplicateData) {
            $ploting = Ploting::where('NIS', $line['NIS'])->first();

            if (!$ploting) {
                $importedData[] = Ploting::create([
                    'kode_kelompok' => $line['Kode Kelompok'],
                    'NIS' => $line['NIS'],
                    'nama_siswa' => $line['Nama'],
                    'kelas' => $line['Kelas'],
                    'nama_pembimbing' => $line['Pembimbing'],
                    'nama_dudi' => $line['Dudi'],
                    'alamat_dudi' => $line['Alamat Dudi']
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
        $pengajuans = Pengajuan::with(['siswa', 'dudi'])
            ->where('status_acc', 0)
            ->get();

        $pembimbings = Pembimbing::all();
        $dudi = Dudi::all();

        foreach ($pengajuans as $pengajuan) {
            $pengajuan->kode_kelompok = $this->generateKodeKelompok($pengajuan->siswa->first()->konsentrasi_keahlian);
        }

        return view('suratpengajuanmandiri', compact('pengajuans', 'pembimbings', 'dudi'));
    }
    


    
    public function approvePengajuan(Request $request)
    {
        $selectedIds = $request->input('check', []);

        if (empty($selectedIds)) {
            return redirect()->back()->with('error', 'Pilih setidaknya satu pengajuan untuk disetujui.');
        }

        foreach ($selectedIds as $id) {
            $pengajuan = Pengajuan::with('siswa', 'dudi')->find($id);
        
            if ($pengajuan && $pengajuan->siswa) {
                $pembimbingNIP = $request->input("pembimbing_{$id}");
                $kodeKelompok = $request->input("kode_kelompok_{$id}");
        
                // Dapatkan nama pembimbing berdasarkan NIP yang dipilih
                $pembimbing = Pembimbing::where('NIP_NIK', $pembimbingNIP)->first();
        
                foreach ($pengajuan->siswa as $siswa) {
                    Ploting::create([
                        'kode_kelompok' => $kodeKelompok,
                        'NIP_NIK' => $pembimbingNIP, // Simpan NIP pembimbing
                        'nama_pembimbing' => $pembimbing->nama_pembimbing,
                        'NIS' => $siswa->NIS,
                        'nama_siswa' => $siswa->nama_siswa,
                        'kelas' => $siswa->kelas,
                        'konsentrasi_keahlian' => $siswa->konsentrasi_keahlian, 
                        'kode_dudi' => $pengajuan->dudi->kode_dudi ?? null,
                        'nama_dudi' => $pengajuan->dudi->nama_dudi ?? 'DUDI tidak tersedia',
                        'alamat_dudi' => $pengajuan->dudi->alamat_dudi ?? 'Alamat DUDI tidak tersedia',
                        'notelp_dudi' => $pengajuan->dudi->notelp_dudi ?? null,
                    ]);
        
                    $pengajuan->update([
                        'status_acc' => 1
                    ]);
                }
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
        $singkatan = $this->getSingkatan($konsentrasi_keahlian);

        $lastGroup = DB::table('ploting')
            ->where('kode_kelompok', 'LIKE', $singkatan . '%')
            ->orderBy('kode_kelompok', 'desc')
            ->first();

        $newIndex = $lastGroup ? ((int) filter_var($lastGroup->kode_kelompok, FILTER_SANITIZE_NUMBER_INT)) + 1 : 1;

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
//                     'nama_dudi' => $pengajuan->nama_dudi,
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

