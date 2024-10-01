@extends('layouts.headersiswa')

@section('content')
<br>
<br>
<div class="container mt-5">
    <h4 style="text-align: center;">ALUR PKL SMK N 1 BANTUL</h4>

    <div class="alur-container">
        <iframe src="https://viewer.diagrams.net/?tags=%7B%7D&lightbox=1&highlight=0000ff&edit=_blank&layers=1&nav=1&title=Tipe%20PKL%20SMK%20N%201%20Bantul.drawio#Uhttps%3A%2F%2Fdrive.google.com%2Fuc%3Fid%3D1RvNEvQ5dtYpDO33V21Ixa_nkneXFfI9v%26export%3Ddownload" frameborder="0" style="width:100%; height:auto; min-height:600px;"></iframe>
    </div>

    <br>

    {{-- pengumuman --}}
    <h4 style="text-align: center;">Pengumuman</h4>
    <br>
    <table class=" table-striped custom-table">
        <thead class="table-primary text-center" >
            <tr class="text-center" >
                <th>No</th>
                <th>Kelompok</th>
                <th>NIS</th>
                <th>Nama</th>
                <th>Konsentrasi Keahlian</th>
                <th>Kelas</th>
                <th>Pembimbing</th>
                <th>Dudi</th>
                <th>No Handphone Dudi</th>
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
