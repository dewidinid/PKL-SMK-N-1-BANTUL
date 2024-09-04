@extends('layouts.headerpembimbing')

@section('content')

<div class="container mt-5">
    <h2 class="text-center">Evaluasi Per Siswa</h2>

    {{-- <div class="mt-4">
        <p><strong>Nama :</strong> {{ $student['name'] }}</p>
        <p><strong>NIS :</strong> {{ $student['nis'] }}</p>
        <p><strong>Jurusan :</strong> {{ $student['jurusan'] }}</p>
        <p><strong>Kelas :</strong> {{ $student['kelas'] }}</p>
        <p><strong>DUDI :</strong> {{ $student['dudi'] }}</p>
    </div> --}}

    <div class="container mt-4">
        <p><strong>Nama :</strong> Rulli Arhan</p>
        <p><strong>NIS :</strong> 17672</p>
        <p><strong>Jurusan :</strong> Teknik Komputer Jaringan</p>
        <p><strong>Kelas :</strong> TKJ 1</p>
        <p><strong>DUDI :</strong> PT Telkom Indonesia</p>
    </div>

    <div class="container mt-5">
        <!-- Batas Lebar Tabel -->
        <div style="max-width: 50%;">
    
            <table class="table">
                <thead>
                    <tr>
                        <th>Evaluasi</th>
                        <th>Persentase</th>
                        <th>Nilai Akhir</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td data-label="Evaluasi">Laporan / Jurnal PKL</td>
                        <td data-label="Persentase">10%</td>
                        <td data-label="Nilai Akhir">90</td>
                    </tr>
                    <tr>
                        <td data-label="Evaluasi">Nilai PKL Dudi</td>
                        <td data-label="Persentase">50%</td>
                        <td data-label="Nilai Akhir">90</td>
                    </tr>
                    <tr>
                        <td data-label="Evaluasi">Monitoring Pembimbing</td>
                        <td data-label="Persentase">20%</td>
                        <td data-label="Nilai Akhir">90</td>
                    </tr>
                    <tr>
                        <td data-label="Evaluasi">Laporan Pengimbasan</td>
                        <td data-label="Persentase">10%</td>
                        <td data-label="Nilai Akhir">90</td>
                    </tr>
                    <tr>
                        <td data-label="Evaluasi">Laporan Akhir PKL</td>
                        <td data-label="Persentase">10%</td>
                        <td data-label="Nilai Akhir">90</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2">Total Nilai</td>
                        <td>90</td>
                    </tr>
                </tfoot>
            </table>
    
        </div> <!-- End of max-width wrapper -->
    </div>
    <br>



    {{-- <div class="total-nilai d-flex justify-content-between">
        <span>Total Nilai</span>
        <span>90</span> <!-- Ganti nilai 90 dengan nilai dinamis dari database -->
    </div> --}}

    <div class="mt-4 d-flex justify-content-center">
        <button class="btn btn-primary">Export Evaluasi PKL</button>
    </div>
</div>

<br>
<br>
<br>
@include('layouts.footer')
@endsection