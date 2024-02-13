<?php
// Include file koneksi
include_once("../../../../validations/middleware-3.php");
include_once("../../../../validations/connection.php");

// Inisialisasi variabel untuk menyimpan pesan kesalahan
$error = "";

// Periksa apakah data dari form telah dikirimkan
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai yang dikirimkan melalui form
    $id_pertanyaan = $_POST['id_pertanyaan'];
    $pertanyaan = $_POST['pertanyaan'];
    $id_kategori = $_POST['kategori'];

    // Query untuk update pertanyaan
    $sql = "UPDATE questions SET question = ?, id_category = ?, updated_at = NOW() WHERE id_question = ?";

    if ($stmt = mysqli_prepare($connect, $sql)) {
        // Bind parameter ke query
        mysqli_stmt_bind_param($stmt, "sii", $pertanyaan, $id_kategori, $id_pertanyaan);

        // Eksekusi query
        if (mysqli_stmt_execute($stmt)) {
            // Redirect ke halaman kelola pertanyaan setelah berhasil mengedit
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