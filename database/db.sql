# Host: springsoftbd.com  (Version 5.7.27-0ubuntu0.16.04.1-log)
# Date: 2021-12-11 03:01:30
# Generator: MySQL-Front 6.1  (Build 1.26)


#
# Structure for table "admin_info"
#

DROP TABLE IF EXISTS `admin_info`;
CREATE TABLE `admin_info` (
  `id` varchar(20) NOT NULL,
  `password` varchar(8) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` text NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `nationality` varchar(20) NOT NULL,
  `nid` varchar(20) NOT NULL,
  `dob` varchar(10) DEFAULT NULL,
  `gender` varchar(6) DEFAULT NULL,
  `address` text,
  `image` text,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "admin_info"
#

INSERT INTO `admin_info` VALUES ('2021-41718-3','ador@123','Sayed Syfuzzaman','sayedsyfuzzaman@gmail.com','sayedsyfuzzaman@gmai','Bangladeshi','3213044',NULL,'male','Dhaka','upload/19-41718-3.png','2021-11-22 21:29:26');

#
# Structure for table "history"
#

DROP TABLE IF EXISTS `history`;
CREATE TABLE `history` (
  `serial` int(11) NOT NULL AUTO_INCREMENT,
  `comment_one` text NOT NULL,
  `comment_two` text,
  `comment_three` text,
  `comment_four` text,
  `date` datetime NOT NULL,
  PRIMARY KEY (`serial`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "history"
#


#
# Structure for table "instructor_info"
#

DROP TABLE IF EXISTS `instructor_info`;
CREATE TABLE `instructor_info` (
  `id` varchar(20) NOT NULL,
  `password` varchar(8) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` text NOT NULL,
  `dob` varchar(10) DEFAULT NULL,
  `gender` varchar(6) DEFAULT NULL,
  `image` text,
  `job_title` varchar(100) NOT NULL,
  `field` varchar(100) NOT NULL,
  `balance` decimal(15,2) NOT NULL DEFAULT '0.00',
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "instructor_info"
#


#
# Structure for table "learner_info"
#

DROP TABLE IF EXISTS `learner_info`;
CREATE TABLE `learner_info` (
  `id` varchar(20) NOT NULL,
  `password` text CHARACTER SET utf8 NOT NULL,
  `name` varchar(100) NOT NULL,
  `highest_degree` text,
  `email` text NOT NULL,
  `dob` varchar(10) DEFAULT NULL,
  `gender` varchar(6) DEFAULT NULL,
  `image` text,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "learner_info"
#

INSERT INTO `learner_info` VALUES ('21-10001-12','mahim@123','Md. Mahim Talukder','hsc','mahim@gmail.com','2021-12-01','male','broken.png','2021-12-11 02:24:18'),('21-10002-12','nabil@123','Abidur Nabil','graduate','nabil@gmail.com','2002-01-01','male','broken.png','2021-12-11 02:36:31');

#
# Structure for table "manager_info"
#

DROP TABLE IF EXISTS `manager_info`;
CREATE TABLE `manager_info` (
  `id` varchar(20) NOT NULL,
  `password` varchar(8) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` text NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `nationality` varchar(20) NOT NULL,
  `nid` varchar(20) NOT NULL,
  `dob` varchar(10) DEFAULT NULL,
  `gender` varchar(6) DEFAULT NULL,
  `address` text,
  `image` text,
  `salary` decimal(15,2) NOT NULL DEFAULT '0.00',
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "manager_info"
#

INSERT INTO `manager_info` VALUES ('2021-1000-12','uSG76BHL','Ador Zaman','asssa@sfdsf.com','','Bangladeshi','2434244','','','',NULL,0.00,'2021-12-11 02:01:01');

#
# Structure for table "course_info"
#

DROP TABLE IF EXISTS `course_info`;
CREATE TABLE `course_info` (
  `course_id` varchar(20) NOT NULL,
  `course_name` varchar(100) NOT NULL,
  `thumbnail` text NOT NULL,
  `created_by` varchar(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `price` decimal(15,2) DEFAULT NULL,
  `discount` int(11) DEFAULT '0',
  `avilability` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`course_id`),
  KEY `fk_course_info_admin_info` (`created_by`),
  CONSTRAINT `fk_course_info_admin_info` FOREIGN KEY (`created_by`) REFERENCES `manager_info` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "course_info"
#


#
# Structure for table "enrolled_course"
#

DROP TABLE IF EXISTS `enrolled_course`;
CREATE TABLE `enrolled_course` (
  `learner_id` varchar(20) NOT NULL,
  `course_id` varchar(20) NOT NULL,
  `enrolled_at` datetime NOT NULL,
  `course_price` decimal(15,2) NOT NULL,
  KEY `fk_enrolled_course` (`learner_id`),
  KEY `fk_enrolled_course_course_info` (`course_id`),
  CONSTRAINT `fk_enrolled_course` FOREIGN KEY (`learner_id`) REFERENCES `learner_info` (`id`),
  CONSTRAINT `fk_enrolled_course_course_info` FOREIGN KEY (`course_id`) REFERENCES `course_info` (`course_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "enrolled_course"
#


#
# Structure for table "course_material"
#

DROP TABLE IF EXISTS `course_material`;
CREATE TABLE `course_material` (
  `material_id` varchar(20) NOT NULL,
  `title` varchar(100) NOT NULL,
  `file` text,
  `video_file` text,
  `created_by` varchar(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `course_id` varchar(20) NOT NULL,
  PRIMARY KEY (`material_id`),
  KEY `fk_course_material` (`created_by`),
  KEY `fk_course_material_course_info` (`course_id`),
  CONSTRAINT `fk_course_material` FOREIGN KEY (`created_by`) REFERENCES `instructor_info` (`id`),
  CONSTRAINT `fk_course_material_course_info` FOREIGN KEY (`course_id`) REFERENCES `course_info` (`course_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "course_material"
#


#
# Structure for table "course_progression"
#

DROP TABLE IF EXISTS `course_progression`;
CREATE TABLE `course_progression` (
  `learner_id` varchar(20) NOT NULL,
  `material_id` varchar(20) NOT NULL,
  `status` varchar(10) NOT NULL,
  KEY `fk_course_progression` (`learner_id`),
  KEY `fk_course_progression_material` (`material_id`),
  CONSTRAINT `fk_course_progression` FOREIGN KEY (`learner_id`) REFERENCES `learner_info` (`id`),
  CONSTRAINT `fk_course_progression_material` FOREIGN KEY (`material_id`) REFERENCES `course_material` (`material_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "course_progression"
#


#
# Structure for table "course_quiz"
#

DROP TABLE IF EXISTS `course_quiz`;
CREATE TABLE `course_quiz` (
  `quiz_id` varchar(20) NOT NULL,
  `material_id` varchar(20) NOT NULL,
  `title` varchar(100) NOT NULL,
  `file` text,
  `created_by` varchar(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `course_id` varchar(20) NOT NULL,
  PRIMARY KEY (`quiz_id`),
  KEY `fk_course_quiz_course_info` (`course_id`),
  KEY `fk_course_quiz_course_material` (`material_id`),
  KEY `fk_course_quiz_instructor_info` (`created_by`),
  CONSTRAINT `fk_course_quiz_course_info` FOREIGN KEY (`course_id`) REFERENCES `course_info` (`course_id`),
  CONSTRAINT `fk_course_quiz_course_material` FOREIGN KEY (`material_id`) REFERENCES `course_material` (`material_id`),
  CONSTRAINT `fk_course_quiz_instructor_info` FOREIGN KEY (`created_by`) REFERENCES `instructor_info` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "course_quiz"
#


#
# Structure for table "course_instructors"
#

DROP TABLE IF EXISTS `course_instructors`;
CREATE TABLE `course_instructors` (
  `course_id` varchar(20) NOT NULL,
  `instructor_id` varchar(20) NOT NULL,
  `assigned_by` varchar(20) NOT NULL,
  `assiged_at` datetime NOT NULL,
  KEY `fk_course_instructors` (`course_id`),
  KEY `fk_course_instructors_assigned` (`assigned_by`),
  KEY `fk_course_instructors_info` (`instructor_id`),
  CONSTRAINT `fk_course_instructors` FOREIGN KEY (`course_id`) REFERENCES `course_info` (`course_id`),
  CONSTRAINT `fk_course_instructors_assigned` FOREIGN KEY (`assigned_by`) REFERENCES `manager_info` (`id`),
  CONSTRAINT `fk_course_instructors_info` FOREIGN KEY (`instructor_id`) REFERENCES `instructor_info` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "course_instructors"
#


#
# Structure for table "course_community"
#

DROP TABLE IF EXISTS `course_community`;
CREATE TABLE `course_community` (
  `topics_id` varchar(20) NOT NULL,
  `course_id` varchar(20) NOT NULL,
  `topic` text NOT NULL,
  `created_by` varchar(20) NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`topics_id`),
  KEY `fk_course_community` (`course_id`),
  KEY `fk_course_community_created` (`created_by`),
  CONSTRAINT `fk_course_community` FOREIGN KEY (`course_id`) REFERENCES `course_info` (`course_id`),
  CONSTRAINT `fk_course_community_created` FOREIGN KEY (`created_by`) REFERENCES `learner_info` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "course_community"
#


#
# Structure for table "community_topics_and_solutions"
#

DROP TABLE IF EXISTS `community_topics_and_solutions`;
CREATE TABLE `community_topics_and_solutions` (
  `topics_id` varchar(20) NOT NULL,
  `solution` text NOT NULL,
  `posted_by` varchar(20) NOT NULL,
  `posted_at` datetime NOT NULL,
  KEY `fk_community_topics_and_solutions` (`topics_id`),
  KEY `fk_community_topics_and_solutions_posted` (`posted_by`),
  CONSTRAINT `fk_community_topics_and_solutions` FOREIGN KEY (`topics_id`) REFERENCES `course_community` (`topics_id`),
  CONSTRAINT `fk_community_topics_and_solutions_posted` FOREIGN KEY (`posted_by`) REFERENCES `instructor_info` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "community_topics_and_solutions"
#


#
# Structure for table "salary_statement"
#

DROP TABLE IF EXISTS `salary_statement`;
CREATE TABLE `salary_statement` (
  `id` varchar(50) NOT NULL,
  `account_type` varchar(20) NOT NULL,
  `current_salary_scale` decimal(15,2) DEFAULT '0.00',
  `prev_balance` decimal(15,2) DEFAULT '0.00',
  `paid_balance` decimal(15,2) DEFAULT '0.00',
  `balance` decimal(15,2) DEFAULT '0.00',
  `year` varchar(4) NOT NULL,
  `month` varchar(15) NOT NULL,
  `payment_date` datetime NOT NULL,
  `paid_by` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_salary_statement` FOREIGN KEY (`id`) REFERENCES `instructor_info` (`id`),
  CONSTRAINT `fk_salary_statement1` FOREIGN KEY (`id`) REFERENCES `manager_info` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "salary_statement"
#


#
# Structure for table "taken_quiz"
#

DROP TABLE IF EXISTS `taken_quiz`;
CREATE TABLE `taken_quiz` (
  `quiz_id` varchar(20) NOT NULL,
  `learner_id` varchar(20) NOT NULL,
  `material_id` varchar(20) NOT NULL,
  `submitted_at` datetime NOT NULL,
  `result` decimal(5,2) DEFAULT NULL,
  KEY `fk_taken_quiz_course_info` (`material_id`),
  KEY `fk_taken_quiz_course_quiz` (`quiz_id`),
  KEY `fk_taken_quiz_learner_info` (`learner_id`),
  CONSTRAINT `fk_taken_quiz_course_info` FOREIGN KEY (`material_id`) REFERENCES `course_material` (`material_id`),
  CONSTRAINT `fk_taken_quiz_course_quiz` FOREIGN KEY (`quiz_id`) REFERENCES `course_quiz` (`quiz_id`),
  CONSTRAINT `fk_taken_quiz_learner_info` FOREIGN KEY (`learner_id`) REFERENCES `learner_info` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "taken_quiz"
#


#
# Structure for table "users"
#

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `serial` int(11) NOT NULL AUTO_INCREMENT,
  `id` varchar(50) NOT NULL,
  `usertype` varchar(20) NOT NULL,
  PRIMARY KEY (`serial`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

#
# Data for table "users"
#

INSERT INTO `users` VALUES (1,'2021-1000-12','Manager'),(2,'2021-41718-3','Admin'),(3,'21-10001-12','learner'),(4,'21-10002-12','learner');
