<!-- resources/views/form-pengajuan.blade.php -->
@extends('layouts.headersiswa')

@section('content')

<div class="body-formmandiri">

    <div class="kembali d-flex justify-content-start mb-3" style="">
        <button onclick="window.location.href='{{ route('mandiri') }}'" style="background-color: #ffffff; color: #0275d8; border: none; padding: 5px 10px; border-radius: 5px; margin-top: 50px;">
            <i class="bi bi-arrow-left"></i> Kembali
        </button>
    </div>
    <!-- Form Container -->
    <br>
    <div class="d-flex justify-content-center align-items-center">
        
        <div class="form-container">
            <h4 class="text-center mb-3" style="color: #21516f">Form Pengajuan PKL</h4> 
            <br>
            <form action="{{ route('formpengajuan') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="nis" class="form-label" style="color: #1A5276 !important">NIS</label>
                    <label for="" style="color: #1A5276">*Jika anggota lebih dari satu, pisahkan dengan tanda koma (,) lalu enter</label>
                    <textarea class="form-control" id="nis" name="nis" rows="3"  placeholder="Masukkan NIS" style="font-size: 16px; padding: 10px;" oninput="this.value = this.value.replace(/[^0-9,\n]/g, '');"></textarea>
                </div>
                
                <div class="mb-3">
                    <label for="nama_siswa" class="form-label" style="color: #1A5276 !important">Nama</label>
                    <label for="" style="color: #1A5276">*Jika anggota lebih dari satu, pisahkan dengan tanda koma (,) lalu enter</label>
                    <textarea class="form-control" id="nama_siswa" name="nama_siswa" rows="3" placeholder="Masukkan Nama" style="font-size: 16px; padding: 10px;" oninput="this.value = this.value.replace(/[^a-zA-Z,\n\s]/g, '');" required></textarea>
                </div>
                
                <div class="mb-3">
                    <label for="konsentrasi_keahlian" class="form-label" style="color: #1A5276 !important">Konsentrasi Keahlian</label>
                    <select class="form-control" id="konsentrasi_keahlian" name="konsentrasi_keahlian"  required>
                        <option value="" disabled selected>Pilih Konsentrasi Keahlian</option>
                        @foreach($konsentrasiKeahlianList as $konsentrasi)
                            <option value="{{ $konsentrasi }}">{{ $konsentrasi }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="mb-3">
                    <label for="no_telp" class="form-label" style="color: #1A5276 !important">No Telp Ketua</label>
                    <input type="" class="form-control" id="no_telp" name="no_telp" placeholder="Masukkan No Handphone" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                </div>
                <div class="mb-3">
                    <label for="nama_dudi" class="form-label" style="color: #1A5276 !important">Rencana Tempat PKL</label>
                    <p style="color: #1A5276 !important; font-size: 12px;">*Pastikan kamu sudah ajukan data dudi ke admin</p>
                    <div class="dropdown-wrapper">
                        <select class="form-control dropdown-custom" id="nama_dudi" name="nama_dudi" onchange="updateNoTelpDudi()">
                            <option value="" disabled selected>Pilih Rencana Tempat PKL</option>
                            @foreach($dudiList as $dudi)
                                {{-- Tambahkan debugging untuk melihat nilai --}}
                                {{-- {{ dd($dudi) }} --}}
                                <option value="{{ $dudi->nama_dudi }}" 
                                        data-telp="{{ $dudi->notelp_dudi }}"
                                        {{-- Tambahkan debugging inline --}}
                                        {{-- data-debug="{{ var_export($dudi->toArray(), true) }}" --}}
                                >
                                    {{ $dudi->nama_dudi }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="no_telp_dudi" class="form-label" style="color: #1A5276 !important">No Telp Dudi</label>
                    <input type="text" class="form-control" id="no_telp_dudi" name="no_telp_dudi" readonly>
                </div>                                                                   
                <div class="mb-3">
                    <label for="proposal_pkl" class="form-label" style="color: #1A5276 !important">Proposal PKL (Dijadikan satu)</label>
                    <div class="custom-file-upload" 
                        style="display: inline-block; position: relative; background-color:#ffffff; border: 2px dashed #cccccc; padding: 20px; text-align: center;" 
                        ondragover="event.preventDefault()" 
                        ondrop="handleFileDrop(event)"
                        onclick="document.getElementById('proposal_pkl').click()">

                        <input type="file" id="proposal_pkl" name="proposal_pkl" style="display: none;" onchange="showFileName(this)">
                        <label id="file-label" for="proposal_pkl" style="display: inline-block; background-color: #ffffff; color: rgb(32, 51, 105); padding: 10px 25px; font-size: 18px; border-radius: 8px; cursor: pointer; font-weight: 500; text-align: center; transition: background-color 0.3s ease;">
                            <i class="fa-sharp fa-solid fa-arrow-up-from-bracket fa-fw" style="margin-right: 10px; font-size: 12px;"></i> Add File or Drag & Drop
                        </label>
                    </div>
                </div>
                <br>
                <button type="submit" class="btn btn-submit" style="background-color: #1A5276; color:#fff;">Submit</button>
            </form>
            <br>
            <br>
        </div>
    </div>
</div>


@endsection