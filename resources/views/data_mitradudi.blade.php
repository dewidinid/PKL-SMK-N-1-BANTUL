@extends('layouts.headeradmin')

@section('content')

<div class="container mt-5 table-wrapper">
    <h4 class="text-center">DATA MITRA DUDI</h4>
    <br>

    <a href="https://docs.google.com/spreadsheets/d/1lAYwZCsuNsmq9Vx7Mek3kWA3i7d5ukdW/edit?usp=drive_link&ouid=102059787068159879684&rtpof=true&sd=true"
    class="custom-btn" style="background-color: #87A2FF; border-radius: 5px; color: white; padding: 10px 20px; text-decoration: none; display: center; font-weight: bold;">
     Template Upload Data Dudi </a>
    <br>
    <br>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <!-- Button to trigger the modal (left-aligned) -->
        <div>
            <button type="button" class="btn btn-primary d-flex align-items-center custom-btn" style="background-color: #0275db" data-bs-toggle="modal" data-bs-target="#addDudiModal">
                Tambah Dudi <i class="bi bi-plus" style="font-size: 19px;"></i>
            </button>
        </div>
    
        <!-- File Upload and Import Buttons (right-aligned) -->
        <div class="d-flex">
            <form method="POST" action="{{ route('import.dudi') }}" enctype="multipart/form-data" class="d-flex">
                @csrf
                <div class="me-2">
                    <label for="file-upload" class="btn btn-primary d-flex align-items-center custom-btn" style="background-color: #0275db">
                        Upload <i class="bi bi-upload ms-2"></i>
                    </label>
                    <input id="file-upload" type="file" name="file" class="d-none" onchange="handleFileUpload(this)">
                </div>
            </form>
        </div>
    </div>

    <!-- Tabel Data Mitra Dudi -->
    <table class="table-striped custom-table">
        <thead class="table-primary text-center">
            <tr class="text-center">
                <th>No</th>
                <th>Kode Dudi</th>
                <th>Nama Dudi</th>
                <th>Bidang Usaha</th>
                <th>No Telp</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody id="data-table">
            @foreach($dudi as $index => $data)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $data->kode_dudi }}</td>
                    <td>{{ $data->nama_dudi }}</td>
                    <td>{{ $data->bidang_usaha }}</td>
                    <td>{{ $data->notelp_dudi }}</td>
                    <td>{{ $data->alamat_dudi }}</td>
                    <td>
                        <!-- Tombol Edit untuk membuka modal edit -->
                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editDudiModal{{ $data->kode_dudi }}">
                            Edit
                        </button>
                    </td>
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

<!-- Modal -->
<div class="modal fade" id="addDudiModal" tabindex="-1" aria-labelledby="addDudiModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('store.dudi') }}" onsubmit="return showAddingNotification()">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addDudiModalLabel">Tambah Data Dudi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="kode_dudi" class="form-label">Kode Dudi</label>
                        <input type="text" class="form-control" id="kode_dudi" name="kode_dudi" required>
                    </div>
                    <div class="mb-3">
                        <label for="nama_dudi" class="form-label">Nama Dudi</label>
                        <input type="text" class="form-control" id="nama_dudi" name="nama_dudi" required>
                    </div>
                    <div class="mb-3">
                        <label for="bidang_usaha" class="form-label">Bidang Usaha</label>
                        <input type="text" class="form-control" id="bidang_usaha" name="bidang_usaha" required>
                    </div>
                    <div class="mb-3">
                        <label for="notelp_dudi" class="form-label">No Telp</label>
                        <input type="text" class="form-control" id="notelp_dudi" name="notelp_dudi" required>
                    </div>
                    <div class="mb-3">
                        <label for="alamat_dudi" class="form-label">Alamat Dudi</label>
                        <input type="text" class="form-control" id="alamat_dudi" name="alamat_dudi" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@foreach($dudi as $data)
    <div class="modal fade" id="editDudiModal{{ $data->kode_dudi }}" tabindex="-1" aria-labelledby="editDudiModalLabel{{ $data->kode_dudi }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="{{ route('update.dudi', $data->kode_dudi) }}" >
                    @csrf
                    @method('PUT')

                    <div class="modal-header">
                        <h5 class="modal-title" id="editDudiModalLabel{{ $data->kode_dudi }}">Edit Data Dudi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="kode_dudi" class="form-label">Kode Dudi</label>
                            <input type="text" class="form-control" id="kode_dudi" name="kode_dudi" value="{{ $data->kode_dudi }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="nama_dudi" class="form-label">Nama Dudi</label>
                            <input type="text" class="form-control" id="nama_dudi" name="nama_dudi" value="{{ $data->nama_dudi }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="bidang_usaha" class="form-label">Bidang Usaha</label>
                            <input type="text" class="form-control" id="bidang_usaha" name="bidang_usaha" value="{{ $data->bidang_usaha }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="notelp_dudi" class="form-label">No Telp</label>
                            <input type="text" class="form-control" id="notelp_dudi" name="notelp_dudi" value="{{ $data->notelp_dudi }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="alamat_dudi" class="form-label">Alamat Dudi</label>
                            <input type="text" class="form-control" id="alamat_dudi" name="alamat_dudi" value="{{ $data->alamat_dudi }}" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach

@endsection
