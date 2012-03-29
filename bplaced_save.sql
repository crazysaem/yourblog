-- phpMyAdmin SQL Dump
-- version 3.4.3.1
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Erstellungszeit: 29. Mrz 2012 um 12:29
-- Server Version: 5.5.16
-- PHP-Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `yourblog`
--
CREATE DATABASE `yourblog` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `yourblog`;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `Comments`
--

CREATE TABLE IF NOT EXISTS `Comments` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Entry_ID` int(11) unsigned NOT NULL,
  `Comment` text NOT NULL,
  `User_ID` int(11) NOT NULL,
  `Date` date NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Daten für Tabelle `Comments`
--

INSERT INTO `Comments` (`ID`, `Entry_ID`, `Comment`, `User_ID`, `Date`) VALUES
(1, 1, 'what an awesome weblog :)', 7, '2012-03-27'),
(2, 1, 'Thanks a lot :)', 4, '2012-03-27'),
(3, 1, 'best blog eva', 3, '2012-03-28');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `Entries`
--

CREATE TABLE IF NOT EXISTS `Entries` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Title` varchar(50) NOT NULL,
  `Text` text NOT NULL,
  `User_ID` int(10) unsigned NOT NULL COMMENT 'Foreign Key To User Table Id',
  `Date` date NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Daten für Tabelle `Entries`
--

