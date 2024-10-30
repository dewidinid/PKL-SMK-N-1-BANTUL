@extends('layouts.headerpembimbing')

@section('content')

<div class="container">
    <div id="home_pembimbing" class="text-center mb-5" data-aos="fade-up">
        <br> <br>
        <h3>DASHBOARD PEMBIMBING</h3>
        <br>
        <br>
        <div class="box-info">
            <a href="{{ route ('pembimbing_laporanjurnal')}}" class="box-link">
                <div class="card">
                    <div class="icon" style="background-color: #e4a0da;">
                        <i class="bi bi-chat-left-text fs-4"></i>
                    </div>
                    <div class="content">
                        <h4>Laporan/Jurnal PKL Siswa</h4>
                    </div>
                </div>
            </a>

            <a href="{{ route('monitoring') }}" class="box-link">
                <div class="card">
                    <div class="icon" style="background-color: #a3c8f2;">
                        <i class="bi bi-person-rolodex "></i>
                    </div>
                    <div class="content">
                        <h4>Monitoring PKL</h4>
                    </div>
                </div>
            </a>
        
            <a href="{{ route('hasil_nilaipkl') }}" class="box-link">
                <div class="card">
                    <div class="icon" style="background-color: #a3f2c9;">
                        <i class="bi bi-buildings"></i>
                    </div>
                    <div class="content">
                        <h4>Nilai PKL Siswa</h4>
                    </div>
                </div>
            </a>
        </div>
        <br>
        
        <div class="box-info">
            <a href="{{ route ('hasil_laporanakhir')}}" class="box-link">
                <div class="card">
                    <div class="icon" style="background-color: rgb(228, 225, 165);">
                        <i class="bi bi-clipboard-check"></i>
                    </div>
                    <div class="content">
                        <h4>Laporan Akhir PKL</h4>
                    </div>
                </div>
            </a>

            <a href="{{ route ('hasil_laporanpengimbasan')}}" class="box-link">
                <div class="card">
                    <div class="icon" style="background-color: #db9898;">
                        <i class="bi bi-journal-text"></i>
                    </div>
                    <div class="content">
                        <h4>Laporan Pengimbasan</h4>
                    </div>
                </div>
            </a>

            <a href="{{ route('evaluasi') }}" class="box-link">
                <div class="card">
                    <div class="icon" style="background-color: #c9a3f2;">
                        <i class="bi bi-people-fill"></i>
                    </div>
                    <div class="content">
                        <h4>Evaluasi PKL</h4>
                    </div>
                </div>
            </a>
        </div>
        <br>
    </div>
</div>

@endsection