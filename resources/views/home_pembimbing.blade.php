@extends('layouts.headerpembimbing')

@section('content')
<br>
<br>
    <div class="container">
        <div id="home_dudi" class="text-center mb-5" data-aos="fade-up">
            <br>
            <h3>DASHBOARD PEMBIMBING</h3>
            <br>
            <br>
            <div class="row justify-content-center mt-3 mb-3">
                <div class="col-md-3 mb-3 custom-spacing">
                    <a href="" class="btn btn-primary btn-lg w-100 h-70 d-flex align-items-center justify-content-center sistem-card custom-shadow" alt="Data Siswa">
                        <i class="bi bi-file-earmark-text"></i> 
                        <span class="ps-3">MONITORING PKL</span>
                    </a>
                </div>
                <div class="col-md-3 mb-3 custom-spacing">
                    <a href="" class="btn btn-primary btn-lg w-100 d-flex align-items-center justify-content-center sistem-card custom-shadow" alt="Guru Pembimbing">
                        <i class="bi bi-chat-left-text"></i> 
                        <span class="ps-3">NILAI SISWA PKL</span>
                    </a>
                </div>
                <div class="col-md-3 mb-3 custom-spacing">
                    <a href="" class="btn btn-primary btn-lg w-100 d-flex align-items-center justify-content-center sistem-card custom-shadow" alt="Guru Pembimbing">
                        <i class="bi bi-chat-left-text"></i> 
                        <span class="ps-3">EVALUASI PKL</span>
                    </a>
                </div>
            </div>
            <div class="row justify-content-center mt-5 mb-5">
                <div class="col-md-3 mb-3 custom-spacing">
                    <a href="" class="btn btn-primary btn-lg w-100 h-70 d-flex align-items-center justify-content-center sistem-card custom-shadow" alt="Data Siswa">
                        <i class="bi bi-file-earmark-text"></i> 
                        <span class="ps-3">LAPORAN AKHIR PKL</span>
                    </a>
                </div>
                <div class="col-md-3 mb-3 custom-spacing">
                    <a href="" class="btn btn-primary btn-lg w-100 d-flex align-items-center justify-content-center sistem-card custom-shadow" alt="Guru Pembimbing">
                        <i class="bi bi-chat-left-text"></i> 
                        <span class="ps-3">LAPORAN/JURNAL PKL</span>
                    </a>
                </div>
                <div class="col-md-3 mb-3 custom-spacing">
                    <a href="" class="btn btn-primary btn-lg w-100 d-flex align-items-center justify-content-center sistem-card custom-shadow" alt="Guru Pembimbing">
                        <i class="bi bi-chat-left-text"></i> 
                        <span class="ps-3">LAPORAN PENGIMBASAN</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
<br>
<br>
<br>


@include('layouts.footer')
@endsection