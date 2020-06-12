-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               8.0.12 - MySQL Community Server - GPL
-- Операционная система:         Win64
-- HeidiSQL Версия:              9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Дамп структуры для таблица sionic.cities
CREATE TABLE IF NOT EXISTS `cities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `classifier` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code_unique` (`code`),
  UNIQUE KEY `classifier_unique` (`classifier`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы sionic.cities: ~8 rows (приблизительно)
/*!40000 ALTER TABLE `cities` DISABLE KEYS */;
INSERT INTO `cities` (`id`, `classifier`, `code`) VALUES
	(1, 'febf7618-7731-4ff1-942d-464809310f52', 'msk'),
	(2, '0ed030a4-c3f7-48bb-b3ab-fe1cd85a089d', 'spb'),
	(3, '97e11fe4-86c7-4cf4-bc98-bf4a909babad', 'smr'),
	(4, 'ae99aae5-88e3-420c-8b55-d8b866703693', 'srt'),
	(5, '695771f0-117f-4a73-a0bb-0b7f6af1bc05', 'kzn'),
	(6, 'caf5aeb2-99d6-4ce8-b6ba-129e8d37f7c4', 'nsb'),
	(7, 'abf3e096-ecce-4d7a-881f-5c421bd76baa', 'chb'),
	(8, 'a5608eee-1f3f-4de2-8388-ecb4235ac62a', 'dch');
/*!40000 ALTER TABLE `cities` ENABLE KEYS */;

-- Дамп структуры для таблица sionic.products
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `weight` double NOT NULL,
  `quantity_msk` int(11) NOT NULL,
  `quantity_spb` int(11) NOT NULL,
  `quantity_smr` int(11) NOT NULL,
  `quantity_srt` int(11) NOT NULL,
  `quantity_kzn` int(11) NOT NULL,
  `quantity_nsb` int(11) NOT NULL,
  `quantity_chb` int(11) NOT NULL,
  `quantity_dch` int(11) NOT NULL,
  `price_msk` int(11) NOT NULL,
  `price_spb` int(11) NOT NULL,
  `price_smr` int(11) NOT NULL,
  `price_srt` int(11) NOT NULL,
  `price_kzn` int(11) NOT NULL,
  `price_nsb` int(11) NOT NULL,
  `price_chb` int(11) NOT NULL,
  `price_dch` int(11) NOT NULL,
  `usage` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=67573 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы sionic.products: ~16 777 rows (приблизительно)
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
/*!40000 ALTER TABLE `products` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
