@extends('layouts.headeradmin')

@section('content')
<br>
<br>
    <div class="container">
        <div id="home_admin" class="text-center mb-5" data-aos="fade-up">
            <br>
            <h3>DASHBOARD ADMIN</h3>
            <br>
            <br>
            <div class="row justify-content-center mt-3 mb-3">
                <div class="col-md-3 mb-3 custom-spacing">
                    <a href="#" class="btn btn-primary btn-lg w-100 h-70 d-flex align-items-center justify-content-center sistem-card custom-shadow" alt="Data Siswa">
                        <i class="bi bi-people-fill me-2"></i> 
                        <span class="ps-3">DATA SISWA</span>
                    </a>
                </div>
                <div class="col-md-3 mb-3 custom-spacing">
                    <a href="{{ route ('guru_pembimbing') }}" class="btn btn-primary btn-lg w-100 d-flex align-items-center justify-content-center sistem-card custom-shadow" alt="Guru Pembimbing">
                        <i class="bi bi-person-rolodex"></i> 
                        <span class="ps-3">GURU PEMBIMBING</span>
                    </a>
                </div>
                <div class="col-md-3 mb-3 custom-spacing">
                    <a href="#" class="btn btn-primary btn-lg w-100 d-flex align-items-center justify-content-center sistem-card custom-shadow" alt="Ploting Siswa">
                        <i class="bi bi-diagram-3"></i> 
                        <span class="ps-3">PLOTING SISWA</span>
                    </a>
                </div>
            </div>
            <div class="row justify-content-center mt-5 mb-5">
                <div class="col-md-3 mb-3 custom-spacing">
                    <a href="{{ route('suratPengajuan') }}" class="btn btn-primary btn-lg w-100 d-flex align-items-center justify-content-center sistem-card custom-shadow" alt="Pengajuan PKL">
                        <i class="bi bi-envelope"></i> 
                        <span class="ps-3">SURAT PENGAJUAN PKL MANDIRI</span>
                    </a>
                </div>
                <div class="col-md-3 mb-3 custom-spacing">
                    <a href="#" class="btn btn-primary btn-lg w-100 d-flex align-items-center justify-content-center sistem-card custom-shadow" alt="Mitra Dudi">
                        <i class="bi bi-buildings"></i> 
                        <span class="ps-3">MITRA DUDI</span>
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