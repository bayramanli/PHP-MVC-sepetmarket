-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1:3306
-- Üretim Zamanı: 08 Tem 2021, 12:30:24
-- Sunucu sürümü: 5.7.31
-- PHP Sürümü: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `sepetmarket`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `basket`
--

DROP TABLE IF EXISTS `basket`;
CREATE TABLE IF NOT EXISTS `basket` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `record_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=71 DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `basket`
--

INSERT INTO `basket` (`id`, `product_id`, `customer_id`, `quantity`, `record_date`) VALUES
(68, 1, 1, 22, '2021-07-08 14:36:06'),
(69, 3, 1, 2, '2021-07-08 14:36:06'),
(70, 8, 1, 4, '2021-07-08 14:36:07'),
(62, 7, 1, 5, '2021-07-08 14:23:58'),
(66, 2, 1, 3, '2021-07-08 14:36:02'),
(65, 6, 1, 1, '2021-07-08 14:36:01');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `surname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `passwords` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `customer`
--

INSERT INTO `customer` (`id`, `name`, `surname`, `email`, `passwords`) VALUES
(1, 'Bayram', 'ANLI', 'bayramanli@mail.com', '25f9e794323b453885f5181f1b624d0b');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `stock` int(11) NOT NULL,
  `price` float(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `product`
--

INSERT INTO `product` (`id`, `name`, `stock`, `price`) VALUES
(1, 'Akıllı Telefon', 95, 3999.00),
(2, 'Ütü', 82, 549.00),
(3, 'Televizyon', 48, 2599.99),
(4, 'Buzdolabı', 32, 4220.49),
(5, 'Yemek Masası', 20, 899.99),
(6, 'Sandalye', 100, 79.49),
(7, 'Çamaşır Makinesi', 3300, 25.00),
(8, 'Bulaşık Makinesi', 36, 2487.99);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
