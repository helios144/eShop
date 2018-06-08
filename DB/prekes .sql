-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 15, 2017 at 09:46 AM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `prekes`
--

-- --------------------------------------------------------

--
-- Table structure for table `atributai_kategorijai`
--

CREATE TABLE `atributai_kategorijai` (
  `ID` int(11) NOT NULL,
  `kategorijos_id` int(11) NOT NULL,
  `preke_id` int(11) NOT NULL,
  `atributas_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `atributai_kategorijai`
--

INSERT INTO `atributai_kategorijai` (`ID`, `kategorijos_id`, `preke_id`, `atributas_id`) VALUES
(1, 5, 44, 3),
(2, 4, 47, 1),
(3, 4, 49, 2),
(4, 4, 54, 1),
(5, 5, 52, 5),
(6, 5, 53, 3),
(7, 6, 50, 8),
(8, 6, 51, 9);

-- --------------------------------------------------------

--
-- Table structure for table `atributu_sarasas`
--

CREATE TABLE `atributu_sarasas` (
  `ID` int(11) NOT NULL,
  `kategorijos_ID` int(11) NOT NULL,
  `atributas` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `atributu_sarasas`
--

INSERT INTO `atributu_sarasas` (`ID`, `kategorijos_ID`, `atributas`) VALUES
(1, 4, 'Clay'),
(2, 4, 'Plastic'),
(3, 5, 'Plastic'),
(4, 5, 'Plastic Coated'),
(5, 5, 'Plastic Cellulose'),
(8, 6, '6-seats'),
(9, 6, '9-seats'),
(10, 0, 'Select new attribute');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `ID` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `cart` longtext NOT NULL,
  `Status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`ID`, `user_id`, `cart`, `Status`) VALUES
(1, 1, 'select id,5 as quant from prekes where id=\"44\" union select id,2 as quant from prekes where id=\"47\" union select id,1 as quant from prekes where id=\"49\"', 'Approved'),
(2, 2, 'select id,1 as quant from prekes where id=\"44\" union select id,1 as quant from prekes where id=\"47\" union select id,1 as quant from prekes where id=\"49\"', 'Approved');

-- --------------------------------------------------------

--
-- Table structure for table `kategorijos`
--

