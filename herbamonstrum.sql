-- --------------------------------------------------------
-- Host:                         localhost
-- Versione server:              8.0.29 - MySQL Community Server - GPL
-- S.O. server:                  Linux
-- HeidiSQL Versione:            12.0.0.6468
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dump della struttura del database herbamonstrum
CREATE DATABASE IF NOT EXISTS `herbamonstrum` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `herbamonstrum`;

-- Dump della struttura di vista herbamonstrum.capienzaTavolo
-- Creazione di una tabella temporanea per risolvere gli errori di dipendenza della vista
CREATE TABLE `capienzaTavolo` (
	`idTavolo` INT(10) NOT NULL,
	`tavolo` VARCHAR(100) NOT NULL COLLATE 'utf8mb4_general_ci',
	`capienza` BIGINT(19) NULL,
	`sala` INT(10) NULL
) ENGINE=MyISAM;

-- Dump della struttura di tabella herbamonstrum.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dump dei dati della tabella herbamonstrum.failed_jobs: ~0 rows (circa)

-- Dump della struttura di tabella herbamonstrum.hm_v_prenotazioni
CREATE TABLE IF NOT EXISTS `hm_v_prenotazioni` (
  `idPrenotazione` int NOT NULL,
  `nomePrenotazione` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `telefono` bigint DEFAULT NULL,
  `coperti` int DEFAULT NULL,
  `dataInserimento` date NOT NULL,
  `dataModifica` date NOT NULL,
  `attiva` bit(1) NOT NULL,
  `oraInizio` time NOT NULL,
  `oraFine` time DEFAULT NULL,
  `note` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `dataPrenotazione` date NOT NULL,
  `numeroBambini` int NOT NULL,
  `operatore` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tavoli` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dump dei dati della tabella herbamonstrum.hm_v_prenotazioni: 0 rows
/*!40000 ALTER TABLE `hm_v_prenotazioni` DISABLE KEYS */;
/*!40000 ALTER TABLE `hm_v_prenotazioni` ENABLE KEYS */;

-- Dump della struttura di tabella herbamonstrum.logs
CREATE TABLE IF NOT EXISTS `logs` (
  `idLog` int NOT NULL AUTO_INCREMENT,
  `utente` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `data` date NOT NULL,
  `azione` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `note` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`idLog`)
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dump dei dati della tabella herbamonstrum.logs: ~80 rows (circa)
INSERT INTO `logs` (`idLog`, `utente`, `data`, `azione`, `note`) VALUES
	(1, 'admin', '2021-11-04', 'Creata prenotazione [id: 24]', NULL),
	(2, 'admin', '2021-11-04', 'UPDATE', 'Aggiornata prenotazione [id: 23]'),
	(3, 'admin', '2021-11-04', 'UPDATE', 'Aggiornata prenotazione [id: 23]'),
	(4, 'admin', '2021-11-04', 'UPDATE', 'Aggiornata prenotazione [id: 23]'),
	(5, 'admin', '2021-11-04', 'Eliminata', 'Eliminata prenotazione [id: 22]'),
	(6, 'admin', '2021-11-04', 'Eliminata', 'Eliminata prenotazione [id: 22]'),
	(7, 'admin', '2021-11-04', 'Eliminata', 'Eliminata prenotazione [id: 23]'),
	(8, 'admin', '2021-11-04', 'Eliminata', 'Eliminata prenotazione [id: 23]'),
	(9, 'admin', '2021-11-04', 'Eliminata', 'Eliminata prenotazione [id: 23]'),
	(10, 'admin', '2021-11-04', 'CREATE', 'Creata prenotazione [id: 25]'),
	(11, 'admin', '2021-11-04', 'UPDATE', 'Aggiornata prenotazione [id: 24]'),
	(12, 'admin', '2021-11-04', 'CREATE', 'Creata prenotazione [id: 26]'),
	(13, 'admin', '2021-11-04', 'CREATE', 'Creata prenotazione [id: 27]'),
	(14, 'admin', '2021-11-04', 'CREATE', 'Creata prenotazione [id: 28]'),
	(15, 'admin', '2021-11-04', 'Eliminata', 'Eliminata prenotazione [id: 28]'),
	(16, 'admin', '2021-11-05', 'CREATE', 'Creata prenotazione [id: 29]'),
	(17, 'admin', '2021-11-05', 'CREATE', 'Creata prenotazione [id: 30]'),
	(18, 'admin', '2021-11-05', 'CREATE', 'Creata prenotazione [id: 31]'),
	(19, 'admin', '2021-11-05', 'UPDATE', 'Aggiornata prenotazione [id: 31]'),
	(20, 'admin', '2021-11-06', 'CREATE', 'Creata prenotazione [id: 1]'),
	(21, 'admin', '2021-11-06', 'CREATE', 'Creata prenotazione [id: 2]'),
	(22, 'admin', '2021-11-06', 'CREATE', 'Creata prenotazione [id: 3]'),
	(23, 'admin', '2021-11-08', 'CREATE', 'Creata prenotazione [id: 4]'),
	(24, 'admin', '2021-11-08', 'CREATE', 'Creata prenotazione [id: 5]'),
	(25, 'admin', '2021-11-08', 'CREATE', 'Creata prenotazione [id: 6]'),
	(26, 'admin', '2021-11-08', 'Eliminata', 'Eliminata prenotazione [id: 2]'),
	(27, 'admin', '2021-11-08', 'UPDATE', 'Aggiornata prenotazione [id: 4]'),
	(28, 'admin', '2021-11-08', 'UPDATE', 'Aggiornata prenotazione [id: 4]'),
	(29, 'admin', '2021-11-08', 'UPDATE', 'Aggiornata prenotazione [id: 4]'),
	(30, 'admin', '2021-11-08', 'Eliminata', 'Eliminata prenotazione [id: 4]'),
	(31, 'admin', '2021-11-09', 'CREATE', 'Creata prenotazione [id: 7]'),
	(32, 'admin', '2021-11-09', 'CREATE', 'Creata prenotazione [id: 8]'),
	(33, 'admin', '2021-11-09', 'CREATE', 'Creata prenotazione [id: 9]'),
	(34, 'admin', '2021-11-10', 'CREATE', 'Creata prenotazione [id: 10]'),
	(35, 'admin', '2021-11-10', 'CREATE', 'Creata prenotazione [id: 11]'),
	(36, 'admin', '2021-11-10', 'CREATE', 'Creata prenotazione [id: 12]'),
	(37, 'admin', '2021-11-10', 'Eliminata', 'Eliminata prenotazione [id: 12]'),
	(38, 'admin', '2021-11-10', 'UPDATE', 'Aggiornata prenotazione [id: 11]'),
	(39, 'admin', '2021-11-10', 'CREATE', 'Creata prenotazione [id: 13]'),
	(40, 'admin', '2021-11-10', 'Eliminata', 'Eliminata prenotazione [id: 13]'),
	(41, 'admin', '2021-11-10', 'CREATE', 'Creata prenotazione [id: 14]'),
	(42, 'admin', '2021-11-10', 'Eliminata', 'Eliminata prenotazione [id: 14]'),
	(43, 'admin', '2021-11-10', 'CREATE', 'Creata prenotazione [id: 15]'),
	(44, 'admin', '2021-11-10', 'CREATE', 'Creata prenotazione [id: 16]'),
	(45, 'admin', '2021-11-10', 'CREATE', 'Creata prenotazione [id: 17]'),
	(46, 'admin', '2021-11-10', 'CREATE', 'Creata prenotazione [id: 18]'),
	(47, 'admin', '2021-11-10', 'Eliminata', 'Eliminata prenotazione [id: 18]'),
	(48, 'admin', '2021-11-10', 'Eliminata', 'Eliminata prenotazione [id: 17]'),
	(49, 'admin', '2021-11-10', 'CREATE', 'Creata prenotazione [id: 19]'),
	(50, 'admin', '2021-11-10', 'UPDATE', 'Aggiornata prenotazione [id: 19]'),
	(51, 'admin', '2021-11-10', 'CREATE', 'Creata prenotazione [id: 20]'),
	(52, 'admin', '2021-11-10', 'Eliminata', 'Eliminata prenotazione [id: 20]'),
	(53, 'admin', '2021-11-10', 'CREATE', 'Creata prenotazione [id: 21]'),
	(54, 'admin', '2021-11-12', 'CREATE', 'Creata prenotazione [id: 22]'),
	(55, 'admin', '2021-11-12', 'CREATE', 'Creata prenotazione [id: 23]'),
	(56, 'admin', '2021-11-12', 'CREATE', 'Creata prenotazione [id: 24]'),
	(57, 'admin', '2021-11-12', 'Eliminata', 'Eliminata prenotazione [id: 24]'),
	(58, 'admin', '2021-11-12', 'CREATE', 'Creata prenotazione [id: 25]'),
	(59, 'admin', '2021-11-12', 'UPDATE', 'Aggiornata prenotazione [id: 25]'),
	(60, 'admin', '2021-11-12', 'CREATE', 'Creata prenotazione [id: 26]'),
	(61, 'admin', '2021-11-13', 'CREATE', 'Creata prenotazione [id: 27]'),
	(62, 'admin', '2021-11-13', 'Eliminata', 'Eliminata prenotazione [id: 27]'),
	(63, 'admin', '2021-11-13', 'UPDATE', 'Aggiornata prenotazione [id: 22]'),
	(64, 'admin', '2022-03-02', 'CREATE', 'Creata prenotazione [id: 28]'),
	(65, 'admin', '2022-03-02', 'CREATE', 'Creata prenotazione [id: 29]'),
	(66, 'admin', '2022-03-02', 'Eliminata', 'Eliminata prenotazione [id: 28]'),
	(67, 'admin', '2022-03-02', 'CREATE', 'Creata prenotazione [id: 30]'),
	(68, 'admin', '2022-03-02', 'CREATE', 'Creata prenotazione [id: 31]'),
	(69, 'admin', '2022-03-02', 'Eliminata', 'Eliminata prenotazione [id: 30]'),
	(70, 'admin', '2022-03-02', 'CREATE', 'Creata prenotazione [id: 32]'),
	(71, 'admin', '2022-03-02', 'UPDATE', 'Aggiornata prenotazione [id: 32]'),
	(72, 'admin', '2022-03-02', 'CREATE', 'Creata prenotazione [id: 33]'),
	(73, 'admin', '2022-03-02', 'UPDATE', 'Aggiornata prenotazione [id: 33]'),
	(74, 'admin', '2022-03-05', 'CREATE', 'Creata prenotazione [id: 34]'),
	(75, 'admin', '2022-03-05', 'CREATE', 'Creata prenotazione [id: 35]'),
	(76, 'admin', '2022-03-05', 'Eliminata', 'Eliminata prenotazione [id: 35]'),
	(77, 'admin', '2022-03-05', 'CREATE', 'Creata prenotazione [id: 36]'),
	(78, 'admin', '2022-03-05', 'Eliminata', 'Eliminata prenotazione [id: 36]'),
	(79, 'admin', '2022-04-23', 'CREATE', 'Creata prenotazione [id: 37]'),
	(80, 'admin', '2022-04-23', 'CREATE', 'Creata prenotazione [id: 38]');

-- Dump della struttura di tabella herbamonstrum.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dump dei dati della tabella herbamonstrum.migrations: ~7 rows (circa)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(5, '2022_04_24_212521_create_oraris_table', 2),
	(6, '2022_04_25_113915_create_tavolos_table', 3),
	(7, '2022_04_25_114935_create_prenotaziones_table', 4);

-- Dump della struttura di tabella herbamonstrum.orari
CREATE TABLE IF NOT EXISTS `orari` (
  `idOrario` int NOT NULL AUTO_INCREMENT,
  `orario` time NOT NULL,
  `idSala` int NOT NULL,
  PRIMARY KEY (`idOrario`)
) ENGINE=InnoDB AUTO_INCREMENT=97 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dump dei dati della tabella herbamonstrum.orari: ~68 rows (circa)
INSERT INTO `orari` (`idOrario`, `orario`, `idSala`) VALUES
	(1, '18:30:00', 1),
	(2, '18:45:00', 1),
	(3, '19:00:00', 1),
	(4, '19:15:00', 1),
	(5, '19:30:00', 1),
	(6, '19:45:00', 1),
	(7, '20:00:00', 1),
	(8, '20:15:00', 1),
	(9, '20:30:00', 1),
	(10, '20:45:00', 1),
	(11, '21:00:00', 1),
	(12, '21:15:00', 1),
	(13, '21:30:00', 1),
	(14, '21:45:00', 1),
	(15, '22:00:00', 1),
	(16, '22:15:00', 1),
	(17, '22:30:00', 1),
	(18, '18:30:00', 2),
	(19, '18:45:00', 2),
	(20, '19:00:00', 2),
	(21, '19:15:00', 2),
	(22, '19:30:00', 2),
	(23, '19:45:00', 2),
	(24, '20:00:00', 2),
	(25, '20:15:00', 2),
	(26, '20:30:00', 2),
	(27, '20:45:00', 2),
	(28, '21:00:00', 2),
	(29, '21:15:00', 2),
	(30, '21:30:00', 2),
	(31, '21:45:00', 2),
	(32, '22:00:00', 2),
	(33, '22:15:00', 2),
	(34, '22:30:00', 2),
	(49, '18:30:00', 3),
	(50, '18:45:00', 3),
	(51, '19:00:00', 3),
	(52, '19:15:00', 3),
	(53, '19:30:00', 3),
	(54, '19:45:00', 3),
	(55, '20:00:00', 3),
	(56, '20:15:00', 3),
	(57, '20:30:00', 3),
	(58, '20:45:00', 3),
	(59, '21:00:00', 3),
	(60, '21:15:00', 3),
	(61, '21:30:00', 3),
	(62, '21:45:00', 3),
	(63, '22:00:00', 3),
	(64, '22:15:00', 3),
	(65, '22:30:00', 3),
	(80, '18:30:00', 4),
	(81, '18:45:00', 4),
	(82, '19:00:00', 4),
	(83, '19:15:00', 4),
	(84, '19:30:00', 4),
	(85, '19:45:00', 4),
	(86, '20:00:00', 4),
	(87, '20:15:00', 4),
	(88, '20:30:00', 4),
	(89, '20:45:00', 4),
	(90, '21:00:00', 4),
	(91, '21:15:00', 4),
	(92, '21:30:00', 4),
	(93, '21:45:00', 4),
	(94, '22:00:00', 4),
	(95, '22:15:00', 4),
	(96, '22:30:00', 4);

-- Dump della struttura di tabella herbamonstrum.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dump dei dati della tabella herbamonstrum.password_resets: ~0 rows (circa)

-- Dump della struttura di tabella herbamonstrum.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dump dei dati della tabella herbamonstrum.personal_access_tokens: ~0 rows (circa)
CREATE TABLE IF NOT EXISTS `prenotazioni` (
  `idPrenotazione` int NOT NULL AUTO_INCREMENT,
  `nomePrenotazione` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `telefono` bigint DEFAULT NULL,
  `coperti` int DEFAULT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL,
  `attiva` bit(1) NOT NULL DEFAULT b'1',
  `oraInizio` time NOT NULL,
  `oraFine` time DEFAULT NULL,
  `note` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `dataPrenotazione` date NOT NULL,
  `numeroBambini` int DEFAULT '0',
  `operatore` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `eliminata` bit(1) DEFAULT b'0',
  `sala` int DEFAULT NULL,
  `servizio` int DEFAULT NULL,
  `liberaTavolo` bit(1) DEFAULT NULL,
  `seduti` bit(1) DEFAULT NULL,
  PRIMARY KEY (`idPrenotazione`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=186 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dump dei dati della tabella herbamonstrum.prenotazioni: ~17 rows (circa)
INSERT INTO `prenotazioni` (`idPrenotazione`, `nomePrenotazione`, `telefono`, `coperti`, `created_at`, `updated_at`, `attiva`, `oraInizio`, `oraFine`, `note`, `dataPrenotazione`, `numeroBambini`, `operatore`, `eliminata`, `sala`, `servizio`, `liberaTavolo`, `seduti`) VALUES
	(169, 'asds', 4234234234324, 3, '2022-05-08', '2022-05-08', b'1', '18:30:00', '20:30:00', NULL, '2022-05-08', NULL, NULL, b'0', 2, NULL, NULL, NULL),
	(170, 'safasfasf', 43234234, 4, '2022-05-08', '2022-05-08', b'1', '18:30:00', '20:30:00', NULL, '2022-05-08', NULL, NULL, b'0', 2, NULL, NULL, NULL),
	(171, 'asdasda', 23424234, 5, '2022-05-09', '2022-05-09', b'1', '18:30:00', '20:00:00', NULL, '2022-05-09', NULL, NULL, b'0', 2, NULL, NULL, NULL),
	(172, 'sdasdsada', 2342342424, 4, '2022-05-12', '2022-05-12', b'1', '18:30:00', '20:30:00', NULL, '2022-05-12', NULL, NULL, b'0', 2, NULL, NULL, NULL),
	(173, 'sadadsas', 242344223424, 5, '2022-05-12', '2022-05-12', b'1', '18:30:00', '20:00:00', NULL, '2022-05-12', NULL, NULL, b'0', 2, NULL, NULL, NULL),
	(174, 'Davide', 3926990701, 2, '2022-05-14', '2022-05-14', b'1', '18:30:00', '20:30:00', 'Seggiolone', '2022-05-14', NULL, NULL, b'0', 2, NULL, NULL, NULL),
	(175, 'Magnozzo', 33333333333, 4, '2022-05-14', '2022-05-14', b'1', '21:00:00', '18:30:00', 'Preparare fusto dedicato', '2022-05-14', 0, NULL, b'0', 2, NULL, NULL, NULL),
	(176, 'Agnkzzo', 33333333333, 8, '2022-05-14', '2022-05-14', b'1', '20:00:00', '21:00:00', NULL, '2022-05-14', NULL, NULL, b'0', 2, NULL, NULL, NULL),
	(177, 'Agnozz', 33333333333, 4, '2022-05-14', '2022-05-14', b'1', '20:15:00', '21:00:00', NULL, '2022-05-14', NULL, NULL, b'0', 2, NULL, NULL, NULL),
	(178, 'Gigginho', 33333333333, 5, '2022-05-14', '2022-05-14', b'1', '18:30:00', '19:30:00', NULL, '2022-05-14', NULL, NULL, b'0', 2, NULL, NULL, NULL),
	(179, 'Gigginho', 33333333333, 30, '2022-05-14', '2022-05-14', b'1', '22:30:00', '23:00:00', NULL, '2022-05-14', NULL, NULL, b'0', 2, NULL, NULL, NULL),
	(180, 'Davide', 335584588844, 5, '2022-05-14', '2022-05-14', b'1', '20:15:00', '22:15:00', 'È antipatico', '2022-05-14', NULL, NULL, b'0', 2, NULL, NULL, NULL),
	(181, 'Utente1', 123, 5, '2022-05-14', '2022-05-14', b'1', '19:30:00', '18:30:00', NULL, '2022-05-14', NULL, NULL, b'0', 2, NULL, NULL, NULL),
	(182, 'Utente2', 567, 10, '2022-05-14', '2022-05-14', b'1', '19:45:00', '18:30:00', NULL, '2022-05-14', NULL, NULL, b'0', 2, NULL, NULL, NULL),
	(183, 'Pax', 555, 4, '2022-05-14', '2022-05-14', b'1', '19:00:00', '18:30:00', NULL, '2022-05-14', 5, NULL, b'0', 2, NULL, NULL, NULL),
	(184, 'Pax', 555, 4, '2022-05-14', '2022-05-14', b'1', '19:00:00', '18:30:00', NULL, '2022-05-14', 5, NULL, b'0', 2, NULL, NULL, NULL),
	(185, 'Pax', 555, 4, '2022-05-14', '2022-05-14', b'1', '19:00:00', '18:30:00', NULL, '2022-05-14', 5, NULL, b'0', 2, NULL, NULL, NULL);
-- Dump della struttura di tabella herbamonstrum.prenotazione_tavolo
CREATE TABLE IF NOT EXISTS `prenotazione_tavolo` (
  `prenotazione_id` int NOT NULL,
  `tavolo` int DEFAULT NULL,
  `postiOccupati` int DEFAULT NULL,
  `sala` int DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `nomeTavolo` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `postiRimanenti` int DEFAULT NULL,
  `dataPrenotazione` date DEFAULT NULL,
  `oraInizio` time DEFAULT NULL,
  `oraFine` time DEFAULT NULL,
  KEY `FK1wx2dvuk957wvka5107wc00iw_idx` (`prenotazione_id`) USING BTREE,
  CONSTRAINT `FK1wx2dvuk957wvka5107wc00iw` FOREIGN KEY (`prenotazione_id`) REFERENCES `prenotazioni` (`idPrenotazione`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dump dei dati della tabella herbamonstrum.prenotazione_tavolo: ~21 rows (circa)
INSERT INTO `prenotazione_tavolo` (`prenotazione_id`, `tavolo`, `postiOccupati`, `sala`, `updated_at`, `created_at`, `nomeTavolo`, `postiRimanenti`, `dataPrenotazione`, `oraInizio`, `oraFine`) VALUES
	(169, 26, 3, 2, '2022-05-08', '2022-05-08', 'Bir 1', 7, '2022-05-08', '18:30:00', '20:30:00'),
	(170, 37, 4, 2, '2022-05-08', '2022-05-08', 'Bir 12', 6, '2022-05-08', '18:30:00', '20:30:00'),
	(171, 17, 5, 2, '2022-05-09', '2022-05-09', 'Legno 1', -1, '2022-05-09', '18:30:00', '20:00:00'),
	(171, 45, 5, 2, '2022-05-09', '2022-05-09', 'Banc 4', -4, '2022-05-09', '18:30:00', '20:00:00'),
	(171, 45, 5, 2, '2022-05-09', '2022-05-09', 'Banc 4', -4, '2022-05-09', '18:30:00', '20:00:00'),
	(171, 18, 5, 2, '2022-05-09', '2022-05-09', 'Legno 2', -1, '2022-05-09', '18:30:00', '20:00:00'),
	(171, 42, 5, 2, '2022-05-09', '2022-05-09', 'Banc 1', -4, '2022-05-09', '18:30:00', '20:00:00'),
	(171, 44, 5, 2, '2022-05-09', '2022-05-09', 'Banc 3', -4, '2022-05-09', '18:30:00', '20:00:00'),
	(173, 18, 5, 2, '2022-05-12', '2022-05-12', 'Legno 2', -1, '2022-05-12', '18:30:00', '20:00:00'),
	(172, 19, 4, 2, '2022-05-12', '2022-05-12', 'Legno 3', 0, '2022-05-12', '18:30:00', '20:30:00'),
	(175, 25, 4, 2, '2022-05-14', '2022-05-14', 'Mur 5', 0, '2022-05-14', '21:00:00', '18:30:00'),
	(176, 28, 8, 2, '2022-05-14', '2022-05-14', 'Bir 3', 2, '2022-05-14', '20:00:00', '21:00:00'),
	(178, 20, 5, 2, '2022-05-14', '2022-05-14', 'Legno 4', -1, '2022-05-14', '18:30:00', '19:30:00'),
	(179, 26, 30, 2, '2022-05-14', '2022-05-14', 'Bir 1', -20, '2022-05-14', '22:30:00', '23:00:00'),
	(179, 27, 30, 2, '2022-05-14', '2022-05-14', 'Bir 2', -20, '2022-05-14', '22:30:00', '23:00:00'),
	(179, 28, 30, 2, '2022-05-14', '2022-05-14', 'Bir 3', -20, '2022-05-14', '22:30:00', '23:00:00'),
	(174, 17, 2, 2, '2022-05-14', '2022-05-14', 'Legno 1', 2, '2022-05-14', '18:30:00', '20:30:00'),
	(180, 29, 5, 2, '2022-05-14', '2022-05-14', 'Bir 4', 5, '2022-05-14', '20:15:00', '22:15:00'),
	(181, 30, 5, 2, '2022-05-14', '2022-05-14', 'Bir 5', 5, '2022-05-14', '19:30:00', '18:30:00'),
	(177, 28, 4, 2, '2022-05-14', '2022-05-14', 'Bir 3', -24, '2022-05-14', '20:15:00', '21:00:00'),
	(182, 30, 10, 2, '2022-05-14', '2022-05-14', 'Bir 5', 0, '2022-05-14', '19:45:00', '18:30:00');

-- Dump della struttura di tabella herbamonstrum.prenotazioni


-- Dump della struttura di tabella herbamonstrum.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `roleId` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`roleId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dump dei dati della tabella herbamonstrum.roles: ~0 rows (circa)
INSERT INTO `roles` (`roleId`, `name`) VALUES
	(1, 'ROLE_ADMIN');

-- Dump della struttura di tabella herbamonstrum.tavoli
CREATE TABLE IF NOT EXISTS `tavoli` (
  `idTavolo` int NOT NULL AUTO_INCREMENT,
  `tavolo` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `descrizione` varchar(250) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `capienza` int NOT NULL,
  `note` varchar(250) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `attivo` bit(1) NOT NULL DEFAULT b'1',
  `libero` bit(1) NOT NULL DEFAULT b'1',
  `sala` int DEFAULT '1',
  `divisibile` bit(1) DEFAULT NULL,
  PRIMARY KEY (`idTavolo`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dump dei dati della tabella herbamonstrum.tavoli: ~45 rows (circa)
INSERT INTO `tavoli` (`idTavolo`, `tavolo`, `descrizione`, `capienza`, `note`, `attivo`, `libero`, `sala`, `divisibile`) VALUES
	(1, '1', 'Tavolo 1', 4, NULL, b'1', b'1', 1, b'0'),
	(2, '2', 'Tavolo 2', 2, NULL, b'1', b'1', 1, b'0'),
	(3, '3', 'Tavolo 3', 3, NULL, b'1', b'1', 1, b'0'),
	(4, '4', 'Tavolo 4', 2, NULL, b'1', b'1', 1, b'0'),
	(5, '5', 'Tavolo 5', 5, NULL, b'1', b'1', 1, b'0'),
	(6, '6', 'Tavolo 6', 6, NULL, b'1', b'1', 1, b'0'),
	(7, '7', 'Tavolo 7', 2, NULL, b'1', b'1', 1, b'0'),
	(8, '8A', 'Tavolo 8A', 4, NULL, b'1', b'1', 1, b'0'),
	(9, '8B', 'Tavolo 8B', 4, NULL, b'1', b'1', 1, b'0'),
	(10, '9A', 'Tavolo 9A', 4, NULL, b'1', b'1', 1, b'0'),
	(11, '9B', 'Tavolo 9B', 4, NULL, b'1', b'1', 1, b'0'),
	(12, '10A', 'Tavolo 10A', 2, NULL, b'1', b'1', 1, b'0'),
	(13, '10B', 'Tavolo 10B', 2, NULL, b'1', b'1', 1, b'0'),
	(14, '10C', 'Tavolo 10C', 2, NULL, b'1', b'1', 1, b'0'),
	(15, 'B.E. A', 'Bancone Esterno A', 2, NULL, b'1', b'1', 1, b'0'),
	(16, 'B.E. B', 'Bancone Esterno B', 2, NULL, b'1', b'1', 1, b'0'),
	(17, 'Legno 1', 'Muro Legno 1', 4, NULL, b'1', b'1', 2, b'0'),
	(18, 'Legno 2', 'Muro Legno 2', 4, NULL, b'1', b'1', 2, b'0'),
	(19, 'Legno 3', 'Muro Legno 3', 4, NULL, b'1', b'1', 2, b'0'),
	(20, 'Legno 4', 'Muro Legno 4', 4, NULL, b'1', b'1', 2, b'0'),
	(21, 'Mur 1', 'Murales 1', 4, NULL, b'1', b'1', 2, b'0'),
	(22, 'Mur 2', 'Murales 2', 4, NULL, b'1', b'1', 2, b'0'),
	(23, 'Mur 3', 'Murales 3', 4, NULL, b'1', b'1', 2, b'0'),
	(24, 'Mur 4', 'Murales 4', 4, NULL, b'1', b'1', 2, b'0'),
	(25, 'Mur 5', 'Murales 5', 4, NULL, b'1', b'1', 2, b'0'),
	(26, 'Bir 1', 'Birreria 1', 10, NULL, b'1', b'1', 2, b'1'),
	(27, 'Bir 2', 'Birreria 2', 10, NULL, b'1', b'1', 2, b'1'),
	(28, 'Bir 3', 'Birreria 3', 10, NULL, b'1', b'1', 2, b'1'),
	(29, 'Bir 4', 'Birreria 4', 10, NULL, b'1', b'1', 2, b'1'),
	(30, 'Bir 5', 'Birreria 5', 10, NULL, b'1', b'1', 2, b'1'),
	(31, 'Bir 6', 'Birreria 6', 10, NULL, b'1', b'1', 2, b'1'),
	(32, 'Bir 7', 'Birreria 7', 10, NULL, b'1', b'1', 2, b'1'),
	(33, 'Bir 8', 'Birreria 8', 10, NULL, b'1', b'1', 2, b'1'),
	(34, 'Bir 9', 'Birreria 9', 10, NULL, b'1', b'1', 2, b'1'),
	(35, 'Bir 10', 'Birreria 10', 10, NULL, b'1', b'1', 2, b'1'),
	(36, 'Bir 11', 'Birreria 11', 10, NULL, b'1', b'1', 2, b'1'),
	(37, 'Bir 12', 'Birreria 12', 10, NULL, b'1', b'1', 2, b'1'),
	(38, 'Bir 13', 'Birreria 13', 10, NULL, b'1', b'1', 2, b'1'),
	(39, 'Bir 14', 'Birreria 14', 10, NULL, b'1', b'1', 2, b'1'),
	(40, 'Bir 15', 'Birreria 15', 10, NULL, b'1', b'1', 2, b'1'),
	(41, 'Bir 16', 'Birreria 16', 10, NULL, b'1', b'1', 2, b'1'),
	(42, 'Banc 1', 'Bancone1', 1, NULL, b'1', b'1', 2, b'0'),
	(43, 'Banc 2', 'Bancone 2', 1, NULL, b'1', b'1', 2, b'0'),
	(44, 'Banc 3', 'Bancone 3', 1, NULL, b'1', b'1', 2, b'0'),
	(45, 'Banc 4', 'Bancone 4', 1, NULL, b'1', b'1', 2, b'0');

-- Dump della struttura di vista herbamonstrum.tavoliLiberi
-- Creazione di una tabella temporanea per risolvere gli errori di dipendenza della vista
CREATE TABLE `tavoliLiberi` (
	`tavolo` INT(10) NOT NULL,
	`capienza` BIGINT(19) NULL,
	`prenotazione_id` INT(10) NOT NULL
) ENGINE=MyISAM;

-- Dump della struttura di tabella herbamonstrum.tavoliprenotati
CREATE TABLE IF NOT EXISTS `tavoliprenotati` (
  `id` int NOT NULL AUTO_INCREMENT,
  `idPrenotazione` int DEFAULT NULL,
  `idTavolo` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dump dei dati della tabella herbamonstrum.tavoliprenotati: ~0 rows (circa)

-- Dump della struttura di tabella herbamonstrum.unionetavoli
CREATE TABLE IF NOT EXISTS `unionetavoli` (
  `idUnione` int NOT NULL AUTO_INCREMENT,
  `idTavolo1` int NOT NULL,
  `idTavolo2` int NOT NULL,
  `idSala` int NOT NULL,
  PRIMARY KEY (`idUnione`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dump dei dati della tabella herbamonstrum.unionetavoli: ~4 rows (circa)
INSERT INTO `unionetavoli` (`idUnione`, `idTavolo1`, `idTavolo2`, `idSala`) VALUES
	(1, 8, 9, 1),
	(2, 10, 11, 1),
	(3, 12, 13, 1),
	(4, 13, 14, 1);

-- Dump della struttura di tabella herbamonstrum.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dump dei dati della tabella herbamonstrum.users: ~0 rows (circa)
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'admin', 'admin@herbamonstrum.com', '2022-04-25 11:00:44', '$2a$12$K5AaMVx9yXUKpgYGqU7Z3uhdTi.GivA6qg2ABNNvfXGNRA.Ia9vzm', 'WU5IVYGSOeKKNP5OWchYc8aaIo9ElKTtmSnNGzNtzZdfgJlOtBlFIYZXs0h7', '2022-04-25 11:01:01', '2022-04-25 11:01:02');

-- Dump della struttura di vista herbamonstrum.capienzaTavolo
-- Rimozione temporanea di tabella e creazione della struttura finale della vista
DROP TABLE IF EXISTS `capienzaTavolo`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `capienzaTavolo` AS select `t`.`idTavolo` AS `idTavolo`,`t`.`tavolo` AS `tavolo`,`tl`.`capienza` AS `capienza`,`t`.`sala` AS `sala` from (`tavoli` `t` join `tavoliLiberi` `tl` on((`tl`.`tavolo` = `t`.`idTavolo`)));

-- Dump della struttura di vista herbamonstrum.tavoliLiberi
-- Rimozione temporanea di tabella e creazione della struttura finale della vista
DROP TABLE IF EXISTS `tavoliLiberi`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `tavoliLiberi` AS select `t`.`idTavolo` AS `tavolo`,(`t`.`capienza` - `p`.`postiOccupati`) AS `capienza`,`p`.`prenotazione_id` AS `prenotazione_id` from (`prenotazione_tavolo` `p` join `tavoli` `t` on((`p`.`tavolo` = `t`.`idTavolo`))) where ((((`t`.`capienza` - `p`.`postiOccupati`) <= 0) and (`t`.`divisibile` = 1)) or (`t`.`divisibile` = 0));

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
