-- phpMyAdmin SQL Dump
-- version 3.3.10.4
-- http://www.phpmyadmin.net
--
-- Host: mysql.goosegotloose.com
-- Generation Time: Sep 28, 2015 at 05:09 PM
-- Server version: 5.1.56
-- PHP Version: 5.6.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dcfeud`
--

-- --------------------------------------------------------

--
-- Table structure for table `active`
--

CREATE TABLE IF NOT EXISTS `active` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `questionid` int(6) NOT NULL,
  `1` tinyint(1) NOT NULL,
  `2` tinyint(1) NOT NULL,
  `3` tinyint(1) NOT NULL,
  `4` tinyint(1) NOT NULL,
  `5` tinyint(1) NOT NULL,
  `6` tinyint(1) NOT NULL,
  `7` tinyint(1) NOT NULL,
  `8` tinyint(1) NOT NULL,
  `X` varchar(34) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `poolquestions`
--

CREATE TABLE IF NOT EXISTS `poolquestions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` varchar(100) NOT NULL,
  `answers` mediumtext NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `question` (`question`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `publicquestions`
--

CREATE TABLE IF NOT EXISTS `publicquestions` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `question` varchar(120) NOT NULL,
  `1` varchar(80) NOT NULL,
  `2` varchar(80) NOT NULL,
  `3` varchar(80) NOT NULL,
  `4` varchar(80) NOT NULL,
  `5` varchar(80) NOT NULL,
  `6` varchar(80) NOT NULL,
  `7` varchar(80) NOT NULL,
  `8` varchar(80) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `question` varchar(120) NOT NULL,
  `1` varchar(80) NOT NULL,
  `2` varchar(80) NOT NULL,
  `3` varchar(80) NOT NULL,
  `4` varchar(80) NOT NULL,
  `5` varchar(80) NOT NULL,
  `6` varchar(80) NOT NULL,
  `7` varchar(80) NOT NULL,
  `8` varchar(80) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
