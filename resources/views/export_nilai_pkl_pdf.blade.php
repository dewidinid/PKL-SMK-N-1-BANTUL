<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nilai PKL Siswa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .table-container {
            max-width: 100%;
            overflow-x: auto;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px; /* Adjust font size for better fit */
            border-radius: 15px !important; 
        }

        /* Gaya baris ganjil dan genap */
        .table-striped tbody tr:nth-child(odd), .custom-table tbody tr:nth-child(odd) {
            background-color: #f8f8f8 !important; /* Warna ganjil */
        }

        .table-striped tbody tr:nth-child(even), .custom-table tbody tr:nth-child(even) {
            background-color: #C5D7E0 !important; /* Warna genap */
        }
        
        th, td {
            border: 1px solid #dee2e6;
            padding: 6px;
            text-align: center;
            word-wrap: break-word;
        }
        th {
            background-color: #0275db;
            color: white;
        }
        h2, h3 {
            text-align: center;
            color: #333;
            margin-bottom: 5px;
        }

        .student-info {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px; /* Sesuaikan ukuran font jika diperlukan */
        }
        .student-info td {
            border: none;
            padding: 4px 8px;
        }
        .student-info td:first-child {
            font-weight: bold;
            text-align: left;
            width: 30%; /* Atur lebar kolom label */
        }
        .student-info td:last-child {
            text-align: left;
            width: 70%; /* Atur lebar kolom nilai */
        }

    </style>
</head>
<body>

    <h3>Nilai PKL Siswa</h3>

    <br>
    <br>

    <!-- Informasi Siswa -->
    <table class="student-info">
        <tr>
            <td><strong>NIS</strong></td>
            <td><strong>:</strong></td>
            <td>{{ $siswa->NIS }}</td>
        </tr>
        <tr>
            <td><strong>Nama</strong></td>
            <td><strong>:</strong></td>
            <td>{{ $siswa->nama_siswa }}</td>
        </tr>
        <tr>
            <td><strong>Konsentrasi Keahlian</strong></td>
            <td><strong>:</strong></td>
            <td>{{ $siswa->konsentrasi_keahlian }}</td>
        </tr>
        <tr>
            <td><strong>Kelas</strong></td>
            <td><strong>:</strong></td>
            <td>{{ $siswa->kelas }}</td>
        </tr>
        <tr>
            <td><strong>Kelompok</strong></td>
            <td><strong>:</strong></td>
            <td>{{ $siswa->kode_kelompok }}</td>
        </tr>
        <tr>
            <td><strong>Tahun Ajaran</strong></td>
            <td><strong>:</strong></td>
            <td>{{ $siswa->tahun }}</td>
        </tr>
    </table>
    


    <br>
    <br>

    <table class="table table-striped" style="max-width: 70%; ">
        <thead>
            <tr>
                <th>Aspek</th>
                <th>Nilai</th>
            </tr>
        </thead>
        <tbody id="data-table">
            <tr>
                <td>Laporan / Jurnal PKL</td>
                <td>{{ number_format($nilaiPkl->persentase_jurnal, 2) }}</td>
            </tr>
            <tr>
                <td>Nilai PKL Dudi</td>
                <td>{{ number_format($nilaiPkl->nilai_akhir_dudi, 2) }}</td>
            </tr>
            <tr>
                <td>Monitoring Pembimbing</td>
                <td>{{ number_format($nilaiPkl->monitoring_pembimbing, 2) }}</td>
            </tr>
            <tr>
                <td>Laporan Pengimbasan</td>
                <td>{{ number_format($nilaiPkl->nilai_pengimbasan, 2) }}</td>
            </tr>
            <tr>
                <td>Laporan Akhir PKL</td>
                <td>{{ number_format($nilaiPkl->nilai_akhir_pkl, 2) }}</td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <th>Total Nilai</th>
                <th>{{ number_format($totalNilai, 2) }}</th>
            </tr>
        </tfoot>
    </table>

</body>
</html>