INSERT INTO `Entries` (`ID`, `Title`, `Text`, `User_ID`, `Date`) VALUES
(2, 'Lorem Ipsum', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur facilisis laoreet dolor in porttitor. Donec tincidunt semper dui, sed bibendum nisi volutpat vulputate. Pellentesque sit amet mauris nunc. Mauris mauris dolor, interdum a euismod et, condimentum venenatis turpis. Etiam fringilla dapibus gravida. Praesent dictum accumsan porta. Sed gravida viverra iaculis. Nullam quis gravida tellus. Duis iaculis libero vel lacus suscipit fermentum. Proin quis turpis dui. Nam eu felis vel erat posuere elementum sit amet ut justo. Nulla lorem lorem, posuere eget dignissim sit amet, laoreet quis arcu. Nunc mattis metus in sem lobortis sed auctor mi varius. In hac habitasse platea dictumst.', 13, '2011-12-14'),
(3, 'Title', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur facilisis laoreet dolor in porttitor. Donec tincidunt semper dui, sed bibendum nisi volutpat vulputate. Pellentesque sit amet mauris nunc. Mauris mauris dolor, interdum a euismod et, condimentum venenatis turpis. Etiam fringilla dapibus gravida. Praesent dictum accumsan porta. Sed gravida viverra iaculis. Nullam quis gravida tellus. Duis iaculis libero vel lacus suscipit fermentum. Proin quis turpis dui. Nam eu felis vel erat posuere elementum sit amet ut justo. Nulla lorem lorem, posuere eget dignissim sit amet, laoreet quis arcu. Nunc mattis metus in sem lobortis sed auctor mi varius. In hac habitasse platea dictumst.', 13, '2012-01-05'),
(4, 'Test', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur facilisis laoreet dolor in porttitor. Donec tincidunt semper dui, sed bibendum nisi volutpat vulputate. Pellentesque sit amet mauris nunc. Mauris mauris dolor, interdum a euismod et, condimentum venenatis turpis. Etiam fringilla dapibus gravida. Praesent dictum accumsan porta. Sed gravida viverra iaculis. Nullam quis gravida tellus. Duis iaculis libero vel lacus suscipit fermentum. Proin quis turpis dui. Nam eu felis vel erat posuere elementum sit amet ut justo. Nulla lorem lorem, posuere eget dignissim sit amet, laoreet quis arcu. Nunc mattis metus in sem lobortis sed auctor mi varius. In hac habitasse platea dictumst.', 13, '2012-01-07'),
(5, 'Y', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur facilisis laoreet dolor in porttitor. Donec tincidunt semper dui, sed bibendum nisi volutpat vulputate. Pellentesque sit amet mauris nunc. Mauris mauris dolor, interdum a euismod et, condimentum venenatis turpis. Etiam fringilla dapibus gravida. Praesent dictum accumsan porta. Sed gravida viverra iaculis. Nullam quis gravida tellus. Duis iaculis libero vel lacus suscipit fermentum. Proin quis turpis dui. Nam eu felis vel erat posuere elementum sit amet ut justo. Nulla lorem lorem, posuere eget dignissim sit amet, laoreet quis arcu. Nunc mattis metus in sem lobortis sed auctor mi varius. In hac habitasse platea dictumst.', 13, '2012-01-12'),
(6, 'H', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur facilisis laoreet dolor in porttitor. Donec tincidunt semper dui, sed bibendum nisi volutpat vulputate. Pellentesque sit amet mauris nunc. Mauris mauris dolor, interdum a euismod et, condimentum venenatis turpis. Etiam fringilla dapibus gravida. Praesent dictum accumsan porta. Sed gravida viverra iaculis. Nullam quis gravida tellus. Duis iaculis libero vel lacus suscipit fermentum. Proin quis turpis dui. Nam eu felis vel erat posuere elementum sit amet ut justo. Nulla lorem lorem, posuere eget dignissim sit amet, laoreet quis arcu. Nunc mattis metus in sem lobortis sed auctor mi varius. In hac habitasse platea dictumst.', 13, '2012-02-09'),
(7, 'H', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur facilisis laoreet dolor in porttitor. Donec tincidunt semper dui, sed bibendum nisi volutpat vulputate. Pellentesque sit amet mauris nunc. Mauris mauris dolor, interdum a euismod et, condimentum venenatis turpis. Etiam fringilla dapibus gravida. Praesent dictum accumsan porta. Sed gravida viverra iaculis. Nullam quis gravida tellus. Duis iaculis libero vel lacus suscipit fermentum. Proin quis turpis dui. Nam eu felis vel erat posuere elementum sit amet ut justo. Nulla lorem lorem, posuere eget dignissim sit amet, laoreet quis arcu. Nunc mattis metus in sem lobortis sed auctor mi varius. In hac habitasse platea dictumst.', 13, '2012-02-11'),
(8, 'Test', 'TesTEXT', 13, '2012-02-18'),
(9, 'Hello Software Engineering', 'testtestasfsegwerg', 3, '2012-02-28'),
(10, 'H', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur facilisis laoreet dolor in porttitor. Donec tincidunt semper dui, sed bibendum nisi volutpat vulputate. Pellentesque sit amet mauris nunc. Mauris mauris dolor, interdum a euismod et, condimentum venenatis turpis. Etiam fringilla dapibus gravida. Praesent dictum accumsan porta. Sed gravida viverra iaculis. Nullam quis gravida tellus. Duis iaculis libero vel lacus suscipit fermentum. Proin quis turpis dui. Nam eu felis vel erat posuere elementum sit amet ut justo. Nulla lorem lorem, posuere eget dignissim sit amet, laoreet quis arcu. Nunc mattis metus in sem lobortis sed auctor mi varius. In hac habitasse platea dictumst.', 13, '2012-03-27'),
(11, 'Hello Software Engineering', 'testtestasfsegwerg', 3, '2012-03-28'),
(12, 'Hello and Welcome', 'On this site we try to create an imversive experience of freedom in blogging...\n\nStill work in progress!\n\nPlease be patient.', 4, '2012-03-28');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `User_Levels`
--

CREATE TABLE IF NOT EXISTS `User_Levels` (
  `ID` int(10) unsigned NOT NULL DEFAULT '0',
  `Name` varchar(20) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `User_Levels`
--

INSERT INTO `User_Levels` (`ID`, `Name`) VALUES
(0, 'Administrator'),
(1, 'Author'),
(2, 'User');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `Users`
--

CREATE TABLE IF NOT EXISTS `Users` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `User_Level_ID` int(10) NOT NULL COMMENT 'Level ID',
  `Name` varchar(50) NOT NULL,
  `Password` text NOT NULL COMMENT 'MD5 verschlüsselt',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Daten für Tabelle `Users`
--

INSERT INTO `Users` (`ID`, `User_Level_ID`, `Name`, `Password`) VALUES
(3, 0, 'Sam', '61e6b2b788f745f68aff879708c64562'),
(4, 0, 'Tob', '61e6b2b788f745f68aff879708c64562'),
(7, 2, 'niklas', '237d7e810d59db228206162f5617df1a'),
(13, 1, 'Author_Bot', '61e6b2b788f745f68aff879708c64562'),
(14, 2, 'User', '61e6b2b788f745f68aff879708c64562');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user_save`
--

CREATE TABLE IF NOT EXISTS `user_save` (
  `User_ID` int(11) NOT NULL,
  `Password` text NOT NULL,
  PRIMARY KEY (`User_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
