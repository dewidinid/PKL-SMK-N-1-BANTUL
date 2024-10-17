<!-- resources/views/form-pengajuan.blade.php -->
@extends('layouts.headersiswa')

@section('content')

<div class="body-formmandiri">

    <div class="d-flex justify-content-start mb-3" style="margin-left: 100px;">
        <button onclick="window.location.href='{{ route('mandiri') }}'" style="background-color: #ffffff; color: #0275d8; border: none; padding: 5px 10px; border-radius: 5px; margin-top: 50px;">
            <i class="bi bi-arrow-left"></i> Kembali
        </button>
    </div>
    <!-- Form Container -->
    <br>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        
        <div class="form-container">
            <h4 class="text-center mb-3" style="color: #ffffff">Form Pengajuan PKL</h4> 
            <br>
            <form action="{{ route('formpengajuan') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="nis" class="form-label">NIS</label>
                    <label for="" style="color: #ffffff">*Jika anggota lebih dari satu, pisahkan dengan tanda koma (,) lalu enter</label>
                    <textarea class="form-control" id="nis" name="nis" rows="3"  placeholder="Masukkan NIS" oninput="this.value = this.value.replace(/[^0-9,\n]/g, '');"></textarea>
                </div>
                
                <div class="mb-3">
                    <label for="nama_siswa" class="form-label">Nama</label>
                    <label for="" style="color: #ffffff">*Jika anggota lebih dari satu, pisahkan dengan tanda koma (,) lalu enter</label>
                    <textarea class="form-control" id="nama_siswa" name="nama_siswa" rows="3" placeholder="Masukkan Nama" oninput="this.value = this.value.replace(/[^a-zA-Z,\n\s]/g, '');" required></textarea>
                </div>
                
                <div class="mb-3">
                    <label for="konsentrasi_keahlian" class="form-label">konsentrasi_keahlian</label>
                    <input type="text" class="form-control" id="konsentrasi_keahlian" name="konsentrasi_keahlian" placeholder="Masukkan Konsentrasi Keahlian">
                </div>
                <div class="mb-3">
                    <label for="no_telp" class="form-label">No Handphone</label>
                    <input type="" class="form-control" id="no_telp" name="no_telp" placeholder="Masukkan No Handphone" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                </div>
                
                <div class="mb-3">
                    <label for="tempat_pkl" class="form-label">Rencana Tempat PKL</label>
                    <input type="text" class="form-control" id="tempat_pkl" name="tempat_pkl" placeholder="Masukkan Rencana Tempat PKL">
                </div>
                <div class="mb-3">
                    <label for="proposal_pkl" class="form-label">Proposal PKL (Dijadikan satu)</label>
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
                <button type="submit" class="btn btn-submit" style="background-color: #ffffff; color:#000000;">Submit</button>
            </form>
            <br>
            <br>
        </div>
    </div>
</div>

@include('layouts.footer')
@endsection