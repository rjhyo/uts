<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Arahkan ke login jika belum login
    exit();
}

// Koneksi ke database
include 'config.php';

// Ambil ID tugas dari query string
if (isset($_GET['id'])) {
    $task_id = $_GET['id'];

    // Ambil data tugas berdasarkan ID
    $query = "SELECT * FROM tasks WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $task_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        header("Location: tasks.php?message=Tugas tidak ditemukan");
        exit();
    }

    $task = $result->fetch_assoc();
} else {
    header("Location: tasks.php?message=ID tugas tidak valid");
    exit();
}

// Proses form ketika disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $project_id = $_POST['project_id'];
    $assigned_to = $_POST['assigned_to'];
    $description = $_POST['description'];
    $due_date = $_POST['due_date'];
    $status = $_POST['status'];

    // Update data tugas di database
    $update_query = "UPDATE tasks SET project_id = ?, assigned_to = ?, description = ?, due_date = ?, status = ? WHERE id = ?";
    $update_stmt = $conn->prepare($update_query);
    $update_stmt->bind_param("iisssi", $project_id, $assigned_to, $description, $due_date, $status, $task_id);

    if ($update_stmt->execute()) {
        header("Location: tasks.php?message=Tugas berhasil diperbarui");
        exit();
    } else {
        $error = "Terjadi kesalahan saat memperbarui tugas.";
    }
}

// Ambil semua proyek untuk dropdown
$projects_query = "SELECT * FROM projects";
$projects_result = $conn->query($projects_query);

// Ambil semua pengguna untuk dropdown
$users_query = "SELECT * FROM users";
$users_result = $conn->query($users_query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Tugas - Aplikasi Manajemen Proyek</title>
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
    <h2>Edit Tugas</h2>

    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>

    <form action="edit_task.php?id=<?php echo $task_id; ?>" method="POST">
        <div class="form-group">
            <label for="project_id">Proyek</label>
            <select name="project_id" id="project_id" class="form-control" required>
                <?php while ($project = $projects_result->fetch_assoc()): ?>
                    <option value="<?php echo $project['id']; ?>" <?php echo ($project['id'] == $task['project_id']) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($project['name']); ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="assigned_to">Ditetapkan Kepada</label>
            <select name="assigned_to" id="assigned_to" class="form-control">
                <option value="">Tidak Ditetapkan</option>
                <?php while ($user = $users_result->fetch_assoc()): ?>
                    <option value="<?php echo $user['id']; ?>" <?php echo ($user['id'] == $task['assigned_to']) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($user['name']); ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="description">Deskripsi</label>
            <textarea name="description" id="description" class="form-control" required><?php echo htmlspecialchars($task['description']); ?></textarea>
        </div>

        <div class="form-group">
            <label for="due_date">Tanggal Tenggat</label>
            <input type="date" name="due_date" id="due_date" class="form-control" value="<?php echo htmlspecialchars($task['due_date']); ?>" required>
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control" required>
                <option value="not_started" <?php echo ($task['status'] == 'not_started') ? 'selected' : ''; ?>>Belum Dimulai</option>
                <option value="in_progress" <?php echo ($task['status'] == 'in_progress') ? 'selected' : ''; ?>>Sedang Berlangsung</option>
                <option value="completed" <?php echo ($task['status'] == 'completed') ? 'selected' : ''; ?>>Selesai</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Perbarui Tugas</button>
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
