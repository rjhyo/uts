<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Arahkan ke login jika belum login
    exit();
}

// Koneksi ke database
include 'config.php';

// Ambil data dari form
$project_id = $_POST['project_id'];
$assigned_to = $_POST['assigned_to'];
$description = $_POST['description'];
$due_date = $_POST['due_date'];

// Siapkan dan eksekusi query untuk menyimpan tugas
$stmt = $conn->prepare("INSERT INTO tasks (project_id, assigned_to, description, due_date) VALUES (?, ?, ?, ?)");
$stmt->bind_param("iiss", $project_id, $assigned_to, $description, $due_date);

if ($stmt->execute()) {
    // Redirect ke halaman tugas jika berhasil
    header("Location: tasks.php?message=Tugas berhasil ditambahkan");
} else {
    // Tampilkan pesan kesalahan jika gagal
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
