@extends('layouts.headerpembimbing')

@section('content')

<div class="container mt-5 table-wrapper"> 
    <div style="background-color: #ffffff; border-radius: 10px; padding: 30px;">
        <div class="d-flex justify-content-start mb-3">
            <button onclick="window.location.href='{{ route('monitoring') }}'" style="background-color: #439AC7; color: #ffffff; border: none; padding: 5px 10px; border-radius: 5px;">
                <i class="bi bi-arrow-left"></i> Kembali
            </button>
        </div>
        
        <h2 class="text-center mt-2">Monitoring Per Siswa</h2>
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


        <div style="max-width: 60%;">
            <a href="https://docs.google.com/spreadsheets/d/1ixFmfIjuGmFTpitBjiFNhmhUmnBDza9Z/edit?usp=sharing&ouid=103935379902975604390&rtpof=true&sd=true" 
            class="custom-btn" style="background-color: #87A2FF; border-radius: 5px; color: white; padding: 10px 20px; text-decoration: none; display: center; font-weight: bold;">
                Template Monitoring Siswa 
            </a>
            <br>
            <br>
            
            <!-- Bagian untuk tabel Monitoring -->
            <table class="table-striped custom-table">
                <thead class="table-primary text-center">
                    <tr>
                        <th>Bulan</th>         
                        <th>Monitoring</th>
                        <th>Ket</th>
                    </tr>
                </thead>
                <tbody id="data-table">
                    @for ($i = 0; $i < 6; $i++)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>
                                @if(isset($monitoringPerSiswa[$i]))
                                    <!-- Jika data sudah ada, tampilkan -->
                                    <form class="mt-2" method="POST" action="{{ route('monitoring.upload', ['nis' => $nis]) }}" enctype="multipart/form-data" id="upload-form">
                                        @csrf
                                        <label for="file{{ $i }}" class="btn bi bi-file-earmark" style="background-color: #60d8aa; border-radius: 5px; color: white;"> Uploaded </label>
                                        <input id="file{{ $i }}" type="file" name="file" class="d-none" disabled>
                                    </form>
                                @else
                                    <!-- Jika belum ada, tampilkan form upload -->
                                    <form class="mt-2" method="POST" action="{{ route('monitoring.upload', ['nis' => $nis]) }}" enctype="multipart/form-data" id="upload-form">
                                        @csrf
                                        <label for="file{{ $i }}" class="btn bi bi-file-earmark" style="background-color: #9173c3; border-radius: 5px; color: white;"> Upload </label>
                                        <input id="file{{ $i }}" type="file" name="file" class="d-none" onchange="handleFileUpload(this)">
                                    </form>
                                @endif
                            </td>
                            <td>
                                <input type="checkbox" id="checkbox{{ $i }}" name="check[]" value="{{ $i + 1 }}" {{ isset($monitoringPerSiswa[$i]) ? 'checked' : '' }} disabled>
                            </td>                    
                        </tr>
                    @endfor
                </tbody>
            </table>
        </div>

        <h4 class="mt-5 text-left">Detail Monitoring</h4><br>
        <table class="table-striped custom-table">
            <thead class="table-primary text-center">
                <tr>
                    <th>Bulan</th>
                    <th>TP1 (Soft Skills)</th>
                    <th>TP2 (Norma & POS)</th>
                    <th>TP3 (Kompetensi Teknis)</th>
                    <th>TP4 (Wawasan Wirausaha)</th>
                    <th>Nilai</th>
                </tr>
            </thead>

            <tbody>
                 @foreach ($monitoringPerSiswa as $data)
                <tr>
                    <td>{{ $loop->iteration }}</td> 
                    <td>{{ $data->nilai_tp1 }}</td>
                    <td>{{ $data->nilai_tp2 }}</td>
                    <td>{{ $data->nilai_tp3 }}</td>
                    <td>{{ $data->nilai_tp4 }}</td>
                    <td>{{ $data->nilai_monitoring }}</td>
                    {{-- <td>{{ $data->nilai_akhir }}</td> <!-- Ini akan tampil setelah 6x upload --> --}}
                </tr>
                @endforeach 
             </tbody>
            <tfoot>
                <tr>
                    {{-- <td colspan="5">Nilai Akhir Monitoring</td>
                    <td>{{ $monitoringPerSiswa->first()->nilai_akhir_monitoring ?? 'N/A' }}</td> --}}
                    <td colspan="5">Nilai Akhir Monitoring</td>
                    <td>
                        @php
                            // Hitung jumlah nilai_monitoring saat ini
                            $totalNilaiMonitoring = $monitoringPerSiswa->sum('nilai_monitoring');
                            // Hitung rata-rata nilai monitoring saat ini
                            $jumlahUpload = $monitoringPerSiswa->count();
                            $nilaiAkhirMonitoring = $jumlahUpload > 0 ? $totalNilaiMonitoring / $jumlahUpload : 0;
                        @endphp
                        {{ number_format($nilaiAkhirMonitoring, 2) }}
                    </td>
                </tr> 
            </tfoot>
        </table>

        <br> <br>

        <div>
            <a href="{{ route('monitoring.export.excel', ['nis' => $siswa->NIS]) }}" class="btn btn-success">
                <i class="bi bi-file-earmark-excel"></i> Export Excel
            </a>
            <a href="{{ route('monitoring.export.pdf', ['nis' => $siswa->NIS]) }}" class="btn btn-danger">
                <i class="bi bi-file-earmark-pdf"></i> Export PDF
            </a>
        </div>
        <br>

    </div>
</div>

@endsection