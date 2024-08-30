@extends('layouts.headersiswa')

@section('content')

<div class="container">
    <!-- Bagian Pengimbasan / Implementasi -->
    <div class="text-center mb-5">
        <h3>Pengimbasan / Implementasi</h3>
        <a href="#" class="text-primary">Template Pengimbasan</a>
        <table class="table table-bordered mt-3">
            <thead class="table-primary">
                <tr>
                    <th>No</th>
                    <th>Kelompok</th>
                    <th>NIS</th>
                    <th>Nama</th>
                    <th>Jurusan</th>
                    <th>Kelas</th>
                    <th>Tempat Dudi</th>
                    <th>Laporan Pengimbasan</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Tkj24/1</td>
                    <td>16034</td>
                    <td>Rulli Ardha Ramadhan</td>
                    <td>TKJ</td>
                    <td>TKJ 1</td>
                    <td>PT. Teknoraka Inovasi Nusantara</td>
                    <td>
                        <a href="#">Upload File <i class="bi bi-upload"></i></a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Bagian Laporan Akhir PKL -->
    <div class="text-center mb-5">
        <h3>Laporan Akhir PKL</h3>
        <a href="#" class="text-primary">Template Laporan Akhir</a>
        <table class="table table-bordered mt-3">
            <thead class="table-primary">
                <tr>
                    <th>No</th>
                    <th>Kelompok</th>
                    <th>NIS</th>
                    <th>Nama</th>
                    <th>Jurusan</th>
                    <th>Kelas</th>
                    <th>Tempat Dudi</th>
                    <th>Laporan Akhir</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Tkj24/1</td>
                    <td>16034</td>
                    <td>Rulli Ardha Ramadhan</td>
                    <td>TKJ</td>
                    <td>TKJ 1</td>
                    <td>PT. Teknoraka Inovasi Nusantara</td>
                    <td>
                        <a href="#">Upload File <i class="bi bi-upload"></i></a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Tombol Nilai PKL -->
    <div class="text-center mb-5">
        <a href="#" class="btn btn-primary btn-lg">Nilai PKL</a>
    </div>
</div>


@include('layouts.footer')
@endsection
