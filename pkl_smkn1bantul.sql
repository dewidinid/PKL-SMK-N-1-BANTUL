-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 07, 2024 at 04:07 PM
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
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`kode_admin`, `password`) VALUES
('ADMIN', '$2y$12$NRBiTjRACIMzun1iCCF2ZOeNhTVDnkB94b7Wkt3PAyCbojNyTGsZC');

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
  `notelp_dudi` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `dudi`
--

INSERT INTO `dudi` (`kode_dudi`, `nama_dudi`, `bidang_usaha`, `password`, `alamat_dudi`, `notelp_dudi`) VALUES
('TI001', 'Reds Computer', 'Teknologi', '$2y$12$gxktJswkSbCqrQBESlLlye2oYi2OVGHWgxjdE0qQkWjieJ8W/jp9K', 'Jl. Jogoripon, Geneng, Pendowoharjo, Sewon, Bantul, Yogyakarta 55188', '19182746'),
('TI002', 'CV Latansa Jogjakarta', 'Teknologi', '$2y$12$yDoVzWjBXDGsRXZ69PP4xexCCvvGrgbWERGqnH4SQ7DuBe6b3I4Zm', 'Nangsri RT 02, Srihardono Pundong, Bantul, Yogyakarta 55771', '86761132'),
('TI003', 'ALBIS Jogja', 'Teknologi', '$2y$12$lxbk3Okl.xXQI9JQxyoXyOtAEF74YJD9Hcw/PVFqrqI1y0ktesI3u', 'Jl. Parangtritis No.7,5, Cabean, Panggungharjo, Sewon, Bantul, Yogyakarta 55185', '67474355'),
('TI004', 'Harrisma Computer', 'Teknologi', '$2y$12$8PKgOEbTWInto0nt3YjpqOuymzkXJJBMlXtk2AtkGsDDlIEvu81n2', 'Jl. C. Simanjuntak No.33-37, Terban, Gondokusuman, Yogyakarta 55223', '13124356'),
('TI005', 'RR COMPUTER', 'Teknologi', '$2y$12$sxO71dvVrBZYiEzP8KLW6.JDWxgCBR/UaRTYrXqnYLhYVg4aKE2AW', 'Jl. Pandeyan No.32, Pandeyan, Umbulharjo, Yogyakarta 55161', '86761132'),
('TI006', 'Azzam Computer', 'Teknologi', '$2y$12$nfvikF9CNzinn0bP0N/eTuh5RNtKoK8wRT2UCi6atzlQ3BfcnZpTi', 'Jl. IKIP PGRI I Sonosewu No.248, Sonosewu, Ngestiharjo, Kasihan, Bantul, Yogyakarta', '86761132'),
('TI007', 'Doctor Laptop Jogja', 'Teknologi', '$2y$12$7d94zvLGuDAwdVbU5ZLD8eZNSEc7ZPk5jzHGn6BtwjwmXMvkhKQ3y', 'Jl. Menteri Supeno No.100, Pandeyan, Umbulharjo, Kota Yogyakarta, Yogyakarta 55161', '124214'),
('TI008', 'Youvee Computer', 'Teknologi', '$2y$12$GX.Ss/O.85qX6EMywPbqSOjkulUzceh/ZV8bZsVvDwbBL95i1BSAu', 'Jl. Madukismo, Padokan Lor, Tirtonirmolo, Kasihan, Bantul, Yogyakarta 55181', '92827363'),
('TI009', 'PT. Broadband Indonesia Pratama (BIPNET)', 'Teknologi', '$2y$12$zqXsoiApvdnUDB5UrAUyB.ewSXbaU7ZFXqqvc.v6neCSwt6/xzaFe', 'Jl. Purbayan No.6, Purbayan, Kotagede, Kota Yogyakarta, Yogyakarta 55173', '8171629182'),
('TI010', 'PT. Gmedia Prime Building', 'Teknologi', '$2y$12$vBXuqkjM6Ko26sV3rdzb7O8/ksFdnLn.yxF58pkmXBAy43DrF3co.', 'Jl. Siliwangi No.32G, Nogotirto, Gamping, Sleman, Yogyakarta 55592', '132453657'),
('TI011', 'AIR NET ( CV. Buana Nirwana Jaya )', 'Teknologi', '$2y$12$GbG2J0/ARRIG4aqulW2Ci.XJg8BTVIXEXKcDvkEibBUH73f2yyOCq', 'Kepuh, Mulyodadi, Bambanglipuro, Bantul, Yogyakarta 55764', '646344247'),
('TI012', 'PT Jaringan Lintas Utara (JATARA)', 'Teknologi', '$2y$12$/REm3H1uEKLISzMoQ.rYW.NYmv76RhWBz6E/DNTkAHgPvide9IV7a', 'Jl. Gading Sari II No.21, Banyuraden, Gamping, Sleman, Yogyakarta 55293', '756745322'),
('TI013', 'PT. Wahana Lintas Nusa Persada', 'Teknologi', '$2y$12$hOquT3nqVvhZquZAKVJz5ujKoHKMDTarVqFA5napzmcTjgQx71Ul.', 'Jl. Lempongsari Raya No.132, Jongkang, Sariharjo, Ngaglik, Sleman, Yogyakarta 55281', '899163181'),
('TI014', 'Life Medianet', 'Teknologi', '$2y$12$zSSF7x0ylLpffq1pNsxeY.eber1qEGRk1.OJFBO5z.2IW//OLbFJW', 'Jl. Parangtritis No.97, Brontokusuman, Mergangsan, Kota Yogyakarta, Yogyakarta 55153', '028172633531'),
('TI015', 'PT. Yetoya Solusi Indonesia (Jujungnet)', 'Teknologi', '$2y$12$kEIPG7EBDQdA6fpaGp2iU.IKYszkzTWovqxF8A5/ot1NdGyGqYPOC', 'Jl. Ringroad Timur No.14B, Wonocatur, Banguntapan, Banguntapan, Bantul, Yogyakarta 55198', ''),
('TI016', 'PT. DINAMIKA MEDIAKOM', 'Teknologi', '$2y$12$2eWtsvRCUYCmUnUpPI2lpuSJDWw9fIAgqnuBtARxgw4eqtf.KmCXW', 'Jl. Raya Kledokan No.38, Kledokan, Caturtunggal, Depok, Sleman, Yogyakarta 55281', ''),
('TI017', 'CITRANET', 'Teknologi', '$2y$12$noangKxEGY.XcAONaFk3ROlXNuuogdbD1PblPdBoAbr9EUb/w9lfO', 'Jl. Petung No.31, Demangan Baru, Caturtunggal, Depok, Sleman, Yogyakarta 55281', '081972363'),
('TI018', 'CSS Media - PT Cahaya Sinergi Semesta', 'Teknologi', '$2y$12$lgrwxw0Z4KQhUkPAR8fJIu53rZfr/o1Nowu4qwitZbrL7HUGV9e9S', 'Jl. Imogiri Barat KM11 No.101A, Bantul, Yogyakarta 55781', ''),
('TI019', 'PT.Global Prima Utama (UIINET)', 'Teknologi', '$2y$12$0nHur59iJZEmUJjCm42Ng.CFeVxOLHaqkTAjd9KNVyTkz6/7Vr3Lm', 'Jl. Cik Di Tiro No 1, Terban, Kec. Gondokusuman, Kota Yogyakarta, Daerah Istimewa Yogyakarta 55223', ''),
('TI020', 'Mahameru Computer', 'Teknologi', '$2y$12$uOugo54wsP.J11su3jEYxO3ufFNtbD4El1Sv9vBH6EuLyrgIBgIB.', 'Jl. Imogiri Timur No.KM 11 Karanganom RT 08 Karanganom, Wonokromo, Pleret, Bantul, Yogyakarta 55791', ''),
('TI021', 'AFTROCOM (Servis Laptop Jogja - Servis Komputer Jogja)', 'Teknologi', '$2y$12$AUuH9OKv5P10V3owaQAsruB5ngBh28gsXp9Y3I9m.gKg1DcCxzADu', 'Jl. KH Djawad Faqih MG III No.851, Brontokusuman, Mergangsan, Kota Yogyakarta, Yogyakarta 55153', ''),
('TI022', 'RAZKA NET', 'Teknologi', '$2y$12$tCxzdV0n5.2CCrc4ZIIfyOe7Zv6BHPkN7G4mriXcUywZgsag30xeW', 'Grudo Rt 04, Grudo, Panjangrejo, Pundong, Bantul, Yogyakarta 55771', ''),
('TI023', 'Bestcamp Network', 'Teknologi', '$2y$12$i2WNyve1SpzwSTX5DM2QyOAJMBAz7i.7S2eMopD.lB4m/5D5y0Sj.', 'Karang Tengah Kidul, Margosari, Pengasih, Kulon Progo, Yogyakarta 55652', ''),
('TI024', 'Tren Komputer Yogyakarta', 'Teknologi', '$2y$12$CK0YMp4EHCC/jFYBdmrZZOHAnER5pGGVKO14P.z9Ijzja3yBBAwP6', 'Jl. Tri Brata No.11, RW.02, Klitren, Gondokusuman, Kota Yogyakarta, Yogyakarta 55221', ''),
('TI025', 'AR Computer', 'Teknologi', '$2y$12$ECfZuGKluSXoXTl7tvUbgeL4Ukw36g9PP468pUjiLPu8kdUsZ0PEq', 'Jl. Ambarbinangun No.256, Brajan, Tamantirto, Kasihan, Bantul, Yogyakarta 55184', ''),
('TI026', 'PONDOK NETWORK', 'Teknologi', '$2y$12$cuhKzcn6SYCwZbc6FHDnceWdoaSPiOWFuxtzPCUk/Ko1eX./93T0.', 'Pondok, Trimurti Srandakan Bantul Yogyakarta 55762', ''),
('TI027', 'Dary Computer', 'Teknologi', '$2y$12$U5XS9knVYlZilMyJxL/13utWYMssTY10qORemyi5ElscBc/RmlcC2', 'najhaja', '86544'),
('TI028', 'AMBAR CORP', 'Teknologi', '$2y$12$1IoU5o3oeikBfteqMaZBxeh2LrxuSk07XVf5N2TNo9iJMxj5tDDca', 'majhadjhdq', '76722');

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
  `konsentrasi_keahlian` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `kelas` varchar(10) DEFAULT NULL,
  `tahun` varchar(10) DEFAULT NULL,
  `nama_dudi` varchar(100) DEFAULT NULL,
  `nilai_laporan_jurnalpkl` decimal(5,2) DEFAULT NULL,
  `nilai_pkldudi` decimal(5,2) DEFAULT NULL,
  `nilai_akhir_monitoring` decimal(5,2) DEFAULT NULL,
  `nilai_pengimbasan` decimal(5,2) DEFAULT NULL,
  `nilai_lap_akhir` decimal(5,2) DEFAULT NULL,
  `nilai_akhir` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `evaluasi`
--

