-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 13, 2024 at 04:46 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pkl_smkn1bantul`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `kode_admin` varchar(10) NOT NULL,
  `password` varchar(255) NOT NULL,
  `surat_pengajuan` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dudi`
--

CREATE TABLE `dudi` (
  `kode_dudi` varchar(10) NOT NULL,
  `nama_dudi` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `alamat_dudi` text NOT NULL,
  `notelp_dudi` varchar(15) NOT NULL,
  `posisi_pkl` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `evaluasi`
--

CREATE TABLE `evaluasi` (
  `id_evaluasi` int NOT NULL,
  `kode_kelompok` varchar(10) DEFAULT NULL,
  `kode_dudi` varchar(10) DEFAULT NULL,
  `NIS` varchar(15) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `konsentrasi_keahlian` varchar(10) DEFAULT NULL,
  `kelas` varchar(10) DEFAULT NULL,
  `tahun` year DEFAULT NULL,
  `nama_dudi` varchar(100) DEFAULT NULL,
  `evaluasi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kelompok`
--

CREATE TABLE `kelompok` (
  `kode_kelompok` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `konsentrasi_keahlian`
--

CREATE TABLE `konsentrasi_keahlian` (
  `kode_konsentrasi` varchar(10) NOT NULL,
  `nama_konsentrasi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `laporan_akhir`
--

CREATE TABLE `laporan_akhir` (
  `id_laporan_akhir` int NOT NULL,
  `kode_kelompok` varchar(10) DEFAULT NULL,
  `kode_dudi` varchar(10) DEFAULT NULL,
  `NIS` varchar(15) DEFAULT NULL,
  `konsentrasi_keahlian` varchar(10) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `kelas` varchar(10) DEFAULT NULL,
  `nama_dudi` varchar(100) DEFAULT NULL,
  `laporan_akhir` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `laporan_jurnal`
--

CREATE TABLE `laporan_jurnal` (
  `id_jurnal` int NOT NULL,
  `NIS` varchar(15) DEFAULT NULL,
  `kode_dudi` varchar(10) DEFAULT NULL,
  `nama_siswa` varchar(100) DEFAULT NULL,
  `nama_dudi` varchar(100) DEFAULT NULL,
  `kegiatan` text,
  `lokasi` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `laporan_pengimbasan`
--

CREATE TABLE `laporan_pengimbasan` (
  `id_pengimbasan` int NOT NULL,
  `kode_kelompok` varchar(10) DEFAULT NULL,
  `kode_dudi` varchar(10) DEFAULT NULL,
  `NIS` varchar(15) DEFAULT NULL,
  `konsentrasi_keahlian` varchar(10) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `kelas` varchar(10) DEFAULT NULL,
  `nama_dudi` varchar(100) DEFAULT NULL,
  `laporan_pengimbasan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `monitoring`
--

CREATE TABLE `monitoring` (
  `id_monitoring` int NOT NULL,
  `NIS` varchar(15) DEFAULT NULL,
  `kode_kelompok` varchar(10) DEFAULT NULL,
  `kode_dudi` varchar(10) DEFAULT NULL,
  `nama_siswa` varchar(100) DEFAULT NULL,
  `konsentrasi_keahlian` varchar(10) DEFAULT NULL,
  `nama_dudi` varchar(100) DEFAULT NULL,
  `kelas` varchar(10) DEFAULT NULL,
  `tahun` year DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nilai_pkl`
--

CREATE TABLE `nilai_pkl` (
  `id_nilai` int NOT NULL,
  `kode_kelompok` varchar(10) DEFAULT NULL,
  `NIS` varchar(15) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `konsentrasi_keahlian` varchar(10) DEFAULT NULL,
  `kelas` varchar(10) DEFAULT NULL,
  `tahun` year DEFAULT NULL,
  `nilai` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pembimbing`
--

CREATE TABLE `pembimbing` (
  `NIP_NIK` varchar(20) NOT NULL,
  `nama_pembimbing` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `notelp_pembimbing` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengajuan`
--

CREATE TABLE `pengajuan` (
  `id_pengajuan` int NOT NULL,
  `NIS` varchar(15) DEFAULT NULL,
  `nama_siswa` varchar(100) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `tempat_pkl` varchar(100) DEFAULT NULL,
  `notelp_dudi` varchar(15) DEFAULT NULL,
  `proposal_pkl` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ploting`
--

CREATE TABLE `ploting` (
  `id_ploting` int NOT NULL,
  `kode_kelompok` varchar(10) DEFAULT NULL,
  `NIP_NIK` varchar(20) DEFAULT NULL,
  `nama_pembimbing` varchar(100) DEFAULT NULL,
  `kode_dudi` varchar(10) DEFAULT NULL,
  `nama_dudi` varchar(100) DEFAULT NULL,
  `NIS` varchar(15) DEFAULT NULL,
  `kelas` varchar(10) DEFAULT NULL,
  `notelp_dudi` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text,
  `payload` text NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('9Rz50t9yiFbnWlQFY7h8w51KQm37M8RsdJVu8rAI', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiR0NVNnQzbkRHY0tZbHIyWlhzSWdZM2plTzRmZkdwUVljMEZJYjU2ZSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1726202688),
('dYyxQk6pPN3f3zJ9kiYlViiEnyaDFfoyw2o50QX5', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVkVaWjhZdTJHVFk3UVZ0VFVlQVpRVzYzYjlZcXljOWxLUVBha3VxWSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1726153239);

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `NIS` varchar(15) NOT NULL,
  `nama_siswa` varchar(100) NOT NULL,
  `konsentrasi_keahlian` varchar(10) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `kelas` varchar(10) NOT NULL,
  `tahun` year NOT NULL,
  `kode_kelompok` varchar(10) DEFAULT NULL,
  `kode_dudi` varchar(10) DEFAULT NULL,
  `nama_dudi` varchar(100) DEFAULT NULL,
  `alamat_dudi` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tipe_pkl`
--

CREATE TABLE `tipe_pkl` (
  `kode_pkl` varchar(10) NOT NULL,
  `tipe_pkl` enum('mpkl','ppkl') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('siswa','pembimbing','admin','dudi') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`kode_admin`);

--
-- Indexes for table `dudi`
--
ALTER TABLE `dudi`
  ADD PRIMARY KEY (`kode_dudi`);

--
-- Indexes for table `evaluasi`
--
ALTER TABLE `evaluasi`
  ADD PRIMARY KEY (`id_evaluasi`),
  ADD KEY `kode_kelompok` (`kode_kelompok`),
  ADD KEY `NIS` (`NIS`),
  ADD KEY `konsentrasi_keahlian` (`konsentrasi_keahlian`),
  ADD KEY `kode_dudi` (`kode_dudi`);

--
-- Indexes for table `kelompok`
--
ALTER TABLE `kelompok`
  ADD PRIMARY KEY (`kode_kelompok`);

--
-- Indexes for table `konsentrasi_keahlian`
--
ALTER TABLE `konsentrasi_keahlian`
  ADD PRIMARY KEY (`kode_konsentrasi`);

--
-- Indexes for table `laporan_akhir`
--
ALTER TABLE `laporan_akhir`
  ADD PRIMARY KEY (`id_laporan_akhir`),
  ADD KEY `kode_kelompok` (`kode_kelompok`),
  ADD KEY `NIS` (`NIS`),
  ADD KEY `konsentrasi_keahlian` (`konsentrasi_keahlian`),
  ADD KEY `kode_dudi` (`kode_dudi`);

--
-- Indexes for table `laporan_jurnal`
--
ALTER TABLE `laporan_jurnal`
  ADD PRIMARY KEY (`id_jurnal`),
  ADD KEY `NIS` (`NIS`),
  ADD KEY `kode_dudi` (`kode_dudi`);

--
-- Indexes for table `laporan_pengimbasan`
--
ALTER TABLE `laporan_pengimbasan`
  ADD PRIMARY KEY (`id_pengimbasan`),
  ADD KEY `kode_kelompok` (`kode_kelompok`),
  ADD KEY `NIS` (`NIS`),
  ADD KEY `konsentrasi_keahlian` (`konsentrasi_keahlian`),
  ADD KEY `kode_dudi` (`kode_dudi`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `monitoring`
--
ALTER TABLE `monitoring`
  ADD PRIMARY KEY (`id_monitoring`),
  ADD KEY `NIS` (`NIS`),
  ADD KEY `kode_kelompok` (`kode_kelompok`),
  ADD KEY `konsentrasi_keahlian` (`konsentrasi_keahlian`),
  ADD KEY `kode_dudi` (`kode_dudi`);

--
-- Indexes for table `nilai_pkl`
--
ALTER TABLE `nilai_pkl`
  ADD PRIMARY KEY (`id_nilai`),
  ADD KEY `kode_kelompok` (`kode_kelompok`),
  ADD KEY `NIS` (`NIS`),
  ADD KEY `konsentrasi_keahlian` (`konsentrasi_keahlian`);

--
-- Indexes for table `pembimbing`
--
ALTER TABLE `pembimbing`
  ADD PRIMARY KEY (`NIP_NIK`);

--
-- Indexes for table `pengajuan`
--
ALTER TABLE `pengajuan`
  ADD PRIMARY KEY (`id_pengajuan`),
  ADD KEY `NIS` (`NIS`);

--
-- Indexes for table `ploting`
--
ALTER TABLE `ploting`
  ADD PRIMARY KEY (`id_ploting`),
  ADD KEY `kode_kelompok` (`kode_kelompok`),
  ADD KEY `NIP_NIK` (`NIP_NIK`),
  ADD KEY `kode_dudi` (`kode_dudi`),
  ADD KEY `NIS` (`NIS`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`NIS`),
  ADD KEY `konsentrasi_keahlian` (`konsentrasi_keahlian`),
  ADD KEY `kode_kelompok` (`kode_kelompok`),
  ADD KEY `kode_dudi` (`kode_dudi`);

--
-- Indexes for table `tipe_pkl`
--
ALTER TABLE `tipe_pkl`
  ADD PRIMARY KEY (`kode_pkl`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `evaluasi`
--
ALTER TABLE `evaluasi`
  MODIFY `id_evaluasi` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `laporan_akhir`
--
ALTER TABLE `laporan_akhir`
  MODIFY `id_laporan_akhir` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `laporan_jurnal`
--
ALTER TABLE `laporan_jurnal`
  MODIFY `id_jurnal` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `laporan_pengimbasan`
--
ALTER TABLE `laporan_pengimbasan`
  MODIFY `id_pengimbasan` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `monitoring`
--
ALTER TABLE `monitoring`
  MODIFY `id_monitoring` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nilai_pkl`
--
ALTER TABLE `nilai_pkl`
  MODIFY `id_nilai` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pengajuan`
--
ALTER TABLE `pengajuan`
  MODIFY `id_pengajuan` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ploting`
--
ALTER TABLE `ploting`
  MODIFY `id_ploting` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `evaluasi`
--
ALTER TABLE `evaluasi`
  ADD CONSTRAINT `evaluasi_ibfk_1` FOREIGN KEY (`kode_kelompok`) REFERENCES `kelompok` (`kode_kelompok`),
  ADD CONSTRAINT `evaluasi_ibfk_2` FOREIGN KEY (`NIS`) REFERENCES `siswa` (`NIS`),
  ADD CONSTRAINT `evaluasi_ibfk_3` FOREIGN KEY (`konsentrasi_keahlian`) REFERENCES `siswa` (`konsentrasi_keahlian`),
  ADD CONSTRAINT `evaluasi_ibfk_4` FOREIGN KEY (`kode_dudi`) REFERENCES `dudi` (`kode_dudi`);

--
-- Constraints for table `laporan_akhir`
--
ALTER TABLE `laporan_akhir`
  ADD CONSTRAINT `laporan_akhir_ibfk_1` FOREIGN KEY (`kode_kelompok`) REFERENCES `kelompok` (`kode_kelompok`),
  ADD CONSTRAINT `laporan_akhir_ibfk_2` FOREIGN KEY (`NIS`) REFERENCES `siswa` (`NIS`),
  ADD CONSTRAINT `laporan_akhir_ibfk_3` FOREIGN KEY (`konsentrasi_keahlian`) REFERENCES `siswa` (`konsentrasi_keahlian`),
  ADD CONSTRAINT `laporan_akhir_ibfk_4` FOREIGN KEY (`kode_dudi`) REFERENCES `dudi` (`kode_dudi`);

--
-- Constraints for table `laporan_jurnal`
--
ALTER TABLE `laporan_jurnal`
  ADD CONSTRAINT `laporan_jurnal_ibfk_1` FOREIGN KEY (`NIS`) REFERENCES `siswa` (`NIS`),
  ADD CONSTRAINT `laporan_jurnal_ibfk_2` FOREIGN KEY (`kode_dudi`) REFERENCES `dudi` (`kode_dudi`);

--
-- Constraints for table `laporan_pengimbasan`
--
ALTER TABLE `laporan_pengimbasan`
  ADD CONSTRAINT `laporan_pengimbasan_ibfk_1` FOREIGN KEY (`kode_kelompok`) REFERENCES `kelompok` (`kode_kelompok`),
  ADD CONSTRAINT `laporan_pengimbasan_ibfk_2` FOREIGN KEY (`NIS`) REFERENCES `siswa` (`NIS`),
  ADD CONSTRAINT `laporan_pengimbasan_ibfk_3` FOREIGN KEY (`konsentrasi_keahlian`) REFERENCES `siswa` (`konsentrasi_keahlian`),
  ADD CONSTRAINT `laporan_pengimbasan_ibfk_4` FOREIGN KEY (`kode_dudi`) REFERENCES `dudi` (`kode_dudi`);

--
-- Constraints for table `monitoring`
--
ALTER TABLE `monitoring`
  ADD CONSTRAINT `monitoring_ibfk_1` FOREIGN KEY (`NIS`) REFERENCES `siswa` (`NIS`),
  ADD CONSTRAINT `monitoring_ibfk_2` FOREIGN KEY (`kode_kelompok`) REFERENCES `kelompok` (`kode_kelompok`),
  ADD CONSTRAINT `monitoring_ibfk_3` FOREIGN KEY (`konsentrasi_keahlian`) REFERENCES `siswa` (`konsentrasi_keahlian`),
  ADD CONSTRAINT `monitoring_ibfk_4` FOREIGN KEY (`kode_dudi`) REFERENCES `dudi` (`kode_dudi`);

--
-- Constraints for table `nilai_pkl`
--
ALTER TABLE `nilai_pkl`
  ADD CONSTRAINT `nilai_pkl_ibfk_1` FOREIGN KEY (`kode_kelompok`) REFERENCES `kelompok` (`kode_kelompok`),
  ADD CONSTRAINT `nilai_pkl_ibfk_2` FOREIGN KEY (`NIS`) REFERENCES `siswa` (`NIS`),
  ADD CONSTRAINT `nilai_pkl_ibfk_3` FOREIGN KEY (`konsentrasi_keahlian`) REFERENCES `siswa` (`konsentrasi_keahlian`);

--
-- Constraints for table `pengajuan`
--
ALTER TABLE `pengajuan`
  ADD CONSTRAINT `pengajuan_ibfk_1` FOREIGN KEY (`NIS`) REFERENCES `siswa` (`NIS`);

--
-- Constraints for table `ploting`
--
ALTER TABLE `ploting`
  ADD CONSTRAINT `ploting_ibfk_1` FOREIGN KEY (`kode_kelompok`) REFERENCES `kelompok` (`kode_kelompok`),
  ADD CONSTRAINT `ploting_ibfk_2` FOREIGN KEY (`NIP_NIK`) REFERENCES `pembimbing` (`NIP_NIK`),
  ADD CONSTRAINT `ploting_ibfk_3` FOREIGN KEY (`kode_dudi`) REFERENCES `dudi` (`kode_dudi`),
  ADD CONSTRAINT `ploting_ibfk_4` FOREIGN KEY (`NIS`) REFERENCES `siswa` (`NIS`);

--
-- Constraints for table `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `siswa_ibfk_1` FOREIGN KEY (`konsentrasi_keahlian`) REFERENCES `konsentrasi_keahlian` (`kode_konsentrasi`),
  ADD CONSTRAINT `siswa_ibfk_2` FOREIGN KEY (`kode_kelompok`) REFERENCES `kelompok` (`kode_kelompok`),
  ADD CONSTRAINT `siswa_ibfk_3` FOREIGN KEY (`kode_dudi`) REFERENCES `dudi` (`kode_dudi`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
