@extends('layouts.headersiswa')

@section('content')
<br>
<br>
<div class="container table-wrapper">
    <div class="d-flex justify-content-start mb-3" style="margin-left: 20px;">
        <button onclick="window.location.href='{{ route('home_siswa') }}'" style="background-color: #0275d8; color: #ffffff; border: none; padding: 5px 10px; border-radius: 5px; margin-top: 10px;">
            <i class="bi bi-arrow-left"></i> Kembali
        </button>
    </div>
    <br>

    <!-- Bagian Pengimbasan / Implementasi -->
    <div class="text-center mb-5">
        <h3>Laporan Pengimbasan PKL</h3>
        <br>
        <br>
        <div class="text-start">
            <a href="#" class="text-primary">Template Pengimbasan</a>
        </div>
        <br>
    
        <table class="table-striped custom-table">
            <thead class="table-primary text-center">
                <tr>
                    <th>No</th>
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
                        <td>1</td>
                        <td>{{ $siswa->NIS }}</td>
                        <td>{{ $siswa->nama_siswa }}</td>
                        <td>{{ $siswa->konsentrasi_keahlian }}</td>
                        <td>{{ $siswa->kelas }}</td>
                        <td>{{ $siswa->nama_dudi }}</td>
                        <td>
                            <form action="{{ route('upload_laporan') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="file" name="laporan_pengimbasan" class="form-control mb-2" accept=".pdf,.doc,.docx">
                                <button type="submit" class="btn btn-primary">Upload</button>
                            </form>
                        </td>
                        <td>
                            <input type="checkbox" {{ $isLaporanPengimbasanUploaded ? 'checked' : '' }}>
                            <span class="custom-checkbox"></span>
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
        <br>
    
        <table class="table-striped custom-table">
            <thead class="table-primary text-center">
                <tr>
                    <th>No</th>
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
                        <td>1</td>
                        <td>{{ $siswa->NIS }}</td>
                        <td>{{ $siswa->nama_siswa }}</td>
                        <td>{{ $siswa->konsentrasi_keahlian }}</td>
                        <td>{{ $siswa->kelas }}</td>
                        <td>{{ $siswa->nama_dudi }}</td>
                        <td>
                            <!-- Form untuk upload Laporan Akhir -->
                            <form action="{{ route('upload_laporan') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="file" name="laporan_akhir" class="form-control mb-2" accept=".pdf,.doc,.docx">
                                <button type="submit" class="btn btn-primary">Upload</button>
                            </form>
                        </td>
                        <td>
                            <input type="checkbox" {{ $isLaporanAkhirUploaded ? 'checked' : '' }}>
                            <span class="custom-checkbox"></span>
                        </td>
                    </tr>
            </tbody>
        </table>
    </div>

    <br>
    <br>
    <!-- Tombol Nilai PKL -->
    <div class="text-center mb-5">
        @if ($isLaporanPengimbasanUploaded && $isLaporanAkhirUploaded && $isNilaiPklAvailable)
            <a href="{{ asset($nilaiPklFilePath) }}" target="_blank" class="btn btn-primary btn-lg">Nilai PKL</a>
        @else
            <button class="btn btn-secondary btn-lg" disabled>Nilai PKL</button>
        @endif
    </div>  
</div>
@endsection
