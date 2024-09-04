@extends('layouts.headerpembimbing')


@section('content')

<div class="container mt-5">
    <h4 class="text-center">EVALUASI PKL</h4>
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
    </div>

    <table class="table table-bordered">
        <thead >
            <tr class="text-center" >
                <td>No</td>
                <td>Kelompok</td>
                <td>NIS</td>
                <td id="nama">Nama</td>
                <td>Konsentrasi Keahlian</td>
                <td>Kelas</td>
                <td>Tahun</td>
                <td>Evaluasi</td>
            <br>
        </thead>
        <tbody id="data-table" >
            <!-- Data contoh, akan diisi dengan JavaScript -->
            <tr>
                <td>1</td>
                <td>K001</td>
                <td>
                    <div>17672</div>
                    <div>17875</div>
                </td>
                <td>
                    <div>Rulli Arhan</div>
                    <div>Meisya Renata</div>
                </td>
                <td>Teknik Komputer Jaringan</td>
                <td>TKJ 1</td>
                <td>2024/2025</td>
                <td>
                    <button class="btn" style="background-color: #e67e55; border-radius: 5px; padding: 5px;">
                        <i class="bi bi-file-earmark" style="font-size: 16px; color: white;"></i>
                    </button>
                </td>
            </tr>
        </tbody>
        {{-- <tbody>
            @foreach ($students as $index => $student)
            <tr>
                <td>{{ $index + 1 }}</td>
                 <td>{{ $student->kelompok }}</td>
                <td>{{ $student->nis }}</td>
                <td>{{ $student->nama }}</td>
                <td>{{ $student->konsentrasi_keahlian }}</td>
                <td>{{ $student->kelas }}</td>
                <td>{{ $student->tahun }}</td>
                <td>{{ $student->monitoring}}</td>
            </tr>
            @endforeach
        </tbody> --}}

    </table>
</div>
    <br>
    <br>
    <br>
    <br>
@include('layouts.footer')
@endsection