-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 16, 2022 at 04:00 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `acss`
--

-- --------------------------------------------------------

--
-- Table structure for table `user_acss`
--

CREATE TABLE `user_acss` (
  `ID` int(11) NOT NULL,
  `Firstname` varchar(100) NOT NULL,
  `Lastname` varchar(100) NOT NULL,
  `Student_ID` int(11) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `Year_level` varchar(100) NOT NULL,
  `Block` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_acss`
--

INSERT INTO `user_acss` (`ID`, `Firstname`, `Lastname`, `Student_ID`, `Password`, `Year_level`, `Block`) VALUES
(1, 'Lancel', 'Papasin', 768, '$2y$10$z32vSQex.Zp63RkPInrffeabgFoJVbb1Bq3A5hagXeKcYsZq/yt2q', '3rd year', '3CSA');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user_acss`
--
ALTER TABLE `user_acss`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user_acss`
--
ALTER TABLE `user_acss`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
