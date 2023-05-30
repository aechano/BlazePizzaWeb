-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 29, 2023 at 03:28 PM
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
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `accountID` int(4) NOT NULL,
  `email` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL,
  `eWalletID` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`accountID`, `email`, `password`, `eWalletID`) VALUES
(1, 'xeniavelacruz1@gmail.com', 'hatdogcheesedog', 659841),
(2, 'angeloechano@gmail.com', '12345678', 226541),
(3, 'renzemortiga@gmail.com', 'abcdoremi', 741229),
(4, 'kaiyaneza@gmail.com', 'blackpink', 941023),
(5, 'wendeepostre@gmail.com', 'abcdefg', 963258);

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(226541, 1, '12345678', 97773, 'Php', 'Activated'),
(659841, 2, 'hatdogcheesedog', 200, 'Php', 'Activated'),
(741229, 3, 'abcdoremi', 405, 'Php', 'Activated'),
(941023, 4, 'blackpink', 0, 'Php', 'Deactivated'),
(963258, 5, 'abcdefg', 1235, 'Php', 'Activated');

-- --------------------------------------------------------

--
-- Table structure for table `ewallettransaction`
--

CREATE TABLE `ewallettransaction` (
  `transactionID` int(6) NOT NULL,
  `transactionAmount` float(6,0) NOT NULL,
  `transactionType` varchar(20) NOT NULL,
  `transactionDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ewallettransaction`
--

INSERT INTO `ewallettransaction` (`transactionID`, `transactionAmount`, `transactionType`, `transactionDate`) VALUES
(1, 200, 'Deposit', '2023-04-19'),
(2, 500, 'Payment', '2023-04-29'),
(3, 123, 'Payment', '2023-04-27'),
(4, 560, 'Deposit', '2023-04-30'),
(5, 600, 'Deposit', '2023-04-30');

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
(1, 'Dough', 'Keto-Crust Dough', 90, ''),
(2, 'Sauce', 'Garlic Pesto Sauce', 100, ''),
(3, 'Cheese', 'Shredded Mozarella', 110, ''),
(4, 'Meat', 'Pepperoni', 133, ''),
(5, 'Veggies', 'Fresh Basil', 67, ''),
(6, 'Finishes', 'Balsamic Glaze', 70, ''),
(7, 'Dough', 'Classic Dough', 10, '');

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
  `paymentStatus` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`orderID`, `customerID`, `promoCode`, `orderAmount`, `orderStatus`, `paymentType`, `orderDate`, `paymentStatus`) VALUES
('1685312110', 13, 'B43Ods', 229, 'COMPLETED', 'Blaze Pizza e-Wallet', '2023-05-29', 'PAID'),
('1685312124', 13, '', 45, 'ONGOING', 'COD', '2023-05-29', 'PENDING'),
('1685312495', 13, '', 126, 'ONGOING', 'Blaze Pizza e-Wallet', '2023-05-29', 'PAID'),
('1685314783', 13, '', 126, 'ONGOING', 'COD', '2023-05-29', 'PENDING'),
('1685314935', 13, '', 31, 'ONGOING', 'COD', '2023-05-29', 'PENDING');

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
(1, 1, 'Gluten-Free Dough', 'Red Sauce', 'Feta Cheese', 'Applewood Bacon', 'Artichokes', 'Arugula'),
(2, 2, 'Cauliflower Dough', 'Garlic Pesto Sauce', 'Fresh Mozarella', 'Crumbled Meatballs', 'Banana Peppers', 'Balsamic Glaze'),
(3, 3, 'Classic Dough', 'Red Sauce Dollops', 'Goat Cheese', 'Grilled Chicken', 'Black Olives', 'BBQ Sauce'),
(4, 4, 'High-Rise Dough', 'Spicy Red Sauce', 'Gorgonzola', 'Italian Sausage', 'Cherry Tomatoes', 'Buttermilk Ranch'),
(5, 5, 'Keto-Crust Dough', 'White Cream Sauce', 'Parmesan', 'Smoked Ham', 'Chopped Garlic', 'Buttermilk Ranch on Side');

-- --------------------------------------------------------

--
-- Table structure for table `orderingredientscart`
--

