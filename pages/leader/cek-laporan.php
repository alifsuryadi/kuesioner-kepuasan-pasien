<?php
include_once("../../validations/middleware-2.php");
include_once("../../validations/connection.php");

// Lakukan pengambilan data dari database menggunakan koneksi yang sudah disertakan
$data_survey_form = [];
try {
    // Lakukan kueri SQL untuk mengambil data dari tabel survey_form dan nama lengkap dari tabel users
    $query = "SELECT sf.*, sr.Kepuasan, u.username AS nama_lengkap
              FROM survey_form sf
              LEFT JOIN users u ON sf.id_user = u.id_user
              LEFT JOIN survey_results sr ON sf.id_form = sr.id_form";

    $result = mysqli_query($connect, $query);

    // Periksa apakah hasil query berhasil
    if ($result) {
        // Ambil hasil query dan simpan dalam array
        while ($row = mysqli_fetch_assoc($result)) {
            $data_survey_form[] = $row;
        }
    } else {
        echo "Error: " . mysqli_error($connect);
    }

} catch(Exception $e) {
    echo "Error: " . $e->getMessage();
}

// Pastikan data_survey_form sudah diinisialisasi sebelum digunakan
if (!empty($data_survey_form)) {
    foreach ($data_survey_form as &$survey_form) {
        $timestamp = strtotime($survey_form['created_at']);
        $survey_form['tanggal'] = date('d-m-Y', $timestamp);
        // Hapus kolom created_at
        unset($survey_form['created_at']);
    }
}

// Hitung jumlah kategori dari tabel questions
$query = "SELECT COUNT(*) as total FROM questions";
$result = mysqli_query($connect, $query);
$row = mysqli_fetch_assoc($result);
$total_questions = $row['total'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="author" content="Lara" />
    <meta name="description" content="Web Kuesioner Penilaian Tingkat Kepuasan Pasien RSUD Arosuka" />
    <meta name="keywords" content="kuesioner, naive bayes, penilaian kepuasan" />
    <meta name="robots" content="index, follow" />
    <meta name="language" content="Indonesia" />

    <title>Hasil - Kuesioner</title>

    <link href="../../assets/images/favicon/favicon.ico" rel="icon" />
    <link href="../../assets/images/favicon/apple-touch-icon.png" rel="apple-touch-icon" />

    <link rel="stylesheet" href="../../assets/styles/main.css" />
    <link href="../../vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet" />
    <link href="../../vendor/aos/aos.css" rel="stylesheet" />
    <link href="../../vendor/glightbox/css/glightbox.min.css" rel="stylesheet" />
</head>

<body>
    <main>Belum ada</main>

    <!-- Vendor JS Files -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="../../vendor/bootstrap-5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../vendor/aos/aos.js"></script>
    <script src="../../vendor/glightbox/js/glightbox.min.js"></script>
    <script src="../../vendor/purecounter/purecounter_vanilla.js"></script>

    <script src="../../assets/scripts/main.js"></script>
    <script src="../../assets/scripts/table.js"></script>
</body>

</html>