@extends('layouts.headersiswa')

@section('content')
<div class="container mt-5">
    <h4 style="text-align: center;">ALUR PKL SMK N 1 BANTUL</h4>

    <div class="alur-container">
        <iframe src="https://viewer.diagrams.net/?tags=%7B%7D&lightbox=1&highlight=0000ff&edit=_blank&layers=1&nav=1&title=Tipe%20PKL%20SMK%20N%201%20Bantul.drawio#Uhttps%3A%2F%2Fdrive.google.com%2Fuc%3Fid%3D1RvNEvQ5dtYpDO33V21Ixa_nkneXFfI9v%26export%3Ddownload" frameborder="0" style="width:100%; height:auto; min-height:600px;"></iframe>
    </div>
    
    <br>
    <br>

    <div class="center-button-container">
        <a href="{{ route('formpengajuan')}}" class="btn btn-primary">Form Pengajuan PKL Mandiri</a>
    </div>
    <br>
    <br>
    <br>
    <br>
</div>
    
@include('layouts.footer')
@endsection
