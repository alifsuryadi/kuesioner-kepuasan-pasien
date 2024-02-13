<?php
session_start();

// Periksa apakah pengguna sudah login atau belum
if (!isset($_SESSION['email'])) {
    // Jika belum, redirect ke halaman login
    header("Location: ../../../../login.php");
    exit();
}
?>