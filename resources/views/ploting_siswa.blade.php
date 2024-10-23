@extends('layouts.headeradmin')


@section('content')
<div class="container mt-5">
    <h4 class="text-center">PLOTING SISWA</h4>
    <br>

    <a href="https://docs.google.com/spreadsheets/d/1jLJYRdNSpNqo-rW7cSwCOMH7he6JvoIf/edit?usp=drive_link&ouid=102059787068159879684&rtpof=true&sd=true">
        Template Upload Ploting
    </a>
    <br>
    <br>

  <!-- Filter Tahun dan konsentrasi_keahlian -->
  <div class="d-flex justify-content-between align-items-center mb-3">
    <form method="GET" action="{{ route('admin.plotingSiswa') }}">
        <div>
            <select class="form-select d-inline-block w-auto" name="tahun">
                <option selected>Tahun</option>
                @foreach($tahun as $t)
                    <option value="{{ $t }}">{{ $t }}</option>
                @endforeach
            </select>
            <select class="form-select d-inline-block w-auto" name="kelompok"> <!-- Pastikan 'name' sama dengan di controller -->
                <option selected>Kelompok</option>
                @foreach($kelompok as $k)
                    <option value="{{ $k }}">{{ $k }}</option> <!-- Ambil 'kode_kelompok' -->
                @endforeach
            </select>
            <select class="form-select d-inline-block w-auto" name="konsentrasi_keahlian"> <!-- Tambahkan dropdown untuk konsentrasi keahlian -->
                <option selected>Konsentrasi Keahlian</option>
                @foreach($konsentrasi_keahlian as $kk)
                    <option value="{{ $kk }}">{{ $kk }}</option>
                @endforeach
            </select>            
            <button type="submit" class="btn btn-primary">Filter</button>
        </div>
    </form>

    <div class="d-flex">
        <form action="{{ route('admin.importPloting') }}" method="POST" enctype="multipart/form-data" class="d-flex">
            @csrf
            <div class="me-2">
                <label for="file-upload" class="btn btn-primary d-flex align-items-center custom-btn" style="background-color: #0275db">
                    Upload <i class="bi bi-upload ms-2"></i>
                </label>
                <input id="file-upload" type="file" name="file" class="d-none" onchange="handleFileUpload(this)">
            </div>
            {{-- <button class="btn custom-btn" style="background-color: #F99417; ">Import</button> --}}
        </form>
    </div>
</div>

        <table class=" table-striped custom-table">
            <thead class="table-primary text-center" >
                <tr class="text-center" >
                    <th>No</th>
                    <th>Kelompok</th>
                    <th>NIS</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Pembimbing</th>
                    <th>Dudi</th>
                    <th>Alamat Dudi</th>
                </tr>
            </thead>
            <tbody id="data-table">
                @foreach ($ploting as $index => $ploting)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $ploting->kode_kelompok }}</td>
                <td>{{ $ploting->siswa->NIS }}</td>
                <td>{{ $ploting->siswa->nama_siswa }}</td>
                <td>{{ $ploting->siswa->kelas }}</td>
                <td>{{ $ploting->nama_pembimbing }}</td>
                <td>{{ $ploting->dudi->nama_dudi }}</td>
                <td>{{ $ploting->dudi->alamat_dudi }}</td>
            </tr>
            @endforeach
                <!-- Data contoh, akan diisi dengan JavaScript -->
            
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