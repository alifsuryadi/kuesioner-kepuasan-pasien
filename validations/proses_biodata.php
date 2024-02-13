<?php
// Include file koneksi ke database
include "./connection.php";

// Cek apakah form biodata sudah di-submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Menampilkan data yang dikirimkan melalui form

    // Tangkap data yang dikirimkan melalui form
    $email = $_POST['email'];
    $username = isset($_POST['username']) ? $_POST['username'] : "user"; // Jika tidak ada username, defaultnya adalah "user"
    $gender = $_POST['gender'];
    $job = $_POST['job'];
    $age = $_POST['age']; // Kolom di database adalah "age", bukan "age"
    $address = $_POST['address']; // Perbaikan: Ganti dari $addresss menjadi $address

    // Tentukan role default jika tidak disertakan dalam form
    $defaultRole = "user";

    // Query untuk menyimpan data ke database
    $query = "INSERT INTO users (username, email, role, gender, job, age, address) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $connect->prepare($query);

    // Bind parameter ke statement
    $stmt->bind_param("ssssiss", $username, $email, $defaultRole, $gender, $job, $age, $address);

    // Eksekusi query
    if ($stmt->execute()) {
        // Redirect ke halaman cara pengisian jika penyimpanan berhasil
        header("Location: ../pages/kuesioner/cara-pengisian.php");
        exit; // Pastikan untuk keluar dari skrip setelah melakukan redirect
    } else {
        echo "Terjadi kesalahan: " . $stmt->error;
    }

    // Tutup statement dan koneksi ke database
    $stmt->close();
    $connect->close();
}
?>