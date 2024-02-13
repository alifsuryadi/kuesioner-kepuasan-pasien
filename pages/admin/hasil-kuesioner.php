<?php include_once("../../validations/middleware.php"); ?>

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

    <link href="../../assets/images/favicon/favicon.ico" rel="icon" />
    <link href="../../assets/images/favicon/apple-touch-icon.png" rel="apple-touch-icon" />

    <link rel="stylesheet" href="../../assets/styles/main.css" />
    <link href="../../vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet" />
    <link href="../../vendor/aos/aos.css" rel="stylesheet" />
    <link href="../../vendor/glightbox/css/glightbox.min.css" rel="stylesheet" />
</head>

<body>
    <!-- Navbar -->
    <header class="navbar-container sticky-top">
        <nav class="navbar navbar-expand-md bg-body-tertiary">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" id="navbarToggler">
                    <span class="navbar-toggler-icon">
                        <i class="bi bi-list"></i>
                    </span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="./index.php">Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="./hasil-kuesioner.php">Hasil Kuesioner</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./kelola-pertanyaan.php">Pertanyaan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./pengujian.php">Pengujian</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./tentang-kami.php">Tentang Kami</a>
                        </li>
                    </ul>
                    <div class="text-center btn-logout">
                        <a href="../../index.php" class="btn btn-secondary">Keluar</a>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <section id="hasil-kuesioner" class="hasil-kuesioner section-bg">
            <div class="content">
                <div class="row">
                    <div class="col-12 col-lg-8">
                        <div class="row">
                            <div class="col-md-4 col-6" data-aos="fade-up" data-aos-delay="100">
                                <a href="./print/total-responden.php">
                                    <div class="card">
                                        <div class="card-body">
                                            <span data-purecounter-start="0" data-purecounter-end="44"
                                                data-purecounter-duration="1" class="purecounter"></span>
                                            <p class="card-text">Total Responden</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-4 col-6" data-aos="fade-up" data-aos-delay="200">
                                <a href="./print/responden-puas.php">
                                    <div class="card">
                                        <div class="card-body">
                                            <span data-purecounter-start="0" data-purecounter-end="28"
                                                data-purecounter-duration="1.5" class="purecounter"></span>
                                            <p class="card-text">Responden Puas</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-4 col-6" data-aos="fade-up" data-aos-delay="300">
                                <a href="./print/responden-tidak-puas.php">
                                    <div class="card">
                                        <div class="card-body">
                                            <span data-purecounter-start="0" data-purecounter-end="16"
                                                data-purecounter-duration="2" class="purecounter"></span>
                                            <p class="card-text">Responden Tidak Puas</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-4 col-6" data-aos="fade-up" data-aos-delay="400">
                                <a href="./print/responden-terdaftar.php">
                                    <div class="card">
                                        <div class="card-body">
                                            <span data-purecounter-start="0" data-purecounter-end="14"
                                                data-purecounter-duration="2.5" class="purecounter"></span>
                                            <p class="card-text">Responden Terdaftar</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-4 col-6" data-aos="fade-up" data-aos-delay="500">
                                <a href="./print/responden-laki-laki.php">
                                    <div class="card">
                                        <div class="card-body">
                                            <span data-purecounter-start="0" data-purecounter-end="7"
                                                data-purecounter-duration="3" class="purecounter"></span>
                                            <p class="card-text">Responden Laki-Laki</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-4 col-6" data-aos="fade-up" data-aos-delay="600">
                                <a href="./print/responden-perempuan.php">
                                    <div class="card">
                                        <div class="card-body">
                                            <span data-purecounter-start="0" data-purecounter-end="7"
                                                data-purecounter-duration="3.5" class="purecounter"></span>
                                            <p class="card-text">Responden Perempuan</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-slider">
                <a class="glightbox" href="../../assets/images/background-rs.png" type="image" slideEffect="slide">
                    <img src="../../assets/images/background-rs-bundar.png" alt="Rumah sakit"
                        class="image-container" /></a>
            </div>
        </section>
    </main>

    <!-- Vendor JS Files -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="../../vendor/bootstrap-5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../vendor/aos/aos.js"></script>
    <script src="../../vendor/glightbox/js/glightbox.min.js"></script>
    <script src="../../vendor/purecounter/purecounter_vanilla.js"></script>

    <script src="../../assets/scripts/navbar.js"></script>
    <script src="../../assets/scripts/main.js"></script>
</body>

</html>