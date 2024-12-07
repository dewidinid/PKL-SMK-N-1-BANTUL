@extends('layouts.header')

@section('content')

{{-- <div style="position: relative; ">
    <img src="{{ asset('image/landing page.png') }}" class="img-full d-block w-100" alt="Landing Page Image" 
         style="height: 100vh; object-fit: contain; margin-top: -125px;">
</div> --}}

<div class="banner" style="position: relative; ">
    <img id="bannerImage" src="{{ asset('image/landing page.png') }}" class="img-fluid d-block w-100" alt="Banner" 
         style="height: 100vh; object-fit: contain; margin-top: -125px;">
</div>

<script>
    const bannerImage = document.getElementById('bannerImage');
    const screenWidth = window.innerWidth;

    if (screenWidth <= 576) {
        bannerImage.src = '{{ asset('image/landing-mobile.png') }}'; // Untuk layar <= 576px
    } else if (screenWidth > 576 && screenWidth <= 768) {
        bannerImage.src = '{{ asset('image/landing page.png') }}'; // Untuk layar tablet (577px - 768px)
    } else if (screenWidth > 768 && screenWidth <= 1200) {
        bannerImage.src = '{{ asset('image/landing page.png') }}'; // Untuk layar desktop kecil (768px - 1200px)
    } else {
        bannerImage.src = '{{ asset('image/landing page.png') }}'; // Untuk layar desktop besar (>1200px)
    }
</script>

{{-- <div class="banner" style="position: relative;">
    <img src="{{ asset('image/landing page.png') }}" style="height: 100vh; object-fit: contain; margin-top: -125px;"
         srcset="{{ asset('image/landing page.png') }} 1200w, {{ asset('image/landing-mobile.png') }} 576w"
         sizes="(max-width: 576px) 100vw, 1200px" 
         alt="Banner" class="img-fluid d-block w-100">
</div> --}}


