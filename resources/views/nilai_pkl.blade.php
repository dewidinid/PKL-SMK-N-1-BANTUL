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
                <select class="form-select d-inline-block w-auto" name="jurusan">
                    <option selected>Jurusan</option>
                    <!-- Tambahkan opsi jurusan -->
                </select>
            </div>
        </div>
        <br>
        <table class="table-striped custom-table">
            <thead class="table-primary text-center">
                <tr>
                    <th>No</th>
                    <th>Kelompok</th>
                    <th>NIS</th>
                    <th>Nama</th>
                    <th>Jurusan</th>
                    <th>Kelas</th>
                    <th>Tahun</th>
                    <th>Nilai</th>
                    <th>Import</th>
                    <th>Ket</th>
                </tr>
            </thead>
            <tbody>
                @foreach($students as $student)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>TKJ</td>
                        <td>{{ $student->nis }}</td>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->jurusan }}</td>
                        <td>{{ $student->kelas }}</td>
                        <td>{{ $student->tahun }}</td>
                        <td>
                            <span class="badge bg-success">Upload</span>
                        </td>
                        <td>
                            <button class="btn btn-primary">Import</button>
                        </td>
                    </tr>
                @endforeach
            
                <tr>
                    <td>1</td>
                    <td>K001</td>
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
                        <th>Softskill</th>
                        <th>Norma</th>
                        <th>Kompetensi</th>
                        <th>Disiplin</th>
                        <th>Nilai Akhir</th>
                    </tr>
                </thead>
                <tbody  id="data-table">
                    @foreach ($nilai_pkl as $index => $nilai)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $nilai->kelompok->kode_kelompok }}</td>
                        <td>{{ $nilai->siswa->NIS }}</td>
                        <td>{{ $nilai->siswaByNama->nama_siswa }}</td>
                        <td>{{ $nilai->konsentrasiKeahlian->konsentrasi_keahlian }}</td>
                        <td>{{ $nilai->siswaByKelas->kelas }}</td>
                        <td>{{ $nilai->siswaByTahun->tahun }}</td>
                        <td>
                            @if($nilai->nilai)
                                <a href="{{ asset('storage/' . $nilai->nilai) }}" target="_blank">Lihat Nilai</a>
                            @else
                                Belum diupload
                            @endif
                        </td>
                        <td>
                            <form action="{{ route('import.nilai', $nilai->id_nilai) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="file" name="nilai_file" required>
                                <button type="submit" class="btn btn-primary">Import</button>
                            </form>
                        </td>
                        <td>{{ $nilai->nilai ? 'Sudah diupload' : 'Belum diupload' }}</td>
                    </tr>
                    @endforeach
                    
                    <tr>
                        <td>1</td>
                        <td>16034</td>
                        <td>Rulli Ardha Ramadhan</td>
                        <td>90</td>
                        <td>90</td>
                        <td>90</td>
                        <td>90</td>
                        <td>90</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>16034</td>
                        <td>Rulli Ardha Ramadhan</td>
                        <td>90</td>
                        <td>90</td>
                        <td>90</td>
                        <td>90</td>
                        <td>90</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>16034</td>
                        <td>Rulli Ardha Ramadhan</td>
                        <td>90</td>
                        <td>90</td>
                        <td>90</td>
                        <td>90</td>
                        <td>90</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>16034</td>
                        <td>Rulli Ardha Ramadhan</td>
                        <td>90</td>
                        <td>90</td>
                        <td>90</td>
                        <td>90</td>
                        <td>90</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <br>
        <div class="mt-3 text-end">
            <button class="btn btn-success">Export Nilai PKL</button>
        </div>
    </div>
</div>


@endsection