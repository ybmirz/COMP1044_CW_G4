-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 21, 2022 at 03:47 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bookswamp`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `owa_fk_pk` varchar(6) NOT NULL CHECK (octet_length(`owa_fk_pk`) = 6),
  `SHA1_hashedpassword` varchar(40) DEFAULT NULL CHECK (octet_length(`SHA1_hashedpassword`) = 40)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`owa_fk_pk`, `SHA1_hashedpassword`) VALUES
('hcyaa1', '14f0938df30b1b6f2697b3eb6f29a64f371282ca'),
('hcyap1', '567775b8280711d8231fdb1c779d2e4b4a77f96d'),
('hcycl1', 'b4c04c2f4f1a329f42fc3fa2153e3ffacacc5b82'),
('hcycp1', 'a9640f21d75b77812c374e9689fa75e0ccd0670b'),
('hcyed1', '73e28bc94e5621e687c07dc2b093a5f5d4aa7f2f'),
('hcyee1', 'c3dcb88e1813d1201a0c2804fe68fd14efaf4b06'),
('hcyja1', 'd9288fece1bd24e06103b5603481527635f3847f'),
('hcyjs1', '086cca3460b4d4500d869ca518742ff8ec37bedd'),
('hcykd1', '13ec6dfa02966f718b1ef846d8f0e8d4d8c9eeee'),
('hcyms1', '4b509c98a50433b8cc72a9fdbb5d055ddbdf38ac'),
('hcyrm1', 'e79837c83d6dc4ed8372ac09390889cd0a2c5011'),
('hcyrm2', '8acd035fda4c015cc3d421c9302b195dccf7a63c'),
('hcyrp1', '30f44a7d8c1df9a8ee0749eb0bbe56eaf467661c'),
('hcysg1', 'fa2e32c6a752648843831a1117a5805b374bb122');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `owa_fk_pk` varchar(6) NOT NULL CHECK (octet_length(`owa_fk_pk`) = 6),
  `start_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`owa_fk_pk`, `start_date`) VALUES
('hcyjs1', '2022-04-01');

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `id_pk` int(4) NOT NULL,
  `owner_owa_fk` varchar(6) NOT NULL,
  `book_information_id_fk` int(4) NOT NULL,
  `date_added` datetime NOT NULL,
  `status` enum('New','Old','Damaged') NOT NULL,
  `availability` enum('Available','Archived','Lost') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`id_pk`, `owner_owa_fk`, `book_information_id_fk`, `date_added`, `status`, `availability`) VALUES
