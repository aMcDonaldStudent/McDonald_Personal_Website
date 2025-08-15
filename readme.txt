# This project is essentially a PHP + Apache + MySQL Login System with MVC architecture.

# This auto-runs with Apache and MySQL (Xampp control recommended) (which controls the credentials for the login system) online, no need to write in the console

# This program is essentially a PHP login website with various features
# based on whether a user is logged in as a technician or an Admin

# This project is very old and has been left for the newer Showcase website
# that I created but is slowly being patched up when I have time for it. 
# It is primarily here to demonstrate background with tools, languages and concepts such as:
- MySQL
- Apache
- PHP.
- MVC Architecture

# To create the MySQL architecture for this, run this to generate the credential tables:
///////////////////////////////////////////////////////////////////////////////
-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 15, 2025 at 10:22 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sdc342_wk5final`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserNo` int(11) NOT NULL,
  `UserId` varchar(12) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `HireDate` date NOT NULL,
  `EMail` varchar(50) NOT NULL,
  `Extension` int(5) NOT NULL,
  `UserLevelNo` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserNo`, `UserId`, `Password`, `FirstName`, `LastName`, `HireDate`, `EMail`, `Extension`, `UserLevelNo`) VALUES
(1, 'LS11775', 'Pw1$', 'Sybil', 'Ludington', '1761-04-05', 'rode2@revere.com', 11775, 2),
(2, 'LR01010', 'Pw1$', 'Rasmus', 'Lerdorf', '1968-11-22', 'creator@php.com', 1010, 1),
(3, 'JP28426', 'Pw1$', 'Percy', 'Julian', '1899-04-11', 'pj@nas.org', 28426, 2),
(4, 'BR21212', 'Pw1$', 'Roy G.', 'Biv', '1899-04-11', 'rainbow@colors.org', 21212, 2),
(5, 'WE11919', 'Pw1$', 'Edith', 'Wilson', '1872-10-15', 'temp_pres@whitehouse.gov', 11918, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserNo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
