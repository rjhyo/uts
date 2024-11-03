<?php
session_start();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Manajemen Proyek</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .hero {
            background-color: #343a40;
            color: white;
            padding: 60px 0;
            text-align: center;
        }
        .hero h1 {
            font-size: 3rem;
        }
        .hero p {
            font-size: 1.25rem;
        }
        .features {
            padding: 60px 0;
        }
        .feature {
            text-align: center;
            padding: 20px;
        }
    </style>
</head>
<body>

    <!-- Hero Section -->
    <header class="hero">
        <div class="container">
            <h1>Selamat Datang di Aplikasi Manajemen Proyek</h1>
            <p>Kelola proyek Anda dengan mudah dan efisien.</p>
            <a href="login.php" class="btn btn-primary btn-lg">Login</a>
            <a href="register.php" class="btn btn-secondary btn-lg">Daftar Sekarang</a>
        </div>
    </header>

    <!-- Features Section -->
    <section class="features">
        <div class="container">
            <h2 class="text-center">Fitur Utama</h2>
            <div class="row">
                <div class="col-md-3 feature">
                    <h4>Manajemen Proyek</h4>
                    <p>Rencanakan dan lacak proyek Anda dari awal hingga selesai.</p>
                </div>
                <div class="col-md-3 feature">
                    <h4>Manajemen Tugas</h4>
                    <p>Atur dan tetapkan tugas kepada anggota tim dengan mudah.</p>
                </div>
                <div class="col-md-3 feature">
                    <h4>Pengelolaan Tim</h4>
                    <p>Kelola anggota tim dan pantau kontribusi mereka dalam proyek.</p>
                </div>
                <div class="col-md-3 feature">
                    <h4>Progres Real-Time</h4>
                    <p>Ikuti perkembangan proyek dan sesuaikan rencana dengan cepat.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="text-center py-4">
        <p>&copy; <?php echo date("Y"); ?> Aplikasi Manajemen Proyek. Semua hak dilindungi.</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
