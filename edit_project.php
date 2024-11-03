<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Arahkan ke login jika belum login
    exit();
}

// Koneksi ke database
include 'config.php';

// Ambil ID proyek dari URL
$project_id = $_GET['id'];

// Ambil data proyek untuk diedit
$stmt = $conn->prepare("SELECT * FROM projects WHERE id = ?");
$stmt->bind_param("i", $project_id);
$stmt->execute();
$result = $stmt->get_result();
$project = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $deadline = $_POST['deadline'];
    $status = $_POST['status'];

    // Siapkan dan eksekusi query untuk mengupdate proyek
    $stmt = $conn->prepare("UPDATE projects SET name = ?, description = ?, deadline = ?, status = ? WHERE id = ?");
    $stmt->bind_param("ssssi", $name, $description, $deadline, $status, $project_id);

    if ($stmt->execute()) {
        header("Location: projects.php"); // Arahkan kembali ke daftar proyek
        exit();
    } else {
        echo "Gagal memperbarui proyek: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Proyek - Aplikasi Manajemen Proyek</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Edit Proyek</h2>
    <form method="POST">
        <div class="form-group">
            <label>Nama Proyek</label>
            <input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($project['name']); ?>" required>
        </div>
        <div class="form-group">
            <label>Deskripsi</label>
            <textarea name="description" class="form-control"><?php echo htmlspecialchars($project['description']); ?></textarea>
        </div>
        <div class="form-group">
            <label>Tanggal Tenggat</label>
            <input type="date" name="deadline" class="form-control" value="<?php echo htmlspecialchars($project['deadline']); ?>">
        </div>
        <div class="form-group">
            <label>Status</label>
            <select name="status" class="form-control">
                <option value="ongoing" <?php if ($project['status'] == 'ongoing') echo 'selected'; ?>>Sedang Berlangsung</option>
                <option value="completed" <?php if ($project['status'] == 'completed') echo 'selected'; ?>>Selesai</option>
                <option value="on_hold" <?php if ($project['status'] == 'on_hold') echo 'selected'; ?>>Ditangguhkan</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Perbarui Proyek</button>
        <a href="projects.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>
</body>
</html>
