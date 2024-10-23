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
            <a href="https://docs.google.com/spreadsheets/d/1ixFmfIjuGmFTpitBjiFNhmhUmnBDza9Z/edit?usp=sharing&ouid=103935379902975604390&rtpof=true&sd=true">Template Monitoring PKL</a> <br>
            <br>
            <table class="table-striped custom-table">
                <thead class="table-primary text-center">
                    <tr>
                        <th>Bulan</th>         
                        <th>Monitoring</th>
                        <th>Ket</th>
                    </tr>
                </thead>

                <tbody id="data-table">
                    @foreach ($monitoring as $index => $data)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            <form class="mt-2" method="POST" action="{{ route('monitoring.upload', ['nis' => $siswa->NIS]) }}" enctype="multipart/form-data" id="upload-form">
                                @csrf
                                <label for="file" class="btn bi bi-file-earmark" style="background-color: #9173c3; border-radius: 5px;color: white;"> Upload </label>
                                <input id="file" type="file" name="file" class="d-none" onchange="handleFileUpload(this)">
                            </form>
                        </td>
                        <td>
                            <input type="checkbox" id="checkbox" name="check[]" value="{{ $index + 1 }}" {{ $data->nilai_tp1 ? 'checked' : '' }} disabled>
                        </td>                    
                    </tr>
                    @endforeach
                </tbody>

                <tbody id="data-table">
                    @if(session('success'))
                        <div class="alert alert-success mt-3">
                            {{ session('success') }}
                        </div>
                    @endif
                    <tr>
                        <td>Ke-2</td>
                        <td>
                            <form class="mt-2" method="POST" action="{{ route('monitoring.upload', ['nis' => $siswa->NIS]) }}" enctype="multipart/form-data" id="upload-form">
                                @csrf
                                <label for="file" class="btn bi bi-file-earmark" style="background-color: #9173c3; border-radius: 5px;color: white;"> Upload </label>
                                <input id="file" type="file" name="file" class="d-none" onchange="this.form.submit()">
                            </form>
                        </td>
                        <td>
                            <input type="checkbox" id="checkbox" name="check[]" value="1" disabled>
                        </td>
                    </tr>

                    <tr>
                        <td>Ke-2</td>
                        <td style="display: flex; justify-content: center; align-items: center;">
                            <form method="POST" action="{{ route('monitoring.upload', ['nis' => $siswa->NIS]) }}" enctype="multipart/form-data" id="upload-form" style=" align-items: center;">
                                @csrf
                                <label for="file" class="btn bi bi-file-earmark" style="background-color: #9173c3; border-radius: 5px; color: white;  align-items: center;" >
                                    Upload
                                </label>
                                <input id="file" type="file" name="file" style="display: none;" onchange="this.form.submit()">
                            </form>
                        </td>
                        <td>
                            <input type="checkbox" id="checkbox" name="check[]" value="1" disabled>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
         <!-- End of max-width wrapper -->

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
                @php
                    $total_tp1 = 0;
                    $total_tp2 = 0;
                    $total_tp3 = 0;
                    $total_tp4 = 0;
                    $total_nilai_akhir = 0;
                @endphp

                @foreach ($monitoring as $data)
                <tr>
                    <td>{{ $loop->iteration }}</td> <!-- Menampilkan urutan bulan -->
                    <td>{{ $data->nilai_tp1 }}</td>
                    <td>{{ $data->nilai_tp2 }}</td>
                    <td>{{ $data->nilai_tp3 }}</td>
                    <td>{{ $data->nilai_tp4 }}</td>
                    <td>{{ $data->nilai_akhir }}</td>
                </tr>

                @php
                    // Hitung total untuk setiap TP
                    $total_tp1 += $data->nilai_tp1;
                    $total_tp2 += $data->nilai_tp2;
                    $total_tp3 += $data->nilai_tp3;
                    $total_tp4 += $data->nilai_tp4;
                    $total_nilai_akhir += $data->nilai_akhir;
                @endphp
                @endforeach

                <!-- Hitung rata-rata dari setiap TP -->
                @php
                    $rata_tp1 = $total_tp1 / $monitoring->count();
                    $rata_tp2 = $total_tp2 / $monitoring->count();
                    $rata_tp3 = $total_tp3 / $monitoring->count();
                    $rata_tp4 = $total_tp4 / $monitoring->count();
                    $rata_nilai_akhir = $total_nilai_akhir / $monitoring->count();

                    // Hitung nilai akhir
                    $nilai_akhir = $total_nilai_akhir / 6; // Total nilai akhir dibagi jumlah upload (6)
                @endphp

            </tbody>
            <tfoot>
                <tr>
                    <td>Total</td>
                    <td>{{ $total_tp1 }}</td>
                    <td>{{ $total_tp2 }}</td>
                    <td>{{ $total_tp3 }}</td>
                    <td>{{ $total_tp4 }}</td>
                    <td>{{ $total_nilai_akhir }}</td>
                </tr>
                <tr>
                    <td>Rata-Rata</td>
                    <td>{{ $rata_tp1 }}</td>
                    <td>{{ $rata_tp2 }}</td>
                    <td>{{ $rata_tp3 }}</td>
                    <td>{{ $rata_tp4 }}</td>
                    <td>{{ $rata_nilai_akhir }}</td>
                </tr>
                
                <tr>
                    <td colspan="5" style="text-align: center;">Nilai Akhir</td>
                    <td>{{ $nilai_akhir }}</td>
                </tr>

                {{-- <tr>
                    <td colspan="5">Total Nilai</td>
                    {{-- <td>{{ $totalNilai }}</td> --}}
                {{-- </tr>
                <tr> --}}
                    {{-- <td colspan="5">Rata-Rata</td> --}}
                    {{-- <td>{{ $rataRata }}</td> --}}
                {{-- </tr> --}} 
            </tfoot>
        </table>
        <br>
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
        <br>
    </div>
</div>

@endsection

        
           