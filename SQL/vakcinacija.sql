-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.32-log - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table vakcinacija.korisnici
CREATE TABLE IF NOT EXISTS `korisnici` (
  `id_korisnika` int(11) NOT NULL AUTO_INCREMENT,
  `ime` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `prezime` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `adresa` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `grad` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `broj_telefona` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `korisnicko_ime` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `lozinka` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `aktivan` tinyint(1) DEFAULT '1',
  `admin_nivo` tinyint(1) DEFAULT '1' COMMENT '7 = backend',
  `super_user` enum('D','N') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  PRIMARY KEY (`id_korisnika`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table vakcinacija.korisnici: ~0 rows (approximately)
/*!40000 ALTER TABLE `korisnici` DISABLE KEYS */;
INSERT INTO `korisnici` (`id_korisnika`, `ime`, `prezime`, `adresa`, `grad`, `broj_telefona`, `email`, `korisnicko_ime`, `lozinka`, `aktivan`, `admin_nivo`, `super_user`) VALUES
	(1, 'Administrator', NULL, NULL, NULL, NULL, NULL, 'admin', '21232f297a57a5a743894a0e4a801fc323a6ef2a7db51e562bd82a473183d4c2', 1, 7, 'D');
/*!40000 ALTER TABLE `korisnici` ENABLE KEYS */;

-- Dumping structure for table vakcinacija.oboljenja
CREATE TABLE IF NOT EXISTS `oboljenja` (
  `id_oboljenja` int(11) NOT NULL AUTO_INCREMENT,
  `oboljenje` varchar(255) NOT NULL,
  PRIMARY KEY (`id_oboljenja`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- Dumping data for table vakcinacija.oboljenja: ~10 rows (approximately)
/*!40000 ALTER TABLE `oboljenja` DISABLE KEYS */;
INSERT INTO `oboljenja` (`id_oboljenja`, `oboljenje`) VALUES
	(1, 'Малигна обољења (пацијенти на хемиотерапији, малигне хемопатије, недавна трансплатација матичних ћелија)'),
	(2, 'Хронична обољења срца и крвних судова (тешка декомпензација срца: попуштање срца, кардиомиопатија)'),
	(3, 'Хронична бубрежна обољења и дијализа'),
	(4, 'Хронична обољења јетре (осим хроничних инфекција хепатитис Б или хепатитис Ц вирусом)'),
	(5, 'Хронична обољења плућа (хронична опструктивна болест плућа, цистична фиброза, интерстицијске болести плућа, примарна плућна хипертензија, пацијенти који захтевају ДОТ или НИВ у кућним условима)'),
	(6, 'Дијабетес (особе на терапији инсулином уколико је потребно пооштравати критеријум, односно све особе са дијагностикованим дијабетесом уколико имамо на располагању довољне количине вакцине)'),
	(7, 'Стања имуносупресије, укључујући и трансплантацију органа'),
	(8, 'Неуролошка обољења, укључујући и цереброваскуларна обољења'),
	(9, 'Гојазност (BMI> 40 кг/м2)'),
	(10, 'Резистентна хипертензија са вредностима крвног притиска већим од 140/90 mmHg упркос трострукој комбинацији хипертензива');
/*!40000 ALTER TABLE `oboljenja` ENABLE KEYS */;

-- Dumping structure for table vakcinacija.opstine
CREATE TABLE IF NOT EXISTS `opstine` (
  `id_opstine` int(11) NOT NULL AUTO_INCREMENT,
  `naziv_opstine` varchar(255) NOT NULL,
  PRIMARY KEY (`id_opstine`)
) ENGINE=InnoDB AUTO_INCREMENT=128 DEFAULT CHARSET=utf8;

-- Dumping data for table vakcinacija.opstine: ~64 rows (approximately)
/*!40000 ALTER TABLE `opstine` DISABLE KEYS */;
INSERT INTO `opstine` (`id_opstine`, `naziv_opstine`) VALUES
	(1, 'Град Бања Лука'),
	(2, 'Град Бијељина'),
	(3, 'Град Источно Сарајево'),
	(4, 'Град Добој'),
	(5, 'Град Приједор'),
	(6, 'Град Требиње'),
	(7, 'Град Зворник'),
	(8, 'Град Градишка'),
	(9, 'Берковићи'),
	(10, 'Билећа'),
	(11, 'Братунац'),
	(12, 'Брод'),
	(13, 'Вишеград'),
	(14, 'Власеница'),
	(15, 'Вукосавље'),
	(16, 'Гацко'),
	(17, 'Дервента'),
	(18, 'Доњи Жабар'),
	(19, 'Источна Илиџа'),
	(20, 'Источни Дрвар'),
	(21, 'Источни Мостар'),
	(22, 'Источни Стари Град'),
	(23, 'Источно Ново Сарајево'),
	(24, 'Језеро'),
	(25, 'Калиновик'),
	(26, 'Кнежево'),
	(27, 'Козарска Дубица'),
	(28, 'Костајница'),
	(29, 'Котор Варош'),
	(30, 'Крупа на Уни'),
	(31, 'Купрес'),
	(32, 'Лакташи'),
	(33, 'Лопаре'),
	(34, 'Љубиње'),
	(35, 'Милићи'),
	(36, 'Модрича'),
	(37, 'Мркоњић Град'),
	(38, 'Невесиње'),
	(39, 'Нови Град'),
	(40, 'Ново Горажде'),
	(41, 'Осмаци'),
	(42, 'Оштра Лука'),
	(43, 'Пале'),
	(44, 'Пелагићево'),
	(45, 'Петровац'),
	(46, 'Петрово'),
	(47, 'Прњавор'),
	(48, 'Рибник'),
	(49, 'Рогатица'),
	(50, 'Рудо'),
	(51, 'Соколац'),
	(52, 'Србац'),
	(53, 'Сребреница'),
	(54, 'Станари'),
	(55, 'Теслић'),
	(56, 'Трново'),
	(57, 'Угљевик'),
	(58, 'Фоча'),
	(59, 'Хан Пијесак'),
	(60, 'Чајниче'),
	(61, 'Челинац'),
	(62, 'Шамац'),
	(63, 'Шековићи'),
	(64, 'Шипово');
/*!40000 ALTER TABLE `opstine` ENABLE KEYS */;

-- Dumping structure for table vakcinacija.pacijeni_oboljenja
CREATE TABLE IF NOT EXISTS `pacijeni_oboljenja` (
  `id_pacijenta` int(11) NOT NULL,
  `id_oboljenja` int(11) NOT NULL,
  KEY `FK_Pacijenti_Oboljenja_Pacijenti` (`id_pacijenta`),
  KEY `FK_Pacijenti_Oboljenja_Oboljenja` (`id_oboljenja`),
  CONSTRAINT `FK_Pacijenti_Oboljenja_Oboljenja` FOREIGN KEY (`id_oboljenja`) REFERENCES `oboljenja` (`id_oboljenja`) ON UPDATE CASCADE,
  CONSTRAINT `FK_Pacijenti_Oboljenja_Pacijenti` FOREIGN KEY (`id_pacijenta`) REFERENCES `pacijenti` (`id_pacijenta`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table vakcinacija.pacijeni_oboljenja: ~0 rows (approximately)
/*!40000 ALTER TABLE `pacijeni_oboljenja` DISABLE KEYS */;
/*!40000 ALTER TABLE `pacijeni_oboljenja` ENABLE KEYS */;

-- Dumping structure for table vakcinacija.pacijenti
CREATE TABLE IF NOT EXISTS `pacijenti` (
  `id_pacijenta` int(11) NOT NULL AUTO_INCREMENT,
  `drzavljanstvo` varchar(255) NOT NULL,
  `jmbg_pasos` varchar(50) NOT NULL,
  `ime` varchar(50) NOT NULL,
  `prezime` varchar(50) NOT NULL,
  `imejl` varchar(100) NOT NULL,
  `brmob` varchar(50) NOT NULL,
  `brfiks` varchar(50) DEFAULT NULL,
  `id_opstine` int(11) NOT NULL,
  `oboljenja` tinyint(1) NOT NULL COMMENT '1 - Da, 0 - Ne',
  `pokretan` tinyint(1) NOT NULL COMMENT '1 - Da, 0 - Ne',
  `davalac_krvi` tinyint(1) NOT NULL COMMENT '1 - Da, 0 - Ne',
  PRIMARY KEY (`id_pacijenta`),
  KEY `FK_Pacijenti_Opstine` (`id_opstine`),
  CONSTRAINT `FK_Pacijenti_Opstine` FOREIGN KEY (`id_opstine`) REFERENCES `opstine` (`id_opstine`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table vakcinacija.pacijenti: ~8 rows (approximately)
/*!40000 ALTER TABLE `pacijenti` DISABLE KEYS */;
/*!40000 ALTER TABLE `pacijenti` ENABLE KEYS */;

-- Dumping structure for table vakcinacija.zakazani_termini_vakcinacije
CREATE TABLE IF NOT EXISTS `zakazani_termini_vakcinacije` (
  `id_termina` int(11) NOT NULL AUTO_INCREMENT,
  `id_pacijenta` int(11) NOT NULL,
  `datum_vrijeme` datetime NOT NULL,
  `tip` enum('V','R') NOT NULL DEFAULT 'V' COMMENT 'V = Vakcinacija; R = Revakcinacija',
  PRIMARY KEY (`id_termina`),
  KEY `FK_Zakazani_Termini_Vakcinacije_Pacijenti` (`id_pacijenta`),
  CONSTRAINT `FK_Zakazani_Termini_Vakcinacije_Pacijenti` FOREIGN KEY (`id_pacijenta`) REFERENCES `pacijenti` (`id_pacijenta`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table vakcinacija.zakazani_termini_vakcinacije: ~0 rows (approximately)
/*!40000 ALTER TABLE `zakazani_termini_vakcinacije` DISABLE KEYS */;
/*!40000 ALTER TABLE `zakazani_termini_vakcinacije` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
