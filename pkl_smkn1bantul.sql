-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 17, 2024 at 04:28 AM
-- Server version: 8.0.30
-- PHP Version: 8.2.23

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
  `surat_pengajuan` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dudi`
--

CREATE TABLE `dudi` (
  `kode_dudi` varchar(10) NOT NULL,
  `nama_dudi` varchar(100) NOT NULL,
  `bidang_usaha` varchar(20) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `alamat_dudi` text NOT NULL,
  `notelp_dudi` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `posisi_pkl` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `dudi`
--

INSERT INTO `dudi` (`kode_dudi`, `nama_dudi`, `bidang_usaha`, `password`, `alamat_dudi`, `notelp_dudi`, `posisi_pkl`) VALUES
('TI001', 'Red\'s Computer', NULL, '$2y$12$gxktJswkSbCqrQBESlLlye2oYi2OVGHWgxjdE0qQkWjieJ8W/jp9K', 'Jl. Jogoripon, Geneng, Pendowoharjo, Sewon, Bantul, Yogyakarta 55188', '', NULL),
('TI002', 'CV Latansa Jogjakarta', 'Teknologi', '$2y$12$yDoVzWjBXDGsRXZ69PP4xexCCvvGrgbWERGqnH4SQ7DuBe6b3I4Zm', 'Nangsri RT 02, Srihardono Pundong, Bantul, Yogyakarta 55771', '86761132', NULL),
('TI003', 'ALBIS Jogja', 'Teknologi', '$2y$12$lxbk3Okl.xXQI9JQxyoXyOtAEF74YJD9Hcw/PVFqrqI1y0ktesI3u', 'Jl. Parangtritis No.7,5, Cabean, Panggungharjo, Sewon, Bantul, Yogyakarta 55185', '67474', NULL),
('TI004', 'Harrisma Computer', NULL, '$2y$12$8PKgOEbTWInto0nt3YjpqOuymzkXJJBMlXtk2AtkGsDDlIEvu81n2', 'Jl. C. Simanjuntak No.33-37, Terban, Gondokusuman, Yogyakarta 55223', '', NULL),
('TI005', 'RR COMPUTER', 'Teknologi', '$2y$12$sxO71dvVrBZYiEzP8KLW6.JDWxgCBR/UaRTYrXqnYLhYVg4aKE2AW', 'Jl. Pandeyan No.32, Pandeyan, Umbulharjo, Yogyakarta 55161', '86761132', NULL);

--
-- Triggers `dudi`
--
DELIMITER $$
CREATE TRIGGER `update_laporan_jurnal_after_update_dudi` AFTER UPDATE ON `dudi` FOR EACH ROW BEGIN
    UPDATE laporan_jurnal lj
    JOIN ploting p ON lj.NIS = p.NIS
    SET lj.nama_dudi = NEW.nama_dudi,
        lj.alamat_dudi = NEW.alamat_dudi
    WHERE p.kode_dudi = NEW.kode_dudi;
END
$$
DELIMITER ;

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

--
-- Dumping data for table `kelompok`
--

INSERT INTO `kelompok` (`kode_kelompok`) VALUES
('TKJ1');

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
  `tanggal` timestamp NULL DEFAULT NULL,
  `NIS` varchar(15) DEFAULT NULL,
  `kode_dudi` varchar(10) DEFAULT NULL,
  `nama_siswa` varchar(100) DEFAULT NULL,
  `nama_dudi` varchar(100) DEFAULT NULL,
  `kegiatan` text,
  `lokasi` varchar(255) DEFAULT NULL,
  `kelas` varchar(255) DEFAULT NULL,
  `kode_kelompok` varchar(255) DEFAULT NULL,
  `konsentrasi_keahlian` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `alamat_dudi` varchar(255) DEFAULT NULL,
  `NIP_NIK` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `laporan_jurnal`
--

INSERT INTO `laporan_jurnal` (`id_jurnal`, `tanggal`, `NIS`, `kode_dudi`, `nama_siswa`, `nama_dudi`, `kegiatan`, `lokasi`, `kelas`, `kode_kelompok`, `konsentrasi_keahlian`, `created_at`, `updated_at`, `alamat_dudi`, `NIP_NIK`) VALUES
(1, NULL, '16728', NULL, 'MUHAMMAD AKMAL RASYID', 'Red\'s Computer', 'instalasi software', 'Sumber Agung, Sumberagung, Jetis, Bantul, Daerah Istimewa Yogyakarta, Jawa, 55715, Indonesia', 'XI TKJ 2', 'TKJ3', 'Teknik Komputer dan Jaringan (TKJ)', '2024-10-15 03:43:56', '2024-10-15 03:43:56', NULL, NULL),
(2, '2024-10-16 02:03:50', '16728', NULL, 'MUHAMMAD AKMAL RASYID', 'Red\'s Computer', 'hardware', 'Jalan Pawiyatan Luhur Selatan II, RW 01, Bendan Duwur, Gajah Mungkur, Semarang, Jawa Tengah, Jawa, 50231, Indonesia', 'XI TKJ 2', NULL, 'Teknik Komputer dan Jaringan (TKJ)', '2024-10-16 02:03:50', '2024-10-16 02:03:50', NULL, NULL);

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
  `nilai` text NOT NULL,
  `is_imported` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pembimbing`
