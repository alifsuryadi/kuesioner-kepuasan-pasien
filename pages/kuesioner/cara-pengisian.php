<?php
// Include file koneksi ke database
include "../../validations/connection.php";

// Query untuk mengambil data kategori dari database
$queryCategory = "SELECT * FROM categories";
$resultCategory = mysqli_query($connect, $queryCategory);

// Mengecek apakah query berhasil dieksekusi
if (!$resultCategory) {
    die("Query Error: " . mysqli_error($connect));
}

// Inisialisasi array untuk menyimpan jawaban dari halaman rangkuman
$answers = array();

// Memeriksa apakah ada data yang dikirimkan dari halaman rangkuman
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil jawaban untuk setiap pertanyaan dan menyimpannya dalam array
    foreach ($_POST as $key => $value) {
        if (substr($key, 0, 1) == "Q") {
            $answers[$key] = $value;
        }
    }
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
                                <form action="./biodata.php" method="post" id="formPrev">
                                    <input type="hidden" name="email"
                                        value="<?php echo isset($_POST['email']) ? $_POST['email'] : null; ?>">
                                    <input type="hidden" name="username"
                                        value="<?php echo isset($_POST['username']) ? $_POST['username'] : null; ?>">
                                    <input type="hidden" name="gender"
                                        value="<?php echo isset($_POST['gender']) ? $_POST['gender'] : null; ?>">
                                    <input type="hidden" name="job"
                                        value="<?php echo isset($_POST['job']) ? $_POST['job'] : null; ?>">
                                    <input type="hidden" name="age"
                                        value="<?php echo isset($_POST['age']) ? $_POST['age'] : null; ?>">
                                    <input type="hidden" name="address"
                                        value="<?php echo isset($_POST['address']) ? $_POST['address'] : null; ?>">

                                    <!-- Loop through categories -->
                                    <?php 
                                    // Set pointer result set kembali ke awal
                                    mysqli_data_seek($resultCategory, 0);
                                    
                                    while ($rowCategory = mysqli_fetch_assoc($resultCategory)) : ?>
                                    <!-- Query for fetching questions based on category -->
                                    <?php
                                    $categoryId = $rowCategory['id_category'];
                                    $queryQuestion = "SELECT * FROM questions WHERE id_category = $categoryId";
                                    $resultQuestion = mysqli_query($connect, $queryQuestion);

                                    // Mengecek apakah query berhasil dieksekusi
                                    if (!$resultQuestion) {
                                        die("Query Error: " . mysqli_error($connect));
                                    }
                                    ?>

                                    <!-- Iterating through questions to display them -->
                                    <?php while ($rowQuestion = mysqli_fetch_assoc($resultQuestion)) : ?>
                                    <!-- Input hidden for answer -->
                                    <input type="hidden" name="Q<?php echo $rowQuestion['id_question']; ?>"
                                        value="<?php echo isset($_POST['Q' . $rowQuestion['id_question']]) ? $_POST['Q' . $rowQuestion['id_question']] : 50; ?>">
                                    <?php endwhile; ?>
                                    <?php endwhile; ?>


                                    <!-- <button type="submit" class="btn btn-primary" id="next">Lanjutkan</button> -->
                                    <button type="submit" class="btn btn-secondary" id="prev">Kembali</button>
                                </form>


                                <form action="./pertanyaan.php" method="post" id="formNext">
                                    <input type="hidden" name="email"
                                        value="<?php echo isset($_POST['email']) ? $_POST['email'] : null; ?>">
                                    <input type="hidden" name="username"
                                        value="<?php echo isset($_POST['username']) ? $_POST['username'] : null; ?>">
                                    <input type="hidden" name="gender"
                                        value="<?php echo isset($_POST['gender']) ? $_POST['gender'] : null; ?>">
                                    <input type="hidden" name="job"
                                        value="<?php echo isset($_POST['job']) ? $_POST['job'] : null; ?>">
                                    <input type="hidden" name="age"
                                        value="<?php echo isset($_POST['age']) ? $_POST['age'] : null; ?>">
                                    <input type="hidden" name="address"
                                        value="<?php echo isset($_POST['address']) ? $_POST['address'] : null; ?>">

                                    <!-- Loop through categories -->
                                    <?php 
                                    // Set pointer result set kembali ke awal
                                    mysqli_data_seek($resultCategory, 0);
                                    
                                    while ($rowCategory = mysqli_fetch_assoc($resultCategory)) : ?>
                                    <!-- Query for fetching questions based on category -->
                                    <?php
                                    $categoryId = $rowCategory['id_category'];
                                    $queryQuestion = "SELECT * FROM questions WHERE id_category = $categoryId";
                                    $resultQuestion = mysqli_query($connect, $queryQuestion);

                                    // Mengecek apakah query berhasil dieksekusi
                                    if (!$resultQuestion) {
                                        die("Query Error: " . mysqli_error($connect));
                                    }
                                    ?>

                                    <!-- Iterating through questions to display them -->
                                    <?php while ($rowQuestion = mysqli_fetch_assoc($resultQuestion)) : ?>
                                    <!-- Input hidden for answer -->
                                    <input type="hidden" name="Q<?php echo $rowQuestion['id_question']; ?>"
                                        value="<?php echo isset($_POST['Q' . $rowQuestion['id_question']]) ? $_POST['Q' . $rowQuestion['id_question']] : 50; ?>">
                                    <?php endwhile; ?>
                                    <?php endwhile; ?>

                                    <!-- Submit button for the form -->
                                    <button type="submit" class="btn btn-primary" id="next">Lanjutkan</button>
                                </form>
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
    <script>
    // let currentActive = 2;
    // localStorage.setItem("currentActive", currentActive);
    document
        .getElementById("next")
        .addEventListener("click", function(event) {
            event.preventDefault();

            document.querySelector("#formNext").submit();
        });

    document
        .getElementById("prev")
        .addEventListener("click", function(event) {
            event.preventDefault();

            document.querySelector("#formPrev").submit();
        });
    </script>
</body>

</html>