INSERT INTO `evaluasi` (`id_evaluasi`, `kode_kelompok`, `kode_dudi`, `NIS`, `nama`, `konsentrasi_keahlian`, `kelas`, `tahun`, `nama_dudi`, `nilai_laporan_jurnalpkl`, `nilai_pkldudi`, `nilai_akhir_monitoring`, `nilai_pengimbasan`, `nilai_lap_akhir`, `nilai_akhir`) VALUES
(1, 'TKJ8', 'TI008', '16715', 'AMANDA SETYAWATI', 'Teknik Komputer dan Jaringan (TKJ)', 'XI TKJ 2', '2023/2024', 'Youvee Computer', NULL, NULL, NULL, '100.00', NULL, '64.30'),
(2, 'TKJ2', 'TI003', '16711', 'ADE DANI OKTAVIAN', 'Teknik Komputer dan Jaringan (TKJ)', 'XI TKJ 2', '2023/2024', 'ALBIS Jogja', NULL, NULL, NULL, '100.00', NULL, '20.17'),
(3, 'TKJ2', 'TI003', '16733', 'RAHMAT DIKY ALFIANZAH', 'Teknik Komputer dan Jaringan (TKJ)', 'XI TKJ 2', '2023/2024', 'ALBIS Jogja', NULL, NULL, NULL, '100.00', NULL, '20.00'),
(4, 'TKJ1', 'TI002', '16683', 'FAWWAZ BAGDI PRASTOWO AKBAR', 'Teknik Komputer dan Jaringan (TKJ)', 'XI TKJ 1', '2023/2024', 'CV Latansa Jogjakarta', NULL, NULL, NULL, '100.00', NULL, '20.00'),
(5, 'TKJ1', 'TI002', '16674', 'ADITYA ARBAYU', 'Teknik Komputer dan Jaringan (TKJ)', 'XI TKJ 1', '2023/2024', 'CV Latansa Jogjakarta', '0.00', '44.14', '17.65', '100.00', '100.00', '81.79'),
(6, 'TKJ3', 'TI001', '16735', 'RESTU AGUS JATMIKO', 'Teknik Komputer dan Jaringan (TKJ)', 'XI TKJ 2', '2023/2024', 'Reds Computer', '0.00', '44.14', '0.00', '0.00', '0.00', '44.14'),
(7, 'TKJ3', 'TI001', '16728', 'MUHAMMAD AKMAL RASYID', 'Teknik Komputer dan Jaringan (TKJ)', 'XI TKJ 2', '2023/2024', 'Reds Computer', '3.33', '44.14', '17.65', '100.00', '0.00', '72.12'),
(8, 'TKJ5', 'TI005', '16690', 'INKA RAHMAWATI', 'Teknik Komputer dan Jaringan (TKJ)', 'XI TKJ 1', '2023/2024', 'RR COMPUTER', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00'),
(9, 'TKJ4', 'TI004', '16723', 'ILHAM KURNIA PUTRA PRAPANCA', 'Teknik Komputer dan Jaringan (TKJ)', 'XI TKJ 2', '2023/2024', 'Harrisma Computer', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00'),
(10, 'TKJ3', 'TI001', '16732', 'NUR DWI CAHYO', 'Teknik Komputer dan Jaringan (TKJ)', 'XI TKJ 2', '2023/2024', 'Reds Computer', '0.00', '44.14', '0.00', '0.00', '0.00', '44.14'),
(11, 'TKJ4', 'TI004', '16719', 'DAFFA RIFKY HAIDAR GHAZWAN', 'Teknik Komputer dan Jaringan (TKJ)', 'XI TKJ 2', '2023/2024', 'Harrisma Computer', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00'),
(12, 'TKJ16', 'TI020', '16698', 'Raditya Eka E', 'Teknik Komputer dan Jaringan (TKJ)', 'XI TKJ 1', '2023/2024', 'Mahameru Computer', '0.83', '0.00', '0.00', '100.00', '100.00', '20.08');

-- --------------------------------------------------------

--
-- Table structure for table `laporan_akhir`
--

CREATE TABLE `laporan_akhir` (
  `id_laporan_akhir` int NOT NULL,
  `kode_kelompok` varchar(10) DEFAULT NULL,
  `kode_dudi` varchar(10) DEFAULT NULL,
  `NIS` varchar(15) DEFAULT NULL,
  `konsentrasi_keahlian` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `nama_siswa` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `kelas` varchar(10) DEFAULT NULL,
  `nama_dudi` varchar(100) DEFAULT NULL,
  `laporan_akhir` varchar(255) NOT NULL,
  `approved` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `laporan_akhir`
--

INSERT INTO `laporan_akhir` (`id_laporan_akhir`, `kode_kelompok`, `kode_dudi`, `NIS`, `konsentrasi_keahlian`, `nama_siswa`, `kelas`, `nama_dudi`, `laporan_akhir`, `approved`) VALUES
(40, 'TKJ8', 'TI008', '16717', 'Teknik Komputer dan Jaringan (TKJ)', 'ARINA MAULA MANASIKANA', 'XI TKJ 2', 'Youvee Computer', 'laporan_akhir_16717.pdf', 0),
(41, 'TKJ5', 'TI005', '16731', 'Teknik Komputer dan Jaringan (TKJ)', 'NABILA NUR RIYANTA', 'XI TKJ 2', 'RR COMPUTER', 'laporan_akhir_16731.pdf', 0),
(85, 'TKJ1', 'TI002', '16674', 'Teknik Komputer dan Jaringan (TKJ)', 'ADITYA ARBAYU', 'XI TKJ 1', 'CV Latansa Jogjakarta', 'laporan_akhir_16674.pdf', 1),
(86, 'TKJ13', 'TI011', '16692', 'Teknik Komputer dan Jaringan (TKJ)', 'LINDU AJI PUTRA PRATAMA', 'XI TKJ 1', 'AIR NET ( CV. Buana Nirwana Jaya )', 'laporan_akhir_16692.pdf', 0),
(87, 'TKJ3', 'TI001', '16728', 'Teknik Komputer dan Jaringan (TKJ)', 'MUHAMMAD AKMAL RASYID', 'XI TKJ 2', 'Reds Computer', 'laporan_akhir_16728.pdf', 0),
(88, 'TKJ16', 'TI020', '16698', 'Teknik Komputer dan Jaringan (TKJ)', 'Raditya Eka E', 'XI TKJ 1', 'Mahameru Computer', 'laporan_akhir_16698.pdf', 1);

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
(3, '2024-10-21 22:44:11', '16711', NULL, 'ADE DANI OKTAVIAN', 'ALBIS Jogja', 'software', 'Jalan Perumnas, Condongcatur, Depok, Sleman, Daerah Istimewa Yogyakarta, Jawa, 55821, Indonesia', 'XI TKJ 2', NULL, 'Teknik Komputer dan Jaringan (TKJ)', '2024-10-21 22:44:11', '2024-10-21 22:44:11', 'Jl. Parangtritis No.7,5, Cabean, Panggungharjo, Sewon, Bantul, Yogyakarta 55185', '197812072014062002'),
(4, '2024-10-24 04:14:23', '16711', NULL, 'ADE DANI OKTAVIAN', 'ALBIS Jogja', 'rakit hardware', 'Gang Kasuari, RW 04, Patemon, Gunung Pati, Semarang, Jawa Tengah, Jawa, 50264, Indonesia', 'XI TKJ 2', NULL, 'Teknik Komputer dan Jaringan (TKJ)', '2024-10-24 04:14:23', '2024-10-24 04:14:23', 'Jl. Parangtritis No.7,5, Cabean, Panggungharjo, Sewon, Bantul, Yogyakarta 55185', '197812072014062002'),
(7, '2024-11-12 08:23:58', '16715', NULL, 'AMANDA SETYAWATI', 'Youvee Computer', 'instalasi', 'Jalan Gabugan, Pandowo Harjo, Pandowoharjo, Sleman, Daerah Istimewa Yogyakarta, Jawa, 55512, Indonesia', 'XI TKJ 2', NULL, 'Teknik Komputer dan Jaringan (TKJ)', '2024-11-12 08:23:58', '2024-11-12 08:23:58', NULL, NULL),
(8, '2024-11-12 08:43:21', '16715', NULL, 'AMANDA SETYAWATI', 'Youvee Computer', 'software', 'Jalan Gabugan, Pandowo Harjo, Pandowoharjo, Sleman, Daerah Istimewa Yogyakarta, Jawa, 55512, Indonesia', 'XI TKJ 2', NULL, 'Teknik Komputer dan Jaringan (TKJ)', '2024-11-12 08:43:21', '2024-11-12 08:43:21', NULL, NULL),
(9, '2024-11-12 09:34:18', '16711', NULL, 'ADE DANI OKTAVIAN', 'ALBIS Jogja', 'instalasi', 'Jalan Gabugan, Pandowo Harjo, Pandowoharjo, Sleman, Daerah Istimewa Yogyakarta, Jawa, 55512, Indonesia', 'XI TKJ 2', NULL, 'Teknik Komputer dan Jaringan (TKJ)', '2024-11-12 09:34:18', '2024-11-12 09:34:18', NULL, NULL),
(10, '2024-11-12 10:19:48', '16717', NULL, 'ARINA MAULA MANASIKANA', 'Youvee Computer', 'instalasi', 'Jalan Gabugan, Pandowo Harjo, Pandowoharjo, Sleman, Daerah Istimewa Yogyakarta, Jawa, 55512, Indonesia', 'XI TKJ 2', NULL, 'Teknik Komputer dan Jaringan (TKJ)', '2024-11-12 10:19:48', '2024-11-12 10:19:48', NULL, NULL),
(16, '2024-11-28 08:01:07', '16728', NULL, 'MUHAMMAD AKMAL RASYID', 'Reds Computer', 'instalasi', 'RW 05, Gondangdia, Menteng, Jakarta Pusat, Daerah Khusus Ibukota Jakarta, Jawa, 10350, Indonesia', 'XI TKJ 2', NULL, 'Teknik Komputer dan Jaringan (TKJ)', '2024-11-28 08:01:07', '2024-11-28 08:01:07', NULL, NULL),
(17, '2024-11-29 00:48:18', '16698', NULL, 'Raditya Eka E', 'Mahameru Computer', 'praktek', 'Kauman, Surakarta, Kecamatan Pasar Kliwon, Jawa Tengah, Jawa, 57115, Indonesia', 'XI TKJ 1', NULL, 'Teknik Komputer dan Jaringan (TKJ)', '2024-11-29 00:48:18', '2024-11-29 00:48:18', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `laporan_pengimbasan`
--

CREATE TABLE `laporan_pengimbasan` (
  `id_pengimbasan` int NOT NULL,
  `kode_kelompok` varchar(10) DEFAULT NULL,
  `kode_dudi` varchar(10) DEFAULT NULL,
  `NIS` varchar(15) DEFAULT NULL,
  `konsentrasi_keahlian` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `kelas` varchar(10) DEFAULT NULL,
  `nama_dudi` varchar(100) DEFAULT NULL,
  `laporan_pengimbasan` varchar(255) NOT NULL,
  `approved` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `laporan_pengimbasan`
--

INSERT INTO `laporan_pengimbasan` (`id_pengimbasan`, `kode_kelompok`, `kode_dudi`, `NIS`, `konsentrasi_keahlian`, `nama`, `kelas`, `nama_dudi`, `laporan_pengimbasan`, `approved`) VALUES
(8, 'TKJ2', 'TI003', '16711', 'Teknik Komputer dan Jaringan (TKJ)', 'ADE DANI OKTAVIAN', 'XI TKJ 2', 'ALBIS Jogja', 'laporan_pengimbasan_16711.pdf', 0),
(9, 'TKJ8', 'TI008', '16715', 'Teknik Komputer dan Jaringan (TKJ)', 'AMANDA SETYAWATI', 'XI TKJ 2', 'Youvee Computer', 'laporan_pengimbasan_16715.pdf', 0),
(33, 'TKJ8', 'TI008', '16717', 'Teknik Komputer dan Jaringan (TKJ)', 'ARINA MAULA MANASIKANA', 'XI TKJ 2', 'Youvee Computer', 'laporan_pengimbasan_16717.pdf', 0),
(34, 'TKJ5', 'TI005', '16731', 'Teknik Komputer dan Jaringan (TKJ)', 'NABILA NUR RIYANTA', 'XI TKJ 2', 'RR COMPUTER', 'laporan_pengimbasan_16731.pdf', 0),
(93, 'TKJ1', 'TI002', '16674', 'Teknik Komputer dan Jaringan (TKJ)', 'ADITYA ARBAYU', 'XI TKJ 1', 'CV Latansa Jogjakarta', 'laporan_pengimbasan_16674.pdf', 1),
(94, 'TKJ13', 'TI011', '16692', 'Teknik Komputer dan Jaringan (TKJ)', 'LINDU AJI PUTRA PRATAMA', 'XI TKJ 1', 'AIR NET ( CV. Buana Nirwana Jaya )', 'laporan_pengimbasan_16692.pdf', 0),
(95, 'TKJ3', 'TI001', '16728', 'Teknik Komputer dan Jaringan (TKJ)', 'MUHAMMAD AKMAL RASYID', 'XI TKJ 2', 'Reds Computer', 'laporan_pengimbasan_16728.pdf', 0),
(96, 'TKJ16', 'TI020', '16698', 'Teknik Komputer dan Jaringan (TKJ)', 'Raditya Eka E', 'XI TKJ 1', 'Mahameru Computer', 'laporan_pengimbasan_16698.pdf', 1);

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
  `NIP_NIK` varchar(20) DEFAULT NULL,
  `nama_siswa` varchar(100) DEFAULT NULL,
  `konsentrasi_keahlian` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `nama_dudi` varchar(100) DEFAULT NULL,
  `kelas` varchar(10) DEFAULT NULL,
  `tahun` varchar(10) DEFAULT NULL,
  `nama_pembimbing` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `monitoring`
--

INSERT INTO `monitoring` (`id_monitoring`, `NIS`, `kode_kelompok`, `kode_dudi`, `NIP_NIK`, `nama_siswa`, `konsentrasi_keahlian`, `nama_dudi`, `kelas`, `tahun`, `nama_pembimbing`) VALUES
(2, '16735', 'TKJ3', 'TI001', '197604052024211002', 'RESTU AGUS JATMIKO', 'Teknik Komputer dan Jaringan (TKJ)', 'Reds Computer', 'XI TKJ 2', '2023/2024', 'RUSDIYANTO, S.Pd'),
(3, '16732', 'TKJ3', 'TI001', '197604052024211002', 'NUR DWI CAHYO', 'Teknik Komputer dan Jaringan (TKJ)', 'Reds Computer', 'XI TKJ 2', '2023/2024', 'RUSDIYANTO, S.Pd'),
(4, '16728', 'TKJ3', 'TI001', '197604052024211002', 'MUHAMMAD AKMAL RASYID', 'Teknik Komputer dan Jaringan (TKJ)', 'Reds Computer', 'XI TKJ 2', '2023/2024', 'RUSDIYANTO, S.Pd'),
(5, '16674', 'TKJ1', 'TI002', '196706051997021002', 'ADITYA ARBAYU', 'Teknik Komputer dan Jaringan (TKJ)', 'CV Latansa Jogjakarta', 'XI TKJ 1', '2023/2024', 'SUJAR HARTONO S.Pd.'),
(6, '16683', 'TKJ1', 'TI002', '196706051997021002', 'FAWWAZ BAGDI PRASTOWO AKBAR', 'Teknik Komputer dan Jaringan (TKJ)', 'CV Latansa Jogjakarta', 'XI TKJ 1', '2023/2024', 'SUJAR HARTONO S.Pd.'),
(7, '16727', 'TKJ2', 'TI003', '197812072014062002', 'MIFTAH ABIT RAKHALANA', 'Teknik Komputer dan Jaringan (TKJ)', 'ALBIS Jogja', 'XI TKJ 2', '2023/2024', 'DARIYATI, S.KOM'),
(8, '16733', 'TKJ2', 'TI003', '197812072014062002', 'RAHMAT DIKY ALFIANZAH', 'Teknik Komputer dan Jaringan (TKJ)', 'ALBIS Jogja', 'XI TKJ 2', '2023/2024', 'DARIYATI, S.KOM'),
(9, '16711', 'TKJ2', 'TI003', '197812072014062002', 'ADE DANI OKTAVIAN', 'Teknik Komputer dan Jaringan (TKJ)', 'ALBIS Jogja', 'XI TKJ 2', '2023/2024', 'DARIYATI, S.KOM'),
(15, '16715', 'TKJ8', 'TI008', '197812072014062002', 'AMANDA SETYAWATI', 'Teknik Komputer dan Jaringan (TKJ)', 'Youvee Computer', 'XI TKJ 2', '2023/2024', 'DARIYATI, S.KOM'),
(16, '16717', 'TKJ8', 'TI008', '197812072014062002', 'ARINA MAULA MANASIKANA', 'Teknik Komputer dan Jaringan (TKJ)', 'Youvee Computer', 'XI TKJ 2', '2023/2024', 'DARIYATI, S.KOM'),
(17, '16723', 'TKJ4', 'TI004', '198810272023211007', 'ILHAM KURNIA PUTRA PRAPANCA', 'Teknik Komputer dan Jaringan (TKJ)', 'Harrisma Computer', 'XI TKJ 2', '2023/2024', 'ROHMAD DWIYANTO S.Pd'),
(18, '16719', 'TKJ4', 'TI004', '198810272023211007', 'DAFFA RIFKY HAIDAR GHAZWAN', 'Teknik Komputer dan Jaringan (TKJ)', 'Harrisma Computer', 'XI TKJ 2', '2023/2024', 'ROHMAD DWIYANTO S.Pd'),
(19, '16713', 'TKJ4', 'TI004', '198810272023211007', 'AIS KHOIRUL RIFAN', 'Teknik Komputer dan Jaringan (TKJ)', 'Harrisma Computer', 'XI TKJ 2', '2023/2024', 'ROHMAD DWIYANTO S.Pd'),
(20, '16690', 'TKJ5', 'TI005', '198810272023211007', 'INKA RAHMAWATI', 'Teknik Komputer dan Jaringan (TKJ)', 'RR COMPUTER', 'XI TKJ 1', '2023/2024', 'ROHMAD DWIYANTO S.Pd'),
(21, '16731', 'TKJ5', 'TI005', '198810272023211007', 'NABILA NUR RIYANTA', 'Teknik Komputer dan Jaringan (TKJ)', 'RR COMPUTER', 'XI TKJ 2', '2023/2024', 'ROHMAD DWIYANTO S.Pd'),
(22, '16720', 'TKJ6', 'TI006', '199003202024211002', 'DESTA DWIANGGA', 'Teknik Komputer dan Jaringan (TKJ)', 'Azzam Computer', 'XI TKJ 2', '2023/2024', 'DUWI RIANTO S. Pd.'),
(23, '16736', 'TKJ6', 'TI006', '199003202024211002', 'RIZKI WAHYU NURRAHMAN', 'Teknik Komputer dan Jaringan (TKJ)', 'Azzam Computer', 'XI TKJ 2', '2023/2024', 'DUWI RIANTO S. Pd.'),
(24, '16740', 'TKJ7', 'TI027', '199003202024211002', 'TEGUH FIRMANSYAH', 'Teknik Komputer dan Jaringan (TKJ)', 'Dary Computer', 'XI TKJ 2', '2023/2024', 'DUWI RIANTO S. Pd.');

-- --------------------------------------------------------

--
-- Table structure for table `monitoring_per_siswa`
--

CREATE TABLE `monitoring_per_siswa` (
  `id_monitoring_persiswa` int NOT NULL,
  `NIS` varchar(15) NOT NULL,
  `nilai_tp1` decimal(5,2) NOT NULL,
  `nilai_tp2` decimal(5,2) NOT NULL,
  `nilai_tp3` decimal(5,2) NOT NULL,
  `nilai_tp4` decimal(5,2) NOT NULL,
  `nilai_monitoring` decimal(5,2) NOT NULL,
  `nilai_akhir_monitoring` decimal(5,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `monitoring_per_siswa`
--

INSERT INTO `monitoring_per_siswa` (`id_monitoring_persiswa`, `NIS`, `nilai_tp1`, `nilai_tp2`, `nilai_tp3`, `nilai_tp4`, `nilai_monitoring`, `nilai_akhir_monitoring`, `created_at`, `updated_at`) VALUES
(1, '16727', '87.50', '88.83', '88.33', '88.43', '88.27', NULL, '2024-11-12 10:01:50', '2024-11-12 10:01:50'),
(2, '16727', '87.50', '88.83', '88.33', '88.43', '88.27', NULL, '2024-11-12 10:02:24', '2024-11-12 10:02:24'),
(3, '16728', '87.50', '88.83', '88.33', '88.43', '88.27', NULL, '2024-11-14 15:40:07', '2024-11-14 15:40:07'),
(4, '16674', '87.50', '88.83', '88.33', '88.43', '88.27', NULL, '2024-11-15 03:51:11', '2024-11-15 03:51:11'),
(5, '16674', '87.50', '88.83', '88.33', '88.43', '88.27', NULL, '2024-11-29 05:25:43', '2024-11-29 05:25:43');

-- --------------------------------------------------------

--
-- Table structure for table `nilai_pkl`
--

CREATE TABLE `nilai_pkl` (
  `id_nilai` int NOT NULL,
  `kode_kelompok` varchar(10) DEFAULT NULL,
  `NIS` varchar(15) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `konsentrasi_keahlian` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `kelas` varchar(10) DEFAULT NULL,
  `tahun` varchar(10) DEFAULT NULL,
  `nilai` decimal(5,2) DEFAULT '0.00',
  `tp1_soft_skills` decimal(5,2) DEFAULT NULL,
  `tp2_norma_pos` decimal(5,2) DEFAULT NULL,
  `tp3_kompetensi_teknis` decimal(5,2) DEFAULT NULL,
  `tp4_wawasan_wirausaha` decimal(5,2) DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `is_imported` tinyint(1) DEFAULT '0',
  `created_by` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `nilai_pkl`
--

INSERT INTO `nilai_pkl` (`id_nilai`, `kode_kelompok`, `NIS`, `nama`, `konsentrasi_keahlian`, `kelas`, `tahun`, `nilai`, `tp1_soft_skills`, `tp2_norma_pos`, `tp3_kompetensi_teknis`, `tp4_wawasan_wirausaha`, `file_path`, `is_imported`, `created_by`) VALUES
(12, NULL, '16735', NULL, NULL, NULL, NULL, '88.27', '87.50', '88.83', '88.33', '88.43', 'Template nilai pkl.xlsx', 1, NULL),
(13, NULL, '16728', NULL, NULL, NULL, NULL, '88.27', '87.50', '88.83', '88.33', '88.43', 'Template nilai pkl.xlsx', 1, NULL),
(14, NULL, '16732', NULL, NULL, NULL, NULL, '88.27', '87.50', '88.83', '88.33', '88.43', 'Template nilai pkl.xlsx', 1, NULL),
(15, NULL, '16715', NULL, NULL, NULL, NULL, '88.27', '87.50', '88.83', '88.33', '88.43', 'Template nilai pkl.xlsx', 1, NULL),
(16, NULL, '16674', NULL, NULL, NULL, NULL, '88.27', '87.50', '88.83', '88.33', '88.43', 'Template nilai pkl.xlsx', 1, NULL);

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
('196706051997021002', 'SUJAR HARTONO S.Pd.', 'Laki-laki', 'PPPK', 'afsdfewf', '16761268', '$2y$12$unVU8A0X1daqHwk2AwjyvuD.gViebaaOBbfl6/0YomzbGxlnW7.fi', '2024-10-07 02:06:32', '2024-10-25 08:30:02'),
('196709222007012012', 'MULATI S.Pd.', 'Perempuan', 'Guru Muda', 'bsjhajhd', '1918371', '$2y$12$I4C2hUQrv5jnP4lnR2TVBe8XbsZQRgJyPyPxaj2mPM5BvGf3tfGi.', '2024-10-11 07:35:38', '2024-11-12 03:34:27'),
('197410222008012005', 'MURDIASIH KADARWATIS.Pd', 'Perempuan', 'Guru Muda', 'bsgsj', '91827', '$2y$12$PvzBaBFV6Hj7d/ZL.ZwlSOjBb8ZGDzl/RCqI4qzb.PLyomHwb6AC2', '2024-10-11 09:33:40', '2024-10-25 08:30:02'),
('197604052024211002', 'RUSDIYANTO, S.Pd', 'Laki-laki', 'PPPK', '', NULL, '$2y$12$rJrUYzIrI4F3PcPlxD89WOy1wtIpvGpBmR0FtGPv3.Zng6m2SPqr2', '2024-10-11 07:29:17', '2024-10-25 08:30:02'),
('197702212022211001', 'AHMAD MUHLASHIN, S.Pd', 'Laki-laki', 'PPPK', 'bantul', '01871291', '$2y$12$es7g2yUFeUo3rUL/rMyv9.s.K3MXAfAV/H0of.tTEnYd19hj4vmsi', '2024-11-12 03:37:26', '2024-11-28 04:02:17'),
('197812072014062002', 'DARIYATI, S.KOM', 'Laki-laki', 'PPPK', 'bantul', '9819361', '$2y$12$nMVwGGV2XQzQ6Q5/z420e.UCuRyOH6ABBhEfWRcnJOWFh7G0SKeby', '2024-10-07 02:06:32', '2024-11-04 04:08:19'),
('198603032022212007', 'WATI, S.Pd.I', 'Perempuan', 'PPPK', '', NULL, '$2y$12$kzDBONPoPo53F3MMKE6dqusiC2P/VGZN0dYuLoVreyCdD.yn79SUO', '2024-11-12 03:37:26', '2024-11-12 03:37:26'),
('198610062022211003', 'NURHIDAYAT SULISTIAWAN, S.Pd', 'Laki-laki', 'PPPK', '', NULL, '$2y$12$/VlDi1pzbtLkS3UWGs/Hvui0hVN8xhCp2Zu8YCsDRe.FDYGiAt1pi', '2024-11-12 03:37:26', '2024-11-12 03:37:26'),
('198810162022211001', 'HARIS BUDIAWAN, S.Pd', 'Laki-laki', 'PPPK', '', NULL, '$2y$12$xF13KGqB2PQE2vCFAT/w9uVaV370qjVrQtV39rOkZhPuXEW57IHVS', '2024-11-12 03:37:27', '2024-11-12 03:37:27'),
('198810272023211007', 'ROHMAD DWIYANTO S.Pd', 'Laki-laki', 'PPPK', '', NULL, '$2y$12$hpj92Gj8jJhmQCMEEaKllOwoA866Alfe/9xh5L8QuTZtXH0p9tq8S', '2024-10-11 07:29:17', '2024-10-25 08:30:02'),
('199003202024211002', 'DUWI RIANTO S. Pd.', 'Laki-laki', 'PPPK', '', NULL, '$2y$12$ikFgZJv.i9QRZhaJgka4vOu6LnXO1bce12TXoOkIioEZurw/sydfu', '2024-10-11 07:29:17', '2024-10-25 08:30:02'),
('199310252024211004', 'MUHAMMAD FURQON S.Sos', 'Laki-laki', 'PPPK', '', NULL, '$2y$12$L4R7vj4KPlzzX.ysQOvJyOJizzScveVn61aWDoWH2Lx4XmwSz85y2', '2024-10-15 02:48:55', '2024-10-25 08:30:02'),
('199408062023212019', 'NOVIA RAHMALINA, S.Pd', 'Perempuan', 'PPPK', 'bahgasghajh', '812717671', '$2y$12$85atByMW8ZtdFvtw.Mz29.CvFaPFvccnOxG80UU9ILMbxxDI/Dlye', '2024-11-12 03:43:14', '2024-11-12 03:43:14'),
('199503272022212001', 'RYAWIDYANINGTYAS, S.Pd', 'Perempuan', 'PPPK', '', NULL, '$2y$12$tIoqNW9VUOptZz5ZsT8y4uRXoHkjBALABc3N72YVpQeRs7ZZKet2i', '2024-11-12 03:37:27', '2024-11-12 03:37:27'),
('199804102024212010', 'RISA RESTI AFRIANI S. Pd.', 'Perempuan', 'PPPK', 'sleman', '1223456789', '$2y$12$6grHfHo5hPuN7qqM3dSI4OVCYgoY02nb0BBO.5kW3qXTY7NXlYFPe', '2024-10-12 09:01:14', '2024-10-25 08:30:02');

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
  `nama_dudi` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `notelp_dudi` varchar(15) DEFAULT NULL,
  `proposal_pkl` text NOT NULL,
  `status_acc` tinyint(1) DEFAULT '0',
  `created_by` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pengajuan`
--

INSERT INTO `pengajuan` (`id_pengajuan`, `NIS`, `nama_siswa`, `no_telp`, `nama_dudi`, `notelp_dudi`, `proposal_pkl`, `status_acc`, `created_by`) VALUES
(21, NULL, 'NABILA NUR RIYANTA,\r\nINKA RAHMAWATI', '1223456789', 'RR COMPUTER', NULL, 'JADWAL TAKJIL 2024.pdf', 1, '16731'),
(22, NULL, 'DESTA DWIANGGA,\r\nRIZKI WAHYU NURRAHMAN', '3224242245', 'Azzam Computer', NULL, 'JADWAL TAKJIL 2024.pdf', 1, '16720'),
(23, NULL, 'TEGUH FIRMANSYAH', '1223456789', 'Dary Computer', NULL, 'JADWAL TAKJIL 2024.pdf', 1, '16740'),
(25, NULL, 'NAYLA EMMA WAHYUNINGTIYAS,\r\nMEYSA TUNGGAL KHARISTA', '193862186482', 'Doctor Laptop Jogja', NULL, 'JADWAL TAKJIL 2024.pdf', 1, '17754'),
(26, NULL, 'AMANDA SETYAWATI,\r\nARINA MAULA MANASIKANA', '3224242245', 'Youvee Computer', NULL, 'JADWAL TAKJIL 2024.pdf', 1, '16715'),
(27, NULL, 'RAYHAN ADITYA PRADHANA,\r\nBURHAN SHALAHUDDIN,\r\nRASYA MAULANA HAFIDTS', '1235678', 'PT Jaringan Lintas Utara (JATARA)', NULL, 'JADWAL TAKJIL 2024.pdf', 1, '16702'),
(28, NULL, 'LINDU AJI PUTRA PRATAMA,\r\nSETO SUJATMIKO', '152672281', 'AIR NET ( CV. Buana Nirwana Jaya )', NULL, 'JADWAL TAKJIL 2024.pdf', 1, '16692'),
(29, NULL, 'FARID HIDAYAT,\r\nENDRI IRAWAN,\r\nHANAN NUR IKHSAN', '91817217291', 'PT. Wahana Lintas Nusa Persada', NULL, 'JADWAL TAKJIL 2024.pdf', 1, '16682'),
(31, NULL, 'IBNU FIKRI ARDIANSYAH,\r\nARYA ALFAH REZA,\r\nFATIHAH AL AISYIYAH', '081927153182', 'Life Medianet', NULL, 'Proposal PKL Mandiri SMKN 1 Bantul (1).pdf', 1, '16722'),
(32, NULL, 'Abqori Ikhwanul Wakhidan,\r\nArdhan Anandhika', '081927153182', 'CITRANET', NULL, 'Proposal PKL Mandiri SMKN 1 Bantul (1).pdf', 0, '16710'),
(33, NULL, 'Raditya Eka E,\r\nRaditya Putra P', '081927153182', 'Mahameru Computer', NULL, 'Proposal PKL Mandiri SMKN 1 Bantul (1).pdf', 1, '16698');

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
(21, '16690', '2024-10-29 05:05:02', '2024-10-29 05:05:02'),
(21, '16731', '2024-10-29 05:05:02', '2024-10-29 05:05:02'),
(22, '16720', '2024-11-04 01:49:35', '2024-11-04 01:49:35'),
(22, '16736', '2024-11-04 01:49:35', '2024-11-04 01:49:35'),
(23, '16740', '2024-11-05 20:54:06', '2024-11-05 20:54:06'),
(25, '16726', '2024-11-08 05:24:13', '2024-11-08 05:24:13'),
(25, '17754', '2024-11-08 05:24:13', '2024-11-08 05:24:13'),
(26, '16715', '2024-11-12 01:43:16', '2024-11-12 01:43:16'),
(26, '16717', '2024-11-12 01:43:16', '2024-11-12 01:43:16'),
(27, '16678', '2024-11-14 22:11:35', '2024-11-14 22:11:35'),
(27, '16701', '2024-11-14 22:11:35', '2024-11-14 22:11:35'),
(27, '16702', '2024-11-14 22:11:35', '2024-11-14 22:11:35'),
(28, '16692', '2024-11-15 03:43:13', '2024-11-15 03:43:13'),
(28, '16707', '2024-11-15 03:43:13', '2024-11-15 03:43:13'),
(29, '16681', '2024-11-15 03:57:41', '2024-11-15 03:57:41'),
(29, '16682', '2024-11-15 03:57:41', '2024-11-15 03:57:41'),
(29, '16687', '2024-11-15 03:57:41', '2024-11-15 03:57:41'),
(31, '16718', '2024-11-25 02:18:00', '2024-11-25 02:18:00'),
(31, '16721', '2024-11-25 02:18:00', '2024-11-25 02:18:00'),
(31, '16722', '2024-11-25 02:18:00', '2024-11-25 02:18:00'),
(32, '16710', '2024-11-28 08:07:00', '2024-11-28 08:07:00'),
(32, '16716', '2024-11-28 08:07:00', '2024-11-28 08:07:00'),
(33, '16698', '2024-11-29 00:45:28', '2024-11-29 00:45:28'),
(33, '16700', '2024-11-29 00:45:28', '2024-11-29 00:45:28');

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
  `konsentrasi_keahlian` varchar(255) DEFAULT NULL,
  `alamat_dudi` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ploting`
--

INSERT INTO `ploting` (`id_ploting`, `kode_kelompok`, `NIP_NIK`, `nama_pembimbing`, `kode_dudi`, `nama_dudi`, `NIS`, `kelas`, `notelp_dudi`, `nama_siswa`, `konsentrasi_keahlian`, `alamat_dudi`) VALUES
(4, 'TKJ1', '196706051997021002', 'SUJAR HARTONO S.Pd.', 'TI002', 'CV Latansa Jogjakarta', '16674', 'XI TKJ 1', '86761132', 'ADITYA ARBAYU', 'Teknik Komputer dan Jaringan (TKJ)', 'Nangsri RT 02, Srihardono Pundong, Bantul, Yogyakarta 55771'),
(6, 'TKJ1', '196706051997021002', 'SUJAR HARTONO S.Pd.', 'TI002', 'CV Latansa Jogjakarta', '16683', 'XI TKJ 1', '86761132', 'FAWWAZ BAGDI PRASTOWO AKBAR', 'Teknik Komputer dan Jaringan (TKJ)', 'Nangsri RT 02, Srihardono Pundong, Bantul, Yogyakarta 55771'),
(12, 'TKJ2', '197812072014062002', 'DARIYATI, S.KOM', 'TI003', 'ALBIS Jogja', '16727', 'XI TKJ 2', '67474', 'MIFTAH ABIT RAKHALANA', 'Teknik Komputer dan Jaringan (TKJ)', 'Jl. Parangtritis No.7,5, Cabean, Panggungharjo, Sewon, Bantul, Yogyakarta 55185'),
(13, 'TKJ2', '197812072014062002', 'DARIYATI, S.KOM', 'TI003', 'ALBIS Jogja', '16733', 'XI TKJ 2', '67474', 'RAHMAT DIKY ALFIANZAH', 'Teknik Komputer dan Jaringan (TKJ)', 'Jl. Parangtritis No.7,5, Cabean, Panggungharjo, Sewon, Bantul, Yogyakarta 55185'),
(14, 'TKJ2', '197812072014062002', 'DARIYATI, S.KOM', 'TI003', 'ALBIS Jogja', '16711', 'XI TKJ 2', '67474', 'ADE DANI OKTAVIAN', 'Teknik Komputer dan Jaringan (TKJ)', 'Jl. Parangtritis No.7,5, Cabean, Panggungharjo, Sewon, Bantul, Yogyakarta 55185'),
(15, 'TKJ3', '197604052024211002', 'RUSDIYANTO, S.Pd', 'TI001', 'Reds Computer', '16735', 'XI TKJ 2', '', 'RESTU AGUS JATMIKO', 'Teknik Komputer dan Jaringan (TKJ)', 'Jl. Jogoripon, Geneng, Pendowoharjo, Sewon, Bantul, Yogyakarta 55188'),
(16, 'TKJ3', '197604052024211002', 'RUSDIYANTO, S.Pd', 'TI001', 'Reds Computer', '16732', 'XI TKJ 2', '', 'NUR DWI CAHYO', 'Teknik Komputer dan Jaringan (TKJ)', 'Jl. Jogoripon, Geneng, Pendowoharjo, Sewon, Bantul, Yogyakarta 55188'),
(17, 'TKJ3', '197604052024211002', 'RUSDIYANTO, S.Pd', 'TI001', 'Reds Computer', '16728', 'XI TKJ 2', '', 'MUHAMMAD AKMAL RASYID', 'Teknik Komputer dan Jaringan (TKJ)', 'Jl. Jogoripon, Geneng, Pendowoharjo, Sewon, Bantul, Yogyakarta 55188'),
(18, 'TKJ4', '198810272023211007', 'ROHMAD DWIYANTO S.Pd', 'TI004', 'Harrisma Computer', '16723', 'XI TKJ 2', '', 'ILHAM KURNIA PUTRA PRAPANCA', 'Teknik Komputer dan Jaringan (TKJ)', 'Jl. C. Simanjuntak No.33-37, Terban, Gondokusuman, Yogyakarta 55223'),
(19, 'TKJ4', '198810272023211007', 'ROHMAD DWIYANTO S.Pd', 'TI004', 'Harrisma Computer', '16719', 'XI TKJ 2', '', 'DAFFA RIFKY HAIDAR GHAZWAN', 'Teknik Komputer dan Jaringan (TKJ)', 'Jl. C. Simanjuntak No.33-37, Terban, Gondokusuman, Yogyakarta 55223'),
(20, 'TKJ4', '198810272023211007', 'ROHMAD DWIYANTO S.Pd', 'TI004', 'Harrisma Computer', '16713', 'XI TKJ 2', '', 'AIS KHOIRUL RIFAN', 'Teknik Komputer dan Jaringan (TKJ)', 'Jl. C. Simanjuntak No.33-37, Terban, Gondokusuman, Yogyakarta 55223'),
(49, 'TKJ5', '198810272023211007', 'ROHMAD DWIYANTO S.Pd ', 'TI005', 'RR COMPUTER', '16690', 'XI TKJ 1', '86761132', NULL, NULL, NULL),
(50, 'TKJ5', '198810272023211007', 'ROHMAD DWIYANTO S.Pd ', 'TI005', 'RR COMPUTER', '16731', 'XI TKJ 2', '86761132', NULL, NULL, NULL),
(51, 'TKJ6', '199003202024211002', 'DUWI RIANTO S. Pd.', 'TI006', 'Azzam Computer', '16720', 'XI TKJ 2', '86761132', NULL, NULL, NULL),
(52, 'TKJ6', '199003202024211002', 'DUWI RIANTO S. Pd.', 'TI006', 'Azzam Computer', '16736', 'XI TKJ 2', '86761132', NULL, NULL, NULL),
(53, 'TKJ7', '199003202024211002', 'DUWI RIANTO S. Pd.', 'TI027', 'Dary Computer', '16740', 'XI TKJ 2', '86544', NULL, NULL, NULL),
(54, 'TKJ8', '197812072014062002', 'DARIYATI, S.KOM', 'TI008', 'Youvee Computer', '16715', 'XI TKJ 2', '92827363', NULL, NULL, NULL),
(55, 'TKJ8', '197812072014062002', 'DARIYATI, S.KOM', 'TI008', 'Youvee Computer', '16717', 'XI TKJ 2', '92827363', NULL, NULL, NULL),
(69, 'TKJ9', '199804102024212010', 'RISA RESTI AFRIANI S. Pd.', 'TI009', 'PT. Broadband Indonesia Pratama (BIPNET)', '16729', 'XI TKJ 2', '', NULL, NULL, NULL),
(70, 'TKJ9', '199804102024212010', 'RISA RESTI AFRIANI S. Pd.', 'TI009', 'PT. Broadband Indonesia Pratama (BIPNET)', '16706', 'XI TKJ 1', '', NULL, NULL, NULL),
(71, 'TKJ9', '199804102024212010', 'RISA RESTI AFRIANI S. Pd.', 'TI009', 'PT. Broadband Indonesia Pratama (BIPNET)', '16688', 'XI TKJ 1', '', NULL, NULL, NULL),
(72, 'TKJ9', '199804102024212010', 'RISA RESTI AFRIANI S. Pd.', 'TI009', 'PT. Broadband Indonesia Pratama (BIPNET)', '16699', 'XI TKJ 1', '', NULL, NULL, NULL),
(73, 'TKJ10', '199310252024211004', 'MUHAMMAD FURQON S.Sos', 'TI007', 'Doctor Laptop Jogja', '16726', 'XI TKJ 2', '124214', NULL, NULL, NULL),
(74, 'TKJ10', '199310252024211004', 'MUHAMMAD FURQON S.Sos', 'TI007', 'Doctor Laptop Jogja', '17754', 'XI TKJ 2', '124214', NULL, NULL, NULL),
(75, 'TKJ11', '198810272023211007', 'ROHMAD DWIYANTO S.Pd', 'TI010', 'PT. Gmedia Prime Building', '16730', 'XI TKJ 2', '132453657', NULL, NULL, NULL),
(76, 'TKJ11', '198810272023211007', 'ROHMAD DWIYANTO S.Pd', 'TI010', 'PT. Gmedia Prime Building', '16708', 'XI TKJ 1', '132453657', NULL, NULL, NULL),
(77, 'TKJ11', '198810272023211007', 'ROHMAD DWIYANTO S.Pd', 'TI010', 'PT. Gmedia Prime Building', '16694', 'XI TKJ 1', '132453657', NULL, NULL, NULL),
(78, 'TKJ12', '199003202024211002', 'DUWI RIANTO S. Pd.', 'TI012', 'PT Jaringan Lintas Utara (JATARA)', '16678', 'XI TKJ 1', '756745322', NULL, NULL, NULL),
(79, 'TKJ12', '199003202024211002', 'DUWI RIANTO S. Pd.', 'TI012', 'PT Jaringan Lintas Utara (JATARA)', '16701', 'XI TKJ 1', '756745322', NULL, NULL, NULL),
(80, 'TKJ12', '199003202024211002', 'DUWI RIANTO S. Pd.', 'TI012', 'PT Jaringan Lintas Utara (JATARA)', '16702', 'XI TKJ 1', '756745322', NULL, NULL, NULL),
(81, 'TKJ13', '197812072014062002', 'DARIYATI, S.KOM', 'TI011', 'AIR NET ( CV. Buana Nirwana Jaya )', '16692', 'XI TKJ 1', '646344247', NULL, NULL, NULL),
(82, 'TKJ13', '197812072014062002', 'DARIYATI, S.KOM', 'TI011', 'AIR NET ( CV. Buana Nirwana Jaya )', '16707', 'XI TKJ 1', '646344247', NULL, NULL, NULL),
(83, 'TKJ14', '198810272023211007', 'ROHMAD DWIYANTO S.Pd', 'TI013', 'PT. Wahana Lintas Nusa Persada', '16681', 'XI TKJ 1', '899163181', NULL, NULL, NULL),
(84, 'TKJ14', '198810272023211007', 'ROHMAD DWIYANTO S.Pd', 'TI013', 'PT. Wahana Lintas Nusa Persada', '16682', 'XI TKJ 1', '899163181', NULL, NULL, NULL),
(85, 'TKJ14', '198810272023211007', 'ROHMAD DWIYANTO S.Pd', 'TI013', 'PT. Wahana Lintas Nusa Persada', '16687', 'XI TKJ 1', '899163181', NULL, NULL, NULL),
(86, 'TKJ15', '197812072014062002', 'DARIYATI, S.KOM', 'TI014', 'Life Medianet', '16718', 'XI TKJ 2', '028172633531', NULL, NULL, NULL),
(87, 'TKJ15', '197812072014062002', 'DARIYATI, S.KOM', 'TI014', 'Life Medianet', '16721', 'XI TKJ 2', '028172633531', NULL, NULL, NULL),
(88, 'TKJ15', '197812072014062002', 'DARIYATI, S.KOM', 'TI014', 'Life Medianet', '16722', 'XI TKJ 2', '028172633531', NULL, NULL, NULL),
(89, 'TKJ16', '196709222007012012', 'MULATI S.Pd.', 'TI020', 'Mahameru Computer', '16698', 'XI TKJ 1', '', NULL, NULL, NULL),
(90, 'TKJ16', '196709222007012012', 'MULATI S.Pd.', 'TI020', 'Mahameru Computer', '16700', 'XI TKJ 1', '', NULL, NULL, NULL);

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
  `user_id` varchar(50) DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text,
  `payload` text NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('0HJip6Si7tIKgck9A5ZG0UZFjoomGMl1nn3nEtdh', NULL, '127.0.0.1', 'Mozilla/5.0 (Linux; Android 7.0; SM-G930V Build/NRD90M) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.125 Mobile Safari/537.36 (compatible; Google-Read-Aloud; +https://support.google.com/webmasters/answer/1061943)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOHhTZEo0YWxBYUVZaGpWOUs2dEs3ZHNnMVFPTGJOMkRJTFNieEdWaiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Njk6Imh0dHA6Ly8yNjlmLTI0MDctMC0zMDAyLWMyYTEtYzg4MS1mZTNjLTQzMmQtY2U3OC5uZ3Jvay1mcmVlLmFwcC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1733577162),
('8IBiWzB1hnLdwjuhYIzyk7pjeIke7w9hNWXscXAH', NULL, '127.0.0.1', 'WhatsApp/2.2447.5 W', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRENHazg5RDBadWliNldMQWJJUnhOY2RKMTM3ME5teno0VVRPOWhVSSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NjM6Imh0dHA6Ly8yNjlmLTI0MDctMC0zMDAyLWMyYTEtYzg4MS1mZTNjLTQzMmQtY2U3OC5uZ3Jvay1mcmVlLmFwcCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1733577007),
('FmRRcuEhDBZQMmSU0VRCextCX2czkwm5oVWltmbN', NULL, '127.0.0.1', 'Mozilla/5.0 (Linux; Android 7.0; SM-G930V Build/NRD90M) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.125 Mobile Safari/537.36 (compatible; Google-Read-Aloud; +https://support.google.com/webmasters/answer/1061943)', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoib2FwbnoxSTF5dGNxNm9WdE5CbGRjUk1menJmdTVJMDg5WmtWbno5WiI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo3NDoiaHR0cDovLzI2OWYtMjQwNy0wLTMwMDItYzJhMS1jODgxLWZlM2MtNDMyZC1jZTc4Lm5ncm9rLWZyZWUuYXBwL2hvbWUtc2lzd2EiO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czo3NDoiaHR0cDovLzI2OWYtMjQwNy0wLTMwMDItYzJhMS1jODgxLWZlM2MtNDMyZC1jZTc4Lm5ncm9rLWZyZWUuYXBwL2hvbWUtc2lzd2EiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1733577162),
('hDijjI53TfmkBQ9QJhz4kpvOUeidtEBOTsiOcNDq', NULL, '127.0.0.1', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNkxITmFOVDJuY1lvRlQwM2F4RWxiMWZNck1GNWJHUDBtN2ZMUHhqTCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Njk6Imh0dHA6Ly8yNjlmLTI0MDctMC0zMDAyLWMyYTEtYzg4MS1mZTNjLTQzMmQtY2U3OC5uZ3Jvay1mcmVlLmFwcC9sb2dpbiI7fX0=', 1733587453),
('liSDcPRyqxX7QLAbhhuxBxxCUtqse3lT5olhipHF', NULL, '127.0.0.1', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZU1ScmFSQmtTbm9QZEU0anZhWFVVdEYxSGZ3VGlhdmNyYTFNRnh1MSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NjM6Imh0dHA6Ly8yNjlmLTI0MDctMC0zMDAyLWMyYTEtYzg4MS1mZTNjLTQzMmQtY2U3OC5uZ3Jvay1mcmVlLmFwcCI7fX0=', 1733581679),
('SQQXMaNnIZRLrH91AD9Xniz3eqgY6LUDhPp2dg2t', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiREZEb2pxRHZXWXFHamlMbnVIS1p1NURycHU3T2FTczlmR282TUYwRiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fX0=', 1733587526);

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
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `is_default_password` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`NIS`, `nama_siswa`, `konsentrasi_keahlian`, `password`, `profile_picture`, `kelas`, `tahun`, `kode_kelompok`, `kode_dudi`, `nama_dudi`, `alamat_dudi`, `created_at`, `updated_at`, `is_default_password`) VALUES
('', 'Retno Muninggar', 'Teknik Komputer dan Jaringan (TKJ)', '$2y$12$QL4yjYocV/7FmkfkDqfQwOCGkmqu3ThxTzCwYE9JE2MwMs0Q1S5n2', NULL, 'XI TKJ 1', '2023/2024', NULL, NULL, NULL, NULL, '2024-10-29 01:22:11', '2024-10-29 01:22:11', 1),
('16674', 'ADITYA ARBAYU', 'Teknik Komputer dan Jaringan (TKJ)', 'pw16674', NULL, 'XI TKJ 1', '2023/2024', 'TKJ1', 'TI002', 'CV Latansa Jogjakarta', 'Nangsri RT 02, Srihardono Pundong, Bantul, Yogyakarta 55771', '2024-10-07 02:09:51', '2024-10-25 08:25:42', 1),
('16675', 'AGRAPRATAMA JANU PUTRA AJI', 'Teknik Komputer dan Jaringan (TKJ)', '$2y$12$cGCo1iWBgV4KYgPPJaiAF.nwsFKvUhdcKogO4cIw/1hHMg7x8ULf6', NULL, 'XI TKJ 1', '2023/2024', NULL, NULL, NULL, NULL, '2024-10-29 01:22:13', '2024-10-29 01:22:13', 1),
('16677', 'ARUL REZA ALFAHREZI', 'Teknik Komputer dan Jaringan (TKJ)', '$2y$12$dDSwxza3/2SthKV.STz/9OF8qZwTOEkqYBRpYI1luipHS8vxzv.We', NULL, 'XI TKJ 1', '2023/2024', NULL, NULL, NULL, NULL, '2024-10-29 01:22:13', '2024-10-29 01:22:13', 1),
('16678', 'BURHAN SHALAHUDDIN', 'Teknik Komputer dan Jaringan (TKJ)', '$2y$12$34vvP4eqI2MQ4wo.AVxkHe5inZoYSQskOKWCz6rKzFojsAutIxgLq', NULL, 'XI TKJ 1', '2023/2024', NULL, NULL, NULL, NULL, '2024-10-29 01:22:07', '2024-10-29 01:22:07', 1),
('16679', 'Daviq Kurniawan', 'Teknik Komputer dan Jaringan (TKJ)', '$2y$12$AvdbG2w3oYZ/EfNsNs7wgevWdQ5YQ2R0MYyqE4F24jy74XKokxdOK', NULL, 'XI TKJ 1', '2023/2024', NULL, NULL, NULL, NULL, '2024-10-29 01:22:13', '2024-10-29 01:22:13', 1),
('16681', 'ENDRI IRAWAN', 'Teknik Komputer dan Jaringan (TKJ)', '$2y$12$T.QVtsgUS0C.z0deRmI/lOPK4c2xs9v4AbGUI.Pq1yIWpQAJ735pG', NULL, 'XI TKJ 1', '2023/2024', NULL, NULL, NULL, NULL, '2024-10-29 01:22:08', '2024-10-29 01:22:08', 1),
('16682', 'FARID HIDAYAT', 'Teknik Komputer dan Jaringan (TKJ)', '$2y$12$/dH9epA8Fu/AjSkaZ5/QL.IXW8k/waufxPC1nqMQVx9K/2Fj/mmR.', NULL, 'XI TKJ 1', '2023/2024', NULL, NULL, NULL, NULL, '2024-10-29 01:22:08', '2024-10-29 01:22:08', 1),
('16683', 'FAWWAZ BAGDI PRASTOWO AKBAR', 'Teknik Komputer dan Jaringan (TKJ)', 'pw16683', NULL, 'XI TKJ 1', '2023/2024', 'TKJ1', 'TI002', 'CV Latansa Jogjakarta', 'Nangsri RT 02, Srihardono Pundong, Bantul, Yogyakarta 55771', '2024-10-07 02:09:52', '2024-10-25 08:25:42', 1),
('16684', 'FENDY BAGUS PURWANTO', 'Teknik Komputer dan Jaringan (TKJ)', '$2y$12$GVgt3z2w1ChS8z2Kmzz9We67pyb.hzWkKQIc/szudg4lupgERJp66', NULL, 'XI TKJ 1', '2023/2024', NULL, NULL, NULL, NULL, '2024-10-29 01:22:17', '2024-10-29 01:22:17', 1),
('16685', 'FITRI ASTUTI', 'Teknik Komputer dan Jaringan (TKJ)', '$2y$12$9qijCxnhY2pAmgn9bl/MoO/h7a2iMVXHq1VFaAbfw3to.bz5eOv7.', NULL, 'XI TKJ 1', '2023/2024', NULL, NULL, NULL, NULL, '2024-10-29 01:22:16', '2024-10-29 01:22:16', 1),
('16687', 'HANAN NUR IKHSAN', 'Teknik Komputer dan Jaringan (TKJ)', '$2y$12$5skmBcXYLW/0wrnbAkmBtuQyvv4XjoqP1b7YC1nuTx9uMtBjrrE16', NULL, 'XI TKJ 1', '2023/2024', NULL, NULL, NULL, NULL, '2024-10-29 01:22:08', '2024-10-29 01:22:08', 1),
('16688', 'HANIFA NUR AINI', 'Teknik Komputer dan Jaringan (TKJ)', '$2y$12$ZVCL2EZsjN0cZbkuXfpAbuPdLiG4WMSORYs.gZOSSBlqXoGFZEd0K', NULL, 'XI TKJ 1', '2023/2024', NULL, NULL, NULL, NULL, '2024-10-29 01:22:04', '2024-10-29 01:22:04', 1),
('16689', 'Helma Dimas Prasetyo', 'Teknik Komputer dan Jaringan (TKJ)', '$2y$12$4W4QzqzmZShg9z4IW7JRbuxp7qlAA9H6AzJROmo71K1cfwVHsGW1u', NULL, 'XI TKJ 1', '2023/2024', NULL, NULL, NULL, NULL, '2024-10-29 01:22:09', '2024-10-29 01:22:09', 1),
('16690', 'INKA RAHMAWATI', 'Teknik Komputer dan Jaringan (TKJ)', '$2y$12$Q6DN4h/0WlzdA2idfLJ/I.ngmJSAjLtpjgMvsvDuEkHPipKE/bsSu', NULL, 'XI TKJ 1', '2023/2024', NULL, NULL, NULL, NULL, '2024-10-11 10:04:10', '2024-10-25 08:25:42', 1),
('16691', 'Khaila Dewi Fatika Sari', 'Teknik Komputer dan Jaringan (TKJ)', '$2y$12$tAncfJTrWAm6/yWzEY8jouI0dv7HgkOhkkleIz1/PkcySsSOqiPwu', NULL, 'XI TKJ 1', '2023/2024', NULL, NULL, NULL, NULL, '2024-10-29 01:22:10', '2024-10-29 01:22:10', 1),
('16692', 'LINDU AJI PUTRA PRATAMA', 'Teknik Komputer dan Jaringan (TKJ)', '$2y$12$7qZO5TfzBl3ikFZSgS0uL.cyBDYHCt7XJsf1bnfZv8i.GX2jIeSru', NULL, 'XI TKJ 1', '2023/2024', NULL, NULL, NULL, NULL, '2024-10-29 01:22:06', '2024-11-15 03:54:33', 0),
('16693', 'Lindu Arif Puji Nugroho', 'Teknik Komputer dan Jaringan (TKJ)', '$2y$12$pt9tpfSvW1UuyROSvwiBY.M3OSnDNgMw5sDgqC5yvNvsIr6B0JuzO', NULL, 'XI TKJ 1', '2023/2024', NULL, NULL, NULL, NULL, '2024-10-29 01:22:10', '2024-10-29 01:22:10', 1),
('16694', 'MUHAMAD HASYIM ABDUL MAJID', 'Teknik Komputer dan Jaringan (TKJ)', '$2y$12$aaKoMQlTyBrazohD/yK07etVdGGsCIwV9tERCSxtjH9uAb9eYoLdK', NULL, 'XI TKJ 1', '2023/2024', NULL, NULL, NULL, NULL, '2024-10-29 01:22:06', '2024-10-29 01:22:06', 1),
('16695', 'Muhammad Bintang Wicaksono', 'Teknik Komputer dan Jaringan (TKJ)', '$2y$12$D8L58483WLsj3PCAkUT3EuxVHZQ4gb6UGQ0aosMn8wwdqwlzDmc82', NULL, 'XI TKJ 1', '2023/2024', NULL, NULL, NULL, NULL, '2024-10-29 01:22:13', '2024-10-29 01:22:13', 1),
('16696', 'Muhammad Khoirudin Ashari', 'Teknik Komputer dan Jaringan (TKJ)', '$2y$12$KGNs10FpD.ZFCM5hFNNvqOeNCPg5JoFMf.c6N3E/scxJI8.zD7yPO', NULL, 'XI TKJ 1', '2023/2024', NULL, NULL, NULL, NULL, '2024-10-29 01:22:10', '2024-10-29 01:22:10', 1),
('16697', 'MUHAMMAD ZAKI PAHLEVI', 'Teknik Komputer dan Jaringan (TKJ)', '$2y$12$V6kYat7s5bSFrsYssvge4eeKz6kblee7cuS0pJFjW8iwlQckQd3y2', NULL, 'XI TKJ 1', '2023/2024', NULL, NULL, NULL, NULL, '2024-10-29 01:22:18', '2024-10-29 01:22:18', 1),
('16698', 'Raditya Eka E', 'Teknik Komputer dan Jaringan (TKJ)', '$2y$12$5Q.1vl3GOxPzh71eRSObgOcm3oB0XIfEHZiwTA2nyEDWGP8C21fbS', '', 'XI TKJ 1', '2023/2024', NULL, NULL, NULL, NULL, '2024-10-29 01:22:14', '2024-11-29 06:46:18', 0),
('16699', 'RADITYA PANJI PRAYOGI', 'Teknik Komputer dan Jaringan (TKJ)', '$2y$12$tbjO2XVgLsJgTvYh/sZ2mu4NGGxkja8.e/tImt467nI.crt7dTvd2', NULL, 'XI TKJ 1', '2023/2024', NULL, NULL, NULL, NULL, '2024-10-29 01:22:05', '2024-10-29 01:22:05', 1),
('16700', 'Raditya Putra P', 'Teknik Komputer dan Jaringan (TKJ)', '$2y$12$zQDLAwfiplPvg9n52N2kmuytM138GTAjiDEW490/NO8bew5nBze0G', NULL, 'XI TKJ 1', '2023/2024', NULL, NULL, NULL, NULL, '2024-10-29 01:22:14', '2024-10-29 01:22:14', 1),
('16701', 'RASYA MAULANA HAFIDTS', 'Teknik Komputer dan Jaringan (TKJ)', '$2y$12$udoUgrQNORcaUCKZ2zZPzuhS1K6Ob7Aypvhaf8T4G5F7toIi2zO2i', NULL, 'XI TKJ 1', '2023/2024', NULL, NULL, NULL, NULL, '2024-10-29 01:22:07', '2024-10-29 01:22:07', 1),
('16702', 'RAYHAN ADITYA PRADHANA', 'Teknik Komputer dan Jaringan (TKJ)', '$2y$12$MsPuuQZeGqJBUM6MEseSuOqYBisGrCcOvdm9gqbLqNq6jborvO.oS', NULL, 'XI TKJ 1', '2023/2024', NULL, NULL, NULL, NULL, '2024-10-29 01:22:07', '2024-10-29 01:22:07', 1),
('16703', 'RAYHAN DAMARJATI WIJANARKO', 'Teknik Komputer dan Jaringan (TKJ)', '$2y$12$EwoD5SpKWXNZF1UkEgMuiuMoJVLzlRAVOzv5oACR.IOUmFFzZYGhm', NULL, 'XI TKJ 1', '2023/2024', NULL, NULL, NULL, NULL, '2024-10-29 01:22:16', '2024-10-29 01:22:16', 1),
('16704', 'Rehan Herdian P', 'Teknik Komputer dan Jaringan (TKJ)', '$2y$12$ngX0PZ0sJ5GbXF4FsFL0VeTFaGOFqbrhs299udqm6ScR9ViFDDgba', NULL, 'XI TKJ 1', '2023/2024', NULL, NULL, NULL, NULL, '2024-10-29 01:22:14', '2024-10-29 01:22:14', 1),
('16706', 'RIBBY SASKIA MECCA', 'Teknik Komputer dan Jaringan (TKJ)', '$2y$12$C.va.hsDjoYOjQ8v/635FO5Q9XmUB8sv7ExGMlSgsd18kBWE3j1K2', NULL, 'XI TKJ 1', '2023/2024', NULL, NULL, NULL, NULL, '2024-10-29 01:22:04', '2024-10-29 01:22:04', 1),
('16707', 'SETO SUJATMIKO', 'Teknik Komputer dan Jaringan (TKJ)', '$2y$12$TRGPXcE.mTVqQpsEK.8Xd.XBQD/4BhPXHgWs77kruPr4konqkno4S', NULL, 'XI TKJ 1', '2023/2024', NULL, NULL, NULL, NULL, '2024-10-29 01:22:06', '2024-10-29 01:22:06', 1),
('16708', 'SUNU WICAKSONO', 'Teknik Komputer dan Jaringan (TKJ)', '$2y$12$RbJOYuxieSgJOLb0FvLCWOR0ZacLba6gKe4Da6C1VIMRVWNxwnSyS', NULL, 'XI TKJ 1', '2023/2024', NULL, NULL, NULL, NULL, '2024-10-29 01:22:05', '2024-10-29 01:22:05', 1),
('16709', 'YOPPY DESYANTO PUJAKUSUMA', 'Teknik Komputer dan Jaringan (TKJ)', '$2y$12$21XHTmalRS16A621isuE6u4LyGwUQcH1Hcbs6ZznQnm7RoLDaWHNy', NULL, 'XI TKJ 1', '2023/2024', NULL, NULL, NULL, NULL, '2024-10-29 01:22:19', '2024-10-29 01:22:19', 1),
('16710', 'Abqori Ikhwanul Wakhidan', 'Teknik Komputer dan Jaringan (TKJ)', '$2y$12$9Zapi/p1vrQOLGnU9QNo4e16x01Hd4k9OIY/UQWnj2XyL29aDaE4O', NULL, 'XI TKJ 2', '2023/2024', NULL, NULL, NULL, NULL, '2024-10-29 01:22:12', '2024-11-28 03:59:29', 1),
('16711', 'ADE DANI OKTAVIAN', 'Teknik Komputer dan Jaringan (TKJ)', 'pw16711', '', 'XI TKJ 2', '2023/2024', 'TKJ2', 'TI003', 'ALBIS Jogja', 'Jl. Parangtritis No.7,5, Cabean, Panggungharjo, Sewon, Bantul, Yogyakarta 55185', '2024-10-07 02:14:45', '2024-11-25 04:05:10', 1),
('16713', 'AIS KHOIRUL RIFAN', 'Teknik Komputer dan Jaringan (TKJ)', '$2y$12$z0pfrd5T6Wr1E.521MqK/OE/zddiDW6emOoC3IvSWgJ8sip7Pw0aa', NULL, 'XI TKJ 2', '2023/2024', NULL, NULL, NULL, NULL, '2024-10-09 02:41:52', '2024-10-25 08:25:42', 1),
('16714', 'AKBAR AVIANTORO', 'Teknik Komputer dan Jaringan (TKJ)', '$2y$12$BDOURag74K0lxnBjzwVZXedtqDP3FHwi31Z0ISK0KFGlgFUPLf7u.', NULL, 'XI TKJ 2', '2023/2024', NULL, NULL, NULL, NULL, '2024-10-29 01:22:15', '2024-10-29 01:22:15', 1),
('16715', 'AMANDA SETYAWATI', 'Teknik Komputer dan Jaringan (TKJ)', '$2y$12$5Ksg0NU.A39HgHyQVuyTEOzw9cINERN1JFfnID1kYmwYOZAaT6sEq', NULL, 'XI TKJ 2', '2023/2024', NULL, NULL, NULL, NULL, '2024-10-29 01:22:03', '2024-11-12 03:28:53', 0),
('16716', 'Ardhan Anandhika', 'Teknik Komputer dan Jaringan (TKJ)', '$2y$12$W2FhnhIVuICL9Ptnn5X.vulDiezvWR/N2hmkFpa0biLwxZdcKsz6S', NULL, 'XI TKJ 2', '2023/2024', NULL, NULL, NULL, NULL, '2024-10-29 01:22:12', '2024-10-29 01:22:12', 1),
('16717', 'ARINA MAULA MANASIKANA', 'Teknik Komputer dan Jaringan (TKJ)', '$2y$12$iWmlrAqvjahe8B7FMnMd1.tnceSXzyoKxpYIYiacAFUR/YhahWohW', NULL, 'XI TKJ 2', '2023/2024', NULL, NULL, NULL, NULL, '2024-10-29 01:22:03', '2024-10-29 01:22:03', 1),
('16718', 'ARYA ALFAH REZA', 'Teknik Komputer dan Jaringan (TKJ)', '$2y$12$jl2rMqJF3bwbPsfXj/iUaeJicudWpMVDdJcZw3xOvdgYWy0kKk34m', NULL, 'XI TKJ 2', '2023/2024', NULL, NULL, NULL, NULL, '2024-10-29 01:22:09', '2024-10-29 01:22:09', 1),
('16719', 'DAFFA RIFKY HAIDAR GHAZWAN', 'Teknik Komputer dan Jaringan (TKJ)', '$2y$12$lqMNjIoTvVV3KyYRiEj0.udHhl9rvpPmdio8dCYjFJfGNdUqv4xzu', NULL, 'XI TKJ 2', '2023/2024', NULL, NULL, NULL, NULL, '2024-10-09 02:41:52', '2024-10-25 08:25:42', 1),
('16720', 'DESTA DWIANGGA', 'Teknik Komputer dan Jaringan (TKJ)', '$2y$12$RXq3DbEP6dU4cV7pbJLrdOK2.7wY2/iyoLA1Ad2y8oAoY.m2930IG', NULL, 'XI TKJ 2', '2023/2024', NULL, NULL, NULL, NULL, '2024-10-12 08:51:18', '2024-10-25 08:25:42', 1),
('16721', 'FATIHAH AL AISYIYAH', 'Teknik Komputer dan Jaringan (TKJ)', '$2y$12$A.gvxEGrU3V8Rqs3b3HrwOjclKjgVp.s4IRcW/POg9FJ1GnFZKS7e', NULL, 'XI TKJ 2', '2023/2024', NULL, NULL, NULL, NULL, '2024-10-29 01:22:09', '2024-10-29 01:22:09', 1),
('16722', 'IBNU FIKRI ARDIANSYAH', 'Teknik Komputer dan Jaringan (TKJ)', '$2y$12$CVjS1GcBGQbkIRz307DjkeMIpnOGeQf7IoggKan/HzjjywTUsRh3S', '', 'XI TKJ 2', '2023/2024', NULL, NULL, NULL, NULL, '2024-10-29 01:22:09', '2024-11-25 02:36:27', 0),
('16723', 'ILHAM KURNIA PUTRA PRAPANCA', 'Teknik Komputer dan Jaringan (TKJ)', '$2y$12$M.1120oDwAKX4Xfsp6zREuvNWrrXjHs218CXjMv/nhwNK0Q0ozbxK', NULL, 'XI TKJ 2', '2023/2024', NULL, NULL, NULL, NULL, '2024-10-09 02:41:51', '2024-10-25 08:25:42', 1),
('16724', 'IRFAN MAULANA', 'Teknik Komputer dan Jaringan (TKJ)', '$2y$12$4UH15YnLn9rPjRVfHt9xA.9z4Cf5SOWHzkMab4MyWCWg/4gR/TgI6', NULL, 'XI TKJ 2', '2023/2024', NULL, NULL, NULL, NULL, '2024-10-29 01:22:15', '2024-10-29 01:22:15', 1),
('16725', 'Jehan Arsyad Setyawan', 'Teknik Komputer dan Jaringan (TKJ)', '$2y$12$6AhaH1KtfFULtu.cxIMGlObtH08jIzNi091wQ0EwsfD9u9Lcs7qxC', NULL, 'XI TKJ 2', '2023/2024', NULL, NULL, NULL, NULL, '2024-10-29 01:22:11', '2024-10-29 01:22:11', 1),
('16726', 'MEYSA TUNGGAL KHARISTA', 'Teknik Komputer dan Jaringan (TKJ)', '$2y$12$QCg./QKRX4v8iytgz50pNebfUlcdS1E8f09gapMco7WsErHHshpbC', NULL, 'XI TKJ 2', '2023/2024', NULL, NULL, NULL, NULL, '2024-10-15 02:48:05', '2024-10-25 08:25:42', 1),
('16727', 'MIFTAH ABIT RAKHALANA', 'Teknik Komputer dan Jaringan (TKJ)', 'pw16727', NULL, 'XI TKJ 2', '2023/2024', 'TKJ2', 'TI003', 'ALBIS Jogja', 'Jl. Parangtritis No.7,5, Cabean, Panggungharjo, Sewon, Bantul, Yogyakarta 55185', '2024-10-07 02:14:44', '2024-10-25 08:25:42', 1),
('16728', 'MUHAMMAD AKMAL RASYID', 'Teknik Komputer dan Jaringan (TKJ)', '$2y$12$/k0D6AdFYPLZPYvwbf2Gw.4NnNonpBwJCRZVdSkIvIeWuVBYoSNpm', '', 'XI TKJ 2', '2023/2024', 'TKJ3', 'TI001', 'Reds Computer', 'Jl. Jogoripon, Geneng, Pendowoharjo, Sewon, Bantul, Yogyakarta 55188', '2024-10-07 00:31:17', '2024-12-07 07:38:26', 0),
('16729', 'MUHAMMAD FAISAL', 'Teknik Komputer dan Jaringan (TKJ)', '$2y$12$PoM2YdAvW4a3BZicgIn6uunz/p59BrDiyoRVR95A2ij1O1wvAZvUW', NULL, 'XI TKJ 2', '2023/2024', NULL, NULL, NULL, NULL, '2024-10-29 01:22:04', '2024-10-29 01:22:04', 1),
('16730', 'MUHAMMAD HAFIDZ SAPUTRA', 'Teknik Komputer dan Jaringan (TKJ)', '$2y$12$s.UQe8aKk.Zs8pEg0//1y.eXbabNF5EXQUPvf94r.L5sw31mb5Cwm', NULL, 'XI TKJ 2', '2023/2024', NULL, NULL, NULL, NULL, '2024-10-29 01:22:05', '2024-10-29 01:22:05', 1),
('16731', 'NABILA NUR RIYANTA', 'Teknik Komputer dan Jaringan (TKJ)', '$2y$12$t6K5PM.q6eKPcmMeIphgtOjLG0ITHaUgrd0mcNNnOJRGM31OFFi4q', NULL, 'XI TKJ 2', '2023/2024', NULL, NULL, NULL, NULL, '2024-10-11 09:57:38', '2024-10-25 08:25:42', 1),
('16732', 'NUR DWI CAHYO', 'Teknik Komputer dan Jaringan (TKJ)', 'pw16732', NULL, 'XI TKJ 2', '2023/2024', 'TKJ3', 'TI001', 'Reds Computer', 'Jl. Jogoripon, Geneng, Pendowoharjo, Sewon, Bantul, Yogyakarta 55188', '2024-10-07 00:31:17', '2024-10-31 08:59:25', 1),
('16733', 'RAHMAT DIKY ALFIANZAH', 'Teknik Komputer dan Jaringan (TKJ)', 'pw16733', NULL, 'XI TKJ 2', '2023/2024', 'TKJ2', 'TI003', 'ALBIS Jogja', 'Jl. Parangtritis No.7,5, Cabean, Panggungharjo, Sewon, Bantul, Yogyakarta 55185', '2024-10-07 02:14:44', '2024-10-25 08:25:42', 1),
('16734', 'RAMA PUTRA LINGGADIYANTO', 'Teknik Komputer dan Jaringan (TKJ)', '$2y$12$BAcaeWkRCx8iMD.kfdf/1OihHYIGQHci12zDli/0skonB.BmcmXs6', NULL, 'XI TKJ 2', '2023/2024', NULL, NULL, NULL, NULL, '2024-11-12 03:30:28', '2024-11-12 03:30:28', 1),
('16735', 'RESTU AGUS JATMIKO', 'Teknik Komputer dan Jaringan (TKJ)', 'pw16735', NULL, 'XI TKJ 2', '2023/2024', 'TKJ3', 'TI001', 'Reds Computer', 'Jl. Jogoripon, Geneng, Pendowoharjo, Sewon, Bantul, Yogyakarta 55188', '2024-10-07 00:31:16', '2024-10-31 08:59:45', 1),
('16736', 'RIZKI WAHYU NURRAHMAN', 'Teknik Komputer dan Jaringan (TKJ)', '$2y$12$TOGcgDFkUFz2H2aQKQuE6uuaSi2W9M.wOIdtISybucr3ucHcg9Rf6', NULL, 'XI TKJ 2', '2023/2024', NULL, NULL, NULL, NULL, '2024-10-12 08:51:19', '2024-10-25 08:25:42', 1),
('16738', 'SINAR ING JAGAD', 'Teknik Komputer dan Jaringan (TKJ)', '$2y$12$t4WwYkeqOal.EQYNZuhfQ.czqhCbLGjFUvv86xsBdeN17vV0I8ZiC', NULL, 'Xl TKJ 2', '2023/2024', NULL, NULL, NULL, NULL, '2024-11-12 03:30:29', '2024-11-12 03:30:29', 1),
('16740', 'TEGUH FIRMANSYAH', 'Teknik Komputer dan Jaringan (TKJ)', '$2y$12$xcT2mtD8GYDNOox7hRRdX.39XtLKd6dDGtLPQXAK2/cpqMTqd3RQ6', NULL, 'XI TKJ 2', '2023/2024', NULL, NULL, NULL, NULL, '2024-10-12 08:51:19', '2024-10-25 08:25:42', 1),
('16741', 'Thomas Yuda Setiawan', 'Teknik Komputer dan Jaringan (TKJ)', '$2y$12$Sf5qPJg09CFCtuJ7wLmDUeRIelCjA1aUylctP4PvsUYR0UZyq1j0O', NULL, 'XI TKJ 2', '2023/2024', NULL, NULL, NULL, NULL, '2024-10-29 01:22:11', '2024-10-29 01:22:11', 1),
('16742', 'TOMI TABAH SUASONO', 'Teknik Komputer dan Jaringan (TKJ)', '$2y$12$7jxQGC0HLbRAdjCc6I248.GIlzE7iec3p.I3CK41YJpNUyqyWWKXq', NULL, 'XI TKJ 2', '2023/2024', NULL, NULL, NULL, NULL, '2024-10-29 01:22:16', '2024-10-29 01:22:16', 1),
('16743', 'Wildan Alghifari', 'Teknik Komputer dan Jaringan (TKJ)', '$2y$12$JJqiVSZIzMNhNj2ojOiqF.RICF2LpDQrz4o3hgslru5sFYIMeDC4a', NULL, 'XI TKJ 2', '2023/2024', NULL, NULL, NULL, NULL, '2024-10-29 01:22:12', '2024-10-29 01:22:12', 1),
('16745', 'ZOLLA ANDRA PANGESTU', 'Teknik Komputer dan Jaringan (TKJ)', '$2y$12$MT4QoIq/GdPbGrG46HwKEOtpaPI7VZGUZU/avfJa0VkaxCh0L32bS', NULL, 'XI TKJ 2', '2023/2024', NULL, NULL, NULL, NULL, '2024-10-29 01:22:15', '2024-10-29 01:22:15', 1),
('17754', 'NAYLA EMMA WAHYUNINGTIYAS', 'Teknik Komputer dan Jaringan (TKJ)', '$2y$12$rhBMLb.6yChMXHfURWWCsuzWWR..a8L5PGalnlE/NFe934Vpa0dAO', NULL, 'XI TKJ 2', '2023/2024', NULL, NULL, NULL, NULL, '2024-10-15 02:48:05', '2024-10-25 08:25:42', 1);

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
  ADD KEY `kode_dudi` (`kode_dudi`),
  ADD KEY `monitoring_ibfk_7` (`NIP_NIK`);

--
-- Indexes for table `monitoring_per_siswa`
--
ALTER TABLE `monitoring_per_siswa`
  ADD PRIMARY KEY (`id_monitoring_persiswa`);

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
  MODIFY `id_evaluasi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `laporan_akhir`
--
ALTER TABLE `laporan_akhir`
  MODIFY `id_laporan_akhir` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `laporan_jurnal`
--
ALTER TABLE `laporan_jurnal`
  MODIFY `id_jurnal` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `laporan_pengimbasan`
--
ALTER TABLE `laporan_pengimbasan`
  MODIFY `id_pengimbasan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `monitoring`
--
ALTER TABLE `monitoring`
  MODIFY `id_monitoring` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `monitoring_per_siswa`
--
ALTER TABLE `monitoring_per_siswa`
  MODIFY `id_monitoring_persiswa` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `nilai_pkl`
--
ALTER TABLE `nilai_pkl`
  MODIFY `id_nilai` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `pengajuan`
--
ALTER TABLE `pengajuan`
  MODIFY `id_pengajuan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `ploting`
--
ALTER TABLE `ploting`
  MODIFY `id_ploting` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

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
  ADD CONSTRAINT `evaluasi_ibfk_2` FOREIGN KEY (`NIS`) REFERENCES `siswa` (`NIS`),
  ADD CONSTRAINT `evaluasi_ibfk_3` FOREIGN KEY (`konsentrasi_keahlian`) REFERENCES `siswa` (`konsentrasi_keahlian`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `evaluasi_ibfk_4` FOREIGN KEY (`kode_dudi`) REFERENCES `dudi` (`kode_dudi`);

--
-- Constraints for table `laporan_akhir`
--
ALTER TABLE `laporan_akhir`
  ADD CONSTRAINT `laporan_akhir_ibfk_1` FOREIGN KEY (`kode_kelompok`) REFERENCES `ploting` (`kode_kelompok`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `laporan_akhir_ibfk_2` FOREIGN KEY (`NIS`) REFERENCES `siswa` (`NIS`),
  ADD CONSTRAINT `laporan_akhir_ibfk_3` FOREIGN KEY (`konsentrasi_keahlian`) REFERENCES `siswa` (`konsentrasi_keahlian`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `laporan_akhir_ibfk_4` FOREIGN KEY (`kode_dudi`) REFERENCES `dudi` (`kode_dudi`);

--
-- Constraints for table `laporan_jurnal`
--
ALTER TABLE `laporan_jurnal`
  ADD CONSTRAINT `laporan_jurnal_ibfk_1` FOREIGN KEY (`NIS`) REFERENCES `siswa` (`NIS`),
  ADD CONSTRAINT `laporan_jurnal_ibfk_2` FOREIGN KEY (`kode_dudi`) REFERENCES `dudi` (`kode_dudi`),
  ADD CONSTRAINT `laporan_jurnal_ibfk_3` FOREIGN KEY (`kode_dudi`) REFERENCES `ploting` (`kode_dudi`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `laporan_pengimbasan`
--
ALTER TABLE `laporan_pengimbasan`
  ADD CONSTRAINT `laporan_pengimbasan_ibfk_2` FOREIGN KEY (`NIS`) REFERENCES `siswa` (`NIS`),
  ADD CONSTRAINT `laporan_pengimbasan_ibfk_3` FOREIGN KEY (`konsentrasi_keahlian`) REFERENCES `siswa` (`konsentrasi_keahlian`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `laporan_pengimbasan_ibfk_4` FOREIGN KEY (`kode_dudi`) REFERENCES `dudi` (`kode_dudi`);

--
-- Constraints for table `monitoring`
--
ALTER TABLE `monitoring`
  ADD CONSTRAINT `monitoring_ibfk_1` FOREIGN KEY (`NIS`) REFERENCES `siswa` (`NIS`),
  ADD CONSTRAINT `monitoring_ibfk_3` FOREIGN KEY (`konsentrasi_keahlian`) REFERENCES `siswa` (`konsentrasi_keahlian`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `monitoring_ibfk_5` FOREIGN KEY (`kode_kelompok`) REFERENCES `ploting` (`kode_kelompok`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `monitoring_ibfk_6` FOREIGN KEY (`NIP_NIK`) REFERENCES `ploting` (`NIP_NIK`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `monitoring_ibfk_7` FOREIGN KEY (`NIP_NIK`) REFERENCES `pembimbing` (`NIP_NIK`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `nilai_pkl`
--
ALTER TABLE `nilai_pkl`
  ADD CONSTRAINT `nilai_pkl_ibfk_1` FOREIGN KEY (`konsentrasi_keahlian`) REFERENCES `siswa` (`konsentrasi_keahlian`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `nilai_pkl_ibfk_2` FOREIGN KEY (`NIS`) REFERENCES `siswa` (`NIS`);

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
  ADD CONSTRAINT `ploting_ibfk_3` FOREIGN KEY (`NIP_NIK`) REFERENCES `pembimbing` (`NIP_NIK`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `ploting_ibfk_4` FOREIGN KEY (`NIS`) REFERENCES `siswa` (`NIS`);

--
-- Constraints for table `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `siswa_ibfk_3` FOREIGN KEY (`kode_dudi`) REFERENCES `ploting` (`kode_dudi`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `siswa_ibfk_4` FOREIGN KEY (`kode_kelompok`) REFERENCES `ploting` (`kode_kelompok`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `siswa_ibfk_5` FOREIGN KEY (`kode_dudi`) REFERENCES `dudi` (`kode_dudi`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
