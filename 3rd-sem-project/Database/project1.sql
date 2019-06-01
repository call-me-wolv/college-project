-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 06, 2018 at 06:46 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project1`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `assigndel` (IN `orderid` INT, IN `delid` INT)  NO SQL
update orders set delivery_id=delid where order_id=orderid$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `restockstore` (IN `itemid` INT, IN `storeid` INT, IN `quantity` INT, IN `quan1` INT)  NO SQL
IF quan1<=100
THEN
update store_items set squantity = quantity where item_id = itemid and store_id=storeid;
END if$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` char(30) NOT NULL,
  `cname` varchar(20) NOT NULL,
  `customer_pwd` char(20) NOT NULL,
  `ccity` char(20) NOT NULL,
  `carea` char(20) NOT NULL,
  `caddress` varchar(50) NOT NULL,
  `cphone` char(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `cname`, `customer_pwd`, `ccity`, `carea`, `caddress`, `cphone`) VALUES
('preetham@gmail.com', 'preethamdp', '1234', 'bengaluru', 'jaynagar', '#007 srr pg sweet homes layout', '990254'),
('shravanth@gmail.com', 'shravanth', '123', 'bengaluru', 'jayanagara', '#1010 kuvempu nagar', '9632587412');

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

CREATE TABLE `delivery` (
  `did` int(11) NOT NULL,
  `dname` varchar(20) NOT NULL,
  `dage` int(11) NOT NULL,
  `dstatus` char(20) NOT NULL,
  `demail` char(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `delivery`
--

INSERT INTO `delivery` (`did`, `dname`, `dage`, `dstatus`, `demail`) VALUES
(1000, 'vyoma', 18, 'avail', 'yoma@gmail.com'),
(1001, 'rama', 18, 'avail', 'shravanth.v.y@gmail.com'),
(1002, 'krishna', 19, 'avail', 'manur.venkat@gmail.com'),
(1004, 'vedanth', 23, 'avail', 'preetham@gmail.com'),
(1006, 'amarnath', 24, 'avail', 'amarnath@gmail.com'),
(1007, 'rahul', 24, 'avail', 'rahulrds@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `hub`
--

CREATE TABLE `hub` (
  `item_id` int(11) NOT NULL,
  `iname` varchar(20) NOT NULL,
  `idesc` varchar(100) NOT NULL,
  `iprice` int(11) NOT NULL,
  `iquantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hub`
--

INSERT INTO `hub` (`item_id`, `iname`, `idesc`, `iprice`, `iquantity`) VALUES
(1, 'brown rice', 'Unpolished or brown rice is different from white rice in that the second layer', 100, 969),
(2, 'jaggery candies', 'Best for digestion - one of the main reasons why people take jaggery after eating ', 150, 200),
(3, 'coconut oil', '100 percent certified organic coconut oil, made from the finest quality coconuts ', 80, 1299),
(4, 'forest honey', 'Wild honey bees collect nectar from himalayan flowers to create this rare honey\r\n', 250, 250),
(5, 'peanuts', 'Peanuts are rich in energy\r\nContains health benefiting nutrients, minerals, antioxidants and vitamin', 110, 50),
(6, 'sugar cane', 'its good for health ', 50, 0),
(8, 'wheat', 'organic 100 percent', 60, 160),
(9, 'sugar cane', 'its good for health ', 50, 14);

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `orderid` int(11) NOT NULL,
  `itemid` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `operation` char(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `orderid`, `itemid`, `quantity`, `operation`) VALUES
(1, 9, 1, 10, '1000'),
(2, 169, 2, 33, 'cancel'),
(3, 179, 8, 1, 'cancel'),
(4, 180, 8, 10, 'cancel'),
(5, 2, 1, 10, 'cancel'),
(6, 8, 8, 17, 'cancel');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `customer_id` char(30) NOT NULL,
  `delivery_id` int(11) DEFAULT NULL,
  `order_date` date DEFAULT NULL,
  `status` char(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `item_id`, `quantity`, `price`, `customer_id`, `delivery_id`, `order_date`, `status`) VALUES
(3, 1, 10, 1000, 'preetham@gmail.com', 1000, '2018-12-01', 'del'),
(4, 3, 10, 800, 'shravanth@gmail.com', 1006, '2018-12-01', 'del'),
(5, 4, 3, 750, 'shravanth@gmail.com', 1001, '2018-12-01', 'del'),
(6, 5, 3, 330, 'preetham@gmail.com', 1000, '2018-12-01', 'del'),
(7, 3, 10, 800, 'preetham@gmail.com', 1004, '2018-12-01', 'del'),
(9, 1, 10, 1000, 'preetham@gmail.com', NULL, '2018-12-06', 'notdel');

--
-- Triggers `orders`
--
DELIMITER $$
CREATE TRIGGER `insert` AFTER DELETE ON `orders` FOR EACH ROW INSERT INTO logs(orderid,itemid,quantity,operation) VALUES (old.order_id,old.item_id,old.quantity,'cancel')
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `trigg` AFTER INSERT ON `orders` FOR EACH ROW UPDATE logs set orderid=new.order_id,itemid=new.item_id,quantity=new.quantity,operation=(new.quantity*new.price) WHERE id=1
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `store`
--

CREATE TABLE `store` (
  `store_id` int(11) NOT NULL,
  `sname` varchar(20) NOT NULL,
  `scity` char(20) NOT NULL,
  `sarea` char(20) NOT NULL,
  `saddress` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `store`
--

INSERT INTO `store` (`store_id`, `sname`, `scity`, `sarea`, `saddress`) VALUES
(1, 'organic retails', 'bengaluru', 'jayanagar', '#001 building #102 4th cross 5th main jayanagar'),
(2, 'hyper bazar', 'bengaluru', 'jpnagar', 'jssate college'),
(3, 'big bazar', 'bengaluru', 'kuvempunagara', '#69,next to kai ruchi ,opp of rds complex'),
(4, 'metro', 'bengaluru', 'srinivaspura', 'near rbi layout'),
(5, 'Dmart', 'mysuru', 'ameednagar', '#212,near mysore palace');

-- --------------------------------------------------------

--
-- Table structure for table `store_items`
--

CREATE TABLE `store_items` (
  `store_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `squantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `store_items`
--

INSERT INTO `store_items` (`store_id`, `item_id`, `squantity`) VALUES
(1, 1, 60),
(1, 2, 150),
(1, 3, 60),
(1, 4, 30),
(1, 5, 150),
(2, 1, 60),
(2, 5, 60),
(2, 8, 88),
(2, 9, 60),
(3, 1, 80),
(3, 3, 55),
(3, 4, 60),
(3, 9, 50),
(4, 1, 88),
(4, 2, 60),
(4, 9, 66),
(5, 3, 89),
(5, 5, 68),
(5, 8, 88),
(5, 9, 56);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`),
  ADD UNIQUE KEY `cphone` (`cphone`);

--
-- Indexes for table `delivery`
--
ALTER TABLE `delivery`
  ADD PRIMARY KEY (`did`);

--
-- Indexes for table `hub`
--
ALTER TABLE `hub`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `orders_con2` (`delivery_id`),
  ADD KEY `orders_con1` (`customer_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `store`
--
ALTER TABLE `store`
  ADD PRIMARY KEY (`store_id`);

--
-- Indexes for table `store_items`
--
ALTER TABLE `store_items`
  ADD PRIMARY KEY (`store_id`,`item_id`),
  ADD KEY `store_items_cons` (`item_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `delivery`
--
ALTER TABLE `delivery`
  MODIFY `did` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1008;

--
-- AUTO_INCREMENT for table `hub`
--
ALTER TABLE `hub`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `store`
--
ALTER TABLE `store`
  MODIFY `store_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_con1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_con2` FOREIGN KEY (`delivery_id`) REFERENCES `delivery` (`did`) ON DELETE SET NULL,
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `hub` (`item_id`);

--
-- Constraints for table `store_items`
--
ALTER TABLE `store_items`
  ADD CONSTRAINT `store_items_cons` FOREIGN KEY (`item_id`) REFERENCES `hub` (`item_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `store_items_cons1` FOREIGN KEY (`store_id`) REFERENCES `store` (`store_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
