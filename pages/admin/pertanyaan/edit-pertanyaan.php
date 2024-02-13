<?php
// Include file koneksi
include_once("../../../validations/middleware-2.php");
include "../../../validations/connection.php";

// Inisialisasi variabel untuk menyimpan pesan kesalahan
$error = "";

// Cek apakah parameter ID pertanyaan dikirim melalui URL
if (isset($_GET['id']) && !empty(trim($_GET['id']))) {
    // Siapkan parameter ID pertanyaan
    $id_pertanyaan = trim($_GET['id']);

    // Query untuk mengambil data pertanyaan berdasarkan ID
    $sql = "SELECT q.id_question, q.question, q.id_category, c.category
            FROM questions q
            INNER JOIN categories c ON q.id_category = c.id_category
            WHERE q.id_question = ?";

    if ($stmt = mysqli_prepare($connect, $sql)) {
        // Bind parameter ke query
        mysqli_stmt_bind_param($stmt, "i", $param_id);

        // Set parameter
        $param_id = $id_pertanyaan;

        // Eksekusi query
        if (mysqli_stmt_execute($stmt)) {
            // Simpan hasil query
            mysqli_stmt_store_result($stmt);

            // Periksa apakah ID pertanyaan valid
            if (mysqli_stmt_num_rows($stmt) == 1) {
                // Bind hasil query ke variabel
                mysqli_stmt_bind_result($stmt, $id_pertanyaan, $pertanyaan, $id_kategori, $kategori);
                mysqli_stmt_fetch($stmt);
            } else {
                // Redirect ke halaman error jika ID tidak valid
                header("location: error.php");
                exit();
            }
        } else {
            $error = "Oops! Ada yang salah. Silakan coba lagi nanti.";
        }

        // Tutup statement
        mysqli_stmt_close($stmt);
    }

    // Tutup koneksi
    mysqli_close($connect);
} else {
    // Redirect ke halaman error jika ID pertanyaan tidak tersedia
    header("location: error.php");
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
                        <form action="./backend/proses-edit-pertanyaan.php" method="POST">
                            <div class="content">
                                <h3 class="card-title">Tambah Pertanyaan</h3>
                                <p class="card-subtitle">
                                    Silahkan Edit Pertanyaan Di bawah ini
                                </p>

                                <div class="question-container mt-4">
                                    <div class="form-group">
                                        <label for="pertanyaan" class="mb-2">Pertanyaan</label>
                                        <textarea class="form-control" id="pertanyaan" name="pertanyaan"
                                            rows="5"><?php echo $pertanyaan; ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="kategori" class="mb-2">Kategori Pertanyaan</label>
                                        <select class="form-select" id="kategori" name="kategori" required>

                                            <option value="" disabled>-- Pilih Kategori Pertanyaan --</option>
                                            <option value="1" <?php if ($id_kategori == 1) echo "selected"; ?>>Keandalan
                                                (Reliability)</option>
                                            <option value="2" <?php if ($id_kategori == 2) echo "selected"; ?>>Daya
                                                Tanggap (Responsiveness)</option>
                                            <option value="3" <?php if ($id_kategori == 3) echo "selected"; ?>>Jaminan
                                                (Assurance)</option>
                                        </select>
                                    </div>
                                    <input type="hidden" name="id_pertanyaan" value="<?php echo $id_pertanyaan; ?>">
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