<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Arahkan ke login jika belum login
    exit();
}

// Koneksi ke database
include 'config.php';

// Cek apakah ID tugas diterima melalui URL
if (isset($_GET['id'])) {
    $task_id = $_GET['id'];

    // Hapus tugas dari database
    $delete_query = "DELETE FROM tasks WHERE id = ?";
    $delete_stmt = $conn->prepare($delete_query);
    $delete_stmt->bind_param("i", $task_id);

    if ($delete_stmt->execute()) {
        header("Location: tasks.php?message=Tugas berhasil dihapus");
        exit();
    } else {
        $error = "Terjadi kesalahan saat menghapus tugas.";
    }
} else {
    header("Location: tasks.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hapus Tugas - Aplikasi Manajemen Proyek</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="#">Aplikasi Manajemen Proyek</a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="dashboard.php">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="projects.php">Manajemen Proyek</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="tasks.php">Manajemen Tugas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="users.php">Manajemen Pengguna</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php else: ?>
        <div class="alert alert-success">Tugas berhasil dihapus.</div>
    <?php endif; ?>
    <a href="tasks.php" class="btn btn-secondary">Kembali ke Tugas</a>
</div>

<!-- Footer -->
<footer class="text-center py-4">
    <p>&copy; <?php echo date("Y"); ?> Aplikasi Manajemen Proyek. Semua hak dilindungi.</p>
</footer>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
