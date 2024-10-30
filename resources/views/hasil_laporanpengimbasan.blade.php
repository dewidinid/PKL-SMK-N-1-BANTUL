@extends('layouts.headerpembimbing')

@section('content')

<div class="container mt-5 table-wrapper">
        <h4 class="text-center">LAPORAN PENGIMBASAN</h4>
        <br> <br>
        
    <!-- Filter Tahun dan konsentrasi_keahlian -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <form action="{{ route('hasil_laporanpengimbasan') }}" method="GET" class="mb-4">
            <div class="d-flex justify-content-between">
                <select class="form-select me-2" name="tahun" required>
                    <option value="">Pilih Tahun</option>
                    @foreach ($tahunOptions as $tahun)
                        <option value="{{ $tahun }}">{{ $tahun }}</option>
                    @endforeach
                </select>

                <select class="form-select" name="konsentrasi_keahlian" required>
                    <option value="">Pilih Konsentrasi Keahlian</option>
                    @foreach ($konsentrasiOptions as $konsentrasi)
                        <option value="{{ $konsentrasi }}">{{ $konsentrasi }}</option>
                    @endforeach
                </select>

                <button type="submit" class="btn btn-primary ms-2">Filter</button>
            </div>
        </form>
    </div>
    <table class="table-striped custom-table">
        <thead class="table-primary text-center">
            <tr>
                <th>No</th>
                <th>Kelompok</th>
                <th>NIS</th>
                <th>Nama</th>
                <th>Kompetensi Keahlian</th>
                <th>Kelas</th>
                <th>Tahun</th>
                <th style="font-size: 15px">Laporan Pengimbasan</th>
                <th>Approved</th>
                <th>Ket</th>
            </tr>
        </thead>
        <tbody id="data-table">
            @foreach ($laporanPengimbasan as $index => $laporan)
                <tr class="text-center">
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $laporan->kode_kelompok}}</td>
                    <td>{{ $laporan->NIS }}</td>
                    <td class="left-align">{{ $laporan->nama_siswa }}</td>
                    <td>{{ $laporan->siswa->konsentrasi_keahlian }}</td>
                    <td>{{ $laporan->kelas  }}</td>
                    <td>{{$laporan->siswa->tahun}}</td>
                    <td>
                        <a href="{{ asset('storage/laporan_pengimbasan/' . $laporan->laporan_pengimbasan) }}" ></a>
                            <button class="btn btn-link" style="background-color: #F99417; color: white; padding: 5px 5px; border-radius: 5px; text-decoration: none; display: inline-flex; align-items: center;">
                                Lihat Laporan
                                <i class="bi bi-view" style="font-size: 1rem; margin-left: 5px;"></i>
                            </button>
                        </a> 
                    </td>
                    <td>
                        @if($laporan->approved)
                            <span class="badge bg-success">Approved</span>
                        @else
                            <form action="{{ route('approve_laporanpengimbasan') }}" method="POST">
                                @csrf
                                <input type="hidden" name="NIS" value="{{ $laporan->NIS }}">
                                <button type="submit" class="btn btn-primary" onclick="handleApprove(this); return false;">Approve</button>
                            </form>
                        @endif
                    </td>
                    <td>
                        <input type="checkbox" {{ $laporan->approved ? 'checked' : '' }} disabled>
                    </td>
                </tr>
            @endforeach                        
        </tbody> 
    </table>

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


@endsection