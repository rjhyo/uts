<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Arahkan ke login jika belum login
    exit();
}

// Koneksi ke database
include 'config.php';

// Ambil semua proyek untuk dropdown
$projects = $conn->query("SELECT * FROM projects");
$users = $conn->query("SELECT * FROM users"); // Mengambil semua pengguna untuk penugasan
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Tugas - Aplikasi Manajemen Proyek</title>
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
    <h2>Tambah Tugas</h2>
    <form action="store_task.php" method="POST">
        <div class="form-group">
            <label for="project_id">Proyek</label>
            <select name="project_id" id="project_id" class="form-control" required>
                <option value="">Pilih Proyek</option>
                <?php while ($project = $projects->fetch_assoc()): ?>
                    <option value="<?php echo $project['id']; ?>"><?php echo htmlspecialchars($project['name']); ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="assigned_to">Ditetapkan Kepada</label>
            <select name="assigned_to" id="assigned_to" class="form-control">
                <option value="">Tidak Ditetapkan</option>
                <?php while ($user = $users->fetch_assoc()): ?>
                    <option value="<?php echo $user['id']; ?>"><?php echo htmlspecialchars($user['name']); ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="description">Deskripsi</label>
            <textarea name="description" id="description" class="form-control" required></textarea>
        </div>
        <div class="form-group">
            <label for="due_date">Tanggal Tenggat</label>
            <input type="date" name="due_date" id="due_date" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan Tugas</button>
        <a href="tasks.php" class="btn btn-secondary">Kembali</a>
    </form>
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
