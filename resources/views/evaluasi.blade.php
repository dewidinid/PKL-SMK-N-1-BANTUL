@extends('layouts.headerpembimbing')


@section('content')

<div class="container mt-5 table-wrapper">
    <h4 class="text-center">EVALUASI PKL</h4>
    <br><br>
    
    <form method="GET" action="{{ route('filterEvalPem') }}">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <select class="form-select d-inline-block w-auto" name="kode_kelompok">
                    <option selected>Kode Kelompok</option>
                    @foreach ($kodeKelompokOptions as $kodeKelompok)
                        <option value="{{ $kodeKelompok }}" {{ request('kode_kelompok') == $kodeKelompok ? 'selected' : '' }}>
                            {{ $kodeKelompok }}
                        </option>
                    @endforeach
                </select>
                <select class="form-select d-inline-block w-auto" name="tahun">
                    <option selected>Tahun</option>
                    @foreach($tahunOptions as $option)
                        <option value="{{ $option }}" {{ request('tahun') == $option ? 'selected' : '' }}>
                            {{ $option }}
                        </option>
                    @endforeach
                </select>
                <select class="form-select d-inline-block w-auto" name="konsentrasi_keahlian">
                    <option selected>Konsentrasi Keahlian</option>
                    @foreach($keahlianOptions as $option)
                        <option value="{{ $option }}" {{ request('konsentrasi_keahlian') == $option ? 'selected' : '' }}>
                            {{ $option }}
                        </option>
                    @endforeach
                </select>
    
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>
        </div>
    </form>
    

    <table class="table-striped custom-table">
        <thead class="table-primary text-center">
            <tr class="text-center" >
                <th>No</th>
                <th>Kelompok</th>
                <th>NIS</th>
                <th >Nama</th>
                <th>Konsentrasi Keahlian</th>
                <th>Kelas</th>
                <th>Tahun</th>
                <th>Evaluasi</th>
            </tr>
        </thead>
        <tbody id="data-table">
            @foreach($dataEvaluasi as $index => $evaluasi)
                <tr class="text-center">
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $evaluasi->kode_kelompok }}</td>
                    <td>{{ $evaluasi->siswa->NIS }}</td>
                    <td>{{ $evaluasi->siswa->nama_siswa }}</td>
                    <td>{{ $evaluasi->siswa->konsentrasi_keahlian }}</td>
                    <td>{{ $evaluasi->siswa->kelas }}</td>
                    <td>{{ $evaluasi->siswa->tahun }}</td>
                    <td>
                        <a href="{{ route('evaluasi_persiswa', ['nis' => $evaluasi->NIS]) }}" class="btn" style="background-color: #e67e55; border-radius: 5px; padding: 5px;">
                            <i class="bi bi-file-earmark" style="font-size: 16px; color: white;"></i>
                        </a>
                        
                    </td>
                    
                </tr>
            @endforeach
        </tbody>

    </table>

    <br><br>

    <div class="pagination-container" style="display: flex; justify-content: center; align-items: center;">
        <button class="pagination-btn" onclick="prevPage()" id="prev-btn" disabled>Sebelumnya</button>
        <div id="pagination-numbers" style="display: flex; gap: 10px; margin: 0 20px;">
            <!-- Angka halaman akan diisi dengan JavaScript -->
        </div>
        <button class="pagination-btn" onclick="nextPage()" id="next-btn">Selanjutnya</button>
    </div>

</div>

@endsection