@extends('layouts.header')

@section('content')
<div class="container">
    <div class="text-center mb-4">
        <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ asset('SMKN1Bantul(depan).jpg') }}" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('SMKN1Bantul(depan).jpg') }}" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('SMKN1Bantul(depan).jpg') }}" class="d-block w-100" alt="...">
                </div>
            </div>
        </div>        
        <br>
        <br>
        <div class="row">
            <div class="col-md-4">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-body">
                        <h5 class="card-title">178</h5>
                        <p class="card-text">Peserta Didik</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-body">
                        <h5 class="card-title">178</h5>
                        <p class="card-text">DUDI</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-body">
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
