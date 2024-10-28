<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
  
        <nav class="navbar navbar-expand-lg ">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img src="{{ asset('image/Logo_SMKN1Bantul.png') }}" alt="Logo" style="height: 70px;">
                    <strong>PKL SMK N 1 BANTUL</strong>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
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
        </nav>
              
    </header>

    @yield('content')

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
    
    <script>
        // Toggle visibility for current (old) password field
        document.getElementById('toggle-current-password').addEventListener('click', function () {
            var input = document.getElementById('current_password');
            if (input.type === 'password') {
                input.type = 'text';
                this.querySelector('i').classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                input.type = 'password';
                this.querySelector('i').classList.replace('fa-eye-slash', 'fa-eye');
            }
        });
    
        // Toggle visibility for new password field
        document.getElementById('toggle-password').addEventListener('click', function () {
            var input = document.getElementById('password');
            if (input.type === 'password') {
                input.type = 'text';
                this.querySelector('i').classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                input.type = 'password';
                this.querySelector('i').classList.replace('fa-eye-slash', 'fa-eye');
            }
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

    <!-- Kemudian ubah script menjadi: -->
    <script>
    $(document).ready(function() {
        $('#tempat_pkl').on('change', function() {
            var selectedOption = $(this).find('option:selected');
            var noTelp = selectedOption.data('telp');
            
            console.log('Selected DUDI:', selectedOption.text());
            console.log('Phone Number:', noTelp);
            
            $('#no_telp_dudi').val(noTelp || '');
        });
    });
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

    <script>
        document.getElementById('navbarNav').addEventListener('shown.bs.collapse', function () {
            console.log('Navbar collapse shown');
        });

        document.getElementById('navbarNav').addEventListener('hidden.bs.collapse', function () {
            console.log('Navbar collapse hidden');
        });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
        AOS.init();
    </script>

    
    
</body>
</html>