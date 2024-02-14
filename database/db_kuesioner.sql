-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 14, 2024 at 11:16 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_kuesioner`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id_category` int(11) NOT NULL,
  `category` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id_category`, `category`) VALUES
(1, 'Ketanggapan (Responsiveness)'),
(2, 'Empati (Empathy)'),
(3, 'Tampilan Fisik (Tangible)');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id_question` int(11) NOT NULL,
  `question` text NOT NULL,
  `id_category` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id_question`, `question`, `id_category`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Petugas kesehatan memberikan pelayanan yang akurat kepada pasien?', 1, NULL, '2024-02-12 15:58:43', NULL),
(2, 'Petugas kesehatan memberikan informasi sebelumnya layanan disediakan?', 1, NULL, '2024-02-12 15:59:15', NULL),
(3, 'Petugas kesehatan menjelaskan tindakan yang akan dilakukan diambil?', 1, NULL, '2024-02-12 15:59:55', NULL),
(4, 'Petugas kesehatan melayani dengan ramah ketika melakukan pengobatan?', 1, NULL, '2024-02-12 16:00:10', NULL),
(5, 'Petugas kesehatan memberikan pelayanan sesuai ke jadwal yang telah ditentukan?', 1, NULL, '2024-02-12 16:00:39', NULL),
(6, 'Tenaga kesehatan bersedia menanggapi keluhan pasien?', 2, NULL, '2024-02-12 16:01:01', NULL),
(7, 'Tenaga kesehatan tanggap dalam melayani pasien?', 2, NULL, '2024-02-12 16:01:24', NULL),
(8, 'Tenaga kesehatan menerima dan melayani pasien dengan baik?', 2, NULL, '2024-02-12 16:01:45', NULL),
(9, 'Petugas kesehatan mengambil tindakan cepat dan dengan tepat?', 2, NULL, '2024-02-12 16:01:58', NULL),
(10, 'Petugas kesehatan melakukan tindakan sesuai dengan Prosedur?', 2, NULL, '2024-02-12 16:02:20', '2024-02-13 10:15:54'),
(11, 'Pasien merasa aman dan nyaman saat menjalani perawatan di rumah sakit?', 3, NULL, '2024-02-12 16:02:42', NULL),
(12, 'Apakah petugas kesehatan memberikan jaminan bahwa informasi pasien akan dirahasiakan?', 3, NULL, '2024-02-13 13:38:37', NULL),
(13, 'Apakah petugas kesehatan menunjukkan keahlian dan pengetahuan yang memadai dalam memberikan layanan kesehatan?', 3, NULL, '2024-02-13 13:38:47', NULL),
(14, 'Apakah petugas kesehatan memberikan penjelasan tentang risiko dan manfaat dari prosedur atau pengobatan kepada pasien?', 3, NULL, '2024-02-13 13:38:58', NULL),
(15, 'Apakah petugas kesehatan memberikan jaminan bahwa prosedur atau pengobatan yang diberikan telah sesuai dengan standar keamanan dan kualitas yang ditetapkan?', 3, NULL, '2024-02-13 13:39:07', '2024-02-13 17:03:10');

-- --------------------------------------------------------

--
-- Table structure for table `survey_form`
--

CREATE TABLE `survey_form` (
  `id_form` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `Q1` int(11) DEFAULT NULL,
  `Q2` int(11) DEFAULT NULL,
  `Q3` int(11) DEFAULT NULL,
  `Q4` int(11) DEFAULT NULL,
  `Q5` int(11) DEFAULT NULL,
  `Q6` int(11) DEFAULT NULL,
  `Q7` int(11) DEFAULT NULL,
  `Q8` int(11) DEFAULT NULL,
  `Q9` int(11) DEFAULT NULL,
  `Q10` int(11) DEFAULT NULL,
  `Q11` int(11) DEFAULT NULL,
  `Q12` int(11) DEFAULT NULL,
  `Q13` int(11) DEFAULT NULL,
  `Q14` int(11) DEFAULT NULL,
  `Q15` int(11) DEFAULT NULL,
  `Q16` int(11) DEFAULT NULL,
  `Q17` int(11) DEFAULT NULL,
  `Q18` int(11) DEFAULT NULL,
  `Q19` int(11) DEFAULT NULL,
  `Q20` int(11) DEFAULT NULL,
  `Q21` int(11) DEFAULT NULL,
  `Q22` int(11) DEFAULT NULL,
  `Q23` int(11) DEFAULT NULL,
  `Q24` int(11) DEFAULT NULL,
  `Q25` int(11) DEFAULT NULL,
  `Q26` int(11) DEFAULT NULL,
  `Q27` int(11) DEFAULT NULL,
  `Q28` int(11) DEFAULT NULL,
  `Q29` int(11) DEFAULT NULL,
  `Q30` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `survey_form`
--

INSERT INTO `survey_form` (`id_form`, `id_user`, `created_at`, `Q1`, `Q2`, `Q3`, `Q4`, `Q5`, `Q6`, `Q7`, `Q8`, `Q9`, `Q10`, `Q11`, `Q12`, `Q13`, `Q14`, `Q15`, `Q16`, `Q17`, `Q18`, `Q19`, `Q20`, `Q21`, `Q22`, `Q23`, `Q24`, `Q25`, `Q26`, `Q27`, `Q28`, `Q29`, `Q30`) VALUES
(1, 2, '2024-02-14 10:10:00', 78, 72, 72, 70, 66, 72, 78, 84, 85, 98, 100, 91, 90, 89, 88, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 3, '2024-02-14 10:11:36', 68, 61, 89, 84, 82, 92, 70, 76, 74, 76, 77, 78, 78, 83, 87, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 4, '2024-02-14 10:12:31', 38, 30, 32, 25, 31, 56, 59, 57, 58, 59, 69, 27, 30, 34, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 5, '2024-02-14 10:13:42', 9, 9, 11, 12, 9, 14, 15, 9, 5, 10, 5, 14, 20, 14, 25, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 6, '2024-02-14 10:14:56', 73, 67, 61, 71, 62, 32, 32, 36, 34, 67, 45, 64, 64, 69, 76, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `survey_results`
--

CREATE TABLE `survey_results` (
  `id_result` int(11) NOT NULL,
  `id_form` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `responsiveness` float NOT NULL,
  `empathy` float NOT NULL,
  `tangible` float NOT NULL,
  `nilai_z` float NOT NULL,
  `kepuasan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `survey_results`
