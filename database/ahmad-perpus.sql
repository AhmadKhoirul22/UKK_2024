-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 27, 2024 at 10:42 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ahmad-perpus`
--

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id_buku` int(11) NOT NULL,
  `judul` varchar(50) NOT NULL,
  `penulis` varchar(50) NOT NULL,
  `penerbit` varchar(50) NOT NULL,
  `tahun_terbit` year(4) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id_buku`, `judul`, `penulis`, `penerbit`, `tahun_terbit`, `id_kategori`, `jumlah`) VALUES
(1, 'Html, Css dan Js', 'Erlangga', 'Kurikulum Merdeka', 2022, 3, 9),
(2, 'Wayang', 'Erlangga', 'Kurikulum Merdeka', 2019, 5, 9),
(4, 'Puisi Jenaka', 'Erlangga', 'Kurikulum Merdeka', 2020, 4, 10),
(5, 'Php', 'Erlangga', 'Kurikulum Merdeka', 2015, 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `denda`
--

CREATE TABLE `denda` (
  `id_denda` int(11) NOT NULL,
  `harga_denda` int(11) NOT NULL,
  `status` enum('BERLAKU','TIDAK BERLAKU') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `denda`
--

INSERT INTO `denda` (`id_denda`, `harga_denda`, `status`) VALUES
(9, 5000, 'TIDAK BERLAKU'),
(10, 7500, 'BERLAKU');

-- --------------------------------------------------------

--
-- Table structure for table `denda_peminjaman`
--

CREATE TABLE `denda_peminjaman` (
  `id` int(11) NOT NULL,
  `kode_peminjaman` int(11) NOT NULL,
  `denda` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `denda_peminjaman`
--

INSERT INTO `denda_peminjaman` (`id`, `kode_peminjaman`, `denda`) VALUES
(5, 8910, 0),
(7, 7564, 18000),
(8, 3974, 45000),
(9, 7548, 60000),
(10, 835, 0),
(11, 6230, 0);

-- --------------------------------------------------------

--
-- Table structure for table `detail_peminjaman`
--

CREATE TABLE `detail_peminjaman` (
  `id_detail` int(11) NOT NULL,
  `kode_peminjaman` int(11) NOT NULL,
  `id_buku` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_peminjaman`
--

INSERT INTO `detail_peminjaman` (`id_detail`, `kode_peminjaman`, `id_buku`) VALUES
(4, 8910, 1),
(5, 8910, 2),
(6, 8910, 4),
(7, 7564, 1),
(8, 7564, 2),
(9, 3974, 2),
(10, 3974, 4),
(11, 4937, 5),
(12, 7548, 2),
(13, 7548, 4),
(14, 3740, 1),
(15, 3740, 2),
(16, 835, 4),
(17, 6230, 2),
(18, 6230, 4);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(3, 'Ilmu Teknologi '),
(4, 'Bahasa Indonesia'),
(5, 'Bahasa Jawa');

-- --------------------------------------------------------

--
-- Table structure for table `koleksi`
--

CREATE TABLE `koleksi` (
  `id_koleksi` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_buku` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `koleksi`
--

INSERT INTO `koleksi` (`id_koleksi`, `id_user`, `id_buku`) VALUES
(9, 4, 1),
(11, 4, 5),
(25, 7, 1),
(32, 5, 4);

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id_peminjaman` int(11) NOT NULL,
  `kode_peminjaman` int(11) NOT NULL,
  `tanggal_peminjaman` date NOT NULL,
  `tanggal_pengembalian` date NOT NULL,
  `tanggal_kembali` date NOT NULL,
  `status` enum('DIPINJAM','DIKEMBALIKAN') NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`id_peminjaman`, `kode_peminjaman`, `tanggal_peminjaman`, `tanggal_pengembalian`, `tanggal_kembali`, `status`, `id_user`) VALUES
(1, 8910, '2024-09-25', '2024-09-28', '2024-09-25', 'DIKEMBALIKAN', 5),
(2, 7564, '2024-09-25', '2024-09-28', '2024-09-30', 'DIKEMBALIKAN', 4),
(3, 3974, '2024-09-26', '2024-09-29', '2024-10-02', 'DIKEMBALIKAN', 5),
(4, 4937, '2024-09-26', '2024-09-29', '0000-00-00', 'DIPINJAM', 5),
(5, 7548, '2024-09-17', '2024-09-20', '2024-09-26', 'DIKEMBALIKAN', 7),
(6, 3740, '2024-09-27', '2024-09-30', '0000-00-00', 'DIPINJAM', 7),
(7, 835, '2024-09-27', '2024-09-30', '2024-09-27', 'DIKEMBALIKAN', 11),
(8, 6230, '2024-09-27', '2024-09-30', '2024-09-27', 'DIKEMBALIKAN', 5);

