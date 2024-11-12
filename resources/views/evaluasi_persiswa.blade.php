@extends('layouts.headerpembimbing')

@section('content')

<div class="container mt-5 table-wrapper">

    <div class="" style="background-color: #ffffff; border-radius: 10px; padding: 30px;">
        <div class="d-flex justify-content-start mb-3">
            <button onclick="window.history.back()" style="background-color: #439AC7; color: #ffffff; border: none; padding: 5px 10px; border-radius: 5px;">
                <i class="bi bi-arrow-left"></i> Kembali
            </button>
        </div>

        <h2 class="text-center">Evaluasi Per Siswa</h2>
        <br>

        <table class="student-info">
            <tr>
                <td><strong>NIS</strong></td>
                <td><strong>:</strong></td>
                <td>{{ $siswa->NIS }}</td>
            </tr>
            <tr>
                <td><strong>Nama</strong></td>
                <td><strong>:</strong></td>
                <td>{{ $siswa->nama_siswa }}</td>
            </tr>
            <tr>
                <td><strong>Konsentrasi Keahlian</strong></td>
                <td><strong>:</strong></td>
                <td>{{ $siswa->konsentrasi_keahlian }}</td>
            </tr>
            <tr>
                <td><strong>Kelas</strong></td>
                <td><strong>:</strong></td>
                <td>{{ $siswa->kelas }}</td>
            </tr>
            <tr>
                <td><strong>Kelompok</strong></td>
                <td><strong>:</strong></td>
                <td>{{ $siswa->kode_kelompok }}</td>
            </tr>
            <tr>
                <td><strong>Dudi</strong></td>
                <td><strong>:</strong></td>
                <td>{{ $siswa->nama_dudi }}</td>
            </tr>
        </table>

        <br>

        <br>

        <div class="container" style=" margin-left: 0;">
            <div class="row">
                <!-- Left Column: Table -->
                <div class="col-md-8" >
                    <table class="table-striped custom-table">
                        <thead class="table-primary text-center">
                            <tr>
                                <th>Evaluasi</th>
                                <th>Persentase</th>
                                <th>Nilai</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Laporan / Jurnal PKL</td>
                                <td>10%</td>
                                <td class="{{ $nilaiJurnalFull >= 100 ? 'text-success' : ($nilaiJurnalFull > 0 ? 'text-warning' : 'text-danger') }}">
                                    {{ number_format($nilaiJurnalFull, 2) }}
                                </td>
                            </tr>
                            <tr>
                                <td>Nilai PKL Dudi</td>
                                <td>50%</td>
                                <td class="{{ $nilaiDudiFull > 0 ? 'text-success' : 'text-danger' }}">
                                    {{ number_format($nilaiDudiFull, 2) }}
                                </td>
                            </tr>
                            <tr>
                                <td>Monitoring Pembimbing</td>
                                <td>20%</td>
                                <td class=" {{ $statusMonitoringColor }}">{{ number_format($nilaiMonitoringFull, 2) }}</td>
                            </tr>
                            <tr>
                                <td>Laporan Pengimbasan</td>
                                <td>10%</td>
                                <td class="{{ $nilaiPengimbasanFull ? 'text-success' : 'text-danger' }}">
                                    {{ number_format($nilaiPengimbasanFull, 2) }}
                                </td>
                            </tr>
                            <tr>
                                <td>Laporan Akhir PKL</td>
                                <td>10%</td>
                                <td class="{{ $nilaiAkhirPKLFull ? 'text-success' : 'text-danger' }}">
                                    {{ number_format($nilaiAkhirPKLFull, 2) }}
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2">Nilai Akhir</td>
                                <td>{{ number_format($totalNilai, 2) }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <!-- Right Column: Info Status -->
                <div class="col-md-4">
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
        </div> 
        
        <br><br>

        <div>
            <a href="{{ route('exportEvaluasiPersiswaExcel', ['nis' => $siswa->NIS]) }}" class="btn btn-success">
                <i class="bi bi-file-earmark-excel"></i> Export Excel
            </a>
            
            <a href="{{ route('exportEvaluasiPersiswaPDF', ['nis' => $siswa->NIS]) }}" class="btn btn-danger">
                <i class="bi bi-file-earmark-pdf"></i> Export PDF
            </a>
        </div>
        <br>
    </div>
</div>

@endsection