-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 25, 2013 at 08:31 AM
-- Server version: 5.5.24-log
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `leaves`
--

-- --------------------------------------------------------

--
-- Table structure for table `accrual_history`
--

CREATE TABLE IF NOT EXISTS `accrual_history` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `employee_id` varchar(100) NOT NULL,
  `leave_code` varchar(3) NOT NULL,
  `date` varchar(100) NOT NULL,
  `year` int(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE IF NOT EXISTS `employees` (
  `id` int(11) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `start_date` varchar(100) NOT NULL,
  `num_of_days` int(11) NOT NULL,
  `vl_outstanding` float(6,2) NOT NULL,
  `sl_outstanding` float(6,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=500000 ;

-- --------------------------------------------------------

--
-- Table structure for table `leave_balance`
--

CREATE TABLE IF NOT EXISTS `leave_balance` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `employee_id` varchar(100) NOT NULL,
  `leave_code` varchar(10) NOT NULL,
  `balance` float(6,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `leave_transaction`
--

CREATE TABLE IF NOT EXISTS `leave_transaction` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `employee_id` varchar(50) NOT NULL,
  `leave_type` varchar(100) NOT NULL,
  `pay_type` varchar(100) NOT NULL,
  `no_days` float(6,2) NOT NULL,
  `start` varchar(100) NOT NULL,
  `end` varchar(100) NOT NULL,
  `vl` float(6,2) NOT NULL,
  `sl` float(6,2) NOT NULL,
  `date` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `leave_type`
--

CREATE TABLE IF NOT EXISTS `leave_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) NOT NULL,
  `desc` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `leave_type`
--

INSERT INTO `leave_type` (`id`, `code`, `desc`) VALUES
(1, 'VL', 'Vacation Leave'),
(2, 'SL', 'Sick Leave');

-- --------------------------------------------------------

--
-- Table structure for table `pay_type`
--

CREATE TABLE IF NOT EXISTS `pay_type` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) NOT NULL,
  `desc` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `pay_type`
--

INSERT INTO `pay_type` (`id`, `code`, `desc`) VALUES
(1, 'PD', 'Paid'),
(2, 'NTPD', 'Not Paid');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `type` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `name`, `password`, `type`) VALUES
(1, 'don_rivera', 'don', 'e10adc3949ba59abbe56e057f20f883e', 'hr'),
(2, 'faisal', 'Faisal Dahfar', 'e10adc3949ba59abbe56e057f20f883e', 'hr');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
