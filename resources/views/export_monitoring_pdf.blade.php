<!-- resources/views/export_monitoring_pdf.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Monitoring Per Siswa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        .container {
            padding: 30px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .details p {
            margin: 5px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            border: 1px solid #333;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #0275d8;
            color: white;
        }
        .footer {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Monitoring Per Siswa</h2>
        </div>

        <div class="details">
            <p><strong>Nama :</strong> {{ $siswa->nama_siswa }}</p>
            <p><strong>NIS :</strong> {{ $siswa->NIS }}</p>
            <p><strong>Konsentrasi Keahlian :</strong> {{ $siswa->konsentrasi_keahlian }}</p>
            <p><strong>Kelas :</strong> {{ $siswa->kelas }}</p>
            <p><strong>DUDI :</strong> {{ $siswa->nama_dudi }}</p>
        </div>

        <h4>Detail Monitoring</h4>
        <table>
            <thead>
                <tr>
                    <th>Bulan</th>
                    <th>Monitoring</th>
                    <th>Nilai Akhir</th>
                </tr>
            </thead>
            <tbody>
                @foreach($monitoring as $item)
                <tr>
                    <td>{{ $item->bulan }}</td>
                    <td>{{ $item->monitoring }}</td>
                    <td>{{ $item->nilai_akhir }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2"><strong>Total Nilai</strong></td>
                    <td>{{ $totalNilai }}</td>
                </tr>
                <tr>
                    <td colspan="2"><strong>Rata-Rata</strong></td>
                    <td>{{ number_format($rataRata, 2) }}</td>
                </tr>
            </tfoot>
        </table>

        <div class="footer">
            <p>Dicetak pada {{ now()->format('d-m-Y') }}</p>
        </div>
    </div>
</body>
</html>
