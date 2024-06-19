-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2022 at 09:36 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `khharcha`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(5) NOT NULL,
  `user_id` int(5) NOT NULL,
  `category` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `user_id`, `category`) VALUES
(3, 18, 'Bill'),
(10, 18, 'Travel'),
(11, 19, 'Movie'),
(12, 18, 'Movie'),
(13, 18, 'Music'),
(14, 25, 'Trial'),
(15, 25, 'Movie');

-- --------------------------------------------------------

--
-- Table structure for table `expense`
--

CREATE TABLE `expense` (
  `expense_id` int(4) NOT NULL,
  `user_id` int(5) NOT NULL,
  `category` varchar(30) NOT NULL,
  `expense` float NOT NULL,
  `date` date NOT NULL,
  `description` varchar(50) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `expense`
--

INSERT INTO `expense` (`expense_id`, `user_id`, `category`, `expense`, `date`, `description`, `image`) VALUES
(2, 18, 'food', 1000, '2022-11-02', 'm', ''),
(3, 18, 'food', 1000, '2022-11-02', 'try', ''),
(6, 18, 'entertaintment', 1000, '2022-11-01', 'try', ''),
(9, 18, 'health', 2000, '2022-11-01', '', ''),
(10, 18, 'Medicine', 500, '2022-11-04', '', ''),
(11, 18, 'Others', 500, '2022-11-02', 'This is just a trial', ''),
(12, 18, 'Bill', 500, '2022-11-04', '', ''),
(14, 18, 'Clothing', 1000, '2022-11-05', '1000 clothing', ''),
(16, 19, 'Movie', 175, '2022-11-07', 'Ticket For - Black Panther', ''),
(18, 19, 'Clothing', 100, '2022-11-07', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', ''),
(19, 18, 'Bill', 1000, '2022-11-08', 'Trial', ''),
(20, 18, 'Entertainment', 1266, '2022-11-08', '', ''),
(21, 18, 'Education', 1500, '2022-11-08', '', ''),
(25, 18, 'Medicine', 400, '2022-11-09', '', 'default_profile.png'),
(26, 18, 'Food', 50, '2022-11-09', 'This is just a try', 'rr.jpg'),
(27, 22, 'Education', 1000, '2022-11-10', '', '64787578_694670737642394_4300864633989758976_n.jpg'),
(28, 25, 'Movie', 500, '2022-11-12', 'Ticket for black panther', '64494135_694677420975059_5952433916131409920_n.jpg'),
(29, 25, 'Movie', 500, '2022-11-12', 'Trial', '64383048_694673764308758_7379478281021554688_n.jpg'),
(30, 25, 'Food', 5000, '2022-11-12', 'This', ''),
(31, 25, 'Entertainment', 10000, '2022-11-12', 'Shopping', ''),
(32, 25, 'Food', 500, '2022-11-03', '', ''),
(33, 25, 'Clothing', 4000, '2022-11-08', '', ''),
(34, 25, 'Education', 1000, '2022-11-12', '', ''),
(35, 25, 'Education', 1500, '2022-11-12', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `income`
--

CREATE TABLE `income` (
  `income_id` int(5) NOT NULL,
  `user_id` int(5) NOT NULL,
  `income` float NOT NULL,
  `date` date NOT NULL,
  `description` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `income`
--

INSERT INTO `income` (`income_id`, `user_id`, `income`, `date`, `description`) VALUES
(2, 18, 1000, '2022-11-01', 'this is a update test'),
(3, 18, 66, '2022-11-02', 'make total balance to 800'),
(4, 18, 900, '2022-11-02', 'to 900'),
(5, 18, 300, '2022-11-02', 'balance 2000\r\nincome 3000'),
(7, 18, 500, '2022-11-02', ''),
(12, 18, 1000, '2022-11-05', ''),
(14, 19, 1000, '2022-11-07', 'This is my first income'),
(15, 19, 10, '2022-11-07', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa'),
(17, 18, 4000, '2022-11-08', ''),
(18, 18, 1000, '2022-11-08', 'Check'),
(19, 18, 1000, '2022-11-08', 'This is try'),
(20, 18, 1000, '2022-11-08', ''),
(21, 18, 1500, '2022-11-08', ''),
(22, 25, 10000, '2022-11-12', 'This is a try'),
(23, 25, 200, '2022-11-11', ''),
(24, 25, 100, '2022-11-04', ''),
(25, 25, 500, '2022-11-07', ''),
(26, 25, 11000, '2022-11-12', ''),
(27, 25, 2000, '2022-11-12', ''),
(28, 25, 700, '2022-11-12', '');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(5) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(80) NOT NULL,
  `profile_path` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `first_name`, `last_name`, `email`, `password`, `profile_path`) VALUES
(18, 'r', 'j', 'r@j.com', '$2y$10$M19zXgWCdO.I0xMC35020eSoPsmL7RD7g.d.KFVV13TpS0tGkkLtK', ''),
(19, 'j', 'j', 'j@j.j', '$2y$10$M19zXgWCdO.I0xMC35020eSoPsmL7RD7g.d.KFVV13TpS0tGkkLtK', ''),
(20, 'n', 'n', 'n@n.n', '$2y$10$M19zXgWCdO.I0xMC35020eSoPsmL7RD7g.d.KFVV13TpS0tGkkLtK', ''),
(22, 'rohit', 'jalari', 'rohitjalari3@gmail.com', '$2y$10$M19zXgWCdO.I0xMC35020eSoPsmL7RD7g.d.KFVV13TpS0tGkkLtK', '51658583_2345035215754600_2326371836197076992_n.jpg'),
(25, 'n', 'm', 'rohitjalari@gmail.com', '$2y$10$pRqEjmNABjLf/oMbSy7xO.AyWaBY.3PAqzbAXEDuMk72gWEhIXzeW', 'default_profile.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `expense`
--
ALTER TABLE `expense`
  ADD PRIMARY KEY (`expense_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `income`
--
ALTER TABLE `income`
  ADD PRIMARY KEY (`income_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `expense`
--
ALTER TABLE `expense`
  MODIFY `expense_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `income`
--
ALTER TABLE `income`
  MODIFY `income_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `category_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `expense`
--
ALTER TABLE `expense`
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `income`
--
ALTER TABLE `income`
  ADD CONSTRAINT `income_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
