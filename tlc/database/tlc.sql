-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 07, 2012 at 08:43 AM
-- Server version: 5.1.37
-- PHP Version: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `tlc`
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

INSERT INTO `t_cart` (`OrderID`, `ProdID`, `Quantity`, `Total`, `satuan`) VALUES
(41, 137, 1, 200000, ''),
(42, 137, 1, 200000, ''),
(0, 138, 1, 200000, ''),
(52, 140, 1, 10000, ''),
(51, 138, 1, 200000, ''),
(53, 138, 1, 200000, ''),
(54, 138, 1, 200000, ''),
(55, 138, 1, 200000, ''),
(56, 139, 1, 200000, ''),
(57, 139, 2, 400000, ''),
(58, 142, 1, 10000, ''),
(59, 152, 1, 18000, ''),
(60, 152, 1, 18000, '');

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

INSERT INTO `t_customer` (`CustID`, `CustName`, `CustAdd`, `City`, `CustContact`, `Email`, `Birthdate`) VALUES
(38, 'Heri Sun', 'Permata Baloi Batam', 'Batam', '08127040426', 'Herisun@gmail.com', '1989-10-22'),
(37, 'Hans', 'gafgagagag', 'Gagafda', '2652643747', 'hans@gmail.co.id', '1989-10-22'),
(36, 'Chris', 'Batam', 'Batam', '0778456456', 'chris@ymail.com', '1980-01-30'),
(34, 'Hans', 'Jodoh Blok H No22', 'Batam', '08566669876', 'hansmorico@yahoo.com', '1990-06-23'),
(35, 'Era', 'Blok 2 pelita', 'Batam', '08127001234', 'era@ymail.com', '1990-02-09');

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

INSERT INTO `t_feedback` (`CommentID`, `Name`, `Email`, `Comments`, `Date`) VALUES
(35, 'Heri ', 'heri_heri@yahoo.com', 'Barangnya sudah tiba', '2012-03-29');

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

INSERT INTO `t_order` (`OrderID`, `CustID`, `DeliverName`, `DeliverAdd`, `DeliverCity`, `Province`, `OrderDate`, `Subtotal`, `Grandtotal`, `OrderStatus`) VALUES
(108, 38, 'Heri Sun', 'Balai', 'Meral', 'Riau', '2012-05-17', 180000, 196000, 'Pending'),
(107, 34, '', '', '', '', '2012-05-11', 360000, 360000, 'Pending'),
(106, 34, 'Ahmad Dani', 'Jakarta barat - kuningan\r\nno.1688', 'Jakarta', 'DKI Jakarta', '2012-05-10', 180000, 196000, 'Cancelled'),
(105, 34, 'Phillip Morris', 'Peace Road\r\nAceh', 'Aceh', 'Aceh', '2012-04-18', 8000000, 8070000, 'Cancelled'),
(104, 35, 'Era', 'Batam', 'Batam', 'Jawa Timur', '2012-04-03', 1250000, 1274000, 'Cancelled'),
(103, 35, 'Era', 'Afafaf', 'Afaf', 'Nusa Tenggara Barat', '2012-04-03', 360000, 386500, 'Pending'),
(102, 36, 'John Carter', 'Jl.Kapitan Pattimura blok G5, no .124B\r\n', 'Ternate', 'Maluku', '2012-03-30', 8388607, 8388607, 'Paid'),
(81, 20, 'Tommy Chandra', 'Perumahan mitra raya blok a no 46', 'Batam', 'Nusa Tenggara Barat', '2012-01-31', 240000, 266500, 'Pending'),
(86, 35, 'Era', 'Afagagag', 'Batam', 'Riau', '2012-03-14', 180000, 196000, 'Cancelled'),
(87, 34, 'Heri Sun', 'Ihjk', 'Batam', 'Banten', '2012-03-14', 18000, 42000, 'Pending'),
(88, 34, 'Gwtfrqrg', 'Gqaq', 'Batam', 'Lampung', '2012-03-14', 18000, 39000, 'Pending'),
(100, 34, 'Hans Jericho', 'Balai Karimun', 'Karimun', 'Gorontalo', '2012-03-19', 2160000, 2215000, 'Pending'),
(101, 36, 'Andi', 'Jyjgksdjyfakjfj', 'Balai', 'Kepualauan Riau', '2012-03-29', 1000000, 1010000, 'Pending'),
(94, 34, 'Affa', 'Zxdczxc', 'Batam', 'Maluku Utara', '2012-03-14', 18000, 60000, 'Pending'),
(95, 34, 'Heri Sun', 'Xcvxcvx', 'Batam', 'DKI Jakarta', '2012-03-14', 18000, 34000, 'Delivered'),
(96, 34, 'Hans', 'Adadaa', 'Batam', 'Maluku', '2012-03-15', 216000, 256000, 'Cancelled'),
(97, 34, 'Avv', 'Aafa', 'Batam', 'Jawa Timur', '2012-03-15', 90000, 114000, 'Pending'),
(98, 34, 'Hans', 'Jodoh', 'Batam', 'Kalimantan Barat', '2012-03-18', 36000, 65500, 'Pending');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=168 ;

--
-- Dumping data for table `t_product`
--

INSERT INTO `t_product` (`ProdID`, `ProdType`, `ProdBrand`, `ProdName`, `ProdImage`, `Description`, `Price`, `Details`, `Stock`, `satuan`) VALUES
(160, 'NB', 'TravelMate', 'Acer Travel Mate', 'TravelMate.jpg', 'Plastic Jerri-can 3.8L with Pump', 4000000, 'Acer Travel Mate', 20, ''),
(161, 'NB', 'Accer', 'Accer V3', 'AspireV3.jpg', 'Tuliskan Deskripsi Spek disini', 50000, 'Spek', 14, ''),
(162, 'NB', 'HP-CQ43-304AU', 'Compaq', 'HP-CQ43-304AU.jpg', 'HP Compaq', 5400000, 'Spesifikasi', 6, ''),
(163, 'NB', 'Dell', 'Dell Precision M4700', 'dell_precision.jpg', 'Dell', 5000000, 'Isikan Rincian', 7, ''),
(164, 'PC', 'Samsung', 'ATIV Smart PC', 'sgpc.jpg', 'Smart PC', 3500000, 'ISikan Spec', 10, ''),
(165, 'TB', 'Toshiba', 'Excite 7.7 Tablet', 'excite-7-7-tablet-600-01.jpg', 'Tablet', 4300000, 'Isikan Spek', 7, ''),
(166, 'NB', 'Toshiba', 'Sattelite U-925', 'satellite.jpg', 'Toshiba', 5200000, 'Isikan Spek', 9, ''),
(167, 'NB', 'Asus', 'Asus N56VZ', 'asus.jpg', 'Asus', 4500000, 'Isikan Spek', 12, '');

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
('Morico', '123456', 34, 'Cust'),
('Admin', '123456', 20, 'Admin'),
('Chris', '123456', 36, 'Cust'),
('Herisun', '654321', 38, 'Cust');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
