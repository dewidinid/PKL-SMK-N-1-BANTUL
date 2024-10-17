@extends('layouts.headerpembimbing')

@section('content')

<div class="container mt-5 table-wrapper">
    
    <div style="background-color: #ffffff; border-radius: 10px; padding: 30px;">
        <div class="d-flex justify-content-start mb-3">
            <button onclick="window.history.back()" style="background-color: #0275d8; color: #ffffff; border: none; padding: 5px 10px; border-radius: 5px;">
                <i class="bi bi-arrow-left"></i> Kembali
            </button>
        </div>
        
        <h2 class="text-center mt-2">Monitoring</h2>
        <br>
        
        {{-- <div class="mt-4">
            <p><strong>NIS :</strong> {{ $siswa->NIS }}</p>
            <p><strong>Nama :</strong> {{ $siswa->nama_siswa }}</p>
            <p><strong>Konsentrasi Keahlian :</strong> {{ $siswa->konsentrasi_keahlian }}</p>
            <p><strong>Kelas :</strong> {{ $siswa->kelas }}</p>
            <p><strong>DUDI :</strong> {{ $siswa->nama_dudi }}</p>
        </div> --}}


        <div >
            <p><strong>NIS :</strong> 17672</p>
            <p><strong>Nama :</strong> Rulli Arhan</p>
            <p><strong>Konsentrasi Keahlian :</strong> Teknik Komputer Jaringan</p>
            <p><strong>Kelas :</strong> TKJ 1</p>
            <p><strong>DUDI :</strong> PT Telkom Indonesia</p>
        </div>

        <!-- Batas Lebar Tabel -->
        <div style="max-width: 60%;">
            <a href="#" class="btn btn-link">Template Monitoring PKL</a>
            <br>
            <table class="table-striped custom-table">
                <thead class="table-primary text-center">
                    <tr>
                        <th>Bulan</th>
                        <th>Monitoring</th>
                        <th>Import</th>
                        <th>Ket</th>
                    </tr>
                </thead>
                <tbody id="data-table">
                    @if(session('success'))
                        <div class="alert alert-success mt-3">
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- @foreach ($index = 1; $index <= 6; $index++) <!-- Looping 6 kali -->
                    <tr>
                        <td>Ke-{{ $index }}</td>
                        <td>
                            <form class="mt-2" method="POST" enctype="multipart/form-data" id="upload-form-{{ $index }}">
                                @csrf
                                <label for="file-upload-{{ $index }}" class="btn bi bi-file-earmark" style="background-color: #9173c3; border-radius: 5px;color: white;"> Upload </label>
                                <input id="file-upload-{{ $index }}" type="file" name="file" class="d-none" onchange="handleFileUpload({{ $index }})">
                            </form>
                        </td>
                        <td>
                            <button id="import-btn-{{ $index }}" class="custom-btn" style="background-color: #F99417; text-decoration: none; display: inline-flex; align-items: center;" disabled onclick="handleImport({{ $index }})">Import</button>
                        </td>
                        <td>
                            <input type="checkbox" id="checkbox-{{ $index }}" name="check[]" value="{{ $index }}" disabled>
                        </td>
                    </tr>
                    @endforeach --}}
                </tbody>
            </table>
        </div>
         <!-- End of max-width wrapper -->

        <h4 class="mt-5 text-left">Detail Monitoring</h4><br>
        <table class="table-striped custom-table">
            <thead class="table-primary text-center">
                <tr>
                    <th>Bulan</th>
                        {{-- @if(isset($headerNames))
                            @foreach($headerNames as $headerName)
                                <th>{{ $headerName }}</th>
                            @endforeach
                        @endif --}}
                    <th>Nilai</th>
                </tr>
            </thead>
            <tbody id="data-table">
                {{-- @if(isset($excelData) && $excelData->count() > 0)
                        @foreach($excelData as $row)
                            <tr>
                                <td>{{ $row['Bulan'] ?? '-' }}</td>
                                @foreach($headerNames as $headerName)
                                    <td>{{ $row[$headerName] ?? '-' }}</td>
                                @endforeach
                                <td>{{ $row['Nilai'] ?? '-' }}</td>
                            </tr>
                        @endforeach
                @endif --}}
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="5">Total Nilai</td>
                    {{-- <td>{{ $totalNilai }}</td> --}}
                </tr>
                <tr>
                    <td colspan="5">Rata-Rata</td>
                    {{-- <td>{{ $rataRata }}</td> --}}
                </tr>
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

        
           