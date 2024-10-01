<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evaluasi PKL - {{ $siswa->nama_siswa }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        h2 {
            text-align: center;
        }
    </style>
</head>
<body>
    <h2>Evaluasi PKL - {{ $siswa->nama_siswa }}</h2>

    <table>
        <thead>
            <tr>
                <th>Evaluasi</th>
                <th>Persentase</th>
                <th>Nilai Akhir</th>
            </tr>
        </thead>
        <tbody>
            @foreach($evaluasi as $item)
            <tr>
                <td>{{ $item->evaluasi }}</td>
                <td>{{ $item->persentase }}%</td>
                <td>{{ $item->nilai_akhir }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <p style="text-align: right; margin-top: 20px;">
        Total Nilai: <strong>{{ $totalNilai }}</strong>
    </p>
</body>
</html>
