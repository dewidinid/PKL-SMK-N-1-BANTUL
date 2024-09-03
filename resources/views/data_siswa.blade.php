@extends('layouts.headersiswa')


@section('content')
<br>
<div class="container mt-5">
    <h4 class="text-center">DATA SISWA</h4>
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

    <form  method="POST" enctype="multipart/form-data">
        {{-- action="{{ route('upload-file') }}" --}}
        @csrf
        <label for="file-upload" class="btn btn-primary d-flex align-items-center">
            Upload <i class="fas fa-upload ms-2"></i>
        </label>
        <input id="file-upload" type="file" name="file" class="d-none" onchange="this.form.submit()">
    </form>
</div>

        <table class="table table-bordered">
            <thead >
                <tr class="text-center" >
                    <td>No</td>
                    <td>NIS</td>
                    
                    <td>Nama</td>
                    <td>Konsentrasi Keahlian</td>
                    <td>Kelas</td>
                    <td>Tahun</td>
                <br>
            </thead>
            <tbody id="data-table">
                <!-- Data contoh, akan diisi dengan JavaScript -->
                <tr>
                    <td>1</td>
                    <td>
                        <div>1. 123456789</div>
                        <div>2. 234567890</div>
                    </td>
                    <td>
                        <div>1. Rulli Arhan</div>
                        <div>2. Muhammad Putra</div>
                    </td>
                    <td>Teknik Komputer Jaringan</td>
                    <td>TKJ 1</td>
                    <td>2024/2025</td>
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

    <br>
    <br>
    <br>
    <br>
@include('layouts.footer')
@endsection