-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2025 at 02:32 PM

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
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `news_id` int(11) NOT NULL,
  `text` text NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `news_id`, `text`, `date_created`) VALUES
(1, 1, 17, 'I think Euan is great ', '2025-05-22 20:34:15'),

(2, 1, 1, 'Frazzle this is shocking!', '2025-05-22 21:01:46'),
(3, 8, 1, 'Hume willl stay ', '2025-05-23 12:15:34');


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
(1, 'Euan', 'Parry', 'Euan123', '123@gmail.com', 'United Kingdom', 'I hate this website', '2025-05-08 09:21:31'),
(2, 'euan', 'parry', 'Enrol123', 'euan@gmail.com', 'United Kingdom', 'I don&#039;t like the about club page as it is empty!!!!!!!!!!!!!!!!!!!!!!!!!!!', '2025-05-22 10:49:11'),
(3, 'Alexander', 'Parry', 'Enrol123', 'Egrparry28@gmail.com', 'USA', 'This website is insane ! The PHP master strikes again. ', '2025-05-22 19:43:17'),
(4, 'Alexander', 'Parry', 'Enrol123', 'Egrparry28@gmail.com', 'USA', 'This website is insane ! The PHP master strikes again. ', '2025-05-22 19:44:50'),
(5, 'Alexander', 'Parry', 'Enrol123', 'Egrparry28@gmail.com', 'USA', 'This website is insane ! The PHP master strikes again. ', '2025-05-22 19:45:06'),
(6, 'Alexander', 'Parry', 'Enrol123', 'Egrparry28@gmail.com', 'USA', 'This website is insane ! The PHP master strikes again. ', '2025-05-22 19:45:50'),
(7, 'Frazee', 'Harbess', 'FrazerGTFC', 'test@gmail.com', 'United Kingdom', 'This website is awful ', '2025-05-23 12:23:57');


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
(1, 'Should I stay or should I Go?', 'Should I stay or should I Go? Denver Hume is considering the question', 0x75706c6f6164732f68756d652e6a7067, 'The vast majority of Town fans are hoping that Denver Hume will sign a new deal with the Mariners , but as days go by its looking increasingly unlikely he will be staying with the Mariners. Hume has got 14 assists in all competitions this season and the joined most assists in League Two as well. The Ex Portsmouth and Sunderland man has played the majority of his football in League one and it looks like this will be where his next club may be. Doncaster Rovers are the rumored team which has offered Hume a contract. Last summer the Mariners also lost long serving player Harry Clifton to Doncaster Rovers , and it could be the case again. In the Fishy forum website a reliable source named &quot; Alan Buckley&quot; seems to think Hume is going &quot;Nowhere&quot; . Alan was the first source to state we was signing Cameron McJannet .\r\nWhats your thoughts? Leave it in the comment section below.', '', '2025-05-23 11:49:47', ''),
(17, 'Altrincham Duo To the Mariners??', 'Rumours are floating around', 0x75706c6f6164732f4a757374696e20416d616c757a6f722e77656270, 'They are some rumours recently That Grimsby town are interested in Signing Regan Linney and Justin Amaluzor from Altrincham.\r\nNo one knows if these rumours are true which is coming from the North-west of England but it has been reported on Altrincham&#039;s fans forum and onn twitter (X) by @RobMoore_1 fans will be intently watching his page for any new rumours.', '', '2025-05-23 11:41:53', ''),
(27, 'Retained List', 'Grimsby towns retained list 24/25 ', 0x75706c6f6164732f6a616b652d65617374776f6f642e6a7067, 'Following the conclusion of the 2024-25 campaign, Grimsby Town Football Club  confirmed their retained and released list.\r\n\r\nThe following players are under contract for the 2025-26 season:\r\n\r\nTyrell Warren\r\n\r\nLewis Cass\r\n\r\nCameron McJannet\r\n\r\nJason Da&amp;amp;eth;i Svan&amp;amp;thorn;&amp;amp;oacute;rsson\r\n\r\nDarragh Burns\r\n\r\nG&amp;amp;eacute;za D&amp;amp;aacute;vid Turi\r\n\r\nHarvey Rodgers\r\n\r\nDoug Tharme\r\n\r\nEvan Khouri\r\n\r\nKieran Green\r\n\r\nCharles Vernam\r\n\r\nDanny Rose\r\n\r\nCameron Gardner\r\n\r\nGeorge McEachran\r\n\r\nGrimsby confirmed that Denver Hume has been offered new terms with the club.\r\n\r\nThe following players are available for transfer:\r\n\r\nJordan Wright\r\n\r\nMatty Carson\r\n\r\nThe following players have been informed that they will be released at the end of their current deals:\r\n\r\nJake Eastwood\r\n\r\nCallum Ainley\r\n\r\nCurtis Thompson\r\n\r\nHarvey Cribb\r\n\r\nRekeil Pyke\r\n\r\nDonovan Wilson\r\n\r\nAll on-loan players have also returned to their parent clubs:\r\n\r\nJordan Davies (Wrexham)\r\n\r\nLuca Barrington (Brighton &amp;amp;amp; Hove Albion)\r\n\r\nJayden Luker (Luton Town)\r\n\r\nJustin Obikwu (Coventry City)\r\n\r\nHead Coach, David Artell said,\r\n\r\n&amp;amp;ldquo;I&amp;amp;rsquo;d like to thank all the players who are leaving the club for their hard work and professionalism during their time with us. Each of them has contributed to the group in their own way, both on and off the pitch.\r\n\r\nIt&amp;amp;rsquo;s never easy saying goodbye to good people, and we&amp;amp;rsquo;re grateful for the commitment they&amp;amp;rsquo;ve shown. They leave with our respect and appreciation, and we wish them all the very best in the next stage of their careers.\r\n\r\nLastly, I would like to extend my thanks to all our loan players for their efforts and wish them well at their respective clubs.&amp;amp;rdquo;\r\n\r\nWe would like to wish all the players leaving Blundell Park the very best for their futures and thank them for their services while with the club.\r\n\r\nUTM\r\n\r\nThis may come as as surprise for the mariners , especially that in looks like both goalkeepers are leaving the club , with Jake Eastwood being released and Jordan Wright being listed for transfer\r\n\r\nLets Hope Dave has some goalkeepers lined up!  ', '', '2025-05-23 11:34:26', '');

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

