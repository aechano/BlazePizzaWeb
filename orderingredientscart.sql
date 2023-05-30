-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 30, 2023 at 11:06 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blazepizza`
--

-- --------------------------------------------------------

--
-- Table structure for table `orderingredientscart`
--

CREATE TABLE `orderingredientscart` (
  `OICID` int(6) NOT NULL,
  `OICartID` int(6) NOT NULL,
  `OICDough` varchar(25) DEFAULT NULL,
  `OICSauce` varchar(25) DEFAULT NULL,
  `OICCheese` varchar(25) DEFAULT NULL,
  `OICMeat` varchar(25) DEFAULT NULL,
  `OICVeggies` varchar(25) DEFAULT NULL,
  `OICFinishes` varchar(25) DEFAULT NULL,
  `customerID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orderingredientscart`
--

INSERT INTO `orderingredientscart` (`OICID`, `OICartID`, `OICDough`, `OICSauce`, `OICCheese`, `OICMeat`, `OICVeggies`, `OICFinishes`, `customerID`) VALUES
(62, 238, '', '', '', 'Pepperoni', '', '', 13);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orderingredientscart`
--
ALTER TABLE `orderingredientscart`
  ADD PRIMARY KEY (`OICID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orderingredientscart`
--
ALTER TABLE `orderingredientscart`
  MODIFY `OICID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
