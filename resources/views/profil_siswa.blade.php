@extends('layouts.headersiswa')

@section('content')

    <!-- Logout Button -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <a href="#" class="btn btn-danger btn-logout position-absolute top-250 end-0 m-3" onclick="confirmLogout(event);">
        <i class="bi bi-box-arrow-right"></i>
        <span>Logout</span>
    </a>

    <div class="profile-container">
        <div class="container">
            <!-- Display Profile Picture -->
            <img src="{{ $siswa->profile_picture ? asset('storage/' . $siswa->profile_picture) : asset('image/default-profile.jpg') }}" alt="Profile Picture" class="rounded-circle" style="width: 200px; height: 200px;">

            <!-- Form to Update Profile Picture -->
            <form action="{{ route('update.profile.picture') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <input type="file" name="profile_picture" class="form-control">
                    <button type="submit" class="btn btn-primary">Update Picture</button>
                </div>
            </form>

            <br>

            <!-- Form to Update Other Profile Data -->
            <form method="POST" action="{{ route('update.profile', $siswa->NIS) }}" style="padding-bottom: 100px;">
                @csrf
                <div class="form-group">
                    <label for="nis" class="form-label">NIS</label>
                    <input type="text" name="nis" class="form-control" placeholder="NIS" value="{{ $siswa->NIS }}" readonly>
                </div>
                <div class="form-group">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" name="nama" class="form-control" placeholder="Nama" value="{{ $siswa->nama_siswa }}"readonly>
                </div>
                <div class="form-group">
                    <label for="kelompok" class="form-label">Kelompok</label>
                    <input type="text" name="kelompok" class="form-control" placeholder="Kelompok" value="{{ $siswa->kode_kelompok }}"readonly>
                </div>
                <div class="form-group">
                    <label for="konsentrasi_keahlian" class="form-label">Konsentrasi Keahlian</label>
                    <input type="text" name="konsentrasi_keahlian" class="form-control" placeholder="Konsentrasi Keahlian" value="{{ $siswa->konsentrasi_keahlian }}"readonly>
                </div>
                <div class="form-group">
                    <label for="tahun" class="form-label">Tahun</label>
                    <input type="text" name="tahun" class="form-control" placeholder="Tahun" value="{{ $siswa->tahun }}"readonly>
                </div>
                <div class="form-group">
                    <label for="current_password" class="form-label">Password Lama</label>
                    <div class="input-group">
                        <input type="password" id="current_password" name="current_password" class="form-control" placeholder="Masukkan password lama" required>
                        <span class="input-group-text" id="toggle-current-password" style="background-color: #fff; border: none;">
                            <i class="far fa-eye" style="color: lightgrey"></i>
                        </span>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="password" class="form-label">Password Baru</label>
                    <div class="input-group">
                        <input type="password" id="password" name="password" class="form-control" placeholder="Password baru (optional)">
                        <span class="input-group-text" id="toggle-password" style="background-color: #fff; border: none;">
                            <i class="far fa-eye" style="color: lightgrey;"></i>
                        </span>
                    </div>
                    <small class="form-text" style="color: white">Masukkan password baru jika ingin mengubahnya.</small>
                </div>                                                   
                <br>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>



    


@include('layouts.footer')
@endsection
