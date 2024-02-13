<?php
include "./connection.php"; // Menghubungkan ke database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil nilai yang dikirimkan dari formulir
    $id_user = $_POST["id_user"];

    // Inisialisasi array untuk menyimpan nilai jawaban
    $answers = [];

    // Menyimpan jawaban dari formulir ke dalam array
    for ($i = 1; $i <= 30; $i++) {
        $question_key = 'Q' . $i;
        if (isset($_POST[$question_key])) {
            $answers[] = $_POST[$question_key]; // Menyimpan nilai jawaban ke dalam array
        } else {
            $answers[] = 'NULL'; // Isi jawaban dengan NULL jika tidak ditemukan
        }
    }

    // Mengonversi array jawaban menjadi format yang sesuai untuk dimasukkan ke dalam database
    $answer_values = implode(', ', $answers);

    // Menyiapkan pernyataan SQL untuk memasukkan data kuesioner ke dalam tabel survey_form
    // Gunakan fungsi NOW() langsung dalam query SQL
    $sql_insert_survey = "INSERT INTO `survey_form` (`id_user`, `created_at`, `Q1`, `Q2`, `Q3`, `Q4`, `Q5`, `Q6`, `Q7`, `Q8`, `Q9`, `Q10`, 
                            `Q11`, `Q12`, `Q13`, `Q14`, `Q15`, `Q16`, `Q17`, `Q18`, `Q19`, `Q20`, 
                            `Q21`, `Q22`, `Q23`, `Q24`, `Q25`, `Q26`, `Q27`, `Q28`, `Q29`, `Q30`) 
                            VALUES ('$id_user', NOW(), $answer_values)";

    // Memasukkan data kuesioner ke dalam tabel survey_form
    if ($connect->query($sql_insert_survey) === TRUE) {
        // Jika berhasil disimpan, alihkan pengguna ke halaman rangkuman
        header("Location: ../pages/kuesioner/rangkuman.php");
        exit();
    } else {
        // Jika terjadi kesalahan, tampilkan pesan kesalahan
        header("Location: ../pages/kuesioner/pertanyaan.php");
        exit();
    }
}

// Menutup koneksi database
$connect->close();
?>