<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard Siswa</title>
    <link rel="stylesheet" href="{{ asset('css/header-siswa.css') }}">
    <link rel="stylesheet" href="{{ asset('css/carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('css/kategori-card.css') }}">
    <link rel="stylesheet" href="{{ asset('css/card-dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/profil-siswa.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tabel.css') }}">
    <link rel="stylesheet" href="{{ asset('css/alur-pkl.css') }}">
    <link rel="stylesheet" href="{{ asset('css/button.css') }}">
    <link rel="stylesheet" href="{{ asset('css/body.css') }}">
    <link rel="stylesheet" href="{{ asset('css/formpengajuan.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style-pagination.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOMw5T5obSTHj9Q+O8Cd60XxFIYBvPzNURnKl7vZ" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>
<body class="background">
    <header class="header-siswa">
        <div class="contact-info d-flex flex-column flex-md-row justify-content-between align-items-center p-8 px-md-7">
            <div>
                <a href="mailto:smkn1bantul@gmail.com" class="me-3" style="text-decoration: none;">
                    <i class="bi bi-envelope me-2"></i>
                    <span>smkn1bantul@gmail.com</span> 
                </a>
                <a href="tel:089024516" style="text-decoration: none;">
                    <i class="bi bi-phone me-2"></i>
                    <span>0890 24516</span>
                </a>
            </div>
            <div class="mt-2 mt-md-0">
                <a href="#" class="me-2" style="text-decoration: none;">
                    <i class="bi bi-twitter-x"></i>
                </a>
                <a href="#" class="me-2" style="text-decoration: none;">
                    <i class="bi bi-facebook"></i>
                </a>
                <a href="#" style="text-decoration: none;">
                    <i class="bi bi-instagram"></i>
                </a>
            </div>            
        </div>


        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ route('home_siswa') }}">
                    <img src="{{ asset('image/Logo_SMKN1Bantul.png') }}" alt="Logo" style="height: 70px;">
                    <strong>PKL SMK N 1 BANTUL</strong>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('home_siswa') }}">Beranda</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('profil_siswa') }}">
                                    <img src="{{ isset($siswa) && $siswa->profile_picture ? asset('storage/' . $siswa->profile_picture) : asset('image/default-profile.jpg') }}" alt="Profile Picture" class="rounded-circle" style="width: 30px; height: 30px;">
                                </a>
                            </li>                        
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
              
    </header>

    @yield('content')

   

    @include('layouts.footer')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    @if(session('success'))
    <script>
        function showNotification(title, text) {
            Swal.fire({
                title: title,
                text: text,
                icon: 'success',
                confirmButtonText: 'OK'
            });
        }

        @if(session('from') === 'login')
            showNotification('Login Berhasil!', '{{ session('success') }}!');
        @elseif(session('from') === 'update_profile')
            showNotification('Berhasil!', '{{ session('success') }}');
        @elseif(session('from') === 'update_profile_picture')
            showNotification('Berhasil!', '{{ session('success') }}');
        @endif
    </script>
    @endif

    @if ($errors->any())
    <script>
        function showError(title, text) {
            Swal.fire({
                title: title,
                text: text,
                icon: 'error',
                confirmButtonText: 'OK'
            });
        }

        showError('Kesalahan!', '{{ $errors->first() }}'); // Menampilkan kesalahan pertama
    </script>
    @endif

    <script>
        // Menampilkan pop-up saat proses pengiriman jurnal
        function showAddingNotification() {
            Swal.fire({
                title: 'Menambahkan Data...',
                text: 'Proses penambahan sedang berlangsung, mohon tunggu!',
                icon: 'info',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
    
            // Izinkan form untuk dikirim setelah pop-up muncul
            return true; // Mengizinkan pengiriman form
        }
    
        // SweetAlert untuk menampilkan hasil setelah submit
        @if (session('success'))
            Swal.fire({
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        @endif
    
        @if (session('error'))
            Swal.fire({
                title: 'Gagal!',
                text: '{{ session('error') }}',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        @endif
    </script>

    <script>
        function confirmLogout(event) {
            event.preventDefault(); // Mencegah aksi default

            // Tampilkan SweetAlert
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda akan keluar dari akun ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, logout!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika pengguna mengonfirmasi logout
                    document.getElementById('logout-form').submit();
                }
            });
        }
    </script>

    
    {{-- <script>
       document.addEventListener('DOMContentLoaded', function () {
        // Toggle visibility untuk setiap kolom password
            toggleVisibility('current_password', 'toggle-current-password');
            toggleVisibility('password', 'toggle-password');
            toggleVisibility('password_confirmation', 'toggle-confirmation-password');

            // Validasi password lama saat Enter ditekan
            document.getElementById('current_password').addEventListener('keypress', function (event) {
                if (event.key === 'Enter') {
                    event.preventDefault(); // Cegah form terkirim
                    validateCurrentPassword(); // Panggil fungsi validasi
                }
            });
        });

        // Fungsi toggle untuk menampilkan atau menyembunyikan password
        function toggleVisibility(fieldId, toggleButtonId) {
            document.getElementById(toggleButtonId).addEventListener('click', function () {
                const input = document.getElementById(fieldId);
                input.type = input.type === 'password' ? 'text' : 'password';
                this.querySelector('i').classList.toggle('fa-eye');
                this.querySelector('i').classList.toggle('fa-eye-slash');
            });
        }

        // Fungsi untuk validasi password lama
        function validateCurrentPassword() {
            const currentPassword = document.getElementById('current_password').value;

            fetch('/validate-password', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ current_password: currentPassword })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Terjadi kesalahan dalam memverifikasi password.');
                }
                return response.json();
            })
            .then(data => {
                if (data.valid) {
                    // Aktifkan kolom password baru dan konfirmasi jika password lama benar
                    document.getElementById('password').disabled = false;
                    document.getElementById('password_confirmation').disabled = false;
                    document.getElementById('password').focus();
                } else {
                    // Jika password lama salah, tampilkan pesan kesalahan
                    Swal.fire({
                        title: 'Error',
                        text: 'Password lama yang Anda masukkan salah',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                    document.getElementById('current_password').focus();
                }
            })
            .catch(error => {
                Swal.fire({
                    title: 'Error',
                    text: error.message || 'Terjadi kesalahan dalam memverifikasi password. Silakan coba lagi.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            });
        }

        // Fungsi untuk validasi password baru dan konfirmasi
        function validateNewPasswords() {
            const newPassword = document.getElementById('password').value;
            const confirmPassword = document.getElementById('password_confirmation').value;

            if (newPassword === confirmPassword && newPassword !== '') {
                // Jika password baru dan konfirmasi sesuai, tampilkan notifikasi berhasil
                Swal.fire({
                    title: 'Berhasil',
                    text: 'Password berhasil diperbarui.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            } else {
                // Jika password baru dan konfirmasi tidak sesuai, munculkan notifikasi dalam bahasa Indonesia
                Swal.fire({
                    title: 'Kesalahan',
                    text: 'Password baru dan konfirmasi tidak sesuai. Silakan periksa kembali.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
                document.getElementById('password').focus();
            }
        }

        // Panggil `validateNewPasswords` saat konfirmasi password di-submit atau saat Enter ditekan
        document.getElementById('password_confirmation').addEventListener('blur', validateNewPasswords);
        document.getElementById('password_confirmation').addEventListener('keypress', function (event) {
            if (event.key === 'Enter') {
                event.preventDefault(); // Cegah form terkirim
                validateNewPasswords();
            }
        });



    </script> --}}

    {{-- <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Toggle visibility untuk setiap kolom password
            toggleVisibility('current_password', 'toggle-current-password');
            toggleVisibility('password', 'toggle-password');
            toggleVisibility('password_confirmation', 'toggle-confirmation-password');

            // Validasi password lama saat Enter ditekan
            document.getElementById('current_password').addEventListener('keypress', function (event) {
                if (event.key === 'Enter') {
                    event.preventDefault(); // Cegah form terkirim
                    validateCurrentPassword(); // Panggil fungsi validasi
                }
            });

            // Event listener untuk tombol Simpan Password
            document.getElementById('save-password-button').addEventListener('click', validateNewPasswords);
        });

        // Fungsi toggle untuk menampilkan atau menyembunyikan password
        function toggleVisibility(fieldId, toggleButtonId) {
            document.getElementById(toggleButtonId).addEventListener('click', function () {
                const input = document.getElementById(fieldId);
                input.type = input.type === 'password' ? 'text' : 'password';
                this.querySelector('i').classList.toggle('fa-eye');
                this.querySelector('i').classList.toggle('fa-eye-slash');
            });
        }

        // Fungsi untuk validasi password lama
        function validateCurrentPassword() {
            const currentPassword = document.getElementById('current_password').value;

            fetch('/validate-password', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ current_password: currentPassword })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Terjadi kesalahan dalam memverifikasi password.');
                }
                return response.json();
            })
            .then(data => {
                if (data.valid) {
                    // Aktifkan kolom password baru, konfirmasi, dan tombol simpan jika password lama benar
                    document.getElementById('password').disabled = false;
                    document.getElementById('password_confirmation').disabled = false;
                    document.getElementById('save-password-button').disabled = false;
                    document.getElementById('password').focus();
                } else {
                    Swal.fire({
                        title: 'Error',
                        text: 'Password lama yang Anda masukkan salah',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                    document.getElementById('current_password').focus();
                }
            })
            .catch(error => {
                Swal.fire({
                    title: 'Error',
                    text: error.message || 'Terjadi kesalahan dalam memverifikasi password. Silakan coba lagi.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            });
        }

        // Fungsi untuk validasi password baru dan konfirmasi saat tombol Simpan Password diklik
        function validateNewPasswords() {
            const newPassword = document.getElementById('password').value;
            const confirmPassword = document.getElementById('password_confirmation').value;

            if (newPassword === confirmPassword && newPassword !== '') {
                Swal.fire({
                    title: 'Berhasil',
                    text: 'Password berhasil diperbarui.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            } else {
                Swal.fire({
                    title: 'Kesalahan',
                    text: 'Password baru dan konfirmasi tidak sesuai. Silakan periksa kembali.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
                document.getElementById('password').focus();
            }
        }

    </script> --}}

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const currentPassword = document.getElementById('current_password');
            const newPassword = document.getElementById('password');
            const confirmPassword = document.getElementById('password_confirmation');
            const saveButton = document.getElementById('save-password-button');
            const resetButton = document.getElementById('reset-password-button');
            
            const toggleCurrentPassword = document.getElementById('toggle-current-password');
            const toggleNewPassword = document.getElementById('toggle-new-password');
            const toggleConfirmPassword = document.getElementById('toggle-confirm-password');

            let isCurrentPasswordValid = false;
            let isShowingPopup = false; // Flag untuk mencegah pop-up ganda

            // Fungsi Toggle Visibility
            function toggleVisibility(inputField, toggleButton) {
                if (inputField.type === 'password') {
                    inputField.type = 'text';
                    toggleButton.innerHTML = '<i class="far fa-eye-slash"></i>';
                } else {
                    inputField.type = 'password';
                    toggleButton.innerHTML = '<i class="far fa-eye"></i>';
                }
            }

            // Event Listener untuk Toggle Visibility
            toggleCurrentPassword.addEventListener('click', () => toggleVisibility(currentPassword, toggleCurrentPassword));
            toggleNewPassword.addEventListener('click', () => toggleVisibility(newPassword, toggleNewPassword));
            toggleConfirmPassword.addEventListener('click', () => toggleVisibility(confirmPassword, toggleConfirmPassword));

            let isValidating = false; // Tambahkan flag untuk mencegah validasi berulang
           
            
            // Fungsi validasi password lama
            async function validatePasswordOld() {
                if (isValidating) return; // Cegah pemanggilan fungsi jika sedang validasi
                isValidating = true;

                const currentPasswordValue = currentPassword.value.trim();

                // Cek apakah input kosong
                if (currentPasswordValue === "") {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Kesalahan',
                        text: 'Password lama tidak boleh kosong.',
                    });
                    isValidating = false; // Reset flag
                    return;
                }

                try {
                    console.log('Mengirim request untuk validasi password lama...');
                    const response = await fetch('/validate-password', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        },
                        body: JSON.stringify({ current_password: currentPasswordValue }),
                    });

                    // Log respons dari server
                    console.log('Respons dari server:', response);

                    // Cek status respons
                    if (!response.ok) {
                        console.error('Gagal mendapatkan respons dari server:', response.status);
                        Swal.fire({
                            icon: 'error',
                            title: 'Kesalahan',
                            text: 'Terjadi kesalahan saat memvalidasi password. (Status ' + response.status + ')',
                        });
                        return;
                    }

                    // Mengambil hasil validasi sebagai JSON
                    const result = await response.json();
                    console.log('Hasil validasi (JSON):', result);

                    // Menampilkan hasil validasi
                    if (result.valid) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Password Valid',
                            text: 'Password lama yang Anda masukkan benar.',
                        }).then(() => {
                            isCurrentPasswordValid = true;
                            currentPassword.disabled = true;
                            newPassword.disabled = false;
                            confirmPassword.disabled = false;
                            saveButton.disabled = false;
                            resetButton.disabled = false; // Aktifkan tombol reset
                            newPassword.focus();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Password Salah',
                            text: result.message || 'Password lama yang Anda masukkan salah.',
                        });
                        isCurrentPasswordValid = false;
                        newPassword.disabled = true;
                        confirmPassword.disabled = true;
                        saveButton.disabled = true;
                        resetButton.disabled = true; // Nonaktifkan tombol reset
                    }
                } catch (error) {
                    console.error('Kesalahan saat memvalidasi password:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Kesalahan',
                        text: 'Terjadi kesalahan saat memvalidasi password. Periksa koneksi Anda atau coba lagi.',
                    });
                }

                isValidating = false; // Reset flag
            }

            // Event Listener untuk validasi
            currentPassword.addEventListener('blur', validatePasswordOld);
            currentPassword.addEventListener('keyup', (event) => {
                if (event.key === 'Enter') {
                    validatePasswordOld();
                }
            });

            
            // Menghindari Double Pop-up Saat Konfirmasi Password Baru
            function showWarningPopup() {
                if (!isShowingPopup && newPassword.value.trim() === "") {
                    isShowingPopup = true;
                    Swal.fire({
                        icon: 'warning',
                        title: 'Perhatian',
                        text: 'Harap isi Password Baru terlebih dahulu sebelum mengisi Konfirmasi Password Baru.',
                    }).then(() => {
                        isShowingPopup = false; // Reset flag setelah SweetAlert ditutup
                        newPassword.focus();
                    });
                }
            }

            // Menambahkan Listener Fokus untuk Konfirmasi Password
            confirmPassword.addEventListener('focus', showWarningPopup);

            // Fungsi Menyimpan Password Baru
            async function validateAndSavePassword() {
                const newPasswordValue = newPassword.value.trim();
                const confirmPasswordValue = confirmPassword.value.trim();

                // Validasi jika password baru kosong
                if (newPasswordValue === "") {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Perhatian',
                        text: 'Password baru tidak boleh kosong.',
                    });
                    newPassword.focus();
                    return;
                }

                // Validasi jika konfirmasi password kosong
                if (confirmPasswordValue === "") {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Perhatian',
                        text: 'Konfirmasi password tidak boleh kosong.',
                    });
                    confirmPassword.focus();
                    return;
                }

                // Validasi kesesuaian password baru dan konfirmasi
                if (newPasswordValue !== confirmPasswordValue) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Kesalahan',
                        text: 'Password baru dan konfirmasi password tidak sesuai. Silakan periksa kembali.',
                    });
                    confirmPassword.focus();
                    return;
                }

                try {
                    const formData = new FormData();
                    formData.append('current_password', currentPassword.value);
                    formData.append('password', newPasswordValue);
                    formData.append('password_confirmation', confirmPasswordValue);

                    // Mengirimkan perubahan password ke server
                    const saveResponse = await fetch('/profile/update', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        },
                        body: formData,
                    });

                    const saveResult = await saveResponse.json();

                    if (saveResult.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Password berhasil diubah. Klik OK untuk logout.',
                        }).then(() => {
                            window.location.href = '/login';
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: saveResult.message || 'Gagal mengubah password.',
                        });
                    }
                } catch (error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Kesalahan',
                        text: 'Terjadi kesalahan saat memvalidasi atau menyimpan password.',
                    });
                }
            }

             // Event Listener saat tombol Simpan Password diklik
            saveButton.addEventListener('click', function (event) {
                event.preventDefault();
                validateAndSavePassword();
            });


            // Fungsi Reset Password
            resetButton.addEventListener('click', () => {
                // Reset input field
                currentPassword.value = '';
                newPassword.value = '';
                confirmPassword.value = '';
                currentPassword.disabled = false;
                newPassword.disabled = true;
                confirmPassword.disabled = true;
                saveButton.disabled = true;
                resetButton.disabled = true; // Nonaktifkan tombol reset setelah reset
                currentPassword.focus();
                isCurrentPasswordValid = false;
            });

            // Mulai dengan tombol reset dan save disabled
            saveButton.disabled = true;
            resetButton.disabled = true;
        });


    </script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function openForm() {
            var modal = new bootstrap.Modal(document.getElementById('jurnalForm'));
            modal.show();
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Fungsi untuk mengambil data jurnal dengan AJAX
        function fetchJurnals() {
            $.ajax({
                url: '/jurnals',  // Endpoint ke controller yang menyediakan data jurnal
                method: 'GET',
                success: function(data) {
                    $('#jurnal-table-container').html(data);  // Memperbarui konten tabel jurnal
                }
            });
        }

        // Panggil fetchJurnals() ketika halaman pertama kali dimuat
        $(document).ready(function() {
            fetchJurnals();  // Panggil sekali saat halaman dimuat

            // Memanggil fetchJurnals() setiap 5 detik
            setInterval(fetchJurnals, 5000);
        });
    </script>

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

    <script>
        $(document).ready(function(){
            // AJAX untuk mengganti konten utama saat klik sidebar link
            $('.sidebar .nav-link').click(function(e){
                e.preventDefault();
                var url = $(this).attr('href');
                $('#main-content').load(url + ' #main-content>*', function(){
                    history.pushState(null, '', url);
                });

                // Mengatur kelas aktif
                $('.sidebar .nav-link').removeClass('active');  // Hilangkan kelas aktif dari semua tautan
                $(this).addClass('active');                      // Tambahkan kelas aktif ke tautan yang diklik
            });

            // Menangani back/forward browser
            window.onpopstate = function(event) {
                var url = location.pathname;
                $('#main-content').load(url + ' #main-content>*');
                // Update aktif link
                $('.sidebar .nav-link').removeClass('active');
                $('.sidebar .nav-link[href="'+url+'"]').addClass('active');
            };
        });
    </script>  

    
    <script>
        $(document).ready(function() {
            $('#nama_dudi').on('change', function() {
                var selectedOption = $(this).find('option:selected');
                var noTelp = selectedOption.data('telp');
                
                console.log('Selected DUDI:', selectedOption.text());
                console.log('Phone Number:', noTelp);
                
                $('#no_telp_dudi').val(noTelp || '');
            });
        });
    </script>

    <script>
        let nisAlertShown = false;
        let namaAlertShown = false;

        document.getElementById('nis').addEventListener('blur', function () {
            validateNIS();
        });

        document.getElementById('nama_siswa').addEventListener('blur', function () {
            validateNama();
        });

        function validateNIS() {
            var nisField = document.getElementById('nis').value.trim();
            
            // Regex untuk validasi NIS: angka yang dipisahkan koma dengan atau tanpa spasi, koma tidak boleh di akhir
            if (nisField && !/^\d+(,\s*\d+)*$/.test(nisField)) {
                if (!nisAlertShown) {
                    nisAlertShown = true; 
                    Swal.fire({
                        icon: 'warning',
                        title: 'Format NIS Salah',
                        text: 'Pisahkan NIS dengan tanda koma jika lebih dari satu, dan jangan ada koma di akhir.',
                        confirmButtonColor: '#1A5276'
                    }).then(() => {
                        document.getElementById('nis').focus();  
                        nisAlertShown = false;
                    });
                }
            } else {
                nisAlertShown = false; // Reset alert jika format sudah benar
            }
        }

        function validateNama() {
            var namaField = document.getElementById('nama_siswa').value.trim();
            
            // Regex untuk validasi Nama: setiap nama dipisahkan koma dan baris baru diperbolehkan, koma tidak boleh di akhir
            if (namaField && !/^(?:[a-zA-Z\s]+,\n?)+[a-zA-Z\s]+$/.test(namaField)) {
                if (!namaAlertShown) {
                    namaAlertShown = true;
                    Swal.fire({
                        icon: 'warning',
                        title: 'Format Nama Salah',
                        text: 'Pisahkan setiap nama dengan koma dan baris baru jika lebih dari satu. Pastikan koma hanya ada di akhir setiap nama kecuali yang terakhir.',
                        confirmButtonColor: '#1A5276'
                    }).then(() => {
                        document.getElementById('nama_siswa').focus();  
                        namaAlertShown = false;
                    });
                }
            } else {
                namaAlertShown = false; // Reset alert jika format sudah benar
            }
        }
    </script>




    {{-- <script>
        function getLocation() {
            if (navigator.geolocation) {
                // Mengambil posisi pengguna
                navigator.geolocation.getCurrentPosition(showPosition, showError);
            } else {
                alert("Geolocation tidak didukung oleh browser ini.");
            }
        }

        function showPosition(position) {
            var latitude = position.coords.latitude;
            var longitude = position.coords.longitude;

            // Panggil fungsi untuk mendapatkan alamat dari koordinat
            getAddressFromCoordinates(latitude, longitude);

            // Menampilkan tautan ke Google Maps
            var mapsLink = document.getElementById("mapsLink");
            mapsLink.href = `https://www.google.com/maps?q=${latitude},${longitude}`;
            mapsLink.style.display = 'inline-block';
        }

        function getAddressFromCoordinates(latitude, longitude) {
            var geocodingAPI = `https://maps.googleapis.com/maps/api/geocode/json?latlng=${latitude},${longitude}&key=YOUR_GOOGLE_MAPS_API_KEY`;

            // Mengambil data dari API
            fetch(geocodingAPI)
                .then(response => response.json())
                .then(data => {
                    if (data.status === "OK") {
                        var address = data.results[0].formatted_address;
                        // Menampilkan alamat di input field
                        document.getElementById("lokasi").value = address;
                    } else {
                        alert("Alamat tidak dapat ditemukan.");
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert("Terjadi kesalahan saat mengambil alamat.");
                });
        }

        function showError(error) {
            switch(error.code) {
                case error.PERMISSION_DENIED:
                    alert("Pengguna menolak permintaan untuk Geolocation.");
                    break;
                case error.POSITION_UNAVAILABLE:
                    alert("Informasi lokasi tidak tersedia.");
                    break;
                case error.TIMEOUT:
                    alert("Permintaan untuk mendapatkan lokasi pengguna telah melebihi batas waktu.");
                    break;
                case error.UNKNOWN_ERROR:
                    alert("Terjadi kesalahan yang tidak diketahui.");
                    break;
            }
        }
    </script> --}}

    <script>
        function getLocation() {
            if (navigator.geolocation) {
                // Mengambil posisi pengguna
                navigator.geolocation.getCurrentPosition(showPosition, showError);
            } else {
                alert("Geolocation tidak didukung oleh browser ini.");
            }
        }

        function showPosition(position) {
            var latitude = position.coords.latitude;
            var longitude = position.coords.longitude;

            // Panggil fungsi untuk mendapatkan alamat dari koordinat menggunakan Nominatim
            getAddressFromCoordinates(latitude, longitude);

            // Menampilkan tautan ke Google Maps atau OpenStreetMap
            var mapsLink = document.getElementById("mapsLink");
            mapsLink.href = `https://www.openstreetmap.org/?mlat=${latitude}&mlon=${longitude}#map=18/${latitude}/${longitude}`;
            mapsLink.style.display = 'inline-block';
        }

        function getAddressFromCoordinates(latitude, longitude) {
            var nominatimAPI = `https://nominatim.openstreetmap.org/reverse?format=json&lat=${latitude}&lon=${longitude}&zoom=18&addressdetails=1`;

            // Mengambil data dari Nominatim API
            fetch(nominatimAPI)
                .then(response => response.json())
                .then(data => {
                    if (data && data.address) {
                        var address = data.display_name;
                        // Menampilkan alamat di input field
                        document.getElementById("lokasi").value = address;
                    } else {
                        alert("Alamat tidak dapat ditemukan.");
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert("Terjadi kesalahan saat mengambil alamat.");
                });
        }

        function showError(error) {
            switch(error.code) {
                case error.PERMISSION_DENIED:
                    alert("Pengguna menolak permintaan untuk Geolocation.");
                    break;
                case error.POSITION_UNAVAILABLE:
                    alert("Informasi lokasi tidak tersedia.");
                    break;
                case error.TIMEOUT:
                    alert("Permintaan untuk mendapatkan lokasi pengguna telah melebihi batas waktu.");
                    break;
                case error.UNKNOWN_ERROR:
                    alert("Terjadi kesalahan yang tidak diketahui.");
                    break;
            }
        }
    </script>

    <script>
        //Script Pagination
        let currentPage = 1;
        const rowsPerPage = 10; // Jumlah baris per halaman
        const tableData = document.querySelectorAll("#data-table tr"); // Mengambil semua baris dalam tabel
        const totalPages = Math.ceil(tableData.length / rowsPerPage);
        
        function displayTablePage(page) {
            const start = (page - 1) * rowsPerPage;
            const end = start + rowsPerPage;
            tableData.forEach((row, index) => {
                row.style.display = index >= start && index < end ? '' : 'none';
            });
        }

        function setupPagination() {
            const paginationNumbers = document.getElementById('pagination-numbers');
            paginationNumbers.innerHTML = '';

            for (let i = 1; i <= totalPages; i++) {
                const pageButton = document.createElement('div');
                pageButton.className = 'pagination-number';
                pageButton.innerText = i;
                pageButton.addEventListener('click', () => goToPage(i));
                paginationNumbers.appendChild(pageButton);
            }
        }

        function goToPage(page) {
            currentPage = page;
            displayTablePage(page);
            updatePaginationButtons();
        }

        function prevPage() {
            if (currentPage > 1) {
                goToPage(currentPage - 1);
            }
        }

        function nextPage() {
            if (currentPage < totalPages) {
                goToPage(currentPage + 1);
            }
        }

        function updatePaginationButtons() {
            document.getElementById('prev-btn').disabled = currentPage === 1;
            document.getElementById('next-btn').disabled = currentPage === totalPages;

            document.querySelectorAll('.pagination-number').forEach((button, index) => {
                button.classList.toggle('active', index + 1 === currentPage);
            });
        }

        // Inisialisasi tampilan tabel dan pagination
        displayTablePage(currentPage);
        setupPagination();
        updatePaginationButtons();
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
        AOS.init();
    </script>

    
    
</body>
</html>