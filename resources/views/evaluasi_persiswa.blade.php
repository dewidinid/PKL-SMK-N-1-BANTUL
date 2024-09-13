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
            <p><strong>Nama :</strong> {{ $student['name'] }}</p>
            <p><strong>NIS :</strong> {{ $student['nis'] }}</p>
            <p><strong>Jurusan :</strong> {{ $student['jurusan'] }}</p>
            <p><strong>Kelas :</strong> {{ $student['kelas'] }}</p>
            <p><strong>DUDI :</strong> {{ $student['dudi'] }}</p>
        </div> --}}

        <div >
            <p><strong>Nama :</strong> Rulli Arhan</p>
            <p><strong>NIS :</strong> 17672</p>
            <p><strong>Jurusan :</strong> Teknik Komputer Jaringan</p>
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
                            <td data-label="Nilai Akhir">90</td>
                        </tr>
                        <tr>
                            <td class="left-align" data-label="Evaluasi">Nilai PKL Dudi</td>
                            <td data-label="Persentase">50%</td>
                            <td data-label="Nilai Akhir">90</td>
                        </tr>
                        <tr>
                            <td class="left-align" data-label="Evaluasi">Monitoring Pembimbing</td>
                            <td data-label="Persentase">20%</td>
                            <td data-label="Nilai Akhir">90</td>
                        </tr>
                        <tr>
                            <td class="left-align" data-label="Evaluasi">Laporan Pengimbasan</td>
                            <td data-label="Persentase">10%</td>
                            <td data-label="Nilai Akhir">90</td>
                        </tr>
                        <tr>
                            <td class="left-align" data-label="Evaluasi">Laporan Akhir PKL</td>
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
        
        <br>



        {{-- <div class="total-nilai d-flex justify-content-between">
            <span>Total Nilai</span>
            <span>90</span> <!-- Ganti nilai 90 dengan nilai dinamis dari database -->
        </div> --}}

        <div class="mt-4 d-flex justify-content-left">
            <button class="btn btn-primary">Export Evaluasi PKL</button>
        </div>
        <br>
        <br>
    </div>
</div>

@endsection