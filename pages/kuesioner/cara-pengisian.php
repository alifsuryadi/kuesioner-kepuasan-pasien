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

    <title>Cara Pengisian - Kuesioner</title>

    <link href="../../assets/images/favicon/favicon.ico" rel="icon" />
    <link href="../../assets/images/favicon/apple-touch-icon.png" rel="apple-touch-icon" />

    <link rel="stylesheet" href="../../assets/styles/main.css" />
    <link href="../../vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet" />
    <link href="../../vendor/aos/aos.css" rel="stylesheet" />
    <link href="../../vendor/glightbox/css/glightbox.min.css" rel="stylesheet" />
</head>

<body>
    <main>
        <section id="keusioner" class="kuesioner">
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
                            <div class="content">
                                <h3 class="card-title">Cara Pengisian Kuosioner</h3>
                                <p class="card-subtitle" style="margin-bottom: 10px">
                                    Untuk Pengisian Kuesioner, silakan ikuti langkah-langkah
                                    berikut ini:
                                </p>
                                <ol class="mb-5">
                                    <li>Bacalah setiap pertanyaan dengan teliti dan cermat.</li>
                                    <li>
                                        Geser slider ke posisi yang sesuai dengan tingkat kepuasan
                                        atau pendapat Anda, di mana 0 menandakan sangat tidak puas
                                        dan 100 menandakan sangat puas.
                                    </li>
                                    <li>
                                        Pastikan untuk memilih nilai yang mencerminkan pengalaman
                                        atau pendapat Anda secara jujur.
                                    </li>
                                    <li>
                                        Lanjutkan ke langkah berikutnya dengan mengklik tombol
                                        "Lanjutkan".
                                    </li>
                                </ol>
                                <div class="question-container">
                                    <h4 class="question-title">Contoh Pertanyaan :</h4>
                                    <div class="question">
                                        <div class="question-no">1.</div>
                                        <div class="question-text">
                                            Bagaimana penilaian Anda terhadap kecepatan respons tim
                                            kami dalam menanggapi kebutuhan Anda?
                                        </div>
                                    </div>
                                    <p class="answer">Jawaban anda : <span>50</span></p>
                                    <!-- Slider -->
                                    <div class="bantuan">
                                        <span>0</span>
                                        <span>100</span>
                                    </div>
                                    <input class="answer-question" type="range" min="0" max="100" step="0" />
                                    <br />
                                </div>
                                <p class="finish">
                                    Jika anda sudah mengerti, silahkan lanjutkan
                                </p>
                            </div>

                            <div class="button">
                                <a href="biodata.php" class="btn btn-secondary" id="prev">Kembali</a>
                                <a href="pertanyaan.php" class="btn btn-primary" id="next">Lanjutkan</a>
                            </div>
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
    <script src="../../assets/scripts/kuesioner.js"></script>
    <script src="../../assets/scripts/slider-answer.js"></script>
</body>

</html>