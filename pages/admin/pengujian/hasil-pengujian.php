<?php
include_once("../../../validations/middleware-2.php");
include_once("../../../validations/connection.php");

// Inisialisasi variabel data hasil pengujian
$hasil_pengujian = [];

try {
    // Periksa apakah ada parameter id_form yang dikirimkan dari URL
    if(isset($_GET['id_form'])) {
        // Ambil nilai id_form dari URL
        $id_form = $_GET['id_form'];

        // Lakukan kueri SQL untuk mengambil data hasil pengujian dari tabel survey_results berdasarkan id_form
        $query = "SELECT sr.*, sf.id_user
                  FROM survey_results sr
                  LEFT JOIN survey_form sf ON sr.id_form = sf.id_form
                  WHERE sr.id_form = $id_form";
        $result = mysqli_query($connect, $query);

        // Periksa apakah hasil query berhasil
        if ($result) {
            // Ambil hasil query dan simpan dalam array
            while ($row = mysqli_fetch_assoc($result)) {
                $hasil_pengujian[] = $row;
            }
        } else {
            echo "Error: " . mysqli_error($connect);
        }

        // Ambil nama Lara dari tabel survey_results
        $nama_lara = "Unknown";
    } else {
        // Jika tidak ada id_form yang dikirimkan, berikan pesan kesalahan
        echo "Error: Parameter id_form tidak ditemukan dalam URL";
    }

} catch(Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="author" content="Lara" />
    <meta name="description" content="Web Kuesioner Penilaian Tingkat Kepuasan Pasien 
      RSUD Arosuka" />
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
        <?php
          if (!empty($hasil_pengujian)) {
              // Loop untuk setiap hasil pengujian
              foreach ($hasil_pengujian as $pengujian) {
                  // Ambil nama lengkap dari tabel users berdasarkan id_user
                  $id_user = $pengujian['id_user'];
                  $query = "SELECT username FROM users WHERE id_user = $id_user";
                  $result = mysqli_query($connect, $query);
                  $row = mysqli_fetch_assoc($result);
                  $nama_lengkap = $row['username'];

                  // Tampilkan hasil pengujian
                  echo '<section id="hasil-pengujian" class="hasil-pengujian">';
                  echo '<div class="content" data-aos="fade-up">';
                  echo '<h2 class="title">Detail Pengujian</h2>';
                  echo '<div class="card">';
                  echo '<div class="card-body">';
                  echo '<div class="row">';
                  echo '<div class="col-12">';
                  echo '<div class="card-title">' . ($nama_lengkap == $nama_lara ? $nama_lara : $nama_lengkap) . '</div>';
                  echo '<div class="card-subtitle">Input :</div>';
                  echo '<div class="card-text">';
                  echo '<div class="row">';
                  echo '<div class="col-9">Keandalan <span>(Reliability)</span></div>';
                  echo '<div class="col-3">: ' . $pengujian['reliability'] . '</div>';
                  echo '<div class="col-9">Daya Tanggap <span>(Responsiveness)</span></div>';
                  echo '<div class="col-3">: ' . $pengujian['responsiveness'] . '</div>';
                  echo '<div class="col-9">Jaminan <span>(Assurance)</span></div>';
                  echo '<div class="col-3">: ' . $pengujian['assurance'] . '</div>';
                  echo '</div>';
                  echo '</div>';
                  echo '<div class="card-subtitle">Output :</div>';
                  echo '<div class="card-text">';
                  echo '<div class="row">';
                  echo '<div class="col-8">Nilai Z</div>';
                  echo '<div class="col-4">: ' . $pengujian['nilai_z'] . '</div>';
                  echo '<div class="col-8">Kepuasan</div>';
                  echo '<div class="col-4">: ' . $pengujian['kepuasan'] . '</div>';
                  echo '</div>';
                  echo '</div>';
                  echo '</div>';
                  echo '</div>';
                  echo '</div>';
                  echo '<div class="row">';
                  echo '<div class="col-12 text-center">';
                  echo '<a href="./table-pengujian.php" class="btn btn-primary">Kembali</a>';
                  echo '</div>';
                  echo '</div>';
                  echo '</div>';
                  echo '</div>';
                  echo '</section>';
              }
          } else {
              // Jika tidak ada hasil pengujian, tampilkan pesan
              echo '<section id="hasil-pengujian" class="hasil-pengujian">';
              echo '<div class="content" data-aos="fade-up">';
              echo '<h2 class="title">Detail Pengujian</h2>';
              echo '<div class="card">';
              echo '<div class="card-body">';
              echo '<div class="row">';
              echo '<div class="col-12">';
              echo 'Data pengujian tidak ditemukan.';
              echo '</div>';
              echo '</div>';
              echo '<div class="row">';
              echo '<div class="col-12 text-center">';
              echo '<a href="./table-pengujian.php" class="btn btn-primary">Kembali</a>';
              echo '</div>';
              echo '</div>';
              echo '</div>';
              echo '</div>';
              echo '</section>';
          }

        // Tutup koneksi ke database
        mysqli_close($connect);
        ?>

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

</html>