@extends('layouts.headeradmin')

@section('content')

<div class="container mt-5 table-wrapper">
    <h4 class="text-center">DATA SISWA</h4>
    <br>

    <a href="https://docs.google.com/spreadsheets/d/1f9_PpRN0Y_1BsYxjG7oTH0g0SiRBsbXc/edit?usp=drive_link&ouid=102059787068159879684&rtpof=true&sd=true">
        Template Upload Data Siswa
    </a>
    <br>
    <br>
    <!-- Filter Tahun dan konsentrasi_keahlian -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <form action="{{ route('filterSiswa') }}" method="GET">
            <div>
                <select class="form-select d-inline-block w-auto" name="tahun">
                    <option value="" selected>Tahun</option>
                    <option value="2023/2024">2023/2024</option>
                    <option value="2022/2023">2022/2023</option>
                    <!-- Tambahkan opsi tahun lainnya -->
                </select>
                <select class="form-select d-inline-block w-auto" name="konsentrasi_keahlian">
                    <option value="" selected>Konsentrasi Keahlian</option>
                    <option value="Teknik Komputer dan Jaringan (TKJ)">Teknik Komputer dan Jaringan (TKJ)</option>
                    <option value="Rekayasa Perangkat Lunak (RPL)">Rekayasa Perangkat Lunak (RPL)</option>
                    <!-- Tambahkan opsi konsentrasi keahlian lainnya -->
                </select>
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>
        </form>

        <div class="d-flex">
            <form method="POST" action="{{ route('siswa.import') }}" enctype="multipart/form-data" class="d-flex">
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
                        <td>{{ $student->konsentrasi_keahlian }}</td>
                        <td>{{ $student->kelas }}</td>
                        <td>{{ $student->tahun }}</td>
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