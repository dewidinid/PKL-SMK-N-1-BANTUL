@extends('layouts.header')

@section('content')
<title>PKL Mandiri</title>
<br>
    <h4 style="text-align: center;">ALUR PKL SMK N 1 BANTUL</h4>

    <style>
        .alur-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh; /* Membuat kontainer memiliki tinggi penuh layar */
        }

        .center-button-container{
            display: flex;           /* Menggunakan Flexbox */
            justify-content: center; /* Memusatkan secara horizontal */
            align-items: center;     /* Memusatkan secara vertikal */
        }
    </style>

    <div class="alur-container">
        <div>
            <img src="{{ asset('image/alur_pkl.png') }}" alt="Logo 1" class="img-fluid mx-2" style="width: 800px; ">
        </div>
    </div>

    <div class="center-button-container">
        <button  type="submit" class="btn btn-outline-primary" value="submit">Form Pengajuan PKL Mandiri</button>
    </div>
    
@include('layouts.footer')
@endsection
