<?php
include "./connection.php"; // Menghubungkan ke database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil nilai yang dikirimkan dari formulir
    $email = isset($_POST["email"]) ? $_POST["email"] : null; 
    $gender = isset($_POST["gender"]) ? $_POST["gender"] : null; // Jika gender tidak diisi, jadikan null
    $job = isset($_POST["job"]) ? $_POST["job"] : null; // Jika job tidak diisi, jadikan null
    $age = isset($_POST["age"]) ? $_POST["age"] : null; // Jika age tidak diisi, jadikan null
    $address = isset($_POST["address"]) ? $_POST["address"] : null; // Jika address tidak diisi, jadikan null
    $role = "user"; // Set role ke "user"

    // Menyiapkan pernyataan SQL untuk memasukkan data ke tabel users
    $sql_insert_user = "INSERT INTO `users` (`email`, `password`, `role`, `gender`, `job`, `age`, `address`) 
                        VALUES ('$email', '', '$role', '$gender', '$job', '$age', '$address')";

    // Memasukkan data ke tabel users
    if ($connect->query($sql_insert_user) === TRUE) {
        // Jika berhasil disimpan, ambil ID pengguna yang baru saja disimpan
        $new_user_id = $connect->insert_id;

        // Buat username dengan format "user" diikuti dengan ID pengguna
        $username = "user" . $new_user_id;

        // Perbarui kolom username dalam tabel dengan username baru
        $sql_update_username = "UPDATE `users` SET `username`='$username' WHERE `id_user`='$new_user_id'";
        $connect->query($sql_update_username);

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