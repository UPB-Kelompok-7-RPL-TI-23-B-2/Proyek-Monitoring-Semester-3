<?php
// Memulai sesi
session_start();

// Menghapus semua data sesi
session_unset();

// Menghancurkan sesi
session_destroy();

// Mengarahkan pengguna ke halaman login (atau halaman lain)
header("Location: login.php");
exit();
?>