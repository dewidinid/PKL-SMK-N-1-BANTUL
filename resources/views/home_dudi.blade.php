@extends('layouts.headerdudi')

@section('content')

<div class="container table-wrapper">
    <!-- Main Content -->
        <div id="home_dudi" class="text-center mb-5" data-aos="fade-up">
            <br>
            <h3>DASHBOARD DUDI</h3>
            <br>
            <br>
            <div class="container-kolom-info">
                <div class="box-kolom">
                    <a href="{{ route('nilai_pkl') }}" class="box-kolom-link">
                        <div class="card-kolom">
                            <div class="icon-kolom" style="background-color: #c9a3f2;">
                                <i class="bi bi-people-fill"></i>
                            </div>
                            <div class="content-kolom">
                                <p>Siswa</p>
                                <h3>112.000</h3>
                            </div>
                        </div>
                    </a>
                    <div class="card-kolom">
                        <div class="icon-kolom" style="background-color: rgb(228, 225, 165);">
                            <i class="bi bi-file-earmark-text"></i>
                        </div>
                        <div class="content-kolom">
                            <h5>Nilai PKL Siswa</h5>
                            {{-- <h3 href="{{ route ('nilai_pkl')}}">Lihat Semua</h3> --}}
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
</div>

@endsection