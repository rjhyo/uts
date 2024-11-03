<?php
session_start();
include 'config.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query untuk mendapatkan data pengguna berdasarkan username
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // Verifikasi password
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            header("Location: dashboard.php"); // Arahkan ke dashboard
            exit();
        } else {
            $_SESSION['error'] = "Password salah.";
            header("Location: login.php");
            exit();
        }
    } else {
        $_SESSION['error'] = "Username tidak ditemukan.";
        header("Location: login.php");
        exit();
    }
}
