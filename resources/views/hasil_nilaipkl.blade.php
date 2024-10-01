@extends('layouts.headerpembimbing')

@section('content')

<div class="container mt-5 table-wrapper">
        <h4 class="text-center">NILAI PKL SISWA</h4>
        <br>
        
    <!-- Filter Tahun dan konsentrasi_keahlian -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div >
            <select class="form-select d-inline-block w-auto" name="bulan">
                <option selected>Bulan</option>
            </select>
            <select class="form-select d-inline-block w-auto" name="tahun">
                <option selected>Tahun</option>
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
                <th>Konsentrasi keahlian</th>
                <th>Kelas</th>
                <th>Tahun</th>
                <th>Nilai</th>
                <th>Download</th>
            </tr>
        </thead>
        
        <tbody id="data-table">
            @foreach ($nilaiPkl as $index => $nilai)
                    <tr class="text-center">
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $nilai->kelompok->kode_kelompok ?? '-' }}</td>
                        <td>{{ $nilai->NIS }}</td>
                        <td>{{ $nilai->siswaByNama->nama_siswa ?? '-' }}</td>
                        <td>{{ $nilai->konsentrasiKeahlian->nama_konsentrasi ?? '-' }}</td>
                        <td>{{ $nilai->siswaByKelas->kelas ?? '-' }}</td>
                        <td>{{ $nilai->siswaByTahun->tahun ?? '-' }}</td>
                        <td>{{ $nilai->TotalNilai }}</td> <!-- Menampilkan total nilai -->
                        <td>
                            <a href="{{ Storage::url($nilai->file_path) }}" download style="background-color: #90DC75; color: white; padding: 5px 5px; border-radius: 5px; text-decoration: none; display: inline-flex; align-items: center;">
                                <span style="font-size: 0.9rem;">Nilai</span>
                                <i class="bi bi-file-earmark" style="font-size: 1rem; margin-left: 5px;"></i>
                            </a> 
                        </td>
                    </tr>
            @endforeach
            <tr class="text-center ">
                <td >1</td>
                <td >K001</td>
                <td >16034</td>
                <td >Rulli Ardha Ramadhan</td>
                <td >Teknik Komputer Jaringan</td>
                <td >TKJ 1</td>
                <td >2024/2025</td>
                <td></td>
                <td>
                    <a href="{{ asset('storage/files/sample-file.pdf') }}" download style="background-color: #90DC75; color: white; padding: 5px 5px; border-radius: 5px; text-decoration: none; display: inline-flex; align-items: center;">
                        <span style="font-size: 0.9rem;">Nilai</span>
                        <i class="bi bi-file-earmark" style="font-size: 1rem; margin-left: 5px;"></i>
                    </a> 
                </td>
            </tr>
        </tbody>
    </table>

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


</div>


@endsection