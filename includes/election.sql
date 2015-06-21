-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 10, 2015 at 01:07 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `election`
--

-- --------------------------------------------------------

--
-- Table structure for table `candidates`
--

CREATE TABLE IF NOT EXISTS `candidates` (
  `CandidateID` int(3) NOT NULL AUTO_INCREMENT,
  `Fname` varchar(30) NOT NULL,
  `Lname` varchar(30) NOT NULL,
  `Gender` varchar(6) NOT NULL,
  `PortfolioID` int(3) NOT NULL,
  `HallID` int(3) NOT NULL,
  `Date` date NOT NULL,
  PRIMARY KEY (`CandidateID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `counterall`
--

CREATE TABLE IF NOT EXISTS `counterall` (
  `counterAllID` int(3) unsigned NOT NULL AUTO_INCREMENT,
  `TotalVoters` int(6) NOT NULL,
  `TotalVerifiedVoters` int(6) NOT NULL,
  `TotalVotesCast` int(6) NOT NULL,
  `TotalRejectedVotes` int(6) NOT NULL,
  `RigAttempt` int(6) NOT NULL,
  `Date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`counterAllID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `countercandidates`
--

CREATE TABLE IF NOT EXISTS `countercandidates` (
  `CountCandID` int(3) unsigned NOT NULL AUTO_INCREMENT,
  `CandidateID` int(3) NOT NULL,
  `VotesObtained` int(6) NOT NULL,
  `VotesPercentage` int(3) NOT NULL,
  PRIMARY KEY (`CountCandID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `hall`
--

CREATE TABLE IF NOT EXISTS `hall` (
  `HallID` int(3) unsigned NOT NULL AUTO_INCREMENT,
  `HallName` varchar(40) NOT NULL,
  PRIMARY KEY (`HallID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `portfolios`
--

CREATE TABLE IF NOT EXISTS `portfolios` (
  `PortfolioID` int(3) unsigned NOT NULL AUTO_INCREMENT,
  `Pname` varchar(40) NOT NULL,
  `PtotalVotes` int(6) NOT NULL,
  PRIMARY KEY (`PortfolioID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `userID` int(3) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `passMD5` varchar(200) NOT NULL,
  `passSHA1` varchar(200) NOT NULL,
  `userType` varchar(30) NOT NULL,
  `dateCreated` datetime NOT NULL,
  `lastLogin` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `voters`
--

CREATE TABLE IF NOT EXISTS `voters` (
  `VoterID` int(4) NOT NULL AUTO_INCREMENT,
  `Fname` varchar(30) NOT NULL,
  `Lname` varchar(30) NOT NULL,
  `IndexNo` varchar(15) NOT NULL,
  `Gender` varchar(6) NOT NULL,
  `VerificationStatus` varchar(15) NOT NULL,
  `VoteStatus` varchar(10) NOT NULL,
  `HallID` int(3) NOT NULL,
  PRIMARY KEY (`VoterID`),
  UNIQUE KEY `IndexNo` (`IndexNo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
