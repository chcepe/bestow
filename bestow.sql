-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 04, 2017 at 05:37 AM
-- Server version: 5.5.36
-- PHP Version: 5.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bestow`
--

-- --------------------------------------------------------

--
-- Table structure for table `campaigns`
--

CREATE TABLE IF NOT EXISTS `campaigns` (
  `title` longtext NOT NULL,
  `story` longtext NOT NULL,
  `img` text NOT NULL,
  `tags` text NOT NULL,
  `loc` text NOT NULL,
  `date` date NOT NULL,
  `money` int(11) NOT NULL,
  `blood_donation` tinyint(1) NOT NULL,
  `current_donation` int(11) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `campaigns`
--

INSERT INTO `campaigns` (`title`, `story`, `img`, `tags`, `loc`, `date`, `money`, `blood_donation`, `current_donation`, `id`, `user_id`) VALUES
('She''s having a Leukemia', 'Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, ', 'photos/5e8693c67dc5f113643461a282e1172a.jpg', 'cancer,medical,ayala', 'Batangas City', '2017-02-05', 100, 1, 50, 1, '563640707176566'),
('Help Joanna Beat Cancer', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum.', 'photos/487f4dc775d49c5d908c187a0b7f1bc3.jpg', 'Batangas,Cancer', 'Batangas City', '2017-02-05', 100, 1, 0, 2, '563640707176566'),
('A Family Living with Rare Disease', 'Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, ', 'photos/fab7cf3243c1abeb343f0eb39e475d60.jpg', 'Quezon City,Rare Disease', 'Quezon City', '2017-02-05', 120, 1, 0, 3, '563640707176566'),
('Chien''s Lost Teeth', 'Nawala ngipin', 'photos/0d9d846dd30221475bda14cf12b0df46.jpg', '#yeah', 'Antartica', '2017-02-05', 116, 1, 0, 4, ''),
('Help us', 'Rare sickness', 'photos/9a1b2142c1ca442e3d3c8507990fdbc2.jpg', 'Leukemia', 'Philippines', '2017-02-05', 100, 1, 0, 5, ''),
('leukemia ', 'leukemia', 'photos/4de829ebc68e7da3bca40565af773682.jpg', 'leukemia', 'ph', '2017-02-05', 100, 1, 0, 6, ''),
('cancer', 'cancer', 'photos/a5b14e28cac510525bdaca4a10003797.jpg', 'cancer', 'ph', '2017-02-05', 100, 1, 0, 7, ''),
('Cepe Heart Disease', 'Heart Disesase', 'photos/0a88c9bae1c319abd87669e39f86f202.jpg', 'Heart', 'Manila', '2017-02-05', 100, 1, 0, 8, ''),
('cancer', 'cancer', 'photos/b378029443d9b1ed45d967c558b6d06b.jpg', 'cancer', 'ph', '2017-02-05', 100, 1, 0, 9, ''),
('etst', 'asdasdsdsd', 'photos/82a709203433efc55145b74164e8055c.jpg', 'asasasdasd', 'asdasd', '2017-02-09', 104, 1, 0, 10, '');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `campaign_id` int(11) NOT NULL,
  `message` longtext NOT NULL,
  `user_id` longtext NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`campaign_id`, `message`, `user_id`, `id`, `date`) VALUES
(1, 'asdas', '563640707176566', 1, '2017-02-05 08:10:37'),
(1, 'test', '563640707176566', 2, '2017-02-05 08:51:38'),
(2, 'sads', '563640707176566', 3, '2017-02-05 09:17:38'),
(1, 'vcvcvc', '', 4, '2017-02-05 13:20:08'),
(1, 'Hello world', '', 5, '2017-02-09 13:29:13'),
(2, 'asdasdasdsd', '563640707176566', 6, '2017-02-09 13:32:14');

-- --------------------------------------------------------

--
-- Table structure for table `donations`
--

CREATE TABLE IF NOT EXISTS `donations` (
  `amount` text NOT NULL,
  `campaign_id` text NOT NULL,
  `user_id` text NOT NULL,
  `type` int(11) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `donations`
--

INSERT INTO `donations` (`amount`, `campaign_id`, `user_id`, `type`, `id`) VALUES
('0', '1', '563640707176566', 2, 1),
('100', '1', '563640707176566', 1, 2),
('100', '4', '1436319789726325', 1, 3),
('100', '2', '563640707176566', 1, 4),
('100', '8', '1436319789726325', 1, 5),
('100', '2', '', 1, 6),
('108', '2', '563640707176566', 1, 7),
('100', '10', '563640707176566', 1, 8);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` varchar(100) NOT NULL,
  `u_age` int(11) NOT NULL,
  `u_blood_type` varchar(50) NOT NULL,
  `u_email` varchar(50) NOT NULL,
  `name` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `u_age`, `u_blood_type`, `u_email`, `name`) VALUES
('1436319789726325', 0, 'A', 'jlsdhgoahgoaehgo@paypal.com', 'Steven Maalihan Torralba'),
('563640707176566', 0, 'A', 'sad', 'Christian Cepe');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