CREATE TABLE `kategorijos` (
  `ID` int(11) NOT NULL,
  `Kategorija` varchar(50) NOT NULL,
  `preke_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategorijos`
--

INSERT INTO `kategorijos` (`ID`, `Kategorija`, `preke_id`) VALUES
(7, 'Chips', 43),
(8, 'Playing Cards', 44),
(9, 'Chips', 45),
(10, 'Playing Cards', 46),
(11, 'Chips', 47),
(12, 'Playing Cards', 48),
(13, 'Chips', 49),
(14, 'Poker Tables', 50),
(15, 'Poker Tables', 51),
(16, 'Playing Cards', 52),
(17, 'Playing Cards', 53),
(18, 'Chips', 54);

-- --------------------------------------------------------

--
-- Table structure for table `kategoriju_sarasas`
--

CREATE TABLE `kategoriju_sarasas` (
  `ID` int(11) NOT NULL,
  `kategorija` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategoriju_sarasas`
--

INSERT INTO `kategoriju_sarasas` (`ID`, `kategorija`) VALUES
(4, 'Chips'),
(5, 'Playing Cards'),
(6, 'Poker Tables');

-- --------------------------------------------------------

--
-- Table structure for table `prekes`
--

CREATE TABLE `prekes` (
  `ID` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `kaina` float NOT NULL,
  `nuotrauka` varchar(6500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prekes`
--

INSERT INTO `prekes` (`ID`, `name`, `description`, `kaina`, `nuotrauka`) VALUES
(44, 'KING  \"PRESTIGE\"', 'KING \"PRESTIGE\" PLAYING CARDS SINGLE DECK RED', 14.99, 'imgg/img_0205_1b.jpg'),
(47, '500PCE AUSSIE$ 13.5G CHIP SET', '500PCE AUSSIE$ 13.5G CHIP SET', 129.99, 'imgg/aud-clay-group.jpg'),
(49, '500PCE TOURNAMENT POKER 13.5G CHIP SET', '500PCE TOURNAMENT POKER 13.5G CHIP SET', 159.99, 'imgg/20160817_105840b.jpg'),
(50, 'X2 MINI POKER TABLE + DINING TABLE', 'Serious dining style with a poker problem\nThe X2 Mini sets the bar for stylish, incognito poker dining tables! We modeled the X2 Mini after our HUGE professional Casino X2 table but brought the scale down to a manageable, real-world size. We then designed a stylish dining top to bring you the ultimate in convertible dining/poker action.\n- Poker table Dimensions: 71.5 in x 44.5 in x 30 inches\n- Dining table Dimensions: 74.5 in x 47.5 in x 33 inches (included)', 2500, 'imgg/x2mini1250ls4.jpg'),
(51, '90  BLACK TOURNAMENT POKER TABLE', 'Step up in class with this 10 player 90  Tournament Texas Hold Em Poker Table.\n\n\nFeatures a Padded water resistant black marine grade vinyl armrest surrounds the table, providing hours of comfort and enjoyment.', 799, 'imgg/tb2.jpg'),
(52, 'KEM ARROW BLACK & GOLD (POKER/JUMBO)', '100% cellulose acetate plastic, your Kem cards will remain attractive and flexible through the most rigorous of use. These cards are scuff and break resistant and completely washable. Arrow Black & Gold, Poker Size / Jumbo Index. (2 decks)', 59, 'imgg/kem-arrow-poker-feature2.jpg'),
(53, '48 X TEXAS HOLDEM 100% PLASTIC PLAYING CARDS', '48 x Decks of Texas Holdem 100% Plastic Poker Size / Jumbo Index (2 1/2 x 3 1/2 inch).', 189.99, 'imgg/cards3.jpg'),
(54, '500 X 10G CUSTOM WORLD POKER SERIES CHIPS', '500 X 10G CUSTOM WORLD POKER SERIES CHIPS', 549.99, 'imgg/chips3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `User_name` varchar(20) NOT NULL,
  `Password` varchar(15) NOT NULL,
  `Privileges` int(11) NOT NULL,
  `Country` varchar(20) DEFAULT NULL,
  `FirstName` varchar(20) DEFAULT NULL,
  `LastName` varchar(20) DEFAULT NULL,
  `Address` varchar(50) DEFAULT NULL,
  `City` varchar(20) DEFAULT NULL,
  `Zip` int(10) DEFAULT NULL,
  `Phone` varchar(15) DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `User_name`, `Password`, `Privileges`, `Country`, `FirstName`, `LastName`, `Address`, `City`, `Zip`, `Phone`, `Email`) VALUES
(1, 'Root', '123456', 1, 'Lietuva', 'Saulius', 'Gaiz', '', '', 0, '', ''),
(2, 'Helios', '999', 0, 'Lietuva', 'Saulius', 'Gaiz', '', '', 0, '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `atributai_kategorijai`
--
ALTER TABLE `atributai_kategorijai`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `atributu_sarasas`
--
ALTER TABLE `atributu_sarasas`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `kategorijos`
--
ALTER TABLE `kategorijos`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `preke_id` (`preke_id`);

--
-- Indexes for table `kategoriju_sarasas`
--
ALTER TABLE `kategoriju_sarasas`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `prekes`
--
ALTER TABLE `prekes`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `atributai_kategorijai`
--
ALTER TABLE `atributai_kategorijai`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `atributu_sarasas`
--
ALTER TABLE `atributu_sarasas`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kategorijos`
--
ALTER TABLE `kategorijos`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `kategoriju_sarasas`
--
ALTER TABLE `kategoriju_sarasas`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `prekes`
--
ALTER TABLE `prekes`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
