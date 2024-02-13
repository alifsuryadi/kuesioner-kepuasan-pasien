<?php
session_start();

// Hapus semua data sesi
session_unset();

// Hancurkan sesi
session_destroy();

// Redirect ke halaman login
$_SESSION['logged_in'] = false;
header("Location: ../login.php");
exit();
?>