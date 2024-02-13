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


    // Table Survey_results
    $countResponsiveness = 0;
    $countEmpathy = 0;
    $countTangible = 0;

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
                    $countResponsiveness++;
                    $Responsiveness += $_POST[$question_key];
                } elseif ($category_id == 2) {
                    $countEmpathy++;
                    $Empathy += $_POST[$question_key];
                } elseif ($category_id == 3) {
                    $countTangible++;
                    $Tangible += $_POST[$question_key];
                }
            }
        }
    }

    // ----------------------------------------------------------------//
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

    // Defuzzifikasi
    // Rata-rata =  Total / Jumlah Data
    $RataResponsiveness = $Responsiveness / $countResponsiveness;
    $RataEmpathy = $Empathy / $countEmpathy;
    $RataTangible = $Tangible / $countTangible;


    // Fuzzyfikasi
    $hasilResponsiveness = "";
    if ($RataResponsiveness >= 70){
          $hasilResponsiveness = "Baik";
    }else if ($RataResponsiveness >= 40){
         $hasilResponsiveness = "Cukup Baik";
    }else{
         $hasilResponsiveness = "Tidak Baik";
    }

    $hasilEmpathy = "";
    if ($RataEmpathy >= 70){
          $hasilEmpathy = "Baik";
    }else if ($RataEmpathy >= 70){
         $hasilEmpathy = "Cukup Baik";
    }else{
         $hasilEmpathy = "Tidak Baik";
    }

    $hasilTangible = "";
    if ($RataTangible >= 70){
          $hasilTangible = "Baik";
    }else if ($RataTangible >= 40){
         $hasilTangible = "Cukup Baik";
    }else{
         $hasilTangible = "Tidak Baik";
    }


    // Inferense
    $kepuasan = "";
    if ($hasilResponsiveness == "Tidak Baik" && $hasilEmpathy == "Tidak Baik" && $hasilTangible == "Tidak Baik" ){
        $kepuasan = "Tidak Puas";
    }
    else if ($hasilResponsiveness == "Tidak Baik" && $hasilEmpathy == "Tidak Baik" && $hasilTangible == "Cukup Baik" ){
        $kepuasan = "Tidak Puas";
    }
    else if ($hasilResponsiveness == "Tidak Baik" && $hasilEmpathy == "Tidak Baik" && $hasilTangible == "Baik" ){
        $kepuasan = "Tidak Puas";
    }
    else if ($hasilResponsiveness == "Tidak Baik" && $hasilEmpathy == "Cukup Baik" && $hasilTangible == "Tidak Baik" ){
        $kepuasan = "Tidak Puas";
    }
    else if ($hasilResponsiveness == "Tidak Baik" && $hasilEmpathy == "Cukup Baik" && $hasilTangible == "Cukup Baik" ){
        $kepuasan = "Tidak Puas";
    }
    else if ($hasilResponsiveness == "Tidak Baik" && $hasilEmpathy == "Cukup Baik" && $hasilTangible == "Baik" ){
        $kepuasan = "Tidak Puas";
    }
    else if ($hasilResponsiveness == "Tidak Baik" && $hasilEmpathy == "Baik" && $hasilTangible == "Tidak Baik" ){
        $kepuasan = "Tidak Puas";
    }
    else if ($hasilResponsiveness == "Tidak Baik" && $hasilEmpathy == "Baik" && $hasilTangible == "Cukup Baik" ){
        $kepuasan = "Tidak Puas";
    }
    else if ($hasilResponsiveness == "Tidak Baik" && $hasilEmpathy == "Baik" && $hasilTangible == "Baik" ){
        $kepuasan = "Tidak Puas";
    }
    else if ($hasilResponsiveness == "Cukup Baik" && $hasilEmpathy == "Tidak Baik" && $hasilTangible == "Tidak Baik" ){
        $kepuasan = "Tidak Puas";
    }
    else if ($hasilResponsiveness == "Cukup Baik" && $hasilEmpathy == "Tidak Baik" && $hasilTangible == "Cukup Baik" ){
        $kepuasan = "Puas";
    }
    else if ($hasilResponsiveness == "Cukup Baik" && $hasilEmpathy == "Tidak Baik" && $hasilTangible == "Baik" ){
        $kepuasan = "Puas";
    }
    else if ($hasilResponsiveness == "Cukup Baik" && $hasilEmpathy == "Cukup Baik" && $hasilTangible == "Tidak Baik" ){
        $kepuasan = "Tidak Puas";
    }
    else if ($hasilResponsiveness == "Cukup Baik" && $hasilEmpathy == "Cukup Baik" && $hasilTangible == "Cukup Baik" ){
        $kepuasan = "Puas";
    }
    else if ($hasilResponsiveness == "Cukup Baik" && $hasilEmpathy == "Cukup Baik" && $hasilTangible == "Baik" ){
        $kepuasan = "Puas";
    }
    else if ($hasilResponsiveness == "Cukup Baik" && $hasilEmpathy == "Baik" && $hasilTangible == "Tidak Baik" ){
        $kepuasan = "Tidak Puas";
    }
    else if ($hasilResponsiveness == "Cukup Baik" && $hasilEmpathy == "Baik" && $hasilTangible == "Cukup Baik" ){
        $kepuasan = "Puas";
    }
    else if ($hasilResponsiveness == "Cukup Baik" && $hasilEmpathy == "Baik" && $hasilTangible == "Baik" ){
        $kepuasan = "Puas";
    }
    else if ($hasilResponsiveness == "Baik" && $hasilEmpathy == "Baik" && $hasilTangible == "Tidak Baik" ){
        $kepuasan = "Tidak Puas";
    }
    else if ($hasilResponsiveness == "Baik" && $hasilEmpathy == "Tidak Baik" && $hasilTangible == "Tidak Baik" ){
        $kepuasan = "Tidak Puas";
    }
    else if ($hasilResponsiveness == "Baik" && $hasilEmpathy == "Tidak Baik" && $hasilTangible == "Cukup Baik" ){
        $kepuasan = "Puas";
    }
    else if ($hasilResponsiveness == "Baik" && $hasilEmpathy == "Tidak Baik" && $hasilTangible == "Baik" ){
        $kepuasan = "Puas";
    }
    else if ($hasilResponsiveness == "Baik" && $hasilEmpathy == "Cukup Baik" && $hasilTangible == "Cukup Baik" ){
        $kepuasan = "Puas";
    }
    else if ($hasilResponsiveness == "Baik" && $hasilEmpathy == "Cukup Baik" && $hasilTangible == "Baik" ){
        $kepuasan = "Puas";
    }
    else if ($hasilResponsiveness == "Baik" && $hasilEmpathy == "Cukup Baik" && $hasilTangible == "Tidak Baik" ){
        $kepuasan = "Tidak Puas";
    }
    else if ($hasilResponsiveness == "Baik" && $hasilEmpathy == "Baik" && $hasilTangible == "Cukup Baik" ){
        $kepuasan = "Puas";
    }
    else if ($hasilResponsiveness == "Baik" && $hasilEmpathy == "Baik" && $hasilTangible == "Baik" ){
        $kepuasan = "Puas";
    }
    else{
        $kepuasan = "Ada inputan yang salah";
    }

    
    //Alfa prediket--------------------------------------------------
    $alfa = min($RataResponsiveness, $RataEmpathy, $RataTangible);
    $alfaSederhana = $alfa / 100;

    $nilai_z = 0;
    if ($kepuasan == "Puas"){
        $nilai_z = 33+($alfaSederhana*(67-33));  //puas
    }
    else if ($kepuasan == "Tidak Puas"){
        $nilai_z = 67-($alfaSederhana*(67-33));  //tidak puas
    }
    else{
        $nilai_z = 0;
    }


    // Menyiapkan pernyataan SQL untuk mendapatkan id_form terakhir
    $sql_get_last_id = "SELECT MAX(id_form) AS last_id FROM survey_form";
    $result_last_id = $connect->query($sql_get_last_id);
    $row_last_id = $result_last_id->fetch_assoc();
    $last_id = $row_last_id['last_id'];
    $next_id = $last_id + 1;

    // Menyiapkan pernyataan SQL untuk memasukkan data hasil survey ke dalam tabel survey_results
    $sql_insert_result = "INSERT INTO `survey_results` (`id_form`, `created_at`, `responsiveness`, `empathy`, `tangible`, `nilai_z`, `kepuasan`) 
                            VALUES ('$next_id', NOW(), '$RataResponsiveness', '$RataEmpathy', '$RataTangible', '$nilai_z', '$kepuasan')";
         
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