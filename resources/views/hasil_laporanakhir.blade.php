@extends('layouts.headerpembimbing')

@section('content')

<div class="container mt-5">
    <h4 class="text-center">LAPORAN AKHIR PKL</h4>
    <br>
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

<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Kelompok</th>
            <th>NIS</th>
            <th>Nama</th>
            <th>Jurusan</th>
            <th>Kelas</th>
            <th>Tahun</th>
            <th>Laporan Akhir</th>
        </tr>
    </thead>
    {{-- <tbody>
        @foreach($students as $student)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>TKJ</td>
                <td>{{ $student->nis }}</td>
                <td>{{ $student->name }}</td>
                <td>{{ $student->jurusan }}</td>
                <td>{{ $student->kelas }}</td>
                <td>{{ $student->tahun }}</td>
                <td>
                    <span class="badge bg-success">Upload</span>
                </td>
                <td>
                    <button class="btn btn-primary">Import</button>
                </td>
            </tr>
        @endforeach
    </tbody> --}}
    <tbody class="table table-striped">
        <tr class="text-center align-middle">
            <td class="align-middle">1</td>
            <td class="align-middle">K001</td>
            <td class="align-middle">16034</td>
            <td class="align-middle">Rulli Ardha Ramadhan</td>
            <td class="align-middle">Teknik Komputer Jaringan</td>
            <td class="align-middle">TKJ 1</td>
            <td class="align-middle">2024/2025</td>
            <td>
                <a href="{{ asset('storage/files/sample-file.pdf') }}" >
                    <button class="btn btn-warning">
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

<br>
<br>
<br>
<br>
</div>

@include('layouts.footer')
@endsection