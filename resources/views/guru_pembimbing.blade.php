@extends('layouts.headeradmin')


@section('content')

<div class="container mt-5 table-wrapper">
    <h4 class="text-center">DATA GURU PEMBIMBING</h4>
    <br>
    <!-- Filter Tahun dan Jurusan -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div >
            <select class="form-select d-inline-block w-auto" name="tahun">
                <option selected>Tahun</option>
                <!-- Tambahkan opsi tahun -->
            </select>
            <select class="form-select d-inline-block w-auto" name="jurusan">
                <option selected>Jurusan</option>
                <!-- Tambahkan opsi jurusan -->
            </select>
        </div>

        <!-- Pesan Sukses -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="d-flex justify-content-end align-items-center mb-3">
            <form method="POST" action="{{ route('import.pembimbing') }}" enctype="multipart/form-data" class="d-flex">
                @csrf
                <div class="me-2">
                    <label for="file-upload" class="btn btn-primary d-flex align-items-center" style="background-color: #0275db">
                        Upload <i class="bi bi-upload ms-2"></i>
                    </label>
                    <input id="file-upload" type="file" name="file" class="d-none" onchange="this.form.submit()">
                </div>
                <button type="submit" class="custom-btn" style="background-color: #F99417;">Import</button>
            </form>
        </div>
    </div>
    
    <table class="table-striped custom-table">
        <thead class="table-primary text-center">
            <tr class="text-center">
                <th>No</th>
                <th>NIP/NIK</th>
                <th>Nama</th>
                {{-- <th>No.Handphone</th> --}}
            </tr>
        </thead>
        <tbody id="data-table">
            @foreach($pembimbing as $index => $data)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $data->NIP_NIK }}</td>
                    <td>{{ $data->nama_pembimbing }}</td>
                    {{-- <td>{{ $data->notelp_pembimbing }}</td> --}}
                </tr>
            @endforeach
        </tbody>
    </table>
    
</div>

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

@endsection