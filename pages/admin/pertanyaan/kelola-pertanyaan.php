<?php
// Include file koneksi
include_once("../../../validations/middleware-2.php");
include "../../../validations/connection.php";

// Query untuk mengambil pertanyaan dan kategori dari tabel questions dan categories
$sql = "SELECT q.id_question, q.question, c.category
        FROM questions q
        INNER JOIN categories c ON q.id_category = c.id_category
        WHERE q.deleted_at IS NULL"; // Filter pertanyaan yang belum dihapus
$result = mysqli_query($connect, $sql);

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

    <title>Pertanyaan - Kuesioner</title>

    <link href="../../../assets/images/favicon/favicon.ico" rel="icon" />
    <link href="../../../assets/images/favicon/apple-touch-icon.png" rel="apple-touch-icon" />

    <link rel="stylesheet" href="../../../assets/styles/main.css" />
    <link href="../../../vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet" />
    <link href="../../../vendor/aos/aos.css" rel="stylesheet" />
    <link href="../../../vendor/glightbox/css/glightbox.min.css" rel="stylesheet" />
</head>

<body>
    <main>
        <section id="kelola-pertanyaan" class="kelola-pertanyaan">
            <div class="container">
                <!-- Content -->

                <div class="card">
                    <div class="card-body">
                        <div class="content">
                            <h3 class="card-title">Daftar Pertanyaan</h3>
                            <p class="card-subtitle">
                                Silahkan Periksa Pertanyaan Di bawah Ini
                            </p>
                            <a href="./tambah-pertanyaan.php" class="btn btn-primary">
                                Tambah Pertanyaan
                            </a>
                            <div class="question-container mt-4">
                                <div class="table-responsive">
                                    <span class="counter pull-right"></span>
                                    <table class="table table-hover table-bordered results">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th class="col-md-8 col-xs-8">Pertanyaan</th>
                                                <th class="col-md-2 col-xs-2">Kategori</th>
                                                <th class="col-md-2 col-xs-2">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (mysqli_num_rows($result) > 0) {
                                                $counter = 1;
                                                while ($row = mysqli_fetch_assoc($result)) {
                                            ?>
                                            <tr>
                                                <th scope="row"><?php echo $counter++; ?></th>
                                                <td class="col-md-8 col-xs-8"><?php echo $row['question']; ?></td>
                                                <td class="col-md-2 col-xs-2"><?php echo $row['category']; ?></td>
                                                <td class="col-md-2 col-xs-2 aksi">
                                                    <a href="./backend/proses-hapus-pertanyaan.php?id=<?php echo $row['id_question']; ?>"
                                                        class="btn btn-delete">Hapus</a>

                                                    <a href="./edit-pertanyaan.php?id=<?php echo $row['id_question']; ?>"
                                                        class="btn btn-edit">Edit</a>
                                                </td>
                                            </tr>
                                            <?php
                                                }
                                            } else {
                                                echo "<tr><td colspan='4'>Tidak ada pertanyaan yang tersedia</td></tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="button">
                            <a href="../kelola-pertanyaan.php" class="btn btn-secondary">Kembali</a>
                        </div>
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
</body>

</html>