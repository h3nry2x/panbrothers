-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.6-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for db_panbrothers
CREATE DATABASE IF NOT EXISTS `db_panbrothers` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `db_panbrothers`;

-- Dumping structure for table db_panbrothers.penduduk
CREATE TABLE IF NOT EXISTS `penduduk` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nik` varchar(16) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `alamat` text NOT NULL,
  `tanggalinput` datetime NOT NULL,
  `userinput` varchar(11) NOT NULL,
  `tanggalupdate` datetime DEFAULT NULL,
  `userupdate` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table db_panbrothers.penduduk: ~2 rows (approximately)
/*!40000 ALTER TABLE `penduduk` DISABLE KEYS */;
INSERT INTO `penduduk` (`id`, `nik`, `nama`, `jenis_kelamin`, `alamat`, `tanggalinput`, `userinput`, `tanggalupdate`, `userupdate`) VALUES
	(2, '3309051501960001', 'Wachid Henry Nugroho', 'L', 'Jl. Kutilang RT 002/RW 005 Recosari Banaran Boyolali', '2021-02-17 01:26:48', 'Admin', '2021-02-17 11:43:40', 'Admin'),
	(4, '3309050906990001', 'Frendy Ervianto', 'L', 'Boyolali', '2021-02-17 03:59:37', 'Admin', NULL, NULL);
/*!40000 ALTER TABLE `penduduk` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
