<?php
include_once("../../../validations/middleware-2.php");
include_once("../../../validations/connection.php");

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
                <h2 class="title">Pengujian Puas / Tidak Puas Pasien di RSUD Arosuka</h2>

                <div class="table-responsive">
                    <div class="form-group pull-right d-flex justify-content-end">
                        <input type="text" class="search form-control" placeholder="Search" />
                    </div>
                    <span class="counter pull-right"></span>
                    <table class="table table-hover table-bordered results">
                        <thead>
                            <tr>
                                <th rowspan="2">#</th>
                                <th rowspan="2" class="col-md-1 col-xs-1">Tanggal</th>
                                <th rowspan="2" class="col-md-1 col-xs-1">Nama Lengkap</th>
                                <th colspan="<?php echo $total_questions; ?>" class="col-md-8 col-xs-8">Pertanyaan</th>
                                <th rowspan="2" class="col-md-1 col-xs-1">Kepuasan</th>
                                <th rowspan="2" class="col-md-1 col-xs-1">Aksi</th>
                            </tr>
                            <tr>
                                <?php
                                // Output nomor pertanyaan
                                for ($i = 1; $i <= $total_questions; $i++) {
                                    echo '<th>' . $i . '</th>';
                                }
                                ?>
                            </tr>

                            <tr class="warning no-result text-center">
                                <td colspan="<?php echo $total_questions + 5; ?>" class="py-4">
                                    <i class="fa fa-warning">Tidak ada hasil yang ditemukan</i>
                                </td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                             // Output data
                             $total_data = count($data_survey_form);
                             for ($key = 0; $key < $total_data - 1; $key++) {
                                 $survey_form = $data_survey_form[$key];
                                echo '<tr>';
                                echo '<td>' . ($key + 1) . '</td>';
                                echo '<td class="col-md-1 col-xs-1">' . (isset($survey_form['tanggal']) ? $survey_form['tanggal'] : '') . '</td>';
                                echo '<td class="col-md-1 col-xs-1">' . (isset($survey_form['nama_lengkap']) ? $survey_form['nama_lengkap'] : '') . '</td>';


                                    // Tampilkan nilai pertanyaan
                                  for ($i = 1; $i <= $total_questions; $i++) {
                                      $question_key = 'Q' . $i;
                                      // Periksa apakah pertanyaan ada dalam data
                                      if (isset($survey_form[$question_key])) {
                                          echo '<td>' . $survey_form[$question_key] . '</td>';
                                      } else {
                                          // Jika pertanyaan tidak ada, tambahkan kolom default dengan nilai "-"
                                          echo '<td>-</td>';
                                      }
                                  }


                                echo '<td class="col-md-1 col-xs-1">' . (isset($survey_form['Kepuasan']) ? $survey_form['Kepuasan'] : '') . '</td>';
                                
                                echo '<td class="col-md-1 col-xs-1 aksi"><a href="./hasil-pengujian.php?id_form=' . $survey_form['id_form'] . '" class="btn btn-uji">Detail</a></td>';

                                echo '</tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-12 d-flex justify-content-end">
                        <a href="../pengujian.php" class="btn btn-primary">Kembali</a>
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

</html>