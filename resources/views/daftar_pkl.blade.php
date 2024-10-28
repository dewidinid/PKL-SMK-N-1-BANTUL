@extends('layouts.headerdudi')

@section('content')

<div class="container mt-5 table-wrapper">
    <h4 class="text-center">DAFTAR SISWA PKL</h4>

    <br>
    <br>
    <!-- Filter Tahun dan konsentrasi_keahlian -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <form action="" method="GET">
            <div>
                <select class="form-select d-inline-block w-auto" name="tahun">
                    <option value="" selected>Tahun</option>
                    @foreach($availableYears as $year)
                        <option value="{{ $year }}" {{ $year == $tahun ? 'selected' : '' }}>{{ $year }}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>
        </form>
    </div>


    <table class=" table-striped custom-table">
        <thead class="table-primary text-center">
            <tr>
                <th>No</th>
                <th>NIS</th>
                <th>Nama</th>
                <th>Konsentrasi Keahlian</th>
                <th>Kelas</th>
                <th>Pembimbing</th>
                <th>Tahun</th>
            </tr>
        </thead>
        <tbody id="data-table">
            @foreach($ploting as $index => $data)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td class="text-center">{{ $data->siswa->NIS }}</td>
                <td>{{ $data->siswa->nama_siswa }}</td>
                <td class="text-center">{{ $data->siswa->konsentrasi_keahlian }}</td>
                <td class="text-center">{{ $data->kelas }}</td>
                <td class="text-center">{{ $data->pembimbing->nama_pembimbing }}</td>
                <td class="text-center">{{ $data->siswa->tahun }}</td>
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