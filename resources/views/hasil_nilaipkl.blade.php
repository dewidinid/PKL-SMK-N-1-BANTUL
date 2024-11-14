@extends('layouts.headerpembimbing')

@section('content')

<div class="container mt-5 table-wrapper">
        <h4 class="text-center">NILAI PKL SISWA</h4>
        <br>
        <br>
        
    <!-- Filter Tahun dan konsentrasi_keahlian -->
    <form action="{{ route('hasil_nilaipkl') }}" method="GET">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <select class="form-select d-inline-block w-auto" name="kode_kelompok" onchange="this.form.submit()">
                    <option selected>Kode Kelompok</option>
                    @foreach ($kode_kelompok as $kelompok)
                        <option value="{{ $kelompok }}" {{ request('kode_kelompok') == $kelompok ? 'selected' : '' }}>{{ $kelompok }}</option>
                    @endforeach
                </select>
                <!-- Dropdown Tahun -->
                <select class="form-select d-inline-block w-auto" name="tahun" onchange="this.form.submit()">
                    <option selected>Tahun</option>
                    @foreach ($tahun as $thn)
                        <option value="{{ $thn }}" {{ request('tahun') == $thn ? 'selected' : '' }}>{{ $thn }}</option>
                    @endforeach
                </select>

                <!-- Dropdown Konsentrasi Keahlian -->
                <select class="form-select d-inline-block w-auto" name="konsentrasi_keahlian" onchange="this.form.submit()">
                    <option selected>Konsentrasi Keahlian</option>
                    @foreach ($konsentrasi_keahlian as $keahlian)
                        <option value="{{ $keahlian }}" {{ request('konsentrasi_keahlian') == $keahlian ? 'selected' : '' }}>{{ $keahlian }}</option>
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
                <th>Konsentrasi keahlian</th>
                <th>Kelas</th>
                <th>Tahun</th>
                <th>Nama Dudi</th>
                <th>Nilai Dudi</th>
                <th>Download</th>
            </tr>
        </thead>

        <!-- home_pembimbing.blade.php -->

    <tbody id="data-table">
        @foreach ($hasil_nilaipkl as $index => $nilai)
            <tr class="text-center">
                <td>{{ $index + 1 }}</td>
                <td>{{ $nilai->kode_kelompok }}</td>
                <td>{{ $nilai->NIS }}</td>
                <td class="left-align">{{ $nilai->siswa->nama_siswa }}</td>
                <td>{{ $nilai->siswa->konsentrasi_keahlian }}</td>
                <td>{{ $nilai->siswa->kelas }}</td>
                <td>{{ $nilai->siswa->tahun }}</td>
                <td>{{ $nilai->nama_dudi }}</td>
                <td>{{ optional($nilai->nilaiPkl)->nilai !== null ? number_format(optional($nilai->nilaiPkl)->nilai, 2) : 'N/A' }}</td>
                <td>
                    @if($nilai->nilaiPkl && $nilai->nilaiPkl->file_path)
                        <a href="{{ Storage::url('public/nilai_pkl/' . $nilai->nilaiPkl->file_path) }}" download
                        style="background-color: #90DC75; color: white; padding: 5px 5px; border-radius: 5px; text-decoration: none; display: inline-flex; align-items: center;">
                            <span style="font-size: 0.9rem;">Unduh Nilai</span>
                            <i class="bi bi-file-earmark" style="font-size: 1rem; margin-left: 5px;"></i>
                        </a>
                    @else
                        Belum diunggah
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>

    </table>

    <br><br>

    <div class="pagination-container" style="display: flex; justify-content: center; align-items: center;">
        <button class="pagination-btn" onclick="prevPage()" id="prev-btn" disabled>Sebelumnya</button>
        <div id="pagination-numbers" style="display: flex; gap: 10px; margin: 0 20px;">
            <!-- Angka halaman akan diisi dengan JavaScript -->
        </div>
        <button class="pagination-btn" onclick="nextPage()" id="next-btn">Selanjutnya</button>
    </div>

</div>

@endsection