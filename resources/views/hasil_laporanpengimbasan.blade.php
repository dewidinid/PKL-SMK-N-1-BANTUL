@extends('layouts.headerpembimbing')

@section('content')

<div class="container mt-5 table-wrapper">
        <h4 class="text-center">LAPORAN PENGIMBASAN</h4>
        <br>
        
    <!-- Filter Tahun dan Jurusan -->
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

    <br>

    <table class="table-striped custom-table">
        <thead class="table-primary text-center">
            <tr>
                <th>No</th>
                <th>Kelompok</th>
                <th>NIS</th>
                <th>Nama</th>
                <th>Kompetensi Keahlian</th>
                <th>Kelas</th>
                <th>Tahun</th>
                <th style="font-size: 15px">Laporan Pengimbasan</th>
            </tr>
        </thead>
        @foreach ($laporanPengimbasan as $index => $laporan)
                    <tr class="text-center">
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $laporan->kelompok->kode_kelompok ?? '-' }}</td>
                        <td>{{ $laporan->NIS }}</td>
                        <td>{{ $laporan->siswaByNama->nama_siswa ?? '-' }}</td>
                        <td>{{ $laporan->konsentrasiKeahlian->nama_konsentrasi ?? '-' }}</td>
                        <td>{{ $laporan->siswaByKelas->kelas ?? '-' }}</td>
                        <td>{{ $laporan->dudi->nama_dudi ?? '-' }}</td>
                        <td>
                            <a href="{{ asset('storage/laporan_pengimbasan/' . $laporan->laporan_pengimbasan) }}" target="_blank" class="btn btn-link">Lihat Laporan</a>
                        </td>
                    </tr>
                    @endforeach
                        
        </tbody> 
        <tbody id="data-table">
            <tr >
                <td >1</td>
                <td >K001</td>
                <td >16034</td>
                <td class="left-align">Rulli Ardha Ramadhan</td>
                <td >Teknik Komputer Jaringan</td>
                <td >TKJ 1</td>
                <td >2024/2025</td>
                <td>
                    <a href="{{ asset('storage/files/sample-file.pdf') }}" >
                        <button class="btn" style="background-color: #F99417; color: white; padding: 5px 5px; border-radius: 5px; text-decoration: none; display: inline-flex; align-items: center;">
                            Download
                            <i class="bi bi-download" style="font-size: 1rem; margin-left: 5px;"></i>
                        </button>
                    </a> 
                </td>
            </tr>
            <tr >
                <td >1</td>
                <td >K001</td>
                <td >16034</td>
                <td class="left-align">Rulli Ardha Ramadhan</td>
                <td >Teknik Komputer Jaringan</td>
                <td >TKJ 1</td>
                <td >2024/2025</td>
                <td>
                    <a href="{{ asset('storage/files/sample-file.pdf') }}" >
                        <button class="btn" style="background-color: #F99417; color: white; padding: 5px 5px; border-radius: 5px; text-decoration: none; display: inline-flex; align-items: center;">
                            Download
                            <i class="bi bi-download" style="font-size: 1rem; margin-left: 5px;"></i>
                        </button>
                    </a> 
                </td>
            </tr>
        </tbody>
    </table>

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


@endsection