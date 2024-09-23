@extends('layouts.headeradmin')


@section('content')

<div class="container mt-5 table-wrapper">
    <h4 class="text-center">DATA MITRA DUDI</h4>
    <br>

    <!-- Pesan Sukses -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="d-flex justify-content-end align-items-center mb-3">
        <form method="POST" action="{{ route('import.dudi') }}" enctype="multipart/form-data" class="d-flex">
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
    

    <!-- Tabel Data Mitra Dudi -->
    <table class="table-striped custom-table">
        <thead class="table-primary text-center">
            <tr class="text-center">
                <th>No</th>
                <th>Kode Dudi</th>
                <th>Nama Dudi</th>
                <th>Alamat Dudi</th>
                <th>No Handphone</th>
                <th>Posisi PKL</th>
            </tr>
        </thead>
        <tbody id="data-table">
            @foreach($dudi as $index => $data)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $data->kode_dudi }}</td>
                    <td>{{ $data->nama_dudi }}</td>
                    <td>{{ $data->alamat_dudi }}</td>
                    <td>{{ $data->notelp_dudi }}</td>
                    <td>{{ $data->posisi_pkl }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

    <br>
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