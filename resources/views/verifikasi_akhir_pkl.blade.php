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
                @forelse ($siswa as $index => $student)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $student->NIS }}</td>
                        <td>{{ $student->nama_siswa }}</td>
                        <td>{{ $student->konsentrasi_keahlian }}</td>
                        <td>{{ $student->kelas }}</td>
                        <td>{{ $student->nama_dudi }}</td>
                        <td>
                            <form action="{{ route('upload_laporan') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="file" name="laporan_pengimbasan" class="form-control mb-2" accept=".pdf,.doc,.docx">
                                <button type="submit" class="btn btn-primary">Upload Laporan Pengimbasan</button>
                            </form>
                        </td>
                        <td>
                            <input type="checkbox" {{ $isLaporanPengimbasanUploaded ? 'checked' : '' }} disabled>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">Tidak ada data siswa.</td>
                    </tr>
                @endforelse
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
                    @forelse ($siswa as $index => $student)
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $student->NIS }}</td>
                        <td>{{ $student->nama_siswa }}</td>
                        <td>{{ $student->konsentrasi_keahlian }}</td>
                        <td>{{ $student->kelas }}</td>
                        <td>{{ $student->nama_dudi }}</td>
                        <td>
                            <!-- Form untuk upload Laporan Akhir -->
                            <form action="{{ route('upload_laporan') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="file" name="laporan_akhir" class="form-control mb-2" accept=".pdf,.doc,.docx">
                                <button type="submit" class="btn btn-primary">Upload Laporan Akhir</button>
                            </form>
                        </td>
                        <td>
                            <input type="checkbox" {{ $isLaporanPengimbasanUploaded ? 'checked' : '' }} disabled>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">Tidak ada data siswa.</td>
                    </tr>
                @endforelse
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
