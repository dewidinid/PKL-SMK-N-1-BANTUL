@extends('layouts.headersiswa')

@section('content')
<div class="container mt-5 table-wrapper" id="jurnal-table-container">
    <div class="d-flex justify-content-start mb-3" style="margin-left: 20px;">
        <button onclick="window.location.href='{{ route('home_siswa') }}'" style="background-color: #439AC7; color: #ffffff; border: none; padding: 5px 10px; border-radius: 5px; margin-top: 10px;">
            <i class="bi bi-arrow-left"></i> Kembali
        </button>
    </div>
    <br>
    <h2 class="text-center mb-4">Laporan PKL (Jurnal)</h2>

    {{-- <div class="d-flex justify-content-between align-items-start mb-3 flex-wrap">
        <!-- Filter di sisi kiri -->
        <div class="filter-section">
            <form action="{{ route('laporanpkl_jurnal') }}" method="GET">
                <div class="mb-2">
                    <select class="form-select" name="bulan">
                        <option value="">Pilih Bulan</option>
                        @for ($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}" {{ $bulan == $i ? 'selected' : '' }}>
                                {{ \Carbon\Carbon::create()->month($i)->translatedFormat('F') }}
                            </option>
                        @endfor
                    </select>
                </div>
                <div class="mb-2">
                    <select class="form-select" name="tahun">
                        <option value="">Pilih Tahun</option>
                        @foreach ($availableYears as $year)
                            <option value="{{ $year }}" {{ $tahun == $year ? 'selected' : '' }}>
                                {{ $year }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary w-100">Filter</button>
            </form>
        </div>
    
        <!-- Tambah Jurnal di sisi kanan -->
        <div class="add-journal-section">
            @if ($ploting)
                <button onclick="openForm()" class="btn btn-block custom-btn w-100" style="background-color: #F4A261; font-size: 18px; padding: 10px;">
                    Tambah Jurnal <i class="bi bi-plus" style="font-size: 20px;"></i>
                </button>
            @else
                <button onclick="showNotPlotedAlert()" class="btn btn-block custom-btn w-100" style="background-color: #F4A261; font-size: 18px; padding: 10px;">
                    Tambah Jurnal <i class="bi bi-plus" style="font-size: 20px;"></i>
                </button>
            @endif
        </div>
    </div> --}}

    <div class="d-flex justify-content-between align-items-start mb-3 flex-wrap">
        <!-- Filter di sisi kiri -->
        <div class="filter-section">
            <form action="{{ route('laporanpkl_jurnal') }}" method="GET">
                <div class="mb-2">
                    <select class="form-select" name="bulan">
                        <option value="">Pilih Bulan</option>
                        @for ($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}" {{ $bulan == $i ? 'selected' : '' }}>
                                {{ \Carbon\Carbon::create()->month($i)->translatedFormat('F') }}
                            </option>
                        @endfor
                    </select>
                </div>
                <div class="mb-2">
                    <select class="form-select" name="tahun">
                        <option value="">Pilih Tahun</option>
                        @foreach ($availableYears as $year)
                            <option value="{{ $year }}" {{ $tahun == $year ? 'selected' : '' }}>
                                {{ $year }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary w-100">Filter</button>
            </form>
        </div>
    
        <!-- Tambah Jurnal di sisi kanan -->
        <div class="add-journal-section ms-3">
            @if ($ploting)
                <button onclick="openForm()" class="btn custom-btn btn-lg w-100 text-center" style="background-color: #F4A261;">
                    Tambah Jurnal <i class="bi bi-plus" style="font-size: 20px;"></i>
                </button>
            @else
                <button onclick="showNotPlotedAlert()" class="btn custom-btn btn-lg w-100 text-center" style="background-color: #F4A261;">
                    Tambah Jurnal <i class="bi bi-plus" style="font-size: 20px;"></i>
                </button>
            @endif
        </div>
    </div>
    
    
    {{-- <div class="d-flex justify-content-between align-items-center mb-3">
        <form action="{{ route('laporanpkl_jurnal') }}" method="GET">
            <select class="form-select d-inline-block w-auto" name="bulan">
                <option value="">Pilih Bulan</option>
                @for ($i = 1; $i <= 12; $i++)
                    <option value="{{ $i }}" {{ $bulan == $i ? 'selected' : '' }}>
                        {{ \Carbon\Carbon::create()->month($i)->translatedFormat('F') }}
                    </option>
                @endfor
            </select>
            <select class="form-select d-inline-block w-auto" name="tahun">
                <option value="">Pilih Tahun</option>
                @foreach ($availableYears as $year)
                    <option value="{{ $year }}" {{ $tahun == $year ? 'selected' : '' }}>
                        {{ $year }}
                    </option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-primary">Filter</button>
        </form>
        <div class="d-flex">
            @if ($ploting)
                <button onclick="openForm()" class="btn d-flex align-items-center custom-btn" style="background-color: #F4A261">
                    Tambah Jurnal <i class="bi bi-plus " style="font-size: 19px;"></i>
                </button>
            @else
                <button onclick="showNotPlotedAlert()" class="btn d-flex align-items-center custom-btn" style="background-color: #F4A261">
                    Tambah Jurnal <i class="bi bi-plus " style="font-size: 19px;"></i>
                </button>
            @endif
        </div>
    </div> --}}

    <!-- Wrapper khusus untuk tabel -->
    <div class="table-responsive">
        <table class="table table-striped custom-table">
            <thead class="table-primary text-center">
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>NIS</th>
                    <th>Nama</th>
                    <th>Konsentrasi Keahlian</th>
                    <th>Kelas</th>
                    <th>Tempat Dudi</th>
                    <th>Kegiatan / Progres</th>
                    <th>Lokasi</th>
                </tr>
            </thead>
            <tbody id="data-table">
                @forelse ($jurnals as $index => $jurnal)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $jurnal->created_at }}</td>
                        <td>{{ $jurnal->NIS }}</td>
                        <td>{{ $jurnal->nama_siswa }}</td>
                        <td>{{ $jurnal->konsentrasi_keahlian }}</td>
                        <td>{{ $jurnal->kelas }}</td>
                        <td>{{ $jurnal->ploting ? $jurnal->ploting->nama_dudi : 'Tidak ada data DUDI' }}</td>
                        <td>{{ $jurnal->kegiatan }}</td>
                        <td>{{ $jurnal->lokasi }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center">Tidak ada data jurnal untuk bulan dan tahun yang dipilih.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
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
    <div class="modal fade" id="jurnalForm" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Form Jurnal Siswa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('submitJurnal') }}" method="POST" onsubmit="return showAddingNotification()">
                        @csrf
                        <!-- Menjaga struktur dan penggunaan kelas Bootstrap yang sama -->
                        <input type="hidden" name="NIS" id="nis" value="{{ $siswa->NIS }}">
                        <div class="mb-3">
                            <label for="nis" class="form-label">NIS</label>
                            <input type="text" class="form-control" id="nis" name="nis" value="{{ $siswa->NIS }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="nama_siswa" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" value="{{ $siswa->nama_siswa }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="konsentrasi_keahlian" class="form-label">Konsentrasi Keahlian</label>
                            <input type="text" class="form-control" id="konsentrasi_keahlian" name="konsentrasi_keahlian" value="{{ $siswa->konsentrasi_keahlian }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="kode_kelompok" class="form-label">Kelompok</label>
                            <input type="text" class="form-control" id="kode_kelompok" name="kode_kelompok" value="{{ $siswa->kode_kelompok }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="kelas" class="form-label">Kelas</label>
                            <input type="text" class="form-control" id="kelas" name="kelas" value="{{ $siswa->kelas }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="nama_dudi" class="form-label">Tempat Dudi</label>
                            <input type="text" class="form-control" id="nama_dudi" name="nama_dudi" value="{{ $ploting ? $ploting->nama_dudi : 'Siswa belum diploting' }}" readonly>
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
                        <div class="modal-footer">
                            <button type="reset" class="btn btn-danger me-2">Reset</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <style>
        .form-label{
            color: black !important;
        }

    </style>    

    <br>
    <br>
    <br>
    <br>

@endsection