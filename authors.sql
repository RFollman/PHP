-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 16, 2018 at 11:02 AM
-- Server version: 5.6.34-log
-- PHP Version: 7.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library`
--

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE `authors` (
  `author_id` int(11) NOT NULL,
  `f_name` varchar(25) NOT NULL,
  `l_name` varchar(35) NOT NULL,
  `address1` varchar(100) NOT NULL,
  `address2` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(10) NOT NULL,
  `zip` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`author_id`, `f_name`, `l_name`, `address1`, `address2`, `city`, `state`, `zip`) VALUES
(1, 'Barbara', 'Kingsolver', '123 Anywhere Street', '', 'Tallahassee', 'FL', 32301),
(2, 'Chinua', 'Achebe', '456 Our Street, Apartment 23', '', 'New York', 'NY', 21212),
(3, 'Charles', 'Dickens', '987 Best Street', '', 'London', 'UK', 0),
(4, 'John', 'MacDonald', '654 Ft. Lauderdale Drive', '', 'Fort Lauderdale', 'FL', 32300),
(5, 'John', 'Smith', '123 Alachua Street', '', 'Tallahssee', 'FL', 32301),
(6, 'Jane', 'Hoffman', '654 San Diego Lane', '', 'Encinito', 'CA', 98745),
(7, 'Andy', 'Weir', '654 Spacer Lane', '', 'Houston', 'TX', 98765);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`author_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `authors`
--
ALTER TABLE `authors`
  MODIFY `author_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
