@extends('layouts.headersiswa')

@section('content')
<br>
<br>

<div class="container table-wrapper">
    <div class="d-flex justify-content-start mb-3" style="margin-left: 20px;">
        <button onclick="window.location.href='{{ route('verifikasi_akhir_pkl') }}'" style="background-color: #0275d8; color: #ffffff; border: none; padding: 5px 10px; border-radius: 5px; margin-top: 10px;">
            <i class="bi bi-arrow-left"></i> Kembali
        </button>
    </div>
    <br>
    

    <div class="text-center mb-5">
        <h3 class="mb-4">Nilai PKL Siswa</h3>

        <br>
        <br>
        <div style="max-width: 70%; margin: auto;">
            <table class="table-striped custom-table">
                <thead class="table-primary text-center">
                    <tr>
                        <th>Aspek</th>
                        <th>Nilai</th>
                    </tr>
                </thead>
                <tbody id="data-table">
                    <tr>
                        <td>Laporan / Jurnal PKL</td>
                        <td>{{ $nilaiPkl->persentase_jurnal }}</td>
                    </tr>
                    <tr>
                        <td>Nilai PKL Dudi</td>
                        <td>{{ $nilaiPkl->nilai_akhir_dudi }}</td>
                    </tr>
                    <tr>
                        <td>Monitoring Pembimbing</td>
                        <td>{{ $nilaiPkl->monitoring_pembimbing }}</td>
                    </tr>
                    <tr>
                        <td>Laporan Pengimbasan</td>
                        <td>{{ $nilaiPkl->nilai_pengimbasan }}</td>
                    </tr>
                    <tr>
                        <td>Laporan Akhir PKL</td>
                        <td>{{ $nilaiPkl->nilai_akhir_pkl }}</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td>Total Nilai</td>
                        <td>{{ $totalNilai }}</td>
                    </tr>
                </tfoot>
            </table>
            <br>
            <br>
            <!-- Tombol Export PDF -->
            <a href="{{ route('exportNilaiPklPdf') }}" class="btn btn-danger mt-3" style="float: left;">
                <i class="bi bi-file-earmark-pdf"></i> Export PDF
            </a>
        </div>
    </div>
</div>

<br>
<br>
<br>
<br>
@endsection
