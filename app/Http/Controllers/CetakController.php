<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Rap2hpoutre\FastExcel\FastExcel;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Siswa;
use App\Models\Monitoring;
use App\Models\Evaluasi;
use App\Models\NilaiPkl;

class CetakController extends Controller
{
    public function exportMonitoringExcel($nis)
    {
        // Fetch the student and monitoring data
        $siswa = Siswa::where('NIS', $nis)->firstOrFail();
        $monitoring = Monitoring::where('NIS', $nis)->get();
        
        // Calculate total and average scores
        $totalNilai = $monitoring->sum('nilai');
        $rataRata = $monitoring->avg('nilai');

        // Prepare the data for Excel export
        $data = $monitoring->map(function ($item) {
            return [
                'Bulan' => $item->bulan,
                'Monitoring' => $item->monitoring,
                'Nilai' => $item->nilai,
            ];
        });

        // Define the file name
        $fileName = 'Monitoring_' . $siswa->nama_siswa . '_' . $nis . '.xlsx';

        // Export to Excel
        return (new FastExcel($data))->download($fileName);
    }

    public function exportMonitoringPDF($nis)
    {
        // Fetch the student and monitoring data
        $siswa = Siswa::where('NIS', $nis)->firstOrFail();
        $monitoring = Monitoring::where('NIS', $nis)->get();

        // Calculate total and average scores
        $totalNilai = $monitoring->sum('nilai');
        $rataRata = $monitoring->avg('nilai');

        // Prepare data for PDF view
        $data = [
            'siswa' => $siswa,
            'monitoring' => $monitoring,
            'totalNilai' => $totalNilai,
            'rataRata' => $rataRata,
        ];

        // Generate PDF from the view
        $pdf = Pdf::loadView('export_monitoring_pdf', $data);

        // Define the file name
        $fileName = 'Monitoring_' . $siswa->nama_siswa . '_' . $nis . '.pdf';

        // Return the PDF download
        return $pdf->download($fileName);
    }

    public function exportEvaluasiExcel($nis)
    {
        // Ambil data siswa dan evaluasi terkait berdasarkan NIS
        $siswa = Siswa::where('NIS', $nis)->firstOrFail();
        $evaluasi = Evaluasi::where('NIS', $nis)->get();
        
        // Siapkan data untuk diekspor ke Excel
        $data = $evaluasi->map(function ($item) {
            return [
                'Evaluasi' => $item->evaluasi,
                'Persentase' => $item->persentase . '%',
                'Nilai Akhir' => $item->nilai_akhir,
            ];
        });

        // Tentukan nama file
        $fileName = 'Evaluasi_PKL_' . $siswa->nama_siswa . '_' . $nis . '.xlsx';

        // Ekspor data ke file Excel
        return (new FastExcel($data))->download($fileName);
    }

    public function exportEvaluasiPDF($nis)
    {
        // Ambil data siswa dan evaluasi terkait berdasarkan NIS
        $siswa = Siswa::where('NIS', $nis)->firstOrFail();
        $evaluasi = Evaluasi::where('NIS', $nis)->get();

        // Siapkan data untuk tampilan PDF
        $data = [
            'siswa' => $siswa,
            'evaluasi' => $evaluasi
        ];

        // Generate PDF dari view 'export_evaluasi_pdf'
        $pdf = Pdf::loadView('export_evaluasi_pdf', $data);

        // Tentukan nama file
        $fileName = 'Evaluasi_PKL_' . $siswa->nama_siswa . '_' . $nis . '.pdf';

        // Return file PDF untuk diunduh
        return $pdf->download($fileName);
    }

