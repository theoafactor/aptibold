-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 04, 2022 at 07:29 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mocks`
--

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `SNO` int(11) NOT NULL,
  `QuestionAuthor` enum('Aadhan','Aditya Krishnan','Aditya Rajan','Aishwarya','Aishwarya Sreenivasan','Akshara','Aparrajitha','Chandrashekhar','Gopika','Harini','Harshavardhini','Lekha','Mahima','Mavresh','Meer','Pooja','Ragini','Sharon') CHARACTER SET utf8 NOT NULL,
  `QuestionText` text CHARACTER SET utf8 NOT NULL,
  `QuestionTopic` enum('CORE','PROGRAMMING','VERBAL ABILITY','QUANTITATIVE ABILITY') CHARACTER SET utf8 NOT NULL,
  `CoreDept` enum('AUT','BIO','CHE','CIV','MEC','ECE','EEE','CSE','INT') CHARACTER SET utf8 NOT NULL,
  `OptA` text CHARACTER SET utf8 DEFAULT NULL,
  `OptB` text CHARACTER SET utf8 DEFAULT NULL,
  `OptC` text CHARACTER SET utf8 DEFAULT NULL,
  `OptD` text CHARACTER SET utf8 DEFAULT NULL,
  `CorrectOpt` enum('A','B','C','D') CHARACTER SET utf8 NOT NULL,
  `Picture` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT 'NONE'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Table structure for table `scores`
--

CREATE TABLE `scores` (
  `SNO` int(11) NOT NULL,
  `reg_no` varchar(12) NOT NULL,
  `sec_1` int(11) NOT NULL,
  `sec_2` int(11) NOT NULL,
  `sec_3` int(11) NOT NULL,
  `sec_4` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `SNO` int(11) NOT NULL,
  `reg_no` varchar(12) NOT NULL,
  `name` varchar(255) NOT NULL,
  `dept` enum('AUT','BIO','CHE','CIV','CSE','ECE','EEE','INT','MEC') NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`SNO`);

--
-- Indexes for table `scores`
--
ALTER TABLE `scores`
  ADD PRIMARY KEY (`SNO`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`SNO`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `SNO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=271;

--
-- AUTO_INCREMENT for table `scores`
--
ALTER TABLE `scores`
  MODIFY `SNO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6885;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `SNO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7504;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
