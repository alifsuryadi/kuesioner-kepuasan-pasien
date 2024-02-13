<?php
// Include file koneksi
include_once("../../../validations/middleware-2.php");
include "../../../validations/connection.php";

try {
    // Query untuk mengambil data responden terdaftar
    $sql = "SELECT * FROM users WHERE email IS NOT NULL AND email <> '' AND role <> 'admin'";
    $result = mysqli_query($connect, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        // Tampilkan data dalam tabel HTML
        echo '<!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8" />
                    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
                    <meta name="author" content="Lara" />
                    <meta name="description" content="Web Kuesioner Penilaian Tingkat Kepuasan Pasien RSUD Arosuka" />
                    <meta name="keywords" content="keusioner, naive bayes, penilaian kepuasan" />
                    <meta name="robots" content="index, follow" />
                    <meta name="language" content="Indonesia" />
                    <title>Hasil - Kuesioner</title>
                    <link href="../../../assets/images/favicon/favicon.ico" rel="icon" />
                    <link href="../../../assets/images/favicon/apple-touch-icon.png" rel="apple-touch-icon" />
                    <link rel="stylesheet" href="../../../assets/styles/main.css" />
                    <link href="../../../vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet" />
                    <link href="../../../vendor/aos/aos.css" rel="stylesheet" />
                    <link href="../../../vendor/glightbox/css/glightbox.min.css" rel="stylesheet" />
                </head>
                <body>
                    <main>
                        <section id="print" class="print">
                            <div class="content" data-aos="fade-up">
                                <h2 class="title">Total Responden Pasien Terdaftar di RSUD Arosuka</h2>
                                <div class="table-responsive">
                                    <table class="table table-hover table-bordered results">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th class="col-md-2 col-xs-2">Nama Lengkap</th>
                                                <th class="col-md-2 col-xs-2">Email</th>
                                                <th class="col-md-2 col-xs-2">Pekerjaan</th>
                                                <th class="col-md-1 col-xs-1">Umur</th>
                                                <th class="col-md-1 col-xs-1">Jenis Kelamin</th>
                                                <th class="col-md-4 col-xs-4">Alamat</th>
                                            </tr>
                                            <tr class="warning no-result">
                                                <td colspan="4"><i class="fa fa-warning"></i> Tidak ada hasil yang ditemukan</td>
                                            </tr>
                                        </thead>
                                        <tbody>';
        $counter = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<th scope="row">' . $counter . '</th>';
            echo '<td class="col-md-2 col-xs-2">' . ($row['username'] ? $row['username'] : '-') . '</td>';
            echo '<td class="col-md-2 col-xs-2">' . $row['email'] . '</td>';
            echo '<td class="col-md-2 col-xs-2">' . ($row['job'] ? $row['job'] : '-') . '</td>';
            echo '<td class="col-md-1 col-xs-1">' . ($row['age'] ? $row['age'] : '-') . '</td>';
            echo '<td class="col-md-1 col-xs-1">' . ($row['gender'] ? $row['gender'] : '-') . '</td>';
            echo '<td class="col-md-4 col-xs-4">' . ($row['address'] ? $row['address'] : '-') . '</td>';
            echo '</tr>';
            $counter++;
        }
        echo '</tbody>
                </table>
            </div>
            <div class="row">
                <div class="col-12 d-flex justify-content-end">
                    <a href="../hasil-kuesioner.php" class="btn btn-primary">Kembali</a>
                    <a href="" class="btn btn-secondary" id="cetak">Cetak</a>
                </div>
            </div>
        </div>
    </section>
</main>
<!-- Vendor JS Files -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="../../../vendor/bootstrap-5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="../../../vendor/aos/aos.js"></script>
<script src="../../../vendor/glightbox/js/glightbox.min.js"></script>
<script src="../../../vendor/purecounter/purecounter_vanilla.js"></script>
<script src="../../../assets/scripts/main.js"></script>
<script src="../../../assets/scripts/table.js"></script>
</body>
</html>';
    } else {
        echo '<p>Tidak ada responden terdaftar.</p>';
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>