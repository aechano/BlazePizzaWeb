-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 30, 2023 at 11:07 AM
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
-- Table structure for table `orderingredients`
--

CREATE TABLE `orderingredients` (
  `orderIngredientsID` int(6) NOT NULL,
  `itemID` int(6) NOT NULL,
  `orderIngredientsDough` varchar(25) DEFAULT NULL,
  `orderIngredientsSauce` varchar(25) DEFAULT NULL,
  `orderIngredientsCheese` varchar(25) DEFAULT NULL,
  `orderIngredientsMeat` varchar(25) DEFAULT NULL,
  `orderIngredientsVeggies` varchar(25) DEFAULT NULL,
  `orderIngredientsFinishes` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orderingredients`
--

INSERT INTO `orderingredients` (`orderIngredientsID`, `itemID`, `orderIngredientsDough`, `orderIngredientsSauce`, `orderIngredientsCheese`, `orderIngredientsMeat`, `orderIngredientsVeggies`, `orderIngredientsFinishes`) VALUES
(10, 74, 'Keto-Crust Dough', 'Garlic Pesto Sauce', 'Shredded Mozarella', 'Pepperoni', 'Fresh Basil', 'Balsamic Glaze');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orderingredients`
--
ALTER TABLE `orderingredients`
  ADD PRIMARY KEY (`orderIngredientsID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orderingredients`
--
ALTER TABLE `orderingredients`
  MODIFY `orderIngredientsID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
