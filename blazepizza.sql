-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 31, 2023 at 03:13 AM
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
-- Database: `blazepizza`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `password`) VALUES
(2, 'myAdmin', '40bd001563085fc35165329ea1ff5c5ecbdbbeef');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customerID` int(6) NOT NULL,
  `custLname` varchar(25) NOT NULL,
  `custFname` varchar(25) NOT NULL,
  `custBdate` date NOT NULL,
  `custGender` varchar(1) NOT NULL,
  `custEmail` varchar(25) NOT NULL,
  `custContactNum` varchar(11) NOT NULL,
  `custAddress` text NOT NULL,
  `custPassword` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customerID`, `custLname`, `custFname`, `custBdate`, `custGender`, `custEmail`, `custContactNum`, `custAddress`, `custPassword`) VALUES
(1, 'Velacruz', 'Xenia Angelica', '2002-06-04', 'F', 'xeniavelacruz1@gmail.com', '58741255221', '100 Ramage Close, Red Deer, Alberta, Canada', ''),
(2, 'Echano', 'Angelo', '2002-09-04', 'M', 'angeloechano@gmail.com', '58763985156', '11 Highway, Red Deer, Alberta, Canada', ''),
(3, 'Mortiga', 'Renze', '2003-01-12', 'M', 'renzemortiga@gmail.com', '40326984412', '200 Ramage Close, Red Deer, Alberta, Canada', ''),
(4, 'Yaneza', 'Kai', '1999-12-12', 'M', 'kaiyaneza@gmail.com', '78045955221', '2a Highway, Red Deer, Alberta, Canada', ''),
(5, 'Postre', 'Wendee', '1989-11-11', 'F', 'wendeepostre@gmail.com', '82549538715', '38A Ave SE, Alberta, Canada', ''),
(13, 'Shin', 'Young ', '2023-04-13', 'M', 'shin@gmail.com', '09107279854', '1355 Market St, Suite 900, San Francisco, CA', '40bd001563085fc35165329ea1ff5c5ecbdbbeef'),
(14, 'Salazar', 'Jane', '2023-04-14', 'F', 'jane@gmail.com', '09107279854', 'Seoul, Korea', '7288edd0fc3ffcbe93a0cf06e3568e28521687bc'),
(15, 'Cruz', 'Xenia', '2023-04-12', 'F', 'xenia123@gmail.com', '09107279854', 'Seoul, Korea', '8cb2237d0679ca88db6464eac60da96345513964');

-- --------------------------------------------------------

--
-- Table structure for table `ewallet`
--

CREATE TABLE `ewallet` (
  `eWalletID` int(6) NOT NULL,
  `customerID` int(6) NOT NULL,
  `eWalletPass` varchar(25) NOT NULL,
  `balance` float(10,0) NOT NULL,
  `currency` varchar(20) NOT NULL,
  `eWalletStatus` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ewallet`
--

INSERT INTO `ewallet` (`eWalletID`, `customerID`, `eWalletPass`, `balance`, `currency`, `eWalletStatus`) VALUES
(226541, 13, '12345678', 96816, 'Php', 'Activated'),
(659841, 2, 'hatdogcheesedog', 200, 'Php', 'Activated'),
(741229, 3, 'abcdoremi', 405, 'Php', 'Activated'),
(941023, 4, 'blackpink', 10000, 'Php', 'Deactivated'),
(963258, 5, 'abcdefg', 1235, 'Php', 'Activated');

-- --------------------------------------------------------

--
-- Table structure for table `ingredients`
--

CREATE TABLE `ingredients` (
  `ingredientsID` int(6) NOT NULL,
  `ingredientsCategory` char(25) NOT NULL,
  `ingredientsName` varchar(25) NOT NULL,
  `ingredientsQty` int(5) NOT NULL,
  `ingImage` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ingredients`
--

INSERT INTO `ingredients` (`ingredientsID`, `ingredientsCategory`, `ingredientsName`, `ingredientsQty`, `ingImage`) VALUES
(9, 'Dough', 'Classic Dough', 159, 'Classic_Dough.png'),
(10, 'Cheese', 'regular cheese', 23, 'Fresh_Mozzarella.png');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `orderID` varchar(255) NOT NULL,
  `customerID` int(6) NOT NULL,
  `promoCode` varchar(6) NOT NULL,
  `orderAmount` double(6,0) NOT NULL,
  `orderStatus` varchar(25) NOT NULL,
  `paymentType` varchar(25) NOT NULL,
  `orderDate` date NOT NULL,
  `paymentStatus` varchar(255) NOT NULL,
  `notes` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`orderID`, `customerID`, `promoCode`, `orderAmount`, `orderStatus`, `paymentType`, `orderDate`, `paymentStatus`, `notes`) VALUES
('1685490088', 13, '', 59, 'ONGOING', 'COD', '2023-05-31', 'PENDING', ''),
('1685490131', 13, '', 301, 'ONGOING', 'COD', '2023-05-31', 'PENDING', ''),
('1685491521', 13, '', 59, 'ONGOING', 'COD', '2023-05-31', 'PENDING', ''),
('1685491693', 13, '', 59, 'COMPLETED', 'Blaze Pizza e-Wallet', '2023-05-31', 'PAID', ''),
('1685492105', 13, '', 59, 'ONGOING', 'Blaze Pizza e-Wallet', '2023-05-31', 'PAID', '');

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
(30, 208, 'Classic Dough', '', 'regular cheese', '', '', '', 13);

