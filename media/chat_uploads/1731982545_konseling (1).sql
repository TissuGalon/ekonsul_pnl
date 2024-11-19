-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 18, 2024 at 06:41 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `konsultasi_mhs`
--

-- --------------------------------------------------------

--
-- Table structure for table `konseling`
--

CREATE TABLE `konseling` (
  `id_konseling` int(11) NOT NULL,
  `mahasiswa_id` int(11) NOT NULL,
  `dosen_id` int(11) NOT NULL,
  `tujuan_konseling` enum('Bimbingan Tugas Akhir','Bimbingan Akademik','Bimbingan PKL') NOT NULL,
  `jenis_konseling` enum('Online','Offline') NOT NULL,
  `tanggal_konseling` date NOT NULL DEFAULT current_timestamp(),
  `waktu_mulai` time NOT NULL,
  `waktu_selesai` time NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Diajukan',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `konseling`
--

INSERT INTO `konseling` (`id_konseling`, `mahasiswa_id`, `dosen_id`, `tujuan_konseling`, `jenis_konseling`, `tanggal_konseling`, `waktu_mulai`, `waktu_selesai`, `status`, `created_at`, `updated_at`) VALUES
(1, 3, 1, 'Bimbingan Tugas Akhir', 'Online', '2024-11-06', '06:15:00', '06:15:00', 'Diajukan', '2024-10-24 04:28:20', '2024-11-06 01:47:28'),
(2, 3, 2, 'Bimbingan Akademik', 'Offline', '2024-11-06', '11:28:00', '06:15:00', 'Diajukan', '2024-10-24 04:28:49', '2024-11-06 01:47:32');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `konseling`
--
ALTER TABLE `konseling`
  ADD PRIMARY KEY (`id_konseling`),
  ADD KEY `fk_lecturer_id` (`dosen_id`),
  ADD KEY `fk_student_id` (`mahasiswa_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `konseling`
--
ALTER TABLE `konseling`
  MODIFY `id_konseling` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `konseling`
--
ALTER TABLE `konseling`
  ADD CONSTRAINT `fk_lecturer_id` FOREIGN KEY (`dosen_id`) REFERENCES `dosen` (`dosen_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_student_id` FOREIGN KEY (`mahasiswa_id`) REFERENCES `mahasiswa` (`mahasiswa_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
