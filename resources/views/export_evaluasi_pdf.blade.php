<!DOCTYPE html>
<html>
<head>
    <title>Evaluasi PKL Siswa</title>
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
        tfoot td {
            background-color: #0275d8; 
            color: white;
            font-weight: bold;
        }

        .footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            text-align: right;
            font-size: 12px;
            padding: 10px;
            box-sizing: border-box;
        }

        /* Styling khusus untuk cetak */
        @media print {
            body, html {
                height: 100%;
                margin: 0;
                padding: 0;
            }
            .footer {
                position: fixed;
                bottom: 0;
            }
        }
    </style>
</head>
<body>

    <h2 class="header">Laporan Evaluasi PKL Siswa</h2> <br>
    
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
        <h3 style="text-align: center;">Detail Evaluasi</h3>
        <table class="table table-striped">
            <thead>
                <tr class="left-align">
                    <th>Evaluasi</th>
                    <th>Persentase</th>
                    <th>Nilai Akhir</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($evaluasi as $data)
                <tr>
                    <td>Laporan / Jurnal PKL</td>
                    <td>10%</td>
                    <td>{{ $data->nilai_laporan_jurnalpkl }}</td>
                </tr>
                <tr>
                    <td>Nilai PKL Dudi</td>
                    <td>50%</td>
                    <td>{{ $data->nilai_pkldudi }}</td>
                </tr>
                <tr>
                    <td>Monitoring Pembimbing</td>
                    <td>20%</td>
                    <td>{{ $data->nilai_akhir_monitoring }}</td>
                </tr>
                <tr>
                    <td>Laporan Pengimbasan</td>
                    <td>10%</td>
                    <td>{{ $data->nilai_pengimbasan}}</td>
                </tr>
                <tr>
                    <td>Laporan Akhir PKL</td>
                    <td>10%</td>
                    <td>{{ $data->nilai_lap_akhir }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td>Nilai Akhir </td>
                    <td>10%</td>
                    <td>{{ $data->nilai_akhir}}</td>
                </tr>
            </tfoot>
        </table>
    </div> <br><br>

    <div class="footer">
        <p>Dicetak pada {{ now()->format('d-m-Y') }}</p>
    </div>

</body>
</html>