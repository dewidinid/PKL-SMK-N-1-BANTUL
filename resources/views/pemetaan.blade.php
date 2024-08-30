@extends('layouts.header')

@section('content')
<title>PKL Pemetaan </title>
<br>
    <h4 style="text-align: center;">ALUR PKL SMK N 1 BANTUL</h4>

    <style>
        .alur-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh; /* Membuat kontainer memiliki tinggi penuh layar */
        }
    </style>

    <div class="alur-container">
        <div>
            <img src="{{ asset('image/alur_pkl.png') }}" alt="Logo 1" class="img-fluid mx-2" style="width: 800px; ">
        </div>
    </div>

{{-- pengumuman --}}
<h4 style="text-align: center;">Pengumuman</h4>
    
@include('layouts.footer')
@endsection
