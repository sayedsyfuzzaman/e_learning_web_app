-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 30, 2022 at 07:52 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e_learning_web_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_info`
--

CREATE TABLE `admin_info` (
  `id` varchar(20) NOT NULL,
  `password` text CHARACTER SET utf8 NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` text NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `nationality` varchar(20) NOT NULL,
  `nid` varchar(20) NOT NULL,
  `dob` varchar(10) DEFAULT NULL,
  `gender` varchar(6) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `image` text DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_info`
--

INSERT INTO `admin_info` (`id`, `password`, `name`, `email`, `phone`, `nationality`, `nid`, `dob`, `gender`, `address`, `image`, `created_at`) VALUES
('2021-41718-3', 'ador@1234', 'Sayed Syfuzzaman', 'sayedsyfuzzaman@gmail.com', '01783149316', 'Bangladeshi', '3213044', '2000-09-23', 'male', 'Dhaka', 'upload/2021-41718-3.png', '2021-11-22 21:29:26');

-- --------------------------------------------------------

--
-- Table structure for table `community_topics_and_solutions`
--

CREATE TABLE `community_topics_and_solutions` (
  `topics_id` varchar(20) NOT NULL,
  `solution` text NOT NULL,
  `posted_by` varchar(20) NOT NULL,
  `posted_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `course_community`
--

