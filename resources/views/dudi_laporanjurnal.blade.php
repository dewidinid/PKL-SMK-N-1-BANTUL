@extends('layouts.headerdudi')

@section('content')

    <div class="container mt-5 table-wrapper">
        <h4 class="text-center mb-4">Laporan PKL (Jurnal)</h4>
        <br>

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

        <table class=" table-striped custom-table">
            <thead class="table-primary text-center" >
                <tr class="text-center" >
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>NIS</th>
                    <th>Nama</th>
                    <th>Jurusan</th>
                    <th>Tempat Dudi</th>
                    <th>Kegiatan/Progress</th>
                    <th>Lokasi</th>
                </tr>
                <br>
            </thead>
            <tbody id="data-table">
                @foreach ($laporan_jurnal as $index => $jurnal)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $jurnal->created_at->format('d-m-Y') }}</td>
                    <td>{{ $jurnal->siswa->NIS }}</td>
                    <td>{{ $jurnal->siswaByNama->nama_siswa }}</td>
                    <td>{{ $jurnal->siswa->konsentrasi_keahlian }}</td>
                    <td>{{ $jurnal->dudi->nama_dudi }}</td>
                    <td>{{ $jurnal->kegiatan }}</td>
                    <td>{{ $jurnal->lokasi }}</td>
                </tr>
                @endforeach
                <!-- Data contoh, akan diisi dengan JavaScript -->
                <tr>
                    <td>1</td>
                    <td>16/03/24</td>
                    <td>16034</td>
                    <td class="left-align">Rulli Ardha Ramadhan</td>
                    <td>TKJ</td>
                    <td>PT. Teknorika Inovasi Nusantara</td>
                    <td>Membuat Flowchart</td>
                    <td>Yogyakarta</td>
                </tr>
                
            </tbody>
            {{-- <tbody>
                @foreach ($jurnals as $index => $jurnal)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ \Carbon\Carbon::parse($jurnal->tanggal)->format('d/m/Y') }}</td>
                        <td>{{ $jurnal->nis }}</td>
                        <td>{{ $jurnal->nama }}</td>
                        <td>{{ $jurnal->jurusan }}</td>
                        <td>{{ $jurnal->tempat_dudi }}</td>
                        <td>{{ $jurnal->kegiatan }}</td>
                        <td>{{ $jurnal->lokasi }}</td> lokasi menggunakan maps location
                    </tr>
                @endforeach
            </tbody> --}}
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