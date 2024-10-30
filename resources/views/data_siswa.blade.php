@extends('layouts.headeradmin')

@section('content')

<div class="container mt-5 table-wrapper">
    <h4 class="text-center">DATA SISWA</h4>
    <br>

    <a href="https://docs.google.com/spreadsheets/d/1f9_PpRN0Y_1BsYxjG7oTH0g0SiRBsbXc/edit?usp=drive_link&ouid=102059787068159879684&rtpof=true&sd=true" 
    class="custom-btn" style="background-color: #87A2FF; border-radius: 5px; color: white; padding: 10px 20px; text-decoration: none; display: center; font-weight: bold;">
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
                    <!-- Dynamically populate year options based on available data -->
                    @foreach ($siswa->pluck('tahun')->unique() as $year)
                        <option value="{{ $year }}" {{ request('tahun') == $year ? 'selected' : '' }}>
                            {{ $year }}
                        </option>
                    @endforeach
                </select>
        
                <select class="form-select d-inline-block w-auto" name="konsentrasi_keahlian">
                    <option value="" selected>Konsentrasi Keahlian</option>
                    <!-- Dynamically populate concentration options based on available data -->
                    @foreach ($siswa->pluck('konsentrasi_keahlian')->unique() as $keahlian)
                        <option value="{{ $keahlian }}" {{ request('konsentrasi_keahlian') == $keahlian ? 'selected' : '' }}>
                            {{ $keahlian }}
                        </option>
                    @endforeach
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
        <thead class="table-primary text-center">
            <tr>
                <th>No</th>
                <th>NIS</th>
                <th>Nama</th>
                <th>Konsentrasi Keahlian</th>
                <th>Kelas</th>
                <th>Tahun</th>
                <th>Aksi</th> <!-- Kolom baru untuk aksi -->
            </tr>
        </thead>
        <tbody id="data-table">
            @foreach ($siswa as $index => $student)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $student->NIS }}</td>
                    <td>{{ $student->nama_siswa }}</td>
                    <td>{{ $student->konsentrasi_keahlian }}</td>
                    <td>{{ $student->kelas }}</td>
                    <td>{{ $student->tahun }}</td>
                    <td>
                        <!-- Tombol Edit -->
                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editSiswaModal" onclick="populateEditForm({{ $student }})">Edit</button>
                    </td>
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

    <!-- Modal Edit Siswa -->
<div class="modal fade" id="editSiswaModal" tabindex="-1" aria-labelledby="editSiswaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editSiswaModalLabel">Edit Data Siswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('siswa.update') }}" method="POST">
                    @csrf
                    @method('PUT') <!-- Menggunakan PUT untuk update -->
                    <input type="hidden" name="NIS" id="editNIS">
                    <div class="mb-3">
                        <label for="editNama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="editNama" name="nama_siswa">
                    </div>
                    <div class="mb-3">
                        <label for="editKonsentrasiKeahlian" class="form-label">Konsentrasi Keahlian</label>
                        <input type="text" class="form-control" id="editKonsentrasiKeahlian" name="konsentrasi_keahlian">
                    </div>
                    <div class="mb-3">
                        <label for="editKelas" class="form-label">Kelas</label>
                        <input type="text" class="form-control" id="editKelas" name="kelas">
                    </div>
                    <div class="mb-3">
                        <label for="editTahun" class="form-label">Tahun</label>
                        <input type="text" class="form-control" id="editTahun" name="tahun">
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

<script>
    // Function untuk mengisi form edit dengan data siswa yang dipilih
    function populateEditForm(student) {
        document.getElementById('editNIS').value = student.NIS;
        document.getElementById('editNama').value = student.nama_siswa;
        document.getElementById('editKonsentrasiKeahlian').value = student.konsentrasi_keahlian;
        document.getElementById('editKelas').value = student.kelas;
        document.getElementById('editTahun').value = student.tahun;
    }
</script>


@endsection