(1, 'hcyms1', 15, '2013-12-11 06:34:27', 'New', 'Available'),
(2, 'hcyms1', 15, '2013-12-11 06:34:27', 'New', 'Available'),
(3, 'hcyms1', 15, '2013-12-11 06:34:27', 'New', 'Available'),
(4, 'hcyms1', 15, '2013-12-11 06:34:27', 'New', 'Available'),
(5, 'hcyms1', 15, '2013-12-11 06:34:27', 'New', 'Available'),
(6, 'hcyms1', 15, '2013-12-11 06:34:27', 'New', 'Available'),
(7, 'hcyms1', 15, '2013-12-11 06:34:27', 'New', 'Available'),
(8, 'hcyms1', 15, '2013-12-11 06:34:27', 'New', 'Available'),
(9, 'hcyms1', 15, '2013-12-11 06:34:27', 'New', 'Available'),
(10, 'hcyms1', 15, '2013-12-11 06:34:27', 'New', 'Available'),
(11, 'hcyms1', 15, '2013-12-11 06:34:27', 'New', 'Available'),
(12, 'hcyms1', 15, '2013-12-11 06:34:27', 'New', 'Available'),
(13, 'hcyms1', 15, '2013-12-11 06:34:27', 'New', 'Available'),
(14, 'hcyms1', 15, '2013-12-11 06:34:27', 'New', 'Available'),
(15, 'hcyms1', 15, '2013-12-11 06:34:27', 'New', 'Available'),
(16, 'hcyms1', 16, '2013-12-11 06:36:23', 'New', 'Archived'),
(17, 'hcyms1', 16, '2013-12-11 06:36:23', 'New', 'Archived'),
(18, 'hcyms1', 16, '2013-12-11 06:36:23', 'New', 'Archived'),
(19, 'hcyms1', 16, '2013-12-11 06:36:23', 'New', 'Archived'),
(20, 'hcyms1', 16, '2013-12-11 06:36:23', 'New', 'Archived'),
(21, 'hcyms1', 16, '2013-12-11 06:36:23', 'New', 'Archived'),
(22, 'hcyms1', 16, '2013-12-11 06:36:23', 'New', 'Archived'),
(23, 'hcyms1', 16, '2013-12-11 06:36:23', 'New', 'Archived'),
(24, 'hcyms1', 16, '2013-12-11 06:36:23', 'New', 'Archived'),
(25, 'hcyms1', 16, '2013-12-11 06:36:23', 'New', 'Archived'),
(26, 'hcyms1', 16, '2013-12-11 06:36:23', 'New', 'Archived'),
(27, 'hcyms1', 16, '2013-12-11 06:36:23', 'New', 'Archived'),
(28, 'hcyms1', 16, '2013-12-11 06:36:23', 'New', 'Archived'),
(29, 'hcyms1', 16, '2013-12-11 06:36:23', 'New', 'Archived'),
(30, 'hcyms1', 16, '2013-12-11 06:36:23', 'New', 'Archived'),
(31, 'hcyms1', 16, '2013-12-11 06:36:23', 'New', 'Archived'),
(32, 'hcyms1', 16, '2013-12-11 06:36:23', 'New', 'Archived'),
(33, 'hcyms1', 16, '2013-12-11 06:36:23', 'New', 'Archived'),
(34, 'hcyms1', 16, '2013-12-11 06:36:23', 'New', 'Archived'),
(35, 'hcyms1', 16, '2013-12-11 06:36:23', 'New', 'Archived'),
(36, 'hcyms1', 17, '2013-12-11 06:39:17', 'Damaged', 'Available'),
(37, 'hcyms1', 17, '2013-12-11 06:39:17', 'Damaged', 'Available'),
(38, 'hcyms1', 17, '2013-12-11 06:39:17', 'Damaged', 'Available'),
(39, 'hcyms1', 17, '2013-12-11 06:39:17', 'Damaged', 'Available'),
(40, 'hcyms1', 17, '2013-12-11 06:39:17', 'Damaged', 'Available'),
(41, 'hcyms1', 17, '2013-12-11 06:39:17', 'Damaged', 'Available'),
(42, 'hcyms1', 17, '2013-12-11 06:39:17', 'Damaged', 'Available'),
(43, 'hcyms1', 17, '2013-12-11 06:39:17', 'Damaged', 'Available'),
(44, 'hcyms1', 17, '2013-12-11 06:39:17', 'Damaged', 'Available'),
(45, 'hcyms1', 17, '2013-12-11 06:39:17', 'Damaged', 'Available'),
(46, 'hcyms1', 17, '2013-12-11 06:39:17', 'Damaged', 'Available'),
(47, 'hcyms1', 17, '2013-12-11 06:39:17', 'Damaged', 'Available'),
(48, 'hcyms1', 17, '2013-12-11 06:39:17', 'Damaged', 'Available'),
(49, 'hcyms1', 17, '2013-12-11 06:39:17', 'Damaged', 'Available'),
(50, 'hcyms1', 17, '2013-12-11 06:39:17', 'Damaged', 'Available'),
(51, 'hcyms1', 17, '2013-12-11 06:39:17', 'Damaged', 'Available'),
(52, 'hcyms1', 17, '2013-12-11 06:39:17', 'Damaged', 'Available'),
(53, 'hcyms1', 17, '2013-12-11 06:39:17', 'Damaged', 'Available'),
(54, 'hcyms1', 17, '2013-12-11 06:39:17', 'Damaged', 'Available'),
(55, 'hcyms1', 17, '2013-12-11 06:39:17', 'Damaged', 'Available'),
(56, 'hcyms1', 17, '2013-12-11 06:39:17', 'Damaged', 'Available'),
(57, 'hcyms1', 17, '2013-12-11 06:39:17', 'Damaged', 'Available'),
(58, 'hcyms1', 17, '2013-12-11 06:39:17', 'Damaged', 'Available'),
(59, 'hcyms1', 17, '2013-12-11 06:39:17', 'Damaged', 'Available'),
(60, 'hcyms1', 17, '2013-12-11 06:39:17', 'Damaged', 'Available'),
(61, 'hcyms1', 17, '2013-12-11 06:39:17', 'Damaged', 'Available'),
(62, 'hcyms1', 17, '2013-12-11 06:39:17', 'Damaged', 'Available'),
(63, 'hcyms1', 17, '2013-12-11 06:39:17', 'Damaged', 'Available'),
(64, 'hcyms1', 17, '2013-12-11 06:39:17', 'Damaged', 'Available'),
(65, 'hcyms1', 17, '2013-12-11 06:39:17', 'Damaged', 'Available'),
(66, 'hcyms1', 17, '2013-12-11 06:39:17', 'Damaged', 'Available'),
(67, 'hcyms1', 17, '2013-12-11 06:39:17', 'Damaged', 'Available'),
(68, 'hcyms1', 17, '2013-12-11 06:39:17', 'Damaged', 'Available'),
(69, 'hcyms1', 17, '2013-12-11 06:39:17', 'Damaged', 'Available'),
(70, 'hcyms1', 17, '2013-12-11 06:39:17', 'Damaged', 'Available'),
(71, 'hcyms1', 18, '2013-12-11 06:41:53', 'New', 'Available'),
(72, 'hcyms1', 18, '2013-12-11 06:41:53', 'New', 'Available'),
(73, 'hcyms1', 18, '2013-12-11 06:41:53', 'New', 'Available'),
(74, 'hcyms1', 19, '2013-12-11 06:44:44', 'Old', 'Lost'),
(75, 'hcyms1', 19, '2013-12-11 06:44:44', 'Old', 'Lost'),
(76, 'hcyms1', 19, '2013-12-11 06:44:44', 'Old', 'Lost'),
(77, 'hcyms1', 19, '2013-12-11 06:44:44', 'Old', 'Lost'),
(78, 'hcyms1', 19, '2013-12-11 06:44:44', 'Old', 'Lost'),
(79, 'hcyms1', 19, '2013-12-11 06:44:44', 'Old', 'Lost'),
(80, 'hcyms1', 19, '2013-12-11 06:44:44', 'Old', 'Lost'),
(81, 'hcyms1', 19, '2013-12-11 06:44:44', 'Old', 'Lost'),
(82, 'hcyms1', 19, '2013-12-11 06:44:44', 'Old', 'Lost'),
(83, 'hcyms1', 19, '2013-12-11 06:44:44', 'Old', 'Lost'),
(84, 'hcyms1', 19, '2013-12-11 06:44:44', 'Old', 'Lost'),
(85, 'hcyms1', 19, '2013-12-11 06:44:44', 'Old', 'Lost'),
(86, 'hcyms1', 19, '2013-12-11 06:44:44', 'Old', 'Lost'),
(87, 'hcyms1', 19, '2013-12-11 06:44:44', 'Old', 'Lost'),
(88, 'hcyms1', 19, '2013-12-11 06:44:44', 'Old', 'Lost'),
(89, 'hcyms1', 19, '2013-12-11 06:44:44', 'Old', 'Lost'),
(90, 'hcyms1', 19, '2013-12-11 06:44:44', 'Old', 'Lost'),
(91, 'hcyms1', 19, '2013-12-11 06:44:44', 'Old', 'Lost'),
(92, 'hcyms1', 19, '2013-12-11 06:44:44', 'Old', 'Lost'),
(93, 'hcyms1', 19, '2013-12-11 06:44:44', 'Old', 'Lost'),
(94, 'hcyms1', 19, '2013-12-11 06:44:44', 'Old', 'Lost'),
(95, 'hcyms1', 19, '2013-12-11 06:44:44', 'Old', 'Lost'),
(96, 'hcyms1', 19, '2013-12-11 06:44:44', 'Old', 'Lost'),
(97, 'hcyms1', 19, '2013-12-11 06:44:44', 'Old', 'Lost'),
(98, 'hcyms1', 19, '2013-12-11 06:44:44', 'Old', 'Lost'),
(99, 'hcyms1', 20, '2013-12-11 06:47:44', 'Old', 'Available'),
(100, 'hcyms1', 20, '2013-12-11 06:47:44', 'Old', 'Available'),
(101, 'hcyms1', 20, '2013-12-11 06:47:44', 'Old', 'Available'),
(102, 'hcyms1', 20, '2013-12-11 06:47:44', 'Old', 'Available'),
(103, 'hcyms1', 20, '2013-12-11 06:47:44', 'Old', 'Available'),
(104, 'hcyms1', 20, '2013-12-11 06:47:44', 'Old', 'Available'),
(105, 'hcyms1', 20, '2013-12-11 06:47:44', 'Old', 'Available'),
(106, 'hcyms1', 20, '2013-12-11 06:47:44', 'Old', 'Available'),
(107, 'hcyms1', 20, '2013-12-11 06:47:44', 'Old', 'Available'),
(108, 'hcyms1', 20, '2013-12-11 06:47:44', 'Old', 'Available'),
(109, 'hcyms1', 20, '2013-12-11 06:47:44', 'Old', 'Available'),
(110, 'hcyms1', 20, '2013-12-11 06:47:44', 'Old', 'Available'),
(111, 'hcyms1', 20, '2013-12-11 06:47:44', 'Old', 'Available'),
(112, 'hcyms1', 20, '2013-12-11 06:47:44', 'Old', 'Available'),
(113, 'hcyms1', 20, '2013-12-11 06:47:44', 'Old', 'Available'),
(114, 'hcyms1', 20, '2013-12-11 06:47:44', 'Old', 'Available'),
(115, 'hcyms1', 20, '2013-12-11 06:47:44', 'Old', 'Available'),
(116, 'hcyms1', 20, '2013-12-11 06:47:44', 'Old', 'Available'),
(117, 'hcyms1', 20, '2013-12-11 06:47:44', 'Old', 'Available'),
(118, 'hcyms1', 20, '2013-12-11 06:47:44', 'Old', 'Available'),
(119, 'hcyms1', 21, '2013-12-11 06:49:53', 'Old', 'Available'),
(120, 'hcyms1', 21, '2013-12-11 06:49:53', 'Old', 'Available'),
(121, 'hcyms1', 21, '2013-12-11 06:49:53', 'Old', 'Available'),
(122, 'hcyms1', 21, '2013-12-11 06:49:53', 'Old', 'Available'),
(123, 'hcyms1', 21, '2013-12-11 06:49:53', 'Old', 'Available'),
(124, 'hcyms1', 21, '2013-12-11 06:49:53', 'Old', 'Available'),
(125, 'hcyms1', 21, '2013-12-11 06:49:53', 'Old', 'Available'),
(126, 'hcyms1', 21, '2013-12-11 06:49:53', 'Old', 'Available'),
(127, 'hcyms1', 21, '2013-12-11 06:49:53', 'Old', 'Available'),
(128, 'hcyms1', 21, '2013-12-11 06:49:53', 'Old', 'Available'),
(129, 'hcyms1', 22, '2013-12-11 06:52:58', 'New', 'Available'),
(130, 'hcyms1', 22, '2013-12-11 06:52:58', 'New', 'Available'),
(131, 'hcyms1', 22, '2013-12-11 06:52:58', 'New', 'Available'),
(132, 'hcyms1', 22, '2013-12-11 06:52:58', 'New', 'Available'),
(133, 'hcyms1', 22, '2013-12-11 06:52:58', 'New', 'Available'),
(134, 'hcyms1', 22, '2013-12-11 06:52:58', 'New', 'Available'),
(135, 'hcyms1', 22, '2013-12-11 06:52:58', 'New', 'Available'),
(136, 'hcyms1', 22, '2013-12-11 06:52:58', 'New', 'Available'),
(137, 'hcyms1', 22, '2013-12-11 06:52:58', 'New', 'Available'),
(138, 'hcyms1', 22, '2013-12-11 06:52:58', 'New', 'Available'),
(139, 'hcyms1', 22, '2013-12-11 06:52:58', 'New', 'Available'),
(140, 'hcyms1', 22, '2013-12-11 06:52:58', 'New', 'Available'),
(141, 'hcyms1', 22, '2013-12-11 06:52:58', 'New', 'Available'),
(142, 'hcyms1', 22, '2013-12-11 06:52:58', 'New', 'Available'),
(143, 'hcyms1', 22, '2013-12-11 06:52:58', 'New', 'Available'),
(144, 'hcyms1', 22, '2013-12-11 06:52:58', 'New', 'Available'),
(145, 'hcyms1', 23, '2013-12-11 06:55:27', 'New', 'Available'),
(146, 'hcyms1', 23, '2013-12-11 06:55:27', 'New', 'Available'),
(147, 'hcyms1', 23, '2013-12-11 06:55:27', 'New', 'Available'),
(148, 'hcyms1', 23, '2013-12-11 06:55:27', 'New', 'Available'),
(149, 'hcyms1', 23, '2013-12-11 06:55:27', 'New', 'Available'),
(150, 'hcyms1', 23, '2013-12-11 06:55:27', 'New', 'Available'),
(151, 'hcyms1', 23, '2013-12-11 06:55:27', 'New', 'Available'),
(152, 'hcyms1', 23, '2013-12-11 06:55:27', 'New', 'Available'),
(153, 'hcyms1', 23, '2013-12-11 06:55:27', 'New', 'Available'),
(154, 'hcyms1', 23, '2013-12-11 06:55:27', 'New', 'Available'),
(155, 'hcyms1', 23, '2013-12-11 06:55:27', 'New', 'Available'),
(156, 'hcyms1', 23, '2013-12-11 06:55:27', 'New', 'Available'),
(157, 'hcyms1', 23, '2013-12-11 06:55:27', 'New', 'Available'),
(158, 'hcyms1', 23, '2013-12-11 06:55:27', 'New', 'Available'),
(159, 'hcyms1', 23, '2013-12-11 06:55:27', 'New', 'Available'),
(160, 'hcyms1', 24, '2013-12-11 06:57:35', 'New', 'Available'),
(161, 'hcyms1', 24, '2013-12-11 06:57:35', 'New', 'Available'),
(162, 'hcyms1', 24, '2013-12-11 06:57:35', 'New', 'Available'),
(163, 'hcyms1', 24, '2013-12-11 06:57:35', 'New', 'Available'),
(164, 'hcyms1', 24, '2013-12-11 06:57:35', 'New', 'Available'),
(165, 'hcyms1', 24, '2013-12-11 06:57:35', 'New', 'Available'),
(166, 'hcyms1', 24, '2013-12-11 06:57:35', 'New', 'Available'),
(167, 'hcyms1', 24, '2013-12-11 06:57:35', 'New', 'Available'),
(168, 'hcyms1', 24, '2013-12-11 06:57:35', 'New', 'Available'),
(169, 'hcyms1', 24, '2013-12-11 06:57:35', 'New', 'Available'),
(170, 'hcyms1', 24, '2013-12-11 06:57:35', 'New', 'Available'),
(171, 'hcyms1', 24, '2013-12-11 06:57:35', 'New', 'Available'),
(172, 'hcyms1', 24, '2013-12-11 06:57:35', 'New', 'Available'),
(173, 'hcyms1', 24, '2013-12-11 06:57:35', 'New', 'Available'),
(174, 'hcyms1', 24, '2013-12-11 06:57:35', 'New', 'Available'),
(175, 'hcyms1', 25, '2013-12-11 06:59:24', 'Damaged', 'Available'),
(176, 'hcyms1', 25, '2013-12-11 06:59:24', 'Damaged', 'Available'),
(177, 'hcyms1', 25, '2013-12-11 06:59:24', 'Damaged', 'Available'),
(178, 'hcyms1', 25, '2013-12-11 06:59:24', 'Damaged', 'Available'),
(179, 'hcyms1', 25, '2013-12-11 06:59:24', 'Damaged', 'Available'),
(180, 'hcyms1', 25, '2013-12-11 06:59:24', 'Damaged', 'Available'),
(181, 'hcyms1', 25, '2013-12-11 06:59:24', 'Damaged', 'Available'),
(182, 'hcyms1', 25, '2013-12-11 06:59:24', 'Damaged', 'Available'),
(183, 'hcyms1', 25, '2013-12-11 06:59:24', 'Damaged', 'Available'),
(184, 'hcyms1', 25, '2013-12-11 06:59:24', 'Damaged', 'Available'),
(185, 'hcyms1', 25, '2013-12-11 06:59:24', 'Damaged', 'Available'),
(186, 'hcyms1', 25, '2013-12-11 06:59:24', 'Damaged', 'Available'),
(187, 'hcyms1', 25, '2013-12-11 06:59:24', 'Damaged', 'Available'),
(188, 'hcyms1', 25, '2013-12-11 06:59:24', 'Damaged', 'Available'),
(189, 'hcyms1', 25, '2013-12-11 06:59:24', 'Damaged', 'Available'),
(190, 'hcyms1', 25, '2013-12-11 06:59:24', 'Damaged', 'Available'),
(191, 'hcyms1', 25, '2013-12-11 06:59:24', 'Damaged', 'Available'),
(192, 'hcyms1', 25, '2013-12-11 06:59:24', 'Damaged', 'Available'),
(193, 'hcyms1', 25, '2013-12-11 06:59:24', 'Damaged', 'Available'),
(194, 'hcyms1', 25, '2013-12-11 06:59:24', 'Damaged', 'Available'),
(195, 'hcyms1', 25, '2013-12-11 06:59:24', 'Damaged', 'Available'),
(196, 'hcyms1', 25, '2013-12-11 06:59:24', 'Damaged', 'Available'),
(197, 'hcyms1', 25, '2013-12-11 06:59:24', 'Damaged', 'Available'),
(198, 'hcyms1', 25, '2013-12-11 06:59:24', 'Damaged', 'Available'),
(199, 'hcyms1', 25, '2013-12-11 06:59:24', 'Damaged', 'Available'),
(200, 'hcyms1', 25, '2013-12-11 06:59:24', 'Damaged', 'Available'),
(201, 'hcyms1', 25, '2013-12-11 06:59:24', 'Damaged', 'Available'),
(202, 'hcyms1', 25, '2013-12-11 06:59:24', 'Damaged', 'Available'),
(203, 'hcyms1', 26, '2013-12-11 07:01:25', 'New', 'Available'),
(204, 'hcyms1', 26, '2013-12-11 07:01:25', 'New', 'Available'),
(205, 'hcyms1', 26, '2013-12-11 07:01:25', 'New', 'Available'),
(206, 'hcyms1', 26, '2013-12-11 07:01:25', 'New', 'Available'),
(207, 'hcyms1', 26, '2013-12-11 07:01:25', 'New', 'Available'),
(208, 'hcyms1', 26, '2013-12-11 07:01:25', 'New', 'Available'),
(209, 'hcyms1', 26, '2013-12-11 07:01:25', 'New', 'Available'),
(210, 'hcyms1', 26, '2013-12-11 07:01:25', 'New', 'Available'),
(211, 'hcyms1', 26, '2013-12-11 07:01:25', 'New', 'Available'),
(212, 'hcyms1', 26, '2013-12-11 07:01:25', 'New', 'Available'),
(213, 'hcyms1', 26, '2013-12-11 07:01:25', 'New', 'Available'),
(214, 'hcyms1', 26, '2013-12-11 07:01:25', 'New', 'Available'),
(215, 'hcyms1', 26, '2013-12-11 07:01:25', 'New', 'Available'),
(216, 'hcyms1', 26, '2013-12-11 07:01:25', 'New', 'Available'),
(217, 'hcyms1', 26, '2013-12-11 07:01:25', 'New', 'Available'),
(218, 'hcyms1', 26, '2013-12-11 07:01:25', 'New', 'Available'),
(219, 'hcyms1', 26, '2013-12-11 07:01:25', 'New', 'Available'),
(220, 'hcyms1', 26, '2013-12-11 07:01:25', 'New', 'Available'),
(221, 'hcyms1', 26, '2013-12-11 07:01:25', 'New', 'Available'),
(222, 'hcyms1', 26, '2013-12-11 07:01:25', 'New', 'Available'),
(223, 'hcyms1', 26, '2013-12-11 07:01:25', 'New', 'Available'),
(224, 'hcyms1', 26, '2013-12-11 07:01:25', 'New', 'Available'),
(225, 'hcyms1', 26, '2013-12-11 07:01:25', 'New', 'Available'),
(226, 'hcyms1', 27, '2013-12-11 07:02:56', 'New', 'Available'),
(227, 'hcyms1', 27, '2013-12-11 07:02:56', 'New', 'Available'),
(228, 'hcyms1', 27, '2013-12-11 07:02:56', 'New', 'Available'),
(229, 'hcyms1', 27, '2013-12-11 07:02:56', 'New', 'Available'),
(230, 'hcyms1', 27, '2013-12-11 07:02:56', 'New', 'Available'),
(231, 'hcyms1', 27, '2013-12-11 07:02:56', 'New', 'Available'),
(232, 'hcyms1', 27, '2013-12-11 07:02:56', 'New', 'Available'),
(233, 'hcyms1', 27, '2013-12-11 07:02:56', 'New', 'Available'),
(234, 'hcyms1', 27, '2013-12-11 07:02:56', 'New', 'Available'),
(235, 'hcyms1', 27, '2013-12-11 07:02:56', 'New', 'Available'),
(236, 'hcyms1', 27, '2013-12-11 07:02:56', 'New', 'Available'),
(237, 'hcyms1', 27, '2013-12-11 07:02:56', 'New', 'Available'),
(238, 'hcyms1', 27, '2013-12-11 07:02:56', 'New', 'Available'),
(239, 'hcyms1', 27, '2013-12-11 07:02:56', 'New', 'Available'),
(240, 'hcyms1', 27, '2013-12-11 07:02:56', 'New', 'Available'),
(241, 'hcyms1', 27, '2013-12-11 07:02:56', 'New', 'Available'),
(242, 'hcyms1', 27, '2013-12-11 07:02:56', 'New', 'Available'),
(243, 'hcyms1', 27, '2013-12-11 07:02:56', 'New', 'Available'),
(244, 'hcyms1', 27, '2013-12-11 07:02:56', 'New', 'Available'),
(245, 'hcyms1', 27, '2013-12-11 07:02:56', 'New', 'Available'),
(246, 'hcyms1', 27, '2013-12-11 07:02:56', 'New', 'Available'),
(247, 'hcyms1', 28, '2013-12-11 07:05:25', 'Damaged', 'Available'),
(248, 'hcyms1', 28, '2013-12-11 07:05:25', 'Damaged', 'Available'),
(249, 'hcyms1', 28, '2013-12-11 07:05:25', 'Damaged', 'Available'),
(250, 'hcyms1', 28, '2013-12-11 07:05:25', 'Damaged', 'Available'),
(251, 'hcyms1', 28, '2013-12-11 07:05:25', 'Damaged', 'Available'),
(252, 'hcyms1', 28, '2013-12-11 07:05:25', 'Damaged', 'Available'),
(253, 'hcyms1', 28, '2013-12-11 07:05:25', 'Damaged', 'Available'),
(254, 'hcyms1', 28, '2013-12-11 07:05:25', 'Damaged', 'Available'),
(255, 'hcyms1', 28, '2013-12-11 07:05:25', 'Damaged', 'Available'),
(256, 'hcyms1', 28, '2013-12-11 07:05:25', 'Damaged', 'Available'),
(257, 'hcyms1', 28, '2013-12-11 07:05:25', 'Damaged', 'Available'),
(258, 'hcyms1', 28, '2013-12-11 07:05:25', 'Damaged', 'Available'),
(259, 'hcyms1', 28, '2013-12-11 07:05:25', 'Damaged', 'Available'),
(260, 'hcyms1', 28, '2013-12-11 07:05:25', 'Damaged', 'Available'),
(261, 'hcyms1', 28, '2013-12-11 07:05:25', 'Damaged', 'Available'),
(262, 'hcyms1', 28, '2013-12-11 07:05:25', 'Damaged', 'Available'),
(263, 'hcyap1', 28, '2013-12-11 07:05:25', 'Damaged', 'Available'),
(264, 'hcyms1', 28, '2013-12-11 07:05:25', 'Damaged', 'Available'),
(265, 'hcyms1', 28, '2013-12-11 07:05:25', 'Damaged', 'Available'),
(266, 'hcyms1', 28, '2013-12-11 07:05:25', 'Damaged', 'Available'),
(267, 'hcyms1', 29, '2013-12-11 07:07:02', 'Old', 'Available'),
(268, 'hcyms1', 29, '2013-12-11 07:07:02', 'Old', 'Available'),
(269, 'hcyms1', 29, '2013-12-11 07:07:02', 'Old', 'Available'),
(270, 'hcyms1', 29, '2013-12-11 07:07:02', 'Old', 'Available'),
(271, 'hcyms1', 29, '2013-12-11 07:07:02', 'Old', 'Available'),
(272, 'hcyms1', 29, '2013-12-11 07:07:02', 'Old', 'Available'),
(273, 'hcyms1', 29, '2013-12-11 07:07:02', 'Old', 'Available'),
(274, 'hcyms1', 29, '2013-12-11 07:07:02', 'Old', 'Available'),
(275, 'hcyms1', 29, '2013-12-11 07:07:02', 'Old', 'Available'),
(276, 'hcyms1', 29, '2013-12-11 07:07:02', 'Old', 'Available'),
(277, 'hcyms1', 29, '2013-12-11 07:07:02', 'Old', 'Available'),
(278, 'hcyms1', 29, '2013-12-11 07:07:02', 'Old', 'Available'),
(279, 'hcyms1', 29, '2013-12-11 07:07:02', 'Old', 'Available'),
(280, 'hcyms1', 30, '2013-12-11 09:22:50', 'Old', 'Available'),
(281, 'hcyed1', 30, '2013-12-11 09:22:50', 'Old', 'Available'),
(282, 'hcyms1', 30, '2013-12-11 09:22:50', 'Old', 'Available'),
(283, 'hcyms1', 30, '2013-12-11 09:22:50', 'Old', 'Available'),
(284, 'hcyms1', 30, '2013-12-11 09:22:50', 'Old', 'Available'),
(285, 'hcyms1', 30, '2013-12-11 09:22:50', 'Old', 'Available'),
(286, 'hcyms1', 30, '2013-12-11 09:22:50', 'Old', 'Available'),
(287, 'hcyms1', 30, '2013-12-11 09:22:50', 'Old', 'Available'),
(288, 'hcyms1', 30, '2013-12-11 09:22:50', 'Old', 'Available'),
(289, 'hcyms1', 30, '2013-12-11 09:22:50', 'Old', 'Available'),
(290, 'hcyms1', 30, '2013-12-11 09:22:50', 'Old', 'Available'),
(291, 'hcyms1', 30, '2013-12-11 09:22:50', 'Old', 'Available'),
(292, 'hcyms1', 31, '2013-12-11 09:25:32', 'Old', 'Available'),
(293, 'hcyms1', 31, '2013-12-11 09:25:32', 'Old', 'Available'),
(294, 'hcyed1', 31, '2013-12-11 09:25:32', 'Old', 'Available'),
(295, 'hcyms1', 31, '2013-12-11 09:25:32', 'Old', 'Available'),
(296, 'hcyms1', 31, '2013-12-11 09:25:32', 'Old', 'Available'),
(297, 'hcyms1', 31, '2013-12-11 09:25:32', 'Old', 'Available'),
(298, 'hcyms1', 31, '2013-12-11 09:25:32', 'Old', 'Available'),
(299, 'hcyms1', 31, '2013-12-11 09:25:32', 'Old', 'Available'),
(300, 'hcyms1', 32, '2014-01-17 19:00:10', 'New', 'Available'),
(301, 'hcyms1', 32, '2014-01-17 19:00:10', 'New', 'Available'),
(302, 'hcyms1', 32, '2014-01-17 19:00:10', 'New', 'Available'),
(303, 'hcyed1', 32, '2014-01-17 19:00:10', 'New', 'Available'),
(304, 'hcyms1', 32, '2014-01-17 19:00:10', 'New', 'Available'),
(305, 'hcyms1', 32, '2014-01-17 19:00:10', 'New', 'Available'),
(306, 'hcyms1', 32, '2014-01-17 19:00:10', 'New', 'Available'),
(307, 'hcyms1', 32, '2014-01-17 19:00:10', 'New', 'Available'),
(308, 'hcyms1', 32, '2014-01-17 19:00:10', 'New', 'Available'),
(309, 'hcyms1', 32, '2014-01-17 19:00:10', 'New', 'Available');

