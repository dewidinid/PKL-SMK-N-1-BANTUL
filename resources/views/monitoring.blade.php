@extends('layouts.headerpembimbing')

@section('content')

<div class="container mt-5 table-wrapper">
    <h4 class="text-center">MONITORING</h4>
    <br><br>
    
  <!-- Form Filter -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <form action="{{ route('filterMonitoring') }}" method="GET">
                @csrf
                <!-- Dropdown untuk filter tahun -->
                <select class="form-select d-inline-block w-auto" name="tahun">
                    <option selected>Tahun</option>
                    @foreach($tahun as $t)
                        <option value="{{ $t }}">{{ $t }}</option>
                    @endforeach
                </select>
        
                <!-- Dropdown untuk filter konsentrasi keahlian -->
                <select class="form-select d-inline-block w-auto" name="konsentrasi_keahlian">
                    <option selected>Konsentrasi Keahlian</option>
                    @foreach($konsentrasi_keahlian as $kk)
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
                <th>Kelompok</th>
                <th>NIS</th>
                <th id="nama">Nama</th>
                <th>Konsentrasi Keahlian</th>
                <th>Kelas</th>
                <th>Tahun</th>
                <th>Monitoring</th>
            </tr>
        </thead>

        <tbody id="data-table">
            @foreach ($monitoring as $index => $data)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $data->kode_kelompok }}</td>
                <td>{{ $data->siswa->NIS }}</td>
                <td class="left-align">{{ $data->nama_siswa }}</td>
                <td>{{ $data->konsentrasi_keahlian }}</td>
                <td>{{ $data->kelas }}</td>
                {{-- <td>{{ $data->nama_dudi }}</td> --}}
                {{-- <td>{{ $data->nama_pembimbing }}</td> --}}
                <td>{{ $data->tahun }}</td>

                <td> 
                    <a href="{{ route('monitoring_persiswa', ['nis' => $data->NIS]) }}" class="btn" style="background-color: #9173c3; border-radius: 5px; padding: 5px;">
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