-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 28, 2024 at 09:27 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online_store_management_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `Orders_id` int(10) NOT NULL,
  `orderDate` varchar(220) DEFAULT NULL,
  `OrderStatus` varchar(220) DEFAULT NULL,
  `OrderProduct` varchar(220) DEFAULT NULL,
  `TotalPrice` varchar(220) DEFAULT NULL,
  `PaymentMethod` varchar(220) DEFAULT NULL,
  `Users_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`Orders_id`, `orderDate`, `OrderStatus`, `OrderProduct`, `TotalPrice`, `PaymentMethod`, `Users_id`) VALUES
(3, '12/12/2001', 'male', 'banana', '12400', NULL, NULL),
(5, '12-2-2003', 'single', 'mango', '2345', 'mompay', 2),
(6, '12-11-2006', '54vbhn', 'ibiryo', '3256', 'momopay', 2),
(7, '2024-04-03', 'green', 'biscuit', '3', 'momo', 2),
(8777, '2024-04-22', 'red', 'bob', '2', 'bpr', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `Product_id` int(10) NOT NULL,
  `Name` varchar(220) DEFAULT NULL,
  `Description` varchar(220) DEFAULT NULL,
  `Price` varchar(220) DEFAULT NULL,
  `StockQuantity` varchar(220) DEFAULT NULL,
  `ProductImage` varchar(220) DEFAULT NULL,
  `SuppierInformation` varchar(220) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`Product_id`, `Name`, `Description`, `Price`, `StockQuantity`, `ProductImage`, `SuppierInformation`) VALUES
(10, 'Yvonne', 'Kigali', '5000', '23k', 'white', 'rice');

-- --------------------------------------------------------

--
-- Table structure for table `store`
--

CREATE TABLE `store` (
  `Store_id` int(10) NOT NULL,
  `Storename` varchar(220) DEFAULT NULL,
  `Storedescription` varchar(220) DEFAULT NULL,
  `Contactinformation` varchar(220) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `store`
--

INSERT INTO `store` (`Store_id`, `Storename`, `Storedescription`, `Contactinformation`) VALUES
(1, 'wwwwww', 'dddddd', NULL),
(2, 'rtyertyuu', 'vcv gfghnjk', '7778');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `Transaction_id` int(10) NOT NULL,
  `PaymentAmount` varchar(220) DEFAULT NULL,
  `PaymentDate` varchar(220) DEFAULT NULL,
  `PaymentStatus` varchar(220) DEFAULT NULL,
  `Orders_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`Transaction_id`, `PaymentAmount`, `PaymentDate`, `PaymentStatus`, `Orders_id`) VALUES
(4, '3500', '2-4-2021', 'payee', NULL),
(5, '15000', '6-9-2009', 'pay', NULL),
(6, '6', '2024-04-22', 'mugeni', 6);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `creationdate` timestamp NOT NULL DEFAULT current_timestamp(),
  `activation_code` varchar(50) DEFAULT NULL,
  `is_activated` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `username`, `gender`, `email`, `telephone`, `password`, `creationdate`, `activation_code`, `is_activated`) VALUES
(1, 'betty', 'uwera', 'uwerab', 'female', 'betuwer@gmail.com', '07895555555', '$2y$10$.qQ95aNcQNuN3zf/5GUN4e58oicngls3utZY8JxdVcDRFqg8AvxKK', '2024-04-18 06:11:46', '777666', 0),
(2, 'maniraguha', 'daniel', 'danmaniraguha', 'male', 'mandan@gmail.com', '07231122234', '$2y$10$p02WI5XGbGql/ApVXwThSeHRKlAXtX2DyKQPdGhCIKrjTDnxED2T2', '2024-04-18 06:14:59', '554433', 0),
(3, 'cecile', 'iradukunda', 'ceiradukunda', 'female', 'iracecile@gmail.com', '07899999', '$2y$10$8A8vkLrdGs2GT/LbXZghVeja6OOpEDgkHCOLGsRObROgS9jyNqVba', '2024-04-19 07:55:07', '11', 0),
(4, 'Mayike', 'rwanda', 'marwanda', 'male', 'mayrwanda@gmail.com', '07899999999', '$2y$10$iTZrggYL7l2djBv2pZh6t.DLf1BvxHo47rHm1smd9ss4gEu9fK/u2', '2024-04-20 09:33:20', '777', 0),
(5, 'sam', 'niyo', 'yimaniragena@gmail.com', 'male', 'nisamu@gmail.com', '0788201441', '$2y$10$AiTHAIzobVPPYL1I6p.sV.u3dtdK/ewWASBWmO6TMx/DN9o6OHULq', '2024-04-24 14:59:48', '123', 0),
(9, 'cecile', 'umwiza', 'umwiza@12', 'male', 'umwiza@gmail.com', '0792403317', '$2y$10$mef9by54YdOypRX6NbTO..k6kZ2Xbq4n.E84RKyhN9p/OzufOuJjq', '2024-04-24 16:54:48', '900', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `Users_id` int(10) NOT NULL,
  `Username` varchar(220) DEFAULT NULL,
  `Password` varchar(220) DEFAULT NULL,
  `Email` varchar(220) DEFAULT NULL,
  `Phonenumber` varchar(220) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Users_id`, `Username`, `Password`, `Email`, `Phonenumber`) VALUES
(2, 'Manzi', '1234', 'manzi@gmail.com', '078907777');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`Orders_id`),
  ADD KEY `Users_id` (`Users_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`Product_id`);

--
-- Indexes for table `store`
--
ALTER TABLE `store`
  ADD PRIMARY KEY (`Store_id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`Transaction_id`),
  ADD KEY `Orders_id` (`Orders_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Users_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `Orders_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8778;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `Product_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `store`
--
ALTER TABLE `store`
  MODIFY `Store_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34573;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `Transaction_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `Users_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`Users_id`) REFERENCES `users` (`Users_id`);

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`Orders_id`) REFERENCES `orders` (`Orders_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
