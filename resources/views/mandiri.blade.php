@extends('layouts.headersiswa')

@section('content')
<div class="container mt-5">

    <div class="d-flex justify-content-start mb-3" style="margin-left: 20px;">
        <button onclick="window.location.href='{{ route('home_siswa') }}'" style="background-color: #439AC7; color: #ffffff; border: none; padding: 5px 10px; border-radius: 5px; margin-top: 10px;">
            <i class="bi bi-arrow-left"></i> Kembali
        </button>
    </div>
    <br>
    <h4 style="text-align: center;">ALUR PKL SMK N 1 BANTUL</h4>

    <div class="alur-container">
        <iframe src="https://viewer.diagrams.net/?tags=%7B%7D&lightbox=1&highlight=0000ff&edit=_blank&layers=1&nav=1&title=Tipe%20PKL%20SMK%20N%201%20Bantul.drawio#Uhttps%3A%2F%2Fdrive.google.com%2Fuc%3Fid%3D1RvNEvQ5dtYpDO33V21Ixa_nkneXFfI9v%26export%3Ddownload" frameborder="0" style="width:100%; height:auto; min-height:600px;"></iframe>
    </div>
    
    <br>
    <br>

    <div class="center-button-container d-flex justify-content-center gap-2">
        <a href="{{ route('formpengajuan')}}" class="btn btn-primary">Form Pengajuan PKL Mandiri</a>
        <a href="https://docs.google.com/document/d/1dyCs8nkdjgoMrTGEmwm4WEJAWZxVwaJjPfnUOy7kA1Q/edit?usp=sharing" 
            class="btn btn-warning" style="background-color: #F4A261; border-radius: 5px; color: white;">
            Template Proposal
        </a>
    </div>
    <br>
    <br>
    <br>
    <br>
</div>
    

@endsection
