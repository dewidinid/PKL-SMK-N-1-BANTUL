<!DOCTYPE html>
<html>
<head>
    <title>Laporan Nilai PKL Siswa SMK Bantul</title>
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
        /* Gaya baris ganjil dan genap */
        .table-striped tbody tr:nth-child(odd), .custom-table tbody tr:nth-child(odd) {
            background-color: #f8f8f8 !important; /* Warna ganjil */
        }

        .table-striped tbody tr:nth-child(even), .custom-table tbody tr:nth-child(even) {
            background-color: #C5D7E0 !important; /* Warna genap */
        }
        .signature-table {
            width: 100%;
            margin-top: 40px;
            font-size: 14px;
            border-collapse: collapse;
            border: none; /* Sembunyikan semua garis tabel */
        }

        .signature-table td {
            text-align: center;
            vertical-align: top;
            padding: 10px;
            border-collapse: collapse;
            border: none; /* Sembunyikan semua garis di setiap sel */
            background-color: transparent;
        }

        .date-right {
            text-align: right;
            margin-right: 20px;
            font-size: 14px;
        }

        .signature-line {
            display: inline-block; /* Agar lebar garis mengikuti konten */
            border-bottom: 1px solid #000;
            width: auto;
            margin: 5px auto;
            padding-bottom: 5px;
        }



    </style>
</head>
<body>
    <h2>Laporan Nilai PKL Siswa SMK Bantul</h2>
    <h3> {{ $namaDudi }}</h3>
    <h3>Tahun {{ $tahunAngkatan }}</h3>
    <br>
    <br>
    <div class="table-container">
        {{-- <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIS</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Konsentrasi Keahlian</th>
                    <th>TP1 (Soft Skills)</th>
                    <th>TP2 (Norma & POS)</th>
                    <th>TP3 (Kompetensi Teknis)</th>
                    <th>TP4 (Wawasan Wirausaha)</th>
                    <th>Total Nilai</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($detailNilai as $index => $nilai)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $nilai->siswa->NIS }}</td>
                        <td>{{ $nilai->siswa->nama_siswa }}</td>
                        <td>{{ $nilai->siswa->kelas }}</td>
                        <td>{{ $nilai->siswa->konsentrasi_keahlian }}</td>
                        <td>{{ $nilai->tp1_soft_skills }}</td>
                        <td>{{ $nilai->tp2_norma_pos }}</td>
                        <td>{{ $nilai->tp3_kompetensi_teknis }}</td>
                        <td>{{ $nilai->tp4_wawasan_wirausaha }}</td>
                        <td>{{ $nilai->nilai }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table> --}}
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIS</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Konsentrasi Keahlian</th>
                    <th>TP1 (Soft Skills)</th>
                    <th>TP2 (Norma & POS)</th>
                    <th>TP3 (Kompetensi Teknis)</th>
                    <th>TP4 (Wawasan Wirausaha)</th>
                    <th>Total Nilai</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($detailNilai as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->siswa->NIS ?? 'N/A' }}</td>
                    <td>{{ $item->siswa->nama_siswa ?? 'N/A' }}</td>
                    <td>{{ $item->siswa->kelas ?? 'N/A' }}</td>
                    <td>{{ $item->siswa->konsentrasi_keahlian ?? 'N/A' }}</td>
                    <td>{{ $item->nilaiPkl->tp1_soft_skills ?? 0 }}</td>
                    <td>{{ $item->nilaiPkl->tp2_norma_pos ?? 0 }}</td>
                    <td>{{ $item->nilaiPkl->tp3_kompetensi_teknis ?? 0 }}</td>
                    <td>{{ $item->nilaiPkl->tp4_wawasan_wirausaha ?? 0 }}</td>
                    <td>{{ $item->nilaiPkl->nilai ?? 0 }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
    </div>

    <br>
    <br>
    <!-- Tanggal di kanan atas -->
    <p class="date-right">........., ... / ... / ......</p>

    <!-- Bagian tanda tangan dalam tabel -->
    <table class="signature-table">
        <tr>
            <!-- Tanda tangan Ketua Pelaksana -->
            <td>
                <p>Pembimbing,</p>
                <br>
                <br>
                <p class="signature-line">(.........................................)</p>
                <p>NIP: ............................</p>
            </td>
            
            <!-- Spacer kolom untuk jarak antara Ketua dan Sekretaris -->
            <td style="width: 20%;"></td>
            
            <!-- Tanda tangan Sekretaris -->
            <td>
                <p>Mitra Dudi,</p>
                <br>
                <br>
                <p class="signature-line">(.........................................)</p>
                <p>NIP: ............................</p>
            </td>
        </tr>
        <tr>
            <td colspan="3" style="padding-top: 20px; text-align: center;">
                <!-- Tanda tangan Kepala Sekolah di bawah dan tengah -->
                <p>Mengetahui:</p>
                <p>Kepala Sekolah,</p>
                <br>
                <br>
                <p class="signature-line">(.........................................)</p>
                <p>NIP: ............................</p>
            </td>
        </tr>
    </table>


</body>
</html>
