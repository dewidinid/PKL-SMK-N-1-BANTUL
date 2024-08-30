@extends('layouts.header')
<title>Laporan PKL (Jurnal) </title>

@section('content')

<style>
    .table-bordered thead td, .table-bordered thead th {
    border-bottom-width: 2px;
    background-color:#1679AB;
    color: white;
}
    .pagination-btn {
    background-color: #1679AB;
    color: white;
    border: none;
    padding: 10px 15px;
    margin: 5px;
    cursor: pointer;
    border-radius: 5px;
}

.pagination-btn:disabled {
    background-color: #ddd;
    cursor: not-allowed;
}

.pagination-number {
    padding: 10px;
    border: 1px solid #1679AB;
    border-radius: 5px;
    cursor: pointer;
}

.pagination-number.active {
    background-color: #1679AB;
    color: white;
}
</style>

    <div class="container mt-5">
        <h2 class="text-center mb-4">Laporan PKL (Jurnal)</h2>
        <div class="d-flex justify-content-end mb-3">
            <button class="btn btn-primary" onclick="openForm()">+ Tambah</button>
        </div>
        <table class="table table-bordered">
            <thead style="background-color: #1679AB !important; color : white !important;">
                <tr class="text-center" >
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>NIS</th>
                    <th>Nama</th>
                    <th>Jurusan</th>
                    <th>Tempat Dudi</th>
                    <th>Kegiatan/Progress</th>
                    <th>Lokasi</th>
                </tr>
                <br>
            </thead>
            <tbody id="data-table">
                <!-- Data contoh, akan diisi dengan JavaScript -->
                <tr>
                    <td>1</td>
                    <td>16/03/24</td>
                    <td>16034</td>
                    <td>Rulli Ardha Ramadhan</td>
                    <td>TKJ</td>
                    <td>PT. Teknorika Inovasi Nusantara</td>
                    <td>Membuat Flowchart</td>
                    <td>Yogyakarta</td>
                </tr>
            </tbody>
            {{-- <tbody>
                @foreach ($jurnals as $index => $jurnal)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ \Carbon\Carbon::parse($jurnal->tanggal)->format('d/m/Y') }}</td>
                        <td>{{ $jurnal->nis }}</td>
                        <td>{{ $jurnal->nama }}</td>
                        <td>{{ $jurnal->jurusan }}</td>
                        <td>{{ $jurnal->tempat_dudi }}</td>
                        <td>{{ $jurnal->kegiatan }}</td>
                        <td>{{ $jurnal->lokasi }}</td>
                    </tr>
                @endforeach
            </tbody> --}}
        </table>
    </div>

    <div class="pagination-container" style="display: flex; justify-content: center; align-items: center;">
        <button class="pagination-btn" onclick="prevPage()" id="prev-btn" disabled>Sebelumnya</button>
        <div id="pagination-numbers" style="display: flex; gap: 10px; margin: 0 20px;">
            <!-- Angka halaman akan diisi dengan JavaScript -->
        </div>
        <button class="pagination-btn" onclick="nextPage()" id="next-btn">Selanjutnya</button>
    </div>

    <!-- Pop-up Form -->
    <div class="modal" id="jurnalForm" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Form Jurnal Siswa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-container">
                        {{-- <h4 class="text-center mb-4" style="color: #ffffff">Form Pengajuan PKL</h4>
                        <form action="{{ route('formpengajuan') }}" method="POST" enctype="multipart/form-data"> --}}
                            @csrf
                            <div class="mb-3">
                                <label for="nis" class="form-label">NIS</label>
                                <input type="text" class="form-control" id="nis" name="nis" placeholder="Masukkan NIS" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 5)" maxlength="5">
                            </div>
                            
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama</label>
                                {{-- <input type="text" class="form-control" id="jurusan" name="jurusan" placeholder="Masukkan Nama Lengkap" oninput="this.value = this.value.replace(/[^a-zA-Z'\s]/g, '');"> --}}
                                <input type="text" class="form-control" id="jurusan" name="jurusan" placeholder="Masukkan Nama Lengkap" oninput="this.value = this.value.replace(/[^a-zA-Z'\s]/g, '').replace(/\b\w/g, char => char.toUpperCase()).replace(/\B\w/g, char => char.toLowerCase());">
                            </div>
                            
                            <div class="mb-3">
                                <label for="jurusan" class="form-label">Jurusan</label>
                                <select class="form-control" id="jurusan" name="jurusan">
                                    <option value="" disabled selected>Pilih Jurusan</option>
                                    <option value="akl">Akuntansi dan Keuangan Lembaga (AKL)</option>
                                    <option value="ps">Layanan Perbankan Syariah (PS)</option>
                                    <option value="mp">Manajemen Perkantoran (MP)</option>
                                    <option value="br">Bisnis Ritel (BR)</option>
                                    <option value="bd">Bisnis Digital(BD)</option>
                                    <option value="tkj">Teknik Komputer dan Jaringan (TKJ)</option>
                                    <option value="dkv">Desain Komunikasi Visual (DKV)</option>
                                    <option value="rpl">Rekayasa Perangkat Lunak (RPL)</option>
                                </select>
                            </div>
                            
                            <div class="mb-3">
                                <label for="no_handphone" class="form-label">Tempat Du/Di</label>
                                <input type="tel" class="form-control" id="tempat_dudi" name="tempat_dudi" placeholder="Masukkan Tempat Dudi">
                            </div>
                            
                            <div class="mb-3">
                                <label for="rencana_tempat_pkl" class="form-label">Kegiatan / Progres</label>
                                <textarea class="form-control" id="nis" name="nis" rows="1" placeholder="Masukkan Kegiatan / Progres hari ini"></textarea>
                            </div>
                            <br>
                            
                            <button type="reset" class="btn btn-danger" >Reset</button>
                            <button type="submit" class="btn btn-primary" style="margin-left: auto;" >Simpan</button>
                    </div>
                    <form method="POST" id="jurnalForm">
                        {{-- action="{{ route('laporanpkl.store') }}"  --}}
                        @csrf
                        <!-- Form fields as before -->
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- @section('scripts')
<script>
    $(document).on('click', '.pagination a', function(event) {
        event.preventDefault();
        var page = $(this).attr('href').split('page=')[1];

        fetchJurnals(page);
    });

    function fetchJurnals(page) {
        $.ajax({
            url: "/jurnals?page=" + page,
            success: function(data) {
                $('#jurnal-table-container').html(data);
            }
        });
    }
