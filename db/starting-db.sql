-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               5.7.24 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table kedaiku.auth_logins
CREATE TABLE IF NOT EXISTS `auth_logins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(50) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  `successfull` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table kedaiku.auth_logins: 12 rows
/*!40000 ALTER TABLE `auth_logins` DISABLE KEYS */;
INSERT INTO `auth_logins` (`id`, `user_id`, `firstname`, `lastname`, `role`, `ip_address`, `date`, `successfull`) VALUES
	(1, 1, 'Cikgu', 'Iszuddin', '1', '127.0.0.1', '2021-03-27 03:33:13', 0),
	(2, 1, 'Cikgu', 'Iszuddin', '1', '127.0.0.1', '2021-03-27 03:33:21', 1),
	(3, 1, 'Cikgu', 'Iszuddin', '1', '127.0.0.1', '2021-03-27 03:34:43', 1),
	(4, 1, 'Cikgu', 'Iszuddin', '1', '127.0.0.1', '2021-03-27 03:38:28', 1),
	(5, 1, 'Cikgu', 'Iszuddin', '1', '127.0.0.1', '2021-03-28 19:16:52', 0),
	(6, 1, 'Cikgu', 'Iszuddin', '1', '127.0.0.1', '2021-03-28 19:19:45', 1),
	(7, 1, 'Cikgu', 'Iszuddin', '1', '127.0.0.1', '2021-03-28 19:22:12', 1),
	(8, 1, 'Cikgu', 'Iszuddin', '1', '127.0.0.1', '2021-03-28 19:22:22', 0),
	(9, 1, 'Cikgu', 'Iszuddin', '1', '127.0.0.1', '2021-03-28 20:01:34', 0),
	(10, 1, 'Cikgu', 'Iszuddin', '1', '127.0.0.1', '2021-03-28 20:01:39', 0),
	(11, 1, 'Cikgu', 'Iszuddin', '1', '127.0.0.1', '2021-03-28 20:01:45', 0),
	(12, 1, 'Cikgu', 'Iszuddin', '1', '127.0.0.1', '2021-03-28 20:01:54', 1);
/*!40000 ALTER TABLE `auth_logins` ENABLE KEYS */;

-- Dumping structure for table kedaiku.auth_tokens
CREATE TABLE IF NOT EXISTS `auth_tokens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `selector` varchar(255) NOT NULL,
  `hashedvalidator` varchar(255) NOT NULL,
  `expires` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- Dumping data for table kedaiku.auth_tokens: 0 rows
/*!40000 ALTER TABLE `auth_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `auth_tokens` ENABLE KEYS */;

-- Dumping structure for table kedaiku.gambar
CREATE TABLE IF NOT EXISTS `gambar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) DEFAULT NULL,
  `nama_fail` varchar(100) DEFAULT NULL,
  `keterangan` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table kedaiku.gambar: ~15 rows (approximately)
/*!40000 ALTER TABLE `gambar` DISABLE KEYS */;
INSERT INTO `gambar` (`id`, `nama`, `nama_fail`, `keterangan`) VALUES
	(1, 'Rembau', 'rembau.jpg', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Natus, saepe nisi hic modi nulla fugit impedit ut unde debitis atque labore culpa neque vel fuga voluptates suscipit ullam, incidunt non?'),
	(2, 'Gemas', 'gemas.jpg', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Natus, saepe nisi hic modi nulla fugit impedit ut unde debitis atque labore culpa neque vel fuga voluptates suscipit ullam, incidunt non?'),
	(3, 'Seremban', 'seremban.jpg', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Natus, saepe nisi hic modi nulla fugit impedit ut unde debitis atque labore culpa neque vel fuga voluptates suscipit ullam, incidunt non?'),
	(4, 'Juaseh', 'juaseh.jpg', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Natus, saepe nisi hic modi nulla fugit impedit ut unde debitis atque labore culpa neque vel fuga voluptates suscipit ullam, incidunt non?'),
	(5, 'Kuala Pilah', 'kuala-pilah.jpg', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Natus, saepe nisi hic modi nulla fugit impedit ut unde debitis atque labore culpa neque vel fuga voluptates suscipit ullam, incidunt non?'),
	(6, 'Port Dickson', 'port-dickson.jpg', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Natus, saepe nisi hic modi nulla fugit impedit ut unde debitis atque labore culpa neque vel fuga voluptates suscipit ullam, incidunt non?'),
	(7, 'Jelebu', '1616829554_84c88bfaa265f9639d35.jpg', 'Tempat di Negeri Sembilan'),
	(8, 'Jempol', '1616821353_fef383473c97552448bb.jpg', 'Daerah dalam Negeri Sembilan'),
	(9, 'Ayer Keroh', '1616821461_b38f521a174c60f91cb6.jpg', 'Ini di Melaka'),
	(10, 'Alor Gajah', '1616830949_07455e7d40843c796d23.jpg', 'Dekat dengan Naning ... tapi Naning ni Melaka atau Negeri Sembilan?'),
	(11, 'Alor Gajah', '1616830990_a7384be88b1e4292d59b.jpg', 'Dekat dengan Naning ... tapi Naning ni Melaka atau Negeri Sembilan?'),
	(12, 'Alor Gajah', '1616831131_15c292379a4ae66ab11a.jpg', 'Dekat dengan Naning ... tapi Naning ni Melaka atau Negeri Sembilan?'),
	(14, 'Tampin', '1616831177_7bc70e1b6f18079c39c2.jpg', 'Dalam Negeri Sembilan'),
	(15, 'Bahau', '1616831212_aa03b6c98d64708130d9.jpg', 'Mana lagi daerah belum add');
/*!40000 ALTER TABLE `gambar` ENABLE KEYS */;

-- Dumping structure for table kedaiku.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `reset_token` varchar(250) NOT NULL,
  `reset_expire` datetime DEFAULT NULL,
  `activated` tinyint(1) NOT NULL,
  `activate_token` varchar(250) DEFAULT NULL,
  `activate_expire` varchar(250) DEFAULT NULL,
  `role` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table kedaiku.users: 1 rows
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `password`, `reset_token`, `reset_expire`, `activated`, `activate_token`, `activate_expire`, `role`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Cikgu', 'Iszuddin', 'kp@websegera.my', '$argon2id$v=19$m=1024,t=2,p=2$U0lhV25wNXJsdXVhYU5Pdg$GO60XLxW0TdWBoXsUOdfW4MhuuyBd6/MM1FAyZSI10g', '', NULL, 1, NULL, NULL, 1, '2021-03-27 01:25:17', '2021-03-27 01:25:17', NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Dumping structure for table kedaiku.user_roles
CREATE TABLE IF NOT EXISTS `user_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- Dumping data for table kedaiku.user_roles: 0 rows
/*!40000 ALTER TABLE `user_roles` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_roles` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
