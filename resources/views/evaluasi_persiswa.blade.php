@extends('layouts.headerpembimbing')

@section('content')

<div class="container mt-5 table-wrapper">

    <div class="" style="background-color: #ffffff; border-radius: 10px; padding: 30px;">
        <div class="d-flex justify-content-start mb-3">
            <button onclick="window.history.back()" style="background-color: #0275d8; color: #ffffff; border: none; padding: 5px 10px; border-radius: 5px;">
                <i class="bi bi-arrow-left"></i> Kembali
            </button>
        </div>

        <h2 class="text-center">Evaluasi Per Siswa</h2>
        <br>

        <div>
            <p><strong>NIS :</strong> {{ $siswa->NIS }}</p>
            <p><strong>Nama :</strong> {{ $siswa->nama_siswa }}</p>
            <p><strong>Konsentrasi Keahlian :</strong> {{  $siswa->konsentrasi_keahlian }}</p>
            <p><strong>Kelas :</strong> {{ $siswa->kelas }}</p>
            <p><strong>DUDI :</strong> {{ $siswa->nama_dudi }}</p>
        </div>

        <br>

            <!-- Batas Lebar Tabel -->
            <div style="max-width: 70%;">
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
                            <td>{{ $persentaseJurnal }}</td>
                        </tr>
                        <tr>
                            <td>Nilai PKL Dudi</td>
                            <td>50%</td>
                            <td>{{ $nilaiAkhirDudi }}</td>
                        </tr>
                        <tr>
                            <td>Monitoring Pembimbing</td>
                            <td>20%</td>
                            <td>{{ $nilaiMonitoring }}</td>
                        </tr>
                        <tr>
                            <td>Laporan Pengimbasan</td>
                            <td>10%</td>
                            <td>{{ $nilaiPengimbasan }}</td>
                        </tr>
                        <tr>
                            <td>Laporan Akhir PKL</td>
                            <td>10%</td>
                            <td>{{ $nilaiAkhirPKL === 10 ? 100 : 0 }}</td>
                            {{-- <td>{{ $nilaiAkhirPKL }}</td> --}}
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2">Nilai Akhir</td>
                            <td>{{ $totalNilai }}</td>
                        </tr>
                    </tfoot>
                </table>
                
            </div> 
        
        <br><br>

        <div >
            <a href="" class="btn btn-success">
                {{-- {{ route('export_evaluasi_excel', ['nis' => $siswa->NIS]) }} --}}
                <i class="bi bi-file-earmark-excel"></i>Export Excel
            </a>
            
            <a href="" class="btn btn-danger">
                {{-- {{ route('export_evaluasi_pdf', ['nis' => $siswa->NIS]) }} --}}
                <i class="bi bi-file-earmark-pdf"></i> Export PDF
            </a>
            
        </div>
        <br>
    </div>
</div>

@endsection