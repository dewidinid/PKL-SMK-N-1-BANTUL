@extends('layouts.headerpembimbing')

@section('content')

<div class="container mt-5 table-wrapper">
    <h4 class="text-center">LAPORAN JURNAL PKL</h4>
    <br><br>
    
    <!-- Filter Tahun dan Konsentrasi Keahlian -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <form method="GET" action="{{ route('pembimbing_laporanjurnal') }}">
            <div>
                <select class="form-select d-inline-block w-auto" name="kode_kelompok">
                    <option selected>Kode Kelompok</option>
                    @foreach($kodeKelompokOptions as $kode)
                        <option value="{{ $kode }}">{{ $kode }}</option>
                    @endforeach
                </select>
                <select class="form-select d-inline-block w-auto" name="tahun">
                    <option selected>Tahun</option>
                    @foreach ($tahunOptions as $tahun)
                        <option value="{{ $tahun }}">{{ $tahun }}</option>
                    @endforeach
                </select>
                <select class="form-select d-inline-block w-auto" name="konsentrasi_keahlian">
                    <option selected>Konsentrasi Keahlian</option>
                    @foreach ($konsentrasiOptions as $konsentrasi)
                        <option value="{{ $konsentrasi }}">{{ $konsentrasi }}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>
        </form>
    </div>
    

    <table class="table-striped custom-table">
        <thead class="table-primary text-center">
            <tr class="text-center">
                <th>No</th>
                <th>Kelompok</th>
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
                <td>{{ $data->kode_kelompok }}</td>
                <td>{{ $data->NIS }}</td>
                <td class="left-align">{{ $data->siswa->nama_siswa }}</td>
                <td>{{ $data->siswa->konsentrasi_keahlian }}</td>
                <td>{{ $data->kelas }}</td>
                <td>{{ $data->siswa->tahun }}</td>
                <td>
                    <a href="{{ route('pembimbing_laporanjurnal_persiswa', $data->NIS) }}" class="btn" style="background-color: #db9898;">
                        <i class="bi bi-journal-text" style="color: white;"></i>
                    </a>
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