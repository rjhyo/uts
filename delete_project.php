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

// Siapkan dan eksekusi query untuk menghapus proyek
$stmt = $conn->prepare("DELETE FROM projects WHERE id = ?");
$stmt->bind_param("i", $project_id);

if ($stmt->execute()) {
    header("Location: projects.php"); // Arahkan kembali ke daftar proyek
    exit();
} else {
    echo "Gagal menghapus proyek: " . $stmt->error;
}
?>
