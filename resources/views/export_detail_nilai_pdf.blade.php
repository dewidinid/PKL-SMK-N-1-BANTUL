<!DOCTYPE html>
<html>
<head>
    <title>Detail Nilai PDF</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Detail Nilai Siswa</h1>
    <table>
        <thead>
            <tr>
                <th>NIS</th>
                <th>Nama</th>
                <th>Total Nilai</th>
                <!-- Add other fields as needed -->
            </tr>
        </thead>
        <tbody>
            @foreach ($detailNilai as $nilai)
                <tr>
                    <td>{{ $nilai->siswa->NIS }}</td>
                    <td>{{ $nilai->siswa->nama_siswa }}</td>
                    <td>{{ $nilai->total_nilai }}</td>
                    <!-- Add other fields as needed -->
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
