@extends('layouts.headersiswa')

@section('content')
<br>
<br>
<div class="container mt-5">
    <h4 style="text-align: center;">ALUR PKL SMK N 1 BANTUL</h4>

    <div class="alur-container">
        <div>
            <img src="{{ asset('image/alur_pkl.png') }}" alt="Logo 1" class="img-fluid mx-2" style="width: 800px; ">
        </div>
    </div>

    <br>

    {{-- pengumuman --}}
    <h4 style="text-align: center;">Pengumuman</h4>
    <br>
    <table class="table table-bordered">
        <thead >
            <tr class="text-center" >
                <td>No</td>
                <td>Kelompok</td>
                <td>NIS</td>
                <td>Nama</td>
                <td>Konsentrasi Keahlian</td>
                <td>Kelas</td>
                <td>Pembimbing</td>
                <td>Dudi</td>
                <td>No Handphone Dudi</td>
            <br>
        </thead>
        <tbody id="data-table" >
            <!-- Data contoh, akan diisi dengan JavaScript -->
            <tr>
                <td>1</td>
                <td>K001</td>
                <td>
                    <div>1. 17678</div>
                    <div>2. 17635</div>
                </td>
                <td>
                    <div>1. Rulli Arhan</div>
                    <div>2. Muhammad Putra</div>
                </td>
                <td>Teknik Komputer Jaringan</td>
                <td>TKJ 1</td>
                <td>Dariyati, S.Pd.</td>
                <td>PT Telkom Indonesia Tbk</td>
                <td>(0274) 64762874</td>
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
<br>
    
@include('layouts.footer')
@endsection
