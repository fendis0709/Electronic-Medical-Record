-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versi server:                 10.1.13-MariaDB - mariadb.org binary distribution
-- OS Server:                    Win32
-- HeidiSQL Versi:               9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table indonusa_emr_rev.checkup
CREATE TABLE IF NOT EXISTS `checkup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `doctor_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `result` text,
  `date` date DEFAULT NULL,
  `symtomp` text,
  `note` text,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_doctor` (`doctor_id`),
  KEY `id_patient` (`patient_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1 COMMENT='Menampung data pemeriksaan pasien pada dokter';

-- Dumping data for table indonusa_emr_rev.checkup: ~5 rows (approximately)
/*!40000 ALTER TABLE `checkup` DISABLE KEYS */;
INSERT INTO `checkup` (`id`, `doctor_id`, `patient_id`, `result`, `date`, `symtomp`, `note`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, 'Unknown', '2016-12-20', 'Tidak tahu', 'Non', '2016-12-22 11:37:38', '2016-12-23 18:24:14'),
	(2, 1, 1, 'Unknown', '2016-12-21', 'Tidak tahu', 'Non', '2016-12-22 11:41:06', '2016-12-23 18:24:14'),
	(4, 1, 1, 'Unknown', '2016-12-30', 'Tidak tahu', 'Non', '2016-12-22 18:11:02', '2016-12-23 18:24:14'),
	(5, 1, 1, 'Hasil', '2016-12-23', 'Gejala', 'Catatan', '2016-12-23 08:25:46', '2016-12-23 20:13:47'),
	(6, 1, 1, 'Pasien memiliki riwayat penyakit epilepsi', '2016-12-24', 'Demam tinggi, Kejang kejang', 'Jangan sering jalan - jalan.', '2016-12-24 12:03:42', '2016-12-24 12:12:45'),
	(7, 1, 11, 'Malaria', '2016-12-25', 'Kejang, Demam, Berkeringat, Susah BAB', 'Sering - sering makan buah, terutama buah jambu biji', '2016-12-25 21:20:46', '2016-12-25 22:19:17');
/*!40000 ALTER TABLE `checkup` ENABLE KEYS */;


-- Dumping structure for table indonusa_emr_rev.doctor
CREATE TABLE IF NOT EXISTS `doctor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(50) DEFAULT NULL,
  `gender` char(1) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `specialization` varchar(50) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `address` text,
  `telephone` varchar(15) DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `photo` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_account` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COMMENT='Menampung data dokter';

-- Dumping data for table indonusa_emr_rev.doctor: ~2 rows (approximately)
/*!40000 ALTER TABLE `doctor` DISABLE KEYS */;
INSERT INTO `doctor` (`id`, `user_id`, `name`, `gender`, `birth_date`, `specialization`, `city`, `address`, `telephone`, `mobile`, `photo`, `created_at`, `updated_at`) VALUES
	(1, 2, 'Dokter Kece', 'L', '1994-12-23', 'Spesialis Anak dan Kandungan', 'Surabaya', 'Jln. Kedurus No 4B', '012123233', '08570897837483', '/storage/assets/userfile/doctor/182d58975c263419568317b306312d99.jpeg', '2016-12-20 15:00:53', '2016-12-23 10:21:39'),
	(2, 53, 'Dokter Kedua', 'P', '1989-02-21', 'Spesialis Kandungan', 'Surabaya', 'Jl. Nginden No. 12 Sukolilo', '02133113', '085707824789', '/storage/assets/userfile/doctor/80aa63583938e848f40046e44277845e.jpeg', '2016-12-22 14:19:04', '2016-12-22 14:19:04'),
	(3, 58, 'Dokter Tambahan', 'L', '1994-12-23', 'Spesialis Gigi', 'Surabaya', 'Jl. Sekar Melati No. 15', '012123233', '08570897837483', '/storage/assets/userfile/doctor/38a0151f485b232e046ac1391c2e72a7.jpeg', '2016-12-25 21:28:19', '2016-12-25 21:32:41');
/*!40000 ALTER TABLE `doctor` ENABLE KEYS */;


