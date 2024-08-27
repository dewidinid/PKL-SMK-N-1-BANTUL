<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .footer {
            background-color: #0275d8;
            color: white;
            padding: 20px 0;
            margin-top: 20px;
        }
        .footer .container {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }
        .footer .footer-description {
            max-width: 50%;
        }
        .footer .footer-contact {
            max-width: 30%;
        }
        .footer .social-icons a {
            color: white;
            margin-right: 10px;
            font-size: 20px;
        }
        .footer-bottom {
            background-color: #025aa5;
            color: white;
            text-align: center;
            padding: 10px 0;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <footer class="footer">
        <div class="container">
            <div class="footer-description">
                <h5>E-PKL</h5>
                <p>Sebuah website yang menyediakan informasi dan monitoring PKL (Praktek Kerja Lapangan) SMK N 1 Bantul</p>
                <div class="social-icons">
                    <a href="#"><i class="bi bi-twitter"></i></a>
                    <a href="#"><i class="bi bi-facebook"></i></a>
                    <a href="#"><i class="bi bi-instagram"></i></a>
                </div>
            </div>
            <div class="footer-contact">
                <h5>Hubungi Kami</h5>
                <p>SMK N 1 Bantul<br>
                Jl. Parangtritis Km 11, Sabdodadi Kec. Bantul,<br>
                Kota Bantul, Daerah Istimewa Yogyakarta 55715</p>
            </div>
        </div>
        <div class="footer-bottom">
            &copy; Copyright SMK N 1 Bantul. All Rights Reserved
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
