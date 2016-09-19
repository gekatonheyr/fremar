-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               10.1.9-MariaDB - mariadb.org binary distribution
-- ОС Сервера:                   Win32
-- HeidiSQL Версия:              9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
-- Дамп данных таблицы fremar.contacts: ~3 rows (приблизительно)
/*!40000 ALTER TABLE `contacts` DISABLE KEYS */;
INSERT INTO `contacts` (`id`, `firstName`, `lastName`, `telNumber`, `emailAddress`, `resPlaceName`, `resPlaceDistrict`, `resPlaceStreet`, `resPlaceHouseNumber`, `resPlaceAppartNumber`) VALUES
	(1, 'taras', 'sarana', '0675505646', 'gek@ukr.net', 'Brovary', 'Дарницкий', 'Автопарковая', '3', '90'),
	(4, 'ivan', 'ivanov', '0506789458', 'i.ivanov@ukr.net', 'Kiev', 'Днепровский', 'Беломорская', '12', '36'),
	(5, 'petr', 'petrov', '0445693864', 'ppetrov@ukr.net', 'Kiev', 'Шевченковский', 'Десятинная', '87', '46'),
	(6, 'ivan', 'petrov', '05487493621', 'i.petrov@ukr.net', 'Kiev', 'Подольский', 'Глуховская', '36', '90'),
	(7, 'petr', 'ivanov', '94637495763', 'p.ivanov@ukr.net', 'Kiev', 'Днепровский', 'Беломорская', '36', '12');
/*!40000 ALTER TABLE `contacts` ENABLE KEYS */;

-- Дамп данных таблицы fremar.districts: ~5 rows (приблизительно)
/*!40000 ALTER TABLE `districts` DISABLE KEYS */;
INSERT INTO `districts` (`id`, `districtName`) VALUES
	(1, 'Дарницкий'),
	(2, 'Днепровский'),
	(3, 'Печерский'),
	(4, 'Подольский'),
	(5, 'Шевченковский');
/*!40000 ALTER TABLE `districts` ENABLE KEYS */;

-- Дамп данных таблицы fremar.streets: ~20 rows (приблизительно)
/*!40000 ALTER TABLE `streets` DISABLE KEYS */;
INSERT INTO `streets` (`id`, `district_id`, `streetName`) VALUES
	(1, 1, 'Автопарковая '),
	(2, 1, 'Автотранспортная '),
	(3, 1, 'Армянская '),
	(4, 1, 'Ахматовой '),
	(5, 2, 'Бажова '),
	(6, 2, 'Беломорская '),
	(7, 2, 'Березневая '),
	(8, 2, 'Березняковская '),
	(9, 3, ' Верхняя '),
	(10, 3, 'Вишни '),
	(11, 3, 'Выдубицкая '),
	(12, 3, 'Верхнегорская '),
	(13, 4, 'Газопроводная'),
	(14, 4, 'Галицкая'),
	(15, 4, 'Глуховская'),
	(16, 4, 'Гомельская'),
	(17, 5, 'Дегтяривская '),
	(18, 5, 'Деревлянская '),
	(19, 5, 'Десятинная '),
	(20, 5, 'Дмитриевская ');
/*!40000 ALTER TABLE `streets` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
