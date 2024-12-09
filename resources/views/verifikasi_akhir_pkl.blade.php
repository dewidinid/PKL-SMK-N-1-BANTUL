@extends('layouts.headersiswa')

@section('content')
<br>
<br>
<div class="container table-wrapper">
    <div class="d-flex justify-content-start mb-3" style="margin-left: 20px;">
        <button onclick="window.location.href='{{ route('home_siswa') }}'" style="background-color: #439AC7; color: #ffffff; border: none; padding: 5px 10px; border-radius: 5px; margin-top: 10px;">
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
            <a href="https://docs.google.com/document/d/1pwCM780nlOwdchJ0b3rXhpdbUpW89_gt/edit?usp=sharing&ouid=103935379902975604390&rtpof=true&sd=true " 
                class="custom-btn" style="background-color: #F4A261; border-radius: 5px; color: white; padding: 10px 20px; text-decoration: none; display: center; font-weight: bold;">
                Template Laporan Pengimbasan
            </a>
        </div>
        <br>
    
        <div class="table-responsive">
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
                        <th>Lihat File</th>
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
                            <td>{{ $siswa->ploting->nama_dudi ?? 'Belum Ada' }}</td>
                            <td>
                                <form action="{{ route('upload_laporan') }}" method="POST" enctype="multipart/form-data" onsubmit="showAddingNotification()">
                                    @csrf
                                    <input type="file" name="laporan_pengimbasan" class="form-control mb-2" accept=".pdf,.doc,.docx">
                                    <button type="submit" class="btn btn-primary">Upload</button>
                                </form>
                            </td>
                            <td>
                                @if ($isLaporanPengimbasanUploaded && $laporanPengimbasanUrl)
                                    <a href="{{ $laporanPengimbasanUrl }}" target="_blank">Lihat File</a>
                                @else
                                    <span class="text-muted">Belum Upload</span>
                                @endif
                            </td>
                            <td>
                                <input type="checkbox" {{ $isLaporanPengimbasanUploaded ? 'checked' : '' }} disabled>
                                <span class="custom-checkbox"></span>
                            </td>
                        </tr>
                </tbody>            
            </table>
        </div>
    </div>
    
    <br>
    <br>
    <!-- Bagian Laporan Akhir PKL -->
    <div class="text-center mb-5">
        <h3>Laporan Akhir PKL</h3>
        <br>
        <br>
        <div class="text-start">
            <a href="https://docs.google.com/document/d/1oZWlK7EMudl40blQK7lvM5mSHMxHN5PL/edit?usp=sharing&ouid=103935379902975604390&rtpof=true&sd=true " 
                class="custom-btn" style="background-color: #F4A261; border-radius: 5px; color: white; padding: 10px 20px; text-decoration: none; display: center; font-weight: bold;">
                Template Laporan Akhir
            </a>
        </div>
        <br>
    
        <div class="table-responsive">
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
                        <th>Lihat File</th>
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
                            <td>{{ $siswa->ploting->nama_dudi ?? 'Belum Ada' }}</td>
                            <td>
                                <!-- Form untuk upload Laporan Akhir -->
                                <form action="{{ route('upload_laporan') }}" method="POST" enctype="multipart/form-data" onsubmit="showAddingNotification()">
                                    @csrf
                                    <input type="file" name="laporan_akhir" class="form-control mb-2" accept=".pdf,.doc,.docx">
                                    <button type="submit" class="btn btn-primary">Upload</button>
                                </form>
                            </td>
                            <td>
                                @if ($isLaporanAkhirUploaded && $laporanAkhirUrl)
                                    <a href="{{ $laporanAkhirUrl }}" target="_blank">Lihat File</a>
                                @else
                                    <span class="text-muted">Belum Upload</span>
                                @endif
                            </td>
                            <td>
                                <input type="checkbox" {{ $isLaporanAkhirUploaded ? 'checked' : '' }} disabled>
                                <span class="custom-checkbox"></span>
                            </td>
                        </tr>
                </tbody>
            </table>
        </div>
    </div>

    <br>
    <br>
    <!-- Tombol Nilai PKL -->
    <div class="text-center mb-5">
        @if ($isLaporanPengimbasanUploaded && $isLaporanAkhirUploaded)
            <a href="{{ route('lihatNilaiPkl') }}" class="btn btn-primary btn-lg">Lihat Nilai PKL</a>
        @else
            <button class="btn btn-secondary btn-lg" disabled>Nilai PKL</button>
        @endif
    </div>
      
</div>

@endsection
