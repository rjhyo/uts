<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Arahkan ke login jika belum login
    exit();
}

// Koneksi ke database
include 'config.php';

// Ambil semua proyek dari database
$result = $conn->query("SELECT * FROM projects");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Proyek - Aplikasi Manajemen Proyek</title>
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
                    <a class="nav-link active" href="projects.php">Manajemen Proyek</a>
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
    <h2>Daftar Proyek</h2>
    <a href="add_project.php" class="btn btn-primary mb-3">Tambah Proyek</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Proyek</th>
                <th>Deskripsi</th>
                <th>Tanggal Tenggat</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($project = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $project['id']; ?></td>
                    <td><?php echo htmlspecialchars($project['name']); ?></td>
                    <td><?php echo htmlspecialchars($project['description']); ?></td>
                    <td><?php echo htmlspecialchars($project['deadline']); ?></td>
                    <td><?php echo htmlspecialchars($project['status']); ?></td>
                    <td>
                        <a href="edit_project.php?id=<?php echo $project['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="delete_project.php?id=<?php echo $project['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus proyek ini?')">Hapus</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
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
