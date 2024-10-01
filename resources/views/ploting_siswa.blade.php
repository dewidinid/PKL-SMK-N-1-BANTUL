@extends('layouts.headeradmin')


@section('content')
<div class="container mt-5">
    <h4 class="text-center">PLOTING SISWA</h4>
    <br>
  <!-- Filter Tahun dan konsentrasi_keahlian -->
  <div class="d-flex justify-content-between align-items-center mb-3">
    <div >
        <select class="form-select d-inline-block w-auto" name="tahun">
            <option selected>Tahun</option>
            <!-- Tambahkan opsi tahun -->
        </select>
        <select class="form-select d-inline-block w-auto" name="konsentrasi_keahlian">
            <option selected>Konsentrasi Keahlian</option>
            <!-- Tambahkan opsi konsentrasi_keahlian -->
        </select>
    </div>

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
                    <th>No Telepon Dudi</th>
                </tr>
            </thead>
            <tbody id="data-table">
                @foreach ($ploting as $index => $ploting)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $ploting->kelompok->kode_kelompok }}</td>
                <td>{{ $ploting->siswa->NIS }}</td>
                <td>{{ $ploting->siswa->nama_siswa }}</td>
                <td>{{ $ploting->siswa->kelas }}</td>
                <td>{{ $ploting->pembimbing->nama_pembimbing }}</td>
                <td>{{ $ploting->dudi->nama_dudi }}</td>
                <td>{{ $ploting->dudi->notelp_dudi }}</td>
            </tr>
            @endforeach
                <!-- Data contoh, akan diisi dengan JavaScript -->
                <tr>
                    <td>1</td>
                    <td>K001</td>
                    <td>178291</td>
                    <td>Rulli Muhammad</td>
                    <td>TKJ 1</td>
                    <td>Dariyati, S.Pd.</td>
                    <td>PT Telkom Indonesia</td>
                    <td>(0274) 56276737</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>K001</td>
                    <td>178291</td>
                    <td>Rulli Muhammad</td>
                    <td>TKJ 1</td>
                    <td>Dariyati, S.Pd.</td>
                    <td>PT Telkom Indonesia</td>
                    <td>(0274) 56276737</td>
                </tr>
            </tbody>
            {{-- <tbody>
                @foreach ($students as $index => $student)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $student->nis }}</td>
                    <td>{{ $student->nama }}</td>
                    <td>{{ $student->konsentrasi_keahlian }}</td>
                    <td>{{ $student->kelas }}</td>
                    <td>{{ $student->tahun }}</td>
                </tr>
                @endforeach
            </tbody> --}}

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