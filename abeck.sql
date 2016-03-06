-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 05, 2016 at 05:39 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `abeck`
--

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE IF NOT EXISTS `profiles` (
  `Profile_ID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `Email` varchar(200) NOT NULL,
  `Availability` text NOT NULL,
  `notifications` char(3) NOT NULL,
  PRIMARY KEY (`Profile_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10025 ;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`Profile_ID`, `name`, `Email`, `Availability`, `notifications`) VALUES
(10000, 'John Dow', 'jdow@spsu.edu', 'Mondays 3-4pm', ''),
(10001, 'Ann Green', 'agreen@spsu.edu', 'Weekends any time', ''),
(10013, 'Ju Be', 'redfootinfotech@yahoo.com', 'Test', ''),
(10014, 'f d', 'a', 'f', ''),
(10015, 'test test', 't', 'test', ''),
(10016, 'f33 d33', 'afd', 'test', ''),
(10017, 'ddd ddd', 'ddd', 'ttt', ''),
(10018, 'test test', 'test@test.edu', 'test', ''),
(10019, 'Julie Beck', 'webtasticjulie@protonmail.ch', 'weekends', ''),
(10020, 'Julie Beck', 'crocheterjulie@gmail.com', 'weekends', ''),
(10021, ' ', '', '', ''),
(10022, 'Andr Beck', 'afounta@gmail.com', 'Weekends', 'on'),
(10023, 'julie beck', 'test@tester.edu', 'test', 'on'),
(10024, 'Test Tester', 'tester@nodomain.edu', 'weekdays', 'on');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE IF NOT EXISTS `services` (
  `Service_ID` int(10) NOT NULL AUTO_INCREMENT,
  `Service_DSC` text NOT NULL,
  PRIMARY KEY (`Service_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`Service_ID`, `Service_DSC`) VALUES
(1, 'PHP tutoring'),
(2, 'Making copies'),
(3, 'Java Tutoring'),
(4, 'HTML Tutoring');

-- --------------------------------------------------------

--
-- Table structure for table `services_provided`
--

CREATE TABLE IF NOT EXISTS `services_provided` (
  `Service_ID` int(11) NOT NULL,
  `Profile_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `services_provided`
--

INSERT INTO `services_provided` (`Service_ID`, `Profile_ID`) VALUES
(1, 10000),
(2, 10000),
(2, 10001),
(10009, 1),
(10009, 2),
(1, 10010),
(2, 10010),
(1, 10011),
(1, 10012),
(1, 10013),
(1, 10015),
(1, 10019),
(1, 10020),
(2, 10022),
(1, 10023),
(1, 10024);

-- --------------------------------------------------------

--
-- Table structure for table `service_request`
--

CREATE TABLE IF NOT EXISTS `service_request` (
  `service_request_id` int(50) NOT NULL AUTO_INCREMENT,
  `Requester_ID` int(50) NOT NULL COMMENT 'Profile ID of requestor',
  `Task_ID` int(50) NOT NULL,
  PRIMARY KEY (`service_request_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `service_request`
--

INSERT INTO `service_request` (`service_request_id`, `Requester_ID`, `Task_ID`) VALUES
(1, 4, 0),
(2, 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE IF NOT EXISTS `tasks` (
  `task_id` int(11) NOT NULL,
  `task_date` datetime NOT NULL,
  `task_desc` text NOT NULL,
  `task_status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`task_id`, `task_date`, `task_desc`, `task_status`) VALUES
(0, '2016-03-05 17:32:45', 'Testing', '0'),
(0, '2016-03-05 17:33:57', 'Testing', 'In Progress');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
