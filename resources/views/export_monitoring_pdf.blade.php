<!DOCTYPE html>
<html>
<head>
    <title>Monitoring Per Siswa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .details-table {
            width: 100%;
            margin-top: 10px;
            margin-bottom: 20px;
        }
        .details-table td {
            padding: 5px 10px;
            font-size: 12px;
            vertical-align: top;
        }
        .details-table .label {
            width: 30%;
            font-weight: bold;
            text-align: left;
            white-space: nowrap;
        }
        .details-table .colon {
            width: 5%;
            text-align: left;
        }
        .details-table .value {
            width: 65%;
            text-align: left;
        }
        .table-container {
            max-width: 100%;
            overflow-x: auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            border: 1px solid white;
            padding: 8px;
            text-align: center;
            color: #333;
        }
        th {
            background-color: #0275d8;
            color: white;
        }
        .table-striped tbody tr:nth-child(odd) {
            background-color: #f8f8f8 !important;
        }
        .table-striped tbody tr:nth-child(even) {
            background-color: #C5D7E0 !important;
        }
        .footer {
            text-align: right;
            margin-top: 20px;
            font-size: 12px;
        }
    </style>
</head>
<body>

    <h2 class="header">Laporan Monitoring Per Siswa</h2> <br>
    
    <!-- Tabel Detail Siswa -->
    <table class="details-table">
        <tr>
            <td class="label">Nama</td>
            <td class="colon">:</td>
            <td class="value">{{ $siswa->nama_siswa }}</td>
        </tr>
        <tr>
            <td class="label">NIS</td>
            <td class="colon">:</td>
            <td class="value">{{ $siswa->NIS }}</td>
        </tr>
        <tr>
            <td class="label">Konsentrasi Keahlian</td>
            <td class="colon">:</td>
            <td class="value">{{ $siswa->konsentrasi_keahlian }}</td>
        </tr>
        <tr>
            <td class="label">Kelas</td>
            <td class="colon">:</td>
            <td class="value">{{ $siswa->kelas }}</td>
        </tr>
        <tr>
            <td class="label">DUDI</td>
            <td class="colon">:</td>
            <td class="value">{{ $siswa->nama_dudi }}</td>
        </tr>
    </table>

    <div class="table-container">
        <h3 style="text-align: center;">Detail Monitoring</h3>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Bulan</th>
                    <th>TP1 (Soft Skills)</th>
                    <th>TP2 (Norma & POS)</th>
                    <th>TP3 (Kompetensi Teknis)</th>
                    <th>TP4 (Wawasan Wirausaha)</th>
                    <th>Nilai</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($monitoringPerSiswa as $index => $data)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $data->nilai_tp1 }}</td>
                    <td>{{ $data->nilai_tp2 }}</td>
                    <td>{{ $data->nilai_tp3 }}</td>
                    <td>{{ $data->nilai_tp4 }}</td>
                    <td>{{ $data->nilai_monitoring }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div> <br><br>

    <div class="footer">
        <p>Dicetak pada {{ now()->format('d-m-Y') }}</p>
    </div>

</body>
</html>