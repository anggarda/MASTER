-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 13, 2012 at 11:06 
-- Server version: 5.1.37
-- PHP Version: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `rjl`
--

-- --------------------------------------------------------

--
-- Table structure for table `t_cart`
--

CREATE TABLE IF NOT EXISTS `t_cart` (
  `OrderID` int(11) NOT NULL,
  `ProdID` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Total` mediumint(9) NOT NULL,
  `satuan` varchar(50) NOT NULL,
  PRIMARY KEY (`OrderID`,`ProdID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_cart`
--


-- --------------------------------------------------------

--
-- Table structure for table `t_customer`
--

CREATE TABLE IF NOT EXISTS `t_customer` (
  `CustID` int(11) NOT NULL AUTO_INCREMENT,
  `CustName` varchar(25) NOT NULL,
  `CustAdd` varchar(100) NOT NULL,
  `City` varchar(25) NOT NULL,
  `CustContact` varchar(20) NOT NULL,
  `Email` varchar(25) NOT NULL,
  `Birthdate` date NOT NULL,
  PRIMARY KEY (`CustID`,`Email`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=39 ;

--
-- Dumping data for table `t_customer`
--


-- --------------------------------------------------------

--
-- Table structure for table `t_feedback`
--

CREATE TABLE IF NOT EXISTS `t_feedback` (
  `CommentID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(25) NOT NULL,
  `Email` varchar(25) NOT NULL,
  `Comments` varchar(150) NOT NULL,
  `Date` date NOT NULL,
  PRIMARY KEY (`CommentID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `t_feedback`
--


-- --------------------------------------------------------

--
-- Table structure for table `t_order`
--

CREATE TABLE IF NOT EXISTS `t_order` (
  `OrderID` int(11) NOT NULL AUTO_INCREMENT,
  `CustID` int(11) NOT NULL,
  `DeliverName` varchar(25) NOT NULL,
  `DeliverAdd` varchar(100) NOT NULL,
  `DeliverCity` varchar(25) NOT NULL,
  `Province` varchar(25) NOT NULL,
  `OrderDate` date NOT NULL,
  `Subtotal` mediumint(9) NOT NULL,
  `Grandtotal` mediumint(9) NOT NULL,
  `OrderStatus` varchar(10) NOT NULL,
  PRIMARY KEY (`OrderID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=109 ;

--
-- Dumping data for table `t_order`
--


-- --------------------------------------------------------

--
-- Table structure for table `t_product`
--

CREATE TABLE IF NOT EXISTS `t_product` (
  `ProdID` int(11) NOT NULL AUTO_INCREMENT,
  `ProdType` varchar(25) NOT NULL,
  `ProdBrand` varchar(25) NOT NULL,
  `ProdName` varchar(50) NOT NULL,
  `ProdImage` varchar(100) NOT NULL,
  `Description` varchar(50) DEFAULT NULL,
  `Price` mediumint(9) NOT NULL,
  `Details` longtext,
  `Stock` int(11) NOT NULL,
  `satuan` varchar(11) NOT NULL,
  PRIMARY KEY (`ProdID`),
  FULLTEXT KEY `ProdType` (`ProdType`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=177 ;

--
-- Dumping data for table `t_product`
--

INSERT INTO `t_product` (`ProdID`, `ProdType`, `ProdBrand`, `ProdName`, `ProdImage`, `Description`, `Price`, `Details`, `Stock`, `satuan`) VALUES
(173, 'Reel', 'Game Reels', 'PENN 320 GT2', 'PENN 320 GT2.jpg', 'Isikan Deskripsi', 450000, 'ISikan RIncian', 15, ''),
(172, 'Reel', 'Spinning Reels', 'SHIMANO', 'SHIMANO.jpg', 'Isikan Deskripsi', 360000, 'ISikan Rincian', 13, ''),
(171, 'Reel', 'Spinning Reels', 'Rage', 'RAGE.jpg', 'Isikan Deskripsi', 270000, 'Isikan RIncian', 18, ''),
(170, 'Lure', 'Lure', 'Surebite', 'SUREBITE.jpg', 'Isikan Deskripsi', 30000, 'Isikan Rincian', 56, ''),
(169, 'Line', 'Mainline', 'Teklon', 'Teklon.JPG', 'Isikan Deskripsi', 80000, 'Isikan RIncian', 30, ''),
(168, 'Line', 'Mainline', 'Carbonite PE', 'CARBONITE PE.jpg', 'Isikan Deskripsi', 300000, 'Isikan Deskripsi', 25, ''),
(174, 'Reel', 'Baitcasting Reels', 'OKuma San JUan', 'OKUMA SAN JUAN.jpg', 'Isikan Deskripsi', 370000, 'Isikan Rincian', 14, ''),
(175, 'Reel', 'Baitcasting Reels', 'Calcuta DC', 'CALCUTTA DC.jpeg', 'Isikan Deskripsi', 300000, 'Isikan Rincian', 20, ''),
(176, 'Reel', 'Game Reels', 'TOURNAMENT', 'TOURNAMENT.jpg', 'Isikan Deskripsi', 400000, 'Isikan Rincian', 14, '');

-- --------------------------------------------------------

--
-- Table structure for table `t_province`
--

CREATE TABLE IF NOT EXISTS `t_province` (
  `Province` varchar(25) NOT NULL,
  `DelPrice` mediumint(9) NOT NULL,
  `Duration` varchar(5) NOT NULL,
  PRIMARY KEY (`Province`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_province`
--

INSERT INTO `t_province` (`Province`, `DelPrice`, `Duration`) VALUES
('Bangka Belitung', 80000, '2-4'),
('Banten', 24000, '3-4'),
('Bengkulu', 25000, '1-2'),
('DKI Jakarta', 16000, '3-4'),
('Gorontalo', 55000, '4-5'),
('Jambi', 22000, '1-2'),
('Jawa Barat', 19000, '2-3'),
('Jawa Tengah', 21000, '2-3'),
('Jawa Timur', 24000, '2-3'),
('Kalimantan Barat', 29500, '3-4'),
('Kalimantan Selatan', 29000, '3-4'),
('Kalimantan Tengah', 29000, '3-4'),
('Kalimantan Timur', 33500, '3-4'),
('Lampung', 21000, '1-2'),
('Maluku', 40000, '3-4'),
('Maluku Utara', 42000, '3-4'),
('Nusa Tenggara Barat', 26500, '3-4'),
('Nusa Tenggara Timur', 37000, '3-4'),
('Papua', 60500, '6-7'),
('Bali', 50000, '5-7'),
('Riau', 16000, '1-2'),
('Sulawesi Selatan', 33000, '3-4'),
('Sulawesi Tengah', 36000, '3-4'),
('Sulawesi Tenggara', 36000, '3-4'),
('Sulawesi Utara', 39000, '3-4'),
('Sumatra Barat', 20000, '1-2'),
('Sumatra Selatan', 19000, '1-2'),
('Sumatra Utara', 17000, '1-2'),
('Yogyakarta', 22000, '2-3'),
('Aceh', 70000, '3-5');

-- --------------------------------------------------------

--
-- Table structure for table `t_tracking`
--

CREATE TABLE IF NOT EXISTS `t_tracking` (
  `OrderID` int(10) NOT NULL,
  `TrackNo` varchar(10) NOT NULL,
  PRIMARY KEY (`OrderID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_tracking`
--


-- --------------------------------------------------------

--
-- Table structure for table `t_user`
--

CREATE TABLE IF NOT EXISTS `t_user` (
  `Username` varchar(25) NOT NULL,
  `Password` varchar(15) NOT NULL,
  `CustID` int(11) NOT NULL DEFAULT '0',
  `UserType` varchar(5) NOT NULL,
  PRIMARY KEY (`CustID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_user`
--

INSERT INTO `t_user` (`Username`, `Password`, `CustID`, `UserType`) VALUES
('Admin', '123456', 20, 'Admin');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
