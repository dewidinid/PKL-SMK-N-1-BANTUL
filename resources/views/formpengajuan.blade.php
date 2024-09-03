<!-- resources/views/form-pengajuan.blade.php -->
@extends('layouts.header')

@section('content')

    <title>Form Pengajuan PKL</title>
    <!-- Load Bootstrap CSS -->

    <link href="{{ asset('css/formpengajuan.css') }}" rel="stylesheet">

    <!-- Form Container -->
    <br>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="form-container">
            <h4 class="text-center mb-4" style="color: #ffffff">Form Pengajuan PKL</h4>
            <form action="{{ route('formpengajuan') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="nis" class="form-label">NIS</label>
                    <label for="" style="color: #ffffff">*Jika anggota lebih dari satu, pisahkan dengan tanda koma (,) lalu enter</label>
                    <textarea class="form-control" id="nis" name="nis" rows="1" placeholder="Masukkan NIS" oninput="this.value = this.value.replace(/[^0-9,\n]/g, '');"></textarea>
                </div>
                
                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <label for="" style="color: #ffffff">*Jika anggota lebih dari satu, pisahkan dengan tanda koma (,) lalu enter</label>
                    <textarea class="form-control" id="name" name="name" rows="1" placeholder="Masukkan Nama" oninput="this.value = this.value.replace(/[^a-zA-Z,\n\s]/g, '');"></textarea>
                </div>
                
                <div class="mb-3">
                    <label for="jurusan" class="form-label">Jurusan</label>
                    <input type="text" class="form-control" id="jurusan" name="jurusan">
                </div>
                <div class="mb-3">
                    <label for="no_handphone" class="form-label">No Handphone</label>
                    <input type="tel" class="form-control" id="no_handphone" name="no_handphone" placeholder="Masukkan No Handphone" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                </div>
                
                <div class="mb-3">
                    <label for="rencana_tempat_pkl" class="form-label">Rencana Tempat PKL</label>
                    <input type="text" class="form-control" id="rencana_tempat_pkl" name="rencana_tempat_pkl" placeholder="Masukkan Rencana Tempat PKL">
                </div>
                <div class="mb-3">
                    <label for="proposal_pkl" class="form-label">Proposal PKL (Dijadikan satu)</label>
                    <div class="custom-file-upload">
                        <input type="file" id="proposal_pkl" name="proposal_pkl">
                        <span class="file-upload-text"> + Add File</span>
                    </div>
                </div>
                <br>
                <button type="submit" class="btn btn-submit" style="background-color: #ffffff">Submit</button>
            </form>
        </div>
    </div>

    @include('layouts.footer')
    @endsection