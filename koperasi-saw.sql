-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 15, 2024 at 07:39 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `koperasi-saw`
--

-- --------------------------------------------------------

--
-- Table structure for table `anggota`
--

CREATE TABLE `anggota` (
  `id_anggota` int(11) NOT NULL,
  `nama_anggota` varchar(255) DEFAULT NULL,
  `tingkat_golongan_asn` varchar(50) DEFAULT NULL,
  `jangka_waktu_pinjam` int(11) DEFAULT NULL,
  `realisasi_pencairan` decimal(15,2) DEFAULT NULL,
  `jasa_diterima` decimal(15,2) DEFAULT NULL,
  `frekuensi_pinjaman` int(11) DEFAULT NULL,
  `jumlah_modal` decimal(15,2) DEFAULT NULL,
  `tgl_terdaftar` date DEFAULT NULL,
  `intensitas_simpanan_wajib` decimal(10,6) DEFAULT NULL,
  `intensitas_angsuran` decimal(15,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `anggota`
--

INSERT INTO `anggota` (`id_anggota`, `nama_anggota`, `tingkat_golongan_asn`, `jangka_waktu_pinjam`, `realisasi_pencairan`, `jasa_diterima`, `frekuensi_pinjaman`, `jumlah_modal`, `tgl_terdaftar`, `intensitas_simpanan_wajib`, `intensitas_angsuran`) VALUES
(22, 'Yanuar Hadi', 'Gol. I', 10, '20000000.00', '833000.00', 6, '1.00', '2019-01-11', '0.005782', '902750.00'),
(23, 'Wahyu Susilo', 'Gol. I', 10, '10000000.00', '833000.00', 5, '0.00', '2019-02-13', '0.001156', '902750.00'),
(24, 'Doso Putri Susanti', 'Gol. III', 36, '20000000.00', '2165800.00', 3, '1.00', '2018-05-21', '0.027753', '1546224.07'),
(25, 'Achmad Imam Yahya', 'Gol. II', 60, '25000000.00', '2915500.00', 5, '1.00', '2017-09-07', '0.013876', '2326291.66'),
(26, 'Dahliana Lubis, Sp.MM', 'Gol. IV', 3, '60000000.00', '3498600.00', 4, '1.00', '2021-01-29', '0.055505', '2583216.67'),
(27, 'Muhammad Amin', 'Gol. II', 60, '40000000.00', '1332800.00', 2, '1.00', '2017-12-12', '0.013876', '333288.89'),
(28, 'Hadhina Anugrah', 'Gol. II', 36, '40000000.00', '2665600.00', 5, '1.00', '2018-01-11', '0.011564', '1518429.63'),
(29, 'Budi Kuncahyo', 'HONORER', 8, '10000000.00', '749700.00', 6, '0.00', '2018-04-10', '0.002313', '744293.18'),
(30, 'Nur Hajati', 'Gol. II', 35, '30000000.00', '3581900.00', 3, '1.00', '2018-07-03', '0.013876', '2347102.78'),
(31, 'Ir. Dwi Prasetyo', 'Gol. III', 60, '15000000.00', '249900.00', 4, '1.00', '2017-08-16', '0.023127', '124991.67');

-- --------------------------------------------------------

--
-- Table structure for table `detail_hasil`
--

CREATE TABLE `detail_hasil` (
  `id_detail_hasil` int(11) NOT NULL,
  `id_hasil` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `nilai_akhir` float NOT NULL,
  `ranking` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_hasil`
--

INSERT INTO `detail_hasil` (`id_detail_hasil`, `id_hasil`, `nama`, `nilai_akhir`, `ranking`) VALUES
(1, 8, 'Doso Putri Susanti', 0.964, 1),
(2, 8, 'Yanuar Hadi', 0.87, 2),
(3, 8, 'Wahyu Susilo', 0.87, 3),
(4, 9, 'Yanuar Hadi', 0.91, 1),
(5, 9, 'Wahyu Susilo', 0.91, 2);

-- --------------------------------------------------------

--
-- Table structure for table `hasil`
--

CREATE TABLE `hasil` (
  `id_hasil` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hasil`
--

INSERT INTO `hasil` (`id_hasil`, `created_at`) VALUES
(9, '2024-09-25 11:41:15');

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE `kriteria` (
  `id_kriteria` int(11) NOT NULL,
  `nama_kriteria` varchar(255) NOT NULL,
  `bobot` float NOT NULL,
  `jenis` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `nama_kriteria`, `bobot`, `jenis`) VALUES
(1, 'Tingkat Golongan ASN', 0.02, 'Benefit'),
(2, 'Lamanya Jangka Waktu Pinjam', 0.05, 'Benefit'),
(3, 'Banyaknya realisasi pencairan (1 tahun)', 0.05, 'Benefit'),
(4, 'Besarnya jasa yang diterima', 0.09, 'Benefit'),
(5, 'Frekuensi jumlah pinjaman', 0.09, 'Benefit'),
(6, 'Banyaknya jumlah modal (1 tahun)', 0.14, 'Benefit'),
(7, 'Tanggal terdaftar sebagai anggota', 0.16, 'Benefit'),
(8, 'Intensitas transaksi simpanan wajib (1 tahun)', 0.19, 'Benefit'),
(9, 'Intensitas angsuran pinjaman', 0.21, 'Benefit');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `nama`, `username`, `password`, `role`) VALUES
(1, 'admin', 'admin', '0192023a7bbd73250516f069df18b500', 'admin'),
(2, 'Kepala Koperasi', 'kepkoperasi', '222730d51731b6b3cf23368d14378dc0', 'Kepala Koperasi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`id_anggota`);

--
-- Indexes for table `detail_hasil`
--
ALTER TABLE `detail_hasil`
  ADD PRIMARY KEY (`id_detail_hasil`);

--
-- Indexes for table `hasil`
--
ALTER TABLE `hasil`
  ADD PRIMARY KEY (`id_hasil`);

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anggota`
--
ALTER TABLE `anggota`
  MODIFY `id_anggota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `detail_hasil`
--
ALTER TABLE `detail_hasil`
  MODIFY `id_detail_hasil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `hasil`
--
ALTER TABLE `hasil`
  MODIFY `id_hasil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
