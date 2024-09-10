@extends('layouts.headerpembimbing')

@section('content')

<div class="container mt-5">
    
    <div class="" style="background-color: #ffffff; border-radius: 10px; padding: 20px;">
        <div class="d-flex justify-content-start mb-3">
            <button onclick="window.history.back()" style="background-color: #0275d8; color: #ffffff; border: none; padding: 5px 10px; border-radius: 5px;">
                <i class="bi bi-arrow-left"></i> Kembali
            </button>
        </div>
        
        <h2 class="text-center mt-2">Monitoring</h2>
        <br>
        
        {{-- <div class="mt-4">
            <p><strong>Nama :</strong> {{ $student['name'] }}</p>
            <p><strong>NIS :</strong> {{ $student['nis'] }}</p>
            <p><strong>Jurusan :</strong> {{ $student['jurusan'] }}</p>
            <p><strong>Kelas :</strong> {{ $student['kelas'] }}</p>
            <p><strong>DUDI :</strong> {{ $student['dudi'] }}</p>
        </div> --}}

        <div class="container mt-4">
            <p><strong>Nama :</strong> Rulli Arhan</p>
            <p><strong>NIS :</strong> 17672</p>
            <p><strong>Jurusan :</strong> Teknik Komputer Jaringan</p>
            <p><strong>Kelas :</strong> TKJ 1</p>
            <p><strong>DUDI :</strong> PT Telkom Indonesia</p>
        </div>

        <div class="my-3">
            <br>
            <a href="#" class="btn btn-link">Template Monitoring PKL</a>
        </div>

        <div class="container mt-5">
            <!-- Batas Lebar Tabel -->
            <div style="max-width: 50%;">
        
                <table class="table table-bordered" >
                    <thead class="table-primary" >
                        <tr >
                            <th>Bulan</th>
                            <th>Monitoring</th>
                            <th>Import</th>
                            <th>Ket</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Ke-1</td>
                            <td>
                                <form method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <label for="file-upload-1" class="btn bi bi-file-earmark" style="background-color: #9173c3; border-radius: 10px;color: white; padding: 5px;"> Upload </label>
                                    <input id="file-upload-1" type="file" name="file" class="d-none" onchange="this.form.submit()">
                                </form>
                            </td>
                            <td><button class="btn btn-warning">Import</button></td>
                            <td class="text-center">
                                <input type="checkbox" name="check[]" value="1">
                            </td>
                        </tr>
                        <tr>
                            <td>Ke-2</td>
                            <td>
                                <form method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <label for="file-upload-2" class="btn bi bi-file-earmark" style="background-color: #9173c3; border-radius: 10px;color: white; padding: 5px;"> Upload </label>
                                    <input id="file-upload-2" type="file" name="file" class="d-none" onchange="this.form.submit()">
                                </form>
                            </td>
                            <td><button class="btn btn-warning">Import</button></td>
                            <td class="text-center">
                                <input type="checkbox" name="check[]" value="1">
                            </td>
                        </tr>
                        <tr>
                            <td>Ke-3</td>
                            <td>
                                <form method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <label for="file-upload-3" class="btn bi bi-file-earmark" style="background-color: #9173c3; border-radius: 10px;color: white; padding: 5px;"> Upload </label>
                                    <input id="file-upload-3" type="file" name="file" class="d-none" onchange="this.form.submit()">
                                </form>
                            </td>
                            <td><button class="btn btn-warning">Import</button></td>
                            <td class="text-center">
                                <input type="checkbox" name="check[]" value="1">
                            </td>
                        </tr>
                    </tbody>
                </table>
        
            </div> <!-- End of max-width wrapper -->
        </div>
        <br>

        <h4 class="mt-5 text-left">Detail Monitoring</h4><br>
        <table class="table table-bordered">
            <thead class="table-primary">
                <tr>
                    <th>Bulan</th>
                    <th>1. Softskill</th>
                    <th>2. Norma</th>
                    <th>3. Kompetensi</th>
                    <th>4. DUDI</th>
                    <th>Nilai Akhir</th>
                </tr>
            </thead>
            {{-- <tbody>
                @foreach($detailMonitoring as $detail)
                    <tr>
                        <td>{{ $detail['bulan'] }}</td>
                        <td>{{ $detail['softskill'] }}</td>
                        <td>{{ $detail['norma'] }}</td>
                        <td>{{ $detail['kompetensi'] }}</td>
                        <td>{{ $detail['dudi'] }}</td>
                        <td>{{ $detail['nilai_akhir'] }}</td>
                    </tr>
                @endforeach
                <tr class="table-primary">
                    <td colspan="5" class="text-end"><strong>Total Nilai</strong></td>
                    <td>{{ array_sum(array_column($detailMonitoring, 'nilai_akhir')) }}</td>
                </tr>
            </tbody> --}}
            <tbody class="table table-striped">
                <tr>
                    <td>Ke-1</td>
                    <td>90</td>
                    <td>90</td>
                    <td>90</td>
                    <td>90</td>
                    <td>90</td>
                </tr>
                <tr>
                    <td>Ke-2</td>
                    <td>90</td>
                    <td>90</td>
                    <td>90</td>
                    <td>90</td>
                    <td>90</td>
                </tr>
                <tr>
                    <td>Ke-3</td>
                    <td>90</td>
                    <td>90</td>
                    <td>90</td>
                    <td>90</td>
                    <td>90</td>
                </tr>
            </tbody>
            <tfoot >
                <tr>
                    <td colspan="5" >Total Nilai</td>
                    <td>170</td> <!-- Contoh total dari semua nilai -->
                </tr>
                <tr>
                    <td colspan="5">Rata-rata</td>
                    <td>85</td> <!-- Contoh rata-rata -->
                </tr>
            </tfoot>

        </table>

        {{-- <div class="total-nilai d-flex justify-content-between">
            <span>Total Nilai</span>
            <span>90</span> <!-- Ganti nilai 90 dengan nilai dinamis dari database -->
        </div> --}}

        <div class="mt-4 d-flex justify-content-left">
            <button class="btn btn-primary">Export Nilai PKL</button>
        </div>
        <br>
        <br>
    </div>
</div>


@endsection