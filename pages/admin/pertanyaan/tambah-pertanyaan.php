<?php
// Include file koneksi
include_once("../../../validations/middleware-2.php");

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
                        <form action="./backend/proses-tambah-pertanyaan.php" method="post">
                            <div class="content">
                                <h3 class="card-title">Tambah Pertanyaan</h3>
                                <p class="card-subtitle">Silahkan Tambahkan Pertanyaan</p>

                                <div class="question-container mt-4">
                                    <div class="form-group">
                                        <label for="question" class="mb-2">Pertanyaan</label>
                                        <textarea class="form-control" id="question" name="question"
                                            placeholder="Masukan Pertanyaannya" rows="5" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="id_category" class="mb-2">Kategori Pertanyaan</label>

                                        <select class="form-select" id="id_category" name="id_category" required>
                                            <option value="" disabled selected>-- Pilih Kategori Pertanyaan --</option>
                                            <option value="1">Keandalan (Reliability)</option>
                                            <option value="2">Daya Tanggap (Responsiveness)</option>
                                            <option value="3"> Jaminan (Assurance)</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="button">
                                <a href="./kelola-pertanyaan.php" class="btn btn-secondary" id="prev"
                                    style="margin: 20px 5px">Kembali</a>
                                <button type="submit" class="btn btn-primary" style="margin: 20px 5px">
                                    Submit
                                </button>
                            </div>
                        </form>
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