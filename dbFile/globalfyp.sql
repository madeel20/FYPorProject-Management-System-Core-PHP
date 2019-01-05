-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2018 at 03:12 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `globalfyp`
--

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `usprj` varchar(100) NOT NULL,
  `src` varchar(100) NOT NULL,
  `uploadedon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `usprj`, `src`, `uploadedon`) VALUES
(118, 'zainab_Smart Irrigation System', 'pp11.png', '2018-11-15 16:12:46'),
(119, 'zainab_Smart Irrigation System', 'pp12.png', '2018-11-15 16:12:46'),
(120, 'zainab_Smart Irrigation System', 'pp13.png', '2018-11-15 16:12:46'),
(121, 'zainab_Smart Irrigation System', 'pp14.png', '2018-11-15 16:12:46'),
(155, 'rabia_Device Tracker', 'Screenshot (4).png', '2018-11-23 11:45:33'),
(180, 'adeel_AI Robot 1', 'Screenshot (20).png', '2018-11-23 12:52:02'),
(245, 'adeel_alskdjfl;', 'Screenshot (3).png', '2018-11-25 22:16:21'),
(247, 'adeel_AI Robot klj', 'Screenshot (1).png', '2018-11-26 10:14:14'),
(248, 'adeel_AI Robot klj', 'Screenshot (2).png', '2018-11-26 10:14:14'),
(249, 'adeel_AI Robot klj', 'Screenshot (3).png', '2018-11-26 10:14:14'),
(250, 'adeel_AI Robot klj', 'Screenshot (4).png', '2018-11-26 10:14:14'),
(255, 'mmm_Patrona Ai', 'Screenshot (1).png', '2018-11-26 10:34:08'),
(256, 'mmm_Patrona Ai', 'Screenshot (2).png', '2018-11-26 10:34:08'),
(257, 'mmm_Patrona Ai', 'Screenshot (3).png', '2018-11-26 10:34:08'),
(258, 'mmm_Patrona Ai', 'Screenshot (4).png', '2018-11-26 10:34:08'),
(259, 'adeel_Patrona', 'Screenshot (1).png', '2018-11-26 10:37:51'),
(260, 'adeel_Patrona test', 'Screenshot (1).png', '2018-11-26 11:10:35'),
(261, 'adeel_Patrona test', 'Screenshot (2).png', '2018-11-26 11:10:35'),
(262, 'adeel_Patrona test', 'Screenshot (3).png', '2018-11-26 11:10:35'),
(263, 'adeel_Patrona test', 'Screenshot (4).png', '2018-11-26 11:10:35');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `pid`, `fullname`) VALUES
(8, 24, 'Adeel Aqeel'),
(9, 24, 'hjk'),
(54, 21, 'Rabia Ali'),
(55, 21, 'Adeel Aqeel'),
(56, 21, 'Adnan Ali'),
(57, 21, ''),
(58, 22, 'Rabia Ali'),
(59, 22, 'ali'),
(60, 22, 'adeel'),
(61, 23, 'Rabia Ali'),
(62, 23, 'ali'),
(63, 23, 'adeel'),
(76, 29, 'Rabia Ali'),
(77, 29, 'Adeel Aqeel'),
(78, 29, ''),
(79, 29, ''),
(80, 31, 'Adeel Aqeel'),
(81, 31, 'jkjlkjl'),
(100, 42, 'Adeel khan'),
(101, 42, 'Ali Adeel'),
(102, 42, ''),
(103, 42, '');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `message_id` int(11) NOT NULL,
  `reciever_id` int(11) NOT NULL,
  `content` varchar(200) NOT NULL,
  `date_sended` varchar(100) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `reciever_name` varchar(50) NOT NULL,
  `sender_name` varchar(200) NOT NULL,
  `message_status` varchar(100) NOT NULL,
  `reciever_is_teacher` tinyint(1) NOT NULL,
  `sender_is_teacher` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`message_id`, `reciever_id`, `content`, `date_sended`, `sender_id`, `reciever_name`, `sender_name`, `message_status`, `reciever_is_teacher`, `sender_is_teacher`) VALUES
(29, 1, 'asdfasdfasdf', '2018-11-27 13:57:37', 0, ' ', 'Adeel Aqeel', '', 1, 0),
(30, 1, 'asdfasdfasdf', '2018-11-27 13:58:34', 3, ' ', 'Adeel Aqeel', '', 1, 0),
(31, 2, 'KJKLKKKKKK', '2018-11-27 13:59:11', 3, 'Adeel khan', 'Adeel Aqeel', '', 1, 0),
(32, 2, 'jhljkk', '2018-11-27 14:00:29', 3, 'Adeel khan', 'Adeel Aqeel', '', 1, 0),
(33, 2, 'jjjj', '2018-11-27 14:01:06', 3, 'Adeel khan', 'Adeel Aqeel', '', 1, 0),
(34, 2, 'jjjj', '2018-11-27 14:01:36', 3, 'Adeel khan', 'Adeel Aqeel', '', 1, 0),
(35, 2, 'jjjj', '2018-11-27 14:01:37', 3, 'Adeel khan', 'Adeel Aqeel', '', 1, 0),
(36, 4, 'jjjj', '2018-11-27 14:01:40', 3, 'adeel ahmed', 'Adeel Aqeel', '', 1, 0),
(37, 2, 'jjjj', '2018-11-27 14:02:05', 3, 'Adeel khan', 'Adeel Aqeel', '', 1, 0),
(38, 2, 'jjjj', '2018-11-27 14:02:07', 3, 'Adeel khan', 'Adeel Aqeel', '', 1, 0),
(39, 2, 'jjjj', '2018-11-27 14:02:07', 3, 'Adeel khan', 'Adeel Aqeel', '', 1, 0),
(40, 2, 'jjjj', '2018-11-27 14:02:07', 3, 'Adeel khan', 'Adeel Aqeel', '', 1, 0),
(41, 2, 'jjjj', '2018-11-27 14:02:07', 3, 'Adeel khan', 'Adeel Aqeel', '', 1, 0),
(42, 2, 'jjjj', '2018-11-27 14:02:08', 3, 'Adeel khan', 'Adeel Aqeel', '', 1, 0),
(43, 2, 'jjjj', '2018-11-27 14:02:08', 3, 'Adeel khan', 'Adeel Aqeel', '', 1, 0),
(44, 2, 'k;', '2018-11-27 14:02:43', 3, 'Adeel khan', 'Adeel Aqeel', '', 1, 0),
(45, 4, 'kk', '2018-11-27 14:03:01', 3, 'adeel ahmed', 'Adeel Aqeel', '', 1, 0),
(46, 2, 'kkk', '2018-11-27 14:03:16', 3, 'Adeel khan', 'Adeel Aqeel', '', 1, 0),
(47, 2, 'lll', '2018-11-27 14:11:12', 3, 'Adeel khan', 'Adeel Aqeel', '', 1, 0),
(48, 2, '', '2018-11-27 15:48:11', 3, 'Adeel khan', 'Adeel Aqeel', '', 1, 0),
(49, 4, 'kkkk', '2018-11-27 15:49:08', 3, 'adeel ahmed', 'Adeel Aqeel', '', 1, 0),
(50, 2, 'asdf', '2018-11-27 15:55:38', 3, 'Adeel khan', 'Adeel Aqeel', '', 1, 0),
(51, 2, 'sdf', '2018-11-27 15:56:58', 3, 'Adeel khan', 'Adeel Aqeel', '', 1, 0),
(52, 2, 'zf', '2018-11-27 15:57:57', 3, 'Adeel khan', 'Adeel Aqeel', '', 1, 0),
(53, 2, 'asdf', '2018-11-27 15:58:15', 3, 'Adeel khan', 'Adeel Aqeel', '', 1, 0),
(54, 2, 'sdf', '2018-11-27 15:58:49', 3, 'Adeel khan', 'Adeel Aqeel', '', 1, 0),
(57, 2, 'sdf', '2018-11-27 16:44:43', 10, 'Adeel khan', 'Rabia Ali', '', 1, 0),
(59, 2, 'sadfjsla;kdf', '2018-11-28 12:29:29', 3, 'Adeel khan', 'Adeel Aqeel', '', 1, 0),
(64, 2, 'kjhlk', '2018-11-28 13:23:37', 3, 'Adeel khan', 'Adeel Aqeel', '', 1, 0),
(67, 2, 'hjkhjk', '2018-11-28 13:37:50', 3, 'Adeel khan', 'Adeel Aqeel', '', 1, 0),
(68, 2, 'hjkj', '2018-11-28 13:38:19', 3, 'Adeel khan', 'Adeel Aqeel', '', 1, 0),
(69, 10, 'gjh', '2018-11-28 13:46:32', 3, 'Rabia Ali', 'Adeel Aqeel', '', 0, 0),
(70, 3, 'ghkgk', '2018-11-28 13:56:22', 10, 'Adeel Aqeel', 'Rabia Ali', '', 0, 0),
(72, 4, 'lkj', '2018-11-28 14:36:56', 2, 'adeel ahmed', 'Adeel khan', '', 1, 1),
(73, 3, 'meme', '2018-11-28 14:41:10', 2, 'Adeel Aqeel', 'Adeel khan', '', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `message_sent`
--

CREATE TABLE `message_sent` (
  `message_sent_id` int(11) NOT NULL,
  `reciever_id` int(11) NOT NULL,
  `content` varchar(200) NOT NULL,
  `date_sended` varchar(100) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `reciever_name` varchar(100) NOT NULL,
  `sender_name` varchar(100) NOT NULL,
  `sender_is_teacher` tinyint(1) NOT NULL,
  `reciever_is_teacher` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `message_sent`
--

INSERT INTO `message_sent` (`message_sent_id`, `reciever_id`, `content`, `date_sended`, `sender_id`, `reciever_name`, `sender_name`, `sender_is_teacher`, `reciever_is_teacher`) VALUES
(1, 42, 'sad', '2013-11-12 22:50:05', 42, 'john kevin lorayna', 'john kevin lorayna', 0, 0),
(2, 11, 'fasf', '2013-11-13 13:15:47', 42, 'Aladin Cabrera', 'john kevin lorayna', 0, 0),
(3, 12, 'bjhkcbkjsdnckldvls', '2013-11-25 15:58:55', 71, 'Ruby Mae  Morante', 'Noli Mendoza', 0, 0),
(4, 71, 'bcjhbcjksdbckldj', '2013-11-25 15:59:13', 71, 'Noli Mendoza', 'Noli Mendoza', 0, 0),
(5, 12, 'test', '2013-11-30 20:54:05', 93, 'Ruby Mae  Morante', 'John Kevin  Lorayna', 0, 0),
(11, 12, 'tst', '2013-12-01 23:38:40', 93, 'Ruby Mae  Morante', 'John Kevin  Lorayna', 0, 0),
(12, 12, 'fasfasf', '2013-12-01 23:49:13', 93, 'Ruby Mae  Morante', 'John Kevin  Lorayna', 0, 0),
(13, 136, 'Submit your classcard', '2014-02-13 13:35:21', 12, 'Jorgielyn Serfino', 'Ruby Mae  Morante', 0, 0),
(29, 3, 'jhkjhk', '2018-11-28 13:04:37', 10, 'Adeel Aqeel', 'Rabia Ali', 0, 0),
(31, 2, 'kjhlk', '2018-11-28 13:23:37', 3, 'Adeel khan', 'Adeel Aqeel', 0, 1),
(32, 3, 'kk', '2018-11-28 13:32:48', 10, 'Adeel Aqeel', 'Rabia Ali', 0, 0),
(33, 3, 'mm', '2018-11-28 13:32:54', 10, 'Adeel Aqeel', 'Rabia Ali', 0, 0),
(34, 2, 'hjkhjk', '2018-11-28 13:37:50', 3, 'Adeel khan', 'Adeel Aqeel', 0, 1),
(35, 2, 'hjkj', '2018-11-28 13:38:19', 3, 'Adeel khan', 'Adeel Aqeel', 0, 1),
(36, 10, 'gjh', '2018-11-28 13:46:32', 3, 'Rabia Ali', 'Adeel Aqeel', 0, 0),
(37, 3, 'ghkgk', '2018-11-28 13:56:22', 10, 'Adeel Aqeel', 'Rabia Ali', 0, 0),
(38, 2, 'kkk', '2018-11-28 13:56:46', 10, 'Adeel khan', 'Rabia Ali', 0, 1),
(40, 3, 'meme', '2018-11-28 14:41:10', 2, 'Adeel Aqeel', 'Adeel khan', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `username` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`username`, `pass`) VALUES
('admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_projects`
--

