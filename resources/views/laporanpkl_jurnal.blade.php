@extends('layouts.headersiswa')

@section('content')
    <div class="container mt-5">
        <h2 class="text-center mb-4">Laporan PKL (Jurnal)</h2>
        <div class="d-flex justify-content-end mb-3">
            <button onclick="openForm()" style="background-color: #0275d8; color:#ffffff">+ Tambah</button>
        </div>
        <table class="table table-bordered">
            <thead >
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
                <!-- Data contoh, akan diisi dengan JavaScript -->
                <tr>
                    <td>1</td>
                    <td>16/03/24</td>
                    <td>16034</td>
                    <td>Rulli Ardha Ramadhan</td>
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
                        <td>{{ $jurnal->lokasi }}</td>
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

    <!-- Pop-up Form -->
    <div class="modal" id="jurnalForm" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Form Jurnal Siswa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-container">
                        {{-- <h4 class="text-center mb-4" style="color: #ffffff">Form Pengajuan PKL</h4>
                        <form action="{{ route('formpengajuan') }}" method="POST" enctype="multipart/form-data"> --}}
                            @csrf
                            <div class="mb-3">
                                <label for="nis" class="form-label">NIS</label>
                                <input type="text" class="form-control" id="nis" name="nis" placeholder="Masukkan NIS" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 5)" maxlength="5">
                            </div>
                            
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama</label>
                                {{-- <input type="text" class="form-control" id="jurusan" name="jurusan" placeholder="Masukkan Nama Lengkap" oninput="this.value = this.value.replace(/[^a-zA-Z'\s]/g, '');"> --}}
                                <input type="text" class="form-control" id="jurusan" name="jurusan" placeholder="Masukkan Nama Lengkap" oninput="this.value = this.value.replace(/[^a-zA-Z'\s]/g, '').replace(/\b\w/g, char => char.toUpperCase()).replace(/\B\w/g, char => char.toLowerCase());">
                            </div>
                            
                            <div class="mb-3">
                                <label for="jurusan" class="form-label">Jurusan</label>
                                <select class="form-control" id="jurusan" name="jurusan">
                                    <option value="" disabled selected>Pilih Jurusan</option>
                                    <option value="akl">Akuntansi dan Keuangan Lembaga (AKL)</option>
                                    <option value="ps">Layanan Perbankan Syariah (PS)</option>
                                    <option value="mp">Manajemen Perkantoran (MP)</option>
                                    <option value="br">Bisnis Ritel (BR)</option>
                                    <option value="bd">Bisnis Digital(BD)</option>
                                    <option value="tkj">Teknik Komputer dan Jaringan (TKJ)</option>
                                    <option value="dkv">Desain Komunikasi Visual (DKV)</option>
                                    <option value="rpl">Rekayasa Perangkat Lunak (RPL)</option>
                                </select>
                            </div>
                            
                            <div class="mb-3">
                                <label for="no_handphone" class="form-label">Tempat Du/Di</label>
                                <input type="tel" class="form-control" id="tempat_dudi" name="tempat_dudi" placeholder="Masukkan Tempat Dudi">
                            </div>
                            
                            <div class="mb-3">
                                <label for="rencana_tempat_pkl" class="form-label">Kegiatan / Progres</label>
                                <textarea class="form-control" id="nis" name="nis" rows="1" placeholder="Masukkan Kegiatan / Progres hari ini"></textarea>
                            </div>
                            <br>
                            
                            <button type="reset" class="btn btn-danger" >Reset</button>
                            <button type="submit" class="btn btn-primary" style="margin-left: auto;" >Simpan</button>
                    </div>
                    <form method="POST" id="jurnalForm">
                        {{-- action="{{ route('laporanpkl.store') }}"  --}}
                        @csrf
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