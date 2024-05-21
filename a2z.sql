-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2024 at 07:31 PM
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
-- Database: `a2z`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `categorie_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `categorie_name`) VALUES
(1, 'Production'),
(2, 'Law and Government'),
(3, 'Office'),
(4, 'Marketings');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `job_title` varchar(255) NOT NULL,
  `qualification_id` int(10) NOT NULL,
  `description` text NOT NULL,
  `categorie_id` int(10) NOT NULL,
  `place_of_work` varchar(255) NOT NULL,
  `hours` varchar(50) NOT NULL,
  `salary` varchar(50) NOT NULL,
  `created_on` date NOT NULL,
  `modified_on` date DEFAULT NULL,
  `status` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `user_id`, `job_title`, `qualification_id`, `description`, `categorie_id`, `place_of_work`, `hours`, `salary`, `created_on`, `modified_on`, `status`) VALUES
(13, 1, 'Marketer', 1, 'When employers look for a new employee, they usually want to make sure that the person they hire is qualified for the specific requirements of the job. For this reason, you may often find that job listings include a list of qualifications they want the person they hire to have. You can also build your qualifications into your standard cover letter and resume so it\'s easiest for employers to determine your best qualities. In this article, we discuss types of qualifications, provide examples of qualifications and explain how to use experience instead of qualifications to apply for a job.', 3, 'Mondsee', '20', '1500€', '2024-04-20', '2024-04-20', 'Visible'),
(17, 1, 'WebDev Junior', 1, 'Alin 123', 3, 'Mondsee', '40', '2600', '2024-05-20', '2024-05-20', 'Visible'),
(18, 1, 'Marketer', 1, 'Alin 456', 3, 'Thalgau', '22', '1200', '2024-05-20', NULL, 'Visible'),
(20, 1, 'WebDev Senior', 1, 'Zaaaa', 2, 'Mondsee', '20', '2500', '2024-05-21', '2024-05-21', 'Visible'),
(21, 2, 'Kelner', 2, 'asdasd', 1, 'Thalgau', '20', '1500€', '2024-05-21', NULL, 'Visible'),
(22, 1, 'Marketer', 1, 'asd', 2, 'Mondsee', '40', '2600', '2024-05-21', '2024-05-21', 'Hidden');

-- --------------------------------------------------------

--
-- Table structure for table `job_categories`
--

CREATE TABLE `job_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `job_id` int(10) UNSIGNED NOT NULL,
  `categories_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `qualifications`
--

CREATE TABLE `qualifications` (
  `id` int(10) UNSIGNED NOT NULL,
  `qualification_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `qualifications`
--

INSERT INTO `qualifications` (`id`, `qualification_name`) VALUES
(1, 'Full-Time'),
(2, 'Part-Time'),
(3, 'Contract'),
(4, 'Temporary');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firm` varchar(255) NOT NULL,
  `admin` int(1) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `first_name`, `last_name`, `email`, `password`, `firm`, `admin`) VALUES
(1, 'Alin', 'Nedelcu', 'nedelcu.alin@gmail.com', '$2y$10$X3fcTRXus/r8DOoEQ61ZE.KPk.Qgp7LtWvsgJy7pg/VZ/uyO0ztNu', 'Administrator', 1),
(2, 'Yana', 'Sushko', 'sushko.yana@gmail.com', '$2y$10$X3fcTRXus/r8DOoEQ61ZE.KPk.Qgp7LtWvsgJy7pg/VZ/uyO0ztNu', 'Hörmann', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `job_categories`
--
ALTER TABLE `job_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `job_id` (`job_id`),
  ADD KEY `categories_id` (`categories_id`);

--
-- Indexes for table `qualifications`
--
ALTER TABLE `qualifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `job_categories`
--
ALTER TABLE `job_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `qualifications`
--
ALTER TABLE `qualifications`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `jobs`
--
ALTER TABLE `jobs`
  ADD CONSTRAINT `cascade_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `job_categories`
--
ALTER TABLE `job_categories`
  ADD CONSTRAINT `cascade_categories_id` FOREIGN KEY (`categories_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cascade_job_id` FOREIGN KEY (`job_id`) REFERENCES `jobs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