CREATE TABLE `course_community` (
  `topics_id` varchar(20) NOT NULL,
  `course_id` varchar(20) NOT NULL,
  `topic` text NOT NULL,
  `created_by` varchar(20) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `course_info`
--

CREATE TABLE `course_info` (
  `course_id` varchar(20) NOT NULL,
  `course_name` varchar(100) NOT NULL,
  `thumbnail` text NOT NULL,
  `created_by` varchar(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `price` decimal(15,2) DEFAULT NULL,
  `discount` int(11) DEFAULT 0,
  `avilability` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course_info`
--

INSERT INTO `course_info` (`course_id`, `course_name`, `thumbnail`, `created_by`, `created_at`, `price`, `discount`, `avilability`) VALUES
('123', 'Web Technologies 11', 'courseThumbnail/web_tec.jpg', '2021-1001-12', '2021-12-12 01:13:17', '400.00', 10, 'true'),
('124', 'C#', 'courseThumbnail/course-thumbnail.png', '2021-1001-12', '2021-12-12 01:14:03', '100.00', 0, 'true'),
('125', 'Java', 'courseThumbnail/course-thumbnail.png', '2021-1001-12', '2021-12-12 02:05:10', '200.00', 10, 'true'),
('1423', 'Cloud IT Solution', 'courseThumbnail/course-thumbnail.png', '2022-1152-01', '2022-01-14 00:14:24', '500.00', 20, 'false'),
('3215', 'java2', 'courseThumbnail/course-thumbnail.png', '2021-1035-12', '2021-12-14 08:32:52', '0.00', 0, 'false'),
('4212', 'Machine Learning', 'courseThumbnail/course-thumbnail.png', '2021-1035-12', '2021-12-14 05:42:14', '700.00', 10, 'true'),
('4336', 'Numerical Methods', 'courseThumbnail/course-thumbnail.png', '2021-1035-12', '2021-12-14 05:43:37', '900.00', 10, 'true'),
('4826', 'Object Oriented Programming with JAVA', 'courseThumbnail/course-thumbnail.png', '2021-1035-12', '2021-12-14 04:48:27', '500.00', 10, 'true'),
('4924', 'advanced python', 'courseThumbnail/course-thumbnail.png', '2021-1035-12', '2021-12-14 09:50:02', '200.00', 0, 'true'),
('4936', 'Python', 'courseThumbnail/course-thumbnail.png', '2021-1035-12', '2021-12-14 06:50:13', '200.00', 0, 'false'),
('5242', 'Discreet Mathmatics', 'courseThumbnail/course-thumbnail.png', '2021-1035-12', '2021-12-14 04:52:43', '400.00', 5, 'false'),
('5910', 'AI', 'courseThumbnail/course-thumbnail.png', '2021-1035-12', '2021-12-14 08:59:48', '0.00', 0, 'false');

-- --------------------------------------------------------

--
-- Table structure for table `course_instructors`
--

CREATE TABLE `course_instructors` (
  `course_id` varchar(20) NOT NULL,
  `instructor_id` varchar(20) NOT NULL,
  `assigned_by` varchar(20) NOT NULL,
  `assiged_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course_instructors`
--

INSERT INTO `course_instructors` (`course_id`, `instructor_id`, `assigned_by`, `assiged_at`) VALUES
('123', '21-5001-12', '2021-1001-12', '2021-12-17 11:38:16');

-- --------------------------------------------------------

--
-- Table structure for table `course_material`
--

CREATE TABLE `course_material` (
  `material_id` varchar(20) NOT NULL,
  `serial` int(11) DEFAULT NULL,
  `title` varchar(100) NOT NULL,
  `file` text DEFAULT NULL,
  `video_file` text DEFAULT NULL,
  `created_by` varchar(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `course_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course_material`
--

INSERT INTO `course_material` (`material_id`, `serial`, `title`, `file`, `video_file`, `created_by`, `created_at`, `course_id`) VALUES
('101', 1, 'python_1', 'CourseFile/First.pdf', 'CourseVideoFile/python_1.mp4', '21-5001-12', '2021-12-18 09:26:14', '123');

-- --------------------------------------------------------

--
-- Table structure for table `course_progression`
--

CREATE TABLE `course_progression` (
  `learner_id` varchar(20) NOT NULL,
  `material_id` varchar(20) NOT NULL,
  `course_id` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course_progression`
--

INSERT INTO `course_progression` (`learner_id`, `material_id`, `course_id`, `status`) VALUES
('22-10007-04', '101', '123', 'complete'),
('21-10002-12', '101', '123', 'incomplete'),
('22-10009-07', '101', '123', 'complete');

-- --------------------------------------------------------

--
-- Table structure for table `course_quiz`
--

CREATE TABLE `course_quiz` (
  `quiz_id` varchar(20) NOT NULL,
  `material_id` varchar(20) NOT NULL,
  `title` varchar(100) NOT NULL,
  `file` text DEFAULT NULL,
  `created_by` varchar(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `course_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course_quiz`
--

INSERT INTO `course_quiz` (`quiz_id`, `material_id`, `title`, `file`, `created_by`, `created_at`, `course_id`) VALUES
('140', '101', 'quiz_1', 'Quiz/question_1.txt', '21-5001-12', '2021-12-18 09:26:14', '123');

-- --------------------------------------------------------

--
-- Table structure for table `enrolled_course`
--

CREATE TABLE `enrolled_course` (
  `learner_id` varchar(20) NOT NULL,
  `course_id` varchar(20) NOT NULL,
  `enrolled_at` datetime NOT NULL,
  `course_price` decimal(15,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `enrolled_course`
--

INSERT INTO `enrolled_course` (`learner_id`, `course_id`, `enrolled_at`, `course_price`) VALUES
('21-10002-12', '124', '2021-12-12 11:38:16', '200.00'),
('21-10001-12', '123', '2021-12-13 01:37:43', '200.00'),
('21-10003-12', '123', '2021-12-14 09:55:28', '360.00'),
('22-10006-04', '123', '2022-04-19 11:40:59', '360.00'),
('22-10007-04', '123', '2022-04-19 12:53:34', '360.00'),
('21-10002-12', '123', '2022-07-05 21:52:01', '360.00'),
('22-10009-07', '123', '2022-07-30 23:11:52', '360.00');

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `serial` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `comment_one` text NOT NULL,
  `comment_two` text DEFAULT NULL,
  `comment_three` text DEFAULT NULL,
  `comment_four` text DEFAULT NULL,
  `added_by` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`serial`, `title`, `comment_one`, `comment_two`, `comment_three`, `comment_four`, `added_by`, `date`) VALUES
(1, 'New course added', 'Course ID: 123', 'Course Name: Web Tech', NULL, NULL, '2021-1035-12', '2021-12-12 01:32:21'),
(2, 'New course added', 'Course ID: 124', 'Course Name: C#', NULL, NULL, '2021-1001-12', '2021-12-12 01:14:03'),
(21, 'Course Enrolled', 'Course ID: 123', 'Course Name: Web Tec', NULL, NULL, '21-10001-12', '2021-12-13 01:37:44'),
(23, 'Course Enrolled', 'Course ID: 123', 'Course Name: Web Tec', NULL, NULL, '21-10002-12', '2021-12-14 03:29:36'),
(24, 'Course Enrolled', 'Course ID: 123', 'Course Name: Web Tec', NULL, NULL, '21-10002-12', '2021-12-14 03:35:20'),
(26, 'Created a New Course.', 'Course ID: 5242', 'Course Name: Discreet Mathmatics', NULL, NULL, '2021-1035-12', '2021-12-14 04:52:43'),
(30, 'Created a New Course.', 'Course ID: 3215', 'Course Name: java2', NULL, NULL, '2021-1035-12', '2021-12-14 08:32:53'),
(39, 'Course Enrolled', 'Course ID: 123', 'Course Name: Web Technologies', NULL, NULL, '21-10003-12', '2021-12-14 09:36:10'),
(40, 'Created a New Course.', 'Course ID: 4924', 'Course Name: advanced python', NULL, NULL, '2021-1035-12', '2021-12-14 09:50:03'),
(41, 'Course Enrolled', 'Course ID: 123', 'Course Name: Web Technologies', NULL, NULL, '21-10003-12', '2021-12-14 09:55:29'),
(42, 'Created a New Manager.', 'Manager ID:2022-1152-01', 'Manager Password:D8xnucxm', NULL, NULL, '2021-41718-3', '2022-01-14 00:11:48'),
(43, 'Created a New Course.', 'Course ID: 1423', 'Course Name: Cloud IT Solution', NULL, NULL, '2022-1152-01', '2022-01-14 00:14:25'),
(44, 'Course Enrolled', 'Course ID: 123', 'Course Name: Web Technologies 11', NULL, NULL, '22-10006-04', '2022-04-19 11:41:00'),
(45, 'Course Enrolled', 'Course ID: 123', 'Course Name: Web Technologies 11', NULL, NULL, '22-10007-04', '2022-04-19 12:53:35'),
(46, 'Course Enrolled', 'Course ID: 123', 'Course Name: Web Technologies 11', NULL, NULL, '21-10002-12', '2022-07-05 21:52:01'),
(47, 'Course Enrolled', 'Course ID: 123', 'Course Name: Web Technologies 11', NULL, NULL, '22-10009-07', '2022-07-30 23:11:52');

-- --------------------------------------------------------

--
-- Table structure for table `instructor_info`
--

CREATE TABLE `instructor_info` (
  `id` varchar(20) NOT NULL,
  `password` varchar(8) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` text NOT NULL,
  `dob` varchar(10) DEFAULT NULL,
  `gender` varchar(6) DEFAULT NULL,
  `image` text DEFAULT NULL,
  `job_title` varchar(100) NOT NULL,
  `field` varchar(100) NOT NULL,
  `balance` decimal(15,2) NOT NULL DEFAULT 0.00,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `instructor_info`
--

INSERT INTO `instructor_info` (`id`, `password`, `name`, `email`, `dob`, `gender`, `image`, `job_title`, `field`, `balance`, `created_at`) VALUES
('21-5001-12', 'abcd@123', 'abc abc', 'abc@gmail.com', '2000-01-20', 'female', 'broken.png', 'Professor', 'Computer Science', '0.00', '2021-12-18 09:26:14');

-- --------------------------------------------------------

--
-- Table structure for table `learner_info`
--

CREATE TABLE `learner_info` (
  `id` varchar(20) NOT NULL,
  `password` text CHARACTER SET utf8 NOT NULL,
  `name` varchar(100) NOT NULL,
  `highest_degree` text DEFAULT NULL,
  `email` text NOT NULL,
  `dob` varchar(10) DEFAULT NULL,
  `gender` varchar(6) DEFAULT NULL,
  `image` text DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `learner_info`
--

INSERT INTO `learner_info` (`id`, `password`, `name`, `highest_degree`, `email`, `dob`, `gender`, `image`, `created_at`) VALUES
('21-10001-12', '21-10001-12', 'Md. Mahim Talukder', 'hsc', 'mahim@gmail.com', '2021-12-01', 'male', 'picture/21-10001-12.png', '2021-12-11 02:24:18'),
('21-10002-12', 'nabil@123', 'Abidur Nabil', 'graduate', 'nabil@gmail.com', '2002-01-01', 'male', 'broken.png', '2021-12-11 02:36:31'),
('21-10003-12', 'ador@1234', 'syed ador', 'hsc', 'ador@gmail.com', '2005-01-05', 'male', 'picture/21-10003-12.png', '2021-12-14 08:07:12'),
('22-10004-01', 'Abc@1234!', 'Ahsanul Kabir', 'graduate', 'boron@gmail.com', '2021-11-11', 'male', 'broken.png', '2022-01-13 23:39:20'),
('22-10005-01', 'Abc@1234!', 'Most. Tabassum Tahmina', 'graduate', 'tabassum@gmail.com', '2021-12-29', 'female', 'broken.png', '2022-01-13 23:40:10'),
('22-10006-04', 'mahim@1234', 'Mahim Talukder', 'graduate', 'mahim75@gmail.com', '2022-04-04', 'male', 'broken.png', '2022-04-19 10:32:29'),
('22-10007-04', 'mahim@123', 'hi a', 'graduate', 'mahim45@gmail.com', '2022-04-07', 'male', 'broken.png', '2022-04-19 12:50:04'),
('22-10008-04', 'Polok@gmail.com', 'sdad asas', 'graduate', 'aaa@fty.bs', '2020-04-28', 'male', 'broken.png', '2022-04-20 00:41:30'),
('22-10009-07', 'Fatema@123', 'Fatema a', 'graduate', 'fatema123@gmail.com', '2022-07-30', 'female', 'broken.png', '2022-07-30 23:11:08');

-- --------------------------------------------------------

--
-- Table structure for table `manager_info`
--

CREATE TABLE `manager_info` (
  `id` varchar(20) NOT NULL,
  `password` text CHARACTER SET utf8 NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` text NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `nationality` varchar(20) NOT NULL,
  `nid` varchar(20) NOT NULL,
  `dob` varchar(10) DEFAULT NULL,
  `gender` varchar(6) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `image` text DEFAULT NULL,
  `salary` decimal(15,2) NOT NULL DEFAULT 0.00,
  `status` varchar(20) CHARACTER SET utf8 DEFAULT 'true',
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `manager_info`
--

INSERT INTO `manager_info` (`id`, `password`, `name`, `email`, `phone`, `nationality`, `nid`, `dob`, `gender`, `address`, `image`, `salary`, `status`, `created_at`) VALUES
('2021-1001-12', 'Kp7xOrDT', 'Mahim Talukder', 'mahim@gmail.com', '', 'Bangladeshi', '546454', '', '', '', 'upload/default.png', '0.00', 'true', '2021-12-12 02:11:04'),
('2021-1035-12', 'sazin@1234', 'Sazin Israk ', 'sazinisrak@gmail.com', '01788995648', 'Bangladeshi', '9988635', '1989-12-29', 'female', 'Jaypurhat', 'upload/2021-1035-12.png', '0.00', 'false', '2021-12-13 03:10:35'),
('2021-1624-12', 'n1CySv7O', 'Syed Atikuzzaman', 'syed@gmail.com', '', 'Bangladeshi', '200156', '', '', '', 'upload/default.png\n', '0.00', 'true', '2021-12-13 03:16:23'),
('2021-1847-12', 'ELbsoM8Z', 'Hamim Ahmed', 'hamim@gmail.com', '', 'Bangladeshi', '23432', '', '', '', 'upload/default.png\n', '0.00', 'true', '2021-12-13 03:18:44'),
('2021-2258-12', 'he3FxQyD', 'Arpita Datta', 'arpita@gmail.com', '', 'Bangladeshi', '889996', '', '', '', 'upload/default.png', '0.00', 'false', '2021-12-13 03:22:55'),
('2021-2855-12', 'm3Ce2e6w', 'Lincon D Costa', 'lincon@gmail.com', '', 'Bangladeshi', '23144995', '', '', '', 'upload/default.png', '0.00', 'true', '2021-12-13 17:28:50'),
('2021-729-12', 'WT1kcGpn', 'Zarif Amir', 'zarif@gmail.com', '', 'Bangladeshi', '23144', '', '', '', 'upload/default.png\n', '0.00', 'true', '2021-12-13 03:07:29'),
('2022-1152-01', 'D8xnucxm', 'Ahsanul Kabir', 'boroncse@gmail.com', '01686377205', 'Bangladeshi', '32130440', '2022-01-05', 'male', 'House: 54, Road-02, RK Road, Rangpur', 'upload/2022-1152-01.png', '0.00', 'false', '2022-01-14 00:11:47');

-- --------------------------------------------------------

--
-- Table structure for table `salary_statement`
--

CREATE TABLE `salary_statement` (
  `id` varchar(50) NOT NULL,
  `account_type` varchar(20) NOT NULL,
  `current_salary_scale` decimal(15,2) DEFAULT 0.00,
  `prev_balance` decimal(15,2) DEFAULT 0.00,
  `paid_balance` decimal(15,2) DEFAULT 0.00,
  `balance` decimal(15,2) DEFAULT 0.00,
  `year` varchar(4) NOT NULL,
  `month` varchar(15) NOT NULL,
  `payment_date` datetime NOT NULL,
  `paid_by` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `taken_quiz`
--

CREATE TABLE `taken_quiz` (
  `quiz_id` varchar(20) NOT NULL,
  `learner_id` varchar(20) NOT NULL,
  `material_id` varchar(20) NOT NULL,
  `submitted_at` datetime NOT NULL,
  `result` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `serial` int(11) NOT NULL,
  `id` varchar(50) NOT NULL,
  `usertype` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`serial`, `id`, `usertype`) VALUES
(2, '2021-41718-3', 'Admin'),
(3, '21-10001-12', 'learner'),
(4, '21-10002-12', 'learner'),
(8, '2021-1001-12', 'Manager'),
(9, '2021-729-12', 'Manager'),
(10, '2021-1035-12', 'Manager'),
(11, '2021-1624-12', 'Manager'),
(12, '2021-1847-12', 'Manager'),
(13, '2021-2258-12', 'Manager'),
(14, '2021-2855-12', 'Manager'),
(15, '21-10003-12', 'learner'),
(33, '21-5001-12', 'instructor'),
(34, '22-10004-01', 'learner'),
(35, '22-10005-01', 'learner'),
(36, '2022-1152-01', 'Manager'),
(37, '22-10006-04', 'learner'),
(38, '22-10007-04', 'learner'),
(39, '22-10008-04', 'learner'),
(40, '22-10009-07', 'learner');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_info`
--
ALTER TABLE `admin_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `community_topics_and_solutions`
--
ALTER TABLE `community_topics_and_solutions`
  ADD KEY `fk_community_topics_and_solutions` (`topics_id`),
  ADD KEY `fk_community_topics_and_solutions_posted` (`posted_by`);

--
-- Indexes for table `course_community`
--
ALTER TABLE `course_community`
  ADD PRIMARY KEY (`topics_id`),
  ADD KEY `fk_course_community` (`course_id`),
  ADD KEY `fk_course_community_created` (`created_by`);

--
-- Indexes for table `course_info`
--
ALTER TABLE `course_info`
  ADD PRIMARY KEY (`course_id`),
  ADD KEY `fk_course_info_admin_info` (`created_by`);

--
-- Indexes for table `course_instructors`
--
ALTER TABLE `course_instructors`
  ADD KEY `fk_course_instructors` (`course_id`),
  ADD KEY `fk_course_instructors_assigned` (`assigned_by`),
  ADD KEY `fk_course_instructors_info` (`instructor_id`);

--
-- Indexes for table `course_material`
--
ALTER TABLE `course_material`
  ADD PRIMARY KEY (`material_id`),
  ADD KEY `fk_course_material` (`created_by`),
  ADD KEY `fk_course_material_course_info` (`course_id`);

--
-- Indexes for table `course_progression`
--
ALTER TABLE `course_progression`
  ADD KEY `fk_course_progression` (`learner_id`),
  ADD KEY `fk_course_progression_material` (`material_id`);

--
-- Indexes for table `course_quiz`
--
ALTER TABLE `course_quiz`
  ADD PRIMARY KEY (`quiz_id`),
  ADD KEY `fk_course_quiz_course_info` (`course_id`),
  ADD KEY `fk_course_quiz_course_material` (`material_id`),
  ADD KEY `fk_course_quiz_instructor_info` (`created_by`);

--
-- Indexes for table `enrolled_course`
--
ALTER TABLE `enrolled_course`
  ADD KEY `fk_enrolled_course` (`learner_id`),
  ADD KEY `fk_enrolled_course_course_info` (`course_id`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`serial`);

--
-- Indexes for table `instructor_info`
--
ALTER TABLE `instructor_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `learner_info`
--
ALTER TABLE `learner_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manager_info`
--
ALTER TABLE `manager_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salary_statement`
--
ALTER TABLE `salary_statement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `taken_quiz`
--
ALTER TABLE `taken_quiz`
  ADD KEY `fk_taken_quiz_course_info` (`material_id`),
  ADD KEY `fk_taken_quiz_course_quiz` (`quiz_id`),
  ADD KEY `fk_taken_quiz_learner_info` (`learner_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`serial`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `serial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `serial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `community_topics_and_solutions`
--
ALTER TABLE `community_topics_and_solutions`
  ADD CONSTRAINT `fk_community_topics_and_solutions` FOREIGN KEY (`topics_id`) REFERENCES `course_community` (`topics_id`),
  ADD CONSTRAINT `fk_community_topics_and_solutions_posted` FOREIGN KEY (`posted_by`) REFERENCES `instructor_info` (`id`);

--
-- Constraints for table `course_community`
--
ALTER TABLE `course_community`
  ADD CONSTRAINT `fk_course_community` FOREIGN KEY (`course_id`) REFERENCES `course_info` (`course_id`),
  ADD CONSTRAINT `fk_course_community_created` FOREIGN KEY (`created_by`) REFERENCES `learner_info` (`id`);

--
-- Constraints for table `course_info`
--
ALTER TABLE `course_info`
  ADD CONSTRAINT `fk_cb` FOREIGN KEY (`created_by`) REFERENCES `manager_info` (`id`);

--
-- Constraints for table `course_instructors`
--
ALTER TABLE `course_instructors`
  ADD CONSTRAINT `fk_course_instructors` FOREIGN KEY (`course_id`) REFERENCES `course_info` (`course_id`),
  ADD CONSTRAINT `fk_course_instructors_assigned` FOREIGN KEY (`assigned_by`) REFERENCES `manager_info` (`id`),
  ADD CONSTRAINT `fk_course_instructors_info` FOREIGN KEY (`instructor_id`) REFERENCES `instructor_info` (`id`);

--
-- Constraints for table `course_material`
--
ALTER TABLE `course_material`
  ADD CONSTRAINT `fk_course_material` FOREIGN KEY (`created_by`) REFERENCES `instructor_info` (`id`),
  ADD CONSTRAINT `fk_course_material_course_info` FOREIGN KEY (`course_id`) REFERENCES `course_info` (`course_id`);

--
-- Constraints for table `course_progression`
--
ALTER TABLE `course_progression`
  ADD CONSTRAINT `fk_course_progression` FOREIGN KEY (`learner_id`) REFERENCES `learner_info` (`id`),
  ADD CONSTRAINT `fk_course_progression_material` FOREIGN KEY (`material_id`) REFERENCES `course_material` (`material_id`);

--
-- Constraints for table `course_quiz`
--
ALTER TABLE `course_quiz`
  ADD CONSTRAINT `fk_course_quiz_course_info` FOREIGN KEY (`course_id`) REFERENCES `course_info` (`course_id`),
  ADD CONSTRAINT `fk_course_quiz_course_material` FOREIGN KEY (`material_id`) REFERENCES `course_material` (`material_id`),
  ADD CONSTRAINT `fk_course_quiz_instructor_info` FOREIGN KEY (`created_by`) REFERENCES `instructor_info` (`id`);

--
-- Constraints for table `enrolled_course`
--
ALTER TABLE `enrolled_course`
  ADD CONSTRAINT `fk_enrolled_course` FOREIGN KEY (`learner_id`) REFERENCES `learner_info` (`id`),
  ADD CONSTRAINT `fk_enrolled_course_course_info` FOREIGN KEY (`course_id`) REFERENCES `course_info` (`course_id`);

--
-- Constraints for table `salary_statement`
--
ALTER TABLE `salary_statement`
  ADD CONSTRAINT `fk_salary_statement` FOREIGN KEY (`id`) REFERENCES `instructor_info` (`id`),
  ADD CONSTRAINT `fk_salary_statement1` FOREIGN KEY (`id`) REFERENCES `manager_info` (`id`);

--
-- Constraints for table `taken_quiz`
--
ALTER TABLE `taken_quiz`
  ADD CONSTRAINT `fk_taken_quiz_course_info` FOREIGN KEY (`material_id`) REFERENCES `course_material` (`material_id`),
  ADD CONSTRAINT `fk_taken_quiz_course_quiz` FOREIGN KEY (`quiz_id`) REFERENCES `course_quiz` (`quiz_id`),
  ADD CONSTRAINT `fk_taken_quiz_learner_info` FOREIGN KEY (`learner_id`) REFERENCES `learner_info` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
