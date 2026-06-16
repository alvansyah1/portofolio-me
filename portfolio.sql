-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 08, 2026 at 12:38 AM
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
-- Database: `portfolio`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', '827ccb0eea8a706c4c34a16891f84e7b');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `message`, `created_at`) VALUES
(1, 'Adaptability', 'agus.purwono@sat.co.id', 'dadada', '2026-06-05 13:31:16'),
(2, 'Alvansyah Hutasoit', 'htsalvan2001@gmail.com', 'adadadadadad', '2026-06-05 13:31:27');

-- --------------------------------------------------------

--
-- Table structure for table `experience`
--

CREATE TABLE `experience` (
  `id` int(11) NOT NULL,
  `company` varchar(200) DEFAULT NULL,
  `position` varchar(200) DEFAULT NULL,
  `period` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `experience`
--

INSERT INTO `experience` (`id`, `company`, `position`, `period`, `description`, `logo`) VALUES
(2, 'PT. Sumber Alfaria Trijaya, TBK', 'IT Support', '2025 - NOW', 'ADADADADAD', '17791325631AEP.JPG'),
(5, 'PT. Sumber Alfaria Trijaya, TBK', 'IT Support', '2025 - NOW', 'Just a TEAM IT ', '1780672621Screenshot_1.jpg'),
(6, 'PT. Sumber Alfaria Trijaya, TBK', 'IT Support', '2025 - NOW', 'SAYA INGIN MENJADI TERBAIK', '1780673492FAN.png');

-- --------------------------------------------------------

--
-- Table structure for table `hero_cards`
--

CREATE TABLE `hero_cards` (
  `id` int(11) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hero_cards`
--

INSERT INTO `hero_cards` (`id`, `title`, `description`) VALUES
(1, 'Vibes Coding', 'Learning With AI'),
(2, 'AI Interface', 'Modern premium UI / UX development'),
(3, 'Web Development', 'Full Stack Development');

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `id` int(11) NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `role` varchar(200) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `location` varchar(200) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `cv` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`id`, `name`, `role`, `description`, `email`, `location`, `photo`, `cv`) VALUES
(1, 'Alvansyah Hutasoit', 'Information Technology | Learning Enthusiast | Vibes Coding', 'Learning Enthusiast | Vibes Coding | Database Programming Supervisor', 'htsalvan2001@gmail.com', 'Indonesia', '1779119057WhatsApp Image 2026-05-15 at 19.01.47.jpeg', '1780676249cv-alvanhts.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `title` varchar(200) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `title`, `description`, `image`) VALUES
(1, 'APLIKASI BANTU IT ', 'Monitoring and data management application\r\nbuilt to simplify and optimize IT operations.', '1779038195kalcer.JPG'),
(2, 'CHATBOT IT ASSITANT', 'Smart IT Support Assistant\r\nSolusi cepat untuk kendala operasional & perangkat IT', '1779130939chatbot.JPG'),
(6, 'DADADA', 'DADADADADADADA', '1779132477_chatbot.JPG'),
(7, 'UI UX DESIGN', 'Halo HAlo ', '1780666970_AT505 AT705.png');

-- --------------------------------------------------------

--
-- Table structure for table `project_gallery`
--

CREATE TABLE `project_gallery` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `caption` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `project_gallery`
--

INSERT INTO `project_gallery` (`id`, `project_id`, `title`, `description`, `image`, `caption`) VALUES
(1, 6, NULL, NULL, '1779132477_0_kalcer.JPG', 'CAADDADCA'),
(2, 6, NULL, NULL, '1779132477_1_WhatsApp Image 2026-04-25 at 16.27.22.jpeg', 'DAACAADADD'),
(3, 7, NULL, NULL, '1780666970_0_end.png', ''),
(4, 7, NULL, NULL, '1780666970_1_Screenshot_1.jpg', '');

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

CREATE TABLE `skills` (
  `id` int(11) NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `skills`
--

INSERT INTO `skills` (`id`, `name`, `icon`, `description`) VALUES
(7, 'PHP', 'fa-brands fa-php', 'Learning and building with PHP'),
(8, 'SQL', 'fa-solid fa-database', 'Managing and analyzing data using SQL.'),
(9, 'HTML', 'fa-solid fa-code', 'Building structured web pages using HTML'),
(10, 'Microsoft Office', 'fa-brands fa-microsoft', 'Familiar with Microsoft Office tools for productivity and data processing'),
(11, 'Communication', 'fa-solid fa-comments', 'Able to communicate clearly and effectively with others.'),
(12, 'Adaptability', 'fa-solid fa-arrows-rotate', 'Able to adapt quickly to new situations and challenges.'),
(13, 'Teamwork', 'fa-solid fa-user-group', 'Works well with others.'),
(14, 'Time Management', 'fa-solid fa-clock', 'Capable of managing time efficiently and meeting deadlines.'),
(15, 'Responbility', 'fa-solid fa-circle-check', 'Reliable and committed to completing tasks with accountability.'),
(16, 'IT Support', 'fa-solid fa-headset', 'Providing technical assistance and support to users effectively.');

-- --------------------------------------------------------

--
-- Table structure for table `social_links`
--

CREATE TABLE `social_links` (
  `id` int(11) NOT NULL,
  `platform` varchar(50) DEFAULT NULL,
  `icon` varchar(100) DEFAULT NULL,
  `url` text DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `label` varchar(100) DEFAULT NULL,
  `subtitle` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `social_links`
--

INSERT INTO `social_links` (`id`, `platform`, `icon`, `url`, `username`, `label`, `subtitle`) VALUES
(1, 'instagram', 'fab fa-instagram', 'https://instagram.com/USERNAME', '@alvanhutasoit', 'Instagram', 'Let\'s Connect'),
(2, 'linkedin', 'fab fa-linkedin-in', 'https://linkedin.com/in/alvansyah-hutasoit', 'Connect with me: alvansyah-hutasoit', 'LinkedIn', 'Professional Profile'),
(3, 'github', 'fab fa-github', 'https://github.com/USERNAME', 'Repo', 'Github', 'See My Projects'),
(4, 'whatsapp', 'fab fa-whatsapp', 'https://wa.me/089526124390', 'Chat on 089526124390', 'Whatsapp', 'Contact Me Directly');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `experience`
--
ALTER TABLE `experience`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hero_cards`
--
ALTER TABLE `hero_cards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_gallery`
--
ALTER TABLE `project_gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `social_links`
--
ALTER TABLE `social_links`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `experience`
--
ALTER TABLE `experience`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `hero_cards`
--
ALTER TABLE `hero_cards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `project_gallery`
--
ALTER TABLE `project_gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `skills`
--
ALTER TABLE `skills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `social_links`
--
ALTER TABLE `social_links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
