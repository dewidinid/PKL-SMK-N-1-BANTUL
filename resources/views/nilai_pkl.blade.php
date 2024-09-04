@extends('layouts.headerdudi')

@section('content')
<br>

<div class="container mt-6">
    <h4 class="text-center">NILAI PKL SISWA</h4> <br>

    <div class="row">
            <a class="col text-start" href="#" class="btn btn-link">Template Nilai PKL</a>
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

    <table class="table table-striped mt-5">
        <thead>
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
        {{-- <tbody>
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
        </tbody> --}}
        <tbody>
            <tr>
                <td>1</td>
                <td>K001</td>
                <td>16034</td>
                <td>Rulli Ardha Ramadhan</td>
                <td>Teknik Komputer Jaringan</td>
                <td>TKJ 1</td>
                <td>2024/2025</td>

                <td>
                    <form  method="POST" enctype="multipart/form-data">
                        {{-- action="{{ route('upload-file') }}" --}}
                        @csrf
                        <label for="file-upload" class="btn btn-primary d-flex align-items-center"> Upload </label>
                        <input id="file-upload" type="file" name="file" class="d-none" onchange="this.form.submit()">
                    </form>
                </td>
                <td>
                    <button class="btn btn-primary">Import</button>
                </td>
                <td class="text-center">
                    <input type="checkbox" name="check[]" value="1">
                </td>


            </tr>
        </tbody>
    </table>
    <br>

    <h4 class="text-center mt-5">DETAIL NILAI</h4> <br>

    <div class="table-responsive" style="max-height: 400px; overflow-y: scroll;">
        <table class="table table-striped">
            <thead>
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
            {{-- <tbody>
                @foreach($students as $student)
                    @foreach($student->grades as $grade)
                        <tr>
                            <td>{{ $loop->parent->iteration }}</td>
                            <td>{{ $student->nis }}</td>
                            <td>{{ $student->name }}</td>
                            <td>{{ $grade->softskill }}</td>
                            <td>{{ $grade->norma }}</td>
                            <td>{{ $grade->kompetensi }}</td>
                            <td>{{ $grade->disiplin }}</td>
                            <td>{{ $grade->nilai_akhir }}</td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody> --}}
            <tbody>
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

    <div class="mt-3 text-end">
        <button class="btn btn-success">Export Nilai PKL</button>
    </div>
</div>

<br><br>  

@include('layouts.footer')
@endsection