-- --------------------------------------------------------

--
-- Table structure for table `orderitem`
--

CREATE TABLE `orderitem` (
  `itemID` int(6) NOT NULL,
  `productID` int(6) NOT NULL,
  `orderID` int(6) NOT NULL,
  `orderItemQty` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orderitem`
--

INSERT INTO `orderitem` (`itemID`, `productID`, `orderID`, `orderItemQty`) VALUES
(78, 26, 1685490088, 1),
(79, 27, 1685490131, 1),
(80, 26, 1685490131, 1),
(81, 26, 1685491521, 1),
(82, 26, 1685491693, 1),
(83, 26, 1685492105, 1);

-- --------------------------------------------------------

--
-- Table structure for table `orderitemcart`
--

CREATE TABLE `orderitemcart` (
  `OICartID` int(6) NOT NULL,
  `productID` int(6) NOT NULL,
  `customerID` int(6) NOT NULL,
  `OICartQty` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orderitemcart`
--

INSERT INTO `orderitemcart` (`OICartID`, `productID`, `customerID`, `OICartQty`) VALUES
(209, 27, 13, 1),
(210, 31, 13, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `productID` int(6) NOT NULL,
  `productName` varchar(30) NOT NULL,
  `productType` varchar(30) NOT NULL,
  `productQty` int(5) NOT NULL,
  `productPrice` float(6,0) NOT NULL,
  `productDesc` text NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productID`, `productName`, `productType`, `productQty`, `productPrice`, `productDesc`, `image`) VALUES
(26, 'Meat Eater', '11-Inch Pizza', 30, 56, 'This pizza is a wonderful pizza, because this pizza is mine', 'Meat_Eater.png'),
(27, 'Wine', 'Drinks, Beers, and Wine', 466, 231, 'You can get another salad with this pizza', 'San_Pellegrino.png'),
(28, 'Vegetarian Pizza', '11-Inch Pizza', 13, 788, 'This pizza is a wonderful pizza, because this pizza is mine', 'Hot_Link.png'),
(29, 'Smore Pie', 'Desserts', 56, 211, 'This is my bread and butter', 'Smore_Pie.png'),
(30, 'brownies', 'Desserts', 123, 2323, '455', 'Chocolate_Brownie_Brushed_with_Olive_Oil.png'),
(31, 'Bread', 'Cheesy Breads and Salads', 12344, 6789, 'This is my bread and butter', 'Entree_Salad.png'),
(32, 'Build Your Own', '11-Inch Pizza', 1234, 32, 'You can get another salad with this pizza', 'Build_Your_Own.png'),
(33, 'Green Stripe Pizza', '11-Inch Pizza', 678, 6576, 'You can get another salad with this pizza', 'Green_Stripe.png');

-- --------------------------------------------------------

--
-- Table structure for table `promos`
--

CREATE TABLE `promos` (
  `promoCode` varchar(6) NOT NULL,
  `promoName` varchar(25) DEFAULT NULL,
  `promoType` varchar(25) NOT NULL,
  `minPrice` float(6,0) NOT NULL,
  `rewards` varchar(25) NOT NULL,
  `availability` int(15) NOT NULL,
  `promoImage` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `promos`
--

INSERT INTO `promos` (`promoCode`, `promoName`, `promoType`, `minPrice`, `rewards`, `availability`, `promoImage`, `description`) VALUES
('REDDEE', 'Blaze Jubilee', 'Promo', 350, '50', 11, 'Stamps_Promo.png', 'We&#39;re the best place to grab a fast-fire&#39;d pizza made with real ingredients that are free of artificial colors, flavors, preservatives, and sweeteners. We&#39;ve also got freshly made salads, house-made lemonades, and decadent, oven-fired desserts');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customerID`);

--
-- Indexes for table `ewallet`
--
ALTER TABLE `ewallet`
  ADD PRIMARY KEY (`eWalletID`);

--
-- Indexes for table `ingredients`
--
ALTER TABLE `ingredients`
  ADD PRIMARY KEY (`ingredientsID`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`orderID`);

--
-- Indexes for table `orderingredients`
--
ALTER TABLE `orderingredients`
  ADD PRIMARY KEY (`orderIngredientsID`);

--
-- Indexes for table `orderingredientscart`
--
ALTER TABLE `orderingredientscart`
  ADD PRIMARY KEY (`OICID`);

--
-- Indexes for table `orderitem`
--
ALTER TABLE `orderitem`
  ADD PRIMARY KEY (`itemID`);

--
-- Indexes for table `orderitemcart`
--
ALTER TABLE `orderitemcart`
  ADD PRIMARY KEY (`OICartID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productID`);

--
-- Indexes for table `promos`
--
ALTER TABLE `promos`
  ADD PRIMARY KEY (`promoCode`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customerID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `ingredients`
--
ALTER TABLE `ingredients`
  MODIFY `ingredientsID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `orderingredients`
--
ALTER TABLE `orderingredients`
  MODIFY `orderIngredientsID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orderingredientscart`
--
ALTER TABLE `orderingredientscart`
  MODIFY `OICID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `orderitem`
--
ALTER TABLE `orderitem`
  MODIFY `itemID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `orderitemcart`
--
ALTER TABLE `orderitemcart`
  MODIFY `OICartID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=211;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `productID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
