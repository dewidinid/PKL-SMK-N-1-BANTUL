@extends('layouts.headersiswa')

@section('content')
<br>
<br>
<div class="container table-wrapper">

    <!-- Bagian Pengimbasan / Implementasi -->
    <div class="text-center mb-5">
        <h3>Pengimbasan / Implementasi</h3>
        <br>
        <br>
        <div class="text-start">
            <a href="#" class="text-primary">Template Pengimbasan</a>
        </div>
    
        <table class="table-striped custom-table">
            <thead class="table-primary text-center">
                <tr>
                    <th>No</th>
                    <th>Kelompok</th>
                    <th>NIS</th>
                    <th>Nama</th>
                    <th>Konsentrasi Keahlian</th>
                    <th>Kelas</th>
                    <th>Tempat Dudi</th>
                    <th>Laporan Pengimbasan</th>
                    <th>Keterangan</th> <!-- Tambahkan kolom Keterangan -->
                </tr>
            </thead>
            <tbody id="data-table">
                <tr>
                    {{-- <td>{{ $index + 1 }}</td>
                    <td>{{ $siswa->kelompok }}</td>
                    <td>{{ $siswa->NIS }}</td>
                    <td>{{ $siswa->nama_siswa }}</td>
                    <td>{{ $siswa->konsentrasi_keahlian }}</td>
                    <td>{{ $siswa->kelas }}</td>
                    <td>{{ $siswa->nama_dudi }}</td> --}}
                    <td>
                        <!-- Form untuk upload file -->
                        {{-- <form action="{{ route('uploadLaporanPengimbasan') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="laporan_pengimbasan" class="form-control mb-2">
                            <button type="submit" class="btn btn-primary">Upload</button>
                        </form>
    
                        @if (session('success'))
                        <div class="alert alert-success mt-2">
                            {{ session('success') }}
                        </div>
                        @endif --}}
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
    
        <table class="table-striped custom-table">
            <thead class="table-primary text-center">
                <tr>
                    <th>No</th>
                    <th>Kelompok</th>
                    <th>NIS</th>
                    <th>Nama</th>
                    <th>Konsentrasi Keahlian</th>
                    <th>Kelas</th>
                    <th>Tempat Dudi</th>
                    <th>Laporan Akhir</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody id="data-table">
                <tr>
                    {{-- <td>{{ $index + 1 }}</td>
                    <td>{{ $siswa->kelompok }}</td>
                    <td>{{ $siswa->NIS }}</td>
                    <td>{{ $siswa->nama_siswa }}</td>
                    <td>{{ $siswa->konsentrasi_keahlian }}</td>
                    <td>{{ $siswa->kelas }}</td>
                    <td>{{ $siswa->nama_dudi }}</td> --}}
                    <td>
                        <!-- Form untuk upload Laporan Akhir -->
                        {{-- <form action="{{ route('uploadLaporanAkhir') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="laporan_akhir" class="form-control mb-2">
                            <button type="submit" class="btn btn-primary">Upload</button>
                        </form>
    
                        @if (session('success_laporan_akhir'))
                        <div class="alert alert-success mt-2">
                            {{ session('success_laporan_akhir') }}
                        </div>
                        @endif --}}
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
    <!-- Tombol Nilai PKL -->
    <div class="text-center mb-5">
        {{-- @if ($isLaporanPengimbasanUploaded && $isLaporanAkhirUploaded) --}}
            <button href="" class="btn btn-primary btn-lg" disabled>Nilai PKL</button>
            {{-- route('previewNilaiPkl', ['nis' => $siswa->nis])  --}}
            {{-- <button class="btn btn-primary btn-lg" >Nilai PKL</button> --}}
        {{-- @endif --}}
    </div>
    
</div>


@endsection
