@extends('layouts.headerpembimbing')


@section('content')

<div class="container mt-5 table-wrapper">
    <h4 class="text-center">MONITORING</h4>
    <br>
    
  <!-- Filter Tahun dan Jurusan -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div >
            <select class="form-select d-inline-block w-auto" name="tahun">
                <option selected>Tahun</option>
                <!-- Tambahkan opsi tahun -->
            </select>
            <select class="form-select d-inline-block w-auto" name="jurusan">
                <option selected>Jurusan</option>
                <!-- Tambahkan opsi jurusan -->
            </select>
        </div>
    </div>

    <table class="table-striped custom-table">
        <thead class="table-primary text-center">
            <tr class="text-center" >
                <th>No</th>
                <th>Kelompok</th>
                <th>NIS</th>
                <th id="nama">Nama</th>
                <th>Konsentrasi Keahlian</th>
                <th>Kelas</th>
                <th>Tahun</th>
                <th>Monitoring</th>
            </tr>
        </thead>
        <tbody id="data-table" >
            @foreach ($monitoring as $index => $data)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $data->kelompok->kode_kelompok }}</td>
                <td>{{ $data->siswa->NIS }}</td>
                <td>{{ $data->siswaByNama->nama_siswa }}</td>
                <td>{{ $data->konsentrasiKeahlian->nama_konsentrasi }}</td>
                <td>{{ $data->siswaByKelas->kelas }}</td>
                <td>{{ $data->siswaByTahun->tahun }}</td>
                <td><a href="{{ route('monitoring.show', $data->id_monitoring) }}">Lihat Detail</a></td>
            </tr>
            @endforeach
            <!-- Data contoh, akan diisi dengan JavaScript -->
            <tr>
                <td>1</td>
                <td>K001</td>
                <td >
                    <div>17672</div>
                    <div>17875</div>
                </td>
                <td class="left-align">
                    <div>Rulli Arhan</div>
                    <div>Meisya Renata</div>
                </td>
                <td>Teknik Komputer Jaringan</td>
                <td>TKJ 1</td>
                <td>2024/2025</td>
                <td>
                    <a href="{{ route ('monitoring_persiswa')}}" class="btn" style="background-color: #9173c3; border-radius: 5px; padding: 5px;">
                        <i class="bi bi-file-earmark" style="font-size: 16px; color: white;"></i>
                    </a>
                </td>
            </tr>
            <tr>
                <td>1</td>
                <td>K001</td>
                <td >
                    <div>17672</div>
                    <div>17875</div>
                </td>
                <td class="left-align">
                    <div>Rulli Arhan</div>
                    <div>Meisya Renata</div>
                </td>
                <td>Teknik Komputer Jaringan</td>
                <td>TKJ 1</td>
                <td>2024/2025</td>
                <td>
                    <a href="{{ route ('monitoring_persiswa')}}" class="btn" style="background-color: #9173c3; border-radius: 5px; padding: 5px;">
                        <i class="bi bi-file-earmark" style="font-size: 16px; color: white;"></i>
                    </a>
                </td>
            </tr>
        </tbody>

    </table>
</div>
    
@endsection