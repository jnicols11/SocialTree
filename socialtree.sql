-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 01, 2021 at 06:14 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `socialtree`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `FIRSTNAME` varchar(30) NOT NULL,
  `LASTNAME` varchar(50) NOT NULL,
  `EMAIL` varchar(100) NOT NULL,
  `NUMBER` varchar(12) NOT NULL,
  `PASSWORD` varchar(100) NOT NULL,
  `LOCATION` varchar(100) DEFAULT NULL,
  `BIO` varchar(256) DEFAULT NULL,
  `PICTURE` varchar(256) DEFAULT NULL,
  `ADMIN` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `FIRSTNAME`, `LASTNAME`, `EMAIL`, `NUMBER`, `PASSWORD`, `LOCATION`, `BIO`, `PICTURE`, `ADMIN`) VALUES
(11, 'Jordan', 'Nicols', 'nicolsj99@gmail.com', '951-847-1268', 'password', 'Tucson, Az', 'I am a Full Stack Developer who is currently looking to build a career in software development.', '', 1),
(12, 'Shaylah', 'Trimmings', 'johnsmith@email.com', '123-123-1234', 'password', 'Egypt', 'Real Estate Agent and Property manager looking to build a house', '', 0),
(13, 'Dylan', 'Kalyteros', 'dylanraymond00@gmail.com', '012-123-1234', 'password', 'Phoenix, Az', 'Just a guy playing some valorant', '', 0),
(14, 'John', 'Doe', 'johndoe@email.com', '122-123-4212', 'password', NULL, NULL, NULL, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
