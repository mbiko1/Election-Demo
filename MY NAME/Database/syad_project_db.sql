-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 28, 2024 at 09:14 PM
-- Server version: 8.3.0
-- PHP Version: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `syad_project_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `candidate_votes`
--

DROP TABLE IF EXISTS `candidate_votes`;
CREATE TABLE IF NOT EXISTS `candidate_votes` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `national_id` varchar(8) NOT NULL,
  `president` varchar(30) DEFAULT NULL,
  `member_of_p` varchar(30) DEFAULT NULL,
  `councillor` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `candidate_votes`
--

INSERT INTO `candidate_votes` (`ID`, `national_id`, `president`, `member_of_p`, `councillor`) VALUES
(1, 'A1B2C3D4', 'President3', 'Mp3', 'Councillor1'),
(2, 'B5C6D7E8', 'President1', 'Mp2', 'Councillor3'),
(3, 'C9D8E7F6', 'President2', 'Mp1', 'Councillor3'),
(4, 'D2E3F4G5', 'President2', 'Mp2', 'Councillor2'),
(5, 'E6F7G8H9', 'President2', 'Mp2', 'Councillor3'),
(6, 'F1G2H3I4', 'President2', 'Mp3', 'Councillor1'),
(7, 'G5H6I7J8', 'President2', 'Mp3', 'Councillor2'),
(8, 'H9I8J7K6', 'President2', 'Mp3', 'Councillor2'),
(9, 'I2J3K4L5', NULL, NULL, NULL),
(10, 'J6K7L8M9', NULL, NULL, NULL),
(11, 'K1L2M3N4', NULL, NULL, NULL),
(12, 'L5M6N7O8', NULL, NULL, NULL),
(13, 'M9N8O7P6', NULL, NULL, NULL),
(14, 'N2O3P4Q5', NULL, NULL, NULL),
(15, 'O6P7Q8R9', NULL, NULL, NULL),
(16, 'P1Q2R3S4', NULL, NULL, NULL),
(17, 'Q5R6S7T8', NULL, NULL, NULL),
(18, 'R9S8T7U6', NULL, NULL, NULL),
(19, 'S2T3U4V5', NULL, NULL, NULL),
(20, 'T6U7V8W9', NULL, NULL, NULL),
(21, 'U1V2W3X4', NULL, NULL, NULL),
(22, 'V5W6X7Y8', NULL, NULL, NULL),
(23, 'W9X8Y7Z6', NULL, NULL, NULL),
(24, 'X2Y3Z4A5', NULL, NULL, NULL),
(25, 'Y6Z7A8B9', NULL, NULL, NULL),
(26, 'Z1A2B3C4', NULL, NULL, NULL),
(27, 'A5B6C7D8', NULL, NULL, NULL),
(28, 'B9C8D7E6', NULL, NULL, NULL),
(29, 'C2D3E4F5', NULL, NULL, NULL),
(30, 'D6E7F8G9', NULL, NULL, NULL),
(31, 'E1F2G3H4', NULL, NULL, NULL),
(32, 'F5G6H7I8', NULL, NULL, NULL),
(33, 'G9H8I7J6', NULL, NULL, NULL),
(34, 'H2I3J4K5', NULL, NULL, NULL),
(35, 'I6J7K8L9', NULL, NULL, NULL),
(36, 'J1K2L3M4', NULL, NULL, NULL),
(37, 'K5L6M7N8', NULL, NULL, NULL),
(38, 'L9M8N7O6', NULL, NULL, NULL),
(39, 'M2N3O4P5', NULL, NULL, NULL),
(40, 'N6O7P8Q9', NULL, NULL, NULL),
(41, 'O1P2Q3R4', NULL, NULL, NULL),
(42, 'P5Q6R7S8', NULL, NULL, NULL),
(43, 'Q9R8S7T6', NULL, NULL, NULL),
(44, 'R2S3T4U5', NULL, NULL, NULL),
(45, 'S6T7U8V9', NULL, NULL, NULL),
(46, 'T1U2V3W4', NULL, NULL, NULL),
(47, 'U5V6W7X8', NULL, NULL, NULL),
(48, 'V9W8X7Y6', NULL, NULL, NULL),
(49, 'W2X3Y4Z5', NULL, NULL, NULL),
(50, 'X6Y7Z8A9', NULL, NULL, NULL),
(51, 'Y1Z2A3B4', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `login_credentials`
--

DROP TABLE IF EXISTS `login_credentials`;
CREATE TABLE IF NOT EXISTS `login_credentials` (
  `national_id` varchar(8) NOT NULL,
  `password` varchar(20) NOT NULL,
  PRIMARY KEY (`national_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `login_credentials`
--

INSERT INTO `login_credentials` (`national_id`, `password`) VALUES
('C9D8E7F6', 'thumbiko'),
('B5C6D7E8', 'thumbiko'),
('A1B2C3D4', 'thumbiko'),
('D2E3F4G5', 'thumbiko'),
('E6F7G8H9', 'thumbiko'),
('F1G2H3I4', 'thumbiko'),
('G5H6I7J8', 'thumbiko'),
('H9I8J7K6', 'thumbiko'),
('I2J3K4L5', ''),
('J6K7L8M9', ''),
('K1L2M3N4', ''),
('L5M6N7O8', ''),
('M9N8O7P6', ''),
('N2O3P4Q5', ''),
('O6P7Q8R9', ''),
('P1Q2R3S4', ''),
('Q5R6S7T8', ''),
('R9S8T7U6', ''),
('S2T3U4V5', ''),
('T6U7V8W9', ''),
('U1V2W3X4', ''),
('V5W6X7Y8', ''),
('W9X8Y7Z6', ''),
('X2Y3Z4A5', ''),
('Y6Z7A8B9', ''),
('Z1A2B3C4', ''),
('A5B6C7D8', ''),
('B9C8D7E6', ''),
('C2D3E4F5', ''),
('D6E7F8G9', ''),
('E1F2G3H4', ''),
('F5G6H7I8', ''),
('G9H8I7J6', ''),
('H2I3J4K5', ''),
('I6J7K8L9', ''),
('J1K2L3M4', ''),
('K5L6M7N8', ''),
('L9M8N7O6', ''),
('M2N3O4P5', ''),
('N6O7P8Q9', ''),
('O1P2Q3R4', ''),
('P5Q6R7S8', ''),
('Q9R8S7T6', ''),
('R2S3T4U5', ''),
('S6T7U8V9', ''),
('T1U2V3W4', ''),
('U5V6W7X8', ''),
('V9W8X7Y6', ''),
('W2X3Y4Z5', ''),
('X6Y7Z8A9', ''),
('Y1Z2A3B4', '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
