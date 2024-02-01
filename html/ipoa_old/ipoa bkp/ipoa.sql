-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 04, 2013 at 08:32 AM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ipoa`
--

-- --------------------------------------------------------

--
-- Table structure for table `sm_main_user`
--

CREATE TABLE IF NOT EXISTS `sm_main_user` (
  `userid` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `username` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `password` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `names` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `level` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `scope` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `Faculty` text COLLATE latin1_general_ci NOT NULL,
  `Status` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `MacAddress` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `MacOptions` varchar(50) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `sm_main_user`
--

INSERT INTO `sm_main_user` (`userid`, `username`, `password`, `names`, `level`, `scope`, `Faculty`, `Status`, `MacAddress`, `MacOptions`) VALUES
('USR-001', 'root', 'saFKJij3eLACw', 'Samuel Muturi Njuguna', '99', 'Global', 'All', '99', '', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
