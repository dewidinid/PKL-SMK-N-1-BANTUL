@extends('layouts.headersiswa')

@section('content')

    <div class="profile-container">
        <!-- Logout Button -->
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>

        <a href="#" class="btn btn-danger btn-logout position-absolute top-250 end-0 m-3" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="bi bi-box-arrow-right"></i>
            <span>Logout</span>
        </a>


        <div class="container">
            <!-- Display Profile Picture -->
            <img src="" alt="Profile Picture">

            <!-- Form to Update Profile Picture -->
            <form action="" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group ">
                    <input type="file" name="profile_picture" class="form-control">
                    <button type="submit" class="btn btn-primary">Update Picture</button>
                </div>
            </form>            

            <br>

            <!-- Form to Update Other Profile Data -->
            <form method="POST" action="" style="padding-bottom: 100px;">
                @csrf
                <div class="form-group">
                    <label for="kelompok" class="form-label">Kelompok</label>
                    <input type="text" name="kelompok" class="form-control" placeholder="Kelompok" value="">
                </div>
                <div class="form-group">
                    <label for="nis" class="form-label">NIS</label>
                    <input type="text" name="nis" class="form-control" placeholder="NIS" value="">
                </div>
                <div class="form-group">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" name="nama" class="form-control" placeholder="Nama" value="">
                </div>
                <div class="form-group">
                    <label for="jurusan" class="form-label">Jurusan</label>
                    <input type="text" name="jurusan" class="form-control" placeholder="Jurusan" value="">
                </div>
                <div class="form-group">
                    <label for="tahun" class="form-label">Tahun</label>
                    <input type="text" name="tahun" class="form-control" placeholder="Tahun" value="">
                </div>
                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Password (optional)">
                </div>
                <br>
                <button type="submit" class="btn btn-primary" >Simpan</button>
            </form>
        </div>
    </div>

@include('layouts.footer')
@endsection
