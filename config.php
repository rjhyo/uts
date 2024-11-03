<?php
// Konfigurasi database
$host = 'localhost'; // Ganti dengan host database Anda jika berbeda
$user = 'root'; // Ganti dengan username database Anda
$password = ''; // Ganti dengan password database Anda
$dbname = 'project_management'; // Nama database yang telah dibuat

// Membuat koneksi ke database
$conn = new mysqli($host, $user, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