-- Dumping structure for table indonusa_emr_rev.lab
CREATE TABLE IF NOT EXISTS `lab` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `telephone` varchar(15) DEFAULT NULL,
  `city` varchar(50) DEFAULT 'Surabaya',
  `address` text,
  `photo` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_account` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COMMENT='Menampung data laboratorium';

-- Dumping data for table indonusa_emr_rev.lab: ~1 rows (approximately)
/*!40000 ALTER TABLE `lab` DISABLE KEYS */;
INSERT INTO `lab` (`id`, `user_id`, `name`, `mobile`, `telephone`, `city`, `address`, `photo`, `created_at`, `updated_at`) VALUES
	(1, 4, 'Lab Kece Abis', '9834984', '2732837', 'Surabaya', 'Jln. Kedurus No 4D', '/storage/assets/userfile/lab/d434febbe8123bcebbde624b9bca7221.jpeg', '2016-12-20 17:39:48', '2016-12-26 00:13:55'),
	(3, 54, 'Lab Keduax', '085707824789', '0313376741', 'Surabaya', 'Jl. Menur No. 12, Sukolilo', '/storage/assets/userfile/lab/202508feb21309f8342a13c1ba6fe4af.jpeg', '2016-12-22 14:20:39', '2016-12-22 15:57:21'),
	(4, 57, 'Lab Ketiga', '232739', '72382738', 'Sidoarjo', 'djhfjksdhf', '/storage/assets/userfile/lab/07cdf083ae66646b8f713bfa71d6d550.jpeg', '2016-12-24 16:19:29', '2016-12-24 16:19:29');
/*!40000 ALTER TABLE `lab` ENABLE KEYS */;


-- Dumping structure for table indonusa_emr_rev.lab_checkup
CREATE TABLE IF NOT EXISTS `lab_checkup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `checkup_id` int(11) NOT NULL,
  `lab_id` int(11) DEFAULT NULL,
  `patient_id` int(11) NOT NULL,
  `result` text,
  `date` date DEFAULT NULL,
  `notes` text,
  `photo` text,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `checkup_id` (`checkup_id`),
  KEY `patient_id` (`patient_id`),
  KEY `lab_id` (`lab_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COMMENT='Menampung data hasil pemeriksaan laboratorium';

-- Dumping data for table indonusa_emr_rev.lab_checkup: ~6 rows (approximately)
/*!40000 ALTER TABLE `lab_checkup` DISABLE KEYS */;
INSERT INTO `lab_checkup` (`id`, `checkup_id`, `lab_id`, `patient_id`, `result`, `date`, `notes`, `photo`, `created_at`, `updated_at`) VALUES
	(1, 2, 1, 1, 'Hasil pemeriksaan Lab', '2016-12-22', 'Catatan untuk pasien dari lab', NULL, '2016-12-22 11:38:54', '2016-12-22 11:38:55'),
	(2, 0, 1, 1, 'Hasil pemeriksaan lab', '2016-12-22', 'Catatan untuk pasien dari lab', NULL, '2016-12-22 11:45:09', '2016-12-22 11:45:10'),
	(3, 0, 1, 1, NULL, '2016-12-30', NULL, NULL, '2016-12-22 18:17:25', '2016-12-22 18:17:25'),
	(4, 0, 1, 1, NULL, '2016-12-25', NULL, NULL, '2016-12-22 19:36:00', '2016-12-22 19:36:00'),
	(5, 5, 1, 1, NULL, '2016-12-27', NULL, NULL, '2016-12-23 20:20:50', '2016-12-23 20:20:50'),
	(6, 0, 1, 1, NULL, '2016-12-23', NULL, NULL, '2016-12-23 21:00:35', '2016-12-23 21:00:35');
/*!40000 ALTER TABLE `lab_checkup` ENABLE KEYS */;


-- Dumping structure for table indonusa_emr_rev.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table indonusa_emr_rev.migrations: ~2 rows (approximately)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;


-- Dumping structure for table indonusa_emr_rev.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table indonusa_emr_rev.password_resets: ~0 rows (approximately)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;


-- Dumping structure for table indonusa_emr_rev.patient
CREATE TABLE IF NOT EXISTS `patient` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `nik` varchar(50) NOT NULL DEFAULT '0',
  `name` varchar(50) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `address` text,
  `mobile` varchar(15) NOT NULL DEFAULT '0',
  `telephone` varchar(15) DEFAULT NULL,
  `gender` char(1) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `notes` text,
  `photo` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`user_id`),
  UNIQUE KEY `nik` (`nik`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1 COMMENT='Menampung data pasien';

-- Dumping data for table indonusa_emr_rev.patient: ~2 rows (approximately)
/*!40000 ALTER TABLE `patient` DISABLE KEYS */;
INSERT INTO `patient` (`id`, `user_id`, `nik`, `name`, `city`, `address`, `mobile`, `telephone`, `gender`, `birth_date`, `notes`, `photo`, `created_at`, `updated_at`) VALUES
	(1, 5, '123456789', 'Pasien Kece Banget Bro', 'Surabaya', 'Jln. Kedurus No 4E', '08570897837483', '0121232333', 'L', '1994-12-23', NULL, 'storage/assets/userfile/e1656e66b8174b4dc005937135ccefed.png', '2016-12-19 14:01:36', '2016-12-22 19:15:28'),
	(11, 55, '123121212', 'Pasien Kedua', 'Sidoarjo', 'Jl. Semolowaru No. 12', '08570897837483', '012123233', 'P', '1989-10-25', NULL, '/storage/assets/userfile/patient/9af8f17cf866fea7d13a2c7764597f09.jpeg', '2016-12-22 14:28:49', '2016-12-22 14:28:49'),
	(12, 61, '123444555', 'Pasien Tambahan', 'Surabaya', 'Abjasfbsdhbfskdjcbsdkjbf', '08570897837483', '012123233', 'L', '1994-12-23', NULL, '/storage/assets/userfile/patient/adebd5abadbeb3cc105a10d5f74a4108.jpeg', '2016-12-25 21:42:02', '2016-12-25 21:42:02');
/*!40000 ALTER TABLE `patient` ENABLE KEYS */;


-- Dumping structure for table indonusa_emr_rev.pharmacy
CREATE TABLE IF NOT EXISTS `pharmacy` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `telephone` varchar(15) DEFAULT NULL,
  `city` varchar(50) DEFAULT 'Surabaya',
  `address` text,
  `photo` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_account` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Menampung data farmasi';

-- Dumping data for table indonusa_emr_rev.pharmacy: ~0 rows (approximately)
/*!40000 ALTER TABLE `pharmacy` DISABLE KEYS */;
INSERT INTO `pharmacy` (`id`, `user_id`, `name`, `mobile`, `telephone`, `city`, `address`, `photo`, `created_at`, `updated_at`) VALUES
	(1, 3, 'Farmasi Kece', NULL, NULL, 'Surabaya', 'Jln. Kedurus No 4C', NULL, '2016-12-22 11:27:06', '2016-12-22 11:27:08');
/*!40000 ALTER TABLE `pharmacy` ENABLE KEYS */;


-- Dumping structure for table indonusa_emr_rev.prescription
CREATE TABLE IF NOT EXISTS `prescription` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `checkup_id` int(11) DEFAULT NULL,
  `doctor_id` int(11) DEFAULT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `note` text,
  `amount` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_doctor` (`doctor_id`),
  KEY `id_patient` (`patient_id`),
  KEY `id_checkup_doctor` (`checkup_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 COMMENT='Menampung data resep obat untuk pasien secara garis besar\r\n';

-- Dumping data for table indonusa_emr_rev.prescription: ~4 rows (approximately)
/*!40000 ALTER TABLE `prescription` DISABLE KEYS */;
INSERT INTO `prescription` (`id`, `checkup_id`, `doctor_id`, `patient_id`, `date`, `note`, `amount`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, 1, '2016-12-24', NULL, NULL, '2016-12-22 11:39:50', '2016-12-22 11:39:51'),
	(2, 6, NULL, 11, '2016-12-25', 'Ojo keluyuran ae', 120000, '2016-12-24 11:58:30', '2016-12-24 11:58:30'),
	(3, NULL, NULL, 11, '2016-12-25', 'Dihabiskan', 50000, '2016-12-25 14:12:53', '2016-12-25 14:12:54'),
	(4, NULL, NULL, 1, '2016-12-25', NULL, NULL, '2016-12-25 21:56:30', '2016-12-25 21:56:30'),
	(5, 7, 1, 11, '2016-12-25', NULL, NULL, '2016-12-25 22:19:17', '2016-12-25 22:19:17');
/*!40000 ALTER TABLE `prescription` ENABLE KEYS */;


-- Dumping structure for table indonusa_emr_rev.prescription_detail
CREATE TABLE IF NOT EXISTS `prescription_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prescription_id` int(11) NOT NULL,
  `medicine` varchar(50) DEFAULT NULL,
  `dosage` varchar(50) DEFAULT NULL,
  `rule_of_use` text,
  `is_verified` char(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_prescription` (`prescription_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1 COMMENT='Menampung data detail resep obat';

-- Dumping data for table indonusa_emr_rev.prescription_detail: ~8 rows (approximately)
/*!40000 ALTER TABLE `prescription_detail` DISABLE KEYS */;
INSERT INTO `prescription_detail` (`id`, `prescription_id`, `medicine`, `dosage`, `rule_of_use`, `is_verified`, `created_at`, `updated_at`) VALUES
	(1, 1, 'Paracetamol 500mg', '3 kali sehari', 'Diminum sesudah makan', '0', '2016-12-24 13:27:51', '2016-12-24 13:27:51'),
	(2, 1, 'Amoxycilin 500mg', '2 kali sehari', 'Diminum sesudah makan', '0', '2016-12-24 13:27:51', '2016-12-24 13:27:51'),
	(3, 2, 'Joko', '2 x 1', 'Sekarepmu', '1', '2016-12-24 14:27:14', '2016-12-24 14:47:35'),
	(5, 2, 'Om telolet om', '3 x 1', 'Teriak di pinggir jalan', '1', '2016-12-24 14:29:24', '2016-12-24 14:47:35'),
	(8, 3, 'Paramex', '3 x 1', 'Sekarepmu', '1', '2016-12-25 15:09:08', '2016-12-25 15:09:14'),
	(9, 5, 'Amfetamin 500mg', '3 x 1', 'Diminum sesudah makan', '1', '2016-12-25 22:19:49', '2016-12-25 22:21:09'),
	(10, 5, 'Amoxicilin 500mg', '2 x 1', 'Sekarepmu', '1', '2016-12-25 22:20:36', '2016-12-25 22:21:09');
/*!40000 ALTER TABLE `prescription_detail` ENABLE KEYS */;


-- Dumping structure for table indonusa_emr_rev.test
CREATE TABLE IF NOT EXISTS `test` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `number` varchar(50) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `datetime` datetime DEFAULT NULL,
  `text` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Hanya untuk coba coba';

-- Dumping data for table indonusa_emr_rev.test: ~0 rows (approximately)
/*!40000 ALTER TABLE `test` DISABLE KEYS */;
/*!40000 ALTER TABLE `test` ENABLE KEYS */;


-- Dumping structure for table indonusa_emr_rev.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `password` text,
  `name` varchar(50) DEFAULT NULL,
  `city` varchar(50) DEFAULT 'Surabaya',
  `address` text,
  `mobile` varchar(15) DEFAULT NULL,
  `telephone` varchar(15) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL COMMENT 'Admin || Lab || Farmasi || Pasien',
  `remember_token` varchar(100) DEFAULT NULL,
  `is_verified` tinyint(4) NOT NULL DEFAULT '0',
  `is_enabled` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=latin1 COMMENT='Menampung data akun pengguna aplikasi (Admin, Dokter, Lab, Farmasi, Pasien)';

-- Dumping data for table indonusa_emr_rev.users: ~13 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `email`, `password`, `name`, `city`, `address`, `mobile`, `telephone`, `status`, `remember_token`, `is_verified`, `is_enabled`, `created_at`, `updated_at`) VALUES
	(1, 'admin@emr.com', '$2y$10$ljfZLPHFwMSpUrBFMQwEvuM.78vuYma7w9DBDCxxy0.z0c57RwEKO', 'Admin Master Gaul', 'Sidoarjo', 'Jln. Kedurus No 4A', '085707824788', '0212121212', 'Admin', 'IxiQF9rV5oRDbmjDrCUMLJoTdxD1e2DrVOLtRN1S0GASTaTy3EpHxF8gRaLO', 1, 1, '2016-12-17 16:37:49', '2016-12-25 22:06:00'),
	(2, 'dokter@emr.com', '$2y$10$ICnc/5XotrSovcT3jCYqWOLZdaLc2ger26d8bfr.dSrsyPawlQC4u', 'Dokter Kece', 'Surabaya', 'Jln. Kedurus No 4B', '08570897837483', '012123233', 'Doctor', 'pU5FUexdTlUXL0pWuiXxJ1TJcAtk5yoi7Z13XBnkgKcMOFZUHMmzvcVLf8JQ', 1, 1, '2016-12-17 16:46:47', '2016-12-25 23:26:49'),
	(3, 'farmasi@emr.com', '$2y$10$Ick56wjDt7d2mQd/G/FkaelpMbd5EXYa1pKz13.hgTVNtrErmbvuW', 'Farmasi Kece Abis', 'Surabaya', 'Jln. Kedurus No 4C', '08570897837483', '012123233', 'Pharmacy', 'aY3xRp0c5ZzxGTfQTpdnGAlBcfags797tSIZHXrpj4yn7TdGMfVyAYPNvAmh', 1, 1, '2016-12-17 16:47:42', '2016-12-26 00:14:51'),
	(4, 'lab@emr.com', '$2y$10$hNyRi17F0ah1zMYLyLi0euyJAhKiC4FHxLI.3XuUq6tyoq4EwrRp6', 'Lab Kece Abis', 'Surabaya', 'Jln. Kedurus No 4D', '9834984', '2732837', 'Lab', 'B27ioVOyiA7Nczx3HePtxacWy1IQKJCFuFZXc3GjKDJy6q3DvFfKCrpEi3bn', 1, 1, '2016-12-19 13:40:00', '2016-12-26 00:14:34'),
	(5, 'pasien@emr.com', '$2y$10$hJkMNmE6VAYably/W1y.ceaF6AjdUhIed4Vciwr6iYej7gZGpTEpu', 'Pasien Kece', 'Surabaya', 'Jln. Kedurus No 4E', '08570897837483', '012123233', 'Patient', 'sSpKnWDpCGaWuEaZ1WZ9Sd7ROor7F4XbZP0tEIhl8Axqnvc8CIl3FpVAeN70', 1, 1, '2016-12-19 13:41:20', '2016-12-26 12:33:19'),
	(53, 'dokter_2@emr.com', NULL, 'Dokter Kedua', 'Surabaya', 'Jl. Nginden No. 12 Sukolilo', '085707824789', '02133113', 'Doctor', 'abba17934bdd5d6c642d2e44ff790b14', 0, 1, '2016-12-22 14:18:59', '2016-12-22 14:18:59'),
	(54, 'lab_2@emr.com', NULL, 'Lab Kedua', 'Surabaya', 'Jl. Menur No. 12, Sukolilo', '085707824789', '0313376741', 'Lab', '7933f28cf2baea9bf31a76907cb81e32', 0, 1, '2016-12-22 14:20:39', '2016-12-22 14:20:39'),
	(55, 'pasien_2@emr.com', NULL, 'Pasien Kedua', 'Sidoarjo', 'Jl. Semolowaru No. 12', '08570897837483', '012123233', 'Patient', '79b72d64e3e7cf225065b53f82a4ee1e', 0, 1, '2016-12-22 14:28:49', '2016-12-22 14:28:49'),
	(56, 'farm_2@emr.com', NULL, 'Farmasi Kedua', 'Sidoarjo', 'Jl. Krian ', '08233849384', '031433498', 'Pharmacy', NULL, 0, 1, '2016-12-22 17:03:35', '2016-12-25 21:35:41'),
	(57, 'lab-3@emr.com', NULL, 'Lab Ketiga', 'Sidoarjo', 'djhfjksdhf', '232739', '72382738', 'Lab', '7513979dd8e457729236d7d99c7aa825', 0, 1, '2016-12-24 16:19:28', '2016-12-24 16:19:28'),
	(58, 'dokter_dua@email.com', '$2y$10$N8DlFHplEzfm/EHhFcwDIOwUFX.jL/00cB9z17Dv99XDtRfEPiH4y', 'Dokter  Tambahan', 'Surabaya', 'Jl. Sekar Melati No. 15', '08570897837483', '012123233', 'Doctor', '17368a24ba43eb08cbc648921b71e4f2', 0, 1, '2016-12-25 21:28:18', '2016-12-25 21:28:18'),
	(59, 'farmasi_2@emr.com', '$2y$10$m1IY88i9Y13tsT3ItcZ.NeYzWJwGBx1IHj7rXq8dRCYE9UAc3u8IW', 'Farmasi Tambahan', 'Surabaya', 'Jl. Ahmad Yani No. 90', '08570889778', '031322412', 'Pharmacy', NULL, 0, 0, '2016-12-25 21:34:30', '2016-12-25 21:34:30'),
	(61, 'pasien_2_2@emr.com', '$2y$10$qpZrz1tj17yGvnX6IKKno.I78RTmUcJ/WX3ZKAQrwN2paP2CyJzFW', 'Pasien Tambahan', 'Surabaya', 'Abjasfbsdhbfskdjcbsdkjbf', '08570897837483', '012123233', 'Patient', 'dab7e58e90a956036ad9b7696c1807d6', 0, 0, '2016-12-25 21:42:02', '2016-12-25 21:42:02');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;


-- Dumping structure for table indonusa_emr_rev.users_2
CREATE TABLE IF NOT EXISTS `users_2` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table indonusa_emr_rev.users_2: ~0 rows (approximately)
/*!40000 ALTER TABLE `users_2` DISABLE KEYS */;
/*!40000 ALTER TABLE `users_2` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
