-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 09, 2022 at 09:43 PM
-- Server version: 10.6.7-MariaDB-2ubuntu1.1
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webnoteapp_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `applogin`
--

CREATE TABLE `applogin` (
  `id_applogin` int(11) NOT NULL,
  `pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `applogin`
--

INSERT INTO `applogin` (`id_applogin`, `pass`) VALUES
(1, '$2y$10$5JWylt51jMdUbO6gYrGi8eE5rraMi/HdffESTMuAF1o7Ga0pdzu7O');

-- --------------------------------------------------------

--
-- Table structure for table `draft_story`
--

CREATE TABLE `draft_story` (
  `id_story` int(11) NOT NULL,
  `series_story` varchar(30) DEFAULT NULL,
  `judul_story` varchar(30) NOT NULL,
  `html_story` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `note`
--

CREATE TABLE `note` (
  `id_note` int(11) NOT NULL,
  `judul_note` varchar(30) NOT NULL,
  `html_note` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applogin`
--
ALTER TABLE `applogin`
  ADD PRIMARY KEY (`id_applogin`);

--
-- Indexes for table `draft_story`
--
ALTER TABLE `draft_story`
  ADD PRIMARY KEY (`id_story`);

--
-- Indexes for table `note`
--
ALTER TABLE `note`
  ADD PRIMARY KEY (`id_note`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applogin`
--
ALTER TABLE `applogin`
  MODIFY `id_applogin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `draft_story`
--
ALTER TABLE `draft_story`
  MODIFY `id_story` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `note`
--
ALTER TABLE `note`
  MODIFY `id_note` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
