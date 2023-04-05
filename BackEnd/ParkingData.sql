-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 30, 2023 at 08:49 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

DROP DATABASE IF EXISTS ParkingData;
CREATE DATABASE ParkingData;
USE ParkingData;

--
-- Database: `ParkingData`
--

-- --------------------------------------------------------

--
-- Table structure for table `Parking_Lots`
--

DROP TABLE IF EXISTS Parking_Lots;
CREATE TABLE `Parking_Lots` (
  `LotID` int(4) NOT NULL,
  `Size` int(100) DEFAULT NULL,
  `Address` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Parking_Lots`
--

INSERT INTO `Parking_Lots` (`LotID`, `Size`, `Address`) VALUES
(123, 10, '1100 Downtown'),
(980, 20, '123 Sesame Street');

-- --------------------------------------------------------

--
-- Table structure for table `Stalls`
--

DROP TABLE IF EXISTS Stalls;
CREATE TABLE `Stalls` (
  `LotID` int(4) NOT NULL,
  `Number` int(4) NOT NULL,
  `Type` varchar(50) DEFAULT NULL,
  `Reserved` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Stalls`
--

INSERT INTO `Stalls` (`LotID`, `Number`, `Type`, `Reserved`) VALUES 
(123, 1, 'Handicap', 0),
(123, 2, 'Handicap', 0),
(123, 3, 'Standard', 0),
(123, 4, 'Standard', 0),
(123, 5, 'Standard', 0),
(123, 6, 'Standard', 0),
(123, 7, 'Standard', 0),
(123, 8, 'Standard', 0),
(123, 9, 'Standard', 0),
(123, 10, 'Large', 0),
(980, 1, 'Standard', 0),
(980, 2, 'Standard', 0),
(980, 3, 'Standard', 0),
(980, 4, 'Standard', 0),
(980, 5, 'Standard', 0),
(980, 6, 'Standard', 0),
(980, 7, 'Standard', 0),
(980, 8, 'Standard', 0),
(980, 9, 'Standard', 0),
(980, 10, 'Standard', 0),
(980, 11, 'Standard', 0),
(980, 12, 'Standard', 0),
(980, 13, 'Standard', 0),
(980, 14, 'Standard', 0),
(980, 15, 'Small', 0),
(980, 16, 'Small', 0),
(980, 17, 'Small', 0),
(980, 18, 'Large', 0),
(980, 19, 'Large', 0),
(980, 20, 'Giant', 0);



/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
