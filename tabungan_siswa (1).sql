-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 11 Jun 2024 pada 16.32
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tabungan_siswa`
--

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `data_lengkap`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `data_lengkap` (
`nisn` varchar(20)
,`nama` varchar(100)
,`tanggal_lahir` date
,`nomor_telepon` varchar(15)
,`saldo` decimal(15,2)
,`nomor_tabungan` varchar(20)
);

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail`
--

CREATE TABLE `detail` (
  `id_detail` int(11) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `saldo_awal` decimal(15,2) DEFAULT NULL,
  `saldo_akhir` decimal(15,2) DEFAULT NULL,
  `nomor_tabungan` varchar(20) DEFAULT NULL,
  `histori` varchar(10) NOT NULL,
  `nominal` decimal(15,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `detail`
--

INSERT INTO `detail` (`id_detail`, `tanggal`, `saldo_awal`, `saldo_akhir`, `nomor_tabungan`, `histori`, `nominal`) VALUES
(37, '2024-06-08', 10000.00, 10001.00, 'T001', 'Penyetoran', 1.00),
(38, '2024-06-08', 10001.00, 10100.00, 'T001', 'Penyetoran', 99.00),
(39, '2024-06-08', 10100.00, 10211.00, 'T001', 'Penyetoran', 111.00),
(40, '2024-06-08', 10211.00, 10310.00, 'T001', 'Penyetoran', 99.00),
(41, '2024-06-08', 10310.00, 10311.00, 'T001', 'Penyetoran', 1.00),
(42, '2024-06-08', 10311.00, 10300.00, 'T001', 'Penarikan', 11.00),
(43, '2024-06-08', 10300.00, 10301.00, 'T001', 'Penyetoran', 1.00),
(44, '2024-06-08', 10301.00, 10302.00, 'T001', 'Penyetoran', 1.00),
(45, '2024-06-08', 10302.00, 10179.00, 'T001', 'Penarikan', 123.00),
(46, '2024-06-08', 10179.00, 10000.00, 'T001', 'Penarikan', 179.00),
(47, '2024-06-09', 0.00, 10000.00, 'T002', 'Penyetoran', 10000.00);

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_resets_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa`
--

CREATE TABLE `siswa` (
  `nisn` varchar(20) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `nomor_telepon` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `siswa`
--

INSERT INTO `siswa` (`nisn`, `nama`, `tanggal_lahir`, `nomor_telepon`) VALUES
('01234567890123456789', 'Joko', '1997-06-11', '081123456789'),
('0987123', 'Budiono Siregar', '2024-06-20', '08976612321'),
('09876543210987654321', 'Kiki', '1996-03-25', '081234567890'),
('10987654321098765432', 'Tono', '1987-08-08', '081123456789'),
('12345678901234567890', 'Ani', '2005-02-12', '081234567890'),
('21098765432109876543', 'Sari', '1988-05-26', '081012345678'),
('23456789012345678901', 'Budi', '2004-07-23', '081345678901'),
('32109876543210987654', 'Rudi', '1989-12-14', '081901234567'),
('34567890123456789012', 'Citra', '2003-11-05', '081456789012'),
('43210987654321098765', 'Qori', '1990-09-02', '081890123456'),
('45678901234567890123', 'Dika', '2006-04-17', '081567890123'),
('54321098765432109876', 'Putri', '1991-04-10', '081789012345'),
('56789012345678901234', 'Eka', '2002-09-30', '081678901234'),
('65432109876543210987', 'Omar', '1992-11-29', '081678901234'),
('67890123456789012345', 'Fani', '2001-12-22', '081789012345'),
('76543210987654321098', 'Nina', '1993-07-07', '081567890123'),
('78901234567890123456', 'Gilang', '2000-05-14', '081890123456'),
('87654321098765432109', 'Mira', '1994-02-03', '081456789012'),
('89012345678901234567', 'Hani', '1999-08-27', '081901234567'),
('90123456789012345678', 'Indra', '1998-01-09', '081012345678'),
('98765432109876543210', 'Lina', '1995-10-18', '081345678901');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tabungan`
--

CREATE TABLE `tabungan` (
  `nomor_tabungan` varchar(20) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `saldo` decimal(15,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tabungan`
--

INSERT INTO `tabungan` (`nomor_tabungan`, `nama`, `saldo`) VALUES
('T001', 'Budiono Siregar', 10000.00),
('T002', 'Joko', 10000.00),
('T003', 'Kiki', 0.00),
('T004', 'Putri', 0.00);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`) VALUES
(2, 'Kei', 'liluluuuuuuuu@gmail.com', '$2y$10$p4MEA3w18W.jN3XGXxBFJeJ8vywgJqSOHYHJuyhN5r22sv0YY4nvy', 'admin'),
(6, 'Budiono Siregar', 'tesakun123@gmail.com', '$2y$10$BKqrGNSCWyBytXGszgUCiOcZzdVca0NJnECVLZWnm5BrEUBDgv81y', 'user'),
(7, 'Citra', 'citralestari@gmail.com', '$2y$10$BEH7NGHAL5EamW5HiP5.feVvJva/Ck28nGakZv1/jyAhSLfwzkmWG', 'user'),
(9, 'Dika', 'dikaganteng123@gmail.com', '$2y$10$t7R/6xsYKnmclnatqeAUr.4MU2cEI3C3mPZsI0hWG09Tj34SfmhJK', 'user'),
(10, 'Kiki', 'kikikikikiki@gmail.com', '$2y$10$wRZKsLlOzr/auAAdhhNC.OjphleH4w2A0GoudlI2kVmXLgk7191..', 'user');

-- --------------------------------------------------------

--
-- Struktur untuk view `data_lengkap`
--
DROP TABLE IF EXISTS `data_lengkap`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `data_lengkap`  AS SELECT `siswa`.`nisn` AS `nisn`, `siswa`.`nama` AS `nama`, `siswa`.`tanggal_lahir` AS `tanggal_lahir`, `siswa`.`nomor_telepon` AS `nomor_telepon`, `tabungan`.`saldo` AS `saldo`, `tabungan`.`nomor_tabungan` AS `nomor_tabungan` FROM (`siswa` left join `tabungan` on(`siswa`.`nama` = `tabungan`.`nama`)) ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `detail`
--
ALTER TABLE `detail`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `nomor_tabungan` (`nomor_tabungan`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`nisn`);

--
-- Indeks untuk tabel `tabungan`
--
ALTER TABLE `tabungan`
  ADD PRIMARY KEY (`nomor_tabungan`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `detail`
--
ALTER TABLE `detail`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `detail`
--
ALTER TABLE `detail`
  ADD CONSTRAINT `detail_ibfk_1` FOREIGN KEY (`nomor_tabungan`) REFERENCES `tabungan` (`nomor_tabungan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
