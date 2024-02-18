<?php
// Include the database connection file
include "./validations/connection.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Query the database to fetch the user with the provided email and password
    $query = "SELECT * FROM users WHERE email = ? AND password = ?";
    $stmt = $connect->prepare($query);
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if a user with the provided email and password exists
    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        // Check if the user is an admin
        if ($user['role'] == 'admin') {
            // Start a session and store the user's email
            session_start();
            $_SESSION['email'] = $email;
            // Redirect to the admin dashboard
            $_SESSION['logged_in'] = true;
            header("Location: ./index.php");

            
            exit();
        } else {
            // Redirect back to login page with error message
            header("Location: ./login.php?error=1");
            exit();
        }
    }
    
    // Redirect back to login page with error message if email or password is incorrect
    header("Location: ./login.php?error=1");
    exit();
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

    <title>Login - Kuesioner</title>

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
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="./index.php">Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./tentang-kami.php">Tentang Kami</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="./login.php">Login Admin</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <section id="login" class="login section-bg">
            <div class="content" data-aos="fade-up">
                <div class="row">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="col-12 col-lg-8">

                            <?php 
                            // Display error message if provided email or password is incorrect
                                if (isset($_GET['error']) && $_GET['error'] == 1) {
                                  echo '<div class="alert alert-danger" role="alert">
                                          Email atau Password ada yang salah
                                        </div>';
                                }
                            ?>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" id="email"
                                    aria-describedby="email" placeholder="Silahkan Masukkan email anda" required />
                            </div>
                            <div class="form-group">
                                <label for="password">Kata Sandi</label>
                                <input type="password" name="password" class="form-control" id="password"
                                    placeholder="Silahkan Masukkan Katasandi anda" required />
                            </div>
                        </div>
                        <div class="col-12 col-lg-8">
                            <button type="submit" class="btn btn-primary">Masuk</button>
                        </div>
                        <div class="col-12 col-lg-8">
                            <a href="https://wa.me/6285265324128?text=Hello,%20saya%20ingin%20bertanya%20kata%20sandi%20dari%20website%20kuesioner%20RSUD%20Arosuka"
                                class="btn btn-link">Lupa Kata Sandi?</a>
                        </div>
                    </form>
                </div>
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
    <script>
    setTimeout(function() {
        document.querySelector('.alert').style.display = 'none';
    }, 5000);
    </script>


</body>

</html>