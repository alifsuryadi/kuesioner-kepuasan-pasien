<?php
include "./connection.php"; // Menghubungkan ke database

// Fuzzyfikasi untuk menentukan kepuasan berdasarkan nilai
$Responsiveness = 0;
$Empathy = 0;
$Tangible = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Proses Biodata
    // Mengambil nilai yang dikirimkan dari formulir
    $email = isset($_POST["email"]) ? $_POST["email"] : null; 
    $gender = isset($_POST["gender"]) ? $_POST["gender"] : null;
    $job = isset($_POST["job"]) ? $_POST["job"] : null;
    $age = isset($_POST["age"]) ? $_POST["age"] : null;
    $address = isset($_POST["address"]) ? $_POST["address"] : null;
    $role = "user";

    // Buat username dari email jika email diisi, jika tidak, gunakan format "user" diikuti dengan ID pengguna
    $username = isset($_POST["username"]) ? $_POST["username"] : null;
    if (!$username) {
        // Jika username tidak diisi, buat username dengan format "user" diikuti dengan ID pengguna
        $sql_get_last_user_id = "SELECT id_user FROM users ORDER BY id_user DESC LIMIT 1";
        $result = $connect->query($sql_get_last_user_id);
        $new_user_id = ($result->num_rows > 0) ? $result->fetch_assoc()["id_user"] + 1 : 1;
        $username = "user" . $new_user_id;
    }

    // Menyiapkan pernyataan SQL untuk memasukkan data ke tabel users
    $sql_insert_user = "INSERT INTO `users` (`email`, `password`, `role`, `gender`, `job`, `age`, `address`, `username`) 
                        VALUES ('$email', '', '$role', '$gender', '$job', '$age', '$address', '$username')";
    

    // ---------------------------------------------------------------- //
    // Table Survey_form

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


        // ----------------------------------------------------------------//
    // Table Survey_results
    $responsiveness = [];
    $empathy = [];
    $tangible = [];
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
                    $responsiveness[] = $_POST[$question_key];
                }
                if ($category_id == 2) { 
                    $empathy[] = $_POST[$question_key];
                }
                if ($category_id == 3) {
                    $tangible[] = $_POST[$question_key];
                }
            }
        }
    }

    // Defuzzifikasi----------------------------------------------------
    // Rata-rata =  Total Q1-Q5 / Jumlah Data (5)
    $rata_responsiveness = array_sum($responsiveness) / count($responsiveness);
    $rata_empathy = array_sum($empathy) / count($empathy);
    $rata_tangible = array_sum($tangible) / count($tangible);


    //Fuzzyfikasi---------------------------------------------------
    //Responsiveness
    //Responsiveness tidak baik
	if($rata_responsiveness <= 33){
        $res_tidakBaik = 1;
      }
    else if($rata_responsiveness > 33 && $rata_responsiveness < 50){
        $res_tidakBaik = (50-$rata_responsiveness)/(50-33);
    }
    else if($rata_responsiveness >= 50){
        $res_tidakBaik = 0;
    }
    
    //Responsiveness Cukup Baik
    if($rata_responsiveness <= 33){
        $res_cukupBaik = 0;
    }
    else if($rata_responsiveness > 50 && $rata_responsiveness < 67){
        $res_cukupBaik = (67-$rata_responsiveness)/(67-50);
    }
    else if($rata_responsiveness == 50){
        $res_cukupBaik = 1;
    }
    else if($rata_responsiveness > 33 && $rata_responsiveness < 50){
        $res_cukupBaik = ($rata_responsiveness-33)/(50-33);
    }
    else if($rata_responsiveness >= 67){
        $res_cukupBaik = 0;
    }
    
    // Responsiveness baik
    if($rata_responsiveness <= 50){
    $res_baik = 0;
    }
    else if($rata_responsiveness > 50 && $rata_responsiveness < 67){
    $res_baik = ($rata_responsiveness-50)/(67-50);
    }
    else if($rata_responsiveness >= 67 && $rata_responsiveness <= 100){
    $res_baik = 1;
    }

    // Empathy
    //  Empathy tidak baik
    if($rata_empathy <= 33){
        $emp_tidakBaik = 1;
    }
    else if($rata_empathy > 33 && $rata_empathy < 50){
        $emp_tidakBaik = (50-$rata_empathy)/(50-33);
    }
    else if($rata_empathy>= 50){
        $emp_tidakBaik = 0;
    }

    //Empathy Cukup Baik
    if($rata_empathy <= 33){
        $emp_cukupBaik = 0;
    }
    else if($rata_empathy > 50 && $rata_empathy < 67){
        $emp_cukupBaik = (67-$rata_empathy)/(67-50);
    }
    else if($rata_empathy == 50){
        $emp_cukupBaik = 1;
    }
    else if($rata_empathy > 33 && $rata_empathy < 50){
        $emp_cukupBaik = ($rata_empathy-33)/(50-33);
    }
    else if($rata_empathy >= 67){
        $emp_cukupBaik = 0;
    }
    // Empathy baik
    if($rata_empathy <= 50){
        $emp_baik = 0;
    }
    else if($rata_empathy > 50 && $rata_empathy < 67){
        $emp_baik = ($rata_empathy-50)/(67-50);
    }
    else if($rata_empathy >= 67 && $rata_empathy <= 100){
        $emp_baik = 1;
    }


    //  Tangible
    // Tangible tidak baik
    if($rata_tangible <= 33){
        $tan_tidakBaik = 1;
    }
    else if($rata_tangible  > 33 && $rata_tangible  < 50){
        $tan_tidakBaik = (50-$rata_tangible )/(50-33);
    }
    else if($rata_tangible >= 50){
        $tan_tidakBaik = 0;
    }

    //  Tangible Cukup Baik
    if($rata_tangible  <= 33){
        $tan_cukupBaik = 0;
    }
    else if($rata_tangible  > 50 && $rata_tangible  < 67){
        $tan_cukupBaik= (67-$rata_tangible )/(67-50);
    }
    else if($rata_tangible == 50){
        $tan_cukupBaik = 1;
    }
    else if($rata_tangible  > 33 && $rata_tangible  < 50){
        $tan_cukupBaik= ($rata_tangible -33)/(50-33);
    }
    else if($rata_tangible  >= 67){
        $tan_cukupBaik = 0;
    }
    
    // Tangible baik
    if($rata_tangible  <= 50){
        $tan_baik = 0;
    }
    else if($rata_tangible  > 50 && $rata_tangible  < 67){
        $tan_baik= ($rata_tangible -50)/(67-50);
    }
    else if($rata_tangible  >= 67 && $rata_tangible  <= 100){
        $tan_baik = 1;
    }


    // Inferense-------------------------------------------------------------------
    // Menghitung nilai a-predikat
    $a1 = min($res_tidakBaik, $emp_tidakBaik, $tan_tidakBaik); // Tidak Puas
    $z1= 67 - ($a1 * (67 - 33));

    $a2 = min($res_tidakBaik, $emp_tidakBaik, $tan_cukupBaik); // Tidak Puas
    $z2 = 67 - ($a2 * (67 - 33));

    $a3 = min($res_tidakBaik, $emp_tidakBaik, $tan_baik); // Tidak Puas
    $z3 = 67 - ($a3 * (67 - 33));

    $a4 = min($res_tidakBaik, $emp_cukupBaik, $tan_tidakBaik); // Tidak Puas
    $z4= 67 - ($a4 * (67 - 33));
  
    $a5 = min($res_tidakBaik, $emp_cukupBaik, $tan_cukupBaik); // Tidak Puas
    $z5= 67 - ($a5 * (67 - 33));
 
    $a6 = min($res_tidakBaik, $emp_cukupBaik, $tan_baik); // Puas
    $z6 = 33 + ($a6 * (67 - 33));
   
    $a7 = min($res_tidakBaik, $emp_baik, $tan_tidakBaik); // Tidak Puas
    $z7 = 67 - ($a7 * (67 - 33));

    $a8 = min($res_tidakBaik, $emp_baik, $tan_cukupBaik); // Puas
    $z8 = 33 + ($a8 * (67 - 33));
    
    $a9 = min($res_tidakBaik, $emp_baik, $tan_baik); // Puas
    $z9 = 33 + ($a9 * (67 - 33));
    
    $a10 = min($res_cukupBaik, $emp_tidakBaik, $tan_tidakBaik); // Tidak Puas
    $z10 = 67 - ($a10 * (67 - 33));

    $a11 = min($res_cukupBaik, $emp_tidakBaik, $tan_cukupBaik); // Tidak Puas
    $z11 = 67 - ($a11 * (67 - 33));

    $a12 = min($res_cukupBaik, $emp_tidakBaik, $tan_baik); // Tidak Puas
    $z12 = 67 - ($a12 * (67 - 33));

    $a13 = min($res_cukupBaik, $emp_cukupBaik, $tan_tidakBaik); // Puas
    $z13 = 33 + ($a13 * (67 - 33));

    $a14 = min($res_cukupBaik, $emp_cukupBaik, $tan_cukupBaik); // Puas
    $z14 = 33 + ($a14 * (67 - 33));

    $a15 = min($res_cukupBaik, $emp_cukupBaik, $tan_baik); // Puas
    $z15 = 33 + ($a15 * (67 - 33));

    $a16 = min($res_cukupBaik, $emp_baik, $tan_tidakBaik); // Puas
    $z16 = 33 + ($a16 * (67 - 33));

    $a17 = min($res_cukupBaik, $emp_baik, $tan_cukupBaik); // Puas
    $z17 = 33 + ($a17 * (67 - 33));

    $a18 = min($res_cukupBaik, $emp_baik, $tan_baik); // Puas
    $z18 = 33 + ($a18 * (67 - 33));

    $a19 = min($res_baik, $emp_tidakBaik, $tan_tidakBaik); // Tidak Puas
    $z19 = 67 - ($a19 * (67 - 33));

    $a20 = min($res_baik, $emp_tidakBaik, $tan_cukupBaik); // Puas
    $z20 = 33 + ($a20 * (67 - 33));

    $a21 = min($res_baik, $emp_tidakBaik, $tan_baik); // Puas
    $z21 = 33 + ($a21 * (67 - 33));

    $a22 = min($res_baik, $emp_cukupBaik, $tan_tidakBaik); // Puas
    $z22 = 33 + ($a22 * (67 - 33));

    $a23 = min($res_baik, $emp_cukupBaik, $tan_cukupBaik); // Puas
    $z23 = 33 + ($a23 * (67 - 33));

    $a24 = min($res_baik, $emp_cukupBaik, $tan_baik); // Puas
    $z24 = 33 + ($a24 * (67 - 33));

    $a25 = min($res_baik, $emp_baik, $tan_tidakBaik); // Puas
    $z25 = 33 + ($a25 * (67 - 33));

    $a26 = min($res_baik, $emp_baik, $tan_cukupBaik); // Puas
    $z26 = 33 + ($a26 * (67 - 33));

    $a27 = min($res_baik, $emp_baik, $tan_baik); // Puas
    $z27 = 33 + ($a27 * (67 - 33));

    $nilai_z = (($a1 * $z1) + ($a2 * $z2) + ($a3 * $z3) + ($a4 * $z4) + ($a5 * $z5) + ($a6 * $z6) + ($a7 * $z7) + ($a8 * $z8) + ($a9 * $z9) + ($a10 * $z10) + ($a11 * $z11) + ($a12 * $z12) + ($a13 * $z13) + ($a14 * $z14) + ($a15 * $z15) + ($a16 * $z16) + ($a17 * $z17) + ($a18 * $z18) + ($a19 * $z19) + ($a20 * $z20) + ($a21 * $z21) + ($a22 * $z22) + ($a23 * $z23) + ($a24 * $z24) + ($a25 * $z25) + ($a26 * $z26) + ($a27 * $z27)) / ($a1 + $a2 + $a3 + $a4 + $a5 + $a6 + $a7 + $a8 + $a9 + $a10 + $a11 + $a12 + $a13 + $a14 + $a15 + $a16 + $a17 + $a18 + $a19 + $a20 + $a21 + $a22 + $a23 + $a24 + $a25 + $a26 + $a27);
    $hasil_z = number_format($nilai_z, 2);

    if ($hasil_z >= 42.5) {
        $kepuasan = "Puas";
    } else {
        $kepuasan = "Tidak Puas";
    }
    

    // Menyiapkan pernyataan SQL untuk mendapatkan id_form terakhir
    $sql_get_last_id = "SELECT MAX(id_form) AS last_id FROM survey_form";
    $result_last_id = $connect->query($sql_get_last_id);
    $row_last_id = $result_last_id->fetch_assoc();
    $last_id = $row_last_id['last_id'];
    $next_id = $last_id + 1;


    // Menyiapkan pernyataan SQL untuk memasukkan data hasil survey ke dalam tabel survey_results
    $sql_insert_result = "INSERT INTO `survey_results` (`id_form`, `created_at`, `responsiveness`, `empathy`, `tangible`, `nilai_z`, `kepuasan`) 
                            VALUES ('$next_id', NOW(), '$rata_responsiveness', '$rata_empathy', '$rata_tangible', '$hasil_z', '$kepuasan')";
         
    // Memasukkan data kuesioner ke dalam tabel survey_form
    if ($connect->query($sql_insert_user) === TRUE && $connect->query($sql_insert_survey) === TRUE && $connect->query($sql_insert_result) === TRUE ) {
        // Jika berhasil disimpan, alihkan pengguna ke halaman rangkuman
        header("Location: ../pages/kuesioner/hasil-pengujian.php?id_form=$next_id");
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