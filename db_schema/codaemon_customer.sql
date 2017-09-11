-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 11, 2017 at 09:10 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `codaemon_customer`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `c_id` int(11) NOT NULL,
  `c_name` varchar(100) NOT NULL,
  `c_email` varchar(255) NOT NULL,
  `c_address` text NOT NULL,
  `c_zip` varchar(10) NOT NULL,
  `c_telephone` varchar(15) NOT NULL,
  `c_dob` date NOT NULL,
  `c_is_active` tinyint(1) NOT NULL,
  `c_is_deleted` tinyint(1) NOT NULL,
  `c_added_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`c_id`, `c_name`, `c_email`, `c_address`, `c_zip`, `c_telephone`, `c_dob`, `c_is_active`, `c_is_deleted`, `c_added_date`) VALUES
(1, 'Albert Brown', 'albert.brown@test.com', 'Testing Testing Testing', '1001', '98905423453', '1987-06-03', 1, 0, '2017-09-11 00:00:00'),
(2, 'John Doe', 'john.doe@testing.com', 'Testing Testing', '1002', '432567891', '1986-09-18', 1, 0, '2017-09-11 00:00:00'),
(3, 'Nancy David', 'nancy.david@gmail.com', '104, $th Floor, New York', '1001', '54323435', '1986-09-20', 1, 0, '2017-09-11 00:00:00'),
(4, 'Jack Brown', 'jack.brown@gmail.com', '23, JB Villa, Texas', '4001', '43256789', '1985-07-12', 1, 0, '2017-09-11 00:00:00'),
(5, 'Ronald Ford', 'ronal.ford@gmail.com', '32, RDF, US', '2003', '4325617809', '1985-05-17', 0, 0, '2017-09-11 00:00:00'),
(6, 'Veronica Jackson', 'veronica.jackson@gmail.com', 'S/201, Tower 2, Lane 1, Phillipines', '1003', '432567323', '1989-06-21', 1, 0, '2017-09-11 00:00:00'),
(13, 'Matthew Joys', 'mathew.joys@gmail.com', 'Testing Testing Testing', '345534', '35345345354', '1988-02-16', 1, 0, '2017-09-11 20:52:22'),
(14, 'Thomas Rismus', 'thomas@gmail.com', 'testin testing testing testing', '234202', '242423424', '1980-03-17', 1, 0, '2017-09-11 20:55:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`c_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
