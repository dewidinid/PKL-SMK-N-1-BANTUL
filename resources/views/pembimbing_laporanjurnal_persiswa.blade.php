@extends('layouts.headerpembimbing')

@section('content')

<div class="container mt-5 table-wrapper">

    <div class="" style="background-color: #ffffff; border-radius: 10px; padding: 30px;">
        <div class="d-flex justify-content-start mb-3">
            <button onclick="window.history.back()" style="background-color: #0275d8; color: #ffffff; border: none; padding: 5px 10px; border-radius: 5px;">
                <i class="bi bi-arrow-left"></i> Kembali
            </button>
        </div>

        <h2 class="text-center">Laporan/Jurnal Per Siswa</h2>
        <br>

        <div>
            <p><strong>Nama :</strong> {{ $siswa->nama_siswa }}</p>
            <p><strong>NIS :</strong> {{ $siswa->NIS }}</p>
            <p><strong>Konsentrasi Keahlian :</strong> {{ $siswa->konsentrasi_keahlian }}</p>
            <p><strong>Kelas :</strong> {{ $siswa->kelas }}</p>
            <p><strong>DUDI :</strong> {{ $siswa->nama_dudi }}</p>
        </div>
        <br>

        <div>
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <select class="form-select d-inline-block w-auto" name="bulan">
                        <option selected>Bulan</option>
                    </select>
                    <select class="form-select d-inline-block w-auto" name="tahun">
                        <option selected>Tahun</option>
                    </select>
                </div>
            </div>

            <table class="table-striped custom-table">
                <thead class="table-primary text-center">
                    <tr class="text-center">
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Kegiatan/Progress</th>
                        <th>Lokasi</th>
                    </tr>
                </thead>
                <tbody id="data-table">
                    @foreach ($jurnals as $index => $jurnal)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ \Carbon\Carbon::parse($jurnal->tanggal)->format('d/m/Y') }}</td>
                            <td>{{ $jurnal->kegiatan }}</td>
                            <td>{{ $jurnal->lokasi }}</td>
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
        
    </div>
</div>

@endsection