@extends('layouts.headersiswa')

@section('content')

<div class="container mt-5" >

    <div class="d-flex justify-content-start mb-3" style="margin-left: 20px;">
        <button onclick="window.location.href='{{ route('home_siswa') }}'" style="background-color: #439AC7; color: #ffffff; border: none; padding: 5px 10px; border-radius: 5px; margin-top: 10px;">
            <i class="bi bi-arrow-left"></i> Kembali
        </button>
    </div>
    <br>
    <h4 style="text-align: center;">ALUR PKL SMK N 1 BANTUL</h4>

    <div class="alur-container">
        <iframe src="https://viewer.diagrams.net/?tags=%7B%7D&lightbox=1&highlight=0000ff&edit=_blank&layers=1&nav=1&title=Tipe%20PKL%20SMK%20N%201%20Bantul.drawio#Uhttps%3A%2F%2Fdrive.google.com%2Fuc%3Fid%3D1RvNEvQ5dtYpDO33V21Ixa_nkneXFfI9v%26export%3Ddownload" frameborder="0" style="width:100%; height:auto; min-height:600px;"></iframe>
    </div>

    <br>
    <br>

    {{-- pengumuman --}}
    <h4 style="text-align: center;">Pengumuman</h4>
    <br>
    <br>

    <div class="d-flex justify-content-end align-items-center mb-3">
        <form method="GET" action="{{ route('pemetaan') }}" >
            <div>
                <select name="tahun" onchange="this.form.submit()" class="form-select d-inline-block w-auto">
                    <option value="">Pilih Tahun</option>
                    @foreach ($availableYears as $year)
                        <option value="{{ $year }}" {{ request('tahun') == $year ? 'selected' : '' }}>{{ $year }}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-primary" >Filter</button>
            </div> 
        </form>
    </div>

    <div style="max-height: 400px; overflow-y: auto;" id="jurnal-table-container"> <!-- Wadah scrollable -->
        <table class="table-striped custom-table">
            <thead class="table-primary text-center">
                <tr class="text-center">
                    <th>No</th>
                    <th>Kelompok</th>
                    <th>NIS</th>
                    <th>Nama</th>
                    <th>Konsentrasi Keahlian</th>
                    <th>Kelas</th>
                    <th>Tahun</th>
                    <th>Pembimbing</th>
                    <th>Dudi</th>
                    <th>Alamat Dudi</th>
                </tr>
            </thead>
            <tbody >
                @foreach ($plotingData as $index => $ploting)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $ploting->kode_kelompok }}</td>
                    <td>{{ $ploting->siswa->NIS }}</td>
                    <td>{{ $ploting->siswa->nama_siswa }}</td>
                    <td>{{ $ploting->siswa->konsentrasi_keahlian }}</td>
                    <td>{{ $ploting->siswa->kelas }}</td>
                    <td>{{ $ploting->siswa->tahun }}</td>
                    <td>{{ $ploting->nama_pembimbing }}</td>
                    <td>{{ $ploting->dudi->nama_dudi }}</td>
                    <td>{{ $ploting->dudi->alamat_dudi }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>


</div>
<br>
<br>
<br>
<br>
    

@endsection
