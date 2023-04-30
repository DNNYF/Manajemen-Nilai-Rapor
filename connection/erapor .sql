-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 30, 2023 at 07:01 PM
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
(5, 'A05A', 'Kelas 5');

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE `nilai` (
  `idNilai` int(11) NOT NULL,
  `idSiswa` int(11) DEFAULT NULL,
  `namaSiswa` varchar(50) DEFAULT NULL,
  `nisn` varchar(20) DEFAULT NULL,
  `tugas` int(11) DEFAULT NULL,
  `uts` int(11) DEFAULT NULL,
  `uas` int(11) DEFAULT NULL,
  `sum` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `idSiswa` int(12) NOT NULL,
  `namaSiswa` varchar(50) NOT NULL,
  `jkSiswa` varchar(10) NOT NULL,
  `tgLahir` date NOT NULL,
  `kelasSiswa` varchar(11) NOT NULL,
  `namaIbu` varchar(30) NOT NULL,
  `nikSiswa` varchar(50) NOT NULL,
  `nisn` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  ADD PRIMARY KEY (`idNilai`),
  ADD KEY `fk_siswa_idSiswa` (`idSiswa`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`idSiswa`),
  ADD UNIQUE KEY `nisn` (`nisn`),
  ADD UNIQUE KEY `nik` (`nikSiswa`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `idKelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `nilai`
--
ALTER TABLE `nilai`
  MODIFY `idNilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `idSiswa` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `nilai`
--
ALTER TABLE `nilai`
  ADD CONSTRAINT `fk_siswa` FOREIGN KEY (`idSiswa`) REFERENCES `siswa` (`idSiswa`),
  ADD CONSTRAINT `fk_siswa_idSiswa` FOREIGN KEY (`idSiswa`) REFERENCES `siswa` (`idSiswa`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