-- --------------------------------------------------------

--
-- Table structure for table `temp`
--

CREATE TABLE `temp` (
  `id_temp` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_buku` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `temp`
--

INSERT INTO `temp` (`id_temp`, `id_user`, `id_buku`) VALUES
(15, 4, 5),
(21, 4, 1),
(31, 7, 1),
(32, 7, 5),
(33, 7, 2),
(41, 11, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ulasan`
--

CREATE TABLE `ulasan` (
  `id_ulasan` int(11) NOT NULL,
  `id_buku` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `ulasan` text NOT NULL,
  `rating` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ulasan`
--

INSERT INTO `ulasan` (`id_ulasan`, `id_buku`, `id_user`, `ulasan`, `rating`) VALUES
(2, 2, 4, 'wayangg sangatt baguss\r\n', 4),
(3, 1, 4, 'buku baguss', 5),
(5, 2, 7, 'wayangg sangatt beragam, wajib dilestarikan\r\n', 5),
(6, 4, 7, 'sangatt menghiburr', 4),
(7, 2, 5, 'budaya yang masih fresh\r\n', 5),
(9, 4, 11, 'sangat \r\n', 4),
(10, 1, 5, 'sangat bermanfaat', 4),
(11, 4, 5, 'sangatt menarik untuk dibaca', 4),
(12, 5, 5, 'bisa membuat web saya yang awalnya statis, menjadi dinamis', 5);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `email` varchar(50) NOT NULL,
  `level` enum('ADMIN','PETUGAS','PEMINJAM') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama`, `username`, `password`, `alamat`, `email`, `level`) VALUES
(1, 'ahmad', 'ahmad', '61243c7b9a4022cb3f8dc3106767ed12', 'pereng, mojogedang', 'ahmad@gmail.com', 'ADMIN'),
(2, 'huda', 'huda', '0075a4e7a2e71083262da135ecdbdd14', 'karanganyar', 'huda@gamil.com', 'PETUGAS'),
(4, 'andi ganetngg', 'andi', 'ce0e5bf55e4f71749eade7a8b95c4e46', 'tawangmangu', 'andi@gmail.com', 'PEMINJAM'),
(5, 'bang dika✅', 'dika', 'e9ce15bcebcedde2cb3cf9fe8f84fc0c', 'tegal', 'dika@gmail.com', 'PEMINJAM'),
(6, 'test bangget lohh', 'test', '8dd48d6a2e2cad213179a3992c0be53c', 'jambangan', 'test@gmail.com', 'ADMIN'),
(7, 'aan✅', 'aan', '4607ed4bd8140e9664875f907f48ae14', 'bagian timur', 'aan@gmail.com', 'PEMINJAM'),
(8, 'aaamat', 'amat', 'c6c6eabaf10b3a79d73cd5810a56643e', 'pereng, mojogedang, karanganyar\r\n', 'amat@gmail.com', 'PEMINJAM'),
(11, 'luqman❎', 'luqman', '4781c13b4bf9b7288a343fd274ff0310', 'bedoyo pereng mojogedang karanganyar', 'luqman@gmail.com', 'PEMINJAM'),
(12, 'admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'banten', 'admin@gmail.com', 'ADMIN'),
(15, 'koko', 'koko', '37f525e2b6fc3cb4abd882f708ab80eb', '', 'koko@gmail.com', 'PEMINJAM'),
(16, 'rara', 'rara', 'd8830ed2c45610e528dff4cb229524e9', '', 'rara@gmail.com', 'PEMINJAM');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`);

--
-- Indexes for table `denda`
--
ALTER TABLE `denda`
  ADD PRIMARY KEY (`id_denda`);

--
-- Indexes for table `denda_peminjaman`
--
ALTER TABLE `denda_peminjaman`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_peminjaman`
--
ALTER TABLE `detail_peminjaman`
  ADD PRIMARY KEY (`id_detail`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `koleksi`
--
ALTER TABLE `koleksi`
  ADD PRIMARY KEY (`id_koleksi`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id_peminjaman`);

--
-- Indexes for table `temp`
--
ALTER TABLE `temp`
  ADD PRIMARY KEY (`id_temp`);

--
-- Indexes for table `ulasan`
--
ALTER TABLE `ulasan`
  ADD PRIMARY KEY (`id_ulasan`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `denda`
--
ALTER TABLE `denda`
  MODIFY `id_denda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `denda_peminjaman`
--
ALTER TABLE `denda_peminjaman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `detail_peminjaman`
--
ALTER TABLE `detail_peminjaman`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `koleksi`
--
ALTER TABLE `koleksi`
  MODIFY `id_koleksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id_peminjaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `temp`
--
ALTER TABLE `temp`
  MODIFY `id_temp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `ulasan`
--
ALTER TABLE `ulasan`
  MODIFY `id_ulasan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
