@extends('layouts.headeradmin')

@section('content')

<div class="container mt-5 table-wrapper">
    <h4 class="text-center">Surat Pengajuan PKL Mandiri</h4>
    <br>
    <table class="table-striped custom-table">
        <thead class="table-primary text-center">
            <tr>
                <th>No</th>
                <th>NIS</th>
                <th>Nama</th>
                <th>No Hp (Ketua)</th>
                <th>Rencana Tempat PKL</th>
                <th>No Telp Du/Di</th>
                <th>Proposal PKL</th>
                <th>ACC</th>
            </tr>
        </thead>
        <tbody id="data-table">
            <tr >
                <td>1</td>
                <td>
                    <div>1. 17672</div>
                    <div>2. 17642</div>
                </td>
                <td class="left-align">
                    <div>1. John Doe</div>
                    <div>2. Jane Smith</div>
                </td>
                <td>08123456789</td>
                <td>SMK N 1 Bantul</td>
                <td>0274 465728</td>
                <td class="text-center">
                    <a href="{{ asset('storage/proposals/sample-proposal.pdf') }}" target="_blank" class="btn btn-primary">Download</a>
                </td>
                <td class="text-center">
                    <input type="checkbox" name="check[]" value="1">
                </td>
            </tr>
            <tr>
                <td>2</td>
                <td >
                    <div>1. 17890</div>
                    <div>2. 17234</div>
                </td>
                <td class="left-align">
                    <div>1. Lucas White</div>
                    <div>2. Charlotte Lewis</div>
                </td>
                <td>08512345678</td>
                <td>SMK N 15 Wates</td>
                <td>0274 465728</td>
                <td class="text-center">
                    <a href="{{ asset('storage/proposals/sample-proposal15.pdf') }}" target="_blank" class="btn btn-primary">Download</a>
                </td>
                <td class="text-center">
                    <input type="checkbox" name="check[]" value="15">
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
    
@endsection