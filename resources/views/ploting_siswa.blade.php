@extends('layouts.headeradmin')


@section('content')
<div class="container mt-5">
    <h4 class="text-center">PLOTING SISWA</h4>
    <br>
    <br>

    <div>
        <a href="https://docs.google.com/spreadsheets/d/1jLJYRdNSpNqo-rW7cSwCOMH7he6JvoIf/edit?usp=drive_link&ouid=102059787068159879684&rtpof=true&sd=true" 
            class="custom-btn me-2" style="background-color: #F4A261; border-radius: 5px; color: white; padding: 10px 20px; text-decoration: none; display: center; font-weight: bold;">
            Template Upload Ploting
        </a>

        <a href="{{ route('export.ploting.excel') }}" class="btn btn-success me-2">
            <i class="bi bi-file-earmark-excel"></i> Export Excel
        </a>

        <a href="{{ route('export_ploting_pdf') }}" class="btn btn-danger">
            <i class="bi bi-file-earmark-pdf"></i> Export PDF
        </a>
    </div>
    <br>

  <!-- Filter Tahun dan konsentrasi_keahlian -->
<div class="d-flex justify-content-between align-items-center mb-3">
        <form method="GET" action="{{ route('admin.plotingSiswa') }}">
            <div>
                <select class="form-select d-inline-block w-auto" name="tahun">
                    <option selected>Tahun</option>
                    @foreach($tahun as $t)
                        <option value="{{ $t }}" {{ request('tahun') == $t ? 'selected' : '' }}>{{ $t }}</option>
                    @endforeach
                </select>
                <select class="form-select d-inline-block w-auto" name="konsentrasi_keahlian">
                    <option selected>Konsentrasi Keahlian</option>
                    @foreach($konsentrasiKeahlian as $kk)
                        <option value="{{ $kk }}" {{ request('konsentrasi_keahlian') == $kk ? 'selected' : '' }}>{{ $kk }}</option>
                    @endforeach
                </select>            
                <select class="form-select d-inline-block w-auto" name="kelompok"> <!-- Pastikan 'name' sama dengan di controller -->
                    <option selected>Kelompok</option>
                    @foreach($kelompok as $k)
                        <option value="{{ $k }}" {{ request('kelompok') == $k ? 'selected' : '' }}>{{ $k }}</option> <!-- Ambil 'kode_kelompok' -->
                    @endforeach
                </select>            
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>
        </form>
    
        <div class="d-flex">
            <form action="{{ route('admin.importPloting') }}" method="POST" enctype="multipart/form-data" class="d-flex">
                @csrf
                <div class="me-2">
                    <label for="file-upload" class="btn btn-primary d-flex align-items-center custom-btn" >
                        Upload <i class="bi bi-upload ms-2"></i>
                    </label>
                    <input id="file-upload" type="file" name="file" class="d-none" onchange="handleFileUpload(this)">
                </div>
            </form>
        </div>
    </div>

    
        <table class=" table-mini table-striped custom-mini-table">
            <thead class="table-primary text-center">
                <tr>
                    <th>No</th>
                    <th>Kelompok</th>
                    <th>NIS</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Konsentrasi Keahlian</th>
                    <th>Pembimbing</th>
                    <th>Dudi</th>
                    <th>Telp Dudi</th>
                    <th>Alamat Dudi</th>
                </tr>
            </thead>
            <tbody id="data-table">
                @foreach ($ploting as $index => $ploting)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $ploting->kode_kelompok }}</td>
                    <td>{{ optional($ploting->siswa)->NIS }}</td>
                    <td>{{ optional($ploting->siswa)->nama_siswa }}</td>
                    <td>{{ optional($ploting->siswa)->kelas }}</td>
                    <td>{{ optional($ploting->siswa)->konsentrasi_keahlian }}</td>
                    <td>{{ optional($ploting->pembimbing)->nama_pembimbing ?? 'Pembimbing tidak tersedia' }}</td>
                    <td>{{ $ploting->nama_dudi ?? 'DUDI tidak tersedia' }}</td>
                    <td>{{ $ploting->dudi->notelp_dudi ?? 'No Telp DUDI tidak tersedia' }}</td>
                    <td>{{ $ploting->dudi->alamat_dudi ?? 'Alamat DUDI tidak tersedia' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
</div>

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


@endsection