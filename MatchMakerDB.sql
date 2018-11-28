-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 27, 2018 at 11:01 PM
-- Server version: 5.7.19-log
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `MatchMakerDB`
--

-- --------------------------------------------------------

--
-- Table structure for table `Matches`
--

DROP TABLE IF EXISTS `Matches`;
CREATE TABLE IF NOT EXISTS `Matches` (
  `MentorID` int(9) NOT NULL,
  `MenteeID` int(9) NOT NULL,
  `MatchID` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`MatchID`),
  KEY `MatchFK` (`MentorID`),
  KEY `MentorFK` (`MenteeID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Matches`
--

INSERT INTO `Matches` (`MentorID`, `MenteeID`, `MatchID`) VALUES
(905922183, 905954395, 1);

-- --------------------------------------------------------

--
-- Table structure for table `Mentee`
--

DROP TABLE IF EXISTS `Mentee`;
CREATE TABLE IF NOT EXISTS `Mentee` (
  `StudentID` int(9) NOT NULL,
  `State` varchar(20) NOT NULL,
  `Major` varchar(250) NOT NULL,
  `Minor` varchar(250) NOT NULL,
  `Eatery` varchar(250) NOT NULL,
  `Hobbies` varchar(250) NOT NULL,
  `Location` varchar(250) NOT NULL,
  `Dorm` varchar(250) NOT NULL,
  `AdviceType` varchar(250) NOT NULL,
  PRIMARY KEY (`StudentID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Mentee`
--

INSERT INTO `Mentee` (`StudentID`, `State`, `Major`, `Minor`, `Eatery`, `Hobbies`, `Location`, `Dorm`, `AdviceType`) VALUES
(905954395, 'Virginia', 'Business Information Technology', 'Other (College of Engineering, College of Science, etc.)', 'D2', 'Art', 'Drillfield', 'Slusher Hall', 'Academic');

-- --------------------------------------------------------

--
-- Table structure for table `Mentor`
--

DROP TABLE IF EXISTS `Mentor`;
CREATE TABLE IF NOT EXISTS `Mentor` (
  `StudentID` int(11) NOT NULL,
  `State` varchar(20) NOT NULL,
  `Major` varchar(250) NOT NULL,
  `Minor` varchar(250) NOT NULL,
  `Eatery` varchar(250) NOT NULL,
  `Hobbies` varchar(250) NOT NULL,
  `Location` varchar(250) NOT NULL,
  `Dorm` varchar(250) NOT NULL,
  `AdviceType` varchar(250) NOT NULL,
  PRIMARY KEY (`StudentID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Mentor`
--

INSERT INTO `Mentor` (`StudentID`, `State`, `Major`, `Minor`, `Eatery`, `Hobbies`, `Location`, `Dorm`, `AdviceType`) VALUES
(905922183, 'Virginia', 'Business Information Technology', 'Other (College of Engineering, College of Science, etc.)', 'D2', 'Art', 'Drillfield', 'Vawter Hall', 'Academic');

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

DROP TABLE IF EXISTS `User`;
CREATE TABLE IF NOT EXISTS `User` (
  `StudentID` int(11) NOT NULL,
  `Email` varchar(250) NOT NULL,
  `PID` varchar(250) NOT NULL,
  `FirstName` varchar(250) NOT NULL,
  `MiddleName` varchar(250) DEFAULT NULL,
  `LastName` varchar(250) NOT NULL,
  `Nickname` varchar(250) DEFAULT NULL,
  `Gender` varchar(30) NOT NULL,
  `DOB` date NOT NULL,
  `Grade` varchar(10) NOT NULL,
  `Password` varchar(250) NOT NULL,
  PRIMARY KEY (`StudentID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`StudentID`, `Email`, `PID`, `FirstName`, `MiddleName`, `LastName`, `Nickname`, `Gender`, `DOB`, `Grade`, `Password`) VALUES
(905922183, 'purnima@vt.edu', 'purnima', 'Purnima', 'Bhargava', 'Ghosh', NULL, 'Female', '1997-02-09', 'Senior', 'pghosh1'),
(905954395, 'armon24@vt.edu', 'armon24', 'Armon', 'Sharif', 'Tawakalzada', 'Arms', 'Male', '1997-08-04', 'Senior', 'armon123');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Matches`
--
ALTER TABLE `Matches`
  ADD CONSTRAINT `MatchFK` FOREIGN KEY (`MentorID`) REFERENCES `Mentor` (`StudentID`),
  ADD CONSTRAINT `MentorFK` FOREIGN KEY (`MenteeID`) REFERENCES `Mentee` (`StudentID`);

--
-- Constraints for table `Mentee`
--
ALTER TABLE `Mentee`
  ADD CONSTRAINT `UserMentee` FOREIGN KEY (`StudentID`) REFERENCES `User` (`StudentID`);

--
-- Constraints for table `Mentor`
--
ALTER TABLE `Mentor`
  ADD CONSTRAINT `UserMentor` FOREIGN KEY (`StudentID`) REFERENCES `User` (`StudentID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
