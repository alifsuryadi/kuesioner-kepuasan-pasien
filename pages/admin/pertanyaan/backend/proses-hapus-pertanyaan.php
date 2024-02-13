<?php
// Include file koneksi
include_once("../../../../validations/middleware-3.php");
include_once("../../../../validations/connection.php");

// Periksa apakah ID pertanyaan dikirim melalui URL
if (isset($_GET['id']) && !empty(trim($_GET['id']))) {
    // Siapkan parameter ID pertanyaan
    $id_pertanyaan = trim($_GET['id']);

    // Query untuk menghapus pertanyaan dari database
    $sql = "UPDATE questions SET deleted_at = NOW() WHERE id_question = ?";

    if ($stmt = mysqli_prepare($connect, $sql)) {
        // Bind parameter ke query
        mysqli_stmt_bind_param($stmt, "i", $param_id);

        // Set parameter
        $param_id = $id_pertanyaan;

        // Eksekusi query
        if (mysqli_stmt_execute($stmt)) {
            // Redirect ke halaman kelola pertanyaan setelah berhasil menghapus
            header("location: ../kelola-pertanyaan.php");
            exit();
        } else {
            echo "Oops! Ada yang salah. Silakan coba lagi nanti.";
        }

        // Tutup statement
        mysqli_stmt_close($stmt);
    }

    // Tutup koneksi
    mysqli_close($connect);
} else {
    // Jika ID tidak tersedia, redirect ke halaman error
    header("location: error.php");
    exit();
}
?>