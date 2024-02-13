<?php
include "./connection.php"; // Menghubungkan ke database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    // Memasukkan data ke tabel users
    if ($connect->query($sql_insert_user) === TRUE) {
        // Alihkan pengguna ke halaman lain
        header("Location: ../pages/kuesioner/cara-pengisian.php");
        exit();
    } else {
        // Jika terjadi kesalahan, tampilkan pesan kesalahan
        header("Location: ../pages/kuesioner/biodata.php");
        exit();
    }

    // Menutup koneksi database
    $connect->close();
}
?>