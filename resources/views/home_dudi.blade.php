@extends('layouts.headerdudi')

@section('content')

@auth
    <div class="container table-wrapper">
        <!-- Main Content -->
            <div id="home_dudi" class="text-center mb-5" data-aos="fade-up">
                <br>
                <h3>DASHBOARD DUDI</h3>
                <br>
                <br>
                <div class="container-kolom-info">
                    <div class="box-kolom">
                        <a href="{{ route ('daftar_siswa_pkl')}}" class="box-link">
                            <div class="card-kolom">
                                <div class="icon-kolom" style="background-color: #c9a3f2;">
                                    <i class="bi bi-people-fill"></i>
                                </div>
                                <div class="content-kolom">
                                    <p>Siswa</p>
                                    <h3>{{ $jumlahSiswa }}</h3> 
                                </div>
                            </div>
                        </a>
                        <div class="card-kolom">
                            <div class="icon-kolom" style="background-color: rgb(228, 225, 165);">
                                <i class="bi bi-file-earmark-text"></i>
                            </div>
                            <div class="content-kolom">
                                <h5>Nilai PKL Siswa</h5>
                                <a href="{{ route ('nilai_pkl')}}" class="lihat-semua-kolom">Lihat Semua</a>
                            </div>
                        </div>
                    </div>
                    <div class="box-info">
                        <div class="box-table">
                            <br>
                            <h3 style="text-align: center">Laporan/Jurnal PKL Siswa</h3>
                            <br>
                            <br>
                            <table class="table-mini table-striped custom-mini-table">
                                <thead class="table-primary text-center">
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>NIS</th>
                                        <th id="nama">Nama</th>
                                        <th>Konsentrasi Keahlian</th>
                                        <th>Kegiatan</th>
                                        <th>Lokasi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($laporan_jurnal->isEmpty())
                                        <tr>
                                            <td colspan="7" class="text-center">Tidak ada data jurnal untuk hari ini.</td>
                                        </tr>
                                    @else
                                        @foreach ($laporan_jurnal as $index => $jurnal)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ \Carbon\Carbon::parse($jurnal->tanggal)->format('d/m/Y') }}</td>
                                                <td>{{ $jurnal->siswa->NIS }}</td>
                                                <td>{{ $jurnal->siswa->nama_siswa }}</td>
                                                <td>{{ $jurnal->konsentrasi_keahlian }}</td>
                                                <td>{{ $jurnal->kegiatan }}</td>
                                                <td>{{ $jurnal->lokasi }}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>                                                          
                            </table>
                            <br>
                            <div class="content" >
                                <a href="{{ route ('dudi_laporanjurnal')}}" class="lihat-semua" style="padding-top: 20px;">Lihat Semua</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
@else
    <p>Silakan login untuk mengakses halaman ini.</p>
@endauth

@endsection