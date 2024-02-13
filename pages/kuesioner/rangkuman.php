<?php
// Include file koneksi ke database

// var_dump($_POST);
include "../../validations/connection.php";

// Query untuk mengambil data kategori dari database
$queryCategory = "SELECT * FROM categories";
$resultCategory = mysqli_query($connect, $queryCategory);

// Mengecek apakah query berhasil dieksekusi
if (!$resultCategory) {
    die("Query Error: " . mysqli_error($connect));
}

$queryUserId = "SELECT id_user FROM users ORDER BY id_user DESC LIMIT 1";
$resultUserId = mysqli_query($connect, $queryUserId);

// Mengecek apakah query berhasil dieksekusi
if (!$resultUserId) {
    die("Query Error: " . mysqli_error($connect));
}

// Mengambil ID pengguna terakhir
$rowUserId = mysqli_fetch_assoc($resultUserId);
$id_user_last = $rowUserId['id_user'] + 1;


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

    <title>Rangkuman - Kuesioner</title>

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
                            <form id="myForm" action="../../validations/proses_survey.php" method="post">
                                <div class="content">
                                    <h3 class="card-title">Rangkuman Jawaban Anda</h3>
                                    <p class="card-subtitle">
                                        Terimakasih sudah mengisi kuesioner ini
                                    </p>

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


                                    <input type="hidden" name="id_user" value="<?php echo $_POST['id_user']; ?>">

                                    <!-- Loop through categories -->
                                    <?php while ($rowCategory = mysqli_fetch_assoc($resultCategory)) : ?>
                                    <div class="category-question">
                                        <!-- Display category name -->
                                        <h4 class="elementor-divider px-4"><?php echo $rowCategory['category']; ?></h4>
                                    </div>
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
                                    <div class="question-container">
                                        <!-- Display question number and text -->
                                        <div class="question">
                                            <div class="question-no"><?php echo $rowQuestion['id_question']; ?>.</div>
                                            <div class="question-text"><?php echo $rowQuestion['question']; ?></div>
                                        </div>
                                        <!-- Display answer -->
                                        <p class="answer">Jawaban anda :
                                            <span><?php echo $_POST['Q' . $rowQuestion['id_question']]; ?></span>
                                        </p>
                                        <!-- Input hidden for answer -->
                                        <input type="hidden" name="Q<?php echo $rowQuestion['id_question']; ?>"
                                            value="<?php echo $_POST['Q' . $rowQuestion['id_question']]; ?>">
                                    </div>
                                    <?php endwhile; ?>
                                    <?php endwhile; ?>


                                </div>

                                <div class="button">
                                    <a href="pertanyaan.php" class="btn btn-secondary" id="prev">Kembali</a>
                                    <button type="submit" class="btn btn-primary" id="next">
                                        Selesai
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
    <script src="../../assets/scripts/kuesioner.js"></script>
    <script>
    document
        .getElementById("next")
        .addEventListener("click", function(event) {
            event.preventDefault();

            document.querySelector("form").submit();
        });
    </script>

</body>

</html>