CREATE TABLE `orderingredientscart` (
  `OICID` int(6) NOT NULL,
  `itemID` int(6) NOT NULL,
  `OICDough` varchar(25) DEFAULT NULL,
  `OICSauce` varchar(25) DEFAULT NULL,
  `OICCheese` varchar(25) DEFAULT NULL,
  `OICMeat` varchar(25) DEFAULT NULL,
  `OICVeggies` varchar(25) DEFAULT NULL,
  `OICFinishes` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orderingredientscart`
--

INSERT INTO `orderingredientscart` (`OICID`, `itemID`, `OICDough`, `OICSauce`, `OICCheese`, `OICMeat`, `OICVeggies`, `OICFinishes`) VALUES
(16, 186, 'Keto-Crust Dough', 'Garlic Pesto Sauce', 'Shredded Mozarella', 'Shredded Mozarella', 'Keto-Crust Dough', 'Keto-Crust Dough'),
(17, 187, 'Keto-Crust Dough', 'Garlic Pesto Sauce', 'Shredded Mozarella', 'Shredded Mozarella', 'Keto-Crust Dough', 'Keto-Crust Dough'),
(18, 188, 'Keto-Crust Dough', 'Garlic Pesto Sauce', 'Shredded Mozarella', '', '', ''),
(19, 189, 'Keto-Crust Dough', 'Garlic Pesto Sauce', 'Shredded Mozarella', '', '', ''),
(20, 190, 'Keto-Crust Dough', 'Garlic Pesto Sauce', 'Shredded Mozarella', '', '', ''),
(21, 191, 'Keto-Crust Dough', 'Garlic Pesto Sauce', 'Shredded Mozarella', '', '', ''),
(22, 192, 'Keto-Crust Dough', 'Garlic Pesto Sauce', 'Shredded Mozarella', '', '', ''),
(23, 193, 'Keto-Crust Dough', 'Garlic Pesto Sauce', 'Shredded Mozarella', '', '', ''),
(24, 194, 'Keto-Crust Dough', 'Garlic Pesto Sauce', 'Shredded Mozarella', '', '', ''),
(25, 195, 'Keto-Crust Dough', 'Garlic Pesto Sauce', 'Shredded Mozarella', '', '', '');

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
(51, 1, 1685312110, 4),
(52, 4, 1685312110, 1),
(53, 5, 1685312110, 3),
(54, 1, 1685312124, 1),
(55, 10, 1685312495, 1),
(56, 10, 1685314783, 1),
(57, 6, 1685314935, 1);

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
(186, 10, 13, 1),
(187, 10, 13, 1),
(188, 10, 13, 1),
(189, 10, 13, 1),
(190, 10, 13, 1),
(191, 10, 13, 1),
(192, 10, 13, 1),
(193, 10, 13, 1),
(194, 10, 13, 1),
(195, 10, 13, 1);

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
(1, 'Vegetarian Pizza', '11-Inch Pizza', 50, 43, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', ''),
(2, 'Cheesy Bread', 'Cheesy Breads and Salads', 73, 23, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', ''),
(3, 'Smore Pie', 'Desserts', 66, 10, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', ''),
(4, 'Party of One', 'Digital Deals', 105, 51, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', ''),
(5, 'Coke Bottle', 'Drinks, Beers, and Wine', 105, 8, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', ''),
(6, 'Art Lover', 'Large Pizza', 98, 30, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', ''),
(7, 'Cheesy Bread + Choice of Side', 'Take Two', 50, 54, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', ''),
(8, 'Pesto Garlic Cheesy Bread', 'Cheesy Breads and Salads', 74, 27, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', ''),
(9, 'Green Stripe', '11-Inch Pizza', 10, 125, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', ''),
(10, 'Build Your Own', '11-Inch Pizza', 10, 120, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', ''),
(11, 'Build Your Own', 'Large Pizza', 5, 234, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '');

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
('13LgIe', 'HEARTSDAY', 'Event', 100, '15', 10, '', 'We\'re the best place to grab a fast-fire\'d pizza made with real ingredients that are free of artificial colors, flavors, preservatives, and sweeteners. We\'ve also got freshly made salads, house-made lemonades, and decadent, oven-fired desserts on the menu'),
('B43Ods', 'DISCOUNT', 'Coupon', 200, '30', 1, '-', 'We\'re the best place to grab a fast-fire\'d pizza made with real ingredients that are free of artificial colors, flavors, preservatives, and sweeteners. We\'ve also got freshly made salads, house-made lemonades, and decadent, oven-fired desserts on the menu'),
('INz3p0', 'NEWYEAR', 'Event', 500, '50', 1, '', 'We\'re the best place to grab a fast-fire\'d pizza made with real ingredients that are free of artificial colors, flavors, preservatives, and sweeteners. We\'ve also got freshly made salads, house-made lemonades, and decadent, oven-fired desserts on the menu');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`accountID`);

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
-- Indexes for table `ewallettransaction`
--
ALTER TABLE `ewallettransaction`
  ADD PRIMARY KEY (`transactionID`);

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
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customerID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `ewallettransaction`
--
ALTER TABLE `ewallettransaction`
  MODIFY `transactionID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ingredients`
--
ALTER TABLE `ingredients`
  MODIFY `ingredientsID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `orderingredients`
--
ALTER TABLE `orderingredients`
  MODIFY `orderIngredientsID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orderingredientscart`
--
ALTER TABLE `orderingredientscart`
  MODIFY `OICID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `orderitem`
--
ALTER TABLE `orderitem`
  MODIFY `itemID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `orderitemcart`
--
ALTER TABLE `orderitemcart`
  MODIFY `OICartID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=196;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `productID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
