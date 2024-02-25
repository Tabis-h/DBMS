-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 25, 2024 at 03:24 PM
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
-- Database: `signup_page`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin@123');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `c_id` int(11) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `fee` decimal(10,2) DEFAULT 0.00,
  `course_length` varchar(50) DEFAULT NULL,
  `timing` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`c_id`, `course_name`, `fee`, `course_length`, `timing`) VALUES
(9, 'Car Driving package 1', 8000.00, '45 days', '2-5 pm'),
(12, 'Car Driving package 3', 4000.00, '5 months', '10 am - 12 pm'),
(14, 'Car Driving package 2', 6000.00, '3 months', '2-5 pm'),
(16, 'Sedan Driving Course (6 weeks)', 8000.00, '45 days', '08am-12am  ');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `emp_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `course_hand` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`emp_id`, `name`, `email`, `course_hand`) VALUES
(1, 'goook', 'hsksdb', 'package 1');

-- --------------------------------------------------------

--
-- Table structure for table `employee_course_assignment`
--

CREATE TABLE `employee_course_assignment` (
  `emp_id` int(11) NOT NULL,
  `emp_name` varchar(20) NOT NULL,
  `c_id` int(11) NOT NULL,
  `course_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee_course_assignment`
--

INSERT INTO `employee_course_assignment` (`emp_id`, `emp_name`, `c_id`, `course_name`) VALUES
(1, 'goook', 9, 'Car Driving package ');

-- --------------------------------------------------------

--
-- Table structure for table `employee_logins`
--

CREATE TABLE `employee_logins` (
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee_logins`
--

INSERT INTO `employee_logins` (`username`, `password`) VALUES
('emp', '123emp');

-- --------------------------------------------------------

--
-- Table structure for table `employee_student_assignment`
--

CREATE TABLE `employee_student_assignment` (
  `id` int(11) NOT NULL,
  `emp_id` int(11) DEFAULT NULL,
  `enr_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee_student_assignment`
--

INSERT INTO `employee_student_assignment` (`id`, `emp_id`, `enr_id`) VALUES
(7, 1, 19);

-- --------------------------------------------------------

--
-- Table structure for table `enrollment_data`
--

CREATE TABLE `enrollment_data` (
  `enr_id` int(11) NOT NULL,
  `user_id` int(10) NOT NULL,
  `course` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `submission_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `paid_fee` int(4) DEFAULT NULL,
  `assigned_employee_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enrollment_data`
--

INSERT INTO `enrollment_data` (`enr_id`, `user_id`, `course`, `fullname`, `email`, `phone`, `submission_date`, `paid_fee`, `assigned_employee_id`) VALUES
(19, 13, 'Car Driving package 1', 'tabish subedar', '123@gmail.com', '9880', '2024-02-24 13:57:21', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `registration_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `email`, `password`, `phone`, `age`, `gender`, `registration_date`) VALUES
(11, 'abdu', 'kugui', 'jhfyu@hjgf.com', '1234567890', '1236547890', 18, 'female', '2024-02-06 23:00:58'),
(12, 'ADNAN', 'PATEL', 'PATELADNAN557@GMAIL.COM', '123', '123', 20, 'male', '2024-02-19 23:06:46'),
(13, 'tabis', 'subedar', '123@gmail.com', '123', '9880', 19, 'male', '2024-02-24 19:26:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`c_id`),
  ADD UNIQUE KEY `course_name` (`course_name`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`emp_id`);

--
-- Indexes for table `employee_logins`
--
ALTER TABLE `employee_logins`
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `employee_student_assignment`
--
ALTER TABLE `employee_student_assignment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `emp_id` (`emp_id`),
  ADD KEY `enr_id` (`enr_id`);

--
-- Indexes for table `enrollment_data`
--
ALTER TABLE `enrollment_data`
  ADD PRIMARY KEY (`enr_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `emp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `employee_student_assignment`
--
ALTER TABLE `employee_student_assignment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `enrollment_data`
--
ALTER TABLE `enrollment_data`
  MODIFY `enr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employee_student_assignment`
--
ALTER TABLE `employee_student_assignment`
  ADD CONSTRAINT `employee_student_assignment_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`emp_id`),
  ADD CONSTRAINT `employee_student_assignment_ibfk_2` FOREIGN KEY (`enr_id`) REFERENCES `enrollment_data` (`enr_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
