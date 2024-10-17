@extends('layouts.headeradmin')

@section('content')

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
                    <div class="box-ver">
                        <div class="icon-ver" style="background-color: rgb(228, 225, 165);">
                            <i class="bi bi-envelope"></i>
                        </div>
                        <div class="content">
                            <h3 style="text-align: left;">Surat Pengajuan PKL Mandiri</h3>
                            <a href="{{ route ('suratPengajuan')}}" class="lihat-semua">Lihat Semua</a>
                        </div>
                    </div>
                    <div class="box-ver">
                        <div class="icon-ver" style="background-color: #db9898;">
                            <i class="bi bi-diagram-3"></i>
                        </div>
                        <div class="content">
                            <h3 style="text-align: left;">Ploting Siswa</h3>
                            <a href="{{ route ('ploting_siswa')}}" class="lihat-semua">Lihat Semua</a>
                        </div>
                    </div>
                </div>
            </div>
</div>


@endsection