    public function exportDetailNilaiExcel()
    {
        // Ambil semua data nilai PKL dengan relasi siswa
        $detailNilai = NilaiPkl::with('siswa')->get();

        // Ambil informasi Dudi yang sedang login dan tahun angkatan
        $dudi = Auth::guard('dudi')->user();
        $namaDudi = $dudi->nama_dudi;
        $tahunAngkatan = $detailNilai->first()->siswa->tahun ?? 'N/A';

        // Siapkan data untuk export Excel
        $data = $detailNilai->map(function ($item) {
            return [
                'No' => $item->siswa->NIS,
                'NIS' => $item->siswa->NIS,
                'Nama' => $item->siswa->nama_siswa,
                'Kelas' => $item->siswa->kelas,
                'Konsentrasi Keahlian' => $item->siswa->konsentrasi_keahlian,
                'TP1 (Soft Skills)' => $item->tp1_soft_skills,
                'TP2 (Norma & POS)' => $item->tp2_norma_pos,
                'TP3 (Kompetensi Teknis)' => $item->tp3_kompetensi_teknis,
                'TP4 (Wawasan Wirausaha)' => $item->tp4_wawasan_wirausaha,
                'Total Nilai' => $item->nilai,
            ];
        })->toArray();

        // Siapkan header untuk file Excel
        $header = [
            ['Laporan Nilai PKL Siswa SMK Bantul'],
            ['Nama Dudi: ' . $namaDudi],
            ['Tahun Angkatan: ' . $tahunAngkatan],
            [],
            ['No', 'NIS', 'Nama', 'Kelas', 'Konsentrasi Keahlian', 'TP1 (Soft Skills)', 'TP2 (Norma & POS)', 'TP3 (Kompetensi Teknis)', 'TP4 (Wawasan Wirausaha)', 'Total Nilai']
        ];

        // Gabungkan header dan data
        $dataForExport = array_merge($header, $data);

        // Nama file untuk export
        $fileName = 'Detail_Nilai_' . date('Y-m-d') . '.xlsx';

        // Export to Excel
        return (new FastExcel($dataForExport))->download($fileName);
    }

    public function exportDetailNilaiPDF()
    {
        // Fetch data
        $detailNilai = NilaiPkl::with('siswa')->get();

        // Ambil informasi Dudi yang sedang login dan tahun angkatan
        $dudi = Auth::guard('dudi')->user();
        $namaDudi = $dudi->nama_dudi;
        $tahunAngkatan = $detailNilai->first()->siswa->tahun ?? 'N/A';

        // Prepare data for PDF view
        $data = [
            'detailNilai' => $detailNilai,
            'namaDudi' => $namaDudi,
            'tahunAngkatan' => $tahunAngkatan,
        ];

        // Generate PDF from the view
        $pdf = Pdf::loadView('export_detail_nilai_pdf', $data);

        // Define the file name
        $fileName = 'Detail_Nilai_' . date('Y-m-d') . '.pdf';

        // Return the PDF download
        return $pdf->download($fileName);
    }


    public function exportNilaiPklPdf()
    {
        // Ambil data siswa dari sesi yang sedang login
        $siswa = Auth::guard('siswa')->user();

        // Periksa apakah data siswa tersedia
        if (!$siswa) {
            return redirect()->back()->with('error', 'Data siswa tidak ditemukan.');
        }

        // Ambil data evaluasi dari tabel 'nilai_pkl' berdasarkan NIS
        $nilaiPkl = DB::table('nilai_pkl')->where('NIS', $siswa->NIS)->first();

        if (!$nilaiPkl) {
            $nilaiPkl = (object) [
                'persentase_jurnal' => 0,
                'nilai_akhir_dudi' => 0,
                'monitoring_pembimbing' => 0,
                'nilai_pengimbasan' => 0,
                'nilai_akhir_pkl' => 0
            ];
        }

        // Periksa jika data evaluasi ada, dan hitung total nilai
        $totalNilai = $nilaiPkl
        ? $nilaiPkl->persentase_jurnal + $nilaiPkl->nilai_akhir_dudi +
        $nilaiPkl->monitoring_pembimbing + $nilaiPkl->nilai_pengimbasan +
        $nilaiPkl->nilai_akhir_pkl
        : 0;

        // Load view dengan data siswa dan nilai PKL
        $pdf = Pdf::loadView('export_nilai_pkl_pdf', compact('siswa', 'nilaiPkl', 'totalNilai'));

        // Return PDF untuk diunduh
        return $pdf->download('nilai_pkl_' . $siswa->NIS . '.pdf');
    }


}
