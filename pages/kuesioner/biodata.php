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

    <title>Biodata - Kuesioner</title>

    <link href="../../assets/images/favicon/favicon.ico" rel="icon" />
    <link href="../../assets/images/favicon/apple-touch-icon.png" rel="apple-touch-icon" />

    <link rel="stylesheet" href="../../assets/styles/main.css" />
    <link href="../../vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet" />
    <link href="../../vendor/aos/aos.css" rel="stylesheet" />
    <link href="../../vendor/glightbox/css/glightbox.min.css" rel="stylesheet" />
</head>

<body>
    <main>
        <section id="biodata" class="biodata kuesioner">
            <div class="progressbar">
                <div class="container">
                    <div class="progress-container">
                        <div class="progress" id="progress"></div>
                        <div class="circle active">1</div>
                        <div class="circle">2</div>
                        <div class="circle">3</div>
                        <div class="circle">4</div>
                    </div>

                    <!-- Content -->
                    <div class="card">
                        <div class="card-body">
                            <form id="myForm" action="./cara-pengisian.php" method="post"
                                enctype="application/x-www-form-urlencoded">
                                <div class="content">
                                    <h3 class="card-title">Masukan Biodata Anda</h3>
                                    <p class="card-subtitle">
                                        Kuesioner ini bertujuan untuk meningkatkan pelayan kami
                                        kedepannya
                                    </p>
                                    <div class="question-container">
                                        <!-- Form inputs -->
                                        <div class="row">
                                            <div class="col-12 col-lg-8 mb-3">
                                                <div class="form-group">
                                                    <label for="email" class="mb-2">Alamat Email</label>
                                                    <input type="email" class="form-control" id="email"
                                                        aria-describedby="emailHelp" name="email"
                                                        placeholder="Masukan email anda" />
                                                    <small id="emailHelp" class="form-text text-muted">
                                                        Kami tidak akan pernah membagikan email Anda
                                                        kepada siapapun.
                                                    </small>
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-8 mb-3">
                                                <div class="form-group">
                                                    <label for="nama" class="mb-2">Nama Lengkap</label>
                                                    <input type="text" name="username" class="form-control" id="nama"
                                                        placeholder="Masukan nama lengkap anda" />
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-8 mb-3">
                                                <div class="form-group">
                                                    <label for="gender" class="mb-2">Jenis Kelamin</label>
                                                    <select class="form-select" name="gender" id="gender">
                                                        <option value="" disabled selected>
                                                            -- Pilih jenis kelamin --
                                                        </option>
                                                        <option value="Laki-laki">Laki-laki</option>
                                                        <option value="Perempuan">Perempuan</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-8 mb-3">
                                                <div class="form-group">
                                                    <label for="job" class="mb-2">Pekerjaan</label>
                                                    <input type="text" name="job" class="form-control" id="job"
                                                        placeholder="Masukan pekerjaan anda" />
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-8 mb-3">
                                                <div class="form-group">
                                                    <label for="age" class="mb-2">Umur</label>
                                                    <input type="number" name="age" class="form-control" id="age"
                                                        placeholder="Masukan umur anda" />
                                                </div>
                                            </div>

                                            <div class="col-12 col-lg-8 mb-3">
                                                <div class="form-group">
                                                    <label for="address" class="mb-2">Alamat</label>
                                                    <textarea class="form-control" name="address" id="address"
                                                        placeholder="Masukan alamat anda"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="finish">Jika sudah diisi, silahkan lanjutkan</p>
                                </div>

                                <!-- Navigation buttons -->
                                <div class="button">
                                    <a href="../../index.php" class="btn btn-secondary" id="prev">Kembali</a>
                                    <!-- Lanjutkan button -->
                                    <button type="submit" class="btn btn-primary" id="next">
                                        Lanjutkan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Vendor JS Files -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="../../vendor/bootstrap-5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../vendor/aos/aos.js"></script>
    <script src="../../vendor/glightbox/js/glightbox.min.js"></script>
    <script src="../../vendor/purecounter/purecounter_vanilla.js"></script>

    <script src="../../assets/scripts/main.js"></script>
    <!-- Wajib isi form
    <script src="../../assets/scripts/form.js"></script> -->
    <script src="../../assets/scripts/kuesioner.js"></script>


</body>

</html>