@extends('layouts.headersiswa')

@section('content')
<br>
<br>

<div class="container table-wrapper">
    <div class="d-flex justify-content-start mb-3" style="margin-left: 20px;">
        <button onclick="window.location.href='{{ route('verifikasi_akhir_pkl') }}'" style="background-color: #439AC7; color: #ffffff; border: none; padding: 5px 10px; border-radius: 5px; margin-top: 10px;">
            <i class="bi bi-arrow-left"></i> Kembali
        </button>
    </div>
    <br>
    

    <div class="text-center mb-5">
        <h3 class="mb-4">Nilai PKL Siswa</h3>

        <br>
        <br>
        <div class="container" style="max-width: 80%; margin-left: 200px;">
            <div class="row">
                <!-- Left Column: Table -->
                <div class="col-md-9" >
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
                                <td class="{{ $nilaiPkl->persentase_jurnal >= 10 ? 'text-success' : ($nilaiPkl->persentase_jurnal > 0 ? 'text-warning' : 'text-danger') }}">
                                    {{ number_format($nilaiPkl->persentase_jurnal, 2) }}
                                </td>
                                
                            </tr>
                            <tr>
                                <td>Nilai PKL Dudi</td>
                                <td class="{{ $nilaiPkl->nilai_akhir_dudi  > 0 ? 'text-success' : 'text-danger' }}">
                                    {{ number_format($nilaiPkl->nilai_akhir_dudi, 2)  }}
                                </td>
                            </tr>
                            <tr>
                                <td>Monitoring Pembimbing</td>
                                <td class=" {{ $statusMonitoringColor }}">{{ number_format($nilaiPkl->monitoring_pembimbing, 2)  }}</td>
                            </tr>
                            <tr>
                                <td>Laporan Pengimbasan</td>
                                <td class="{{ $nilaiPkl->nilai_pengimbasan ? 'text-success' : 'text-danger' }}">
                                    {{ number_format($nilaiPkl->nilai_pengimbasan, 2) }}
                                </td>
                            </tr>
                            <tr>
                                <td>Laporan Akhir PKL</td>
                                <td class="{{ $nilaiPkl->nilai_akhir_pkl ? 'text-success' : 'text-danger' }}">
                                    {{ number_format($nilaiPkl->nilai_akhir_pkl, 2) }}
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td>Total Nilai</td>
                                <td>{{ number_format($totalNilai, 2) }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <!-- Right Column: Info Status -->
                <div class="col-md-3">
                    <div style=" margin-top: 20px; text-align: left">
                        <p style="margin-left: 15px"><strong>Info Status</strong></p>
                        <ul>
                            <li><span class="text-success">Hijau:</span> Sudah lengkap</li>
                            <li><span class="text-warning">Kuning:</span> Masih Proses</li>
                            <li><span class="text-danger">Merah:</span> Belum ada</li>
                        </ul>
                    </div>
                </div>
                
            </div>
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
