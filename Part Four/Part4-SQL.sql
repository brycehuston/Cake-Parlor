-- phpMyAdmin SQL Dump
-- version 4.7.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 28, 2019 at 05:35 AM
-- Server version: 5.6.34
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cake_parlor`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `ID` int(11) NOT NULL,
  `Descr` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `members` (
    `user_id` int(11) AUTO_INCREMENT PRIMARY KEY NOT NULL,
    `user_first` varchar(25) NOT NULL,
    `user_last` varchar(25) NOT NULL,
    `user_email` varchar(50) NOT NULL,
    `user_uid` varchar(50) NOT NULL,
    `user_pwd` varchar(256) NOT NULL
);

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`ID`, `Descr`) VALUES
(1, 'Ice Cream Cake'),
(2, 'Black Forrest Cake'),
(3, 'Dark Chocolate Cake');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `ID` int(11) NOT NULL,
  `FName` varchar(25) DEFAULT NULL,
  `LName` varchar(25) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `Suburb` varchar(255) DEFAULT NULL,
  `State` varchar(3) DEFAULT NULL,
  `Phone` char(10) DEFAULT NULL,
  `Descr` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`ID`, `FName`, `LName`, `Address`, `Suburb`, `State`, `Phone`, `Descr`) VALUES
(1, 'Bryce', 'Huston', '1 Home street', 'Homeville', 'WA', '0412345678', 'Likes long walks on the beach'),
(2, 'Ryker', 'Krein', '1 First street', 'Melville', 'WA', '0487654321', 'Love to swim');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `ID` int(11) NOT NULL,
  `FName` varchar(25) DEFAULT NULL,
  `LName` varchar(40) DEFAULT NULL,
  `Address` varchar(50) DEFAULT NULL,
  `Suburb` varchar(25) DEFAULT NULL,
  `Salary` decimal(8,2) DEFAULT NULL,
  `StartDate` date DEFAULT NULL,
  `TFN` int(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`ID`, `FName`, `LName`, `Address`, `Suburb`, `Salary`, `StartDate`, `TFN`) VALUES
(1, 'Rondell', 'Gogio', 'Boss street', 'Bossville', '999999.99', '2019-04-01', 123456789),
(2, 'Jason', 'Tegart', '15 Boss lane', 'Bossville', '1000.12', '2019-06-27', 987654321);

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `InvoiceNo` int(11) NOT NULL,
  `InvoiceDate` date DEFAULT NULL,
  `CustID` int(11) DEFAULT NULL,
  `EmpID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`InvoiceNo`, `InvoiceDate`, `CustID`, `EmpID`) VALUES
(1, '2019-06-28', 1, 2),
(2, '2019-06-27', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `invoice_line`
--

CREATE TABLE `invoice_line` (
  `InvoiceNo` int(11) NOT NULL,
  `ProdID` int(11) NOT NULL DEFAULT '0',
  `Qty` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice_line`
--

INSERT INTO `invoice_line` (`InvoiceNo`, `ProdID`, `Qty`) VALUES
(2, 1, 2),
(1, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `ID` int(11) NOT NULL,
  `Descr` varchar(255) DEFAULT NULL,
  `CategoryID` int(11) DEFAULT NULL,
  `CostPrice` decimal(5,2) DEFAULT NULL,
  `SuppID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`ID`, `Descr`, `CategoryID`, `CostPrice`, `SuppID`) VALUES
(1, 'Chocolate', 2, '14.99', 2),
(2, 'French Vanilla', 1, '19.99', 1);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `ID` int(11) NOT NULL,
  `Name` varchar(25) DEFAULT NULL,
  `Phone` char(10) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `Suburb` varchar(255) DEFAULT NULL,
  `State` varchar(3) DEFAULT NULL,
  `Postcode` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`ID`, `Name`, `Phone`, `Address`, `Suburb`, `State`, `Postcode`) VALUES
(1, 'Cheesecake Shop', '93312345', '12 South street', 'White gum valley', 'WA', 6157),
(2, 'Bakers Delight', '93341234', 'Kardinya Shops', 'Kardinya', 'WA', 6162);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`InvoiceNo`),
  ADD KEY `CustID` (`CustID`),
  ADD KEY `EmpID` (`EmpID`);

--
-- Indexes for table `invoice_line`
--
ALTER TABLE `invoice_line`
  ADD PRIMARY KEY (`ProdID`,`InvoiceNo`),
  ADD KEY `InvoiceNo` (`InvoiceNo`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `CategoryID` (`CategoryID`),
  ADD KEY `SuppID` (`SuppID`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `InvoiceNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `invoice_line`
--
ALTER TABLE `invoice_line`
  MODIFY `InvoiceNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `invoice`
--
ALTER TABLE `invoice`
  ADD CONSTRAINT `invoice_ibfk_1` FOREIGN KEY (`CustID`) REFERENCES `customer` (`ID`),
  ADD CONSTRAINT `invoice_ibfk_2` FOREIGN KEY (`EmpID`) REFERENCES `employee` (`ID`);

--
-- Constraints for table `invoice_line`
--
ALTER TABLE `invoice_line`
  ADD CONSTRAINT `invoice_line_ibfk_1` FOREIGN KEY (`InvoiceNo`) REFERENCES `invoice` (`InvoiceNo`),
  ADD CONSTRAINT `invoice_line_ibfk_2` FOREIGN KEY (`ProdID`) REFERENCES `product` (`ID`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`CategoryID`) REFERENCES `category` (`ID`),
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`SuppID`) REFERENCES `supplier` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
