@extends('layouts.headersiswa')

@section('content')
<br>
<br>
<div class="container mt-5" id="jurnal-table-container">
    <h4 style="text-align: center;">ALUR PKL SMK N 1 BANTUL</h4>

    <div class="alur-container">
        <iframe src="https://viewer.diagrams.net/?tags=%7B%7D&lightbox=1&highlight=0000ff&edit=_blank&layers=1&nav=1&title=Tipe%20PKL%20SMK%20N%201%20Bantul.drawio#Uhttps%3A%2F%2Fdrive.google.com%2Fuc%3Fid%3D1RvNEvQ5dtYpDO33V21Ixa_nkneXFfI9v%26export%3Ddownload" frameborder="0" style="width:100%; height:auto; min-height:600px;"></iframe>
    </div>

    <br>

    {{-- pengumuman --}}
    <h4 style="text-align: center;">Pengumuman</h4>
    <br>
    <div style="max-height: 400px; overflow-y: auto;"> <!-- Wadah scrollable -->
        <table class="table-striped custom-table">
            <thead class="table-primary text-center">
                <tr class="text-center">
                    <th>No</th>
                    <th>Kelompok</th>
                    <th>NIS</th>
                    <th>Nama</th>
                    <th>Konsentrasi Keahlian</th>
                    <th>Kelas</th>
                    <th>Pembimbing</th>
                    <th>Dudi</th>
                    <th>Alamat Dudi</th>
                </tr>
            </thead>
            <tbody >
                @foreach ($plotingData as $index => $ploting)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $ploting->kode_kelompok }}</td>
                    <td>{{ $ploting->siswa->NIS }}</td>
                    <td>{{ $ploting->siswa->nama_siswa }}</td>
                    <td>{{ $ploting->siswa->konsentrasi_keahlian }}</td>
                    <td>{{ $ploting->siswa->kelas }}</td>
                    <td>{{ $ploting->nama_pembimbing }}</td>
                    <td>{{ $ploting->dudi->nama_dudi }}</td>
                    <td>{{ $ploting->dudi->alamat_dudi }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>


</div>
<br>
<br>
<br>
<br>
    
@include('layouts.footer')
@endsection
