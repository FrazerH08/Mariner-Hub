-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
<<<<<<< Updated upstream
-- Generation Time: May 09, 2025 at 12:51 PM
=======
-- Generation Time: May 16, 2025 at 12:35 AM
>>>>>>> Stashed changes
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
-- Database: `black&white_faithful`
--

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `firstname` text NOT NULL,
  `lastname` text NOT NULL,
  `username` text NOT NULL,
  `email` text NOT NULL,
  `region` text NOT NULL,
  `subject` text NOT NULL,
  `date_written` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `firstname`, `lastname`, `username`, `email`, `region`, `subject`, `date_written`) VALUES
(0, 'Euan', 'Parry', 'Euan123', '123@gmail.com', 'United Kingdom', 'I hate this website', '2025-05-08 09:21:31');

-- --------------------------------------------------------

--
-- Table structure for table `live_chat`
--

CREATE TABLE `live_chat` (
  `id` int(11) NOT NULL,
  `game_name` text NOT NULL,
  `replies` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `time_written` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `picture` blob NOT NULL,
  `content` text NOT NULL,
  `username` text NOT NULL,
  `time_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `comments` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `description`, `picture`, `content`, `username`, `time_created`, `comments`) VALUES
<<<<<<< Updated upstream
(1, 'What did Euan Do Yesterday', 'Hello ', '', 'vdsbgsghdrhfh', '', '2025-05-09 09:11:52', ''),
(2, 'My first Post', 'hdcdc', '', 'fewsgfegeg', '', '2025-05-09 09:14:24', ''),
(3, 'My first Post', 'hdcdc', 0x4172726179, 'fewsgfegeg', '', '2025-05-09 10:22:30', '');
=======
(1, 'Final Test', 'Hello This is frazzle', 0x75706c6f6164732f53637265656e73686f7420323032342d31312d3034203131343535342e706e67, 'please work!', '', '2025-05-13 10:09:48', ''),
(16, 'Testing', 'fdgdgfdg', 0x475446432e6a7067, 'gfdfdfdf', '', '2025-05-15 11:06:04', '');
>>>>>>> Stashed changes

-- --------------------------------------------------------

--
-- Table structure for table `threads`
--

CREATE TABLE `threads` (
  `thread_id` int(11) NOT NULL,
  `thread_name` text NOT NULL,
  `replies` text NOT NULL,
  `likes` int(11) NOT NULL,
  `date_created` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `firstname` text NOT NULL,
  `lastname` text NOT NULL,
  `email` text NOT NULL,
  `bio` text NOT NULL,
  `profile_pic` blob NOT NULL,
  `region` text NOT NULL,
  `status` enum('active','inactive','','') NOT NULL,
  `birthdate` text NOT NULL,
  `role` enum('user','admin','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

<<<<<<< Updated upstream
INSERT INTO `users` (`id`, `username`, `password`, `firstname`, `lastname`, `region`, `status`, `birthdate`, `role`, `email`) VALUES
(1, 'FrazerGTFC', '$2y$10$EwvAmv/0GzWsB86V5ffUTecwJp3ehOCYM8nCSIJenXjPcBDaOHfMO', 'Frazer', 'Harness', 'United Kingdom', 'active', '2008-06-07', 'user', 'frazergtfc9@outlook.com');
=======
INSERT INTO `users` (`id`, `username`, `password`, `firstname`, `lastname`, `email`, `bio`, `profile_pic`, `region`, `status`, `birthdate`, `role`) VALUES
(1, 'FrazerGTFC', '$2y$10$EwvAmv/0GzWsB86V5ffUTecwJp3ehOCYM8nCSIJenXjPcBDaOHfMO', 'Frazer', 'Harness', 'frazergtfc9@outlook.com', '', '', 'United Kingdom', 'active', '2008-06-07', 'admin'),
(3, 'EuanParry123', '$2y$10$n3SxG/5GD1EkA0xw.KanxeMMBZBDL6aYifWk6X/IH1GGTDLWk9jdG', 'Euan', 'Pazza', 'euan@gmail.com', '', '', 'Australia', 'active', '2020-01-07', 'user');
>>>>>>> Stashed changes

--
-- Indexes for dumped tables
--

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `live_chat`
--
ALTER TABLE `live_chat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `threads`
--
ALTER TABLE `threads`
  ADD PRIMARY KEY (`thread_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `live_chat`
--
ALTER TABLE `live_chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
<<<<<<< Updated upstream
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
=======
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
>>>>>>> Stashed changes

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
