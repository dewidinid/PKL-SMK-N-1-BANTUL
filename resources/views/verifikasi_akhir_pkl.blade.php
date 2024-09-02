@extends('layouts.headersiswa')

@section('content')
<br>
<br>
<div class="container">

    <!-- Bagian Pengimbasan / Implementasi -->
    <div class="text-center mb-5">
        <h3>Pengimbasan / Implementasi</h3>
        <br>
        <br>
        <div class="text-start">
            <a href="#" class="text-primary">Template Pengimbasan</a>
        </div>
        
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
                    <th>Keterangan</th> <!-- Tambahkan kolom Keterangan -->
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
                        <!-- Form untuk upload file -->
                        <form action="" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="laporan_pengimbasan" class="form-control mb-2">
                            <button type="submit" class="btn btn-primary">Upload</button>
                        </form>
                        
                        @if (session('success'))
                        <div class="alert alert-success mt-2">
                            {{ session('success') }}
                        </div>
                        @endif
                    </td>
                    <td>
                        <!-- Checkbox untuk Keterangan, akan tercentang jika file sudah diupload -->
                        <input type="checkbox"  disabled>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    
    <br>
    <br>
    <!-- Bagian Laporan Akhir PKL -->
    <div class="text-center mb-5">
        <h3>Laporan Akhir PKL</h3>
        <br>
        <br>
        <div class="text-start">
            <a href="#" class="text-primary">Template Laporan Akhir</a>
        </div>

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
                    <th>Keterangan</th>
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
                        <!-- Form untuk upload Laporan Akhir -->
                        <form action="" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="laporan_akhir" class="form-control mb-2">
                            <button type="submit" class="btn btn-primary">Upload</button>
                        </form>
                        
                        @if (session('success_laporan_akhir'))
                        <div class="alert alert-success mt-2">
                            {{ session('success_laporan_akhir') }}
                        </div>
                        @endif
                    </td>
                    <td>
                        <!-- Checkbox untuk Keterangan, akan tercentang jika file sudah diupload -->
                        <input type="checkbox"  disabled>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    
    <br>
    <br>
    <!-- Tombol Nilai PKL -->
    <div class="text-center mb-5">
        {{-- @php
            $isLaporanPengimbasanUploaded = !empty(Auth::user()->laporan_pengimbasan);
            $isLaporanAkhirUploaded = !empty(Auth::user()->laporan_akhir);
        @endphp --}}

        {{-- @if ($isLaporanPengimbasanUploaded && $isLaporanAkhirUploaded)
            <a href="#" class="btn btn-primary btn-lg">Nilai PKL</a>
        @else --}}
            <button class="btn btn-primary btn-lg" disabled>Nilai PKL</button>
        {{-- @endif --}}
    </div>
</div>

@include('layouts.footer')
@endsection
