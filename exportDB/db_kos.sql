-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 03 Des 2019 pada 06.31
-- Versi server: 10.1.30-MariaDB
-- Versi PHP: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_kos`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id_admin` int(11) NOT NULL,
  `nama_admin` varchar(200) NOT NULL,
  `alamat_admin` varchar(300) NOT NULL,
  `telp_admin` varchar(15) NOT NULL,
  `username` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_admin`
--

INSERT INTO `tbl_admin` (`id_admin`, `nama_admin`, `alamat_admin`, `telp_admin`, `username`) VALUES
(1, 'Ayek', 'Sumenep', '081122334455', 'admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_akun`
--

CREATE TABLE `tbl_akun` (
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_akun`
--

INSERT INTO `tbl_akun` (`username`, `password`, `level`) VALUES
('admin', '$2y$10$cZK1TAh2Kj9yRrbdDY9i0ug2hbMhTBJfov7EoBPvbhEf8H41xBSYW', 1),
('denikos', '$2y$10$7ZnCusaLV0894TFe.2Dx4O8rOUhxJElyAWO5moiIWGX3Pw5nuUv5S', 2),
('ginakos', '$2y$10$1KfBfe5adDfVvfUd8bpBvu4nZgBZhlfdjyRqP/j4e860EfWVgbOnG', 2),
('ifankos', '$2y$10$dHhNgM3gW0dmXYwMVdKeB.A2nFQnNNp7v.7.awuxgHaLS6yYLwOMi', 2),
('luqman', '$2y$10$m73obvBpffO7EERFZCcS3.Ae4HhEMwPbJ0SJsdUEGWxseaG9.6F5K', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_kamar`
--

CREATE TABLE `tbl_kamar` (
  `id_kamar` int(11) NOT NULL,
  `harga_kamar` int(11) NOT NULL,
  `status_kamar` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_kamar`
--

INSERT INTO `tbl_kamar` (`id_kamar`, `harga_kamar`, `status_kamar`) VALUES
(1, 500000, 0),
(2, 500000, 1),
(3, 500000, 0),
(4, 500000, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_penyewa`
--

CREATE TABLE `tbl_penyewa` (
  `id_penyewa` int(11) NOT NULL,
  `nama_penyewa` varchar(200) NOT NULL,
  `alamat_penyewa` varchar(300) NOT NULL,
  `telp_penyewa` varchar(15) NOT NULL,
  `username` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_penyewa`
--

INSERT INTO `tbl_penyewa` (`id_penyewa`, `nama_penyewa`, `alamat_penyewa`, `telp_penyewa`, `username`) VALUES
(1, 'Ifan Binasrillah', 'Sumenep', '085111111111', 'ifankos'),
(2, 'Deni', 'Sumenep', '085222222222', 'denikos'),
(5, 'Luqman', 'Lamongan', '08888888888', 'luqman'),
(6, 'Gina', 'Sumenep', '085111111111', 'ginakos');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_sewa`
--

CREATE TABLE `tbl_sewa` (
  `id_sewa` int(11) NOT NULL,
  `id_kamar` int(11) NOT NULL,
  `id_penyewa` int(11) NOT NULL,
  `id_admin` int(11) NOT NULL,
  `tgl_sewa` date NOT NULL,
  `lama_sewa` int(11) NOT NULL,
  `status_pembayaran` tinyint(1) NOT NULL,
  `status_sewa` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_sewa`
--

INSERT INTO `tbl_sewa` (`id_sewa`, `id_kamar`, `id_penyewa`, `id_admin`, `tgl_sewa`, `lama_sewa`, `status_pembayaran`, `status_sewa`) VALUES
(1, 1, 1, 1, '2019-12-02', 3, 1, 1),
(2, 2, 2, 1, '2019-11-01', 2, 1, 0),
(3, 3, 5, 1, '2019-12-03', 6, 0, 1),
(6, 4, 6, 1, '2019-12-01', 3, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD KEY `2` (`username`);

--
-- Indeks untuk tabel `tbl_akun`
--
ALTER TABLE `tbl_akun`
  ADD PRIMARY KEY (`username`);

--
-- Indeks untuk tabel `tbl_kamar`
--
ALTER TABLE `tbl_kamar`
  ADD PRIMARY KEY (`id_kamar`);

--
-- Indeks untuk tabel `tbl_penyewa`
--
ALTER TABLE `tbl_penyewa`
  ADD PRIMARY KEY (`id_penyewa`),
  ADD KEY `4` (`username`);

--
-- Indeks untuk tabel `tbl_sewa`
--
ALTER TABLE `tbl_sewa`
  ADD PRIMARY KEY (`id_sewa`),
  ADD KEY `admin` (`id_admin`),
  ADD KEY `penyewa` (`id_penyewa`),
  ADD KEY `kamar` (`id_kamar`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tbl_kamar`
--
ALTER TABLE `tbl_kamar`
  MODIFY `id_kamar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tbl_penyewa`
--
ALTER TABLE `tbl_penyewa`
  MODIFY `id_penyewa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tbl_sewa`
--
ALTER TABLE `tbl_sewa`
  MODIFY `id_sewa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD CONSTRAINT `2` FOREIGN KEY (`username`) REFERENCES `tbl_akun` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tbl_penyewa`
--
ALTER TABLE `tbl_penyewa`
  ADD CONSTRAINT `4` FOREIGN KEY (`username`) REFERENCES `tbl_akun` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tbl_sewa`
--
ALTER TABLE `tbl_sewa`
  ADD CONSTRAINT `admin` FOREIGN KEY (`id_admin`) REFERENCES `tbl_admin` (`id_admin`) ON UPDATE CASCADE,
  ADD CONSTRAINT `kamar` FOREIGN KEY (`id_kamar`) REFERENCES `tbl_kamar` (`id_kamar`) ON UPDATE CASCADE,
  ADD CONSTRAINT `penyewa` FOREIGN KEY (`id_penyewa`) REFERENCES `tbl_penyewa` (`id_penyewa`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
