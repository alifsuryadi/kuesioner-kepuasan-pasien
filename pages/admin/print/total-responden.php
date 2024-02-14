<?php
include_once("../../../validations/middleware-2.php");
include_once("../../../validations/connection.php");

try {
    // Query untuk mengambil data responden dari tabel users kecuali yang berperan sebagai admin
    $query = "SELECT u.*, s.* FROM users u LEFT JOIN survey_form f ON u.id_user = f.id_user 
              LEFT JOIN survey_results s ON f.id_form = s.id_form WHERE u.role != 'admin'";


    $result = mysqli_query($connect, $query);

    // Inisialisasi variabel nomor urut
    $nomor = 1;

    // Periksa apakah ada data yang ditemukan
    if (mysqli_num_rows($result) > 0 ) {
        echo '<!DOCTYPE html>
        <html lang="en">
          <head>
            <meta charset="UTF-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />
            <meta name="author" content="Lara" />
            <meta
              name="description"
              content="Web Kuesioner Penilaian Tingkat Kepuasan Pasien 
              RSUD Arosuka"
            />
            <meta
              name="keywords"
              content="keusioner, naive bayes, penilaian kepuasan"
            />
            <meta name="robots" content="index, follow" />
            <meta name="language" content="Indonesia" />
        
            <title>Hasil - Kuesioner</title>
        
            <link href="../../../assets/images/favicon/favicon.ico" rel="icon" />
            <link
              href="../../../assets/images/favicon/apple-touch-icon.png"
              rel="apple-touch-icon"
            />
        
            <link rel="stylesheet" href="../../../assets/styles/main.css" />
            <link
              href="../../../vendor/bootstrap-icons/bootstrap-icons.css"
              rel="stylesheet"
            />
            <link href="../../../vendor/aos/aos.css" rel="stylesheet" />
            <link
              href="../../../vendor/glightbox/css/glightbox.min.css"
              rel="stylesheet"
            />
          </head>
          <body>
            <main>
              <section id="print" class="print">
                <div class="content" data-aos="fade-up">
                  <h2 class="title">Total Responden Pasien di RSUD Arosuka</h2>
        
                  <div class="table-responsive">
                    <div class="form-group pull-right d-flex justify-content-end">
                      <input
                        type="text"
                        class="search form-control"
                        placeholder="Search"
                      />
                    </div>
                    <span class="counter pull-right"></span>
                    <table class="table table-hover table-bordered results">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th class="col-md-2 col-xs-2">Nama Lengkap</th>
                          <th class="col-md-1 col-xs-1">Pekerjaan</th>
                          <th class="col-md-1 col-xs-1">Umur</th>
                          <th class="col-md-1 col-xs-1">Jenis Kelamin</th>
                          <th class="col-md-3 col-xs-3">Alamat</th>
                          <th class="col-md-1 col-xs-1">Responsiveness</th>
                          <th class="col-md-1 col-xs-1">Empathy</th>
                          <th class="col-md-1 col-xs-1">Tangible</th>
                          <th class="col-md-1 col-xs-1">Kepuasan</th>
                        </tr>
                        <tr class="warning no-result text-center">
                          <td colspan="11" class="py-4">
                            <i class="fa fa-warning"></i> Tidak ada hasil yang ditemukan
                          </td>
                        </tr>
                      </thead>
                      <tbody>';
        
                      // Loop melalui setiap baris hasil
                      while ($row = mysqli_fetch_assoc($result)) {
                          echo '<tr>';
                          echo '<th scope="row">' . $nomor . '</th>';
                          echo '<td class="col-md-2 col-xs-2">' . $row['username'] . '</td>';
                          echo '<td class="col-md-1 col-xs-1">' . ($row['job'] ? $row['job'] : '-') . '</td>';
                          echo '<td class="col-md-1 col-xs-1">' . ($row['age'] ? $row['age'] : '-') . '</td>';
                          echo '<td class="col-md-1 col-xs-1">' . ($row['gender'] ? $row['gender'] : '-') . '</td>';
                          echo '<td class="col-md-3 col-xs-3">' . ($row['address'] ? $row['address'] : '-') . '</td>';
                          echo '<td class="col-md-1 col-xs-1">' . $row['responsiveness'] . '</td>';
                          echo '<td class="col-md-1 col-xs-1">' . $row['empathy'] . '</td>';
                          echo '<td class="col-md-1 col-xs-1">' . $row['tangible'] . '</td>';
                          echo '<td class="col-md-1 col-xs-1">' . $row['kepuasan'] . '</td>';
                          echo '</tr>';
                          $nomor++;
                      }
        
        echo '</tbody>
                </table>
              </div>
              <div class="row">
                <div class="col-12 d-flex justify-content-end">
                  <a href="../hasil-kuesioner.php" class="btn btn-primary"
                    >Kembali</a
                  >
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
        // Jika tidak ada hasil yang ditemukan, tampilkan pesan
        echo "Tidak ada data responden yang ditemukan.";
    }

    // Tutup koneksi ke database
    mysqli_close($connect);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>