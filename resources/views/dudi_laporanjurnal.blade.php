@extends('layouts.headerdudi')

@section('content')

<div class="container mt-5 table-wrapper">
    <h4 class="text-center">LAPORAN/JURNAL PKL</h4>
    <br>
    
    <!-- Filter Tahun dan Konsentrasi Keahlian -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <select class="form-select d-inline-block w-auto" name="tahun">
                <option selected>Tahun</option>
                <!-- Tambahkan opsi tahun -->
            </select>
            <select class="form-select d-inline-block w-auto" name="konsentrasi_keahlian">
                <option selected>Konsentrasi Keahlian</option>
                <!-- Tambahkan opsi konsentrasi keahlian -->
            </select>
        </div>
    </div>

    <table class="table-striped custom-table">
        <thead class="table-primary text-center">
            <tr class="text-center">
                <th>No</th>
                <th>NIS</th>
                <th id="nama">Nama</th>
                <th>Konsentrasi Keahlian</th>
                <th>Kelas</th>
                <th>Tahun</th>
                <th>Laporan PKL</th>
            </tr>
        </thead>
        <tbody id="data-table">
            @foreach ($laporan_jurnal as $index => $data)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $data->siswa->NIS }}</td>
                <td>{{ $data->siswaByNama->nama_siswa }}</td>
                <td>{{ $data->konsentrasi_konsentrasi }}</td>
                <td>{{ $data->kelas }}</td>
                <td>{{ $data->tahun }}</td>
                <td>
                    <a href="{{ route('dudi_laporanjurnal_persiswa'), $data->siswa->NIS }}" class="btn" style="background-color: #db9898; border-radius: 5px; padding: 5px;">
                        <i class="bi bi-journal-text" style="font-size: 16px; color: white;"></i>
                    </a>
                </td>
            </tr>
            @endforeach
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