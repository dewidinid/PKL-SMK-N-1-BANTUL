<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="{{ asset('css/header-admin.css') }}">
    <link rel="stylesheet" href="{{ asset('css/card-dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/card-sistem-pkl.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tabel.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
    <header class="header-admin">
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
                            <a class="nav-link" href="{{ route('home_admin') }}">Beranda</a>
                        </li>
                        <li class="nav-item">
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Logout
                            </a>
                        </li>                        
                    </ul>
                </div>
            </div>
        </nav>
              
    </header>

    @yield('content')

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
    
    
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
        <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
        <script>
            AOS.init();
        </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('navbarNav').addEventListener('shown.bs.collapse', function () {
            console.log('Navbar collapse shown');
        });

        document.getElementById('navbarNav').addEventListener('hidden.bs.collapse', function () {
            console.log('Navbar collapse hidden');
        });
    </script>
    
</body>
</html>