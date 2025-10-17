-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 16, 2025 at 08:44 AM
-- Server version: 11.8.3-MariaDB-log
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u739449679_tmstp`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'cat 1'),
(2, 'Cat 2'),
(7, 'Cat 4');

-- --------------------------------------------------------

--
-- Table structure for table `cats_pro`
--

CREATE TABLE `cats_pro` (
  `id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `pro_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `cats_pro`
--

INSERT INTO `cats_pro` (`id`, `cat_id`, `pro_id`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 2, 2),
(4, 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `course_id` int(11) NOT NULL,
  `course_duration` int(11) NOT NULL,
  `course_code` varchar(30) NOT NULL,
  `course_title` varchar(255) NOT NULL,
  `course_description` varchar(255) NOT NULL,
  `learning_outcome` varchar(255) NOT NULL,
  `fee_details` varchar(255) NOT NULL COMMENT 'the cost of the course, skill future credit\r\n'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_id`, `course_duration`, `course_code`, `course_title`, `course_description`, `learning_outcome`, `fee_details`) VALUES
(1, 2, '', 'Digital Marketing', 'Digital Marketing with AI', 'Equip you with the skills needed to secure prestigious jobs at top companies.', '$819'),
(2, 1, '', 'Cybersecurity', 'Cybersecurity Essentials Course', 'Learn essential cybersecurity skills to combat evolving cyber threats.', 'Singaporeans aged 40 and above	70%	$624 Singaporeans below 40 and all PRs	50%	$944 Non-Singapore Citizens and Non-PRs	-	$1,744');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_uca1400_ai_ci;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'members', 'General User');

-- --------------------------------------------------------

--
-- Table structure for table `learners`
--

