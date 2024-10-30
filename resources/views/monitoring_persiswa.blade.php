@extends('layouts.headerpembimbing')

@section('content')

<div class="container mt-5 table-wrapper"> 
    <div style="background-color: #ffffff; border-radius: 10px; padding: 30px;">
        <div class="d-flex justify-content-start mb-3">
            <button onclick="window.history.back()" style="background-color: #0275d8; color: #ffffff; border: none; padding: 5px 10px; border-radius: 5px;">
                <i class="bi bi-arrow-left"></i> Kembali
            </button>
        </div>
        
        <h2 class="text-center mt-2">Monitoring Per Siswa</h2>
        <br>

        <div>
            <p><strong>NIS :</strong> {{ $siswa->NIS }}</p>
            <p><strong>Nama :</strong> {{ $siswa->nama_siswa }}</p>
            <p><strong>Konsentrasi Keahlian :</strong> {{ $siswa->konsentrasi_keahlian }}</p>
            <p><strong>Kelas :</strong> {{ $siswa->kelas }}</p>
            <p><strong>Nama DUDI :</strong> {{ $siswa->nama_dudi }}</p> <br>
        </div>

        <!-- Batas Lebar Tabel Monitoring -->
        <div style="max-width: 60%;">
            <a href="https://docs.google.com/spreadsheets/d/1f9_PpRN0Y_1BsYxjG7oTH0g0SiRBsbXc/edit?usp=drive_link&ouid=102059787068159879684&rtpof=true&sd=true" 
            class="custom-btn" style="background-color: #87A2FF; border-radius: 5px; color: white; padding: 10px 20px; text-decoration: none; display: center; font-weight: bold;">
             Template Upload Data Siswa </a>
            <br><br>
            
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
                    <th>Nilai TP 1</th>
                    <th>Nilai TP 2</th>
                    <th>Nilai TP 3</th>
                    <th>Nilai TP 4</th>
                    <th>Nilai</th>
                </tr>
            </thead>
            <tbody>
                 @foreach ($monitoringPerSiswa as $data)
                <tr>
                    <td>{{ $loop->iteration }}</td> <!-- Menampilkan urutan bulan -->
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
                    <td colspan="5">Nilai Akhir Monitoring</td>
                    {{-- <td>{{ $nilai_akhir_monitpring }}</td> --}}
                    <td>.</td>
                </tr> 
            </tfoot>
        </table>

        <br> <br>
        <div>
            <a href="" class="btn btn-success">
                {{--{{ route('monitoring.export.excel') }} , $siswa->NIS --}}
                <i class="bi bi-file-earmark-excel"></i> Export Excel
            </a>
            <a href="" class="btn btn-danger">
                {{-- {{ route('monitoring.export.pdf') }} , $siswa->NIS --}}
                <i class="bi bi-file-earmark-pdf"></i> Export PDF
            </a>
        </div>
        <br>

    </div>
</div>

@endsection