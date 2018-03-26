-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 25, 2018 at 09:24 PM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `inventory`
--
CREATE DATABASE IF NOT EXISTS `inventory` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `inventory`;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `c_id` int(11) NOT NULL,
  `disc` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `c_id`, `disc`) VALUES
(1, 3, 'Beds'),
(2, 5, 'comfort');

-- --------------------------------------------------------

--
-- Table structure for table `incoming`
--

CREATE TABLE IF NOT EXISTS `incoming` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `customer_name` varchar(200) NOT NULL,
  `invoice_no` int(11) NOT NULL,
  `i_code` varchar(50) NOT NULL,
  `amount` float NOT NULL,
  `price` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `incoming`
--

INSERT INTO `incoming` (`id`, `date`, `customer_name`, `invoice_no`, `i_code`, `amount`, `price`) VALUES
(1, '2017-07-21', 'kkd', 4343, '1', 6, 11500),
(3, '0000-00-00', 'adsf', 43, '1', 5, 10000),
(4, '2017-07-13', '54', 765, '1', 32, 12000),
(5, '2017-07-23', 'sdf', 765, '1', 23, 54444),
(6, '2017-07-20', 'dfdfsdf', 234, '1', 10, 70000);

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE IF NOT EXISTS `item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) NOT NULL,
  `disc` text NOT NULL,
  `category` int(11) NOT NULL,
  `amount` float NOT NULL,
  `price` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`id`, `code`, `disc`, `category`, `amount`, `price`) VALUES
(1, 'A-10', 'Black Bed', 1, 53, 70000),
(3, '2', 'comfort', 1, 10, 0);

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE IF NOT EXISTS `notification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `msg` text NOT NULL,
  `token` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `msg`, `token`) VALUES
(1, 'There is a shortage on Black Bed!', 1),
(2, 'There is a shortage on Black Bed!', 1);

-- --------------------------------------------------------

--
-- Table structure for table `outgoing`
--

CREATE TABLE IF NOT EXISTS `outgoing` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `customer_name` varchar(200) NOT NULL,
  `invoice_no` int(11) NOT NULL,
  `i_code` varchar(50) NOT NULL,
  `amount` float NOT NULL,
  `price` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `outgoing`
--

INSERT INTO `outgoing` (`id`, `date`, `customer_name`, `invoice_no`, `i_code`, `amount`, `price`) VALUES
(2, '2017-07-15', 'Buyer 21', 3432, '1', 4, 13000),
(3, '2017-07-07', 'asd', 4332, '1', 2, 13000),
(4, '2017-06-27', 'sdf', 43, '1', 3, 0),
(5, '2017-07-12', 'dddd', 566, '1', 3, 0),
(6, '2017-07-11', 'eee', 10, '1', 2, 0),
(7, '2017-06-28', 'sdf', 542, '1', 4, 0),
(8, '2017-07-20', 'hewam', 123, '1', 2, 0),
(9, '2017-09-13', 'samrawit', 1, '1', 5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`) VALUES
(1, 'sadf', 'asd', 'asdd@sdf', 'sa'),
(2, 'first', 'last', 'email@e', 'pass');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
