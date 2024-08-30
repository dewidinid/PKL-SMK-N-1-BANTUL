@extends('layouts.headersiswa')

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

    <br>
    <br>
    <div class=" container">
        <div id="kategori-pkl" class="text-center mb-5" data-aos="fade-up">
            <h3>Kategori PKL</h3>
            <br>
            <p>PKL di SMK N 1 Bantul memiliki kategori 2 jenis, yaitu Mandiri dan Pemetaan.</p>
            <br>
            <div class="row justify-content-center mt-3 mb-3">
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-3 custom-spacing">
                    <a href="#" class="btn btn-success btn-lg w-100 d-flex align-items-center justify-content-center kategori-card custom-shadow" alt="Kategori PKL">
                        <i class="bi bi-person-fill me-2"></i> <!-- Ganti dengan ikon yang Anda inginkan -->
                        <span class="ps-3">MANDIRI</span>
                    </a>
                </div>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-3 custom-spacing">
                    <a href="#" class="btn btn-success btn-lg w-100 d-flex align-items-center justify-content-center kategori-card custom-shadow" alt="Kategori PKL">
                        <i class="bi bi-bounding-box-circles me-2"></i> <!-- Ganti dengan ikon yang Anda inginkan -->
                        <span class="ps-3">PEMETAANA</span>
                    </a>
                </div>
            </div>
        </div>
    
        <br>
        <div id="kategori-pkl" class="text-center mb-5" data-aos="fade-up">
            <h3>Laporan</h3>
            <br>
            <p>Pantau perkembangan jurnal dan penilaian PKL secara menyeluruh melalui laporan terperinci yang tersedia di sini</p>
            <br>
            <div class="row justify-content-center mt-3 mb-3">
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-3 custom-spacing">
                    <a href="#" class="btn btn-success btn-lg w-100 d-flex align-items-center justify-content-center kategori-card custom-shadow" alt="Laporan PKL">
                        <i class="bi bi-chat-left-text"></i> <!-- Ganti dengan ikon yang Anda inginkan -->
                        <span class="ps-3">LAPORAN PKL (JURNAL)</span>
                    </a>
                </div>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-3 custom-spacing">
                    <a href="#" class="btn btn-success btn-lg w-100 d-flex align-items-center justify-content-center kategori-card custom-shadow" alt="Laporan PKL">
                        <i class="bi bi-file-earmark-text"></i> <!-- Ganti dengan ikon yang Anda inginkan -->
                        <span class="ps-3">NILAI PKL</span>
                    </a>
                </div>
            </div>            
        </div>
    </div>
    
<br>
<br>

@include('layouts.footer')
@endsection