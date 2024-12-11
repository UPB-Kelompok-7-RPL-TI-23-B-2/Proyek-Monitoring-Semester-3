<?php
// Aktifkan error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

$host = "localhost";
$user = "root";  // Sesuaikan dengan username database Anda
$pass = "";      // Sesuaikan dengan password database Anda
$db   = "db_smep";  // Ganti dengan nama database Anda

// Koneksi Database dengan error handling
$koneksi = mysqli_connect($host, $user, $pass, $db);

// Cek Koneksi
if (!$koneksi) {
    die("Koneksi Gagal: " . mysqli_connect_error());
}

// Set karakter UTF-8
mysqli_set_charset($koneksi, "utf8");
?>