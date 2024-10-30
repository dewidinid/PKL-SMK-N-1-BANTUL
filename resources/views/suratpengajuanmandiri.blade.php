@extends('layouts.headeradmin')

@section('content')

<div class="container mt-5 table-wrapper">
    <h4 class="text-center">Surat Pengajuan PKL Mandiri</h4>
    <br>

    <form method="POST" action="{{ route('approvePengajuan') }}">
        @csrf
        <table class="table-mini table-striped custom-mini-table">
            <thead class="table-primary text-center">
                <tr>
                    <th>No</th>
                    <th>NIS</th>
                    <th>Nama</th>
                    <th>No Hp (Ketua)</th>
                    <th>Rencana Tempat PKL</th>
                    <th>No Telp Du/Di</th>
                    <th>Proposal PKL</th>
                    <th>Pembimbing</th>
                    <th>Kode Kelompok</th>
                    <th>ACC</th>
                </tr>
            </thead>
            <tbody id="data-table">
                @foreach($pengajuans as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>
                        @foreach($item->siswa as $siswa)
                            <div>{{ $siswa->NIS }}</div>
                        @endforeach
                    </td>
                    <td>
                        @foreach($item->siswa as $siswa)
                            <div>{{ $siswa->nama_siswa }}</div>
                        @endforeach
                    </td>
                    <td>{{ $item->no_telp }}</td> <!-- No telp ketua -->
                    <td>{{ $item->nama_dudi }}</td>
                    <td>{{ $item->dudi->notelp_dudi ?? 'Data tidak tersedia' }}</td>
                    <td class="text-center">
                        <a href="{{ Storage::url('proposals/' . $item->proposal_pkl) }}" target="_blank" >Lihat File</a>
                    </td>
                    <td>
                        <!-- Dropdown untuk memilih Pembimbing -->
                        <select name="pembimbing_{{ $item->id_pengajuan }}" class="form-control">
                            <option value="" selected disabled>Pilih Pembimbing</option>
                            @foreach($pembimbings as $pembimbing)
                                <option value="{{ $pembimbing->NIP_NIK }}">
                                    {{ $pembimbing->nama_pembimbing }} 
                                </option>
                            @endforeach
                        </select>                        
                    </td>
                    <td>
                        <input style="text-align: center;" type="text" name="kode_kelompok_{{ $item->id_pengajuan }}" value="{{ $item->kode_kelompok }}" readonly>
                    </td>                    
                    <td class="text-center">
                        <input type="checkbox" name="check[]" value="{{ $item->id_pengajuan }}" {{ $item->status_acc ? 'checked disabled' : '' }}>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <br>
        <button type="submit" class="btn btn-success mt-3">Approve Selected</button>
    </form>
    
</div>

<br>
<br>

<div class="pagination-container" style="display: flex; justify-content: center; align-items: center;">
    <button class="pagination-btn" onclick="prevPage()" id="prev-btn" disabled>Sebelumnya</button>
    <div id="pagination-numbers" style="display: flex; gap: 10px; margin: 0 20px;">
        <!-- Angka halaman akan diisi dengan JavaScript -->
    </div>
    <button class="pagination-btn" onclick="nextPage()" id="next-btn">Selanjutnya</button>
</div>

@endsection
