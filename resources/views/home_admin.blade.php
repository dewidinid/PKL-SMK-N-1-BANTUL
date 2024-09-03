@extends('layouts.header')

@section('content')
<title>HOME ADMIN</title>

<div id="sistem-pkl" class="text-center mb-5" data-aos="fade-up">
    <br>
    <h3>DASHBOARD ADMIN</h3>
    <br>
    <div class="row justify-content-center mt-3 mb-3">
        <div class="col-md-3 mb-3 custom-spacing">
            <a href="#" class="btn btn-primary btn-lg w-100 h-70 d-flex align-items-center justify-content-center sistem-card custom-shadow" alt="Data Siswa">
                <i class="bi bi-people-fill me-2"></i> 
                <span class="ps-3">DATA SISWA</span>
            </a>
        </div>
        <div class="col-md-3 mb-3 custom-spacing">
            <a href="#" class="btn btn-primary btn-lg w-100 d-flex align-items-center justify-content-center sistem-card custom-shadow" alt="Guru Pembimbing">
                <i class="bi bi-person-badge-fill me-2"></i> 
                <span class="ps-3">GURU PEMBIMBING</span>
            </a>
        </div>
        <div class="col-md-3 mb-3 custom-spacing">
            <a href="#" class="btn btn-primary btn-lg w-100 d-flex align-items-center justify-content-center sistem-card custom-shadow" alt="Ploting Siswa">
                <i class="bi bi-diagram-3-fill me-2"></i> 
                <span class="ps-3">PLOTING SISWA</span>
                <br>
            </a>
        </div>
        <br>
        <br>
        <div class="row justify-content-center mt-3 mb-3">
            <div class="col-md-3 mb-3 custom-spacing">
                <a href="#" class="btn btn-primary btn-lg w-100 d-flex align-items-center justify-content-center sistem-card custom-shadow" alt="Pengajuan PKL">
                    <i class="bi bi-envelope-fill me-2"></i> 
                    <span class="ps-3">SURAT PENGAJUAN PKL MANDIRI</span>
                </a>
            </div>
            <div class="col-md-3 mb-3 custom-spacing">
                <a href="#" class="btn btn-primary btn-lg w-100 d-flex align-items-center justify-content-center sistem-card custom-shadow" alt="Mitra Dudi">
                    <i class="bi bi-buildings-fill me-2"></i> 
                    <span class="ps-3">MITRA DUDI</span>
                </a>
            </div>
        </div>           
</div>
</div>
<br>

@include('layouts.footer')
@endsection