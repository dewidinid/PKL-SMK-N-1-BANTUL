@extends('layouts.headeradmin')

@section('content')

<div class="container mt-5 table-wrapper">
    <h4 class="text-center">DATA GURU PEMBIMBING</h4>
    <br>


    <div>
        <a href="https://docs.google.com/spreadsheets/d/1bfAglmp234hEOIc-OrjsE5CP5cjLexaY/edit?usp=drive_link&ouid=102059787068159879684&rtpof=true&sd=true">
            Template Upload Data Pembimbing
        </a>
    </div>
    <br>

    <!-- Filter Tahun dan konsentrasi_keahlian -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        {{-- <div>
            <select class="form-select d-inline-block w-auto" name="tahun">
                <option selected>Tahun</option>
                <!-- Tambahkan opsi tahun -->
            </select>
            <select class="form-select d-inline-block w-auto" name="konsentrasi_keahlian">
                <option selected>konsentrasi_keahlian</option>
                <!-- Tambahkan opsi konsentrasi_keahlian -->
            </select>
        </div> --}}
        
        <div>
            <button type="button" class="btn btn-primary d-flex align-items-center custom-btn" style="background-color: #0275db" data-bs-toggle="modal" data-bs-target="#addPembimbingModal">
                Tambah Pembimbing <i class="bi bi-plus" style="font-size: 19px;"></i>
            </button>
        </div>        

        <div class="d-flex ">
            <!-- Button untuk upload dengan SweetAlert -->
            <form method="POST" action="{{ route('import.pembimbing') }}" enctype="multipart/form-data" class="d-flex">
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
    

    <table class="table-striped custom-table">
        <thead class="table-primary text-center">
            <tr class="text-center">
                <th>No</th>
                <th>NIP/NIK</th>
                <th>Nama</th>
                <th>Jabatan</th>
                <th>Jenis Kelamin</th>
                <th>No Telp</th>
                <th>Alamat</th>
                {{-- <th>Tahun</th> --}}
            </tr>
        </thead>
        <tbody id="data-table">
            @foreach ($pembimbing as $index => $pembimbing)
                <tr class="text-center">
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $pembimbing->NIP_NIK }}</td>
                    <td>{{ $pembimbing->nama_pembimbing }}</td>
                    <td>{{ $pembimbing->jabatan }}</td>
                    <td>{{ $pembimbing->jenis_kelamin }}</td>
                    <td>{{ $pembimbing->no_telp }}</td>
                    <td>{{ $pembimbing->alamat }}</td>
                    {{-- <td>{{ $pembimbing->tahun }}</td>                             --}}
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

<!-- Modal Tambah Pembimbing -->
<div class="modal fade" id="addPembimbingModal" tabindex="-1" aria-labelledby="addPembimbingLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPembimbingLabel">Tambah Data Pembimbing</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('store.pembimbing') }}" method="POST" onsubmit="return showAddingNotification()">
                    @csrf
                    <div class="mb-3">
                        <label for="NIP_NIK" class="form-label">NIP/NIK</label>
                        <input type="text" class="form-control" id="NIP_NIK" name="NIP_NIK" required>
                    </div>
                    <div class="mb-3">
                        <label for="nama_pembimbing" class="form-label">Nama Pembimbing</label>
                        <input type="text" class="form-control" id="nama_pembimbing" name="nama_pembimbing" required>
                    </div>
                    <div class="mb-3">
                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                        <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="jabatan" class="form-label">Jabatan</label>
                        <input type="text" class="form-control" id="jabatan" name="jabatan" required>
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input type="text" class="form-control" id="alamat" name="alamat" required>
                    </div>
                    <div class="mb-3">
                        <label for="no_telp" class="form-label">No. Telepon</label>
                        <input type="text" class="form-control" id="no_telp" name="no_telp" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection