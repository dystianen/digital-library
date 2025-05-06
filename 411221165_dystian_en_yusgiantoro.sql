-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 06, 2025 at 04:24 AM
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
-- Database: `411221165_dystian_en_yusgiantoro`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `book_id` int(11) NOT NULL,
  `isbn` varchar(20) NOT NULL,
  `title` varchar(150) NOT NULL,
  `author` varchar(100) NOT NULL,
  `year_published` year(4) NOT NULL,
  `quantity_available` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`book_id`, `isbn`, `title`, `author`, `year_published`, `quantity_available`, `created_at`) VALUES
(1, '978-3-0000000001', 'The Art of Programming', 'Donald Knuth', '1968', 5, '2025-05-05 19:23:45'),
(2, '978-3-0000000002', 'Clean Code', 'Robert C. Martin', '2008', 3, '2025-05-05 19:23:45'),
(3, '978-3-0000000003', 'Design Patterns', 'Erich Gamma', '1994', 2, '2025-05-05 19:23:45'),
(4, '978-3-0000000004', 'Refactoring', 'Martin Fowler', '1999', 4, '2025-05-05 19:23:45'),
(5, '978-3-0000000005', 'You Don’t Know JS', 'Kyle Simpson', '2015', 6, '2025-05-05 19:23:45'),
(6, '978-3-0000000006', 'Eloquent JavaScript', 'Marijn Haverbeke', '2018', 5, '2025-05-05 19:23:45'),
(7, '978-3-0000000007', 'Introduction to Algorithms', 'Thomas H. Cormen', '2009', 3, '2025-05-05 19:23:45'),
(8, '978-3-0000000008', 'The Pragmatic Programmer', 'Andy Hunt', '1999', 4, '2025-05-05 19:23:45'),
(9, '978-3-0000000009', 'Code Complete', 'Steve McConnell', '2004', 2, '2025-05-05 19:23:45'),
(10, '978-3-0000000010', 'The Mythical Man-Month', 'Fred Brooks', '1975', 1, '2025-05-05 19:23:45'),
(11, '978-3-0000000011', 'Working Effectively with Legacy Code', 'Michael Feathers', '2005', 6, '2025-05-05 19:23:45'),
(12, '978-3-0000000012', 'Don\'t Make Me Think', 'Steve Krug', '2000', 4, '2025-05-05 19:23:45'),
(13, '978-3-0000000013', 'Cracking the Coding Interview', 'Gayle Laakmann McDowell', '2015', 3, '2025-05-05 19:23:45'),
(14, '978-3-0000000014', 'Soft Skills: The Software Developer’s Life Manual', 'John Sonmez', '2014', 2, '2025-05-05 19:23:45'),
(15, '978-3-0000000015', 'Domain-Driven Design', 'Eric Evans', '2003', 3, '2025-05-05 19:23:45'),
(16, '978-3-0000000016', 'The Phoenix Project', 'Gene Kim', '2013', 5, '2025-05-05 19:23:45');

-- --------------------------------------------------------

--
-- Table structure for table `borrowings`
--

CREATE TABLE `borrowings` (
  `borrowing_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `borrow_date` date NOT NULL,
  `return_date` date DEFAULT NULL,
  `status` enum('borrowed','returned') NOT NULL DEFAULT 'borrowed'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `member_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `role` enum('admin','member') NOT NULL DEFAULT 'member',
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`member_id`, `username`, `password_hash`, `full_name`, `role`, `status`, `created_at`) VALUES
(1, 'admin', '$2y$10$p59jOqqWowivfqGfxTXg7eaYPiTfMPFp4jTdAYlMf0XoybJyqsKcq', 'Administrator', 'admin', 'active', '2025-05-05 19:23:45'),
(2, 'tian', '$2y$10$ZnX5x0fTUVN6Bwg4WxIVW.zPLq3k40Y1opIaQJ/9TMHzChH9e88fK', 'Dystian En', 'member', 'active', '2025-05-05 19:23:45');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(10, '2025-05-05-094524', 'App\\Database\\Migrations\\Members', 'default', 'App', 1746498215, 1),
(11, '2025-05-05-094530', 'App\\Database\\Migrations\\Books', 'default', 'App', 1746498215, 1),
(12, '2025-05-05-094537', 'App\\Database\\Migrations\\Borrowings', 'default', 'App', 1746498215, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`book_id`);

--
-- Indexes for table `borrowings`
--
ALTER TABLE `borrowings`
  ADD PRIMARY KEY (`borrowing_id`),
  ADD KEY `borrowings_member_id_foreign` (`member_id`),
  ADD KEY `borrowings_book_id_foreign` (`book_id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`member_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `borrowings`
--
ALTER TABLE `borrowings`
  MODIFY `borrowing_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `borrowings`
--
ALTER TABLE `borrowings`
  ADD CONSTRAINT `borrowings_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`),
  ADD CONSTRAINT `borrowings_member_id_foreign` FOREIGN KEY (`member_id`) REFERENCES `members` (`member_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