--

CREATE TABLE `pembimbing` (
  `NIP_NIK` varchar(20) NOT NULL,
  `nama_pembimbing` varchar(100) NOT NULL,
  `jenis_kelamin` varchar(10) DEFAULT NULL,
  `jabatan` varchar(50) DEFAULT NULL,
  `alamat` text,
  `no_telp` varchar(15) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pembimbing`
--

INSERT INTO `pembimbing` (`NIP_NIK`, `nama_pembimbing`, `jenis_kelamin`, `jabatan`, `alamat`, `no_telp`, `password`, `created_at`, `updated_at`) VALUES
('196706051997021002', 'SUJAR HARTONO S.Pd.', NULL, NULL, NULL, NULL, '$2y$12$unVU8A0X1daqHwk2AwjyvuD.gViebaaOBbfl6/0YomzbGxlnW7.fi', '2024-10-07 02:06:32', '2024-10-15 08:25:22'),
('196709222007012012', 'MULATI S.Pd.', 'Perempuan', 'Guru Muda', '', NULL, '$2y$12$I4C2hUQrv5jnP4lnR2TVBe8XbsZQRgJyPyPxaj2mPM5BvGf3tfGi.', '2024-10-11 07:35:38', '2024-10-11 07:35:38'),
('197410222008012005', 'MURDIASIH KADARWATIS.Pd', 'Perempuan', 'Guru Muda', 'bsgsj', '91827', '$2y$12$PvzBaBFV6Hj7d/ZL.ZwlSOjBb8ZGDzl/RCqI4qzb.PLyomHwb6AC2', '2024-10-11 09:33:40', '2024-10-11 09:33:40'),
('197604052024211002', 'RUSDIYANTO, S.Pd', 'Laki-laki', 'PPPK', '', NULL, '$2y$12$rJrUYzIrI4F3PcPlxD89WOy1wtIpvGpBmR0FtGPv3.Zng6m2SPqr2', '2024-10-11 07:29:17', '2024-10-15 08:36:19'),
('197812072014062002', 'DARIYATI, S.KOM', NULL, NULL, NULL, NULL, '$2y$12$nMVwGGV2XQzQ6Q5/z420e.UCuRyOH6ABBhEfWRcnJOWFh7G0SKeby', '2024-10-07 02:06:32', '2024-10-07 02:06:32'),
('198810272023211007', 'ROHMAD DWIYANTO S.Pd', 'Laki-laki', 'PPPK', '', NULL, '$2y$12$hpj92Gj8jJhmQCMEEaKllOwoA866Alfe/9xh5L8QuTZtXH0p9tq8S', '2024-10-11 07:29:17', '2024-10-11 07:29:17'),
('199003202024211002', 'DUWI RIANTO S. Pd.', 'Laki-laki', 'PPPK', '', NULL, '$2y$12$ikFgZJv.i9QRZhaJgka4vOu6LnXO1bce12TXoOkIioEZurw/sydfu', '2024-10-11 07:29:17', '2024-10-11 07:29:17'),
('199310252024211004', 'MUHAMMAD FURQON S.Sos', 'Laki-laki', 'PPPK', '', NULL, '$2y$12$L4R7vj4KPlzzX.ysQOvJyOJizzScveVn61aWDoWH2Lx4XmwSz85y2', '2024-10-15 02:48:55', '2024-10-15 02:48:55'),
('199804102024212010', 'RISA RESTI AFRIANI S. Pd.', 'Perempuan', 'PPPK', 'sleman', '1223456789', '$2y$12$6grHfHo5hPuN7qqM3dSI4OVCYgoY02nb0BBO.5kW3qXTY7NXlYFPe', '2024-10-12 09:01:14', '2024-10-12 09:01:14');

--
-- Triggers `pembimbing`
--
DELIMITER $$
CREATE TRIGGER `update_nip_nik_after_update` AFTER UPDATE ON `pembimbing` FOR EACH ROW BEGIN
    UPDATE laporan_jurnal lj
    JOIN ploting p ON lj.NIS = p.NIS
    SET lj.NIP_NIK = NEW.NIP_NIK
    WHERE p.nama_pembimbing = NEW.nama_pembimbing;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `pengajuan`
--

CREATE TABLE `pengajuan` (
  `id_pengajuan` int NOT NULL,
  `NIS` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `nama_siswa` varchar(100) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `tempat_pkl` varchar(100) DEFAULT NULL,
  `notelp_dudi` varchar(15) DEFAULT NULL,
  `proposal_pkl` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pengajuan`
--

INSERT INTO `pengajuan` (`id_pengajuan`, `NIS`, `nama_siswa`, `no_telp`, `tempat_pkl`, `notelp_dudi`, `proposal_pkl`) VALUES
(5, NULL, 'RESTU AGUS JATMIKO,\r\nNUR DWI CAHYO,\r\nMUHAMMAD AKMAL RASYID', '1223456789', 'Red\'s Computer', NULL, 'proposals/jYZxbCHNZERAW19aYXFWKS1tkv0SIjzxdhMxOTVT.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `pengajuan_siswa`
--

CREATE TABLE `pengajuan_siswa` (
  `id_pengajuan` int NOT NULL,
  `nis` varchar(25) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pengajuan_siswa`
--

INSERT INTO `pengajuan_siswa` (`id_pengajuan`, `nis`, `created_at`, `updated_at`) VALUES
(5, '16728', '2024-10-16 05:36:22', '2024-10-16 05:36:22'),
(5, '16732', '2024-10-16 05:36:22', '2024-10-16 05:36:22'),
(5, '16735', '2024-10-16 05:36:22', '2024-10-16 05:36:22');

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
  `notelp_dudi` varchar(15) DEFAULT NULL,
  `nama_siswa` varchar(255) DEFAULT NULL,
  `alamat_dudi` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ploting`
--

INSERT INTO `ploting` (`id_ploting`, `kode_kelompok`, `NIP_NIK`, `nama_pembimbing`, `kode_dudi`, `nama_dudi`, `NIS`, `kelas`, `notelp_dudi`, `nama_siswa`, `alamat_dudi`) VALUES
(4, 'TKJ1', '196706051997021002', 'SUJAR HARTONO S.Pd.', 'TI002', 'CV Latansa Jogjakarta', '16674', 'XI TKJ 1', '86761132', 'ADITYA ARBAYU', 'Nangsri RT 02, Srihardono Pundong, Bantul, Yogyakarta 55771'),
(6, 'TKJ1', '196706051997021002', 'SUJAR HARTONO S.Pd.', 'TI002', 'CV Latansa Jogjakarta', '16683', 'XI TKJ 1', '86761132', 'FAWWAZ BAGDI PRASTOWO AKBAR', 'Nangsri RT 02, Srihardono Pundong, Bantul, Yogyakarta 55771'),
(12, 'TKJ2', '197812072014062002', 'Dariyati, S.Kom', 'TI003', 'ALBIS Jogja', '16727', 'XI TKJ 2', '67474', 'MIFTAH ABIT RAKHALANA', 'Jl. Parangtritis No.7,5, Cabean, Panggungharjo, Sewon, Bantul, Yogyakarta 55185'),
(13, 'TKJ2', '197812072014062002', 'Dariyati, S.Kom', 'TI003', 'ALBIS Jogja', '16733', 'XI TKJ 2', '67474', 'RAHMAT DIKY ALFIANZAH', 'Jl. Parangtritis No.7,5, Cabean, Panggungharjo, Sewon, Bantul, Yogyakarta 55185'),
(14, 'TKJ2', '197812072014062002', 'Dariyati, S.Kom', 'TI003', 'ALBIS Jogja', '16711', 'XI TKJ 2', '67474', 'ADE DANI OKTAVIAN', 'Jl. Parangtritis No.7,5, Cabean, Panggungharjo, Sewon, Bantul, Yogyakarta 55185'),
(15, 'TKJ3', '197604052024211002', 'Rusdiyanto, S.Pd', 'TI001', 'Red\'s Computer', '16735', 'XI TKJ 2', '', 'RESTU AGUS JATMIKO', 'Jl. Jogoripon, Geneng, Pendowoharjo, Sewon, Bantul, Yogyakarta 55188'),
(16, 'TKJ3', '197604052024211002', 'Rusdiyanto, S.Pd', 'TI001', 'Red\'s Computer', '16732', 'XI TKJ 2', '', 'NUR DWI CAHYO', 'Jl. Jogoripon, Geneng, Pendowoharjo, Sewon, Bantul, Yogyakarta 55188'),
(17, 'TKJ3', '197604052024211002', 'Rusdiyanto, S.Pd', 'TI001', 'Red\'s Computer', '16728', 'XI TKJ 2', '', 'MUHAMMAD AKMAL RASYID', 'Jl. Jogoripon, Geneng, Pendowoharjo, Sewon, Bantul, Yogyakarta 55188'),
(18, 'TKJ4', '198810272023211007', 'Rohmad Dwiyanto S.Pd', 'TI004', 'Harrisma Computer', '16723', 'XI TKJ 2', '', 'ILHAM KURNIA PUTRA PRAPANCA', 'Jl. C. Simanjuntak No.33-37, Terban, Gondokusuman, Yogyakarta 55223'),
(19, 'TKJ4', '198810272023211007', 'Rohmad Dwiyanto S.Pd', 'TI004', 'Harrisma Computer', '16719', 'XI TKJ 2', '', 'DAFFA RIFKY HAIDAR GHAZWAN', 'Jl. C. Simanjuntak No.33-37, Terban, Gondokusuman, Yogyakarta 55223'),
(20, 'TKJ4', '198810272023211007', 'Rohmad Dwiyanto S.Pd', 'TI004', 'Harrisma Computer', '16713', 'XI TKJ 2', '', 'AIS KHOIRUL RIFAN', 'Jl. C. Simanjuntak No.33-37, Terban, Gondokusuman, Yogyakarta 55223');

--
-- Triggers `ploting`
--
DELIMITER $$
CREATE TRIGGER `update_laporan_jurnal_after_insert` AFTER INSERT ON `ploting` FOR EACH ROW BEGIN
    UPDATE laporan_jurnal lj
    JOIN siswa s ON lj.NIS = s.NIS
    JOIN ploting p ON s.NIS = p.NIS
    JOIN dudi d ON p.kode_dudi = d.kode_dudi
    SET lj.kode_kelompok = p.kode_kelompok,
        lj.nama_dudi = d.nama_dudi,
        lj.alamat_dudi = d.alamat_dudi
    WHERE lj.NIS = NEW.NIS;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_nip_nik_after_insert` AFTER INSERT ON `ploting` FOR EACH ROW BEGIN
    UPDATE laporan_jurnal lj
    JOIN siswa s ON lj.NIS = s.NIS
    JOIN ploting p ON s.NIS = p.NIS
    JOIN pembimbing pb ON p.nama_pembimbing = pb.nama_pembimbing
    SET lj.NIP_NIK = pb.NIP_NIK
    WHERE lj.NIS = NEW.NIS;
END
$$
DELIMITER ;

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
('fh2HUxecUqWzupYTl3Z8bHJcA2BF0gm1sfJdAJZs', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiajZ4Znl1SEROSFJiYXZKbm9PSG9tOXVOam9icngxYjVYRlB1MFpxSyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTI6ImxvZ2luX3Npc3dhXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO3M6NToiMTY3MjgiO30=', 1729103986),
('Zphos5s1XFznlaTpwIe1vg5vfMHiZOxVB4aGpOvC', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieGhaRUgyUGVEeEpXemF0alB0Vkl0RnBBNmFsRHZPNGNubk9tWW81NiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1729139210);

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `NIS` varchar(15) NOT NULL,
  `nama_siswa` varchar(100) NOT NULL,
  `konsentrasi_keahlian` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `kelas` varchar(10) NOT NULL,
  `tahun` varchar(10) DEFAULT NULL,
  `kode_kelompok` varchar(10) DEFAULT NULL,
  `kode_dudi` varchar(10) DEFAULT NULL,
  `nama_dudi` varchar(100) DEFAULT NULL,
  `alamat_dudi` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`NIS`, `nama_siswa`, `konsentrasi_keahlian`, `password`, `profile_picture`, `kelas`, `tahun`, `kode_kelompok`, `kode_dudi`, `nama_dudi`, `alamat_dudi`, `created_at`, `updated_at`) VALUES
('16674', 'ADITYA ARBAYU', 'Teknik Komputer dan Jaringan (TKJ)', 'pw16674', NULL, 'XI TKJ 1', '2023/2024', 'TKJ1', 'TI002', 'CV Latansa Jogjakarta', 'Nangsri RT 02, Srihardono Pundong, Bantul, Yogyakarta 55771', '2024-10-07 02:09:51', '2024-10-15 05:55:39'),
('16683', 'FAWWAZ BAGDI PRASTOWO AKBAR', 'Teknik Komputer dan Jaringan (TKJ)', 'pw16683', NULL, 'XI TKJ 1', '2023/2024', 'TKJ1', 'TI002', 'CV Latansa Jogjakarta', 'Nangsri RT 02, Srihardono Pundong, Bantul, Yogyakarta 55771', '2024-10-07 02:09:52', '2024-10-15 05:55:39'),
('16690', 'INKA RAHMAWATI', 'Teknik Komputer dan Jaringan (TKJ)', '$2y$12$Q6DN4h/0WlzdA2idfLJ/I.ngmJSAjLtpjgMvsvDuEkHPipKE/bsSu', NULL, 'XI TKJ 1', '2023/2024', NULL, NULL, NULL, NULL, '2024-10-11 10:04:10', '2024-10-11 10:04:10'),
('16711', 'ADE DANI OKTAVIAN', 'Teknik Komputer dan Jaringan (TKJ)', 'pw16711', NULL, 'XI TKJ 2', '2023/2024', 'TKJ2', 'TI003', 'ALBIS Jogja', 'Jl. Parangtritis No.7,5, Cabean, Panggungharjo, Sewon, Bantul, Yogyakarta 55185', '2024-10-07 02:14:45', '2024-10-15 05:55:39'),
('16713', 'AIS KHOIRUL RIFAN', 'Teknik Komputer dan Jaringan (TKJ)', '$2y$12$z0pfrd5T6Wr1E.521MqK/OE/zddiDW6emOoC3IvSWgJ8sip7Pw0aa', NULL, 'XI TKJ 2', '2023/2024', NULL, NULL, NULL, NULL, '2024-10-09 02:41:52', '2024-10-09 02:41:52'),
('16719', 'DAFFA RIFKY HAIDAR GHAZWAN', 'Teknik Komputer dan Jaringan (TKJ)', '$2y$12$lqMNjIoTvVV3KyYRiEj0.udHhl9rvpPmdio8dCYjFJfGNdUqv4xzu', NULL, 'XI TKJ 2', '2023/2024', NULL, NULL, NULL, NULL, '2024-10-09 02:41:52', '2024-10-09 02:41:52'),
('16720', 'DESTA DWIANGGA', 'Teknik Komputer dan Jaringan (TKJ)', '$2y$12$RXq3DbEP6dU4cV7pbJLrdOK2.7wY2/iyoLA1Ad2y8oAoY.m2930IG', NULL, 'XI TKJ 2', '2023/2024', NULL, NULL, NULL, NULL, '2024-10-12 08:51:18', '2024-10-12 08:51:18'),
('16723', 'ILHAM KURNIA PUTRA PRAPANCA', 'Teknik Komputer dan Jaringan (TKJ)', '$2y$12$M.1120oDwAKX4Xfsp6zREuvNWrrXjHs218CXjMv/nhwNK0Q0ozbxK', NULL, 'XI TKJ 2', '2023/2024', NULL, NULL, NULL, NULL, '2024-10-09 02:41:51', '2024-10-09 02:41:51'),
('16726', 'MEYSA TUNGGAL KHARISTA', 'Teknik Komputer dan Jaringan (TKJ)', '$2y$12$QCg./QKRX4v8iytgz50pNebfUlcdS1E8f09gapMco7WsErHHshpbC', NULL, 'XI TKJ 2', '2023/2024', NULL, NULL, NULL, NULL, '2024-10-15 02:48:05', '2024-10-15 02:48:05'),
('16727', 'MIFTAH ABIT RAKHALANA', 'Teknik Komputer dan Jaringan (TKJ)', 'pw16727', NULL, 'XI TKJ 2', '2023/2024', 'TKJ2', 'TI003', 'ALBIS Jogja', 'Jl. Parangtritis No.7,5, Cabean, Panggungharjo, Sewon, Bantul, Yogyakarta 55185', '2024-10-07 02:14:44', '2024-10-15 05:55:39'),
('16728', 'MUHAMMAD AKMAL RASYID', 'Teknik Komputer dan Jaringan (TKJ)', '$2y$12$ONbN0hq4wFa2anP2s5LE6./O4oGDELnY1nplzKVZQrauLGb0l4HYa', '', 'XI TKJ 2', '2023/2024', 'TKJ3', 'TI001', 'Red\'s Computer', 'Jl. Jogoripon, Geneng, Pendowoharjo, Sewon, Bantul, Yogyakarta 55188', '2024-10-07 00:31:17', '2024-10-15 03:11:16'),
('16731', 'NABILA NUR RIYANTA', 'Teknik Komputer dan Jaringan (TKJ)', '$2y$12$t6K5PM.q6eKPcmMeIphgtOjLG0ITHaUgrd0mcNNnOJRGM31OFFi4q', NULL, 'XI TKJ 2', '2023/2024', NULL, NULL, NULL, NULL, '2024-10-11 09:57:38', '2024-10-11 09:57:38'),
('16732', 'NUR DWI CAHYO', 'Teknik Komputer dan Jaringan (TKJ)', 'pw16732', NULL, 'XI TKJ 2', '2023/2024', 'TKJ3', 'TI001', 'Red\'s Computer', 'Jl. Jogoripon, Geneng, Pendowoharjo, Sewon, Bantul, Yogyakarta 55188', '2024-10-07 00:31:17', '2024-10-15 05:55:39'),
('16733', 'RAHMAT DIKY ALFIANZAH', 'Teknik Komputer dan Jaringan (TKJ)', 'pw16733', NULL, 'XI TKJ 2', '2023/2024', 'TKJ2', 'TI003', 'ALBIS Jogja', 'Jl. Parangtritis No.7,5, Cabean, Panggungharjo, Sewon, Bantul, Yogyakarta 55185', '2024-10-07 02:14:44', '2024-10-15 05:55:39'),
('16735', 'RESTU AGUS JATMIKO', 'Teknik Komputer dan Jaringan (TKJ)', 'pw16735', NULL, 'XI TKJ 2', '2023/2024', 'TKJ3', 'TI001', 'Red\'s Computer', 'Jl. Jogoripon, Geneng, Pendowoharjo, Sewon, Bantul, Yogyakarta 55188', '2024-10-07 00:31:16', '2024-10-15 05:55:39'),
('16736', 'RIZKI WAHYU NURRAHMAN', 'Teknik Komputer dan Jaringan (TKJ)', '$2y$12$TOGcgDFkUFz2H2aQKQuE6uuaSi2W9M.wOIdtISybucr3ucHcg9Rf6', NULL, 'XI TKJ 2', '2023/2024', NULL, NULL, NULL, NULL, '2024-10-12 08:51:19', '2024-10-15 08:02:22'),
('16740', 'TEGUH FIRMANSYAH', 'Teknik Komputer dan Jaringan (TKJ)', '$2y$12$xcT2mtD8GYDNOox7hRRdX.39XtLKd6dDGtLPQXAK2/cpqMTqd3RQ6', NULL, 'XI TKJ 2', '2023/2024', NULL, NULL, NULL, NULL, '2024-10-12 08:51:19', '2024-10-15 08:02:00'),
('17754', 'NAYLA EMMA WAHYUNINGTIYAS', 'Teknik Komputer dan Jaringan (TKJ)', '$2y$12$rhBMLb.6yChMXHfURWWCsuzWWR..a8L5PGalnlE/NFe934Vpa0dAO', NULL, 'XI TKJ 2', '2023/2024', NULL, NULL, NULL, NULL, '2024-10-15 02:48:05', '2024-10-15 02:48:05');

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
  ADD PRIMARY KEY (`kode_admin`),
  ADD KEY `fk_surat_pengajuan` (`surat_pengajuan`);

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
-- Indexes for table `pengajuan_siswa`
--
ALTER TABLE `pengajuan_siswa`
  ADD PRIMARY KEY (`id_pengajuan`,`nis`),
  ADD KEY `fk_siswa` (`nis`);

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
  ADD KEY `kode_dudi` (`kode_dudi`),
  ADD KEY `konsentrasi_keahlian_2` (`konsentrasi_keahlian`);

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
  MODIFY `id_jurnal` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `id_pengajuan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ploting`
--
ALTER TABLE `ploting`
  MODIFY `id_ploting` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `fk_surat_pengajuan` FOREIGN KEY (`surat_pengajuan`) REFERENCES `pengajuan` (`id_pengajuan`);

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
-- Constraints for table `pengajuan_siswa`
--
ALTER TABLE `pengajuan_siswa`
  ADD CONSTRAINT `fk_pengajuan` FOREIGN KEY (`id_pengajuan`) REFERENCES `pengajuan` (`id_pengajuan`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_siswa` FOREIGN KEY (`nis`) REFERENCES `siswa` (`NIS`) ON DELETE CASCADE;

--
-- Constraints for table `ploting`
--
ALTER TABLE `ploting`
  ADD CONSTRAINT `ploting_ibfk_4` FOREIGN KEY (`NIS`) REFERENCES `siswa` (`NIS`);

--
-- Constraints for table `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `siswa_ibfk_1` FOREIGN KEY (`konsentrasi_keahlian`) REFERENCES `siswa` (`konsentrasi_keahlian`),
  ADD CONSTRAINT `siswa_ibfk_3` FOREIGN KEY (`kode_dudi`) REFERENCES `ploting` (`kode_dudi`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `siswa_ibfk_4` FOREIGN KEY (`kode_kelompok`) REFERENCES `ploting` (`kode_kelompok`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `siswa_ibfk_5` FOREIGN KEY (`kode_dudi`) REFERENCES `dudi` (`kode_dudi`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
