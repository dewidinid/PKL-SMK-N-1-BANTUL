<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Rap2hpoutre\FastExcel\FastExcel;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Siswa;
use App\Models\Monitoring;
use App\Models\Evaluasi;

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
}
