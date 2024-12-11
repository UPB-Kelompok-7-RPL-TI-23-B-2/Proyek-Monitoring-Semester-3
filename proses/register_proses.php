<?php
session_start();
include('../config/koneksi.php');

// Aktifkan error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Gunakan trim() untuk menghapus spasi
    $username = trim(mysqli_real_escape_string($koneksi, $_POST['username']));
    $password = trim($_POST['password']);
    $konfirmasi_password = trim($_POST['konfirmasi_password']);
    
    // Bersihkan input
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = $_POST['password'];
    $konfirmasi_password = $_POST['konfirmasi_password'];

    // Validasi input
    $errors = [];

    // Cek username sudah ada
    $cek_username = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE username = '$username'");
    if (mysqli_num_rows($cek_username) > 0) {
        $errors[] = "Username sudah terdaftar";
    }

    // Validasi password
    if ($password !== $konfirmasi_password) {
        $errors[] = "Konfirmasi password tidak sesuai";
    }

    if (strlen($password) < 6) {
        $errors[] = "Password minimal 6 karakter";
    }

    // Jika ada error
    if (!empty($errors)) {
        $_SESSION['error'] = implode("<br>", $errors);
        header("Location: ../register.php");
        exit();
    }

    // Hash password
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    // Query simpan data dengan prepared statement
    $stmt = $koneksi->prepare("INSERT INTO tb_user (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $password_hash);
    
    // Eksekusi query
    if ($stmt->execute()) {
        $_SESSION['success'] = "Registrasi berhasil. Silakan login.";
        header("Location: ../login.php");
        exit();
    } else {
        $_SESSION['error'] = "Registrasi gagal: " . $stmt->error;
        header("Location: ../register.php");
        exit();
    }
}
?>