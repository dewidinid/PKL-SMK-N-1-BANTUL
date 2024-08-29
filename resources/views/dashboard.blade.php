@extends('layouts.header')

@section('content')
<div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="{{ asset('image/SMKN1Bantul(depan).jpg') }}" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="{{ asset('image/SMKN1Bantul(depan).jpg') }}" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="{{ asset('image/SMKN1Bantul(depan).jpg') }}" class="d-block w-100" alt="...">
        </div>
    </div>
</div> 
<div class="container">
    <div class="text-center mb-4">
        <br>
        <br>
        <div class="row justify-content-center mt-5 mb-3">
            <div class="col-md-2">
                <div class="card text-white bg-primary mb-3 square-card">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                            <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                        </svg>
                        <br>
                        <h5 class="card-title">Peserta Didik</h5>
                        <h5 class="card-text">178</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="card text-white bg-primary mb-3 square-card">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-buildings-fill" viewBox="0 0 16 16">
                            <path d="M15 .5a.5.5 0 0 0-.724-.447l-8 4A.5.5 0 0 0 6 4.5v3.14L.342 9.526A.5.5 0 0 0 0 10v5.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V14h1v1.5a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5zM2 11h1v1H2zm2 0h1v1H4zm-1 2v1H2v-1zm1 0h1v1H4zm9-10v1h-1V3zM8 5h1v1H8zm1 2v1H8V7zM8 9h1v1H8zm2 0h1v1h-1zm-1 2v1H8v-1zm1 0h1v1h-1zm3-2v1h-1V9zm-1 2h1v1h-1zm-2-4h1v1h-1zm3 0v1h-1V7zm-2-2v1h-1V5zm1 0h1v1h-1z"/>
                          </svg>
                          <br>
                        <h5 class="card-title">DUDI</h5>
                        <h5 class="card-text">178</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="card text-white bg-primary mb-3 square-card">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        <h5 class="card-title">178</h5>
                        <p class="card-text">Kota</p>
                    </div>
                </div>
            </div>
        </div> 
    </div>

    <div class="text-center mb-5">
        <h3>Tentang PKL</h3>
        <p>Praktek Kerja Lapangan (PKL) adalah kegiatan belajar di luar kelas yang dilakukan oleh siswa di tempat kerja tertentu...</p>
        <div class="d-flex justify-content-center">
            <img src="{{ asset('path_to_logos_image') }}" alt="Logos" class="img-fluid">
        </div>
    </div>

    <div class="text-center mb-5">
        <h3>Sistem PKL</h3>
        <p>Sistem PKL adalah sistem yang digunakan untuk mempermudah dalam monitoring kegiatan PKL Siswa</p>
        <div class="row">
            <div class="col-md-6 mb-3">
                <a href="#" class="btn btn-primary btn-lg w-100">Mandiri</a>
            </div>
            <div class="col-md-6 mb-3">
                <a href="#" class="btn btn-primary btn-lg w-100">Pemetaan</a>
            </div>
        </div>
    </div>

    <div class="text-center mb-5">
        <h3>Tim PKL</h3>
        <div class="row">
            <div class="col-md-3 mb-3">
                <div class="card">
                    <img src="{{ asset('path_to_profile_image') }}" class="card-img-top" alt="Tim PKL">
                    <div class="card-body">
                        <h5 class="card-title">Daryati, S.Pd</h5>
                        <p class="card-text">Peran</p>
                    </div>
                </div>
            </div>
            <!-- Tambahkan lebih banyak kartu anggota tim sesuai kebutuhan -->
        </div>
    </div>
</div>

@include('layouts.footer')
@endsection
