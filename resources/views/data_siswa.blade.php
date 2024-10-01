@extends('layouts.headeradmin')

@section('content')

<div class="container mt-5 table-wrapper">
    <h4 class="text-center">DATA SISWA</h4>
    <br>
    <!-- Filter Tahun dan konsentrasi_keahlian -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div >
            <select class="form-select d-inline-block w-auto" name="tahun">
                <option selected>Tahun</option>
                <!-- Tambahkan opsi tahun -->
            </select>
            <select class="form-select d-inline-block w-auto" name="konsentrasi_keahlian">
                <option selected>konsentrasi_keahlian</option>
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
                <!-- Tombol dengan kelas kustom -->
                <button class="custom-btn" style="background-color: #F99417; ">Import</button>
            </form>
        </div>
    </div>


        <table class=" table-striped custom-table">
            <thead class="table-primary text-center" >
                <tr>
                    <th>No</th>
                    <th>NIS</th>
                    <th>Nama</th>
                    <th>Konsentrasi Keahlian</th>
                    <th>Kelas</th>
                    <th>Tahun</th>
                </tr>
            </thead>
            <tbody id="data-table" >
                @foreach ($siswa as $index => $student)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $student->NIS }}</td>
                        <td>{{ $student->nama_siswa }}</td>
                        <td>{{ $student->konsentrasiKeahlian->nama_konsentrasi }}</td>
                        <td>{{ $student->kelas }}</td>
                        <td>{{ $student->tahun }}</td>
                    </tr>
                @endforeach
                <!-- Data contoh, akan diisi dengan JavaScript -->
                <tr>
                    <td>1</td>
                    <td>
                        <div>1. 123456789</div>
                        <div>2. 234567890</div>
                    </td>
                    <td class="left-align">
                        <div>1. Rulli Arhan</div>
                        <div>2. Muhammad Putra</div>
                    </td>
                    <td>Teknik Komputer Jaringan</td>
                    <td>TKJ 1</td>
                    <td>2024/2025</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>
                        <div>1. 123456789</div>
                        <div>2. 234567890</div>
                    </td>
                    <td class="left-align">
                        <div>1. Rulli Arhan</div>
                        <div>2. Muhammad Putra</div>
                    </td>
                    <td>Teknik Komputer Jaringan</td>
                    <td>TKJ 1</td>
                    <td>2024/2025</td>
                </tr>
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