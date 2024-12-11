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
    
    $username = trim(mysqli_real_escape_string($koneksi, $_POST['username']));
    $password = trim($_POST['password']);
    // Bersihkan input
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = $_POST['password'];

    // Debug: Tampilkan input
    echo "Username: " . $username . "<br>";

    // Query untuk mencari user
    $query = "SELECT * FROM tb_user WHERE username = '$username'";
    $result = mysqli_query($koneksi, $query);

    // Cek apakah query berhasil
    if (!$result) {
        die("Query Error: " . mysqli_error($koneksi));
    }

    $user = mysqli_fetch_assoc($result);

    // Debug: Tampilkan informasi user
    if ($user) {
        echo "User ditemukan: <br>";
        echo "Stored Password Hash: " . $user['password'] . "<br>";
        echo "Input Password: " . $password . "<br>";
    } else {
        echo "User tidak ditemukan<br>";
    }

    // Verifikasi password dengan debug
    if ($user && password_verify($password, $user['password'])) {
        // Login berhasil
        $_SESSION['login'] = true;
        $_SESSION['id_user'] = $user['id_user'];
        $_SESSION['username'] = $user['username'];
        
        header("Location: ../index.php");
        exit();
    } else {
        // Login gagal
        $_SESSION['error'] = "Username atau password salah!";
        
        // Debug tambahan
        if (!$user) {
            $_SESSION['error'] = "Username tidak ditemukan!";
        } else {
            $_SESSION['error'] = "Password salah!";
        }
        
        header("Location: ../login.php");
        exit();
    }
}
?>