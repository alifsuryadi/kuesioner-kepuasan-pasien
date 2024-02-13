<?php
// Include file koneksi ke database
include "../../validations/connection.php";

// Mengecek apakah form telah dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai ID pengguna dari form
    $id_user = $_POST['id_user'];
    
    // Buat array untuk menyimpan jawaban pertanyaan
    $answers = array();
    
    // Looping untuk mengambil nilai jawaban dari setiap pertanyaan
    for ($i = 1; $i <= 30; $i++) {
        $question_key = 'Q' . $i;
        if (isset($_POST[$question_key])) {
            $answers[$question_key] = $_POST[$question_key];
        }
    }
    
    // Membuat string kunci dan nilai kolom untuk query SQL
    $columns = implode(", ", array_keys($answers));
    $values = implode(", ", array_values($answers));
    
    // Membuat query SQL untuk menyimpan data survey ke tabel survey_form
    $query = "INSERT INTO survey_form (id_user, created_at, $columns) VALUES ('$id_user', NOW(), $values)";
    
    // Menjalankan query SQL
    if (mysqli_query($connect, $query)) {
        echo "Data survey berhasil disimpan.";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($connect);
    }
} else {
    echo "Metode HTTP yang digunakan tidak valid.";
}
?>