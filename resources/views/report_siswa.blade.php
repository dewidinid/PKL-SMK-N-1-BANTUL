@extends('layouts.headeradmin')

@section('content')

<div class="container mt-5 table-wrapper">
    <h4 class="text-center">Report Siswa</h4>
    <br><br>
    
  <!-- Form Filter -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <form action="{{ route('report_siswa') }}" method="GET">
                <select class="form-select d-inline-block w-auto" name="tahun">
                    <option selected>Tahun</option>
                    @foreach($tahun as $t)
                        <option value="{{ $t }}">{{ $t }}</option>
                    @endforeach
                </select>
                <select class="form-select d-inline-block w-auto" name="konsentrasi_keahlian">
                    <option selected>Konsentrasi Keahlian</option>
                    @foreach($konsentrasiKeahlian as $kk)
                        <option value="{{ $kk }}">{{ $kk }}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-primary">Filter</button>
            </form>
        </div>    
    </div>

    <table class="table-striped custom-table">
        <thead class="table-primary text-center">
            <tr class="text-center" >
                <th>No</th>
                <th>NIS</th>
                <th id="nama">Nama</th>
                <th>Konsentrasi Keahlian</th>
                <th>Kelas</th>
                <th>Kelompok</th>
                <th>Tahun</th>
                <th>Dudi</th>
                <th>Pemimbing</th>
                <th>Report</th>
            </tr>
        </thead>

        <tbody id="data-table">
            @foreach ($dataSiswa as $index => $data)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $data->siswa->NIS }}</td>
                <td>{{ $data->siswa->nama_siswa }}</td>
                <td>{{ $data->siswa->konsentrasi_keahlian }}</td>
                <td>{{ $data->siswa->kelas }}</td>
                <td>{{ $data->kode_kelompok }}</td>
                <td>{{ $data->siswa->tahun }}</td>
                <td>{{ $data->nama_dudi }}</td>
                <td>{{ $data->nama_pembimbing }}</td>

                <td> 
                    <a href="{{ route('report_siswa_persiswa', $data->siswa->NIS) }}" class="btn" style="background-color: #e4a0da; border-radius: 5px; padding: 5px;">
                        <i class="bi bi-file-earmark" style="font-size: 16px; color: white;"></i>
                    </a>                    
                </td>
                
            </tr>
            @endforeach
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

@endsection