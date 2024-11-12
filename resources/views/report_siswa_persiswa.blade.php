@extends('layouts.headeradmin')

@section('content')

<div class="container mt-5 table-wrapper"> 
    <div style="background-color: #ffffff; border-radius: 10px; padding: 30px;">
        <div class="d-flex justify-content-start mb-3">
            <button onclick="window.history.back()" style="background-color: #439AC7; color: #ffffff; border: none; padding: 5px 10px; border-radius: 5px;">
                <i class="bi bi-arrow-left"></i> Kembali
            </button>
        </div>
        
        <h2 class="text-center mt-2">Report Per Siswa</h2>
        <br>

        <table class="student-info">
            <tr>
                <td><strong>NIS</strong></td>
                <td><strong>:</strong></td>
                <td>{{ $siswa->NIS }}</td>
            </tr>
            <tr>
                <td><strong>Nama</strong></td>
                <td><strong>:</strong></td>
                <td>{{ $siswa->nama_siswa }}</td>
            </tr>
            <tr>
                <td><strong>Konsentrasi Keahlian</strong></td>
                <td><strong>:</strong></td>
                <td>{{ $siswa->konsentrasi_keahlian }}</td>
            </tr>
            <tr>
                <td><strong>Kelas</strong></td>
                <td><strong>:</strong></td>
                <td>{{ $siswa->kelas }}</td>
            </tr>
            <tr>
                <td><strong>Kelompok</strong></td>
                <td><strong>:</strong></td>
                <td>{{ $siswa->kode_kelompok }}</td>
            </tr>
            <tr>
                <td><strong>Dudi</strong></td>
                <td><strong>:</strong></td>
                <td>{{ $siswa->nama_dudi }}</td>
            </tr>
        </table>
        <br>
       
        <h4 class="mt-3">Nilai PKL</h4>
        <br>

        <!-- Batas Lebar Tabel Monitoring -->
        <div class="container" style=" margin-left: 0;">
            <div class="row">
                <!-- Left Column: Table -->
                <div class="col-md-8" >
                    <table class="table-striped custom-table">
                        <thead>
                            <tr>
                                <th>Aspek</th>
                                <th>Nilai</th>
                                <th>Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="text-align: left;">Laporan Jurnal PKL</td>
                                <td class="{{ $nilaiJurnalFull  >= 100 ? 'text-success' : ($nilaiJurnalFull  > 0 ? 'text-warning' : 'text-danger') }}">
                                    {{ $nilaiJurnalFull  }}
                                </td>
                                <td>Silahkan scroll ke bawah</td>
                            </tr>
                            <tr>
                                <td style="text-align: left;">Nilai PKL Dudi</td>
                                <td class="{{ $nilaiDudiFull > 0 ? 'text-success' : 'text-danger' }}">
                                    {{ $nilaiDudiFull }}
                                </td>
                                <td>
                                    @if($nilaiPklDudi && $nilaiPklDudi->file_path)
                                        <a href="{{ route('admin.download.nilai.pkl', ['nis' => $nis]) }}" target="_blank">Lihat/Download Nilai PKL</a>
                                    @else
                                        <span class="text-danger">Belum Diunggah</span>
                                    @endif
                                </td>
                            </tr>
                            <tr >
                                <td style="text-align: left;">Monitoring Pembimbing</td>
                                <td class=" {{ $statusMonitoringColor }}">{{ $nilaiMonitoringFull }}</td>
                                <td>Silahkan scroll ke bawah</td>
                            </tr>                
                            <tr>
                                <td style="text-align: left;">Laporan Pengimbasan</td>
                                <td class="{{ $nilaiPengimbasanFull ? 'text-success' : 'text-danger' }}">
                                    {{ $nilaiPengimbasanFull }}
                                </td>
                                <td>
                                    @if($laporanPengimbasanUrl && $laporanPengimbasan->laporan_pengimbasan)
                                        <a href="{{ $laporanPengimbasanUrl }}" target="_blank">{{ $laporanPengimbasan->laporan_pengimbasan }}</a>
                                    @else
                                        <span class="text-danger">Belum Diunggah</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: left;">Laporan Akhir PKL</td>
                                <td class="{{ $nilaiAkhirPKLFull ? 'text-success' : 'text-danger' }}">
                                    {{ $nilaiAkhirPKLFull }}
                                </td>
                                <td>
                                    @if($laporanAkhirUrl && $laporanAkhir->laporan_akhir)
                                        <a href="{{ $laporanAkhirUrl }}" target="_blank">{{ $laporanAkhir->laporan_akhir }}</a>
                                    @else
                                        <span class="text-danger">Belum Diunggah</span>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td>Total Nilai</td>
                                <td class="{{ $totalNilai == 50 ? 'text-success' : ($totalNilai > 0 ? 'text-warning' : 'text-danger') }}">
                                    {{ $totalNilai }}
                                </td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <!-- Right Column: Info Status -->
                <div class="col-md-4">
                    <div style=" margin-top: 20px; text-align: left">
                        <p style="margin-left: 15px"><strong>Info Status</strong></p>
                        <ul>
                            <li><span class="text-success">Hijau:</span> Sudah lengkap</li>
                            <li><span class="text-warning">Kuning:</span> Masih Proses</li>
                            <li><span class="text-danger">Merah:</span> Belum ada</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <br>

        <h4 class="mt-3 text-left">Detail Monitoring</h4>
        <br>
        <table class="table-striped custom-table">
            <thead class="table-primary text-center">
                <tr>
                    <th>Bulan</th>
                    <th>Nilai TP 1</th>
                    <th>Nilai TP 2</th>
                    <th>Nilai TP 3</th>
                    <th>Nilai TP 4</th>
                    <th>Nilai</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($monitoringPerSiswa as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td> <!-- Urutan bulan -->
                        <td>{{ $data->nilai_tp1 }}</td>
                        <td>{{ $data->nilai_tp2 }}</td>
                        <td>{{ $data->nilai_tp3 }}</td>
                        <td>{{ $data->nilai_tp4 }}</td>
                        <td>{{ $data->nilai_monitoring }}</td>
                    </tr>
                @endforeach 
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="5">Nilai Akhir Monitoring</td>
                    <td>{{ $nilaiAkhirMonitoring }}</td>
                </tr> 
            </tfoot>
        </table>
        <br>

        <h4 class="mt-3 text-left">Laporan Jurnal PKL</h4>
        <br>
        <br>
        <div>
            <div class="d-flex justify-content-between align-items-center mb-3">
                <form action="" method="GET">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <!-- Dropdown filter Bulan -->
                            <select class="form-select d-inline-block w-auto" name="bulan">
                                <option value="">Pilih Bulan</option>
                                @for ($i = 1; $i <= 12; $i++)
                                    <option value="{{ $i }}" {{ $bulan == $i ? 'selected' : '' }}>
                                        {{ \Carbon\Carbon::create()->month($i)->translatedFormat('F') }}
                                    </option>
                                @endfor
                            </select>
                
                            <!-- Dropdown filter Tahun -->
                            <select class="form-select d-inline-block w-auto" name="tahun">
                                <option value="" disabled selected>Pilih Tahun</option>
                                @foreach ($availableYears as $year)
                                    <option value="{{ $year }}" {{ $tahun == $year ? 'selected' : '' }}>
                                        {{ $year }}
                                    </option>
                                @endforeach
                            </select>                                
                
                            <!-- Tombol Submit -->
                            <button type="submit" class="btn btn-primary">Filter</button>
                        </div>
                    </div>
                </form>
                
            </div>
            <table class="table-striped custom-table">
                <thead class="table-primary text-center">
                    <tr class="text-center" >
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Kegiatan/Progress</th>
                        <th>Lokasi</th>
                    </tr>
                    <br>
                </thead>
                <tbody id="data-table">
                    @forelse ($jurnals as $index => $jurnal)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ \Carbon\Carbon::parse($jurnal->tanggal)->format('d/m/Y') }}</td>
                            <td>{{ $jurnal->kegiatan }}</td>
                            <td>{{ $jurnal->lokasi }}</td> 
                        </tr>
                     @empty
                        <tr>
                            <td colspan="4">Tidak ada data jurnal untuk bulan dan tahun yang dipilih.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
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
        <br>
        <br>

    </div>
</div>



@endsection