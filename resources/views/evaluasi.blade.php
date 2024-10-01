@extends('layouts.headerpembimbing')


@section('content')

<div class="container mt-5 table-wrapper">
    <h4 class="text-center">EVALUASI PKL</h4>
    <br>
    
  <!-- Filter Tahun dan konsentrasi_keahlian -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div >
            <select class="form-select d-inline-block w-auto" name="tahun">
                <option selected>Tahun</option>
                <!-- Tambahkan opsi tahun -->
            </select>
            <select class="form-select d-inline-block w-auto" name="konsentrasi_keahlian">
                <option selected>konsentrasi_keahlian</option>
                <!-- Tambahkan opsi konsentrasi_keahlian -->
            </select>
        </div>
    </div>

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
            {{-- @foreach($dataEvaluasi as $index => $evaluasi) --}}
                {{-- <tr class="text-center">
                    {{-- <td>{{ $index + 1 }}</td>
                    <td>{{ $evaluasi->kelompok->kode_kelompok ?? '-' }}</td>
                    <td>{{ $evaluasi->NIS }}</td>
                    <td>{{ $evaluasi->nama }}</td>
                    <td>{{ $evaluasi->konsentrasiKeahlian->nama_keahlian ?? '-' }}</td>
                    <td>{{ $evaluasi->kelas }}</td>
                    <td>{{ $evaluasi->tahun }}</td>
                    <td>
                        @if($evaluasi->evaluasi)
                            <a href="{{ asset('storage/evaluasi/' . $evaluasi->evaluasi) }}" class="btn btn-link">Lihat Evaluasi</a>
                        @else
                            <span>Tidak ada evaluasi</span>
                        @endif
                    </td> --}}
                {{-- </tr> --}} 
            {{-- @endforeach --}}
            
            <!-- Data contoh, akan diisi dengan JavaScript -->
            <tr>
                <td>1</td>
                <td>K001</td>
                <td>
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
                    <a href="{{ route('evaluasi_persiswa') }}" class="btn" style="background-color: #e67e55; border-radius: 5px; padding: 5px;">
                        {{-- {{ route('evaluasi_persiswa', ['nis' => $data->siswa->NIS]) }} --}}
                        <i class="bi bi-file-earmark" style="font-size: 16px; color: white;"></i>
                    </a>
                </td>
            </tr>
            <tr>
                <td>1</td>
                <td>K001</td>
                <td>
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
                    <a href="{{ route ('evaluasi_persiswa')}}" class="btn" style="background-color: #e67e55; border-radius: 5px; padding: 5px;">
                        <i class="bi bi-file-earmark" style="font-size: 16px; color: white;"></i>
                    </a>
                </td>
            </tr>
        </tbody>
        {{-- <tbody>
            @foreach ($students as $index => $student)
            <tr>
                <td>{{ $index + 1 }}</td>
                 <td>{{ $student->kelompok }}</td>
                <td>{{ $student->nis }}</td>
                <td>{{ $student->nama }}</td>
                <td>{{ $student->konsentrasi_keahlian }}</td>
                <td>{{ $student->kelas }}</td>
                <td>{{ $student->tahun }}</td>
                <td>{{ $student->monitoring}}</td>
            </tr>
            @endforeach
        </tbody> --}}

    </table>

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

@endsection