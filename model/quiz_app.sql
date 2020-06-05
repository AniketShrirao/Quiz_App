-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 05, 2020 at 05:59 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quiz_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `answer_id` int(11) NOT NULL,
  `answer` text NOT NULL,
  `question_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`answer_id`, `answer`, `question_id`) VALUES
(1, 'Application', 1),
(2, 'Scripting', 1),
(3, 'Programming', 1),
(4, 'None of these', 1),
(5, 'font', 2),
(6, 'style', 2),
(7, 'class', 2),
(8, 'styles', 2),
(9, 'Colorful Style Sheets', 3),
(10, 'Computer Style Sheets', 3),
(11, 'Creative Style Sheets', 3),
(12, 'Cascading Style Sheets', 3),
(13, 'W3C', 4),
(14, 'Mozilla', 4),
(15, 'Microsoft', 4),
(16, 'Google', 4),
(17, 'Browser', 5),
(18, 'Server', 5),
(19, 'ISP', 5),
(20, 'None of these', 5),
(21, '&lt;background&gt;yellow&lt;/background&gt;', 6),
(22, '&lt;body style=\"background-color:yellow;\"&gt;', 6),
(23, '&lt;body bg=\"yellow\"&gt;', 6),
(24, 'None of these', 6);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `questions_id` int(11) NOT NULL,
  `question` text NOT NULL,
  `answer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`questions_id`, `question`, `answer_id`) VALUES
(1, 'Javascript is ______ language.', 2),
(2, 'Which HTML attribute is used to define inline styles?', 6),
(3, 'What does CSS stand for?', 12),
(4, 'Who is making the Web standards?', 13),
(5, 'JavaScript is ______ Side Scripting Language.', 18),
(6, 'What is the correct HTML for adding a background color?', 22);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `status`) VALUES
(1, 'Aniket', 'anikets@prdxn.com', '$2y$10$xqeOc.NK8fKMh0/x69sAqezWQ0NouxqCjsNI3p/YhOFWqwmgQ0v8q', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`answer_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`questions_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `answer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `questions_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
