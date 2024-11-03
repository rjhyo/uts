<?php
session_start();
include 'config.php'; // Menghubungkan ke database

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Enkripsi password

    // Cek apakah username sudah ada
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['error'] = "Username sudah digunakan.";
        header("Location: register.php");
        exit();
    } else {
        // Masukkan pengguna baru ke database
        $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $password);
        if ($stmt->execute()) {
            $_SESSION['success'] = "Pendaftaran berhasil! Silakan login.";
            header("Location: login.php");
            exit();
        } else {
            $_SESSION['error'] = "Terjadi kesalahan. Silakan coba lagi.";
            header("Location: register.php");
            exit();
        }
    }
}
