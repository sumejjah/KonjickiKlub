-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 14, 2017 at 06:05 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wt_spirala4`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrator`
--

CREATE TABLE `administrator` (
  `id` int(11) NOT NULL,
  `username` varchar(30) COLLATE utf8_slovenian_ci NOT NULL,
  `password` varchar(30) COLLATE utf8_slovenian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Dumping data for table `administrator`
--

INSERT INTO `administrator` (`id`, `username`, `password`) VALUES
(1, 'admin', 'password');

-- --------------------------------------------------------

--
-- Table structure for table `anketa`
--

CREATE TABLE `anketa` (
  `id` int(11) NOT NULL,
  `pitanje1` varchar(10) COLLATE utf8_slovenian_ci NOT NULL,
  `pitanje2` varchar(10) COLLATE utf8_slovenian_ci NOT NULL,
  `pitanje3` varchar(10) COLLATE utf8_slovenian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Dumping data for table `anketa`
--

INSERT INTO `anketa` (`id`, `pitanje1`, `pitanje2`, `pitanje3`) VALUES
(1, 'Da', 'Ne', 'Da'),
(2, 'Da', 'Da', 'Da'),
(3, 'Da', 'Da', 'Ne'),
(4, 'Ne', 'Da', 'Da'),
(5, 'Da', 'Da', 'Da'),
(6, 'Da', 'Da', 'Da');

-- --------------------------------------------------------

--
-- Table structure for table `komentar`
--

CREATE TABLE `komentar` (
  `id` int(11) NOT NULL,
  `usluga` int(11) NOT NULL,
  `tekst` varchar(250) COLLATE utf8_slovenian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Dumping data for table `komentar`
--

INSERT INTO `komentar` (`id`, `usluga`, `tekst`) VALUES
(1, 1, 'Jako lijepo iskustvo. Preporucujem!'),
(2, 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
(3, 1, 'dfsdgdfgdfhfdgsdfv'),
(4, 1, 'ubi nogama hahehohh\r\n'),
(9, 7, 'ma gluho bilo dfvdfgvsdvsd');

-- --------------------------------------------------------

--
-- Table structure for table `usluga`
--

CREATE TABLE `usluga` (
  `id` int(11) NOT NULL,
  `administrator` int(11) NOT NULL,
  `naziv` varchar(30) COLLATE utf8_slovenian_ci NOT NULL,
  `trajanje` varchar(30) COLLATE utf8_slovenian_ci NOT NULL,
  `cijena` varchar(30) COLLATE utf8_slovenian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Dumping data for table `usluga`
--

INSERT INTO `usluga` (`id`, `administrator`, `naziv`, `trajanje`, `cijena`) VALUES
(1, 1, 'box', 'po dogovoru', '10KM/dan'),
(3, 1, 'jahanje sa preprekama', '1 mjesec', '70KM'),
(5, 1, 'Jahanje', '10 minuta', '3 KM'),
(6, 1, 'Jahanje', '20 minuta', '10 KM'),
(7, 1, 'Skola jahanja', '8 sedmica', '250 KM'),
(8, 1, 'Cuvanje konja', '1 godina', '1000 KM');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrator`
--
ALTER TABLE `administrator`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `anketa`
--
ALTER TABLE `anketa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `komentar`
--
ALTER TABLE `komentar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usluga` (`usluga`);

--
-- Indexes for table `usluga`
--
ALTER TABLE `usluga`
  ADD PRIMARY KEY (`id`),
  ADD KEY `administrator` (`administrator`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administrator`
--
ALTER TABLE `administrator`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `anketa`
--
ALTER TABLE `anketa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `komentar`
--
ALTER TABLE `komentar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `usluga`
--
ALTER TABLE `usluga`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `komentar`
--
ALTER TABLE `komentar`
  ADD CONSTRAINT `usluga_constrait` FOREIGN KEY (`usluga`) REFERENCES `usluga` (`id`);

--
-- Constraints for table `usluga`
--
ALTER TABLE `usluga`
  ADD CONSTRAINT `administrator_constrait` FOREIGN KEY (`administrator`) REFERENCES `administrator` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
