<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Arahkan ke login jika belum login
    exit();
}

// Koneksi ke database
include 'config.php';

// Ambil semua tugas dari database
$result = $conn->query("SELECT tasks.*, projects.name AS project_name FROM tasks JOIN projects ON tasks.project_id = projects.id");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Tugas - Aplikasi Manajemen Proyek</title>
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
                    <a class="nav-link active" href="tasks.php">Manajemen Tugas</a>
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
    <h2>Daftar Tugas</h2>
    <a href="add_task.php" class="btn btn-primary mb-3">Tambah Tugas</a>
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
            <?php while ($task = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $task['id']; ?></td>
                    <td><?php echo htmlspecialchars($task['project_id']); ?></td>
                    <td><?php echo htmlspecialchars($task['description']); ?></td>
                    <td><?php echo htmlspecialchars($task['due_date']); ?></td>
                    <td><?php echo htmlspecialchars($task['status']); ?></td>
                    <td>
                        <a href="edit_task.php?id=<?php echo $task['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="delete_task.php?id=<?php echo $task['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus tugas ini?')">Hapus</a>
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
