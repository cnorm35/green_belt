-- phpMyAdmin SQL Dump
-- version 3.3.9.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 18, 2014 at 04:28 PM
-- Server version: 5.5.9
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `greenbelt_exam`
--

-- --------------------------------------------------------

--
-- Table structure for table `Incidents`
--

CREATE TABLE `Incidents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `Users_id` int(11) NOT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Incidents_Users_idx` (`Users_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `Incidents`
--

INSERT INTO `Incidents` VALUES(20, 'some one cooked bacon', '2014-07-18 15:56:18', '2014-07-18 15:56:18', 4, '2014-07-16 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` VALUES(1, 'codes', 'norman', 'mail@mail.com', 'password', '2014-07-18 13:09:49', '2014-07-18 13:09:49');
INSERT INTO `Users` VALUES(2, 'codes', 'norman', 'mail@mail.com', 'password', '2014-07-18 13:10:25', '2014-07-18 13:10:25');
INSERT INTO `Users` VALUES(3, 'Chuck', 'Norris', 'chuck@norris.com', 'password', '2014-07-18 13:10:44', '2014-07-18 13:10:44');
INSERT INTO `Users` VALUES(4, 'bruce', 'campbell', 'army@darkness.net', 'password', '2014-07-18 13:26:41', '2014-07-18 13:26:41');
INSERT INTO `Users` VALUES(5, 'codes', 'norman', 'mail@mail.com', 'password', '2014-07-18 15:23:27', '2014-07-18 15:23:27');

-- --------------------------------------------------------

--
-- Table structure for table `Users_has_Incidents`
--

CREATE TABLE `Users_has_Incidents` (
  `Users_id` int(11) NOT NULL,
  `Incidents_id` int(11) NOT NULL,
  PRIMARY KEY (`Users_id`,`Incidents_id`),
  KEY `fk_Users_has_Incidents_Incidents1_idx` (`Incidents_id`),
  KEY `fk_Users_has_Incidents_Users1_idx` (`Users_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Users_has_Incidents`
--


--
-- Constraints for dumped tables
--

--
-- Constraints for table `Users_has_Incidents`
--
ALTER TABLE `Users_has_Incidents`
  ADD CONSTRAINT `fk_Users_has_Incidents_Users1` FOREIGN KEY (`Users_id`) REFERENCES `Users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Users_has_Incidents_Incidents1` FOREIGN KEY (`Incidents_id`) REFERENCES `date` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
