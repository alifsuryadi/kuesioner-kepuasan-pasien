<?php
include_once("../../../validations/middleware-2.php");
include_once("../../../validations/connection.php");

// Inisialisasi variabel data hasil pengujian
$hasil_pengujian = [];

try {
    // Periksa apakah ada parameter id_form yang dikirimkan dari URL
    if (isset($_GET['id_form'])) {
        // Ambil nilai id_form dari URL
        $id_form = $_GET['id_form'];

        // Lakukan kueri SQL untuk mengambil data hasil pengujian dari tabel survey_results berdasarkan id_form
        $query = "SELECT sr.*, sf.id_user
                  FROM survey_results sr
                  LEFT JOIN survey_form sf ON sr.id_form = sf.id_form
                  WHERE sr.id_form = $id_form";
        $result = mysqli_query($connect, $query);

        // hitung seluruh data
        $sql_total = "SELECT COUNT(*) AS total FROM survey_results";
        $result_total = mysqli_query($connect, $sql_total);
        $total_data = mysqli_fetch_assoc($result_total)["total"];

        // Perhitungan Responsiveness

        $query_puas_tidak_baik_r = "SELECT count(0) as jumlah from survey_results where c_responsiveness = 'Tidak Baik' and kepuasan = 'Puas'";
        $result_puas_tidak_baik_r = mysqli_query($connect, $query_puas_tidak_baik_r);
        $puas_tidak_baik_r = mysqli_fetch_assoc($result_puas_tidak_baik_r)["jumlah"];

        $query_t_puas_tidak_baik_r = "SELECT count(0) as jumlah from survey_results where c_responsiveness = 'Tidak Baik' and kepuasan = 'Tidak Puas'";
        $result_t_puas_tidak_baik_r = mysqli_query($connect, $query_t_puas_tidak_baik_r);
        $t_puas_tidak_baik_r = mysqli_fetch_assoc($result_t_puas_tidak_baik_r)["jumlah"];


        $query_puas_cukup_baik_r = "SELECT count(0) as jumlah from survey_results where c_responsiveness = 'Cukup Baik' and kepuasan = 'Puas'";
        $result_puas_cukup_baik_r = mysqli_query($connect, $query_puas_cukup_baik_r);
        $puas_cukup_baik_r = mysqli_fetch_assoc($result_puas_cukup_baik_r)["jumlah"];

        $query_t_puas_cukup_baik_r = "SELECT count(0) as jumlah from survey_results where c_responsiveness = 'Cukup Baik' and kepuasan = 'Tidak Puas'";
        $result_t_puas_cukup_baik_r = mysqli_query($connect, $query_t_puas_cukup_baik_r);
        $t_puas_cukup_baik_r = mysqli_fetch_assoc($result_t_puas_cukup_baik_r)["jumlah"];


        $query_puas_baik_r = "SELECT count(0) as jumlah from survey_results where c_responsiveness = 'Baik' and kepuasan = 'Puas'";
        $result_puas_baik_r = mysqli_query($connect, $query_puas_baik_r);
        $puas_baik_r = mysqli_fetch_assoc($result_puas_baik_r)["jumlah"];

        $query_t_puas_baik_r = "SELECT count(0) as jumlah from survey_results where c_responsiveness = 'Baik' and kepuasan = 'Tidak Puas'";
        $result_t_puas_baik_r = mysqli_query($connect, $query_t_puas_baik_r);
        $t_puas_baik_r = mysqli_fetch_assoc($result_t_puas_baik_r)["jumlah"];




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
} catch (Exception $e) {
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
        <section id="hasil-pengujian" class="hasil-pengujian">
            <div class="content" data-aos="fade-up" style="width: 100% !important;">
                <h2 class="title">Detail Perhitungan</h2>
                <div class="card" style="width: 100% !important;">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Tsukamoto</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Naïve Bayes</button>
                                    </li>
                                </ul>
                                <div class="tab-content" id="pills-tabContent">
                                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                        <p class="fst-italic">Penilaian ketanggapan (Responsiveness) terdiri dari TIDAK BAIK, CUKUP BAIK, dan BAIK.</p>
                                    </div>
                                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                        <p class="fs-5">Probabilitas Responsiveness</p>
                                        <p style="font-weight: bold;"> Rumus : P (C|X) = P(x|c)P(c)/P(x)</p>

                                        <p style="font-weight: bold;"><i>Puas</i></p>
                                        <p>P (Tidak Baik | Puas) = <?php echo $puas_tidak_baik_r ?>/<?php echo $total_data ?> = <?php echo $puas_tidak_baik_r / $total_data ?></p>
                                        <p>P (Cukup Baik | Puas) = <?php echo $puas_cukup_baik_r ?>/<?php echo $total_data ?> = <?php echo $puas_cukup_baik_r / $total_data ?></p>
                                        <p>P (Baik | Puas) = <?php echo $puas_baik_r ?>/<?php echo $total_data ?> = <?php echo $puas_baik_r / $total_data ?></p>
                                        <p style="font-weight: bold;"><i>Tidak Puas</i></p>
                                        <p>P (Tidak Baik | Tidak Puas) = <?php echo $t_puas_tidak_baik_r ?>/<?php echo $total_data ?> = <?php echo $t_puas_tidak_baik_r / $total_data ?></p>
                                        <p>P (Cukup Baik | Tidak Puas) = <?php echo $t_puas_cukup_baik_r ?>/<?php echo $total_data ?> = <?php echo $t_puas_cukup_baik_r / $total_data ?></p>
                                        <p>P (Baik | Tidak Puas) = <?php echo $t_puas_baik_r ?>/<?php echo $total_data ?> = <?php echo $t_puas_baik_r / $total_data ?></p>
                                        <hr>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <a href="./table-pengujian.php" class="btn btn-primary">Kembali</a>
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

</html>