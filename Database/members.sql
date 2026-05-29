-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 18, 2025 at 08:02 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jeffersonfong`
--

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `mid` int(5) NOT NULL,
  `username` varchar(21) NOT NULL,
  `password` varchar(31) NOT NULL,
  `phone` varchar(21) NOT NULL,
  `ancientShirt` int(5) DEFAULT 0,
  `cap` int(5) DEFAULT 0,
  `cultureShirt` int(5) DEFAULT 0,
  `poloShirt` int(5) DEFAULT 0,
  `calendar` int(5) DEFAULT 0,
  `fan` int(5) DEFAULT 0,
  `mugs` int(5) DEFAULT 0,
  `umbrella` int(5) DEFAULT 0,
  `brooch` int(5) DEFAULT 0,
  `crystal` int(5) DEFAULT 0,
  `earRings` int(5) DEFAULT 0,
  `necklace` int(5) DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`mid`, `username`, `password`, `phone`, `ancientShirt`, `cap`, `cultureShirt`, `poloShirt`, `calendar`, `fan`, `mugs`, `umbrella`, `brooch`, `crystal`, `earRings`, `necklace`) VALUES
(1, 'xiao', '1111', '12345', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
--
-- Indexes for dumped tables
--

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`mid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `mid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
