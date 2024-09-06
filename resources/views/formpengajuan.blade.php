<!-- resources/views/form-pengajuan.blade.php -->
@extends('layouts.headersiswa')

@section('content')

    <title>Form Pengajuan PKL</title>
    <!-- Load Bootstrap CSS -->

    <link href="{{ asset('css/formpengajuan.css') }}" rel="stylesheet">

    <!-- Form Container -->
    <br>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="form-container">
            <h4 class="text-center mb-3" style="color: #ffffff">Form Pengajuan PKL</h4> <br>
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
                <button type="submit" class="btn btn-submit" style="background-color: #ffffff; color:#000000">Submit</button>
            </form>
        </div>
    </div>


    <script>
        function showFileName(input) {
            var file = input.files[0];
            var label = document.getElementById("file-label");
    
            if (file) {
                // Replace the label text with the file name
                label.innerHTML = file.name;
            } else {
                // Reset to default text if no file is selected
                label.innerHTML = '<i class="fa-sharp fa-solid fa-arrow-up-from-bracket fa-fw" style="margin-right: 10px; font-size: 16px;"></i> Add File or Drag & Drop';
            }
        }
    
        function handleFileDrop(event) {
            event.preventDefault();
            var input = document.getElementById('proposal_pkl');
            var files = event.dataTransfer.files;
    
            // Assign the dropped file to the input element
            if (files.length) {
                input.files = files;
                showFileName(input);
            }
        }
    </script>

    @include('layouts.footer')
    @endsection