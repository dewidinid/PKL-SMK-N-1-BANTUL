@extends('layouts.headerdudi')

@section('content')

<div class="container mt-5 table-wrapper">

    <div class="" style="background-color: #ffffff; border-radius: 10px; padding: 30px;">
        <div class="d-flex justify-content-start mb-3">
            <button onclick="window.location.href='{{ route('dudi_laporanjurnal') }}'" style="background-color: #439AC7; color: #ffffff; border: none; padding: 5px 10px; border-radius: 5px;">
                <i class="bi bi-arrow-left"></i> Kembali
            </button>
        </div>

        <h2 class="text-center">Laporan Jurnal Per Siswa</h2>
        <br>
        <br>

        <table class="student-info">
            <tr>
                <td><strong>NIS</strong></td>
                <td><strong>:</strong></td>
                <td>{{ $siswa->NIS }}</td>
            </tr>
            <tr>
                <td><strong>Nama</strong></td>
                <td><strong>:</strong></td>
                <td>{{ $siswa->nama_siswa }}</td>
            </tr>
            <tr>
                <td><strong>Konsentrasi Keahlian</strong></td>
                <td><strong>:</strong></td>
                <td>{{ $siswa->konsentrasi_keahlian }}</td>
            </tr>
            <tr>
                <td><strong>Kelas</strong></td>
                <td><strong>:</strong></td>
                <td>{{ $siswa->kelas }}</td>
            </tr>
            <tr>
                <td><strong>Kelompok</strong></td>
                <td><strong>:</strong></td>
                <td>{{ $siswa->kode_kelompok }}</td>
            </tr>
            <tr>
                <td><strong>Dudi</strong></td>
                <td><strong>:</strong></td>
                <td>{{ $siswa->nama_dudi }}</td>
            </tr>
        </table>
        
        <br>
        <br>

            <!-- Batas Lebar Tabel -->
            <div style="">
        
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <form action="{{ route('dudi_laporanjurnal_persiswa', $siswa->NIS) }}" method="GET">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <!-- Dropdown filter Bulan -->
                                <select class="form-select d-inline-block w-auto" name="bulan">
                                    <option value="">Pilih Bulan</option>
                                    @for ($i = 1; $i <= 12; $i++)
                                        <option value="{{ $i }}" {{ $bulan == $i ? 'selected' : '' }}>
                                            {{ \Carbon\Carbon::create()->month($i)->translatedFormat('F') }}
                                        </option>
                                    @endfor
                                </select>
                    
                                <!-- Dropdown filter Tahun -->
                                <select class="form-select d-inline-block w-auto" name="tahun">
                                    <option value="" disabled selected>Pilih Tahun</option>
                                    @foreach ($availableYears as $year)
                                        <option value="{{ $year }}" {{ $tahun == $year ? 'selected' : '' }}>
                                            {{ $year }}
                                        </option>
                                    @endforeach
                                </select>                                
                    
                                <!-- Tombol Submit -->
                                <button type="submit" class="btn btn-primary">Filter</button>
                            </div>
                        </div>
                    </form>
                    
                </div>
        
                <table class="table-striped custom-table">
                    <thead class="table-primary text-center">
                        <tr class="text-center" >
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Kegiatan/Progress</th>
                            <th>Lokasi</th>
                        </tr>
                        <br>
                    </thead>
                    <tbody id="data-table">
                        @forelse ($jurnals as $index => $jurnal)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ \Carbon\Carbon::parse($jurnal->tanggal)->format('d/m/Y') }}</td>
                                <td>{{ $jurnal->kegiatan }}</td>
                                <td>{{ $jurnal->lokasi }}</td> 
                            </tr>
                         @empty
                            <tr>
                                <td colspan="4">Tidak ada data jurnal untuk bulan dan tahun yang dipilih.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>       
            </div> <!-- End of max-width wrapper -->
        
            <br>
            <br>
            <br>
        
            <div class="pagination-container" style="display: flex; justify-content: center; align-items: center;">
                <button class="pagination-btn" onclick="prevPage()" id="prev-btn" disabled>Sebelumnya</button>
                <div id="pagination-numbers" style="display: flex; gap: 10px; margin: 0 20px;">
                    <!-- Angka halaman akan diisi dengan JavaScript -->
                </div>
                <button class="pagination-btn" onclick="nextPage()" id="next-btn">Selanjutnya</button>
            </div>
            
    </div>
</div>

@endsection