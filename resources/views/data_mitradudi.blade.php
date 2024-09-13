@extends('layouts.headeradmin')


@section('content')

<div class="container mt-5 table-wrapper">
    <h4 class="text-center">DATA MITRA DUDI</h4>
    <br>
    <div class="d-flex justify-content-end align-items-center mb-3">
        <form method="POST" enctype="multipart/form-data" class="d-flex">
            @csrf
            <div class="me-2">
                <label for="file-upload" class="btn btn-primary d-flex align-items-center" style="background-color: #0275db">
                    Upload <i class="bi bi-upload ms-2"></i>
                </label>
                <input id="file-upload" type="file" name="file" class="d-none" onchange="this.form.submit()">
            </div>
            <button class="custom-btn" style="background-color: #F99417; ">Import</button>
        </form>
    </div>
    

        <table class=" table-striped custom-table">
            <thead class="table-primary text-center" >
                <tr class="text-center" >
                    <th>No</th>
                    <th>Kode Dudi</th>
                    <th>Nama Dudi</th>
                    <th>Alamat Dudi</th>
                    <th>No Handphone</th>
                    <th>Posisi PKL</th>
                </tr>
            </thead>
            <tbody id="data-table">
                <tr>
                    <td>1</td>
                    <td>D001</td>
                    <td>PT Telkom Indonesia</td>
                    <td>Jl Damai, No 15, Yogyakarta</td>
                    <td>0274 563876</td>
                    <td>Cyber Security</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>D001</td>
                    <td>PT Telkom Indonesia</td>
                    <td>Jl Damai, No 15, Yogyakarta</td>
                    <td>0274 563876</td>
                    <td>Cyber Security</td>
                </tr>
            </tbody>
            {{-- <tbody>
                @foreach ($dudi as $index => $student)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $dudi->kode_dudi }}</td>
                    <td>{{ $dudi->nama_dudi }}</td>
                    <td>{{ $dudi->alamat }}</td>
                    <td>{{ $dudi->no_telp }}</td>
                    <td>{{ $dudi->posisi }}</td>
                </tr>
                @endforeach
            </tbody> --}}

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