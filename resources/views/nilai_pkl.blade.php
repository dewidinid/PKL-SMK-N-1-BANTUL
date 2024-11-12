@extends('layouts.headerdudi')

@section('content')

<div class="container mt-5">
    <div style="background-color: #ffffff; border-radius: 10px; padding: 30px;">
        <h4 class="text-center">NILAI PKL SISWA</h4> 
        <br>
        <br>

        <a href="https://docs.google.com/spreadsheets/d/1CEIz_99Nyc6WwM9ARAjSmWFL0Bjb0wCR/edit?usp=sharing&ouid=103935379902975604390&rtpof=true&sd=true " 
            class="custom-btn" style="background-color: #F4A261; border-radius: 5px; color: white; padding: 10px 20px; text-decoration: none; display: center; font-weight: bold;">
            Template Nilai PKL
        </a>
        <br>
        <br>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <form action="{{ route('nilai_pkl') }}" method="GET">
                <div>
                    <select class="form-select d-inline-block w-auto" name="tahun">
                        <option value="" selected>Tahun</option>
                        @foreach($availableYears as $year)
                            <option value="{{ $year }}" {{ $year == $tahun ? 'selected' : '' }}>{{ $year }}</option>
                        @endforeach
                    </select>

                    <select class="form-select d-inline-block w-auto" name="konsentrasi_keahlian">
                        <option value="" selected>Konsentrasi Keahlian</option>
                        @foreach($availableKonsentrasi as $konsentrasi)
                            <option value="{{ $konsentrasi }}" {{ $konsentrasi == $konsentrasiKeahlian ? 'selected' : '' }}>
                                {{ $konsentrasi }}
                            </option>
                        @endforeach
                    </select>
                    <select name="kode_kelompok" class="form-select d-inline-block w-auto">
                        <option value="">Pilih Kelompok</option>
                        @foreach($availableKelompok as $kelompok)
                            <option value="{{ $kelompok }}" {{ request('kode_kelompok') == $kelompok ? 'selected' : '' }}>{{ $kelompok }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </form>  
        </div>

        <table class="table-striped custom-table">
            <thead class="table-primary text-center">
                <tr>
                    <th>No</th>
                    <th>NIS</th>
                    <th>Nama</th>
                    <th>Konsentrasi Keahlian</th>
                    <th>Kelas</th>
                    <th>Kelompok</th>
                    <th>Tahun</th>
                    <th>Upload</th>
                    <th>File</th>
                    <th>Ket</th>
                </tr>
            </thead>
            <tbody>
                @foreach($nilai_pkl as $index => $data)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $data->siswa->NIS }}</td>
                        <td>{{ $data->siswa->nama_siswa }}</td>
                        <td>{{ $data->siswa->konsentrasi_keahlian }}</td>
                        <td>{{ $data->kelas }}</td>
                        <td>{{ $data->kode_kelompok }}</td>
                        <td>{{ $data->siswa->tahun }}</td>
                        <td style="text-align: center; vertical-align: middle;">
                            <form id="upload-form-{{ $data->siswa->NIS }}" action="{{ route('import_excel', $data->siswa->NIS) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <label for="file-upload-{{ $data->siswa->NIS }}" class="btn btn-primary d-flex align-items-center mt-2" style="background-color: #0275db; padding: 6px; border: none; border-radius: 5px;">
                                    Upload
                                </label>
                                <input id="file-upload-{{ $data->siswa->NIS }}" type="file" name="file" class="d-none" onchange="this.form.submit()">
                            </form>                            
                        </td>                      
                        <td>
                            @if($data->nilaiPkl && $data->nilaiPkl->file_path)
                            <a href="{{ route('nilai.pkl.show', ['fileName' => $data->nilaiPkl->file_path]) }}" target="_blank">
                                Lihat/Download
                            </a>
                        @else
                            Belum ada file
                        @endif                        
                        </td>                                                                                                                                       
                        <td style="text-align: center; vertical-align: middle;">
                            <input type="checkbox"{{ $data->nilaiPkl && $data->nilaiPkl->is_imported ? 'checked' : '' }} disabled>
                            <span class="custom-checkbox"></span>
                        </td>
                    </tr>
                @endforeach
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
                        <th>Kelompok</th>
                        <th>TP1 (Soft Skills)</th>
                        <th>TP2 (Norma & POS)</th>
                        <th>TP3 (Kompetensi Teknis)</th>
                        <th>TP4 (Wawasan Wirausaha)</th>
                        <th>Total Nilai</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($detail_nilai as $index => $row)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $row['NIS'] }}</td>
                        <td>{{ $row['Nama'] }}</td>
                        <td>{{ $row['Kelompok'] }}</td>
                        <td>{{ $row['tp1_soft_skills'] }}</td>
                        <td>{{ $row['tp2_norma_pos'] }}</td>
                        <td>{{ $row['tp3_kompetensi_teknis'] }}</td>
                        <td>{{ $row['tp4_wawasan_wirausaha'] }}</td>
                        <td>{{ number_format($row['Total Nilai'], 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
<br>
<br>
            <div>
                <a href="{{ route('export.detail.nilai.excel') }}" class="btn btn-success">
                    <i class="bi bi-file-earmark-excel"></i> Export Excel
                </a>
                <a href="{{ route('export.detail.nilai.pdf') }}" class="btn btn-danger"> 
                    <i class="bi bi-file-earmark-pdf"></i> Export PDF
                </a>
            </div>
        </div>
    </div>
</div>

@endsection