CREATE TABLE `tbl_projects` (
  `pid` int(11) NOT NULL,
  `studentid` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `discipline` varchar(50) NOT NULL,
  `area` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `supervisor` varchar(50) NOT NULL,
  `website` varchar(255) NOT NULL,
  `overview` longtext NOT NULL,
  `details` longtext NOT NULL,
  `approve` tinyint(1) NOT NULL,
  `type` varchar(20) NOT NULL,
  `startdate` date NOT NULL,
  `enddate` date NOT NULL,
  `dateadded` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `type2` varchar(20) NOT NULL,
  `members` varchar(15) NOT NULL,
  `scope` varchar(10) NOT NULL,
  `projectfile` varchar(255) NOT NULL,
  `supervisorId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_projects`
--

INSERT INTO `tbl_projects` (`pid`, `studentid`, `title`, `discipline`, `area`, `status`, `supervisor`, `website`, `overview`, `details`, `approve`, `type`, `startdate`, `enddate`, `dateadded`, `type2`, `members`, `scope`, `projectfile`, `supervisorId`) VALUES
(14, 3, 'Patrona', 'Engineering', 'Wild Life', 1, 'adeel khan', 'www.patrona.com/', 'The PATRONA puppy website is a website which is actually encyclopedia about all types of dogs. The Famous Veteran Patrona is fond of animals specially Dogs, Cats, Rabbits. With her achievements in the field of serving as veteran, she also had interest in writing books on animals and their behavior\r\n            ', ' All those years she had came across various type of breeds and their characteristics and behavior. Due to passion of photography she has huge collection of animals pictures of all types discovered. Ms Patrona wish to share this images with all for which she had decided to develop an website of various animals.\r\n\r\nDog food refers to food specifically intended for consumption by dogs. Like all carnivorans, dogs have sharp, pointed teeth, and have short gastrointestinal tracts better suited for the consumption of meat. In spite of this natural carnivorous design, dogs have still managed to adapt over thousands of years to survive on the meat and non-meat scraps and leftovers of human existence and thrive on a variety of foods.      ', 1, 'Completed', '2018-11-01', '2018-11-30', '2018-11-15 15:54:40', 'Academic', 'Individual', 'Private', 'adeel_Patrona_zip', NULL),
(15, 14, 'Smart Irrigation System', 'Engineering', 'Technology', 1, 'Imran Khan', 'www.smifdsa.com.pk/', '  According to the World Wildlife Foundation, global agriculture wastes almost 60% of the water it utilizes each year, mainly due to inefficient water irrigation systems. This is significant when less than 3% of all the water on earth is freshwater and more than two-thirds of that is locked up in ice caps and glaciers. Poor irrigation accounts for wasting about 70% of the worldâ€™s accessible water. What if we were able to know exactly when, where, and how much water is needed to irrigate plants? What if we could guarantee optimal plant conditions and simultaneously avoid wasting excess water? RCAI-research center for artifcial intelligence has assisted in deploying an intelligent irrigation system to facilitate management of the water network and ofcource for the farmers of pakistan.    ', ' The main setup includes soil moisture probes placed underground to monitor the water levels in various locations around the park. RCAI"s Sensor Platform devices were placed in waterproof boxes and are powered by batteries with a lifespan of about one year. The data gathered from the probes is sent to Gateway and then to the cloud using 3G. The farmers are able to monitor and control electronic irrigation valves via their computer, smart phone, or tablet. Through this IoT technology, irrigation is done based on plant need and weather conditions, allowing for optimized water consumption and reducing Barcelonaâ€™s municipal water bill by nearly 25%. If Intelligent irrigation system can be adopted to more wide spread agricultural use, it will allow farmers to reduce costs, maintain optimal plant levels, and potentially increase plant production  ', 1, 'On Going', '2018-09-05', '2018-11-30', '2018-11-15 16:12:47', 'Research', 'Individual', 'Public', '', NULL),
(21, 10, 'Device Tracker', 'Engineering', 'Wild Life', 1, 'Sana Kalam', 'www.patrona.com/', '  asldfjlksajflsjal;k', 'jla;sjdflkajsdl;fjals;djfl;asdjfl;asdfljsa ', 0, 'On Going', '2018-11-01', '2018-11-30', '2018-11-20 22:01:08', 'Research', 'Group Base', 'Public', '', NULL),
(29, 10, 'AI Robot', 'Engineering', 'hkh', 1, 'Sana Kalam', 'lkjlk;', '  kllkj  ', 'kljljl  ', 0, 'On Going', '2018-11-01', '2018-11-21', '2018-11-23 12:38:38', 'Academic', 'Group Base', 'Public', 'rabia_AI Robot_Screenshot (5).zip', NULL),
(30, 3, 'AI Robot 1', 'Engineering', 'Wild Life', 1, 'Sana Kalam', 'www.patrona.com/', '  jkljljl  ', 'jlkjljlk  ', 0, 'On Going', '2018-11-21', '2018-11-14', '2018-11-23 12:50:55', 'Academic', 'Individual', 'Public', 'adeel_AI Robot 1_Project Details.docx', NULL),
(35, NULL, 'lkj', '', '', 0, '', '', '', '', 1, '', '0000-00-00', '0000-00-00', '2018-11-24 12:35:13', '', '', '', '', NULL),
(38, 3, 'Patrona test', 'Engineering', 'Wild Life', 1, 'adeel khan', 'www.patrona.com/', 'The PATRONA puppy website is a website which is actually encyclopedia about all types of dogs. The Famous Veteran Patrona is fond of animals specially Dogs, Cats, Rabbits. With her achievements in the field of serving as veteran, she also had interest in writing books on animals and their behavior\r\n        ', ' All those years she had came across various type of breeds and their characteristics and behavior. Due to passion of photography she has huge collection of animals pictures of all types discovered. Ms Patrona wish to share this images with all for which she had decided to develop an website of various animals.\r\n\r\nDog food refers to food specifically intended for consumption by dogs. Like all carnivorans, dogs have sharp, pointed teeth, and have short gastrointestinal tracts better suited for the consumption of meat. In spite of this natural carnivorous design, dogs have still managed to adapt over thousands of years to survive on the meat and non-meat scraps and leftovers of human existence and thrive on a variety of foods.    ', 1, 'Completed', '2018-11-01', '2018-11-30', '2018-11-15 15:54:40', 'Academic', 'Individual', 'Public', 'adeel_Patrona test_docx', NULL),
(40, 3, 'alskdjfl;', 'Engineering', 'kjl', 1, 'jlk;', 'jlk', '  asdfasfjlk          ', 'jaklsdfjkas;df      ', 0, 'On Going', '2018-11-23', '2018-11-22', '2018-11-25 22:16:22', 'Academic', 'Individual', 'Public', 'adeel_alskdjfl;_Screenshot (5).zip', NULL),
(41, 3, 'AI Robot klj', 'Engineering', 'Wild Life', 1, 'Sana Kalam', 'www.patrona.com/', '  asdfja;lsdfj;l        ', 'al;jdf;alsdkjf;lasdjkf;adf     ', 0, 'On Going', '2018-11-01', '2018-11-22', '2018-11-26 10:14:15', 'Academic', 'Individual', 'Public', 'adeel_AI Robot klj_Screenshot (5).zip', NULL),
(42, NULL, 'Patrona Ai', 'Engineering', 'hkh', 1, 'Adeel khan', 'www.patrona.com/', '  adsfjl;jasdlf;k aldkjfal;dkj                ', 'aldkjfal;sdkjfl;         ', 1, 'On Going', '2018-11-01', '2018-11-25', '2018-11-26 10:22:11', 'Academic', 'Group Base', 'Public', 'mmm_Patrona Ai.zip', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_student`
--

CREATE TABLE `tbl_student` (
  `id` int(11) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `university` varchar(250) NOT NULL,
  `country` varchar(30) NOT NULL,
  `username` varchar(20) NOT NULL,
  `pass` varchar(20) NOT NULL,
  `regdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `img` varchar(255) NOT NULL,
  `approve` tinyint(1) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `email` varchar(50) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `qualifications` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_student`
--

INSERT INTO `tbl_student` (`id`, `fname`, `lname`, `university`, `country`, `username`, `pass`, `regdate`, `img`, `approve`, `active`, `email`, `gender`, `qualifications`) VALUES
(3, 'Adeel', 'Aqeel', 'Sir Syed University Of Engineering and Technology', 'Pakistan', 'adeel', '1234', '2018-11-08 13:41:04', '..\\images/users/3adeel.png', 1, 1, 'adeel@gmail.com', 'male', 'bss'),
(10, 'Rabia', 'Ali', 'Sir Syed University Of Engineering and Technology', 'Hong Kong', 'rabia', '123', '2018-11-11 20:01:22', '..\\images/users/8zYLGMHhq.jpg', 1, 1, 'rabia@gmail.commm', 'male', 'BS'),
(11, 'Zahid', 'Khan', 'NUST', 'Pakistan', 'zahid1', '1234', '2018-11-15 14:41:55', '..\\images/users/11zahid1.jpg', 1, 1, 'zahid123@gmail.com', 'male', 'MS'),
(13, 'Mateen', 'Ahmed', 'ZABIST', 'Pakistan', 'mateen', '1234', '2018-11-15 15:08:24', '..\\images/users/116q8QdN8Z.jpg', 0, 1, 'mateen@gmail.com', 'male', 'Bachelors'),
(14, 'Zainab', 'khan', 'UBIT,Karachi University', 'Pakistan', 'zainab', '12345', '2018-11-15 15:10:39', '..\\images/users/13H0FHazlm.jpg', 1, 1, 'zainabh@hotmail.com', 'female', 'Master and Bachelors in CS'),
(15, 'Talha', 'Siddique', 'Sir Syed University Of Engineering and Technology', 'Pakistan', 'talha', '1234', '2018-11-15 15:23:32', '..\\images/users/14u9vDKpRw.jpg', 0, 1, 'talha@outlook.com', 'male', 'Bachelors'),
(16, 'l;jk', 'jlkj', '.k', 'Albania', 'hkjlhk', 'kkk', '2018-11-20 12:52:23', '..\\images/users/15hkjlhk.png', 0, 1, 'jlkjklj@jkljl.jkhk', 'female', 'vhjg'),
(21, 'kljhj', 'dgh', 'n,m.', 'Afganistan', 'bnmbkjhjkl', 'll', '2018-11-20 13:02:31', '..\\images/users/20bnmbkjhjkl.png', 0, 1, 'hjk@jlk.kl', 'male', 'jkl;jk');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_supervisor`
--

CREATE TABLE `tbl_supervisor` (
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `university` varchar(250) NOT NULL,
  `country` varchar(30) NOT NULL,
  `username` varchar(20) NOT NULL,
  `pass` varchar(20) NOT NULL,
  `regdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `img` varchar(255) NOT NULL,
  `approve` tinyint(1) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `email` varchar(50) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `qualifications` varchar(100) NOT NULL,
  `areaofinterest` varchar(100) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_supervisor`
--

INSERT INTO `tbl_supervisor` (`fname`, `lname`, `university`, `country`, `username`, `pass`, `regdate`, `img`, `approve`, `active`, `email`, `gender`, `qualifications`, `areaofinterest`, `id`) VALUES
('Adeel', 'khan', 'Sir Syed University Of Engineering and Technology', 'Albania', 'mmm', '1234', '2018-11-17 15:24:56', '..\\images/users/2mmm.png', 1, 1, 'adeel@gmail.com', 'male', 'Bachelors', 'health weatlh', 2),
('adeel', 'ahmed', 'NED1', 'Afganistan', 'mmm2', '123', '2018-11-17 15:36:22', '..\\images/users/4mmm2.png', 1, 1, 'waqas@fd.com', 'male', 'MS', 'health', 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `message_sent`
--
ALTER TABLE `message_sent`
  ADD PRIMARY KEY (`message_sent_id`);

--
-- Indexes for table `tbl_projects`
--
ALTER TABLE `tbl_projects`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `tbl_student`
--
ALTER TABLE `tbl_student`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_supervisor`
--
ALTER TABLE `tbl_supervisor`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=264;
--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;
--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;
--
-- AUTO_INCREMENT for table `message_sent`
--
ALTER TABLE `message_sent`
  MODIFY `message_sent_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT for table `tbl_projects`
--
ALTER TABLE `tbl_projects`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT for table `tbl_student`
--
ALTER TABLE `tbl_student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `tbl_supervisor`
--
ALTER TABLE `tbl_supervisor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
