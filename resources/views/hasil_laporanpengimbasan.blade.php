@extends('layouts.headerpembimbing')

@section('content')

<div class="container mt-5 table-wrapper">
        <h4 class="text-center">LAPORAN PENGIMBASAN</h4>
        <br> <br>

        <form method="GET" action="{{ route('hasil_laporanpengimbasan') }}">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <select class="form-select d-inline-block w-auto" name="kode_kelompok">
                        <option selected value="">Kode Kelompok</option>
                        @foreach($kodeKelompokOptions as $kode_kel)
                            <option value="{{ $kode_kel }}">{{ $kode_kel }}</option>
                        @endforeach
                    </select>
                    
                    <select class="form-select d-inline-block w-auto" name="tahun">
                        <option selected value="">Tahun</option>
                        @foreach($tahunOptions as $tahun)
                            <option value="{{ $tahun }}">{{ $tahun }}</option>
                        @endforeach
                    </select>
                    
                    <select class="form-select d-inline-block w-auto" name="konsentrasi_keahlian">
                        <option selected value="">Konsentrasi Keahlian</option>
                        @foreach($konsentrasiOptions as $konsentrasi)
                            <option value="{{ $konsentrasi }}">{{ $konsentrasi }}</option>
                        @endforeach
                    </select>
                    
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </div>
        </form>
        

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
                    <td class="left-align">{{ $laporan->nama }}</td>
                    <td>{{ $laporan->konsentrasi_keahlian }}</td>
                    <td>{{ $laporan->kelas  }}</td>
                    <td>{{$laporan->tahun}}</td>

                    <td>
                        @if(!empty($laporan->laporan_pengimbasan))
                            <a href="{{ asset('storage/laporan_pengimbasan/' . $laporan->laporan_pengimbasan) }}" target="_blank"
                               style="background-color: #db9898;; color: white; padding: 5px 5px; border-radius: 5px; text-decoration: none; display: inline-flex; align-items: center;">
                                <span style="font-size: 0.9rem;">Lihat Laporan</span>
                            </a>
                        @else
                            Belum diunggah
                        @endif
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

    <div class="pagination-container" style="display: flex; justify-content: center; align-items: center;">
        <button class="pagination-btn" onclick="prevPage()" id="prev-btn" disabled>Sebelumnya</button>
        <div id="pagination-numbers" style="display: flex; gap: 10px; margin: 0 20px;">
            <!-- Angka halaman akan diisi dengan JavaScript -->
        </div>
        <button class="pagination-btn" onclick="nextPage()" id="next-btn">Selanjutnya</button>
    </div>

</div>


@endsection