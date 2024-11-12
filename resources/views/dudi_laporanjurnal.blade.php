@extends('layouts.headerdudi')

@section('content')

<div class="container mt-5 table-wrapper">
    <h4 class="text-center">LAPORAN JURNAL PKL</h4>
    <br>
    
    <!-- Filter Tahun dan Konsentrasi Keahlian -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <form action="{{ route('dudi_laporanjurnal') }}" method="GET">
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
            <tr class="text-center">
                <th>No</th>
                <th>NIS</th>
                <th id="nama">Nama</th>
                <th>Konsentrasi Keahlian</th>
                <th>Kelas</th>
                <th>Kelompok</th>
                <th>Tahun</th>
                <th>Laporan PKL</th>
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
                <td>{{ $data->kode_kelompok }}</td>
                <td class="text-center">{{ $data->siswa->tahun }}</td>
                <td>
                    <a href="{{ route('dudi_laporanjurnal_persiswa', ['nis' => $data->siswa->NIS]) }}" class="btn" style="background-color: #db9898; border-radius: 5px; padding: 5px;">
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