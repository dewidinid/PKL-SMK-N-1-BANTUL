@extends('layouts.headeradmin')

@section('content')

<div class="container mt-5 table-wrapper">
    <h4 class="text-center">Surat Pengajuan PKL Mandiri</h4>
    <br>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <select class="form-select d-inline-block w-auto" name="tahun">
                <option selected>Tahun</option>
                <!-- Tambahkan opsi tahun -->
            </select>
        </div>
    </div>

    <!-- Pesan Sukses -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('approvePengajuan') }}">
        @csrf
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
                @foreach($pengajuan as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>
                        <div>1. {{ $item->nis }}</div>
                    </td>
                    <td class="left-align">
                        <div>1. {{ $item->nama_siswa }}</div>
                    </td>
                    <td>{{ $item->no_telp }}</td>
                    <td>{{ $item->tempat_pkl }}</td>
                    <td>{{ $item->notelp_dudi }}</td>
                    <td class="text-center">
                        <a href="{{ asset('storage/proposals/' . $item->proposal_pkl) }}" target="_blank" class="btn btn-primary">Download</a>
                    </td>
                    <td class="text-center">
                        <input type="checkbox" name="check[]" value="{{ $item->id_pengajuan }}" {{ $item->status_acc ? 'checked disabled' : '' }}>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <button type="submit" class="btn btn-success mt-3">Approve Selected</button>
    </form>
    

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