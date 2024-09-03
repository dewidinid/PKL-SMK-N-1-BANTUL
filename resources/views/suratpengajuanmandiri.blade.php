@extends('layouts.headeradmin')

@section('content')


<div class="container mt-5">
    <h3 class="text-center">Surat Pengajuan PKL Mandiri</h3>
    <br>
    <br>
    <table class="table table-striped table-bordered mt-4">
        <thead class="table-primary text-center">
            <tr>
                <th>No</th>
                <th>NIS</th>
                <th>Nama</th>
                <th>No Handphone (Ketua)</th>
                <th>Rencana Tempat PKL</th>
                <th>Proposal PKL</th>
                <th>Check</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>
                    <div>1. 123456789</div>
                    <div>2. 234567890</div>
                </td>
                <td>
                    <div>1. John Doe</div>
                    <div>2. Jane Smith</div>
                </td>
                <td>08123456789</td>
                <td>SMK N 1 Bantul</td>
                <td class="text-center">
                    <a href="{{ asset('storage/proposals/sample-proposal.pdf') }}" target="_blank" class="btn btn-primary">Download</a>
                </td>
                <td class="text-center">
                    <input type="checkbox" name="check[]" value="1">
                </td>
            </tr>
            <tr>
                <td>2</td>
                <td>
                    <div>345678901</div>
                </td>
                <td>
                    <div>Michael Brown</div>
                </td>
                <td>08987654321</td>
                <td>SMK N 2 Yogyakarta</td>
                <td class="text-center">
                    <a href="{{ asset('storage/proposals/sample-proposal2.docx') }}" target="_blank" class="btn btn-primary">Download</a>
                </td>
                <td class="text-center">
                    <input type="checkbox" name="check[]" value="2">
                </td>
            </tr>
        </tbody>
    </table>

    <br>
    <br>

    <div class="pagination-container" style="display: flex; justify-content: center; align-items: center;">
        <button class="pagination-btn" onclick="prevPage()" id="prev-btn" disabled>Sebelumnya</button>
        <div id="pagination-numbers" style="display: flex; gap: 10px; margin: 0 20px;">
            <!-- Angka halaman akan diisi dengan JavaScript -->
        </div>
        <button class="pagination-btn" onclick="nextPage()" id="next-btn">Selanjutnya</button>
    </div>
  
</div>

<br>
<br>
<br>
<br>
<br>

@include('layouts.footer')
@endsection