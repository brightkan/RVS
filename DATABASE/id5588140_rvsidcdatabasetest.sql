-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 04, 2018 at 09:51 PM
-- Server version: 10.2.12-MariaDB
-- PHP Version: 7.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id5588140_rvsidcdatabasetest`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `name` varchar(15) NOT NULL,
  `username` varchar(15) NOT NULL,
  `id` varchar(15) NOT NULL,
  `password` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`name`, `username`, `id`, `password`) VALUES
('Bright Kanyange', 'brightk', '215004544', 'javac');

-- --------------------------------------------------------

--
-- Table structure for table `ballot`
--

CREATE TABLE `ballot` (
  `ballot_id` int(6) NOT NULL,
  `grc` varchar(4) NOT NULL,
  `president` int(4) NOT NULL,
  `secretary` int(4) NOT NULL,
  `constitutional_affairs` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ballot`
--

INSERT INTO `ballot` (`ballot_id`, `grc`, `president`, `secretary`, `constitutional_affairs`) VALUES
(81, '20', 24, 26, 28),
(82, '21', 25, 26, 28),
(83, '20', 24, 26, 28),
(84, '20', 24, 26, 28),
(85, '20', 24, 26, 28),
(86, '20', 24, 26, 28),
(87, '20', 24, 26, 28),
(88, '20', 24, 27, 29),
(89, '20', 24, 27, 29),
(90, '21', 24, 27, 29),
(91, '20', 24, 27, 28),
(92, '21', 24, 26, 28),
(93, '21', 25, 27, 28),
(94, '20', 24, 26, 28),
(95, '20', 24, 26, 28),
(96, '20', 24, 26, 28);

-- --------------------------------------------------------

--
-- Table structure for table `candidate`
--

CREATE TABLE `candidate` (
  `name` varchar(25) NOT NULL,
  `position` varchar(25) NOT NULL,
  `nomination_form_no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `candidate`
--

INSERT INTO `candidate` (`name`, `position`, `nomination_form_no`) VALUES
('Javiira Matovu', 'grc', 20),
('Bright Kanyange', 'grc', 21),
('Mutebi Ibrahim', 'president', 24),
('Uwezo Gilbert', 'president', 25),
('Nakitende Joan', 'secretary', 26),
('Nalumu Angel', 'secretary', 27),
('Owamani Herbert', 'constitutional_affairs', 28),
('Kikabi Elvis', 'constitutional_affairs', 29),
('Uwayezu Joseph Gilbert', 'grc', 123456);

-- --------------------------------------------------------

--
-- Table structure for table `voter`
--

CREATE TABLE `voter` (
  `firstname` varchar(15) NOT NULL,
  `lastname` varchar(15) NOT NULL,
  `id` int(11) NOT NULL,
  `username` varchar(15) NOT NULL,
  `programofstudy` varchar(15) NOT NULL,
  `college` varchar(15) NOT NULL,
  `password` varchar(15) NOT NULL,
  `voter_status` varchar(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `voter`
--

INSERT INTO `voter` (`firstname`, `lastname`, `id`, `username`, `programofstudy`, `college`, `password`, `voter_status`) VALUES
('John', 'Musaazi', 210000888, 'Johnm', 'BIS', 'COCIS', 'helloworld', NULL),
('John', 'Kateebe', 210000934, 'jk', 'BIS', 'COCIS', 'Already', NULL),
('MUTEBI', 'IBRAHIM', 215003400, 'HK', 'BIS', 'COCIS', '215003400', ''),
('John', 'Kisambira', 215004344, 'johnk', 'BIS', 'COCIS', 'HELLOWORLD', NULL),
('Bright', 'Kanyange', 215004544, 'brightk', '', 'Scit', 'helloworld', 'yes'),
('odongo', 'hallan', 215009214, 'hallanc', 'BIS', 'COCIS', 'allancharles123', 'yes'),
('Joseph Gilbert', 'Uwayezu', 215017228, 'Uwayezu', 'BIS', 'COCIS', '123456789', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ballot`
--
ALTER TABLE `ballot`
  ADD PRIMARY KEY (`ballot_id`);

--
-- Indexes for table `candidate`
--
ALTER TABLE `candidate`
  ADD PRIMARY KEY (`nomination_form_no`);

--
-- Indexes for table `voter`
--
ALTER TABLE `voter`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ballot`
--
ALTER TABLE `ballot`
  MODIFY `ballot_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `candidate`
--
ALTER TABLE `candidate`
  MODIFY `nomination_form_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123457;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
