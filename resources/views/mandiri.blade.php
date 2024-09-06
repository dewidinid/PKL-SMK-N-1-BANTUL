@extends('layouts.headersiswa')

@section('content')
<br>
<br>

    <h4 style="text-align: center;">ALUR PKL SMK N 1 BANTUL</h4>

    <div class="alur-container">
        <div>
            <img src="{{ asset('image/alur_pkl.png') }}" alt="Logo 1" class="img-fluid mx-2" style="width: 800px; ">
        </div>
    </div>
    <br>
    <br>

    <div class="center-button-container">
        <a href="{{ route('formpengajuan')}}" class="btn btn-outline-primary">Form Pengajuan PKL Mandiri</a>
    </div>
    <br>
    <br>
    <br>
    <br>
    
@include('layouts.footer')
@endsection
