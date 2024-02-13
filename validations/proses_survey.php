<?php
include "./connection.php"; // Menghubungkan ke database


// Fuzzyfikasi untuk menentukan kepuasan berdasarkan nilai
$Reliability = 0;
$Responsiveness = 0;
$Assurance = 0;


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

    // Loop melalui data formulir untuk menghitung nilai kategori
    for ($i = 1; $i <= 30; $i++) {
        $question_key = 'Q' . $i;
        if (isset($_POST[$question_key])) {
            // Mengambil pertanyaan dari database untuk mendapatkan kategori
            $sql_question_category = "SELECT id_category FROM questions WHERE id_question = $i";
            $result = $connect->query($sql_question_category);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $category_id = $row['id_category'];
                // Menambahkan nilai jawaban ke kategori yang sesuai
                if ($category_id == 1) {
                    $Reliability += $_POST[$question_key];
                } elseif ($category_id == 2) {
                    $Responsiveness += $_POST[$question_key];
                } elseif ($category_id == 3) {
                    $Assurance += $_POST[$question_key];
                }
            }
        }
    }

    // Survey_form
    // Mengonversi array jawaban menjadi format yang sesuai untuk dimasukkan ke dalam database
    $answer_values = implode(', ', $answers);

    // Menyiapkan pernyataan SQL untuk memasukkan data kuesioner ke dalam tabel survey_form
    // Gunakan fungsi NOW() langsung dalam query SQL
    $sql_insert_survey = "INSERT INTO `survey_form` (`id_user`, `created_at`, `Q1`, `Q2`, `Q3`, `Q4`, `Q5`, `Q6`, `Q7`, `Q8`, `Q9`, `Q10`, 
                            `Q11`, `Q12`, `Q13`, `Q14`, `Q15`, `Q16`, `Q17`, `Q18`, `Q19`, `Q20`, 
                            `Q21`, `Q22`, `Q23`, `Q24`, `Q25`, `Q26`, `Q27`, `Q28`, `Q29`, `Q30`) 
                            VALUES ('$id_user', NOW(), $answer_values)";



    // Table survey_results
    //fuzzyfikasi---------------------------------------------------
    $Rel_tinggi=($Reliability-5)/(50-5);
    $Rel_rendah=(50-$Reliability)/(50-5);

    $Res_tinggi=($Responsiveness-5)/(50-5);
    $Res_rendah=(50-$Responsiveness)/(50-5);

    $As_tinggi=($Assurance-5)/(50-5);
    $As_rendah=(50-$Assurance)/(50-5);


    //Inference Engine---------------------------------------------
    //alfa prediket---------------------------------------------------
    $a1 = min($Rel_tinggi, $Res_tinggi, $As_tinggi); // Sangat Puas
    $z1 = 50 + ($a1 * (100 - 50));

    $a2 = min($Rel_tinggi, $Res_tinggi, $As_rendah); // Puas
    $z2 = 35 + ($a2 * (50 - 35));

    $a3 = min($Rel_tinggi, $Res_rendah, $As_tinggi); // Puas
    $z3 = 35 + ($a3 * (50 - 35));

    $a4 = min($Rel_rendah, $Res_tinggi, $As_tinggi); // Puas
    $z4 = 35 + ($a4 * (50 - 35));

    $a5 = min($Rel_tinggi, $Res_tinggi, $As_rendah); // Cukup Puas
    $z5 = 20 + ($a5 * (35 - 20));

    $a6 = min($Rel_tinggi, $Res_rendah, $As_rendah); // Cukup Puas
    $z6 = 20 + ($a6 * (35 - 20));

    $a7 = min($Rel_rendah, $Res_tinggi, $As_tinggi); // Cukup Puas
    $z7 = 20 + ($a7 * (35 - 20));

    $a8 = min($Rel_tinggi, $Res_rendah, $As_tinggi); // Cukup Puas
    $z8 = 20 + ($a8 * (35 - 20));

    $a9 = min($Rel_tinggi, $Res_rendah, $As_rendah); // Kecewa
    $z9 = 5 + ($a9 * (20 - 5));

    $a10 = min($Rel_rendah, $Res_rendah, $As_tinggi); // Kecewa
    $z10 = 5 + ($a10 * (20 - 5));

    $a11 = min($Rel_rendah, $Res_tinggi, $As_rendah); // Kecewa
    $z11 = 5 + ($a11 * (20 - 5));

    $a12 = min($Rel_tinggi, $Res_rendah, $As_rendah); // Kecewa
    $z12 = 5 + ($a12 * (20 - 5));


    // Defuzzyfication
    $z = (($a1 * $z1) + ($a2 * $z2) + ($a3 * $z3) + ($a4 * $z4) + ($a5 * $z5) + ($a6 * $z6) + ($a7 * $z7) + ($a8 * $z8) + ($a9 * $z9) + ($a10 * $z10) + ($a11 * $z11) + ($a12 * $z12)) / ($a1 + $a2 + $a3 + $a4 + $a5 + $a6 + $a7 + $a8 + $a9 + $a10 + $a11 + $a12);

    // Menentukan tingkat kepuasan berdasarkan nilai z
    if ($z >= 42.5) {
        $himKepuasan = "Sangat Puas";
    } else if ($z >= 27.5) {
        $himKepuasan = "Puas";
    } else if ($z >= 12.5) {
        $himKepuasan = "Cukup Puas";
    } else {
        $himKepuasan = "Kecewa";
    }



    // Menyiapkan pernyataan SQL untuk mendapatkan id_form terakhir
    $sql_get_last_id = "SELECT MAX(id_form) AS last_id FROM survey_form";
    $result_last_id = $connect->query($sql_get_last_id);
    $row_last_id = $result_last_id->fetch_assoc();
    $last_id = $row_last_id['last_id'];
    $next_id = $last_id + 1;

    // Menyiapkan pernyataan SQL untuk memasukkan data hasil survey ke dalam tabel survey_results
    $sql_insert_result = "INSERT INTO `survey_results` (`id_form`, `created_at`, `reliability`, `responsiveness`, `assurance`, `nilai_z`, `kepuasan`) 
                            VALUES ('$next_id', NOW(), '$Reliability', '$Responsiveness', '$Assurance', '$z', '$himKepuasan')";
                            
    // Memasukkan data kuesioner ke dalam tabel survey_form
    if ($connect->query($sql_insert_survey) === TRUE && $connect->query($sql_insert_result) === TRUE) {
        // Jika berhasil disimpan, alihkan pengguna ke halaman rangkuman
        header("Location: ../pages/kuesioner/terimakasih.php");
        exit();
    } else {
        // Jika terjadi kesalahan, tampilkan pesan kesalahan
        header("Location: ../pages/kuesioner/rangkuman.php");
        exit();
    }
}

// Menutup koneksi database
$connect->close();
?>