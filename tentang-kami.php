<?php
// Mulai Sesi
session_start();
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

    <title>Tentang Kami - Kuesioner</title>

    <link href="./assets/images/favicon/favicon.ico" rel="icon" />
    <link href="./assets/images/favicon/apple-touch-icon.png" rel="apple-touch-icon" />

    <link rel="stylesheet" href="./assets/styles/main.css" />
    <link href="./vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet" />
    <link href="./vendor/aos/aos.css" rel="stylesheet" />
    <link href="./vendor/glightbox/css/glightbox.min.css" rel="stylesheet" />
</head>

<body>
    <!-- Navbar -->
    <header class="navbar-container sticky-top">
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" id="navbarToggler">
                    <span class="navbar-toggler-icon">
                        <i class="bi bi-list"></i>
                    </span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">

                    <?php if (!isset($_SESSION['logged_in'])) : ?>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link " href="./index.php">Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="./tentang-kami.php">Tentang Kami</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./login.php">Login Admin</a>
                        </li>
                    </ul>
                    <?php endif; ?>

                    <!-- Navbar admin  -->
                    <?php if (isset($_SESSION['logged_in']) && $_SESSION['role'] == 'admin') : ?>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="./index.php">Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./pages/admin/hasil-kuesioner.php">Hasil Kuesioner</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./pages/admin/kelola-pertanyaan.php">Pertanyaan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./pages/admin/pengujian.php">Kepuasan Pelanggan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="./tentang-kami.php">Tentang Kami</a>
                        </li>
                    </ul>
                    <div class="text-center btn-logout">
                        <a href="./validations/logout.php" class="btn btn-secondary">Keluar</a>
                    </div>
                    <?php endif; ?>

                    <!-- Navbar leader -->
                    <?php if (isset($_SESSION['logged_in']) && $_SESSION['role'] == 'leader') : ?>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="./index.php">Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="./tentang-kami.php">Tentang Kami</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./pages/admin/pengujian.php">Kepuasan Pelanggan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./pages/leader/laporan.php">Laporan</a>
                        </li>
                    </ul>
                    <div class="text-center btn-logout">
                        <a href="./validations/logout.php" class="btn btn-secondary">Keluar</a>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <section id="hero" class="hero section-bg">
            <div class="content" data-aos="fade-up">
                <h2 class="title">RSUD AROSUKA</h2>
                <p class="text-content mb-5 col-12 col-lg-8">
                    RSUD AROSUKA adalah lembaga pelayanan kesehatan yang berkomitmen
                    untuk memberikan layanan terbaik kepada masyarakat sejak didirikan.
                    <br />
                    Kami menyediakan berbagai layanan kesehatan yang mencakup perawatan
                    medis, pelayanan rawat inap, operasi, konsultasi dokter, dan beragam
                    fasilitas penunjang lainnya. Dengan tim medis yang berpengalaman dan
                    fasilitas yang memadai, kami bertekad untuk menjadi mitra terpercaya
                    dalam upaya menjaga kesehatan dan kesejahteraan masyarakat.
                </p>
            </div>
            <div class="card-slider">
                <a class="glightbox" href="./assets/images/background-rs.png" type="image" slideEffect="slide">
                    <img src="./assets/images/background-rs-bundar.png" alt="Rumah sakit" class="image-container" /></a>
            </div>
        </section>
    </main>

    <!-- Vendor JS Files -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="./vendor/bootstrap-5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./vendor/aos/aos.js"></script>
    <script src="./vendor/glightbox/js/glightbox.min.js"></script>
    <script src="./vendor/purecounter/purecounter_vanilla.js"></script>

    <script src="./assets/scripts/navbar.js"></script>
    <script src="./assets/scripts/main.js"></script>
</body>

</html>