-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 16, 2018 at 11:03 AM
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
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `book_id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `pub_date` date NOT NULL,
  `author` int(11) NOT NULL,
  `pub_type` varchar(100) NOT NULL,
  `copyright` tinyint(1) NOT NULL,
  `genre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`book_id`, `title`, `pub_date`, `author`, `pub_type`, `copyright`, `genre`) VALUES
(1, 'Things Fall Apart', '1970-09-01', 2, 'E-Book', 0, 'Fiction'),
(2, 'The Long Lavender Look', '1968-09-01', 4, 'E-Book', 0, 'Fiction'),
(3, 'Little Dorrit', '1865-07-01', 3, 'E-Book', 0, 'Fiction'),
(4, 'Nicholas Nickleby', '1838-03-31', 3, 'E-book', 0, 'Fiction'),
(5, 'The Bean Trees', '1988-09-01', 1, 'Paperback', 0, 'Fiction'),
(6, 'The Deep Blue Goodbye', '1964-06-01', 4, 'Paperback', 0, 'Detective'),
(7, 'Artemis', '2017-09-01', 7, 'E-book', 0, 'Science Fiction');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`book_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
