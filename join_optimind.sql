-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 04, 2021 at 04:50 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `join_optimind`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(9) NOT NULL,
  `name` varchar(200) NOT NULL,
  `role` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT '1990-01-01 00:00:00' ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `role`, `email`, `password`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Administrator Karen', 'Admin', 'kmorales@myoptimind.com', '$2y$10$e92GdySmGorHmtYq48nwW.H78Mul6t7zp4haJo2CFIR2x0acgPrDK', '2021-09-29 15:31:41', '2021-09-29 16:16:51', NULL),
(2, 'Ryan Jacinto Magsakay', 'Recruitment Assistant', 'rmagsakay@myoptimind.com', '$2y$10$1uACLqc4GTtujplHSGM20eZ3AVcM8X3hsAsxZ7ogQnDtD5xg8gwBO', '2021-09-29 16:10:57', '2021-09-29 16:18:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `applicants`
--

CREATE TABLE `applicants` (
  `id` int(11) NOT NULL,
  `fname` varchar(191) NOT NULL,
  `lname` varchar(191) NOT NULL,
  `mobile_num` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `password` text NOT NULL,
  `year_graduated` varchar(191) NOT NULL,
  `years_experience` varchar(191) NOT NULL,
  `resume` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT '1990-01-01 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `applicants`
--

INSERT INTO `applicants` (`id`, `fname`, `lname`, `mobile_num`, `email`, `password`, `year_graduated`, `years_experience`, `resume`, `created_at`, `updated_at`) VALUES
(1, 'Karen Joy', 'Morales', '09068534696', 'kmorales@myoptimind.com', '$2y$10$ws6TZllVKTUbT8qbOpGMqOnuzGOk/dzppHFASAiTVHuuVlRKOe9YG', '2019', '2', '1632998509_sample.pdf', '2021-09-30 18:41:50', '1990-01-01 00:00:00'),
(2, 'Tiffany', 'Jabillo', '09054852125', 'tjabillo@myoptimind.com', '$2y$10$zvZ5zQT3H0dA.XziTXY10OgkwEL7PUvvo2vPG3116GSWL50VO.4YK', '2015', '5', '1633055492_One_to_Tree_Brand_Book_V01_(1).pdf', '2021-10-01 10:31:33', '1990-01-01 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE `applications` (
  `id` int(11) NOT NULL,
  `applicant_id` int(11) NOT NULL COMMENT 'FK from applicant',
  `position_id` int(11) NOT NULL COMMENT 'FK from positions',
  `step1_status` text NOT NULL,
  `step1_date` date DEFAULT NULL,
  `step2_status` text NOT NULL,
  `step2_date` date DEFAULT NULL,
  `step3_status` text NOT NULL,
  `step3_date` date DEFAULT NULL,
  `step4_status` text NOT NULL,
  `step4_date` date DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT '1990-01-01 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `applications`
--

INSERT INTO `applications` (`id`, `applicant_id`, `position_id`, `step1_status`, `step1_date`, `step2_status`, `step2_date`, `step3_status`, `step3_date`, `step4_status`, `step4_date`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'pending', NULL, '', NULL, '', NULL, '', NULL, '2021-09-30 18:41:50', '2021-10-01 17:30:33'),
(2, 2, 2, 'pending', NULL, '', NULL, '', NULL, '', NULL, '2021-10-01 10:31:33', '2021-10-01 16:24:00');

-- --------------------------------------------------------

--
-- Table structure for table `crud`
--

CREATE TABLE `crud` (
  `id` int(9) NOT NULL,
  `some_varchar_field` varchar(200) NOT NULL,
  `some_text_field` text NOT NULL,
  `image_url` text NOT NULL,
  `some_int_field` int(11) NOT NULL,
  `some_datetime_field` datetime NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT '1990-01-01 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `crud`
--

INSERT INTO `crud` (`id`, `some_varchar_field`, `some_text_field`, `image_url`, `some_int_field`, `some_datetime_field`, `created_at`, `updated_at`) VALUES
(1, 'Veroem ipsum adasdasd', 'Hooooh', '', 123, '0000-00-00 00:00:00', '2021-09-29 15:31:40', '1990-01-01 00:00:00'),
(2, 'Ahahahah ipsum adasdasd', 'Hohhhhheeeeoh', '', 131323, '2017-06-04 00:00:00', '2021-09-29 15:31:40', '1990-01-01 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `essay`
--

CREATE TABLE `essay` (
  `id` int(11) NOT NULL,
  `topic` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT '1990-01-01 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `essay`
--

INSERT INTO `essay` (`id`, `topic`, `created_at`, `updated_at`) VALUES
(1, 'Nothing\'s gonna change my love for you\r\nYou oughta know by now how much I love you\r\nOne thing you can be sure of\r\nI\'ll never ask for more than your  hfdh', '2021-10-01 12:05:43', '2021-10-01 17:31:33');

-- --------------------------------------------------------

--
-- Table structure for table `essay_exam`
--

CREATE TABLE `essay_exam` (
  `id` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL COMMENT 'FK from essay',
  `application_id` int(11) NOT NULL COMMENT 'FK from applications',
  `essay` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT '1990-01-01 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `keys`
--

CREATE TABLE `keys` (
  `id` int(9) NOT NULL,
  `user_id` int(11) NOT NULL,
  `key` varchar(40) NOT NULL,
  `level` int(2) NOT NULL,
  `ignore_limits` tinyint(1) NOT NULL DEFAULT 0,
  `is_private_key` tinyint(1) NOT NULL DEFAULT 0,
  `ip_addresses` tinytext DEFAULT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `logical_answers`
--

CREATE TABLE `logical_answers` (
  `id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL COMMENT 'FK from logical_questions',
  `answer` text NOT NULL,
  `has_image` int(11) NOT NULL DEFAULT 0,
  `image_url` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT '1990-01-01 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `logical_exam`
--

CREATE TABLE `logical_exam` (
  `id` int(11) NOT NULL,
  `application_id` int(11) NOT NULL COMMENT 'FK from application',
  `question_id` int(11) NOT NULL COMMENT 'FK from logical_questions',
  `answer_id` int(11) NOT NULL COMMENT 'FK from logical_answers',
  `is_correct` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT '1990-01-01 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `logical_questions`
--

CREATE TABLE `logical_questions` (
  `id` int(11) NOT NULL,
  `question` text NOT NULL,
  `answer_id` int(11) NOT NULL COMMENT 'FK from logicak_answer',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT '1990-01-01 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `version` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`version`) VALUES
(20180625000001);

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE `positions` (
  `id` int(11) NOT NULL,
  `position_name` text NOT NULL,
  `job_description` text NOT NULL,
  `requirements` text NOT NULL,
  `is_technical` int(11) NOT NULL DEFAULT 0,
  `is_available` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT '1990-01-01 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`id`, `position_name`, `job_description`, `requirements`, `is_technical`, `is_available`, `created_at`, `updated_at`) VALUES
(1, 'Front-end Developer', 'We’re currently looking for a Front End Developer that’s passionate about creating beautiful web experiences. The ideal candidate will have a solid understanding of design, and usability while also having the front end chops to create rich new experiences. He/She should be a flexible, highly independent worker as well as an excellent team player who can work efficiently under tight deadlines and will thrive on the product team’s passion for quality and delivery\r\n\r\nWhat you will be doing:\r\n\r\nDesign, implement and maintain web-based user interfaces using HTML, CSS and JavaScript.\r\nWork with customers, business leads, and designers to create user interfaces that are cutting edge and easy-to-use for consumers.\r\nUnderstand the needs of the business and inform management of functional design and schedule trade-offs.\r\nPerform peer design and code reviews\r\nIdentify and resolve system and software issues in a timely manner.\r\nBe forward-thinking and help improve the usability, functionality, and quality of the user experience', 'Minimum 1 year experience in HTML5/CSS development\r\nGraduate of any 4 year IT related course\r\nKnowledge in Bootstrap or any HTML5/CSS framework\r\nKnowledge and experience in responsive web is a must\r\nAMP knowledge is a plus\r\nConversion from Photoshop/Illustrator to html5/css is a plus\r\nExcellent written and verbal communication skills; ability to handle multiple projects simultaneously', 1, 1, '2021-09-30 15:55:12', '2021-09-30 16:33:01'),
(2, 'Digital Marketing Coordinator', 'Our team is seeking to hire a project coordinator who will assist our digital marketing team in our ongoing projects.\r\nTo be effective in the role, you will need to work around tight deadlines, well-versed in using MS Office Applications (Excel and Word), and other existing tools used in line with the work.\r\n\r\nRESPONSIBILITIES:\r\n\r\nMonitor project schedules and project plans.\r\nEnsure project deadlines are met.\r\nOrganize, attend, or participate in team/client meetings. Ensure minutes of the meeting are provided to all team members.\r\nDocument and follow-up on important actions, and decisions from meetings.\r\nProvide administrative support when needed.\r\nEnsure proper documentation is maintained appropriately for each account.\r\nProvide solutions where applicable.', 'Good verbal, written, and presentation skills.\r\nAbility to work effectively both independently and as part of the team.\r\nProficient in using MS Office Applications.\r\nAbility to work on tight deadlines\r\nKnowledge in digital marketing is a plus but not necessary\r\nGraduate of communications, advertising, management, or any related course with related experience. Fresh graduates and non-graduates are welcome to apply.', 0, 1, '2021-09-30 16:04:22', '2021-09-30 17:15:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `applicants`
--
ALTER TABLE `applicants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `crud`
--
ALTER TABLE `crud`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `essay`
--
ALTER TABLE `essay`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `essay_exam`
--
ALTER TABLE `essay_exam`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `keys`
--
ALTER TABLE `keys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logical_answers`
--
ALTER TABLE `logical_answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logical_exam`
--
ALTER TABLE `logical_exam`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logical_questions`
--
ALTER TABLE `logical_questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `applicants`
--
ALTER TABLE `applicants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `applications`
--
ALTER TABLE `applications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `crud`
--
ALTER TABLE `crud`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `essay`
--
ALTER TABLE `essay`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `essay_exam`
--
ALTER TABLE `essay_exam`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `keys`
--
ALTER TABLE `keys`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `logical_answers`
--
ALTER TABLE `logical_answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `logical_exam`
--
ALTER TABLE `logical_exam`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `logical_questions`
--
ALTER TABLE `logical_questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