</script> --}}

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function openForm() {
            var modal = new bootstrap.Modal(document.getElementById('jurnalForm'));
            modal.show();
        }
    </script>

    <script>
        let currentPage = 1;
        const rowsPerPage = 1; // Jumlah baris per halaman
        const tableData = document.querySelectorAll("#data-table tr"); // Mengambil semua baris dalam tabel
        const totalPages = Math.ceil(tableData.length / rowsPerPage);

        function displayTablePage(page) {
            const start = (page - 1) * rowsPerPage;
            const end = start + rowsPerPage;
            tableData.forEach((row, index) => {
                row.style.display = index >= start && index < end ? '' : 'none';
            });
        }

        function setupPagination() {
            const paginationNumbers = document.getElementById('pagination-numbers');
            paginationNumbers.innerHTML = '';

            for (let i = 1; i <= totalPages; i++) {
                const pageButton = document.createElement('div');
                pageButton.className = 'pagination-number';
                pageButton.innerText = i;
                pageButton.addEventListener('click', () => goToPage(i));
                paginationNumbers.appendChild(pageButton);
            }
        }

        function goToPage(page) {
            currentPage = page;
            displayTablePage(page);
            updatePaginationButtons();
        }

        function prevPage() {
            if (currentPage > 1) {
                goToPage(currentPage - 1);
            }
        }

        function nextPage() {
            if (currentPage < totalPages) {
                goToPage(currentPage + 1);
            }
        }

        function updatePaginationButtons() {
            document.getElementById('prev-btn').disabled = currentPage === 1;
            document.getElementById('next-btn').disabled = currentPage === totalPages;

            document.querySelectorAll('.pagination-number').forEach((button, index) => {
                button.classList.toggle('active', index + 1 === currentPage);
            });
        }

        // Inisialisasi tampilan tabel dan pagination
        displayTablePage(currentPage);
        setupPagination();
        updatePaginationButtons();

    </script>

@include('layouts.footer')
@endsection