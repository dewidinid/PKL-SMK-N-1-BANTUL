@extends('layouts.headerdudi')


@section('content')
<br>

<div class="container mt-5">

    <div style="background-color: #ffffff; border-radius: 10px; padding: 30px;">
        <h4 class="text-center">NILAI PKL SISWA</h4> 
        <br>

        <div class="row">
                <a class="col text-start mt-3" href="#" class="btn btn-link">Template Nilai PKL</a>
            <div class="col text-end">
                <select class="form-select d-inline-block w-auto" name="tahun">
                    <option selected>Tahun</option>
                    <!-- Tambahkan opsi tahun -->
                </select>
                <select class="form-select d-inline-block w-auto" name="konsentrasi_keahlian">
                    <option selected>Konsentrasi Keahlian</option>
                    <!-- Tambahkan opsi konsentrasi_keahlian -->
                </select>
            </div>
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
                    <th>Tahun</th>
                    <th>Nilai</th>
                    <th>Import</th>
                    <th>Ket</th>
                </tr>
            </thead>
            <tbody>
                {{-- @foreach($students as $student) --}}
                    <tr>
                        {{-- <td>{{ $index + 1 }}</td>
                        <td>{{ $student->NIS }}</td>
                        <td>{{ $student->nama_siswa }}</td>
                        <td>{{ $student->konsentrasiKeahlian->nama_konsentrasi }}</td>
                        <td>{{ $student->kelas }}</td>
                        <td>{{ $student->tahun }}</td> --}}
                        <td style="text-align: center; vertical-align: middle;">
                            {{-- <form id="upload-form" action="{{ route('import_excel') }}" method="POST" enctype="multipart/form-data"> --}}
                                @csrf
                                <label for="file-upload" class="btn btn-primary d-flex align-items-center mt-2" style="background-color: #0275db; padding: 6px; border: none; border-radius: 5px;">
                                    Upload
                                </label>
                                <input id="file-upload" type="file" name="file" class="d-none" onchange="handleFileUpload()">
                            </form>
                        </td>
                        
                        <td style="text-align: center; vertical-align: middle;">
                            <button id="import-btn" class="custom-btn d-flex align-items-center" style="background-color: #F99417;" disabled onclick="handleImport()">
                                Import
                            </button>
                        </td>
                        
                        <td class="text-center">
                            <input id="checkbox" type="checkbox" name="check[]" value="1" >
                        </td>                        
                    </tr>
                {{-- @endforeach --}}
            
                <tr>
                    <td>1</td>
                    <td>16034</td>
                    <td class="left-align">Rulli Ardha Ramadhan</td>
                    <td>Teknik Komputer Jaringan</td>
                    <td>TKJ 1</td>
                    <td>2024/2025</td>

                    <td style="text-align: center; vertical-align: middle;">
                        <form id="upload-form" method="POST" enctype="multipart/form-data">
                            {{-- action="{{ route('upload-file') }}" --}}
                            @csrf
                            <label for="file-upload" class="btn btn-primary d-flex align-items-center mt-2" style="background-color: #0275db; padding: 6px; border: none; border-radius: 5px;">
                                Upload 
                            </label>
                            <input id="file-upload" type="file" name="file" class="d-none" onchange="handleFileUpload()">
                        </form>
                    </td>
                    <td style="text-align: center; vertical-align: middle;">
                        <button id="import-btn" class="custom-btn d-flex align-items-center " style="background-color: #F99417;" disabled onclick="handleImport()">
                            Import
                        </button>
                    </td>
                    <td class="text-center">
                        <input id="checkbox" type="checkbox" name="check[]" value="1">
                    </td>                
                </tr>
            </tbody>
        </table>
        <br>

        <h4 class="text-center mt-5">DETAIL NILAI</h4> <br>

        <div  style="max-height: 400px; overflow-y: scroll;">
            <table class="table-striped custom-table">
                <thead class="table-primary text-center">
                    <tr>
                        <th>No</th>
                        <th>NIS</th>
                        <th>Nama</th>
            
                        {{-- Looping untuk header dinamis dari Excel --}}
                        {{-- @foreach($headers as $header)
                            @if($header !== 'NIS' && $header !== 'Nama') <!-- Hindari kolom NIS/Nama ganda -->
                                <th>{{ $header }}</th>
                            @endif
                            @endforeach --}}

                        <th>Total Nilai</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @foreach ($nilai_pkl as $index => $row)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $row['NIS'] }}</td>
                        <td>{{ $row['Nama'] }}</td>
            
                        {{-- Looping untuk menampilkan nilai di kolom dinamis --}}
                        {{-- @foreach($headers as $header)
                            @if($header !== 'NIS' && $header !== 'Nama')
                                <td>{{ $row[$header] }}</td>
                            @endif
                            @endforeach
                         <td>{{ $row['Total Nilai'] }}</td>
                    </tr>
                    @endforeach  --}}
                </tbody>
            </table>
            
        </div>

        <br>
        <div class="mt-3 text-end">
            <a href="{{ route('export.detail.nilai.excel') }}" class="btn btn-success">Export Excel</a>
            <a href="{{ route('export.detail.nilai.pdf') }}" class="btn btn-danger">Export PDF</a>
        </div>           
    </div>
</div>


@endsection