@extends('layouts.headersiswa')

@section('content')
    <div class="container mt-5 table-wrapper">
        <h2 class="text-center mb-4">Laporan PKL (Jurnal)</h2>

            <!-- Form Submission Success Message -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Button to Open the Form -->
        <div class="d-flex justify-content-end mb-3">
            <button onclick="openForm()" class="btn btn-primary">Tambah Jurnal</button>
        </div>

        <!-- Journal Table -->
        <table class="table-striped custom-table">
            <thead class="table-primary text-center">
                <tr class="text-center">
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>NIS</th>
                    <th>Nama</th>
                    <th>Konsentrasi Keahlian</th>
                    <th>Tempat Dudi</th>
                    <th>Kegiatan / Progres</th>
                    <th>Lokasi</th>
                </tr>
            </thead>
            <tbody id="data-table">
                {{-- @foreach ($jurnals as $index => $jurnal)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $jurnal->NIS }}</td>
                        <td>{{ $jurnal->nama_siswa }}</td>
                        <td>{{ $jurnal->konsentrasi_keahlian }}</td>
                        <td>{{ $jurnal->nama_dudi }}</td>
                        <td>{{ $jurnal->kegiatan }}</td>
                        <td>{{ $jurnal->lokasi }}</td>
                    </tr>
                @endforeach --}}
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

    <!-- Pop-up Form -->
    <div class="modal" id="jurnalForm" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Form Jurnal Siswa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('submitJurnal') }}" method="POST">
                        @csrf
                        {{-- <div class="mb-3">
                            <label for="nis" class="form-label">NIS</label>
                            <input type="text" class="form-control" id="nis" name="nis" value="{{ Auth::user()->NIS }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="nama_siswa" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" value="{{ Auth::user()->nama }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="konsentrasi_keahlian" class="form-label">konsentrasi_keahlian</label>
                            <input type="text" class="form-control" id="konsentrasi_keahlian" name="konsentrasi_keahlian" value="{{ Auth::user()->konsentrasi_keahlian }}" readonly>
                        </div> --}}
                        <div class="mb-3">
                            <label for="tempat_dudi" class="form-label">Tempat Dudi</label>
                            <input type="text" class="form-control" id="tempat_dudi" name="tempat_dudi" required>
                        </div>
                        <div class="mb-3">
                            <label for="kegiatan" class="form-label">Kegiatan / Progres</label>
                            <textarea class="form-control" id="kegiatan" name="kegiatan" rows="2" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="lokasi" class="form-label">Lokasi</label>
                            <input type="text" class="form-control" id="lokasi" name="lokasi" required readonly>
                            <button type="button" class="btn btn-primary mt-2" onclick="getLocation()">Ambil Lokasi Saat Ini</button>
                            <a id="mapsLink" href="#" target="_blank" class="btn btn-success mt-2" style="display: none;">Lihat di Peta</a>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="reset" class="btn btn-danger me-2">Reset</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>

@include('layouts.footer')
@endsection