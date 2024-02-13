<?php
// Include file koneksi
include_once("../../../../validations/middleware-3.php");
include_once("../../../../validations/connection.php");

// Periksa apakah data dari form telah dikirimkan
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai yang dikirimkan melalui form
    $question = $_POST['question'];
    $id_category = $_POST['id_category'];

    // Query untuk menambahkan question baru
    $sql = "INSERT INTO questions (question, id_category, created_at) VALUES (?, ?, NOW())";

    if ($stmt = mysqli_prepare($connect, $sql)) {
        // Bind parameter ke query
        mysqli_stmt_bind_param($stmt, "si", $question, $id_category);

        // Eksekusi query
        if (mysqli_stmt_execute($stmt)) {
            // Redirect ke halaman kelola pertanyaan setelah berhasil menambahkan
            header("location: ../kelola-pertanyaan.php");
            exit();
        } else {
            $error = "Oops! Ada yang salah. Silakan coba lagi nanti.";
        }

        // Tutup statement
        mysqli_stmt_close($stmt);
    }

    // Tutup koneksi
    mysqli_close($connect);
}
?>