-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 18, 2021 at 06:49 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `guru`
--

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `id` int(11) PRIMARY KEY,
  `nama` varchar(50) NOT NULL,
  `nip` int(30) NOT NULL,
  `kelas` varchar(10) NOT NULL,
  `keterangan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`id`, `nama`, `nip`, `kelas`, `keterangan`) VALUES
(1, 'SITI SUKARTINI, S.Pd', '19640522 198305 2 002', 'I', ''),
(2, 'KURINIH, S.Pd.SD', '19660427 198610 2 002', 'II', ''),
(3, 'SUNARTO, S.Pd', '19710620 200801 1 006', 'VI', ''),
(4, 'ERYANI, S.Pd.I', '', 'I-VI', ''),
(5, 'SUGIARTO, S.Pd', '', 'I-VI', ''),
(6, 'DEDE KUNAENIH, S.Pd', '', 'IV A', ''),
(7, 'WARSIDI, S.Pd', '', 'V', ''),
(8, 'SITI HALIMAH, S.Pd.SD', '', 'IV B', ''),
(9, 'SIRATNA NINGSIH, A.Ma.Pust', '', 'V', ''),
(10, 'DODI JUNAEDI, A.Md', '', '', 'OPS'),
(11, 'ANGGA OFFI KHOFFIDIN', '', '', 'PENJAGA');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD UNIQUE KEY `nip` (`nip`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `guru`
--
ALTER TABLE `guru`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;