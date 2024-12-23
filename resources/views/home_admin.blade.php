@extends('layouts.headeradmin')

@section('content')

@auth
    <div class="container">
        <!-- Main Content -->
            <div id="home_admin" class="text-center mb-5" data-aos="fade-up">
                <br>
                <h3>DASHBOARD ADMIN</h3>
                <br>
                <br>
                <div class="box-info">
                    <a href="{{ route('data_siswa') }}" class="box-link">
                        <div class="card">
                            <div class="icon" style="background-color: #c9a3f2;">
                                <i class="bi bi-people-fill"></i>
                            </div>
                            <div class="content">
                                <p>Siswa</p>
                                <h3>{{ $jumlahSiswa }}</h3>
                            </div>
                        </div>
                    </a>
                    
                    <a href="{{ route('guru_pembimbing') }}" class="box-link">
                        <div class="card">
                            <div class="icon" style="background-color: #a3c8f2;">
                                <i class="bi bi-person-rolodex "></i>
                            </div>
                            <div class="content">
                                <p>Guru Pembimbing</p>
                                <h3>{{ $jumlahPembimbing }}</h3>
                            </div>
                        </div>
                    </a>
                
                    <a href="{{ route('data_mitradudi') }}" class="box-link">
                        <div class="card">
                            <div class="icon" style="background-color: #a3f2c9;">
                                <i class="bi bi-buildings"></i>
                            </div>
                            <div class="content">
                                <p>Mitra Dudi</p>
                                <h3>{{ $jumlahDudi }}</h3>
                            </div>
                        </div>
                    </a>
                </div>
                <br>
                <br>
                <div class="box-info">
                    <a href="{{ route ('suratPengajuan')}}" class="box-link">
                        <div class="card">
                            <div class="icon" style="background-color: rgb(228, 225, 165);">
                                <i class="bi bi-envelope"></i>
                            </div>
                            <div class="content">
                                <h4>Surat Pengajuan Mandiri</h4>
                            </div>
                        </div>
                    </a>
                    <a href="{{ route ('ploting_siswa')}}" class="box-link">
                        <div class="card">
                            <div class="icon" style="background-color: #db9898;">
                                <i class="bi bi-diagram-3"></i>
                            </div>
                            <div class="content">
                                <h4>Ploting Siswa</h4>
                            </div>
                        </div>
                    </a>
                    <a href="{{ route ('report_siswa')}}" class="box-link">
                        <div class="card">
                            <div class="icon"  style="background-color: #e4a0da;">
                                <i class="bi bi-clipboard-check"></i>
                            </div>
                            <div class="content">
                                <h4>Report Siswa</h4>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
    </div>
@else
    <p>Silakan login untuk mengakses halaman ini.</p>
@endauth

@endsection