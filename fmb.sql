-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 04, 2015 at 09:16 AM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `fmb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `uname` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`uname`, `password`) VALUES
('admin', 'admin1234'),
('admin', 'admin1234'),
('admin', 'admin1234'),
('admin', 'admin1234');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `commentID` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `comments` varchar(100) NOT NULL,
  `complainID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`commentID`, `name`, `comments`, `complainID`) VALUES
(32, 'Claire', 'hi uy', 33),
(44, 'rhea', ' dada', 33),
(45, 'rhea', ' thanks', 35),
(46, 'claire', ' this is comment', 35),
(47, 'Clara', 'this is a comment', 36),
(48, '', ' ', 33),
(49, '', ' ', 33),
(50, '', ' ', 33),
(51, 'admin1234', 'Comment', 36),
(52, 'admin1234', 'Comment', 33),
(53, 'admin1234', ' afasdfasfas', 33),
(54, 'admin1234', ' ohlla', 37),
(55, 'rhea', ' ohlaa', 33),
(56, 'rhea', ' lapad\r\n', 33),
(57, 'mr', 'tangkag ko', 45);

-- --------------------------------------------------------

--
-- Table structure for table `complain`
--

CREATE TABLE IF NOT EXISTS `complain` (
  `complainID` int(11) NOT NULL,
  `cname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contact` varchar(11) NOT NULL,
  `location` varchar(30) NOT NULL,
  `cdate` date NOT NULL,
  `category` varchar(50) NOT NULL,
  `description` varchar(100) NOT NULL,
  `image` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `complain`
--

INSERT INTO `complain` (`complainID`, `cname`, `email`, `contact`, `location`, `cdate`, `category`, `description`, `image`) VALUES
(33, 'Rhea Geonzon', 'rheageonzon011@gmail.com', '09321159372', 'Eskina Langit', '2015-03-10', 'Garbage', 'The garbage is everywhere', 'issue2.jpg'),
(35, 'Claire De La Vina', 'clayredangs@gmail.com', '0909090909', 'Basak', '2015-03-14', 'Road', 'The road is rocky road', 'issue4.jpg'),
(36, 'Clara', 'cj_dv@rocketmail.com', '09321159372', 'guadalue', '2015-03-17', 'Road', 'The road is road', 'issue5.jpg'),
(37, 'Rhey Rhe', 'rhe@gmail.com', '09332139723', 'Basak', '2015-03-17', 'Public', 'Vandalism is everywhere', 'issue3.jpg'),
(43, 'Tim Ruz', 'tim@yahoo.com', '0932116787', 'basak', '2015-03-20', 'public', 'this is publc', 'issue6.jpg'),
(44, 'Tim Ruzy', 'tim1@yahoo.com', '09321234567', 'basak', '2015-03-20', 'garbage', 'akdhfbad', 'issue1.jpg'),
(45, 'Tim Ruz Canete', 'chra@yahoo.com', '09321234567', 'basak', '2015-03-19', 'public', 'this is disrtbance', 'issue7.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `complainant1`
--

CREATE TABLE IF NOT EXISTS `complainant1` (
  `rid` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `uname` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `complainant1`
--

INSERT INTO `complainant1` (`rid`, `fname`, `lname`, `uname`, `email`, `password`) VALUES
(1001, 'trixie', 'olpoc', 'trixie', 'trixie@yahoo.com', 'trixie'),
(1002, 'inee', 'abastas', 'inee', 'inee@yahoo.com', 'inee');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `rid` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `birthdate` date NOT NULL,
  `purok` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`rid`, `firstname`, `lastname`, `birthdate`, `purok`, `email`, `username`, `password`) VALUES
(1001, 'Trixie', 'Olpoc', '1996-06-29', '1', 'trixie@yahoo.com', 'trixie', '94e9de8dd889f40b8ad1a5412f05274392026ccec74b184fc5'),
(1002, 'Inee', 'Abastas', '2015-05-01', '2', 'inee@yahoo.com', ' inee', 'e62b53d0cfcd07df94621ccb6a4e9fcf2e75df9b2c410e92af'),
(1003, 'Claire', 'Dela vina', '2015-01-05', '4', '', '', ''),
(1004, 'Chyme', 'Yap', '2015-01-13', '5', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `complainant1`
--
ALTER TABLE `complainant1`
 ADD PRIMARY KEY (`rid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`rid`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
