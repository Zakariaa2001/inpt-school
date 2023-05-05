-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 10, 2022 at 03:07 AM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `school`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `idAdmin` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`idAdmin`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`idAdmin`, `email`, `password`, `name`) VALUES
(2, 'yassine@gmail.com', 'admin123', 'yassine');

-- --------------------------------------------------------

--
-- Table structure for table `filieres`
--

DROP TABLE IF EXISTS `filieres`;
CREATE TABLE IF NOT EXISTS `filieres` (
  `nameFiliere` varchar(100) NOT NULL,
  `idFiliere` int(11) NOT NULL,
  PRIMARY KEY (`nameFiliere`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `filieres`
--

INSERT INTO `filieres` (`nameFiliere`, `idFiliere`) VALUES
('iccn', 1),
('smart', 2),
('sud', 3);

-- --------------------------------------------------------

--
-- Table structure for table `inforoom`
--

DROP TABLE IF EXISTS `inforoom`;
CREATE TABLE IF NOT EXISTS `inforoom` (
  `id` smallint(11) NOT NULL AUTO_INCREMENT,
  `idTeacher` int(11) NOT NULL,
  `nameFiliere` varchar(100) NOT NULL,
  `nameSalle` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  `start` varchar(100) NOT NULL,
  `end` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `nameFiliere` (`nameFiliere`),
  KEY `nameTeacher` (`idTeacher`),
  KEY `inforoom_ibfk_3` (`nameSalle`)
) ENGINE=InnoDB AUTO_INCREMENT=350 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inforoom`
--

INSERT INTO `inforoom` (`id`, `idTeacher`, `nameFiliere`, `nameSalle`, `date`, `start`, `end`) VALUES
(349, 2, 'iccn', 'TP3', '2022-04-23', '08:00', '08:00');

-- --------------------------------------------------------

--
-- Table structure for table `matiere`
--

DROP TABLE IF EXISTS `matiere`;
CREATE TABLE IF NOT EXISTS `matiere` (
  `idMatiere` int(11) NOT NULL AUTO_INCREMENT,
  `nameMatiere` varchar(50) NOT NULL,
  PRIMARY KEY (`idMatiere`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `matiere`
--

INSERT INTO `matiere` (`idMatiere`, `nameMatiere`) VALUES
(1, 'uml'),
(2, 'web security '),
(3, 'merise');

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

DROP TABLE IF EXISTS `reservation`;
CREATE TABLE IF NOT EXISTS `reservation` (
  `idReservation` int(11) NOT NULL AUTO_INCREMENT,
  `numRoom` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  `start` varchar(100) NOT NULL,
  `end` varchar(100) NOT NULL,
  `idInfoRoom` smallint(11) NOT NULL,
  PRIMARY KEY (`idReservation`),
  KEY `idInfoRoom` (`idInfoRoom`)
) ENGINE=InnoDB AUTO_INCREMENT=214 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`idReservation`, `numRoom`, `date`, `start`, `end`, `idInfoRoom`) VALUES
(213, '', '2022-04-23', '08:00', '08:00', 349);

-- --------------------------------------------------------

--
-- Table structure for table `salles`
--

DROP TABLE IF EXISTS `salles`;
CREATE TABLE IF NOT EXISTS `salles` (
  `salle` varchar(100) NOT NULL,
  PRIMARY KEY (`salle`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `salles`
--

INSERT INTO `salles` (`salle`) VALUES
('B1'),
('B2'),
('B3'),
('B4'),
('B5'),
('B6'),
('S1'),
('S2'),
('S3'),
('S4'),
('TP1'),
('TP2'),
('TP3'),
('TP4'),
('TP5'),
('TP6');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

DROP TABLE IF EXISTS `students`;
CREATE TABLE IF NOT EXISTS `students` (
  `idStudent` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `nameFiliere` varchar(100) NOT NULL,
  PRIMARY KEY (`idStudent`),
  KEY `nameFiliere` (`nameFiliere`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`idStudent`, `email`, `password`, `name`, `nameFiliere`) VALUES
(10, 'soufaine@gmail.com', 'student123', 'soufaine', 'iccn'),
(11, 'younes@gmail.com', 'student123', 'younes', 'smart'),
(12, 'abdellah@gmail.com', 'student123', 'abdellah', 'sud'),
(13, 'malak@gmail.com', 'student123', 'malak', 'iccn'),
(14, 'aya@gmail.com', 'student123', 'aya', 'iccn'),
(15, 'ali@gmail.com', 'student123', 'ali', 'smart'),
(16, 'manal@gmail.com', 'student123', 'manal', 'smart'),
(17, 'saad@gmail.com', 'student123', 'saad', 'sud'),
(18, 'oussama@gmail.com', 'student123', 'oussama', 'sud');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

DROP TABLE IF EXISTS `teachers`;
CREATE TABLE IF NOT EXISTS `teachers` (
  `idTeacher` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `idMatiere` int(11) NOT NULL,
  PRIMARY KEY (`idTeacher`),
  KEY `idMatiere` (`idMatiere`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`idTeacher`, `email`, `password`, `name`, `idMatiere`) VALUES
(1, 'zakaria@gmail.com', 'teacher123', 'zakaria', 1),
(2, 'hamza@gmail.com', 'teacher123', 'hamza', 2),
(3, 'mohamed@gmail.com', 'teacher123', 'mohamed', 3),
(4, 'hamzazakaria5555@gmail.com', 'teacher123', 'zakaria', 1),
(5, 'hamzazakaria55@gmail.com', 'teacher123', 'hamza', 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `inforoom`
--
ALTER TABLE `inforoom`
  ADD CONSTRAINT `inforoom_ibfk_2` FOREIGN KEY (`idTeacher`) REFERENCES `teachers` (`idTeacher`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `inforoom_ibfk_3` FOREIGN KEY (`nameSalle`) REFERENCES `salles` (`salle`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `inforoom_ibfk_4` FOREIGN KEY (`nameFiliere`) REFERENCES `filieres` (`nameFiliere`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`idInfoRoom`) REFERENCES `inforoom` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`nameFiliere`) REFERENCES `filieres` (`nameFiliere`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `teachers`
--
ALTER TABLE `teachers`
  ADD CONSTRAINT `teachers_ibfk_1` FOREIGN KEY (`idMatiere`) REFERENCES `matiere` (`idMatiere`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
