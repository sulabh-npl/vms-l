-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 25, 2021 at 01:02 PM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sevani`
--

-- --------------------------------------------------------

--
-- Table structure for table `1_sections`
--

DROP TABLE IF EXISTS `1_sections`;
CREATE TABLE IF NOT EXISTS `1_sections` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `1_sections`
--

INSERT INTO `1_sections` (`id`, `name`) VALUES
(0, 'Main'),
(2, 'Floor 1'),
(3, 'Floor-2');

-- --------------------------------------------------------

--
-- Table structure for table `1_staff`
--

DROP TABLE IF EXISTS `1_staff`;
CREATE TABLE IF NOT EXISTS `1_staff` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text,
  `phone` text,
  `email` text,
  `password` text,
  `section_id` int(11) DEFAULT NULL,
  `permission` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `1_staff`
--

INSERT INTO `1_staff` (`id`, `name`, `phone`, `email`, `password`, `section_id`, `permission`) VALUES
(1, 'sulabh', '123456789', 'sangat.masti@gmail.com', '$2y$10$nHaxT6NYGZTzRILAiApVmuLp.QSyfdLhKKOJpxigvR9qvuqjrK/x6', 0, 0),
(2, 'Kabindra', '989898989', 'kabee.kc@gmail.com', '$2y$04$pQdXoSqB5sQXj0gsmGeMmevaBAIbyfe00Ktxsb/z2/J0pNTXd5M2m', 0, 0),
(3, 'Alex', '00000000000000', 'alexkinhk@gmail.com', '$2y$04$WMAA9YlWXRFU5MbUEnpzfO4LfQNhYUrNxUlF5bFMvj5g2ojBBgXQW', 0, 0),
(4, 'Jhon Smith', '+9779800000000', 'jhon@fake.data', '$2y$04$Cq356LjKhlKPh3bylt16W.yf4dl16I1omx.4vPS.TG3c.LrT/CWHS', 2, 0),
(5, 'Jhon Doe', '+949800000000', 'Jhon.doe@fake.data', '$2y$04$ZfOdpXw34b.iuPb6RtXYLeOLTv3k.WY.MKwc3ZunFCAGR.ysb23n.', 3, 0),
(6, 'Liam', '+1000000000', 'LiM@FAKE.DATA', '$2y$04$2tZvM5jvQXcleMnx5ZXt6OvW.NoVPTIOwJr4kruBEgJA0Voc6HhHW', 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `1_visitors`
--

DROP TABLE IF EXISTS `1_visitors`;
CREATE TABLE IF NOT EXISTS `1_visitors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text,
  `addresser` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  `doc_type` text,
  `doc_id` text,
  `father_name` text,
  `issue_date` date DEFAULT NULL,
  `exp_date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=101 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `1_visitors`
--

INSERT INTO `1_visitors` (`id`, `name`, `addresser`, `date`, `time`, `doc_type`, `doc_id`, `father_name`, `issue_date`, `exp_date`) VALUES
(1, 'Riley Krajcik', 6, '1978-07-30', '22:07:25', 'Citizenship', '9004394', 'Prof. Tevin Wunsch', '1975-05-09', '1992-10-16'),
(2, 'Vito Kilback', 5, '1974-08-31', '23:48:00', 'Passport', '8710461', 'Solon Reichert', '1989-04-13', '1971-03-26'),
(3, 'Tyson Cassin', 6, '1996-06-10', '23:05:25', 'Driving Lisense', '8080652', 'Jaeden Dickens', '2000-12-22', '2001-08-13'),
(4, 'Norma Lowe', 6, '1986-08-18', '06:46:50', 'Driving Lisense', '6824541', 'Mr. Peter Gottlieb Sr.', '2015-08-24', '1995-09-07'),
(5, 'Russell Mann', 6, '2013-12-02', '11:00:32', 'Driving Lisense', '3599729', 'Ezra Adams Sr.', '2017-08-06', '2002-08-08'),
(6, 'Demetris Herzog', 4, '1984-12-15', '09:54:28', 'Citizenship', '3638352', 'Andrew McKenzie Jr.', '1982-10-30', '1973-03-31'),
(7, 'Rodrigo Eichmann', 5, '1988-04-19', '16:13:13', 'Passport', '4961573', 'Lee Ritchie', '1993-05-04', '2000-11-03'),
(8, 'Dr. Adrien Bauch DDS', 6, '1984-07-22', '15:15:33', 'Passport', '8910289', 'Jeromy Hintz', '1988-07-03', '1979-01-19'),
(9, 'Betsy Prohaska', 4, '1981-10-13', '17:19:38', 'Passport', '9417902', 'Kevon Bednar PhD', '2019-08-21', '1972-03-21'),
(10, 'Prof. Ivah Keebler II', 4, '1997-09-28', '23:50:12', 'Citizenship', '8657010', 'Taylor Lowe', '1990-10-11', '2015-12-30'),
(11, 'Gideon Sporer Sr.', 5, '1987-01-06', '06:01:25', 'Citizenship', '638489', 'Timmothy Smitham', '1983-08-11', '2007-10-16'),
(12, 'Ms. Anabelle Frami', 5, '1982-06-20', '09:48:10', 'Driving Lisense', '7618596', 'Mr. Giles Bernhard', '2010-10-02', '1980-12-25'),
(13, 'Virgie Padberg', 5, '1989-09-09', '15:21:56', 'Driving Lisense', '6093938', 'Prof. Arturo Goldner Jr.', '2020-09-23', '2016-07-13'),
(14, 'Melody Halvorson', 6, '1989-07-21', '01:40:20', 'Passport', '7096837', 'Drake Welch', '1979-06-27', '2004-05-14'),
(15, 'Gerda Upton I', 4, '1979-09-05', '09:15:57', 'Driving Lisense', '3773974', 'Prof. Van Paucek MD', '2006-04-12', '1970-12-13'),
(16, 'Marisa Brekke', 6, '2017-06-28', '18:16:06', 'Passport', '8640673', 'Daren Bradtke', '1981-01-05', '2013-07-01'),
(17, 'Isabel Hayes', 4, '2001-08-10', '21:57:31', 'Passport', '1488476', 'Prof. Jarvis Gaylord', '1989-11-15', '2020-08-04'),
(18, 'Garfield D\'Amore', 4, '1970-06-23', '18:52:07', 'Driving Lisense', '9324733', 'Kaley Beatty Jr.', '2013-01-11', '2005-05-21'),
(19, 'Prof. Barry Schmidt III', 6, '2018-02-05', '01:00:51', 'Driving Lisense', '5421770', 'Jaeden Bauch V', '2008-12-05', '1974-10-31'),
(20, 'Neoma Grimes', 6, '1974-04-25', '03:53:46', 'Citizenship', '3260933', 'Pete Kulas', '2007-10-15', '1984-12-02'),
(21, 'Mr. Chance Halvorson', 6, '1989-08-13', '15:21:41', 'Passport', '6427219', 'Mr. Lavon Tromp III', '1976-05-04', '1989-02-21'),
(22, 'Bert O\'Hara', 5, '2005-01-10', '03:27:33', 'Passport', '8640305', 'Dawson Klein IV', '1992-10-30', '1971-07-06'),
(23, 'Dr. Clemens West I', 5, '1981-11-29', '19:42:56', 'Citizenship', '5605110', 'Abdul Yost', '2019-11-06', '2003-07-24'),
(24, 'Julie Huel', 4, '1992-06-01', '15:08:50', 'Passport', '9983271', 'Lon Gleason', '1997-03-15', '2019-03-27'),
(25, 'Ms. Eden Kreiger III', 6, '1970-03-03', '13:08:57', 'Citizenship', '8016252', 'Joe Ortiz DVM', '1985-06-22', '1975-02-01'),
(26, 'Norberto Pacocha DDS', 4, '1979-07-11', '09:55:09', 'Driving Lisense', '3210970', 'Kenny Lesch', '1993-03-16', '1985-05-13'),
(27, 'Mr. Oda Kling', 4, '1980-10-01', '10:02:44', 'Passport', '1896913', 'Dr. Gilbert Kertzmann III', '1984-01-12', '1970-12-11'),
(28, 'Lamont D\'Amore', 4, '1972-03-06', '17:54:07', 'Passport', '5200587', 'Tomas Osinski', '1993-02-21', '2006-10-22'),
(29, 'Jedediah Hagenes', 6, '1988-09-17', '07:21:39', 'Citizenship', '8774162', 'Antone Kuhlman', '1981-10-19', '2006-02-02'),
(30, 'Morris Gaylord', 6, '1991-12-24', '05:08:49', 'Citizenship', '5371553', 'Mr. Rodger Davis Sr.', '1987-08-06', '2016-04-22'),
(31, 'Mr. Hyman Green', 4, '2019-06-22', '17:54:40', 'Passport', '5815899', 'Nils Weber PhD', '1990-08-12', '1998-08-30'),
(32, 'Rosina Jacobson', 4, '1991-03-13', '06:07:37', 'Driving Lisense', '8075238', 'Ashton Schmeler', '1985-02-07', '1985-01-21'),
(33, 'Kathleen Batz', 4, '1989-03-31', '22:45:57', 'Citizenship', '5074497', 'Mr. Monte Torp', '1999-06-28', '2015-12-12'),
(34, 'Orion Skiles', 5, '2009-09-25', '23:50:39', 'Driving Lisense', '3735669', 'Curtis Blanda', '2009-03-06', '1983-02-06'),
(35, 'Joel Wyman', 5, '2003-12-02', '03:13:42', 'Passport', '3668020', 'Javonte Collier', '2006-05-12', '1980-07-09'),
(36, 'Adriana Sawayn', 5, '2017-02-26', '19:27:44', 'Citizenship', '6822710', 'Earl Dickinson', '1990-10-08', '1971-04-01'),
(37, 'Thaddeus Lowe', 5, '1975-04-08', '17:17:15', 'Citizenship', '5508140', 'Rowland Adams', '2013-03-20', '1972-03-02'),
(38, 'Taryn Hermiston', 4, '1975-06-06', '12:06:26', 'Driving Lisense', '2392136', 'Rory Boyer', '1975-12-18', '2009-02-23'),
(39, 'Darlene Ryan', 5, '1992-10-11', '16:31:19', 'Citizenship', '7743454', 'Alexys Beatty DDS', '1993-10-29', '2002-01-06'),
(40, 'Albert Rice', 4, '2012-02-27', '19:03:44', 'Citizenship', '799454', 'Isaac Barton', '1996-05-25', '1970-11-15'),
(41, 'Miss Brandy Rippin', 5, '2000-09-05', '15:54:32', 'Citizenship', '3628450', 'Garnet Stehr', '1982-08-28', '1987-05-20'),
(42, 'Linnea Lowe', 5, '2013-02-27', '07:04:32', 'Citizenship', '7604025', 'Mr. Gonzalo Kihn', '1980-11-08', '1984-08-03'),
(43, 'Chandler Huel', 4, '2010-07-30', '20:02:28', 'Passport', '4047910', 'Ludwig Murray', '1995-08-12', '1990-10-26'),
(44, 'Lucious Torp', 5, '2017-05-09', '03:04:49', 'Citizenship', '3574034', 'Arnoldo Windler', '1995-07-31', '1977-02-19'),
(45, 'Vicky McGlynn', 4, '2005-01-14', '17:57:48', 'Driving Lisense', '7326005', 'Giuseppe Runte', '1976-10-24', '2012-06-18'),
(46, 'Mrs. Odie Schuster', 6, '1982-12-16', '07:04:57', 'Passport', '512618', 'Mr. Urban Runolfsdottir Jr.', '2004-03-06', '1994-06-21'),
(47, 'Dexter Rogahn', 5, '1976-09-10', '13:10:10', 'Citizenship', '1925721', 'Ramiro Beier', '2002-12-25', '2017-11-22'),
(48, 'Nina Bailey', 5, '2011-11-26', '05:35:00', 'Driving Lisense', '2702701', 'Mr. Stuart Feil', '2018-08-15', '1977-11-25'),
(49, 'Kristoffer Reilly', 6, '1989-08-09', '17:17:03', 'Driving Lisense', '2733031', 'Mr. Bo Mitchell Jr.', '1999-01-29', '2007-10-14'),
(50, 'Dr. Rickey Roob', 6, '2019-10-22', '05:15:45', 'Passport', '8158584', 'Keagan Batz', '1981-03-25', '1972-07-20'),
(51, 'Osbaldo McDermott', 5, '2017-10-05', '11:30:38', 'Driving Lisense', '1306516', 'Brain Smith', '1997-09-06', '1993-02-20'),
(52, 'Ms. Ozella Schinner I', 4, '1971-10-24', '00:03:43', 'Citizenship', '4655644', 'Bobby Prohaska', '1980-03-06', '2003-05-26'),
(53, 'Lester Ritchie', 5, '1980-12-14', '08:28:32', 'Citizenship', '5406734', 'Lincoln Kovacek', '1975-07-04', '1979-02-04'),
(54, 'Tyra Brown', 4, '2006-05-19', '22:42:46', 'Passport', '4421278', 'Dwight Macejkovic', '2018-03-07', '1997-11-08'),
(55, 'Lee Bernier', 6, '1978-06-01', '11:19:12', 'Citizenship', '6480073', 'Conrad Rempel DVM', '2007-06-28', '1971-01-25'),
(56, 'Alverta Stehr', 5, '2020-01-21', '11:37:43', 'Driving Lisense', '9373920', 'Prof. Tillman Lubowitz', '1980-05-18', '1981-12-10'),
(57, 'Arvel Hoppe', 5, '2014-04-18', '02:22:55', 'Passport', '9611148', 'Jeff Ziemann', '2015-11-27', '1983-04-14'),
(58, 'Prof. Helene Rosenbaum V', 6, '1993-12-31', '22:53:06', 'Driving Lisense', '906121', 'Prof. Julian Graham', '1970-02-17', '1973-08-10'),
(59, 'Dr. Morton Bogan', 5, '2014-11-03', '09:39:25', 'Driving Lisense', '3507002', 'Griffin Runte', '1974-09-12', '1976-06-06'),
(60, 'Litzy Bernier', 5, '1986-12-07', '21:10:12', 'Citizenship', '8043139', 'Mr. Elroy Hammes', '2007-04-10', '1979-07-05'),
(61, 'Rebeca Bogan V', 4, '2010-05-17', '14:11:49', 'Driving Lisense', '4105687', 'Mr. Ward Bosco', '1999-02-11', '1987-02-22'),
(62, 'Delaney Zulauf', 6, '1981-01-31', '07:48:05', 'Driving Lisense', '8908945', 'Marquis Fay Sr.', '2002-10-02', '1976-04-03'),
(63, 'Nadia Bernier', 5, '2007-11-01', '21:11:11', 'Driving Lisense', '4070648', 'Mr. Dayton Wehner DVM', '1987-07-31', '2010-01-03'),
(64, 'Beaulah Gibson', 4, '1986-03-07', '03:32:35', 'Citizenship', '6495360', 'Jed Bergstrom IV', '2000-02-10', '2015-06-21'),
(65, 'Lilla Strosin', 4, '2005-02-04', '02:42:42', 'Citizenship', '7519001', 'Paul Klein V', '1978-02-03', '1980-04-21'),
(66, 'Dr. Hal Schulist III', 6, '2019-05-18', '06:58:17', 'Driving Lisense', '5889250', 'Giovani Morissette', '1992-10-19', '1991-07-08'),
(67, 'Prof. Herbert Kautzer Jr.', 4, '1995-04-17', '16:44:54', 'Driving Lisense', '1495520', 'Stephen Mosciski', '1984-01-03', '2003-01-12'),
(68, 'Sydnee Borer', 5, '1981-12-20', '08:39:04', 'Driving Lisense', '335288', 'Jennings Johnston', '2005-06-04', '2020-11-30'),
(69, 'Monique McCullough', 5, '1974-10-12', '14:59:42', 'Driving Lisense', '8262465', 'Westley Considine', '1995-05-14', '1975-08-22'),
(70, 'Prof. Reina Hudson', 6, '1971-10-10', '16:44:09', 'Driving Lisense', '3065086', 'Casimir Ferry', '1979-09-06', '2020-06-18'),
(71, 'Nettie Wilkinson', 5, '1990-06-16', '20:44:14', 'Driving Lisense', '1188627', 'Beau Nader DDS', '2002-08-16', '1982-05-15'),
(72, 'Mr. Eusebio Baumbach', 4, '2012-02-26', '02:32:49', 'Passport', '2850927', 'Casimer Marvin', '2000-11-10', '1991-03-03'),
(73, 'Larissa Schumm', 4, '1974-10-16', '11:16:02', 'Passport', '4291765', 'Gayle Romaguera', '1997-03-30', '1990-07-27'),
(74, 'Jovan Romaguera', 6, '1991-02-05', '22:13:59', 'Driving Lisense', '6861671', 'Russel Senger', '2005-07-11', '1975-12-14'),
(75, 'Brittany Halvorson', 4, '2015-04-29', '02:10:45', 'Citizenship', '2888525', 'Dr. Evert Renner', '1983-09-29', '2017-08-15'),
(76, 'Nyasia Konopelski', 6, '1974-01-09', '10:31:11', 'Driving Lisense', '5827319', 'Maxwell Beier V', '2015-01-18', '1997-11-30'),
(77, 'Myriam Brekke', 6, '2021-06-10', '09:52:01', 'Driving Lisense', '128663', 'Frederik Wiza', '1978-04-09', '1971-04-13'),
(78, 'Nat Bergstrom', 6, '1983-08-30', '23:37:47', 'Citizenship', '5138503', 'Tobin Feil DDS', '2013-12-08', '2020-09-20'),
(79, 'Kraig Langosh', 5, '1975-10-16', '22:09:34', 'Driving Lisense', '2466113', 'Arely Shields', '2021-03-04', '2020-01-10'),
(80, 'Gabrielle Langworth', 6, '2007-10-05', '20:47:57', 'Passport', '722311', 'Prof. Brennon Hammes', '2015-03-22', '1979-05-06'),
(81, 'Elmore Berge', 4, '2000-02-12', '15:52:02', 'Passport', '5484558', 'Mr. Randy Brekke PhD', '2002-07-16', '1991-08-30'),
(82, 'Darrin Rolfson', 4, '1990-02-12', '02:51:25', 'Passport', '347137', 'Brandt Runolfsdottir', '2001-11-19', '2004-02-18'),
(83, 'Dr. Gordon McDermott', 4, '1971-01-04', '13:57:53', 'Passport', '1503241', 'Gilbert Morissette', '1994-01-29', '2020-12-25'),
(84, 'Wendell Bartell', 4, '1999-03-21', '06:25:48', 'Passport', '1379534', 'Adelbert Bailey', '1994-08-25', '2011-12-23'),
(85, 'Wilhelm Ferry', 5, '1980-10-03', '12:06:06', 'Citizenship', '7903179', 'Carlos Schmidt', '2012-02-10', '1994-07-05'),
(86, 'Audra Kulas', 4, '1985-02-02', '14:29:32', 'Citizenship', '945524', 'Prof. Abdiel Little', '1993-11-17', '1982-08-04'),
(87, 'Fermin Kozey', 6, '2018-12-14', '08:34:34', 'Citizenship', '6170395', 'Nils Fay', '2006-11-26', '2011-01-29'),
(88, 'Mortimer Schmidt', 5, '1990-06-03', '12:35:19', 'Passport', '9667482', 'Jocelyn Reynolds', '1993-02-02', '1982-06-08'),
(89, 'Miss Luisa Weber', 5, '2020-08-01', '05:22:03', 'Citizenship', '9156241', 'Prof. Reilly Shanahan Jr.', '1997-05-30', '2005-05-28'),
(90, 'Mr. Emile Buckridge III', 6, '1993-06-11', '23:05:32', 'Passport', '7973171', 'Dr. Clinton Koch', '2016-12-07', '1993-04-14'),
(91, 'Vaughn Ward', 6, '1993-04-27', '17:13:12', 'Driving Lisense', '9034008', 'Richmond Quigley Jr.', '1994-07-06', '1982-04-09'),
(92, 'Willa Boyle IV', 5, '1995-12-27', '11:44:34', 'Driving Lisense', '939478', 'Gerson Fritsch III', '1983-11-27', '1999-01-01'),
(93, 'Anika Turner', 6, '1986-09-17', '04:41:44', 'Passport', '6177902', 'Vicente Emmerich', '1989-10-08', '1994-10-11'),
(94, 'Prof. Chaya O\'Conner III', 6, '2001-02-16', '12:05:21', 'Passport', '5220148', 'Prof. Owen Romaguera', '2001-12-17', '2005-11-03'),
(95, 'Dorcas Kreiger', 6, '2012-05-20', '18:07:39', 'Citizenship', '7893766', 'Maxine McClure Sr.', '2008-07-01', '1991-05-15'),
(96, 'Prof. Willie Schultz', 4, '2006-11-02', '21:14:27', 'Driving Lisense', '1535418', 'Prof. Joan Cronin IV', '2001-12-09', '1979-12-25'),
(97, 'Arlie Bogisich', 6, '1979-02-25', '01:26:03', 'Driving Lisense', '5028039', 'Chauncey Reinger', '1997-10-21', '2011-10-15'),
(98, 'Cara Kuhic', 4, '1977-03-21', '01:42:55', 'Passport', '9981276', 'Prof. Jamarcus Homenick', '1999-04-25', '2013-06-19'),
(99, 'Howard Fritsch', 4, '1991-07-02', '01:47:19', 'Passport', '7391401', 'Mr. Ryleigh Hamill', '2001-10-21', '2001-04-11'),
(100, 'Madie Renner', 4, '2018-02-11', '09:27:15', 'Driving Lisense', '8796095', 'Prof. Kurtis Brown DVM', '1984-04-16', '1988-04-18');

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

DROP TABLE IF EXISTS `admin_users`;
CREATE TABLE IF NOT EXISTS `admin_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `phone` text NOT NULL,
  `password` text NOT NULL,
  `per` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `name`, `email`, `phone`, `password`, `per`) VALUES
(1, 'sab', 'sangat.masti@gmail.com', 'jhdfkshkfnk', '$2y$10$iTcbtF.CVEaTEDaUFHhU6uh7c46rgh/jZN6RgQ1X63rxH4bR/t1k6', 0);

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

DROP TABLE IF EXISTS `vendors`;
CREATE TABLE IF NOT EXISTS `vendors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `phone` text NOT NULL,
  `email` text NOT NULL,
  `address` text NOT NULL,
  `registered_date` date NOT NULL,
  `exp_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`id`, `name`, `phone`, `email`, `address`, `registered_date`, `exp_date`) VALUES
(1, 'ABC Company Limited', '12345', '123@45.com', 'China', '2021-10-25', '2021-10-30');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