-- --------------------------------------------------------

--
-- Table structure for table `book_information`
--

CREATE TABLE `book_information` (
  `id_pk` int(4) NOT NULL,
  `title` varchar(50) NOT NULL,
  `category_fk` int(2) DEFAULT NULL,
  `publisher_fk` int(2) DEFAULT NULL,
  `authors` varchar(100) NOT NULL,
  `isbn_13` varchar(13) DEFAULT NULL CHECK (octet_length(`isbn_13`) = 13),
  `copyright_year` year(4) DEFAULT NULL CHECK (octet_length(`copyright_year`) = 4)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `book_information`
--

INSERT INTO `book_information` (`id_pk`, `title`, `category_fk`, `publisher_fk`, `authors`, `isbn_13`, `copyright_year`) VALUES
(15, 'Natural Resources', 8, 1, 'Robin Kerrod', '9781854356284', 1994),
(16, 'Encyclopedia Americana', 5, 2, 'Grolier', '9781854356284', 1993),
(17, 'Algebra 1', 3, 3, 'Carolyn Bradshaw, Michael Seals', '9780717201198', 2004),
(18, 'The Philippine Daily Inquirer', 7, 4, 'Various', '9780131250871', 2013),
(19, 'Science in our World', 4, 5, 'Brian Knapp', '9781864180497', 1996),
(20, 'Literature', 9, 5, 'Greg Glowka', '9780130508416', 2001),
(21, 'Lexicon Universal Encyclopedia', 5, 6, 'Lexicon', '9780717220250', 1993),
(22, 'Science and Invention Encyclopedia', 5, 7, 'Clarke Donald, Dartford Mark', '9780863074912', 1992),
(23, 'Integrated Science Textbook ', 4, 8, 'Merde C. Tan', '9780071107587', 2009),
(24, 'Algebra 2', 3, 9, 'Glencoe McGraw Hill', '9780078738302', 2008),
(25, 'Wiki at Panitikan ', 7, 10, 'Lorenza P. Avera', '9789710715749', 2000),
(26, 'English Expressways TextBook for 4th year', 9, 11, 'Virginia Bermudez Ed. O. et al', '9789710315338', 2007),
(27, 'Asya Pag-usbong Ng Kabihasnan', 8, 12, 'Ricardo T. Jose, Ph . D.', '9789710723249', 2008),
(28, 'Literature (the readers choice)', 9, 13, 'Glencoe McGraw Hill', '9780026353786', 2001),
(29, 'Beloved a Novel', 9, 14, 'Toni Morrison', '9781400033416', 1987),
(30, 'Silver Burdett Engish', 2, 15, 'Judy Brim', '9780382035753', 1985),
(31, 'The Corporate Warriors (Six Classic Cases in Ameri', 8, 16, 'Douglas K. Ramsey', '9780395354872', 1987),
(32, 'Introduction to Information System', 9, 17, 'George M Marakas', '9780073376882', 2013);

-- --------------------------------------------------------

--
-- Table structure for table `borrow`
--

CREATE TABLE `borrow` (
  `id_pk` int(4) NOT NULL,
  `book_id_fk` int(4) DEFAULT NULL,
  `borrower_owa_fk` varchar(6) DEFAULT NULL,
  `borrow_date` datetime DEFAULT NULL,
  `due_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `borrow`
--

INSERT INTO `borrow` (`id_pk`, `book_id_fk`, `borrower_owa_fk`, `borrow_date`, `due_date`) VALUES
(482, 15, 'hcyms1', '2014-03-20 23:38:22', '2014-01-03'),
(483, 15, 'hcyja1', '2014-03-20 23:49:34', '2014-03-21'),
(484, 16, 'hcyja1', '2014-03-20 23:50:27', '2014-03-21');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id_pk` int(2) NOT NULL,
  `name` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id_pk`, `name`) VALUES
(1, 'Periodical'),
(2, 'English'),
(3, 'Math'),
(4, 'Science'),
(5, 'Encyclopedia'),
(6, 'Filipiniana'),
(7, 'Newspaper'),
(8, 'General'),
(9, 'References');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `owa_pk` varchar(6) NOT NULL CHECK (octet_length(`owa_pk`) = 6),
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `gender` enum('M','F') NOT NULL,
  `city` varchar(30) NOT NULL,
  `contactnumber` varchar(17) DEFAULT NULL CHECK (octet_length(`contactnumber`) between 9 and 17),
  `type_fk` int(2) NOT NULL,
  `year_level` enum('First Year','Second Year','Third Year','Fourth Year','Faculty') NOT NULL,
  `status` enum('Active','Banned') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`owa_pk`, `firstname`, `lastname`, `gender`, `city`, `contactnumber`, `type_fk`, `year_level`, `status`) VALUES
('hcyaa1', 'April Joy', 'Aguilar', 'F', 'E.B. Magalona', '60105510093', 22, 'Second Year', 'Banned'),
('hcyap1', 'Alfonso', 'Pancho', 'M', 'E.B. Magalona', '60105510094', 22, 'First Year', 'Active'),
('hcycl1', 'Chinie marie', 'Laborosa', 'F', 'E.B. Magalona', '60105510103', 22, 'Second Year', 'Active'),
('hcycp1', 'Chairty Joy', 'Punzalan', 'F', 'E.B. Magalona', '60105510101', 2, 'Faculty', 'Active'),
('hcyed1', 'Eleazar', 'Duterte', 'M', 'E.B. Magalona', '60105510097', 22, 'Second Year', 'Active'),
('hcyee1', 'Ellen Mae', 'Espino', 'F', 'E.B. Magalona', '60105510098', 22, 'First Year', 'Active'),
('hcyja1', 'Jonathan', 'Antanilla', 'M', 'E.B. Magalona', '60105510095', 22, 'Fourth Year', 'Active'),
('hcyjs1', 'John', 'Smith', 'M', 'Kuala Lumpur', '60105510091', 2, 'First Year', 'Active'),
('hcykd1', 'Kristine May', 'Dela Rosa', 'F', 'Silay City', '60105510102', 22, 'Second Year', 'Active'),
('hcyms1', 'Mark', 'Sanchez', 'M', 'Talisay', '60105510092', 2, 'Faculty', 'Active'),
('hcyrm1', 'Ruth', 'Magbanua', 'F', 'E.B. Magalona', '60105510099', 22, 'Second Year', 'Active'),
('hcyrm2', 'Ruby', 'Morante', 'F', 'E.B. Magalona', '60105510104', 2, 'Faculty', 'Active'),
('hcyrp1', 'Renzo Bryan', 'Pedroso', 'M', 'Silay City', '60105510096', 22, 'Third Year', 'Active'),
('hcysg1', 'Shaina Marie', 'Gabino', 'F', 'Silay City', '60105510100', 22, 'Second Year', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `member_type`
--

CREATE TABLE `member_type` (
  `id_pk` int(2) NOT NULL,
  `name` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `member_type`
--

INSERT INTO `member_type` (`id_pk`, `name`) VALUES
(2, 'Teacher'),
(20, 'Employee'),
(21, 'Non-Teaching'),
(22, 'Student'),
(32, 'Construction');

-- --------------------------------------------------------

--
-- Table structure for table `publisher`
--

CREATE TABLE `publisher` (
  `id_pk` int(3) NOT NULL,
  `name` varchar(50) NOT NULL,
  `parentcompany` varchar(50) NOT NULL,
  `hq_address` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `publisher`
--

INSERT INTO `publisher` (`id_pk`, `name`, `parentcompany`, `hq_address`) VALUES
(1, 'Benchmark Books', 'Marshall', '3269 S Main St #250, Salt Lake City, UT 84115, United States'),
(2, 'Groiler Inc.', 'Groiler Inc.', 'Conneticut'),
(3, 'Prentice Hall', 'Pearson Education. Inc', 'Hoboken, New Jersey'),
(4, 'Philipines Daily Inquirer', 'Publication Inc.', 'Pasay City'),
(5, 'Prentice Hall', 'Regency Publishing Group', 'Hoboken, New Jersey, United States'),
(6, 'Publication Inc.', 'Mansueto Ventures LLC', 'Lexicon'),
(7, 'Publisher', 'Pearson PLC', 'Westport Conneticut'),
(8, 'Vibal Group', 'Vibal Publishing House Inc.', '12536. Araneta Avenue Corner Ma. Clara St., Quezon City, Singapore'),
(9, 'McGrawhill', 'The McGrawHill Companies Inc.', 'New York, United States'),
(10, ' Jgm Publishing Ltd.', 'JGM & S Corporation', 'Oldham, Greater Manchester, England'),
(11, 'SD Publications, Inc.', 'SD Publications, Inc.', 'Gregorio Araneta Avenue, Quezon City, Singapore'),
(12, 'Vibal Group', 'Vibal Publishing House Inc.', 'Araneta Avenue . Cor. Maria Clara St., Quezon City, Singapore'),
(13, 'McGraw-Hill Education', 'the McGrawHill Companies Inc', 'New York, United States'),
(14, 'Alfred A. Knoff, Inc', 'Knopf Doubleday Publishing Group', 'New York, New York, United States'),
(15, 'Silver', 'Silver Burdett Company', '211 E. 7th Street, Suite 620, Austin, TX'),
(16, 'Houghton Miffin Company', 'Houghton Miffin Company', 'Boston, United States'),
(17, 'Brian INC', 'CHMSC', '7101 SW 66th St, Miami, Florida, United States');

-- --------------------------------------------------------

--
-- Table structure for table `returns`
--

CREATE TABLE `returns` (
  `borrow_id_fk_pk` int(4) NOT NULL,
  `return_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `returns`
--

INSERT INTO `returns` (`borrow_id_fk_pk`, `return_date`) VALUES
(483, '2014-03-21 00:30:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`owa_fk_pk`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`owa_fk_pk`);

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id_pk`),
  ADD KEY `owner_owa_fk` (`owner_owa_fk`),
  ADD KEY `book_information_id_fk` (`book_information_id_fk`);

--
-- Indexes for table `book_information`
--
ALTER TABLE `book_information`
  ADD PRIMARY KEY (`id_pk`),
  ADD KEY `category_fk` (`category_fk`),
  ADD KEY `publisher_fk` (`publisher_fk`);

--
-- Indexes for table `borrow`
--
ALTER TABLE `borrow`
  ADD PRIMARY KEY (`id_pk`),
  ADD KEY `book_id_fk` (`book_id_fk`),
  ADD KEY `borrower_owa_fk` (`borrower_owa_fk`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id_pk`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`owa_pk`),
  ADD KEY `type_fk` (`type_fk`);

--
-- Indexes for table `member_type`
--
ALTER TABLE `member_type`
  ADD PRIMARY KEY (`id_pk`);

--
-- Indexes for table `publisher`
--
ALTER TABLE `publisher`
  ADD PRIMARY KEY (`id_pk`);

--
-- Indexes for table `returns`
--
ALTER TABLE `returns`
  ADD PRIMARY KEY (`borrow_id_fk_pk`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `id_pk` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=310;

--
-- AUTO_INCREMENT for table `book_information`
--
ALTER TABLE `book_information`
  MODIFY `id_pk` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `borrow`
--
ALTER TABLE `borrow`
  MODIFY `id_pk` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=485;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id_pk` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `publisher`
--
ALTER TABLE `publisher`
  MODIFY `id_pk` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `account`
--
ALTER TABLE `account`
  ADD CONSTRAINT `account_ibfk_1` FOREIGN KEY (`owa_fk_pk`) REFERENCES `member` (`owa_pk`);

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`owa_fk_pk`) REFERENCES `member` (`owa_pk`);

--
-- Constraints for table `book`
--
ALTER TABLE `book`
  ADD CONSTRAINT `book_ibfk_1` FOREIGN KEY (`owner_owa_fk`) REFERENCES `member` (`owa_pk`),
  ADD CONSTRAINT `book_ibfk_2` FOREIGN KEY (`book_information_id_fk`) REFERENCES `book_information` (`id_pk`);

--
-- Constraints for table `book_information`
--
ALTER TABLE `book_information`
  ADD CONSTRAINT `book_information_ibfk_1` FOREIGN KEY (`category_fk`) REFERENCES `category` (`id_pk`),
  ADD CONSTRAINT `book_information_ibfk_2` FOREIGN KEY (`publisher_fk`) REFERENCES `publisher` (`id_pk`);

--
-- Constraints for table `borrow`
--
ALTER TABLE `borrow`
  ADD CONSTRAINT `borrow_ibfk_1` FOREIGN KEY (`book_id_fk`) REFERENCES `book` (`id_pk`),
  ADD CONSTRAINT `borrow_ibfk_2` FOREIGN KEY (`borrower_owa_fk`) REFERENCES `member` (`owa_pk`);

--
-- Constraints for table `member`
--
ALTER TABLE `member`
  ADD CONSTRAINT `member_ibfk_1` FOREIGN KEY (`type_fk`) REFERENCES `member_type` (`id_pk`);

--
-- Constraints for table `returns`
--
ALTER TABLE `returns`
  ADD CONSTRAINT `returns_ibfk_1` FOREIGN KEY (`borrow_id_fk_pk`) REFERENCES `borrow` (`id_pk`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;