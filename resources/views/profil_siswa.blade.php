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
        <div class="container position-relative">
            <!-- Display Profile Picture -->
            <div class="profile-picture-container">
                <img src="{{ $siswa->profile_picture ? asset('storage/' . $siswa->profile_picture) : asset('image/default-profile.jpg') }}" 
                     alt="Profile Picture" 
                     class="profile-picture rounded-circle">
                <label for="profile_picture" class="camera-icon">
                    <i class="bi bi-camera-fill"></i>
                </label>
            </div>
    
            <!-- Form to Update Profile Picture -->
            <form action="{{ route('update.profile.picture') }}" method="POST" enctype="multipart/form-data" style="display: none;">
                @csrf
                <input type="file" id="profile_picture" name="profile_picture" class="form-control" accept="image/*" onchange="this.form.submit()">
            </form>
            <br>

            <div class="profile-data" style="">
                <!-- Form to Update Other Profile Data -->
                <form method="POST" action="{{ route('update.profile', $siswa->NIS) }}" style="padding-bottom: 50px;">
                    @csrf
                    <div class="form-group">
                        <label for="nis" class="form-label" style="color: #1A5276 !important">NIS</label>
                        <input type="text" name="nis" class="form-control" style="background-color: #fff" placeholder="NIS" value="{{ $siswa->NIS }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="nama" class="form-label" style="color: #1A5276 !important">Nama</label>
                        <input type="text" name="nama" class="form-control" style="background-color: #fff" placeholder="Nama" value="{{ $siswa->nama_siswa }}"readonly>
                    </div>
                    <div class="form-group">
                        <label for="kelompok" class="form-label" style="color: #1A5276 !important">Kelompok</label>
                        <input type="text" name="kelompok" class="form-control" style="background-color: #fff" placeholder="Kelompok" value="{{ $siswa->kode_kelompok }}"readonly>
                    </div>
                    <div class="form-group">
                        <label for="konsentrasi_keahlian" class="form-label" style="color: #1A5276 !important">Konsentrasi Keahlian</label>
                        <input type="text" name="konsentrasi_keahlian" class="form-control" style="background-color: #fff" placeholder="Konsentrasi Keahlian" value="{{ $siswa->konsentrasi_keahlian }}"readonly>
                    </div>
                    <div class="form-group">
                        <label for="tahun" class="form-label" style="color: #1A5276 !important">Tahun</label>
                        <input type="text" name="tahun" class="form-control" style="background-color: #fff" placeholder="Tahun" value="{{ $siswa->tahun }}"readonly>
                    </div>
                    <div class="container " style="background-color: #fff; padding: 20px; max-width: 90%; border-radius: 10px;">
                        <!-- Password Lama -->
                        <div class="form-group position-relative">
                            <label for="current_password" class="form-label" style="color: black !important">Password Lama</label>
                            {{-- <input type="password" id="current_password" name="current_password" class="form-control" placeholder="Masukkan password lama" required>
                            <button type="button" id="toggle-current-password" class="btn input-group-text">
                                <i class="far fa-eye" style="color: rgb(173, 173, 173);"></i>
                            </button> --}}
                            <div class="password-container">
                                <input type="password" id="current_password" name="current_password" class="form-control" placeholder="Masukkan password lama" required>
                                <button type="button" class="toggle-password" id="toggle-current-password">
                                    <i class="far fa-eye"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Password Baru -->
                        <div class="form-group position-relative">
                            <label for="password" class="form-label" style="color: black !important">Password Baru</label>
                            {{-- <input type="password" id="password" name="password" class="form-control" placeholder="Password baru" disabled>
                            <button type="button" id="toggle-new-password" class="btn input-group-text">
                                <i class="far fa-eye" style="color: rgb(173, 173, 173);"></i>
                            </button> --}}
                            <div class="password-container">
                                <input type="password" id="password" name="password" class="form-control" placeholder="Password baru" disabled>
                                <button type="button" class="toggle-password" id="toggle-new-password">
                                    <i class="far fa-eye"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Konfirmasi Password Baru -->
                        <div class="form-group position-relative">
                            <label for="password_confirmation" class="form-label" style="color: black !important">Konfirmasi Password Baru</label>
                            {{-- <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Konfirmasi password baru" disabled>
                            <button type="button" id="toggle-confirm-password" class="btn input-group-text">
                                <i class="far fa-eye" style="color: rgb(173, 173, 173);"></i>
                            </button> --}}
                            <div class="password-container">
                                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Konfirmasi password baru" disabled>
                                <button type="button" class="toggle-password" id="toggle-confirm-password">
                                    <i class="far fa-eye"></i>
                                </button>
                            </div>
                        </div>

                        <div class="form-group mt-2" style="display: flex;  gap: 10px;">
                            <button type="button" id="reset-password-button" class="btn btn-danger mt-4 " style="flex: 1; padding: 10px; text-align: center;" disabled>Reset</button>
                            
                            <!-- Tombol Simpan Password -->
                            <button type="button" id="save-password-button" class="btn btn-primary mt-4 " style="flex: 1; padding: 10px; text-align: center;" disabled>Simpan Password</button>
                        </div>
                    </div>                                              
                </form>
            </div>
        </div>
    </div>

<script>
// Toggle untuk password lama
document.getElementById('toggle-current-password').addEventListener('click', () => {
    const inputField = document.getElementById('current-password');
    const icon = document.getElementById('toggle-current-password').querySelector('i');

    if (inputField.type === 'password') {
        inputField.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        inputField.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
});

// Toggle untuk password baru
document.getElementById('toggle-new-password').addEventListener('click', () => {
    const inputField = document.getElementById('new-password');
    const icon = document.getElementById('toggle-new-password').querySelector('i');

    if (inputField.type === 'password') {
        inputField.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        inputField.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
});

// Toggle untuk konfirmasi password
document.getElementById('toggle-confirm-password').addEventListener('click', () => {
    const inputField = document.getElementById('confirm-password');
    const icon = document.getElementById('toggle-confirm-password').querySelector('i');

    if (inputField.type === 'password') {
        inputField.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        inputField.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
});


</script>

@endsection
