-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Jan 2023 pada 15.38
-- Versi server: 10.4.21-MariaDB
-- Versi PHP: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spkisal`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `indikator`
--

CREATE TABLE `indikator` (
  `idindikator` int(11) NOT NULL,
  `indikator` varchar(99) NOT NULL,
  `nilai` int(11) NOT NULL,
  `idkriteria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `indikator`
--

INSERT INTO `indikator` (`idindikator`, `indikator`, `nilai`, `idkriteria`) VALUES
(11, 'Sangat Kurang', 1, 4),
(12, 'Kurang', 2, 4),
(13, 'Cukup', 3, 4),
(14, 'Baik', 4, 4),
(15, 'Sangat Baik', 5, 4),
(21, 'SP 3', 4, 2),
(22, 'SP 2', 3, 2),
(23, 'SP 1', 2, 2),
(24, 'Tidak Ada SP', 1, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `karyawan`
--

CREATE TABLE `karyawan` (
  `idkaryawan` int(11) NOT NULL,
  `nama` varchar(63) NOT NULL,
  `jekel` enum('Pria','Wanita') NOT NULL,
  `alamat` text NOT NULL,
  `telepon` char(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `karyawan`
--

INSERT INTO `karyawan` (`idkaryawan`, `nama`, `jekel`, `alamat`, `telepon`) VALUES
(1, 'Fathan Ilalang', 'Pria', 'alamat lengkap\r\n', '08123456789'),
(2, 'Luqman Aditya ', 'Pria', 'alamat lengkap', '08123456789'),
(3, 'Yanuary Romadhon ', 'Pria', 'alamat lengkap', '08123456789'),
(4, 'Bagus Pangarestu ', 'Pria', 'alamat lengkap', '08123456789'),
(5, 'A.Rozak ', 'Pria', 'alamat lengkap', '08123456789');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kriteria`
--

CREATE TABLE `kriteria` (
  `idkriteria` int(11) NOT NULL,
  `kriteria` varchar(36) NOT NULL,
  `kategori` enum('Cost','Benefit') NOT NULL,
  `bobot` int(11) NOT NULL,
  `jenis` enum('input','indikator') NOT NULL,
  `batas` int(11) NOT NULL,
  `satuan` varchar(18) NOT NULL,
  `persentase` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kriteria`
--

INSERT INTO `kriteria` (`idkriteria`, `kriteria`, `kategori`, `bobot`, `jenis`, `batas`, `satuan`, `persentase`) VALUES
(1, 'Kehadiran', 'Benefit', 15, 'input', 26, 'hari', 15),
(2, 'Sikap', 'Cost', 25, 'indikator', 0, '', 25),
(3, 'Kedisiplinan Waktu', 'Benefit', 15, 'input', 210, 'jam', 15),
(4, 'Kreatifitas', 'Benefit', 35, 'indikator', 0, '', 35),
(5, 'Kuantitas', 'Benefit', 10, 'input', 26, 'buah', 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai`
--

CREATE TABLE `nilai` (
  `idnilai` int(11) NOT NULL,
  `indikator` varchar(99) NOT NULL,
  `nilai` int(11) NOT NULL,
  `periode` varchar(18) NOT NULL,
  `idkriteria` int(11) NOT NULL,
  `idkaryawan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `nilai`
--

INSERT INTO `nilai` (`idnilai`, `indikator`, `nilai`, `periode`, `idkriteria`, `idkaryawan`) VALUES
(2, 'SP 1', 3, 'November 2022', 2, 1),
(4, 'Sangat Baik', 5, 'November 2022', 4, 1),
(7, 'Tidak Ada SP', 4, 'November 2022', 2, 2),
(9, 'Baik', 4, 'November 2022', 4, 2),
(12, 'SP 3', 1, 'November 2022', 2, 3),
(14, 'Cukup', 3, 'November 2022', 4, 3),
(17, 'SP 2', 2, 'November 2022', 2, 4),
(18, '>65% dan <=75 %', 4, 'November 2022', 3, 4),
(19, 'Baik', 4, 'November 2022', 4, 4),
(22, 'SP 2', 2, 'November 2022', 2, 5),
(24, 'Sangat Baik', 5, 'November 2022', 4, 5),
(27, 'SP 2', 2, 'Desember 2022', 2, 2),
(29, 'SP 2', 2, 'Desember 2022', 2, 1),
(31, 'Cukup', 3, 'Desember 2022', 4, 1),
(36, 'Tidak Ada SP', 4, 'Desember 2022', 2, 3),
(37, 'Tidak Ada SP', 4, 'Desember 2022', 2, 4),
(38, 'SP 1', 3, 'Desember 2022', 2, 5),
(39, '>20% dan <=45%', 2, 'Desember 2022', 3, 2),
(40, '>65% dan <=75 %', 4, 'Desember 2022', 3, 3),
(41, '>45% dan <=65%', 3, 'Desember 2022', 3, 4),
(42, '>65% dan <=75 %', 4, 'Desember 2022', 3, 5),
(43, 'Baik', 4, 'Desember 2022', 4, 5),
(44, 'Baik', 4, 'Desember 2022', 4, 3),
(45, 'Sangat Kurang', 1, 'Desember 2022', 4, 4),
(46, 'Baik', 4, 'Desember 2022', 4, 2),
(51, '26 hari', 26, 'Januari 2023', 1, 1),
(52, '25 hari', 25, 'Januari 2023', 1, 2),
(53, '175 jam', 175, 'Januari 2023', 3, 2),
(54, '182 jam', 182, 'Januari 2023', 3, 3),
(55, 'SP 1', 2, 'Januari 2023', 2, 1),
(56, 'Sangat Baik', 5, 'Januari 2023', 4, 1),
(57, '26 buah', 26, 'Januari 2023', 5, 1),
(58, 'Tidak Ada SP', 1, 'Januari 2023', 2, 2),
(59, '26 hari', 26, 'Januari 2023', 1, 3),
(60, '24 hari', 24, 'Januari 2023', 1, 4),
(61, '23 hari', 23, 'Januari 2023', 1, 5),
(62, 'Tidak Ada SP', 1, 'Januari 2023', 2, 3),
(63, 'SP 2', 3, 'Januari 2023', 2, 4),
(64, '182 jam', 182, 'Januari 2023', 3, 1),
(65, '168 jam', 168, 'Januari 2023', 3, 4),
(66, '161 jam', 161, 'Januari 2023', 3, 5),
(67, 'Baik', 4, 'Januari 2023', 4, 2),
(68, 'Cukup', 3, 'Januari 2023', 4, 3),
(69, 'Baik', 4, 'Januari 2023', 4, 4),
(70, 'Sangat Baik', 5, 'Januari 2023', 4, 5),
(71, '24 buah', 24, 'Januari 2023', 5, 2),
(72, '26 buah', 26, 'Januari 2023', 5, 3),
(73, '23 buah', 23, 'Januari 2023', 5, 4),
(74, '23 buah', 23, 'Januari 2023', 5, 5),
(75, 'SP 3', 4, 'Januari 2023', 2, 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilaiakhir`
--

CREATE TABLE `nilaiakhir` (
  `idnilai` int(11) NOT NULL,
  `na` double NOT NULL,
  `periode` varchar(18) NOT NULL,
  `idkaryawan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `nilaiakhir`
--

INSERT INTO `nilaiakhir` (`idnilai`, `na`, `periode`, `idkaryawan`) VALUES
(1, 78.75, 'November 2022', 1),
(2, 66.92, 'November 2022', 2),
(3, 55.5, 'November 2022', 3),
(4, 59, 'November 2022', 4),
(5, 75, 'November 2022', 5),
(6, 70, 'Desember 2022', 1),
(7, 81.75, 'Desember 2022', 2),
(8, 82.25, 'Desember 2022', 3),
(9, 63.33, 'Desember 2022', 4),
(10, 76, 'Desember 2022', 5),
(11, 87.5, 'Januari 2023', 1),
(12, 91.08, 'Januari 2023', 2),
(13, 86, 'Januari 2023', 3),
(14, 72.87, 'Januari 2023', 4),
(15, 76.63, 'Januari 2023', 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengguna`
--

CREATE TABLE `pengguna` (
  `username` varchar(99) NOT NULL,
  `password` char(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pengguna`
--

INSERT INTO `pengguna` (`username`, `password`) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `indikator`
--
ALTER TABLE `indikator`
  ADD PRIMARY KEY (`idindikator`);

--
-- Indeks untuk tabel `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`idkaryawan`);

--
-- Indeks untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`idkriteria`);

--
-- Indeks untuk tabel `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`idnilai`);

--
-- Indeks untuk tabel `nilaiakhir`
--
ALTER TABLE `nilaiakhir`
  ADD PRIMARY KEY (`idnilai`);

--
-- Indeks untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `indikator`
--
ALTER TABLE `indikator`
  MODIFY `idindikator` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `idkaryawan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `idkriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `nilai`
--
ALTER TABLE `nilai`
  MODIFY `idnilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT untuk tabel `nilaiakhir`
--
ALTER TABLE `nilaiakhir`
  MODIFY `idnilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