INSERT INTO `users` (`id`, `username`, `password`, `firstname`, `lastname`, `email`, `bio`, `profile_pic`, `region`, `status`, `birthdate`, `role`) VALUES
(1, 'FrazerGTFC', '$2y$10$EwvAmv/0GzWsB86V5ffUTecwJp3ehOCYM8nCSIJenXjPcBDaOHfMO', 'Frazer  ', 'Harness  ', 'frazergtfc9@outlook.com', 'Hello Euan Parry This is my blogsite', 0x53637265656e73686f7420323032352d30312d3231203039313231382e706e67, 'Australia', 'active', '2008-06-07', 'admin'),
(3, 'EuanParry123', '$2y$10$n3SxG/5GD1EkA0xw.KanxeMMBZBDL6aYifWk6X/IH1GGTDLWk9jdG', 'Euan', 'Pazza', 'euan@gmail.com', '', '', 'Australia', 'active', '2020-01-07', 'user'),
(4, 'harold1234', '$2y$10$76PrL2sPvomrdLcM4ROCY.O4Hvp7pHd38QS/gTZlFJOn63q77fBNe', 'harry', 'barker', 'HAROLd123@gmail.com', '', '', 'United Kingdom', 'active', '2007-08-13', 'user'),
(5, 'thegreatone', '$2y$10$qs0Df8w2wAwTVdXJ8Ceg7ek/s8qM0Wjb5/hv62.pVzMq1wxeh.F1O', 'euan ', 'glyn', 'euanismydadd@yahoo.com', '', '', 'USA', 'active', '12121-02-12', 'admin'),
(6, 'Enrol123', '$2y$10$4kxZa1hwdH5QR3STzJUYRu5N1nMIOmBmjF7iyH.bcUFxHdEuFdqdK', 'Euan ', 'Parry ', 'Egrparry28@gmail.com', 'Euan is grate', 0x53637265656e73686f7420323032342d31302d3134203134313530322e706e67, 'Australia', 'active', '2007-09-28', 'user'),
(7, 'EuanSmells', '$2y$10$xzFzSyqM/cOxiOuSxMrHfeWtFr0MiNUFRARMMhWAOfAIX/gtJzMBW', 'Alex', 'Parry', 'alexparry@gmail.com', '', '', 'USA', 'active', '2004-03-28', 'user'),
(8, 'MrTest123', '$2y$10$gsruPByhpzqk48vrhwEd9.K7Ww3YiSbVe9cIyEIcLf2O6Ll1gJto2', 'Test ', 'Testing ', 'test@gmail.com', 'This is a test bio ', 0x4a757374696e20416d616c757a6f722e77656270, 'Australia', 'active', '2003-02-03', 'user');


--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`

  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;


--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`

  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;


--
-- AUTO_INCREMENT for table `live_chat`
--
ALTER TABLE `live_chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`

  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
