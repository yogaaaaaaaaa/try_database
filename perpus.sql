-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 09 Sep 2023 pada 14.32
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpus`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `pinjam`
--

CREATE TABLE `pinjam` (
  `id_pinjam` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `mobile` varchar(13) NOT NULL,
  `buku` varchar(100) NOT NULL,
  `tgl_pinjam` timestamp NOT NULL DEFAULT current_timestamp(),
  `tgl_kembali` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pinjam`
--

INSERT INTO `pinjam` (`id_pinjam`, `name`, `mobile`, `buku`, `tgl_pinjam`, `tgl_kembali`) VALUES
(1, 'Agus', '0851578871', 'Algoritma Pemograman', '2023-09-08 23:03:09', '2023-09-16'),
(13, 'Wati', '0871465995', 'Panduan Bernyanyi', '2023-09-09 12:05:43', '2023-09-16'),
(14, 'Nasrul', '0895238155', 'Pemograman Dasar', '2023-09-09 12:06:19', '2023-09-16'),
(15, 'Nurul', '0878145687', 'Puisi', '2023-09-09 12:07:22', '2023-09-16'),
(16, 'Haris', '0895782321', 'Pemograman Dasar', '2023-09-09 12:08:01', '2023-09-16');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `pinjam`
--
ALTER TABLE `pinjam`
  ADD PRIMARY KEY (`id_pinjam`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `pinjam`
--
ALTER TABLE `pinjam`
  MODIFY `id_pinjam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
