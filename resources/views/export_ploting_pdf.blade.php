<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Ploting Siswa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        /* CSS untuk tabel mini dengan sudut melengkung */
.table-mini, .custom-mini-table {
    border-radius: 10px; /* Sudut melengkung */
    overflow: hidden;
    border-collapse: separate;
    width: 100%;
    table-layout: auto;
    font-size: 12px; /* Ukuran font lebih kecil */
}

/* Wrapper tabel mini */
.table-mini-wrapper, .custom-mini-table-wrapper {
    overflow-x: auto;
}

/* Gaya header tabel mini */
.table-mini thead th, .custom-mini-table thead th {
    background-color: #439AC7;
    color: white;
    text-align: center;
    padding: 4px 4px; /* Padding lebih kecil */
}

/* Sudut melengkung header tabel mini */
.table-mini thead, .custom-mini-table thead {
    border-top-left-radius: 6px;
    border-top-right-radius: 6px;
}

/* Gaya baris ganjil dan genap tabel mini */
.table-mini-striped tbody tr:nth-child(odd), .custom-mini-table tbody tr:nth-child(odd) {
    background-color: #f8f8f8 !important;
}

.table-mini-striped tbody tr:nth-child(even), .custom-mini-table tbody tr:nth-child(even) {
    background-color: #C5D7E0 !important; /* Warna lebih lembut */
}

/* Gaya sel tabel mini */
.table-mini tbody td, .custom-mini-table tbody td {
    text-align: center;
    padding: 3px; /* Padding lebih kecil */
    vertical-align: middle;
    border: 1px solid #ddd;
}

/* Gaya untuk teks di kolom 'Nama' yang rata kiri */
.custom-mini-table .left-align {
    text-align: left;
}

/* Gaya umum untuk tabel mini */
.custom-mini-table td, .custom-mini-table th {
    text-align: center;
    font-size: 12px; /* Ukuran font lebih kecil */
}

/* Gaya footer tabel mini */
.table-mini tfoot td, .custom-mini-table tfoot td {
    background-color: #439AC7 !important;
    color: white !important;
    font-weight: bold;
    text-align: center;
    padding: 3px; /* Padding lebih kecil di footer */
}

/* Sudut melengkung pada footer tabel mini */
.table-mini tfoot, .custom-mini-table tfoot {
    border-bottom-left-radius: 6px;
    border-bottom-right-radius: 6px;
}

/* Styling untuk tombol download pada tabel mini */
.custom-mini-table a.btn {
    background-color: #007bff;
    color: white;
    padding: 2px 6px; /* Ukuran tombol lebih kecil */
    font-size: 12px; /* Ukuran font lebih kecil */
}


    </style>
</head>
<body>
    <h2 style="text-align: center;">DATA PLOTING SISWA PKL</h2>
    <h3 style="text-align: center;">SMKN 1 BANTUL </h3>
    <h3 style="text-align: center;">Tahun {{ $tahunAngkatan }}</h3>

    <table class="table-mini table-striped custom-mini-table">
        <thead class="table-primary text-center">
            <tr>
                <th>Kode Kelompok</th>
                <th>NIS</th>
                <th>Nama Siswa</th>
                <th>Kelas</th>
                <th>Konsentrasi Keahlian</th>
                <th>NIP/NIK Pembimbing</th>
                <th>Pembimbing</th>
                <th>Kode DUDI</th>
                <th>DUDI</th>
                <th>No Telp DUDI</th>
                <th>Alamat DUDI</th>
            </tr>
        </thead>
        <tbody id="data-table">
            @foreach ($plotingData as $ploting)
            <tr>
                <td>{{ $ploting->kode_kelompok }}</td>
                <td>{{ $ploting->NIS }}</td>
                <td>{{ optional($ploting->siswa)->nama_siswa }}</td>
                <td>{{ $ploting->kelas }}</td>
                <td>{{ optional($ploting->siswa)->konsentrasi_keahlian }}</td>
                <td>{{ $ploting->NIP_NIK }}</td>
                <td>{{ $ploting->nama_pembimbing }}</td>
                <td>{{ $ploting->kode_dudi }}</td>
                <td>{{ $ploting->nama_dudi }}</td>
                <td>{{ $ploting->dudi->notelp_dudi }}</td>
                <td>{{ $ploting->dudi->alamat_dudi }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
