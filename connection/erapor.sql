-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 03, 2023 at 02:41 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `erapor`
--

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `nip` int(30) NOT NULL,
  `kelas` varchar(10) NOT NULL,
  `keterangan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`id`, `nama`, `nip`, `kelas`, `keterangan`) VALUES
(1, 'SITI SUKARTINI, S.Pd', 19640522, 'I', ''),
(2, 'KURINIH, S.Pd.SD', 19660427, 'II', ''),
(3, 'SUNARTO, S.Pd', 19710620, 'VI', ''),
(4, 'ERYANI, S.Pd.I', 0, 'I-VI', ''),
(5, 'SUGIARTO, S.Pd', 0, 'I-VI', ''),
(6, 'DEDE KUNAENIH, S.Pd', 0, 'IV A', ''),
(7, 'WARSIDI, S.Pd', 1, 'V', 'GURU'),
(8, 'SITI HALIMAH, S.Pd.SD', 0, 'IV B', ''),
(9, 'SIRATNA NINGSIH, A.Ma.Pust', 1, 'V', 'GURU'),
(10, 'DODI JUNAEDI, A.Md', 0, '', 'OPS'),
(11, 'ANGGA OFFI KHOFFIDIN', 0, '', 'PENJAGA');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `idKelas` int(11) NOT NULL,
  `kodeKelas` varchar(10) NOT NULL,
  `kelas` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`idKelas`, `kodeKelas`, `kelas`) VALUES
(1, 'A01A', 'Kelas 1'),
(2, 'A02A', 'Kelas 2'),
(3, 'A03A', 'Kelas 3'),
(4, 'A04A', 'Kelas 4'),
(5, 'A05A', 'Kelas 5'),
(6, 'A06A', 'Kelas 6');

-- --------------------------------------------------------

--
-- Table structure for table `mapel`
--

CREATE TABLE `mapel` (
  `kode_mapel` varchar(5) NOT NULL,
  `mapel` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mapel`
--

INSERT INTO `mapel` (`kode_mapel`, `mapel`) VALUES
('A01', 'Bahasa Indonesia'),
('A02', 'Bahasa Inggris');

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE `nilai` (
  `idNilai` int(11) NOT NULL,
  `namaSiswa` varchar(50) NOT NULL,
  `kelasSiswa` varchar(10) NOT NULL,
  `mapel` varchar(20) NOT NULL,
  `nisn` varchar(20) NOT NULL,
  `semester` varchar(20) NOT NULL,
  `tugas` float NOT NULL,
  `uas` float NOT NULL,
  `uts` float NOT NULL,
  `rata_rata` int(11) NOT NULL,
  `predikat` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nilai`
--

INSERT INTO `nilai` (`idNilai`, `namaSiswa`, `kelasSiswa`, `mapel`, `nisn`, `semester`, `tugas`, `uas`, `uts`, `rata_rata`, `predikat`) VALUES
(1, 'Ana', 'Kelas 5', 'Bahasa Inggris', '14235', 'Ganjil', 99, 0, 100, 0, ''),
(2, 'Ani', 'Kelas 4', 'Bahasa Indonesia', '553', '', 0, 0, 0, 0, ''),
(3, 'wisnu', 'Kelas 6', '-', '77', '-', 0, 0, 0, 0, ''),
(4, 'Ana', '', 'Bahasa Inggris', '14235', 'Genap', 88, 66, 88, 0, ''),
(5, 'Ana', '', '', '14235', 'Genap', 66, 66, 66, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `idSiswa` int(12) NOT NULL,
  `namaSiswa` varchar(50) NOT NULL,
  `jkSiswa` enum('L','P') NOT NULL,
  `tgLahir` date NOT NULL,
  `kelasSiswa` varchar(11) NOT NULL,
  `namaIbu` varchar(30) NOT NULL,
  `nikSiswa` varchar(50) NOT NULL,
  `nisn` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`idSiswa`, `namaSiswa`, `jkSiswa`, `tgLahir`, `kelasSiswa`, `namaIbu`, `nikSiswa`, `nisn`) VALUES
(201, 'Ani', 'P', '2023-10-09', 'Kelas 4', 'wasmi', '555', '553'),
(202, 'Ana', 'L', '2002-11-08', 'Kelas 5', 'darsem', '2342', '14235'),
(203, 'wisnu', 'L', '2287-04-22', 'Kelas 6', 'iem', '77', '77');

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `namaSiswa` varchar(50) NOT NULL,
  `nisn` int(11) NOT NULL,
  `mapel` varchar(20) NOT NULL,
  `tugas` int(11) NOT NULL,
  `uas` int(11) NOT NULL,
  `uts` int(11) NOT NULL,
  `semester` varchar(20) NOT NULL,
  `tahun_ajaran` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pass` varchar(20) NOT NULL,
  `sebagai` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama_user`, `email`, `pass`, `sebagai`) VALUES
(1, 'denny', 'ya@gmail.com', '123', 'Admin'),
(2, 'firman', 'admin@gmail.com', '123', 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`idKelas`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`idNilai`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`idSiswa`),
  ADD UNIQUE KEY `nisn` (`nisn`),
  ADD UNIQUE KEY `nik` (`nikSiswa`),
  ADD UNIQUE KEY `nikSiswa` (`nikSiswa`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `idKelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `nilai`
--
ALTER TABLE `nilai`
  MODIFY `idNilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `idSiswa` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=204;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
