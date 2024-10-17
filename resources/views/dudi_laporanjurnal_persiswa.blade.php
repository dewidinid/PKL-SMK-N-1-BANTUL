@extends('layouts.headerdudi')

@section('content')

<div class="container mt-5 table-wrapper">

    <div class="" style="background-color: #ffffff; border-radius: 10px; padding: 30px;">
        <div class="d-flex justify-content-start mb-3">
            <button onclick="window.history.back()" style="background-color: #0275d8; color: #ffffff; border: none; padding: 5px 10px; border-radius: 5px;">
                <i class="bi bi-arrow-left"></i> Kembali
            </button>
        </div>

        <h2 class="text-center">Laporan/Jurnal Per Siswa</h2>
        <br>
        
        {{-- <div class="mt-4">
            <p><strong>Nama :</strong> {{ $student['name'] }}</p>
            <p><strong>NIS :</strong> {{ $student['nis'] }}</p>
            <p><strong>konsentrasi_keahlian :</strong> {{ $student['konsentrasi_keahlian'] }}</p>
            <p><strong>Kelas :</strong> {{ $student['kelas'] }}</p>
            <p><strong>DUDI :</strong> {{ $student['dudi'] }}</p>
        </div> --}}

        <div >
            <p><strong>Nama :</strong> Rulli Arhan</p>
            <p><strong>NIS :</strong> 17672</p>
            <p><strong>Konsentrasi Keahlian :</strong> Teknik Komputer Jaringan</p>
            <p><strong>Kelas :</strong> TKJ 1</p>
            <p><strong>DUDI :</strong> PT Telkom Indonesia</p>
        </div>
        <br>

            <!-- Batas Lebar Tabel -->
            <div style="">
        
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div >
                        <select class="form-select d-inline-block w-auto" name="bulan">
                            <option selected>Bulan</option>
                        </select>
                        <select class="form-select d-inline-block w-auto" name="tahun">
                            <option selected>Tahun</option>
                        </select>
                    </div>
                </div>
        
                <table class="table-striped custom-table">
                    <thead class="table-primary text-center">
                        <tr class="text-center" >
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Kegiatan/Progress</th>
                            <th>Lokasi</th>
                        </tr>
                        <br>
                    </thead>
                    <tbody id="data-table">
                        <!-- Data contoh, akan diisi dengan JavaScript -->
                        <tr>
                            <td>1</td>
                            <td>16/03/24</td>
                            <td>Membuat Flowchart</td>
                            <td>Yogyakarta</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>16/03/24</td>
                            <td>Membuat Flowchart</td>
                            <td>Yogyakarta</td>
                        </tr>
                    </tbody>
                    {{-- <tbody>
                        @foreach ($jurnals as $index => $jurnal)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ \Carbon\Carbon::parse($jurnal->tanggal)->format('d/m/Y') }}</td>
                                <td>{{ $jurnal->kegiatan }}</td>
                                <td>{{ $jurnal->lokasi }}</td> lokasi menggunakan maps location
                            </tr>
                        @endforeach
                    </tbody> --}}
                </table>       
            </div> <!-- End of max-width wrapper -->
        
            <br>
            <br>
            <br>
        
            <div class="pagination-container" style="display: flex; justify-content: center; align-items: center;">
                <button class="pagination-btn" onclick="prevPage()" id="prev-btn" disabled>Sebelumnya</button>
                <div id="pagination-numbers" style="display: flex; gap: 10px; margin: 0 20px;">
                    <!-- Angka halaman akan diisi dengan JavaScript -->
                </div>
                <button class="pagination-btn" onclick="nextPage()" id="next-btn">Selanjutnya</button>
            </div>
            
    </div>
</div>

@endsection