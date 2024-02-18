<?php

include_once("../../../../validations/middleware-3.php");
include_once("../../../../validations/connection.php");

// Periksa apakah parameter ID form diberikan dalam URL
if (isset($_GET['id_form'])) {
    $id_form = $_GET['id_form'];

    
    // Hapus data dari tabel users berdasarkan ID form
    $query_delete_users = "DELETE FROM users WHERE id_user IN (SELECT id_user FROM survey_form WHERE id_form = $id_form)";
    $result_delete_users = mysqli_query($connect, $query_delete_users);

    // Hapus data dari tabel survey_results berdasarkan ID form
    $query_delete_results = "DELETE FROM survey_results WHERE id_form = $id_form";
    $result_delete_results = mysqli_query($connect, $query_delete_results);

    // Hapus data dari tabel survey_form berdasarkan ID form
    $query_delete_form = "DELETE FROM survey_form WHERE id_form = $id_form";
    $result_delete_form = mysqli_query($connect, $query_delete_form);



    if ($result_delete_results && $result_delete_form && $result_delete_users) {
        // Redirect ke halaman yang sesuai setelah penghapusan berhasil
        header("Location: ../table-pengujian.php");
        exit();
    } else {
        echo "Error: Gagal menghapus data";
    }
} else {
    echo "Error: ID form tidak diberikan";
}
?>