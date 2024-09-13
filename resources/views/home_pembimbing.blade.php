@extends('layouts.headerpembimbing')

@section('content')

<div class="container ">
    <div id="home_pembimbing" class="text-center mb-5" data-aos="fade-up">
        <br>
        <h3>DASHBOARD PEMBIMBING</h3>
        <br>
        <br>
        <div class="box-info">
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
        <br>
        <div class="box-info">
            <div class="box-ver">
                <div class="icon-ver" style="background-color: rgb(228, 225, 165);">
                    <i class="bi bi-clipboard-check"></i>
                </div>
                <div class="content">
                    <h3 style="text-align: left;">Laporan Akhir PKL</h3>
                    <a href="{{ route ('hasil_laporanakhir')}}" class="lihat-semua">Lihat Semua</a>
                </div>
            </div>
            <div class="box-ver">
                <div class="icon-ver" style="background-color: #db9898;">
                    <i class="bi bi-journal-text"></i>
                </div>
                <div class="content">
                    <h3 style="text-align: left;"> Laporan Pengimbasan</h3>
                    <a href="{{ route ('hasil_laporanpengimbasan')}}" class="lihat-semua">Lihat Semua</a>
                </div>
            </div>
        </div>
        <br>
        <br>
        <div class="box-info ">
            <div class="box-table " style="height: 350px">
                <br>
                <h3 style="text-align: center">Laporan/Jurnal PKL Siswa</h3>
                <br>
                <br>
                <br>
                <table class="table-striped custom-table">
                    <thead class="table-primary text-center">
                        <tr class="text-center" >
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>NIS</th>
                            <th>Nama</th>
                            <th>Jurusan</th>
                            <th>Tempat Dudi</th>
                            <th>Kegiatan/Progress</th>
                            <th>Lokasi</th>
                        </tr>
                    </thead>
                    <tbody id="data-table">
                        <!-- Data contoh, akan diisi dengan JavaScript -->
                        <tr>
                            <td>1</td>
                            <td>16/03/24</td>
                            <td>16034</td>
                            <td>Rulli Ardha Ramadhan</td>
                            <td>TKJ</td>
                            <td>PT. Teknorika Inovasi Nusantara</td>
                            <td>Membuat Flowchart</td>
                            <td>Yogyakarta</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>16/03/24</td>
                            <td>16034</td>
                            <td>Rulli Ardha Ramadhan</td>
                            <td>TKJ</td>
                            <td>PT. Teknorika Inovasi Nusantara</td>
                            <td>Membuat Flowchart</td>
                            <td>Yogyakarta</td>
                        </tr>
                    </tbody>
                    {{-- <tbody>
                        @foreach ($jurnals as $index => $jurnal)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ \Carbon\Carbon::parse($jurnal->tanggal)->format('d/m/Y') }}</td>
                                <td>{{ $jurnal->nis }}</td>
                                <td>{{ $jurnal->nama }}</td>
                                <td>{{ $jurnal->jurusan }}</td>
                                <td>{{ $jurnal->tempat_dudi }}</td>
                                <td>{{ $jurnal->kegiatan }}</td>
                                <td>{{ $jurnal->lokasi }}</td> lokasi menggunakan maps location
                            </tr>
                        @endforeach
                    </tbody> --}}
                </table>
                <br>
                <div class="content" >
                    <a href="{{ route ('dudi_laporanjurnal')}}" class="lihat-semua" style="padding-top: 20px;">Lihat Semua</a>
                </div>
            </div>
            
        </div>
    </div>
</div>

@endsection