CREATE TABLE `learners` (
  `learner_id` int(11) UNSIGNED NOT NULL,
  `learner_username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(254) NOT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_uca1400_ai_ci;

--
-- Dumping data for table `learners`
--

INSERT INTO `learners` (`learner_id`, `learner_username`, `password`, `email`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES
(1, 'mary', 'mar@123', 'mary@gmail.com', 1268889823, 1268889823, 1, 'Mary', 'Doe', 'Riorobot Pte Ltd', '98989898');

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_uca1400_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `phpcg_users`
--

CREATE TABLE `phpcg_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `profiles_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `address` varchar(50) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `zip_code` varchar(20) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `mobile_phone` varchar(20) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL COMMENT 'Boolean'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_uca1400_ai_ci;

--
-- Dumping data for table `phpcg_users`
--

INSERT INTO `phpcg_users` (`id`, `profiles_id`, `name`, `firstname`, `address`, `city`, `zip_code`, `email`, `phone`, `mobile_phone`, `password`, `active`) VALUES
(1, 1, 'LionMarks Admin', 'Lionmarks', 'the address of the lionmarks admin', '', '', 'admin@lionmarks.com', '', '', '$2y$10$BZxH/wNbLUonLahFeE3sC.Zj8BR1EaPeONwxYrNh.GGCEyyM3zV9e', 1);

-- --------------------------------------------------------

--
-- Table structure for table `phpcg_users_profiles`
--

CREATE TABLE `phpcg_users_profiles` (
  `id` int(11) NOT NULL,
  `profile_name` varchar(100) NOT NULL,
  `r_category` tinyint(1) NOT NULL DEFAULT 0,
  `u_category` tinyint(1) NOT NULL DEFAULT 0,
  `cd_category` tinyint(1) NOT NULL DEFAULT 0,
  `cq_category` varchar(255) DEFAULT NULL,
  `r_courses` tinyint(1) NOT NULL DEFAULT 0,
  `u_courses` tinyint(1) NOT NULL DEFAULT 0,
  `cd_courses` tinyint(1) NOT NULL DEFAULT 0,
  `cq_courses` varchar(255) DEFAULT NULL,
  `r_learners` tinyint(1) NOT NULL DEFAULT 0,
  `u_learners` tinyint(1) NOT NULL DEFAULT 0,
  `cd_learners` tinyint(1) NOT NULL DEFAULT 0,
  `cq_learners` varchar(255) DEFAULT NULL,
  `r_trainers` tinyint(1) NOT NULL DEFAULT 0,
  `u_trainers` tinyint(1) NOT NULL DEFAULT 0,
  `cd_trainers` tinyint(1) NOT NULL DEFAULT 0,
  `cq_trainers` varchar(255) DEFAULT NULL,
  `r_users` tinyint(1) NOT NULL DEFAULT 0,
  `u_users` tinyint(1) NOT NULL DEFAULT 0,
  `cd_users` tinyint(1) NOT NULL DEFAULT 0,
  `cq_users` varchar(255) DEFAULT NULL,
  `r_phpcg_users` tinyint(1) NOT NULL DEFAULT 0,
  `u_phpcg_users` tinyint(1) NOT NULL DEFAULT 0,
  `cd_phpcg_users` tinyint(1) NOT NULL DEFAULT 0,
  `cq_phpcg_users` varchar(255) DEFAULT NULL,
  `r_phpcg_users_profiles` tinyint(1) NOT NULL DEFAULT 0,
  `u_phpcg_users_profiles` tinyint(1) NOT NULL DEFAULT 0,
  `cd_phpcg_users_profiles` tinyint(1) NOT NULL DEFAULT 0,
  `cq_phpcg_users_profiles` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_uca1400_ai_ci;

--
-- Dumping data for table `phpcg_users_profiles`
--

INSERT INTO `phpcg_users_profiles` (`id`, `profile_name`, `r_category`, `u_category`, `cd_category`, `cq_category`, `r_courses`, `u_courses`, `cd_courses`, `cq_courses`, `r_learners`, `u_learners`, `cd_learners`, `cq_learners`, `r_trainers`, `u_trainers`, `cd_trainers`, `cq_trainers`, `r_users`, `u_users`, `cd_users`, `cq_users`, `r_phpcg_users`, `u_phpcg_users`, `cd_phpcg_users`, `cq_phpcg_users`, `r_phpcg_users_profiles`, `u_phpcg_users_profiles`, `cd_phpcg_users_profiles`, `cq_phpcg_users_profiles`) VALUES
(1, 'superadmin', 2, 2, 2, '', 2, 2, 2, '', 2, 2, 2, '', 2, 2, 2, '', 2, 2, 2, '', 2, 2, 2, '', 2, 2, 2, '');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `cat_id`, `name`) VALUES
(1, 1, 'pro 1'),
(2, 1, 'pro 2'),
(3, 1, 'pro 1'),
(6, 2, 'pro 1'),
(7, 2, 'pro 2'),
(9, 2, 'pro 2 3'),
(16, 0, 'test'),
(17, 1, 'test2'),
(18, 2, 'testing'),
(19, 7, 'Test 1 product...'),
(20, 0, 'download_(1).jpg');

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`id`, `title`, `description`, `status`) VALUES
(3, 'test', '', 0),
(4, 'test', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `trainers`
--

CREATE TABLE `trainers` (
  `trainer_id` int(11) UNSIGNED NOT NULL,
  `trainer_username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(254) NOT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_uca1400_ai_ci;

--
-- Dumping data for table `trainers`
--

INSERT INTO `trainers` (`trainer_id`, `trainer_username`, `password`, `email`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES
(1, 'john', 'joh@123', 'john@gmail.com', 1268889823, 1268889823, 1, 'John', 'Doe', 'Riorobot Pte Ltd', '98989898');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(254) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_uca1400_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES
(1, '127.0.0.1', 'administrator', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', 'admin@admin.com', '', NULL, NULL, NULL, 1268889823, 1760253689, 1, 'Admin', 'istrator', 'ADMIN', '0');

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_uca1400_ai_ci;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(2, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `user_data`
--

CREATE TABLE `user_data` (
  `setting_id` tinyint(1) NOT NULL,
  `root_url` varchar(250) NOT NULL,
  `client_email` varchar(250) NOT NULL,
  `license_code` varchar(250) NOT NULL,
  `lcd` varchar(250) NOT NULL,
  `lrd` varchar(250) NOT NULL,
  `installation_key` varchar(250) NOT NULL,
  `installation_hash` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_uca1400_ai_ci;

--
-- Dumping data for table `user_data`
--

INSERT INTO `user_data` (`setting_id`, `root_url`, `client_email`, `license_code`, `lcd`, `lrd`, `installation_key`, `installation_hash`) VALUES
(1, 'https://tms.lionmark.com.sg/class/phpformbuilder', 'danielhtwe@gmail.com', '44d0b8f0-44a7-4f2d-8760-75f2b277d2c5', 'WE50NUl2RkpOeDZZcWFqNGVLSVVvdz09OjrcxX1OpQg2u4Oo4a5pu0Ul', 'UGtSWDVnbFRkNVZGTER5U3lrRk5RQT09OjqEUsfYMXi854SKEZml2jDh', 'R2U2TVZIQWFuczltaFUvN0FEUFpxMHY5QXE3WDFMakRhdkdrdVNrSWpOSDZZQVJMRkVPT09COW1zbG9GYWNVV0xLK1RiYlBGYnQ3S09WY1JONmVGNFE9PTo62zfPHVP4eEKoD7FSYCNQ4w==', '8874b91a2214180e5dfddcc33c91ca9a8bdfcf293be22a5bb5f51d4285f3aad6');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cats_pro`
--
ALTER TABLE `cats_pro`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `learners`
--
ALTER TABLE `learners`
  ADD PRIMARY KEY (`learner_id`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `phpcg_users`
--
ALTER TABLE `phpcg_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`),
  ADD KEY `fk_phpcg_users_phpcg_users_profiles` (`profiles_id`);

--
-- Indexes for table `phpcg_users_profiles`
--
ALTER TABLE `phpcg_users_profiles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `profile_name_UNIQUE` (`profile_name`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trainers`
--
ALTER TABLE `trainers`
  ADD PRIMARY KEY (`trainer_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- Indexes for table `user_data`
--
ALTER TABLE `user_data`
  ADD PRIMARY KEY (`setting_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `cats_pro`
--
ALTER TABLE `cats_pro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `learners`
--
ALTER TABLE `learners`
  MODIFY `learner_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `phpcg_users`
--
ALTER TABLE `phpcg_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `phpcg_users_profiles`
--
ALTER TABLE `phpcg_users_profiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `trainers`
--
ALTER TABLE `trainers`
  MODIFY `trainer_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_data`
--
ALTER TABLE `user_data`
  MODIFY `setting_id` tinyint(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `phpcg_users`
--
ALTER TABLE `phpcg_users`
  ADD CONSTRAINT `fk_phpcg_users_phpcg_users_profiles` FOREIGN KEY (`profiles_id`) REFERENCES `phpcg_users_profiles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
