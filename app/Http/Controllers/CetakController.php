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
use App\Models\LaporanJurnal;
use App\Models\LaporanAkhir;
use App\Models\LaporanPengimbasan;
use App\Models\MonitoringPerSiswa;


class CetakController extends Controller
{
    public function exportMonitoringPerSiswaExcel($nis)
    {
        // Ambil data siswa dan monitoring per siswa berdasarkan NIS
        $siswa = Siswa::where('NIS', $nis)->firstOrFail();
        $monitoringPerSiswa = MonitoringPerSiswa::where('NIS', $nis)->get();

        // Hitung nilai akhir monitoring sebagai rata-rata dari nilai_monitoring
        $totalNilaiMonitoring = $monitoringPerSiswa->sum('nilai_monitoring');
        $jumlahBulan = $monitoringPerSiswa->count();
        $nilaiAkhirMonitoring = $jumlahBulan > 0 ? $totalNilaiMonitoring / $jumlahBulan : 0;

        // Siapkan data untuk header Excel
        $header = [
            ['Laporan Monitoring Per Siswa SMK Bantul'],
            ['NIS: ' . $siswa->NIS],
            ['Nama: ' . $siswa->nama_siswa],
            ['Kelas: ' . $siswa->kelas],
            ['Konsentrasi Keahlian: ' . $siswa->konsentrasi_keahlian],
            ['Nama Dudi: ' . $siswa->nama_dudi],
            ['Nilai Akhir Monitoring: ' . number_format($nilaiAkhirMonitoring, 2)],
            [],
            ['Bulan', 'TP1 (Soft Skills)', 'TP2 (Norma & POS)', 'TP3 (Kompetensi Teknis)', 'TP4 (Wawasan Wirausaha)', 'Nilai']
        ];

        // Siapkan data monitoring untuk diisi dalam file Excel
        $data = $monitoringPerSiswa->map(function ($item, $index) {
            return [
                'Bulan' => $index + 1,
                'TP1 (Soft Skills)' => $item->nilai_tp1,
                'TP2 (Norma & POS)' => $item->nilai_tp2,
                'TP3 (Kompetensi Teknis)' => $item->nilai_tp3,
                'TP4 (Wawasan Wirausaha)' => $item->nilai_tp4,
                'Nilai' => $item->nilai_monitoring,
            ];
        })->toArray();

        // Gabungkan header dan data untuk export
        $dataForExport = array_merge($header, $data);

        // Nama file Excel
        $fileName = 'Monitoring_Per_Siswa_' . $siswa->nama_siswa . '_' . $nis . '.xlsx';

        // Export ke Excel
        return (new FastExcel($dataForExport))->download($fileName);
    }

    public function exportMonitoringPerSiswaPDF($nis)
    {
        // Ambil data siswa dan monitoring per siswa berdasarkan NIS
        $siswa = Siswa::where('NIS', $nis)->firstOrFail();
        $monitoringPerSiswa = MonitoringPerSiswa::where('NIS', $nis)->get();

        // Siapkan data untuk view PDF
        $data = [
            'siswa' => $siswa,
            'monitoringPerSiswa' => $monitoringPerSiswa,
        ];

        // Generate PDF dari view yang sesuai
        $pdf = Pdf::loadView('export_monitoring_pdf', $data);

        // Nama file PDF
        $fileName = 'Monitoring_Per_Siswa_' . $siswa->nama_siswa . '_' . $nis . '.pdf';

        // Export ke PDF
        return $pdf->download($fileName);
    }

    public function exportEvaluasiPersiswaExcel($nis)
    {
        // Ambil data siswa dan evaluasi terkait berdasarkan NIS
        $siswa = Siswa::where('NIS', $nis)->firstOrFail();
        $evaluasi = Evaluasi::where('NIS', $nis)->get();

        // Siapkan data untuk header Excel
        $header = [
            ['Laporan Evaluasi PKL Siswa SMK Bantul'],
            ['NIS: ' . $siswa->NIS],
            ['Nama: ' . $siswa->nama_siswa],
            ['Kelas: ' . $siswa->kelas],
            ['Konsentrasi Keahlian: ' . $siswa->konsentrasi_keahlian],
            ['Nama Dudi: ' . $siswa->nama_dudi],
            [],
            ['Evaluasi', 'Persentase', 'Nilai Akhir']
        ];

        // Siapkan data evaluasi untuk diisi dalam file Excel
        $data = $evaluasi->map(function ($item) {
            return [
                'Evaluasi' => $item->evaluasi,
                'Persentase' => $item->persentase . '%',
                'Nilai Akhir' => $item->nilai_akhir,
            ];
        })->toArray();

        // Gabungkan header dan data untuk export
        $dataForExport = array_merge($header, $data);

        // Nama file Excel
        $fileName = 'Evaluasi_PKL_' . $siswa->nama_siswa . '_' . $nis . '.xlsx';

        // Export ke Excel
        return (new FastExcel($dataForExport))->download($fileName);
    }

    public function exportEvaluasiPersiswaPDF($nis)
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

        $nis = $siswa->NIS;

        // Ambil data yang sama seperti di SiswaController
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

        $pengimbasanUploaded = LaporanPengimbasan::where('NIS', $nis)->exists();
        $nilaiPengimbasan = $pengimbasanUploaded ? 10 : 0;
        $nilaiPengimbasanFull = $pengimbasanUploaded ? 100 : 0;

        $laporanAkhirUploaded = LaporanAkhir::where('NIS', $nis)->exists();
        $nilaiAkhirPKL = $laporanAkhirUploaded ? 10 : 0;
        $nilaiAkhirPKLFull = $laporanAkhirUploaded ? 100 : 0;

        // Hitung total nilai
        $totalNilai = $persentaseJurnal + $nilaiAkhirDudi + $nilaiMonitoring + $nilaiPengimbasan + $nilaiAkhirPKL;

        // Siapkan data untuk PDF
        $nilaiPkl = (object) [
            'persentase_jurnal' => $nilaiJurnalFull,
            'nilai_akhir_dudi' => $nilaiDudiFull,
            'monitoring_pembimbing' => $nilaiMonitoringFull,
            'nilai_pengimbasan' => $nilaiPengimbasanFull,
            'nilai_akhir_pkl' => $nilaiAkhirPKLFull
        ];

        // Load view dengan data siswa dan nilai PKL
        $pdf = Pdf::loadView('export_nilai_pkl_pdf', compact('siswa', 'nilaiPkl', 'totalNilai'));

        // Return PDF untuk diunduh
        return $pdf->download('nilai_pkl_' . $siswa->NIS . '.pdf');
    }



}
