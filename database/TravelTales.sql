-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 11, 2024 at 08:09 AM
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
-- Database: `TravelTales`
--

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE `activities` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `activity` varchar(255) DEFAULT NULL,
  `activity_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `flight` varchar(100) NOT NULL,
  `travel_date` date NOT NULL,
  `passengers` int(11) NOT NULL,
  `booking_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `name`, `email`, `phone`, `flight`, `travel_date`, `passengers`, `booking_date`) VALUES
(1, 'vanshika salekar', 'xyz@example.com', '8980989878', 'New York to London', '2024-09-06', 1, '2024-09-05 17:28:45'),
(2, 'example1', 'example1@example.com', '8980989878', 'Sydney to Dubai', '2024-09-26', 3, '2024-09-05 17:31:10'),
(3, 'example2', 'example2@example.com', '8980989878', 'Tokyo to Paris', '2024-09-15', 7, '2024-09-05 17:32:59'),
(4, 'example3', 'example3@example.com', '8980989878', 'Los Angeles to Rome', '2024-10-09', 3, '2024-09-07 17:19:50');

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `name`, `email`, `message`, `created_at`) VALUES
(1, 'vanshika salekar', 'xyz@gmail.com', 'good', '2024-09-13 17:55:24'),
(4, 'example1', 'example1@gmail.com', 'good', '2024-09-14 10:37:16');

-- --------------------------------------------------------

--
-- Table structure for table `hired_guides`
--

CREATE TABLE `hired_guides` (
  `id` int(11) NOT NULL,
  `guide_name` varchar(255) NOT NULL,
  `destination` varchar(255) NOT NULL,
  `hire_date` date NOT NULL,
  `duration` int(11) NOT NULL,
  `price_per_day` decimal(10,2) NOT NULL,
  `total_price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hired_guides`
--

INSERT INTO `hired_guides` (`id`, `guide_name`, `destination`, `hire_date`, `duration`, `price_per_day`, `total_price`) VALUES
(1, 'David Kim', 'New York City', '2024-09-10', 1, 7550.00, 7550.00),
(2, 'John Doe', 'New York City', '2024-09-10', 4, 8390.00, 33560.00);

-- --------------------------------------------------------

--
-- Table structure for table `hotel_reservations`
--

CREATE TABLE `hotel_reservations` (
  `id` int(11) NOT NULL,
  `hotel_name` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `checkin_date` date NOT NULL,
  `checkout_date` date NOT NULL,
  `guests` int(11) NOT NULL,
  `rooms` int(11) NOT NULL,
  `special_requests` text DEFAULT NULL,
  `reservation_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hotel_reservations`
--

INSERT INTO `hotel_reservations` (`id`, `hotel_name`, `name`, `email`, `phone`, `checkin_date`, `checkout_date`, `guests`, `rooms`, `special_requests`, `reservation_date`) VALUES
(1, 'The Ritz-Carlton, Paris', 'vanshika salekar', 'xyz@example.com', '8980989878', '2024-09-10', '2024-09-20', 4, 5, 'none', '2024-09-08 04:08:51');

-- --------------------------------------------------------

--
-- Table structure for table `package_bookings`
--

CREATE TABLE `package_bookings` (
  `id` int(11) NOT NULL,
  `trip_name` varchar(255) NOT NULL,
  `trip_price` decimal(10,2) NOT NULL,
  `number_of_travelers` int(11) NOT NULL,
  `booking_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `package_bookings`
--

INSERT INTO `package_bookings` (`id`, `trip_name`, `trip_price`, `number_of_travelers`, `booking_date`) VALUES
(1, 'Whitewater Rafting in Rishikesh, India', 5000.00, 2, '2024-09-13 16:49:15'),
(3, 'Paris, France', 200000.00, 2, '2024-09-13 17:37:56'),
(4, 'Venice, Italy', 180000.00, 2, '2024-09-14 10:28:28'),
(5, 'London, UK (Harry Potter Studio Tour)', 380000.00, 4, '2024-09-14 11:01:14'),
(6, 'London, UK (Harry Potter Studio Tour)', 380000.00, 1, '2024-10-01 05:43:57'),
(7, 'Athens, Greece', 230000.00, 1, '2024-10-14 05:05:58'),
(8, 'Whitewater Rafting in Rishikesh, India', 5000.00, 1, '2024-10-14 05:06:20');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `profile_picture` varchar(255) NOT NULL,
  `bio` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`, `profile_picture`, `bio`) VALUES
(45, 'Vanshika Salekar', 'vanshika682004@gmail.com', '$2y$10$SaUN8Wa82dj6dCYRLB1qLudTP/iQpi26wfFDUR52wXToOPTWOnWsy', '2024-10-15 03:15:02', 'uploads/profile_pictures/profile_45.jpg', 'Hi'),
(46, 'Example1', 'Example1@gmail.com', '$2y$10$EmaghMqzsdHvBSV0OLhF4eDPnGTGwTphgGotaN1p4VnDYY0tLT4ou', '2024-11-01 17:44:57', 'uploads/profile_pictures/profile_46.jpg', 'Hii'),
(47, 'Example2', 'Example2@gmail.com', '$2y$10$6IQxOvGGGXEgujvZXP6vhuthfKF1d4Hx.TWANUuOFEvjYR0WbXH/e', '2024-11-05 16:40:35', '', 'hi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hired_guides`
--
ALTER TABLE `hired_guides`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hotel_reservations`
--
ALTER TABLE `hotel_reservations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `package_bookings`
--
ALTER TABLE `package_bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activities`
--
ALTER TABLE `activities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `hired_guides`
--
ALTER TABLE `hired_guides`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `hotel_reservations`
--
ALTER TABLE `hotel_reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `package_bookings`
--
ALTER TABLE `package_bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