--

INSERT INTO `survey_results` (`id_result`, `id_form`, `created_at`, `responsiveness`, `empathy`, `tangible`, `nilai_z`, `kepuasan`) VALUES
(1, 1, '2024-02-14 10:10:00', 71.6, 83.4, 91.6, 67, 'Puas'),
(2, 2, '2024-02-14 10:11:36', 76.8, 77.6, 80.6, 67, 'Puas'),
(3, 3, '2024-02-14 10:12:31', 31.2, 57.8, 39, 49.93, 'Puas'),
(4, 4, '2024-02-14 10:13:42', 10, 10.6, 15.6, 33, 'Tidak Puas'),
(5, 5, '2024-02-14 10:14:56', 66.8, 40.2, 63.6, 47.46, 'Puas');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `role` varchar(100) NOT NULL,
  `gender` varchar(100) DEFAULT NULL,
  `job` varchar(100) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `address` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `username`, `email`, `password`, `role`, `gender`, `job`, `age`, `address`) VALUES
(1, 'Lara Edyan', 'lara@gmail.com', 'lara1234', 'admin', NULL, NULL, NULL, NULL),
(2, 'Alif Suryadi', 'alifsuryadi@gmail.com', '', 'user', 'Laki-laki', 'Mahasiswa', 22, 'Lubuk Begalung, Kota Padang'),
(3, 'Tasya', 'tasya@gmail.com', '', 'user', 'Perempuan', 'Mahasiswa', 21, 'Jln. Gandoriah, Kota Pariaman'),
(4, 'Tony Altidt', 'tonialtidy@ngangur.com', '', 'user', 'Laki-laki', 'Mahasiswa', 22, 'Padang'),
(5, 'Akmal Alhidayat', 'akmalhidayati@gmail.com', '', 'user', 'Laki-laki', 'Mahasiswa', 21, 'Pasisir Selatan'),
(6, 'Raja Iskandar', '', '', 'user', '', '', 0, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id_category`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id_question`);

--
-- Indexes for table `survey_form`
--
ALTER TABLE `survey_form`
  ADD PRIMARY KEY (`id_form`);

--
-- Indexes for table `survey_results`
--
ALTER TABLE `survey_results`
  ADD PRIMARY KEY (`id_result`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id_question` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `survey_form`
--
ALTER TABLE `survey_form`
  MODIFY `id_form` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `survey_results`
--
ALTER TABLE `survey_results`
  MODIFY `id_result` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