<div id="info" class="container" >
    <div class="row">
        
        {{-- <div class="row justify-content-center mt-5 mb-3">
            <div class="col-6 col-md-4 col-lg-3 mb-4 " style="margin-left: 40px; margin-right: 40px;">
                <div class="card text-white bg-primary mb-3 square-card custom-shadow" style="background-color: #439AC7 !important;">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                            <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5"/>
                          </svg>
                        <br>
                        <h5 class="card-title">Peserta Didik</h5>
                        <h5 class="card-text">{{ $jumlahSiswa }}</h5>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-3 mb-4 " style="margin-left: 40px; margin-right: 40px;">
                <div class="card text-white bg-primary mb-3 square-card custom-shadow" style="background-color: #439AC7 !important">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-buildings-fill" viewBox="0 0 16 16">
                            <path d="M15 .5a.5.5 0 0 0-.724-.447l-8 4A.5.5 0 0 0 6 4.5v3.14L.342 9.526A.5.5 0 0 0 0 10v5.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V14h1v1.5a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5zM2 11h1v1H2zm2 0h1v1H4zm-1 2v1H2v-1zm1 0h1v1H4zm9-10v1h-1V3zM8 5h1v1H8zm1 2v1H8V7zM8 9h1v1H8zm2 0h1v1h-1zm-1 2v1H8v-1zm1 0h1v1h-1zm3-2v1h-1V9zm-1 2h1v1h-1zm-2-4h1v1h-1zm3 0v1h-1V7zm-2-2v1h-1V5zm1 0h1v1h-1z"/>
                          </svg>
                          <br>
                        <h5 class="card-title">DUDI</h5>
                        <h5 class="card-text">{{ $jumlahDudi }}</h5>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-3 mb-4 " style="margin-left: 40px; margin-right: 40px;">
                <div class="card text-white bg-primary mb-3 square-card custom-shadow " style="background-color: #439AC7 !important">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-map-fill" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M16 .5a.5.5 0 0 0-.598-.49L10.5.99 5.598.01a.5.5 0 0 0-.196 0l-5 1A.5.5 0 0 0 0 1.5v14a.5.5 0 0 0 .598.49l4.902-.98 4.902.98a.5.5 0 0 0 .196 0l5-1A.5.5 0 0 0 16 14.5zM5 14.09V1.11l.5-.1.5.1v12.98l-.402-.08a.5.5 0 0 0-.196 0zm5 .8V1.91l.402.08a.5.5 0 0 0 .196 0L11 1.91v12.98l-.5.1z"/>
                        </svg>
                        <br>
                        <h5 class="card-title">Pembimbing</h5>
                        <h5 class="card-text">{{ $jumlahPembimbing }}</h5>
                    </div>
                </div>
            </div>
        </div>  --}}
        <div class="row justify-content-center mt-5" >
            <div class="col-6 col-md-4 col-lg-3 mb-4">
                <div class="card text-white bg-primary mb-3 square-card custom-shadow" style="background-color: #439AC7 !important;">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                            <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5"/>
                        </svg>
                        <h5 class="card-title">Peserta Didik</h5>
                        <h5 class="card-text">{{ $jumlahSiswa }}</h5>
                    </div>
                </div>
            </div>
        
            <div class="col-6 col-md-4 col-lg-3 mb-4">
                <div class="card text-white bg-primary mb-3 square-card custom-shadow" style="background-color: #439AC7 !important;">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-buildings-fill" viewBox="0 0 16 16">
                            <path d="M15 .5a.5.5 0 0 0-.724-.447l-8 4A.5.5 0 0 0 6 4.5v3.14L.342 9.526A.5.5 0 0 0 0 10v5.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V14h1v1.5a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5zM2 11h1v1H2zm2 0h1v1H4zm-1 2v1H2v-1zm1 0h1v1H4zm9-10v1h-1V3zM8 5h1v1H8zm1 2v1H8V7zM8 9h1v1H8zm2 0h1v1h-1zm-1 2v1H8v-1zm1 0h1v1h-1zm3-2v1h-1V9zm-1 2h1v1h-1zm-2-4h1v1h-1zm3 0v1h-1V7zm-2-2v1h-1V5zm1 0h1v1h-1z"/>
                        </svg>
                        <h5 class="card-title">DUDI</h5>
                        <h5 class="card-text">{{ $jumlahDudi }}</h5>
                    </div>
                </div>
            </div>
        
            <div class="col-6 col-md-4 col-lg-3 mb-4">
                <div class="card text-white bg-primary mb-3 square-card custom-shadow" style="background-color: #439AC7 !important;">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-map-fill" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M16 .5a.5.5 0 0 0-.598-.49L10.5.99 5.598.01a.5.5 0 0 0-.196 0l-5 1A.5.5 0 0 0 0 1.5v14a.5.5 0 0 0 .598.49l4.902-.98 4.902.98a.5.5 0 0 0 .196 0l5-1A.5.5 0 0 0 16 14.5zM5 14.09V1.11l.5-.1.5.1v12.98l-.402-.08a.5.5 0 0 0-.196 0zm5 .8V1.91l.402.08a.5.5 0 0 0 .196 0L11 1.91v12.98l-.5.1z"/>
                        </svg>
                        <h5 class="card-title">Pembimbing</h5>
                        <h5 class="card-text">{{ $jumlahPembimbing }}</h5>
                    </div>
                </div>
            </div>
        </div>
        
    </div>

    <br>
    
    <div id="tentang-pkl" class="text-center mb-5" data-aos="fade-up">
        <h3>Tentang PKL</h3>
        <br>
        <p>
            Praktek Kerja Lapangan (PKL) adalah kegiatan belajar di luar kelas yang dilakukan oleh siswa di tempat kerja tertentu. 
            PKL merupakan salah satu kegiatan yang wajib dilakukan oleh siswa SMK. Kegiatan ini dilakukan untuk memberikan pengalaman 
            kerja kepada siswa agar mereka dapat mengetahui dan memahami dunia kerja secara langsung. Selain itu, PKL juga bertujuan 
            untuk mengembangkan sikap, keterampilan, dan kemampuan siswa dalam bidang tertentu
        </p>
        <br>
        <br>
        <div class="logo-container">
            <div class="d-flex justify-content-start logo-scroll">
                <img src="{{ asset('image/logo-telkom-indonesia.jpg') }}" alt="Logo 1" class="img-fluid mx-2" style="width: 100px; height: auto;">
                <img src="{{ asset('image/logo-telkom-indonesia.jpg') }}" alt="Logo 2" class="img-fluid mx-2" style="width: 100px; height: auto;">
                <img src="{{ asset('image/logo-telkom-indonesia.jpg') }}" alt="Logo 3" class="img-fluid mx-2" style="width: 100px; height: auto;">
                <img src="{{ asset('image/logo-telkom-indonesia.jpg') }}" alt="Logo 4" class="img-fluid mx-2" style="width: 100px; height: auto;">
                <img src="{{ asset('image/logo-telkom-indonesia.jpg') }}" alt="Logo 5" class="img-fluid mx-2" style="width: 100px; height: auto;">
                <img src="{{ asset('image/logo-telkom-indonesia.jpg') }}" alt="Logo 6" class="img-fluid mx-2" style="width: 100px; height: auto;">
                <img src="{{ asset('image/logo-telkom-indonesia.jpg') }}" alt="Logo 7" class="img-fluid mx-2" style="width: 100px; height: auto;">
                <img src="{{ asset('image/logo-telkom-indonesia.jpg') }}" alt="Logo 8" class="img-fluid mx-2" style="width: 100px; height: auto;">
                <img src="{{ asset('image/logo-telkom-indonesia.jpg') }}" alt="Logo 9" class="img-fluid mx-2" style="width: 100px; height: auto;">
                <img src="{{ asset('image/logo-telkom-indonesia.jpg') }}" alt="Logo 10" class="img-fluid mx-2" style="width: 100px; height: auto;">
                <img src="{{ asset('image/logo-telkom-indonesia.jpg') }}" alt="Logo 11" class="img-fluid mx-2" style="width: 100px; height: auto;">
                <img src="{{ asset('image/logo-telkom-indonesia.jpg') }}" alt="Logo 12" class="img-fluid mx-2" style="width: 100px; height: auto;">
            </div>
        </div>             
    </div>

    <br>
    <br>
    <div id="sistem-pkl" class="text-center mb-5" data-aos="fade-up">
        <h3>Sistem PKL</h3>
        <br>
        <p>Sistem PKL adalah sistem yang digunakan untuk mempermudah dalam monitoring kegiatan PKL Siswa</p>
        <br>
        <div class="row justify-content-center mt-3 mb-3">
            <div class="col-md-3 mb-3 custom-spacing" >
                <a href="{{ route('login') }}" class="btn  btn-lg w-100 d-flex align-items-center justify-content-center sistem-card custom-shadow" alt="Sistem PKL" style="background-color: #439AC7 !important; color: white;">
                    <i class="bi bi-person-fill me-2"></i>
                    <span class="ps-3">MANDIRI</span>
                </a>
            </div>
            <div class="col-md-3 mb-3 custom-spacing">
                <a href="{{ route('login') }}" class="btn  btn-lg w-100 d-flex align-items-center justify-content-center sistem-card custom-shadow" alt="Sistem PKL" style="background-color: #439AC7 !important; color: white;">
                    <i class="bi bi-bounding-box-circles me-2"></i> 
                    <span class="ps-3">PEMETAAN</span>
                </a>
            </div>
        </div>           
    </div>

    <br>
    {{-- <div id="tim-pkl" class="text-center mb-5" data-aos="fade-up">
        <h3>Tim PKL</h3>
        <br>
        <br>
        <div class="row">
            <div class="col-md-3 mb-3">
                <div class="card custom-card">
                    <img src="{{ asset('image/tim-pkl-1.jpg') }}" class="card-img-top" alt="Tim PKL">
                    <div class="card-body">
                        <h5 class="card-title">Daryati, S.Pd</h5>
                        <p class="card-text">Peran</p>
                    </div>
                </div>
            </div>                                    
            <div class="col-md-3 mb-3">
                <div class="card custom-card">
                    <img src="{{ asset('image/tim-pkl-1.jpg') }}" class="card-img-top" alt="Tim PKL">
                    <div class="card-body">
                        <h5 class="card-title">Daryati, S.Pd</h5>
                        <p class="card-text">Peran</p>
                    </div>
                </div>
            </div>  
            <div class="col-md-3 mb-3">
                <div class="card custom-card">
                    <img src="{{ asset('image/tim-pkl-1.jpg') }}" class="card-img-top" alt="Tim PKL">
                    <div class="card-body">
                        <h5 class="card-title">Daryati, S.Pd</h5>
                        <p class="card-text">Peran</p>
                    </div>
                </div>
            </div>  
            <div class="col-md-3 mb-3">
                <div class="card custom-card">
                    <img src="{{ asset('image/tim-pkl-1.jpg') }}" class="card-img-top" alt="Tim PKL">
                    <div class="card-body">
                        <h5 class="card-title">Daryati, S.Pd</h5>
                        <p class="card-text">Peran</p>
                    </div>
                </div>
            </div>  
        </div>
    </div> --}}
</div>
<br>
<br>

@include('layouts.footer')
@endsection