-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 12, 2016 at 08:14 PM
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
  `ldap_login` varchar(50) NOT NULL,
  PRIMARY KEY (`Profile_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10028 ;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`Profile_ID`, `name`, `Email`, `Availability`, `notifications`, `ldap_login`) VALUES
(10025, 'Julie Beck', 'afounta3@students.kennesaw.edu', 'Weekends', 'on', 'afounta3'),
(10026, 'Julie Beck', 'webtasticjulie@gmail.com', 'Weekends', 'on', 'webtasticjulie'),
(10027, 'Andrea Fountain', 'crocheterjulie@gmail.com', 'Weekdays', 'on', 'crocheterjulie');

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
(1, 10024),
(1, 10025),
(1, 10026),
(3, 10027),
(4, 10027);

-- --------------------------------------------------------

--
-- Table structure for table `service_request`
--

CREATE TABLE IF NOT EXISTS `service_request` (
  `service_request_id` int(50) NOT NULL AUTO_INCREMENT,
  `Requester_ID` int(50) NOT NULL COMMENT 'Profile ID of requestor',
  `Task_ID` int(50) NOT NULL,
  PRIMARY KEY (`service_request_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `service_request`
--

INSERT INTO `service_request` (`service_request_id`, `Requester_ID`, `Task_ID`) VALUES
(1, 4, 0),
(2, 4, 0),
(3, 4, 0),
(4, 4, 2),
(5, 4, 3),
(6, 4, 4),
(7, 4, 5),
(8, 4, 6),
(9, 4, 7);

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE IF NOT EXISTS `tasks` (
  `task_id` int(11) NOT NULL AUTO_INCREMENT,
  `task_date` datetime NOT NULL,
  `task_desc` text NOT NULL,
  `task_status` varchar(30) NOT NULL,
  `task_deadline` datetime NOT NULL,
  `Service_ID` int(10) NOT NULL,
  `assigned_to` int(10) NOT NULL,
  PRIMARY KEY (`task_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`task_id`, `task_date`, `task_desc`, `task_status`, `task_deadline`, `Service_ID`, `assigned_to`) VALUES
(1, '2016-03-05 18:28:18', 'test', 'In Progress', '0000-00-00 00:00:00', 0, 0),
(2, '2016-03-05 18:29:04', 'Test', 'In Progress', '0000-00-00 00:00:00', 0, 0),
(3, '2016-03-06 08:40:37', 'this is a test', 'In Progress', '2016-07-01 00:00:00', 1, 0),
(4, '2016-03-06 08:40:37', 'this is a test', 'In Progress', '2016-07-01 00:00:00', 3, 0),
(5, '2016-03-06 09:12:59', 'This is a test', 'In Progress', '2016-07-09 00:00:00', 1, 10020),
(6, '2016-03-06 09:12:59', 'This is a test', 'In Progress', '2016-07-09 00:00:00', 4, 10020),
(7, '2016-03-12 20:04:29', 'This is a test', 'In Progress', '2016-04-10 00:00:00', 2, 10027);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
