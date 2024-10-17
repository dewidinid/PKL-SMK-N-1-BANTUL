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
        
        {{-- <div class="mt-4">
            <p><strong>NIS :</strong> {{ $siswa->NIS }}</p>
            <p><strong>Nama :</strong> {{ $siswa->nama_siswa }}</p>
            <p><strong>Konsentrasi Keahlian :</strong> {{ $siswa->konsentrasi_keahlian }}</p>
            <p><strong>Kelas :</strong> {{ $siswa->kelas }}</p>
            <p><strong>DUDI :</strong> {{ $siswa->nama_dudi }}</p>
        </div> --}}

        <div >
            <p><strong>NIS :</strong> 17672</p>
            <p><strong>Nama :</strong> Rulli Arhan</p>
            <p><strong>konsentrasi_keahlian :</strong> Teknik Komputer Jaringan</p>
            <p><strong>Kelas :</strong> TKJ 1</p>
            <p><strong>DUDI :</strong> PT Telkom Indonesia</p>
        </div>
        <br>

            <!-- Batas Lebar Tabel -->
            <div style="max-width: 70%;">
                <table class="table-striped custom-table">
                    <thead class="table-primary text-center">
                        <tr>
                            <th>Evaluasi</th>
                            <th>Persentase</th>
                            <th>Nilai Akhir</th>
                        </tr>
                    </thead>
                    <tbody id="data-table">
                        <tr>
                            <td class="left-align" data-label="Evaluasi">Laporan / Jurnal PKL</td>
                            <td data-label="Persentase">10%</td>
                            {{-- <td data-label="Nilai Akhir">{{ $persentaseJurnal }}</td> --}}
                        </tr>
                        <tr>
                            <td class="left-align" data-label="Evaluasi">Nilai PKL Dudi</td>
                            <td data-label="Persentase">50%</td>
                            {{-- <td data-label="Nilai Akhir">{{ $nilaiAkhirDudi }}</td> --}}
                        </tr>
                        <tr>
                            <td class="left-align" data-label="Evaluasi">Monitoring Pembimbing</td>
                            <td data-label="Persentase">20%</td>
                            {{-- <td data-label="Nilai Akhir">{{ $nilaiMonitoring }}</td> --}}
                        </tr>
                        <tr>
                            <td class="left-align" data-label="Evaluasi">Laporan Pengimbasan</td>
                            <td data-label="Persentase">10%</td>
                            {{-- <td data-label="Nilai Akhir">{{ $nilaiPengimbasan }}</td> --}}
                        </tr>
                        <tr>
                            <td class="left-align" data-label="Evaluasi">Laporan Akhir PKL</td>
                            <td data-label="Persentase">10%</td>
                            {{-- <td data-label="Nilai Akhir">{{ $nilaiAkhirPKL }}</td> --}}
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2">Total Nilai</td>
                            {{-- <td>{{ $totalNilai }}</td> --}}
                        </tr>
                    </tfoot>
                </table>
                
            </div> <!-- End of max-width wrapper -->
        
        <br>

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
        <br>
    </div>
</div>

@endsection