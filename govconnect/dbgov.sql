-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 21, 2024 at 07:24 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbgov`
--

-- --------------------------------------------------------

--
-- Table structure for table `birth`
--

CREATE TABLE `birth` (
  `name` varchar(25) NOT NULL,
  `birth` date NOT NULL,
  `contact` int(11) NOT NULL,
  `email` varchar(25) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `birth`
--

INSERT INTO `birth` (`name`, `birth`, `contact`, `email`, `status`) VALUES
('cal kestis', '2003-05-15', 2147483647, 'cal@gmail.com', '');

-- --------------------------------------------------------

--
-- Table structure for table `business`
--

CREATE TABLE `business` (
  `bname` varchar(25) NOT NULL,
  `oname` varchar(25) NOT NULL,
  `address` varchar(25) NOT NULL,
  `btype` enum('Retail','Service','Manufacturing','Food') NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `business`
--

INSERT INTO `business` (`bname`, `oname`, `address`, `btype`, `status`) VALUES
('sugarbeans', 'juan dela cruz', 'batangas', 'Food', ''),
('Tite', 'Puke', 'Malvar Batangas', 'Service', ''),
('Tite', 'Puke', 'Malvar Batangas', 'Service', ''),
('pussymeow', 'pussymeow', 'lipa', 'Food', 'Pending'),
('asd', 'asd', 'lipa', 'Food', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

CREATE TABLE `delivery` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `ID` int(255) NOT NULL,
  `Uname` varchar(255) NOT NULL,
  `Fname` varchar(255) NOT NULL,
  `Mname` varchar(255) NOT NULL,
  `Lname` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Age` int(255) NOT NULL,
  `Location` varchar(255) NOT NULL,
  `Gender` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`ID`, `Uname`, `Fname`, `Mname`, `Lname`, `Password`, `Email`, `Age`, `Location`, `Gender`) VALUES
(6, 'shutty', 'shutty', 'shut', 'manalo', 'powpow', 'river@gmail.com', 23, 'batangas', 'male'),
(7, 'peyn4', 'Albert', 'Einstein', 'Rosales', 'malaki04', 'oraytnman@gmail.com', 23, 'Malvar, Batangas', 'female'),
(8, 'asd', 'asd', 'asd', 'asd', '12345', 'asd@gmail.com', 21, 'Lipa', 'male');

-- --------------------------------------------------------

--
-- Table structure for table `voter`
--

CREATE TABLE `voter` (
  `fname` varchar(25) NOT NULL,
  `birth` date NOT NULL,
  `address` varchar(25) NOT NULL,
  `contact` int(11) NOT NULL,
  `email` varchar(25) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `voter`
--

INSERT INTO `voter` (`fname`, `birth`, `address`, `contact`, `email`, `status`) VALUES
('ronin inovejas', '2001-08-04', 'malvar, batangas', 2147483647, 'ronin@gmail.com', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `delivery`
--
ALTER TABLE `delivery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `delivery`
--
ALTER TABLE `delivery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
