-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2017 at 06:45 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sacco`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE IF NOT EXISTS `admin_users` (
`user_id` smallint(5) unsigned NOT NULL,
  `admin_login` varchar(48) NOT NULL,
  `admin_pass` char(32) NOT NULL,
  `admin_name` varchar(64) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`user_id`, `admin_login`, `admin_pass`, `admin_name`) VALUES
(5, 'testadmin', '8e0afbb78a344c39e7c400f26bb40a51', 'testadmin'),
(2, 'admin_1', '8e0afbb78a344c39e7c400f26bb40a51', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `country_list`
--

CREATE TABLE IF NOT EXISTS `country_list` (
`country_id` tinyint(4) unsigned NOT NULL,
  `country_name` varchar(40) NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `curr_code` tinyint(4) unsigned NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=240 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `country_list`
--

INSERT INTO `country_list` (`country_id`, `country_name`, `enabled`, `curr_code`) VALUES
(1, 'Afghanistan', 0, 2),
(2, 'Albania', 0, 3),
(3, 'Algeria', 0, 40),
(4, 'Andorra', 0, 0),
(5, 'Angola', 0, 6),
(6, 'Anguilla', 0, 0),
(7, 'Antarctica', 0, 0),
(8, 'Antigua and Barbuda', 0, 0),
(9, 'Argentina', 0, 7),
(10, 'Armenia', 0, 4),
(11, 'Aruba', 0, 9),
(12, 'Ascension Island', 0, 0),
(13, 'Australia', 0, 8),
(14, 'Austria', 0, 0),
(15, 'Azerbaijan', 0, 10),
(16, 'Bahamas', 0, 21),
(17, 'Bahrain', 0, 15),
(18, 'Bangladesh', 0, 13),
(19, 'Barbados', 0, 12),
(20, 'Belarus', 0, 24),
(21, 'Belgium', 0, 0),
(22, 'Belize', 0, 25),
(23, 'Benin', 0, 0),
(24, 'Bermuda', 0, 17),
(25, 'Bhutan', 0, 22),
(26, 'Bolivia', 0, 19),
(27, 'Bophuthatswana', 0, 0),
(28, 'Bosnia-Herzegovina', 0, 0),
(29, 'Botswana', 0, 23),
(30, 'Bouvet Island', 0, 0),
(31, 'Brazil', 0, 20),
(32, 'British Indian Ocean', 0, 0),
(33, 'British Virgin Islands', 0, 0),
(34, 'Brunei Darussalam', 0, 18),
(35, 'Bulgaria', 0, 14),
(36, 'Burkina Faso', 0, 0),
(37, 'Burundi', 0, 16),
(38, 'Cambodia', 0, 75),
(39, 'Cameroon', 0, 0),
(40, 'Canada', 0, 26),
(41, 'Cape Verde Island', 0, 0),
(42, 'Cayman Islands', 0, 80),
(43, 'Central Africa', 0, 0),
(44, 'Chad', 0, 0),
(45, 'Channel Islands', 0, 0),
(46, 'Chile', 0, 29),
(47, 'China, Peoples Republic', 0, 0),
(48, 'Christmas Island', 0, 0),
(49, 'Cocos (Keeling) Islands', 0, 0),
(50, 'Colombia', 0, 31),
(51, 'Comoros Islands', 0, 0),
(52, 'Congo', 0, 27),
(53, 'Cook Islands', 0, 0),
(54, 'Costa Rica', 0, 32),
(55, 'Croatia', 0, 59),
(56, 'Cuba', 0, 33),
(57, 'Cyprus', 0, 35),
(58, 'Czech Republic', 0, 36),
(59, 'Denmark', 0, 38),
(60, 'Djibouti', 0, 37),
(61, 'Dominica', 0, 39),
(62, 'Dominican Republic', 0, 39),
(63, 'Easter Island', 0, 0),
(64, 'Ecuador', 0, 0),
(65, 'Egypt', 0, 42),
(66, 'El Salvador', 0, 136),
(67, 'England', 0, 0),
(68, 'Equatorial Guinea', 0, 0),
(69, 'Estonia', 0, 41),
(70, 'Ethiopia', 0, 44),
(71, 'Faeroe Islands', 0, 0),
(72, 'Falkland Islands', 0, 47),
(73, 'Fiji', 0, 46),
(74, 'Finland', 0, 0),
(75, 'France', 0, 0),
(76, 'French Guyana', 0, 0),
(77, 'French Polynesia', 0, 0),
(78, 'Gabon', 0, 0),
(79, 'Gambia', 0, 53),
(80, 'Georgia Republic', 0, 0),
(81, 'Germany', 0, 0),
(82, 'Gibraltar', 0, 52),
(83, 'Greece', 0, 0),
(84, 'Greenland', 0, 0),
(85, 'Grenada', 0, 0),
(86, 'Guadeloupe (French)', 0, 0),
(87, 'Guatemala', 0, 55),
(88, 'Guernsey Island', 0, 0),
(89, 'Guinea', 0, 54),
(90, 'Guinea Bissau', 0, 0),
(91, 'Guyana', 0, 56),
(92, 'Haiti', 0, 60),
(93, 'Heard and McDonald Isls', 0, 0),
(94, 'Honduras', 0, 58),
(95, 'Hong Kong', 0, 57),
(96, 'Hungary', 0, 61),
(97, 'Iceland', 0, 68),
(98, 'India', 0, 65),
(99, 'Iran', 0, 67),
(100, 'Iraq', 0, 66),
(101, 'Ireland', 0, 0),
(102, 'Isle of Man', 0, 64),
(103, 'Israel', 0, 63),
(104, 'Italy', 0, 0),
(105, 'Ivory Coast', 0, 0),
(106, 'Jamaica', 0, 70),
(107, 'Japan', 0, 72),
(108, 'Jersey Island', 0, 0),
(109, 'Jordan', 0, 71),
(110, 'Kazakhstan', 0, 81),
(111, 'Kenya', 1, 73),
(112, 'Kiribati', 0, 0),
(113, 'Kuwait', 0, 79),
(114, 'Laos', 0, 82),
(115, 'Latvia', 0, 88),
(116, 'Lebanon', 0, 83),
(117, 'Lesotho', 0, 86),
(118, 'Liberia', 0, 85),
(119, 'Libya', 0, 89),
(120, 'Liechtenstein', 0, 0),
(121, 'Lithuania', 0, 87),
(122, 'Luxembourg', 0, 0),
(123, 'Macao', 0, 0),
(124, 'Macedonia', 0, 93),
(125, 'Madagascar', 0, 92),
(126, 'Malawi', 0, 101),
(127, 'Malaysia', 0, 103),
(128, 'Maldives', 0, 100),
(129, 'Mali', 0, 0),
(130, 'Malta', 0, 98),
(131, 'Martinique (French)', 0, 0),
(132, 'Mauritania', 0, 97),
(133, 'Mauritius', 0, 99),
(134, 'Mayotte', 0, 0),
(135, 'Mexico', 0, 102),
(136, 'Micronesia', 0, 0),
(137, 'Moldavia', 0, 0),
(138, 'Monaco', 0, 0),
(139, 'Mongolia', 0, 95),
(140, 'Montenegro', 0, 0),
(141, 'Montserrat', 0, 0),
(142, 'Morocco', 0, 90),
(143, 'Mozambique', 0, 104),
(144, 'Myanmar', 0, 94),
(145, 'Namibia', 0, 105),
(146, 'Nauru', 0, 0),
(147, 'Nepal', 0, 109),
(148, 'Netherlands', 0, 5),
(149, 'Netherlands Antilles', 0, 5),
(150, 'New Caledonia (French)', 0, 0),
(151, 'New Zealand', 0, 110),
(152, 'Nicaragua', 0, 107),
(153, 'Niger', 0, 106),
(154, 'Niue', 0, 0),
(155, 'Norfolk Island', 0, 0),
(156, 'North Korea', 0, 0),
(157, 'Northern Ireland', 0, 0),
(158, 'Norway', 0, 108),
(159, 'Oman', 0, 111),
(160, 'Pakistan', 0, 116),
(161, 'Panama', 0, 112),
(162, 'Papua New Guinea', 0, 114),
(163, 'Paraguay', 0, 118),
(164, 'Peru', 0, 113),
(165, 'Philippines', 0, 115),
(166, 'Pitcairn Island', 0, 0),
(167, 'Poland', 0, 117),
(168, 'Polynesia (French)', 0, 0),
(169, 'Portugal', 0, 0),
(170, 'Qatar', 0, 119),
(171, 'Reunion Island', 0, 0),
(172, 'Romania', 0, 120),
(173, 'Russia', 0, 122),
(174, 'Rwanda', 0, 123),
(175, 'S.Georgia Sandwich Isls', 0, 0),
(176, 'San Marino', 0, 0),
(177, 'Sao Tome, Principe', 0, 0),
(178, 'Saudi Arabia', 0, 124),
(179, 'Scotland', 0, 0),
(180, 'Senegal', 0, 0),
(181, 'Serbia', 0, 121),
(182, 'Seychelles', 0, 126),
(183, 'Shetland', 0, 0),
(184, 'Sierra Leone', 0, 131),
(185, 'Singapore', 0, 129),
(186, 'Slovak Republic', 0, 0),
(187, 'Slovenia', 0, 0),
(188, 'Solomon Islands', 0, 125),
(189, 'Somalia', 0, 132),
(190, 'South Africa', 0, 169),
(191, 'South Korea', 0, 0),
(192, 'Spain', 0, 0),
(193, 'Sri Lanka', 0, 84),
(194, 'St. Helena', 0, 0),
(195, 'St. Kitts Nevis Anguilla', 0, 0),
(196, 'St. Lucia', 0, 0),
(197, 'St. Martins', 0, 0),
(198, 'St. Pierre Miquelon', 0, 0),
(199, 'St. Vincent Grenadines', 0, 0),
(200, 'Sudan', 0, 127),
(201, 'Suriname', 0, 134),
(202, 'Svalbard Jan Mayen', 0, 0),
(203, 'Swaziland', 0, 138),
(204, 'Sweden', 0, 128),
(205, 'Switzerland', 0, 28),
(206, 'Syria', 0, 137),
(207, 'Tahiti', 0, 0),
(208, 'Taiwan', 0, 147),
(209, 'Tajikistan', 0, 140),
(210, 'Tanzania', 0, 148),
(211, 'Thailand', 0, 139),
(212, 'Togo', 0, 0),
(213, 'Tokelau', 0, 0),
(214, 'Tonga', 0, 143),
(215, 'Trinidad and Tobago', 0, 145),
(216, 'Tunisia', 0, 142),
(217, 'Turkmenistan', 0, 141),
(218, 'Turks and Caicos Isls', 0, 0),
(219, 'Tuvalu', 0, 146),
(220, 'Uganda', 0, 150),
(221, 'Ukraine', 0, 149),
(222, 'United Arab Emirates', 0, 1),
(223, 'United States', 0, 151),
(224, 'Uruguay', 0, 152),
(225, 'Uzbekistan', 0, 153),
(226, 'Vanuatu', 0, 157),
(227, 'Vatican City State', 0, 0),
(228, 'Venezuela', 0, 0),
(229, 'Vietnam', 0, 0),
(230, 'Virgin Islands (Brit)', 0, 0),
(231, 'Wales', 0, 0),
(232, 'Wallis Futuna Islands', 0, 0),
(233, 'Western Sahara', 0, 0),
(234, 'Western Samoa', 0, 0),
(235, 'Yemen', 0, 168),
(236, 'Yugoslavia', 0, 0),
(237, 'Zaire', 0, 0),
(238, 'Zambia', 0, 170),
(239, 'Zimbabwe', 0, 171);

-- --------------------------------------------------------

--
-- Table structure for table `dividend_payments`
--

CREATE TABLE IF NOT EXISTS `dividend_payments` (
`dividend_payments_id` int(10) unsigned NOT NULL,
  `dividend_payments_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dividend_payments_value_per_share` decimal(11,2) NOT NULL,
  `dividend_payments_amount_paid` decimal(11,2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dividend_payout`
--

CREATE TABLE IF NOT EXISTS `dividend_payout` (
`dividend_payout_id` int(10) unsigned NOT NULL,
  `dividend_payout_value` decimal(11,2) unsigned NOT NULL,
  `dividend_payout_amount` decimal(11,2) unsigned NOT NULL,
  `dividend_payout_member_count` int(10) unsigned NOT NULL,
  `dividend_payout_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dividend_payout`
--

INSERT INTO `dividend_payout` (`dividend_payout_id`, `dividend_payout_value`, `dividend_payout_amount`, `dividend_payout_member_count`, `dividend_payout_date`) VALUES
(1, '1.00', '16349.00', 50, '2011-02-14 13:10:31'),
(2, '0.00', '16349.00', 0, '2011-02-14 13:11:58'),
(3, '1.00', '16349.00', 0, '2011-02-14 13:12:26'),
(4, '1.00', '16349.00', 50, '2011-02-14 13:12:52'),
(5, '3.00', '49047.00', 0, '2011-02-14 13:26:46'),
(6, '3.00', '49047.00', 9, '2011-02-14 13:34:01'),
(7, '3.00', '49047.00', 0, '2011-02-14 13:34:23'),
(8, '2.00', '32698.00', 6, '2011-02-14 15:33:31'),
(9, '3.00', '49047.00', 6, '2011-02-16 18:08:00'),
(10, '7.00', '11410.00', 5, '2017-09-24 20:51:45'),
(11, '1.00', '6371.00', 8, '2017-11-20 15:55:13'),
(12, '1.00', '6371.00', 8, '2017-11-20 16:02:42'),
(13, '1.00', '6371.00', 8, '2017-11-20 16:13:09'),
(14, '3.00', '19113.00', 8, '2017-11-20 16:13:32'),
(15, '3.00', '19113.00', 8, '2017-11-20 16:14:00'),
(16, '2.00', '12742.00', 8, '2017-11-20 16:28:20'),
(17, '2.00', '12742.00', 8, '2017-11-20 16:30:17');

-- --------------------------------------------------------

--
-- Table structure for table `email`
--

CREATE TABLE IF NOT EXISTS `email` (
`email_id` int(10) unsigned NOT NULL,
  `member_id` int(10) unsigned NOT NULL,
  `email_front_name` varchar(24) NOT NULL,
  `email_detail` varchar(32) NOT NULL,
  `public` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM AUTO_INCREMENT=114 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `email`
--

INSERT INTO `email` (`email_id`, `member_id`, `email_front_name`, `email_detail`, `public`) VALUES
(26, 18, 'Primary Email', 'tanuirodgers@yahoo.com', 1),
(27, 18, 'Alternative Email', 'rodgy12@gmail.com', 1),
(75, 66, 'Primary Email', 'mywriter001@gmail.com', 1),
(28, 19, 'Primary Email', 'kiturben87@gmail.com', 1),
(29, 20, 'Primary Email', 'test@test.com', 1),
(30, 21, 'Primary Email', 'testuser@gmail.com', 1),
(31, 22, 'Primary Email', 'wilsonkamau@gmail.com', 1),
(32, 23, 'Primary Email', 'keyamakanga@gmail.com', 1),
(35, 26, 'Primary Email', 'willy@gmail.com', 1),
(34, 25, 'Primary Email', 'kamau@gmail.com', 1),
(36, 27, 'Primary Email', 'fiona@gmail.com', 1),
(37, 28, 'Primary Email', 'faith@gmail.com', 1),
(38, 29, 'Primary Email', 'thuku@gmail.com', 1),
(39, 30, 'Primary Email', 'abandu@gmail.com', 1),
(40, 31, 'Primary Email', 'dianah@gmail.com', 1),
(113, 104, 'Primary Email', 'racheal@gmail.com', 1),
(112, 103, 'Primary Email', 'charles@gmail.com', 1),
(111, 102, 'Primary Email', 'karibadyab@gmail.com', 1),
(110, 101, 'Primary Email', 'karibadyabe@gmail.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `fund_account`
--

CREATE TABLE IF NOT EXISTS `fund_account` (
`fund_account_id` int(10) unsigned NOT NULL,
  `member_id` int(10) unsigned NOT NULL,
  `fund_account_debit` decimal(11,2) unsigned NOT NULL,
  `fund_account_credit` decimal(11,2) unsigned NOT NULL,
  `fund_account_active` tinyint(1) NOT NULL DEFAULT '1',
  `fund_account_period_credit_count` smallint(5) unsigned NOT NULL,
  `fund_account_period_debit_count` smallint(5) unsigned NOT NULL,
  `fund_account_period_debit_amount` decimal(10,2) unsigned NOT NULL,
  `fund_account_period_credit_amount` decimal(10,2) unsigned NOT NULL,
  `fund_account_period_day_count` tinyint(3) unsigned NOT NULL,
  `fund_account_period_reset_date` datetime NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=104 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fund_account`
--

INSERT INTO `fund_account` (`fund_account_id`, `member_id`, `fund_account_debit`, `fund_account_credit`, `fund_account_active`, `fund_account_period_credit_count`, `fund_account_period_debit_count`, `fund_account_period_debit_amount`, `fund_account_period_credit_amount`, `fund_account_period_day_count`, `fund_account_period_reset_date`) VALUES
(103, 104, '15000.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(18, 19, '144723.00', '17568.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(19, 20, '1000.00', '10000.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(20, 21, '63245.00', '2250.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(21, 22, '200.00', '900.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(22, 23, '360.00', '90.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(25, 26, '33000.00', '3000.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(24, 25, '4800.00', '310.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(26, 27, '27600.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(27, 28, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(28, 29, '34300.00', '300.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(29, 30, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(30, 31, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(31, 32, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(32, 33, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(33, 34, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(34, 35, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(35, 36, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(36, 37, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(37, 38, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(38, 39, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(39, 40, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(40, 41, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(41, 42, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(42, 43, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(43, 44, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(44, 45, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(45, 46, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(46, 47, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(47, 48, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(48, 49, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(49, 50, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(50, 51, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(51, 52, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(52, 53, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(53, 54, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(54, 55, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(55, 56, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(56, 57, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(57, 58, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(58, 59, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(59, 60, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(60, 61, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(61, 62, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(62, 63, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(63, 64, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(64, 65, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(65, 66, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(66, 67, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(67, 68, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(68, 69, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(69, 70, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(70, 71, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(71, 72, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(72, 73, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(73, 74, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(74, 75, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(75, 76, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(76, 77, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(77, 78, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(78, 79, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(79, 80, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(80, 81, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(81, 82, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(82, 83, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(83, 84, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(84, 85, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(85, 86, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(86, 87, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(87, 88, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(88, 89, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(89, 90, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(90, 91, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(91, 92, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(92, 93, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(93, 94, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(94, 95, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(95, 96, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(96, 97, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(97, 98, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(98, 99, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(99, 100, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(100, 101, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(101, 102, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(102, 103, '15000.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `fund_transaction`
--

CREATE TABLE IF NOT EXISTS `fund_transaction` (
`fund_transaction_id` int(10) unsigned NOT NULL,
  `account_id_credit` int(10) unsigned NOT NULL,
  `account_id_debit` int(10) unsigned NOT NULL,
  `fund_transaction_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fund_transaction_amount` decimal(11,2) unsigned NOT NULL,
  `fund_trans_charge_id` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fund_transaction`
--

INSERT INTO `fund_transaction` (`fund_transaction_id`, `account_id_credit`, `account_id_debit`, `fund_transaction_date`, `fund_transaction_amount`, `fund_trans_charge_id`) VALUES
(1, 6, 5, '2010-10-31 11:13:44', '500.00', 0),
(2, 6, 5, '2010-10-31 11:51:08', '600.00', 0),
(3, 6, 5, '2010-10-31 11:52:08', '600.00', 0),
(4, 6, 7, '2010-11-18 17:53:54', '5800.00', 0),
(5, 6, 8, '2010-11-19 02:46:19', '3000.00', 0),
(6, 6, 10, '2011-02-14 08:15:25', '500.00', 0),
(7, 20, 21, '2017-08-02 08:28:30', '100.00', 0),
(8, 18, 20, '2017-09-15 15:26:19', '5000.00', 0),
(9, 20, 18, '2017-09-15 15:33:35', '100.00', 0),
(10, 18, 20, '2017-09-20 12:16:43', '1000.00', 0),
(11, 20, 18, '2017-09-24 20:08:10', '1000.00', 0),
(12, 18, 24, '2017-09-24 20:21:32', '1000.00', 0),
(13, 20, 24, '2017-09-24 21:11:16', '100.00', 0),
(14, 24, 20, '2017-09-30 05:54:43', '10.00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `fund_trans_charges`
--

CREATE TABLE IF NOT EXISTS `fund_trans_charges` (
`fund_trans_charge_id` int(10) unsigned NOT NULL,
  `trans_id` int(10) unsigned NOT NULL,
  `account_id` int(10) unsigned NOT NULL,
  `fund_trans_charge_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fund_trans_charge_amount` decimal(11,2) unsigned NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fund_trans_charges`
--

INSERT INTO `fund_trans_charges` (`fund_trans_charge_id`, `trans_id`, `account_id`, `fund_trans_charge_date`, `fund_trans_charge_amount`) VALUES
(1, 1, 6, '2010-10-31 11:13:44', '50.00'),
(2, 3, 6, '2010-10-31 11:52:08', '50.00'),
(3, 4, 6, '2010-11-18 17:53:54', '75.00'),
(4, 5, 6, '2010-11-19 02:46:19', '75.00'),
(5, 6, 6, '2011-02-14 08:15:25', '75.00'),
(6, 7, 20, '2017-08-02 08:28:30', '75.00'),
(7, 8, 18, '2017-09-15 15:26:19', '75.00'),
(8, 9, 20, '2017-09-15 15:33:35', '75.00'),
(9, 10, 18, '2017-09-20 12:16:43', '75.00'),
(10, 11, 20, '2017-09-24 20:08:10', '75.00'),
(11, 12, 18, '2017-09-24 20:21:32', '75.00'),
(12, 13, 20, '2017-09-24 21:11:16', '75.00');

-- --------------------------------------------------------

--
-- Table structure for table `kin`
--

CREATE TABLE IF NOT EXISTS `kin` (
`kin_id` int(10) unsigned NOT NULL,
  `member_id` int(10) unsigned NOT NULL,
  `kin_relation` varchar(48) NOT NULL,
  `kin_name` varchar(48) NOT NULL,
  `kin_phone` varchar(15) NOT NULL,
  `kin_address` varchar(128) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kin`
--

INSERT INTO `kin` (`kin_id`, `member_id`, `kin_relation`, `kin_name`, `kin_phone`, `kin_address`) VALUES
(3, 18, 'sister', 'Faith', '0715573466', 'p.o box 171,\r\nEldama Ravine'),
(4, 19, 'Father', 'Jackson Manadgo', '07263895', 'Nakuru'),
(5, 19, 'Mother', 'Jane kuria', '0729268965', 'Nyeri');

-- --------------------------------------------------------

--
-- Table structure for table `loan`
--

CREATE TABLE IF NOT EXISTS `loan` (
`loan_id` int(11) NOT NULL,
  `member_id` int(10) unsigned NOT NULL,
  `loan_type_id` int(10) unsigned NOT NULL,
  `loan_amount` decimal(11,2) unsigned NOT NULL,
  `loan_payment_months` tinyint(3) unsigned NOT NULL,
  `loan_interest` int(2) unsigned NOT NULL,
  `loan_approved` tinyint(1) NOT NULL,
  `loan_final_payment` decimal(11,2) unsigned NOT NULL,
  `loan_monthly_payment` decimal(11,2) unsigned NOT NULL,
  `loan_payment_completed` tinyint(1) NOT NULL,
  `loan_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loan`
--

INSERT INTO `loan` (`loan_id`, `member_id`, `loan_type_id`, `loan_amount`, `loan_payment_months`, `loan_interest`, `loan_approved`, `loan_final_payment`, `loan_monthly_payment`, `loan_payment_completed`, `loan_time`) VALUES
(21, 7, 1, '100.00', 5, 10, 1, '102.50', '20.50', 0, '2011-02-22 13:01:35'),
(33, 7, 3, '5432.00', 8, 25, 1, '5953.52', '744.19', 0, '2011-03-01 10:04:03'),
(19, 7, 3, '15000.00', 15, 10, 0, '16019.40', '1067.96', 0, '2011-02-22 13:01:35'),
(18, 7, 2, '7777.00', 10, 10, 1, '8137.90', '813.79', 0, '2011-02-22 13:01:35'),
(34, 7, 3, '5001.00', 7, 25, 1, '5426.33', '775.19', 0, '2011-03-01 19:00:26'),
(35, 19, 1, '6000.00', 6, 7, 1, '6123.12', '1020.52', 0, '2017-09-24 20:49:08'),
(36, 26, 1, '7000.00', 6, 7, 1, '7143.60', '1190.60', 0, '2017-09-25 05:31:20'),
(38, 19, 1, '6000.00', 7, 7, 1, '6140.82', '877.26', 0, '2017-09-25 09:23:43'),
(39, 27, 1, '8000.00', 8, 7, 1, '8211.44', '1026.43', 0, '2017-09-25 09:25:17');

-- --------------------------------------------------------

--
-- Table structure for table `loan_payment`
--

CREATE TABLE IF NOT EXISTS `loan_payment` (
`loan_payment_id` int(10) unsigned NOT NULL,
  `loan_id` int(10) unsigned NOT NULL,
  `loan_payment_amount` decimal(11,2) unsigned NOT NULL,
  `loan_balance` decimal(11,2) NOT NULL,
  `loan_payment_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loan_payment`
--

INSERT INTO `loan_payment` (`loan_payment_id`, `loan_id`, `loan_payment_amount`, `loan_balance`, `loan_payment_date`) VALUES
(1, 18, '100.00', '8037.90', '2010-12-20 10:09:04'),
(2, 18, '200.00', '7837.90', '2010-12-20 10:13:50'),
(3, 33, '600.00', '5353.52', '2011-03-01 18:59:56'),
(4, 34, '230.00', '5196.33', '2011-03-01 19:01:59'),
(5, 34, '789.00', '4407.33', '2011-03-01 19:02:12'),
(6, 35, '100.00', '6023.12', '2017-09-24 20:49:56'),
(7, 35, '100.00', '5923.12', '2017-09-24 20:51:54');

-- --------------------------------------------------------

--
-- Table structure for table `loan_types`
--

CREATE TABLE IF NOT EXISTS `loan_types` (
`loan_type_id` int(10) unsigned NOT NULL,
  `loan_type_name` varchar(256) NOT NULL,
  `loan_type_min_months` tinyint(3) unsigned NOT NULL,
  `loan_type_max_months` tinyint(3) unsigned NOT NULL,
  `loan_type_min_amount` decimal(11,2) unsigned NOT NULL,
  `loan_type_max_amount` decimal(11,2) unsigned NOT NULL,
  `loan_type_share_threshold` decimal(11,2) unsigned NOT NULL,
  `loan_type_fund_threshold` decimal(11,2) unsigned NOT NULL,
  `loan_type_account_age_threshold` smallint(5) unsigned NOT NULL,
  `loan_type_interest` decimal(5,2) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loan_types`
--

INSERT INTO `loan_types` (`loan_type_id`, `loan_type_name`, `loan_type_min_months`, `loan_type_max_months`, `loan_type_min_amount`, `loan_type_max_amount`, `loan_type_share_threshold`, `loan_type_fund_threshold`, `loan_type_account_age_threshold`, `loan_type_interest`) VALUES
(1, 'Anzisha Loan', 5, 25, '5001.00', '10000.00', '1.00', '1000.00', 2, '7.00'),
(2, 'Wezesha Loan', 5, 25, '10001.00', '25000.00', '1000.00', '15000.00', 5, '10.00'),
(3, 'Jenga', 5, 25, '25001.00', '50000.00', '10000.00', '35000.00', 10, '13.00');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE IF NOT EXISTS `member` (
`member_id` int(10) unsigned NOT NULL,
  `member_national_id` char(10) NOT NULL,
  `member_work_id` varchar(12) NOT NULL,
  `member_name` varchar(48) NOT NULL,
  `member_password` char(32) NOT NULL,
  `share_transaction_id` int(11) unsigned NOT NULL,
  `fund_transaction_id` int(11) unsigned NOT NULL,
  `share_sale_id` int(10) unsigned NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_login` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_activity` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `session_time` int(11) NOT NULL,
  `member_active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM AUTO_INCREMENT=105 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`member_id`, `member_national_id`, `member_work_id`, `member_name`, `member_password`, `share_transaction_id`, `fund_transaction_id`, `share_sale_id`, `reg_date`, `last_login`, `last_activity`, `session_time`, `member_active`) VALUES
(20, '0000001', '001', 'Joseph', '8e0afbb78a344c39e7c400f26bb40a51', 0, 0, 0, '2017-07-10 20:43:37', '2017-07-10 20:43:37', '2017-07-10 20:43:37', 3, 0),
(19, '25937139', '100', 'KITUR', '8e0afbb78a344c39e7c400f26bb40a51', 0, 12, 10, '2014-04-23 03:54:02', '2017-11-20 17:33:56', '2017-11-20 17:37:03', 15, 1),
(21, '32627326', '10', 'Joseph Kariba', '8e0afbb78a344c39e7c400f26bb40a51', 0, 14, 10, '2017-07-25 07:54:54', '2017-11-20 17:37:12', '2017-11-20 17:40:36', 10, 1),
(22, '32726912', '4677', 'Wilson', 'e10adc3949ba59abbe56e057f20f883e', 0, 7, 0, '2017-07-29 22:06:26', '2017-07-29 22:06:26', '2017-07-29 22:06:26', 3, 1),
(23, '52654936', '4862', 'Makanga', 'e10adc3949ba59abbe56e057f20f883e', 0, 0, 0, '2017-07-29 22:08:26', '2017-07-29 22:57:43', '2017-07-31 06:57:01', 3, 1),
(26, '2125544', '022', 'Wilson Kamau', '8e0afbb78a344c39e7c400f26bb40a51', 0, 0, 0, '2017-09-25 05:24:35', '2017-09-25 05:27:00', '2017-09-25 06:11:08', 3, 1),
(25, '325554', '0111', 'john Kamau', '8e0afbb78a344c39e7c400f26bb40a51', 0, 14, 0, '2017-09-24 19:30:01', '2017-09-30 05:52:49', '2017-10-01 16:17:07', 50, 1),
(27, '1212555', '00002', 'Fiona princess', '8e0afbb78a344c39e7c400f26bb40a51', 0, 0, 0, '2017-09-25 07:47:01', '2017-11-20 17:14:25', '2017-11-20 17:18:46', 3, 1),
(28, '26596558', '00000', 'Faith Wanjala', '8e0afbb78a344c39e7c400f26bb40a51', 0, 0, 0, '2017-09-25 19:30:29', '2017-09-25 19:30:29', '2017-09-25 19:30:29', 3, 1),
(29, '000000', '0002', 'Wilfred Thuku', '8e0afbb78a344c39e7c400f26bb40a51', 0, 0, 0, '2017-10-04 07:57:47', '2017-10-14 08:41:19', '2017-10-14 08:49:16', 3, 1),
(30, '22556647', '88888', 'Micheal Abandu', '8e0afbb78a344c39e7c400f26bb40a51', 0, 0, 0, '2017-10-15 15:58:25', '2017-10-15 15:59:07', '2017-10-15 15:59:12', 3, 1),
(100, '64454464', '56346', 'john mumo', '8e0afbb78a344c39e7c400f26bb40a51', 0, 0, 0, '2017-11-19 16:12:08', '2017-11-19 16:12:08', '2017-11-19 16:12:08', 3, 0),
(101, '4446446', '46446', 'Francis kimemia', '8e0afbb78a344c39e7c400f26bb40a51', 0, 0, 0, '2017-11-19 16:28:27', '2017-11-19 16:28:27', '2017-11-19 16:28:27', 3, 0),
(102, '47485475', '65556', 'Sifuna mkombozi', '8e0afbb78a344c39e7c400f26bb40a51', 0, 0, 0, '2017-11-20 15:49:37', '2017-11-20 15:49:37', '2017-11-20 15:49:37', 3, 1),
(103, '79899797', '65654', 'Chales Kamau', '8e0afbb78a344c39e7c400f26bb40a51', 0, 0, 0, '2017-11-20 16:23:53', '2017-11-20 17:40:43', '2017-11-20 17:41:14', 3, 1),
(104, '45464668', '55464', 'Rachal Shebesh', '8e0afbb78a344c39e7c400f26bb40a51', 0, 0, 0, '2017-11-20 17:42:01', '2017-11-20 17:42:43', '2017-11-20 17:43:33', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `member_query`
--

CREATE TABLE IF NOT EXISTS `member_query` (
`member_query_id` int(10) unsigned NOT NULL,
  `member_id` int(10) unsigned NOT NULL,
  `member_query_name` varchar(64) NOT NULL,
  `member_query_email` varchar(128) NOT NULL,
  `member_query_msg` varchar(2048) NOT NULL,
  `member_query_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `member_query_read` tinyint(1) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `member_query`
--

INSERT INTO `member_query` (`member_query_id`, `member_id`, `member_query_name`, `member_query_email`, `member_query_msg`, `member_query_time`, `member_query_read`) VALUES
(8, 7, 'Arthur Omuombo', '', 'bla bnla bkamjlksad', '2011-03-08 16:12:42', 1),
(2, 0, '0', '', 'abcdefgabcdefg', '0000-00-00 00:00:00', 1),
(3, 0, '0', 'kk@mail.cim', '123abcdefg456', '0000-00-00 00:00:00', 1),
(4, 0, '0', 'kk@mail.cim', '123abcdefg456', '0000-00-00 00:00:00', 1),
(7, 0, 'eve', '', 'how are you', '0000-00-00 00:00:00', 1),
(6, 7, 'Arthur Atha', '', 'hallloooo', '0000-00-00 00:00:00', 1),
(10, 7, 'Arthur Omuombo', '', 'jkqhjhaqzaqzaq', '2011-03-11 09:24:30', 1),
(11, 0, '', '', '', '2017-07-10 20:36:58', 1),
(12, 0, 'Jane', 'janeuser@yahoo.com', 'I like your Application!', '2017-07-29 22:46:02', 1),
(13, 21, 'Test user', '', 'test', '2017-09-15 15:31:37', 1),
(14, 21, 'Joseph Kariba', '', 'test message', '2017-09-24 20:03:10', 1);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
`news_id` tinyint(3) unsigned NOT NULL,
  `news_title` varchar(48) NOT NULL,
  `news_url_title` varchar(64) NOT NULL,
  `news_desc` varchar(255) NOT NULL,
  `news_date` datetime NOT NULL,
  `news_content` varchar(5000) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`news_id`, `news_title`, `news_url_title`, `news_desc`, `news_date`, `news_content`) VALUES
(10, 'Meeting!', 'Meeting!', 'Meeting on 29/10/2017', '2010-11-19 00:00:00', '<p><span style="color: #ff0000;"><strong><span style="font-size: medium;">All members are notified that will have a meeting on the 29th of October 2017</span></strong></span></p>\r\n<p><span style="color: #000000; font-size: small;">If this is your first visit, be sure to 		check out the <a href="http://forums.archeagegame.com/faq.php?s=da000ea56ae58023a400b8f68bb804af" target="_blank">FAQ</a> by clicking the 		link above. You may have to <a href="http://forums.archeagegame.com/register.php?s=da000ea56ae58023a400b8f68bb804af" target="_blank">register</a> before you can post: click the register link above to proceed. To start viewing messages, 		select the forum that you want to visit from the selection below.If this is your first visit, be sure to 		check out the <a href="http://forums.archeagegame.com/faq.php?s=da000ea56ae58023a400b8f68bb804af" target="_blank">FAQ</a> by clicking the 		link above. You may have to <a href="http://forums.archeagegame.com/register.php?s=da000ea56ae58023a400b8f68bb804af" target="_blank">register</a> before you can post: click the register link above to proceed. To start viewing messages, 		select the forum that you want to visit from the selection below.If this is your first visit, be sure to 		check out the <a href="http://forums.archeagegame.com/faq.php?s=da000ea56ae58023a400b8f68bb804af" target="_blank">FAQ</a> by clicking the 		link above. You may have to <a href="http://forums.archeagegame.com/register.php?s=da000ea56ae58023a400b8f68bb804af" target="_blank">register</a> before you can post: click the register link above to proceed. To start viewing messages, 		select the forum that you want to visit from the selection below.If this is your first visit, be sure to 		check out the <a href="http://forums.archeagegame.com/faq.php?s=da000ea56ae58023a400b8f68bb804af" target="_blank">FAQ</a> by clicking the 		link above. You may have to <a href="http://forums.archeagegame.com/register.php?s=da000ea56ae58023a400b8f68bb804af" target="_blank">register</a> before you can post: click the register link above to proceed. To start viewing messages, 		select the forum that you want to visit from the selection below.</span></p>'),
(11, 'New Member', 'New_Member', 'New member application', '2011-03-18 00:00:00', '<p>simon ngodi diff was alegedly spotted studying... thats rightr, studying, here in KU, earlier today...</p>\r\n<p>&nbsp;</p>\r\n<p>will bring you news as we receive it</p>'),
(12, 'Next dividents payout ', 'Next_dividents_payout_', 'If this is your first visit, be sure to check out the FAQ by clicking the link above. You may have to register before you can post: click the register link above to proceed. To start viewing messages, select the forum that you want to visit from the selec', '2017-09-15 00:00:00', '<p>If this is your first visit, be sure to 		check out the <a href="http://forums.archeagegame.com/faq.php?s=da000ea56ae58023a400b8f68bb804af" target="_blank"><strong>FAQ</strong></a> by clicking the 		link above. You may have to <a href="http://forums.archeagegame.com/register.php?s=da000ea56ae58023a400b8f68bb804af" target="_blank"><strong>register</strong></a> before you can post: click the register link above to proceed. To start viewing messages, 		select the forum that you want to visit from the selection below.</p>'),
(13, 'New member application', 'New_member_application', 'If this is your first visit, be sure to check out the FAQ by clicking the link above. You may have to register before you can post: click the register link above to proceed. To start viewing messages, select the forum that you want to visit from the selec', '2017-09-15 00:00:00', '<p>If this is your first visit, be sure to 		check out the <a href="http://forums.archeagegame.com/faq.php?s=da000ea56ae58023a400b8f68bb804af" target="_blank"><strong>FAQ</strong></a> by clicking the 		link above. You may have to <a href="http://forums.archeagegame.com/register.php?s=da000ea56ae58023a400b8f68bb804af" target="_blank"><strong>register</strong></a> before you can post: click the register link above to proceed. To start viewing messages, 		select the forum that you want to visit from the selection below.If this is your first visit, be sure to 		check out the <a href="http://forums.archeagegame.com/faq.php?s=da000ea56ae58023a400b8f68bb804af" target="_blank"><strong>FAQ</strong></a> by clicking the 		link above. You may have to <a href="http://forums.archeagegame.com/register.php?s=da000ea56ae58023a400b8f68bb804af" target="_blank"><strong>register</strong></a> before you can post: click the register link above to proceed. To start viewing messages, 		select the forum that you want to visit from the selection below.If this is your first visit, be sure to 		check out the <a href="http://forums.archeagegame.com/faq.php?s=da000ea56ae58023a400b8f68bb804af" target="_blank"><strong>FAQ</strong></a> by clicking the 		link above. You may have to <a href="http://forums.archeagegame.com/register.php?s=da000ea56ae58023a400b8f68bb804af" target="_blank"><strong>register</strong></a> before you can post: click the register link above to proceed. To start viewing messages, 		select the forum that you want to visit from the selection below.If this is your first visit, be sure to 		check out the <a href="http://forums.archeagegame.com/faq.php?s=da000ea56ae58023a400b8f68bb804af" target="_blank"><strong>FAQ</strong></a> by clicking the 		link above. You may have to <a href="http://forums.archeagegame.com/register.php?s=da000ea56ae58023a400b8f68bb804af" target="_blank"><strong>register</strong></a> before you can post: click the register link above to proceed. To start viewing messages, 		select the forum that you want to visit from the selection below.</p>');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
`page_id` tinyint(3) unsigned NOT NULL,
  `page_title` varchar(48) NOT NULL,
  `page_url_title` varchar(64) NOT NULL,
  `page_desc` varchar(255) NOT NULL,
  `page_content` varchar(5000) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`page_id`, `page_title`, `page_url_title`, `page_desc`, `page_content`) VALUES
(3, 'Home', 'Home', 'Welcome to Online chama', '<h1 style="color: #ff0000;"><span style="color: #008000;"><strong>Welcome to Online chama management system</strong></span></h1>\r\n<p><sup> </sup></p>\r\n<p><sup><span style="font-size: small;">It is with great pleasure that Online chama avails to you most services that are common in the conventional chamas where mebers meet face-to-face to carry out their business.With the increased use of the internet, Online Chama connect which allows each member of the chama to undertake their tasks which are not critical(Do not need a physical visit to our premises) online and thus saving them time and also allows them to carry out transactions at anytime and at any place of their convenience when needed. All a member needs is just an internet connection.</span></sup></p>\r\n<p><span style="font-size: small;"><br /></span></p>\r\n<p><span style="font-size: small;"><img src="003.jpg" alt="" /><br /> <!--?php echo"Hello" ?--> </span></p>'),
(4, 'About us', 'About_us', 'About Online chama', '<p>&nbsp;</p><p>Online chama is a an application solution designed to automate the operations of conventional Chamas where members meet face-to-face to transact their business.</p><p>Area of Operation - the Republic of Kenya, specifically Nyeri County, Kimathi.</p>'),
(5, 'Services', 'Services', 'Our services, here at Online chama', '<h1>The services offered by this platform include:</h1>\r\n<p><strong>Chama Loan services for members<br /></strong></p>\r\n<p>a. Standard Loan &ndash; Repayable in 60 Months. Interest 12% p.a.</p>\r\n<p>b. School Fees Loan - Repayable in 12 Months. On Decreasing Balance</p>\r\n<p>c. Emergency Loan - Repayable in 12 Months. ( = 6.5 % P.A)</p>\r\n<p>d. Refinance (Top up) - Additional Loan with 1.5% Interest on Reducing Balance where 0.5% is deducted upfront.</p>\r\n<p>e. Chama Quick Loan - Repayable in 60 Months. Interest 1.25% p.m. on ReducingBalance but 0.25% is paid instantly from the Loan Approved.</p>\r\n<p>f. Services &ndash; Credit Advisory, Conference hall Facilities, Chairs and Public Address Systems for Hire.</p>\r\n<p><strong>Account management</strong></p>\r\n<ul style="list-style-type: disc;">\r\n<li><strong>&nbsp;Funds transfer</strong></li>\r\n</ul>\r\n<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &gt;&gt;Saving remitance</p>\r\n<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &gt;&gt;Loan remitance</p>\r\n<ul style="list-style-type: disc;">\r\n<li><strong>&nbsp;Share transfer</strong></li>\r\n</ul>\r\n<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &gt;&gt;Buying of shares</p>\r\n<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &gt;&gt;Selling of shares</p>\r\n<ul>\r\n<li><strong>Chat communication</strong></li>\r\n<li><strong>Simple solution.</strong></li>\r\n</ul>'),
(6, 'contact us', 'contact_us', 'Our contacts, addresses and office location', '<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;<strong>Physical Address:</strong></p>\r\n<p style="text-align: left;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ONLINA CHAMA &copy; ,</p>\r\n<p style="text-align: left;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Gathii House,next to KRA building.</p>\r\n<p style="text-align: left;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; P.O. Box: 924,Nyeri.</p>\r\n<p style="text-align: left;"><strong>&nbsp; Email Address</strong>:</p>\r\n<p style="text-align: left;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; info@onlinechama.co.ke - Head Office</p>\r\n<p style="text-align: left;"><strong>Tel:</strong> +254 (20)8024 800 , Mobile:- +254(714) - 757 510 , (734) 547 678</p>\r\n<p style="text-align: left;">The Members/clients can communicate to the Society through the following official e-mail addresses;</p>\r\n<p style="text-align: left;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 1. info@onlinechama.co.ke - Head Office</p>\r\n<p style="text-align: left;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 2. admin@onlinechama.co.ke -ICT Department</p>'),
(7, 'Site Map', 'Site_Map', 'Online chama site map', '<ul><li><a href="http://www.bartesacco.com/index.php/home">Home</a> </li><li><a href="http://www.bartesacco.com/index.php/about-us">About Us</a> <ul><li><a href="http://www.bartesacco.com/index.php/about-us/company-profile">Company Profile</a> </li><li><a href="http://www.bartesacco.com/index.php/about-us/our-team">Our Team</a> </li><li><a href="http://www.bartesacco.com/index.php/about-us/departments">Departments</a> </li></ul></li><li><a href="http://www.bartesacco.com/index.php/products-and-services">Products and Services</a> <ul><li><a href="http://www.bartesacco.com/index.php/products-and-services/overview">Overview</a> </li><li><a href="http://www.bartesacco.com/index.php/products-and-services/sacco">COSA Services</a> </li><li><a href="http://www.bartesacco.com/index.php/products-and-services/fosa">FOSA Services</a> </li><li><a href="http://www.bartesacco.com/index.php/products-and-services/investments">Investments</a> </li></ul></li><li><a href="http://www.bartesacco.com/index.php/members-a-stakeholders">Members &amp; Stakeholders</a> <ul><li><a href="http://www.bartesacco.com/index.php/members-a-stakeholders/membership">Membership</a> </li><li><a href="http://www.bartesacco.com/index.php/members-a-stakeholders/partner-a-stakeholder-information">Partner &amp; Stakeholder Information</a> </li><li><a href="http://www.bartesacco.com/index.php/members-a-stakeholders/how-to-become-a-member">How to become a Member</a> </li></ul></li><li><a href="http://www.bartesacco.com/index.php/media-center">Media Center</a> <ul><li><a href="http://www.bartesacco.com/index.php/media-center/news-a-events">News &amp; Events</a> </li><li><a href="http://www.bartesacco.com/index.php/media-center/sacco-reports">Sacco Reports</a> </li><li><a href="http://www.bartesacco.com/index.php/media-center/photo-gallery">Photo Gallery</a> </li><li><a href="http://www.bartesacco.com/index.php/media-center/faqs">FAQ''s</a> </li></ul></li><li><a href="http://www.bartesacco.com/index.php/downloads">Downloads</a> </li><li><a href="http://www.bartesacco.com/index.php/contact-us">Contact Us</a> <ul><li><a href="http://www.afyasacco.com/index.php/contact-us/members-feedback">Office Address</a> </li><li><a href="http://www.bartesacco.com/index.php/contact-us/fosa-branches">FOSA Branches</a> </li><li><a href="http://www.bartesacco.com/index.php/contact-us/members-feedback-form">Members Feedback Form</a> </li></ul></li></ul>');

-- --------------------------------------------------------

--
-- Table structure for table `phone`
--

CREATE TABLE IF NOT EXISTS `phone` (
`phone_id` int(10) unsigned NOT NULL,
  `member_id` int(10) unsigned NOT NULL,
  `phone_front_name` varchar(24) NOT NULL,
  `phone_detail` varchar(15) NOT NULL,
  `public` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM AUTO_INCREMENT=108 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `phone`
--

INSERT INTO `phone` (`phone_id`, `member_id`, `phone_front_name`, `phone_detail`, `public`) VALUES
(21, 18, 'Primary Phone', '0714757510', 1),
(22, 19, 'Primary Phone', '0726857101', 1),
(23, 20, 'Primary Phone', '0700000000', 1),
(24, 21, 'Primary Phone', '0729263839', 1),
(25, 22, 'Primary Phone', '0723023949', 1),
(31, 28, 'Primary Phone', '0766565632', 1),
(32, 29, 'Primary Phone', '0729263692', 1),
(33, 30, 'Primary Phone', '0729265689', 1),
(104, 101, 'Primary Phone', '0734172718', 1),
(105, 102, 'Primary Phone', '0734172711', 1),
(106, 103, 'Primary Phone', '0729263868', 1),
(107, 104, 'Primary Phone', '0723569821', 1);

-- --------------------------------------------------------

--
-- Table structure for table `phyaddress`
--

CREATE TABLE IF NOT EXISTS `phyaddress` (
`phyAddress_id` int(10) unsigned NOT NULL,
  `member_id` int(10) unsigned NOT NULL,
  `phyAddress_front_name` varchar(24) NOT NULL,
  `phyAddress_detail` varchar(64) NOT NULL,
  `phyAddress_city` varchar(48) NOT NULL,
  `country_id` smallint(5) unsigned NOT NULL,
  `public` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `phyaddress`
--

INSERT INTO `phyaddress` (`phyAddress_id`, `member_id`, `phyAddress_front_name`, `phyAddress_detail`, `phyAddress_city`, `country_id`, `public`) VALUES
(5, 18, 'Permanent Address', 'p.o box 924,\r\n', 'Mweiga', 111, 1),
(3, 7, 'Alternative', 'akila 2, hs A11', 'Nyeri', 111, 0);

-- --------------------------------------------------------

--
-- Table structure for table `postal`
--

CREATE TABLE IF NOT EXISTS `postal` (
`postal_id` int(10) unsigned NOT NULL,
  `member_id` int(10) unsigned NOT NULL,
  `postal_front_name` varchar(24) NOT NULL,
  `postal_detail` varchar(64) NOT NULL,
  `postal_code` varchar(24) NOT NULL,
  `postal_city` varchar(48) NOT NULL,
  `country_id` smallint(5) unsigned NOT NULL,
  `public` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `postal`
--

INSERT INTO `postal` (`postal_id`, `member_id`, `postal_front_name`, `postal_detail`, `postal_code`, `postal_city`, `country_id`, `public`) VALUES
(5, 7, 'nairobi address', 'p.o. box 123', '0100', 'nairobi', 111, 0);

-- --------------------------------------------------------

--
-- Table structure for table `share_account`
--

CREATE TABLE IF NOT EXISTS `share_account` (
`share_account_id` int(10) unsigned NOT NULL,
  `member_id` int(10) unsigned NOT NULL,
  `share_account_debit` decimal(11,2) unsigned NOT NULL,
  `share_account_credit` decimal(11,2) unsigned NOT NULL,
  `share_account_active` tinyint(1) NOT NULL DEFAULT '1',
  `share_account_period_credit_count` smallint(5) unsigned NOT NULL,
  `share_account_period_debit_count` smallint(5) unsigned NOT NULL,
  `share_account_period_debit_amount` decimal(10,2) unsigned NOT NULL,
  `share_account_period_credit_amount` decimal(10,2) unsigned NOT NULL,
  `share_account_period_day_count` tinyint(3) unsigned NOT NULL,
  `share_account_period_reset_date` datetime NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=104 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `share_account`
--

INSERT INTO `share_account` (`share_account_id`, `member_id`, `share_account_debit`, `share_account_credit`, `share_account_active`, `share_account_period_credit_count`, `share_account_period_debit_count`, `share_account_period_debit_amount`, `share_account_period_credit_amount`, `share_account_period_day_count`, `share_account_period_reset_date`) VALUES
(1, 2, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(2, 3, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(17, 19, '2571.00', '30.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(24, 25, '110.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(19, 20, '10.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(20, 21, '450.00', '30.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(21, 22, '20.00', '30.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(22, 23, '30.00', '20.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(25, 26, '1000.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(26, 27, '1200.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(27, 28, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(28, 29, '1100.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(29, 30, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(30, 31, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(31, 32, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(32, 33, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(33, 34, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(34, 35, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(35, 36, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(36, 37, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(37, 38, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(38, 39, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(39, 40, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(40, 41, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(41, 42, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(42, 43, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(43, 44, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(44, 45, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(45, 46, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(46, 47, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(47, 48, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(48, 49, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(49, 50, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(50, 51, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(51, 52, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(52, 53, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(53, 54, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(54, 55, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(55, 56, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(56, 57, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(57, 58, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(58, 59, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(59, 60, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(60, 61, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(61, 62, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(62, 63, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(63, 64, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(64, 65, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(65, 66, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(66, 67, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(67, 68, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(68, 69, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(69, 70, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(70, 71, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(71, 72, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(72, 73, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(73, 74, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(74, 75, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(75, 76, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(76, 77, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(77, 78, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(78, 79, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(79, 80, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(80, 81, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(81, 82, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(82, 83, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(83, 84, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(84, 85, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(85, 86, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(86, 87, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(87, 88, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(88, 89, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(89, 90, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(90, 91, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(91, 92, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(92, 93, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(93, 94, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(94, 95, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(95, 96, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(96, 97, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(97, 98, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(98, 99, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(99, 100, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(100, 101, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(101, 102, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(102, 103, '20.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00'),
(103, 104, '0.00', '0.00', 1, 0, 0, '0.00', '0.00', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `share_purchase`
--

CREATE TABLE IF NOT EXISTS `share_purchase` (
`share_purchase_id` int(10) unsigned NOT NULL,
  `member_id` int(10) unsigned NOT NULL,
  `share_purchase_amount` int(10) unsigned NOT NULL,
  `share_purchase_value_per_share` decimal(11,2) unsigned NOT NULL,
  `share_purchase_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `share_purchase`
--

INSERT INTO `share_purchase` (`share_purchase_id`, `member_id`, `share_purchase_amount`, `share_purchase_value_per_share`, `share_purchase_date`) VALUES
(1, 7, 1, '5.00', '2011-01-15 07:22:31'),
(2, 6, 6, '2.00', '2011-01-15 07:48:43'),
(3, 7, 5, '2.00', '2011-01-15 08:00:02'),
(4, 7, 5, '2.00', '2011-01-15 08:00:13'),
(5, 7, 50, '3.00', '2011-03-03 13:56:30'),
(6, 21, 10, '3.00', '2017-08-02 08:21:06'),
(7, 21, 10, '3.00', '2017-08-02 08:21:08'),
(8, 21, 10, '3.00', '2017-09-15 15:11:17'),
(9, 19, 20, '3.00', '2017-09-15 15:20:42'),
(10, 19, 10, '3.00', '2017-09-15 15:34:37'),
(11, 26, 1000, '3.00', '2017-09-25 05:28:40'),
(12, 19, 1, '3.00', '2017-09-25 20:18:02'),
(13, 19, 10, '3.00', '2017-09-25 20:18:04'),
(14, 19, 10, '3.00', '2017-09-25 20:18:05'),
(15, 19, 10, '3.00', '2017-09-25 20:18:06'),
(16, 19, 10, '3.00', '2017-09-25 20:18:32'),
(17, 25, 100, '3.00', '2017-09-30 05:55:36');

-- --------------------------------------------------------

--
-- Table structure for table `share_sale_transaction`
--

CREATE TABLE IF NOT EXISTS `share_sale_transaction` (
`share_transaction_id` int(10) unsigned NOT NULL,
  `account_id_credit` int(10) unsigned NOT NULL,
  `account_id_debit` int(10) unsigned NOT NULL,
  `share_transaction_request_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `share_transaction_approved_date` datetime NOT NULL,
  `share_transaction_amount` decimal(11,2) unsigned NOT NULL,
  `share_value` decimal(11,2) unsigned NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `share_sale_transaction`
--

INSERT INTO `share_sale_transaction` (`share_transaction_id`, `account_id_credit`, `account_id_debit`, `share_transaction_request_date`, `share_transaction_approved_date`, `share_transaction_amount`, `share_value`) VALUES
(8, 6, 8, '2010-11-19 02:43:39', '2010-11-19 03:21:07', '300.00', '20.00'),
(9, 6, 8, '2010-11-19 03:35:26', '2010-11-19 03:36:15', '200.00', '10.00'),
(10, 17, 20, '2017-09-15 15:23:42', '2017-09-15 18:24:02', '30.00', '3.00');

-- --------------------------------------------------------

--
-- Table structure for table `share_sale_trans_charges`
--

CREATE TABLE IF NOT EXISTS `share_sale_trans_charges` (
`share_trans_charge_id` int(10) unsigned NOT NULL,
  `trans_id` int(10) unsigned NOT NULL,
  `account_id` int(10) unsigned NOT NULL,
  `share_trans_charge_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `share_trans_charge_amount` decimal(11,2) unsigned NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `share_sale_trans_charges`
--

INSERT INTO `share_sale_trans_charges` (`share_trans_charge_id`, `trans_id`, `account_id`, `share_trans_charge_date`, `share_trans_charge_amount`) VALUES
(6, 13, 6, '2010-11-19 02:43:39', '35.00'),
(7, 14, 6, '2010-11-19 03:35:26', '35.00'),
(8, 14, 20, '2017-08-02 08:25:47', '35.00'),
(9, 15, 20, '2017-09-15 15:07:35', '35.00'),
(10, 16, 18, '2017-09-15 15:23:42', '35.00'),
(11, 17, 18, '2017-09-20 12:15:17', '35.00');

-- --------------------------------------------------------

--
-- Table structure for table `share_transaction`
--

CREATE TABLE IF NOT EXISTS `share_transaction` (
`share_transaction_id` int(10) unsigned NOT NULL,
  `account_id_credit` int(10) unsigned NOT NULL,
  `account_id_debit` int(10) unsigned NOT NULL,
  `share_transaction_request_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `share_transaction_approved_date` datetime NOT NULL,
  `share_transaction_amount` decimal(11,2) unsigned NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `share_transaction`
--

INSERT INTO `share_transaction` (`share_transaction_id`, `account_id_credit`, `account_id_debit`, `share_transaction_request_date`, `share_transaction_approved_date`, `share_transaction_amount`) VALUES
(1, 6, 7, '2010-11-19 01:06:30', '2010-11-19 01:06:30', '15.00'),
(2, 6, 7, '2010-11-19 01:06:33', '2010-11-19 01:06:33', '15.00'),
(3, 6, 7, '2010-11-19 01:06:36', '2010-11-19 01:06:36', '15.00'),
(4, 6, 7, '2010-11-18 15:26:17', '2010-11-19 01:07:28', '15.00'),
(5, 6, 7, '2010-11-18 15:26:17', '2010-11-19 01:11:31', '15.00'),
(6, 6, 7, '2010-11-18 15:26:17', '2010-11-19 01:30:26', '15.00'),
(7, 6, 7, '2010-11-18 15:26:58', '2010-11-19 01:30:28', '15.00'),
(8, 6, 10, '2011-02-14 08:16:33', '2011-02-14 11:16:56', '500.00');

-- --------------------------------------------------------

--
-- Table structure for table `share_trans_charges`
--

CREATE TABLE IF NOT EXISTS `share_trans_charges` (
`share_trans_charge_id` int(10) unsigned NOT NULL,
  `trans_id` int(10) unsigned NOT NULL,
  `account_id` int(10) unsigned NOT NULL,
  `share_trans_charge_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `share_trans_charge_amount` decimal(11,2) unsigned NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `share_trans_charges`
--

INSERT INTO `share_trans_charges` (`share_trans_charge_id`, `trans_id`, `account_id`, `share_trans_charge_date`, `share_trans_charge_amount`) VALUES
(5, 12, 6, '2010-11-19 01:39:49', '50.00'),
(6, 13, 6, '2011-02-14 08:16:33', '50.00');

-- --------------------------------------------------------

--
-- Table structure for table `site_configs`
--

CREATE TABLE IF NOT EXISTS `site_configs` (
  `config_name` varchar(64) NOT NULL,
  `config_value` varchar(128) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `site_configs`
--

INSERT INTO `site_configs` (`config_name`, `config_value`) VALUES
('debit_share_trans_charge', '0'),
('share_value', '3'),
('max_phone', '6'),
('max_email', '5'),
('max_physicalAddress', '3'),
('max_postal', '3'),
('max_kin', '8'),
('credit_share_trans_charge', '50'),
('debit_fund_trans_charge', '0'),
('credit_fund_trans_charge', '0'),
('credit_share_sale_charge', '35'),
('debit_share_sale_charge', '0'),
('new_share_balance', '3609'),
('loan_interest_rate', '10'),
('utility_payment_transaction_charge', '10'),
('minimum_inactivity_time', '1'),
('maximum_inactivity_time', '50'),
('site_message', 'Welcome to Online Chama System.<br/><br/>NOTICE TO MEMBERS: DIVIDENDS FOR 2012-2013 HAVE BEEN PAID OUT');

-- --------------------------------------------------------

--
-- Table structure for table `tmp_sale_share_transaction`
--

CREATE TABLE IF NOT EXISTS `tmp_sale_share_transaction` (
`tmp_share_transaction_id` int(10) unsigned NOT NULL,
  `tmp_share_transaction_type` tinyint(3) unsigned NOT NULL,
  `tmp_account_id_credit` int(10) unsigned NOT NULL,
  `tmp_account_id_debit` int(10) unsigned NOT NULL,
  `tmp_share_transaction_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tmp_share_transaction_amount` decimal(11,2) unsigned NOT NULL,
  `tmp_share_value` decimal(11,2) unsigned NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tmp_sale_share_transaction`
--

INSERT INTO `tmp_sale_share_transaction` (`tmp_share_transaction_id`, `tmp_share_transaction_type`, `tmp_account_id_credit`, `tmp_account_id_debit`, `tmp_share_transaction_date`, `tmp_share_transaction_amount`, `tmp_share_value`) VALUES
(13, 0, 6, 8, '2010-11-19 02:43:39', '300.00', '20.00'),
(14, 0, 20, 21, '2017-08-02 08:25:47', '10.00', '3.00'),
(17, 0, 17, 20, '2017-09-20 12:15:17', '100.00', '3.00');

-- --------------------------------------------------------

--
-- Table structure for table `tmp_share_purchase`
--

CREATE TABLE IF NOT EXISTS `tmp_share_purchase` (
`share_purchase_id` int(10) unsigned NOT NULL,
  `member_id` int(10) unsigned NOT NULL,
  `share_purchase_amount` int(10) unsigned NOT NULL,
  `share_purchase_value_per_share` decimal(11,2) unsigned NOT NULL,
  `share_purchase_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tmp_share_purchase`
--

INSERT INTO `tmp_share_purchase` (`share_purchase_id`, `member_id`, `share_purchase_amount`, `share_purchase_value_per_share`, `share_purchase_date`) VALUES
(13, 19, 10, '3.00', '2017-09-25 20:19:46'),
(15, 29, 100, '3.00', '2017-10-04 08:04:15'),
(12, 19, 10, '3.00', '2017-09-25 20:18:41');

-- --------------------------------------------------------

--
-- Table structure for table `tmp_share_transaction`
--

CREATE TABLE IF NOT EXISTS `tmp_share_transaction` (
`tmp_share_transaction_id` int(10) unsigned NOT NULL,
  `tmp_share_transaction_type` tinyint(3) unsigned NOT NULL,
  `tmp_account_id_credit` int(10) unsigned NOT NULL,
  `tmp_account_id_debit` int(10) unsigned NOT NULL,
  `tmp_share_transaction_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tmp_share_transaction_amount` decimal(11,2) unsigned NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `utility`
--

CREATE TABLE IF NOT EXISTS `utility` (
`utility_id` int(10) unsigned NOT NULL,
  `utility_name` varchar(32) NOT NULL,
  `utility_website` varchar(32) NOT NULL,
  `utility_email` varchar(32) NOT NULL,
  `utility_phone` varchar(15) NOT NULL,
  `utility_postal` varchar(64) NOT NULL,
  `utility_address` varchar(128) NOT NULL,
  `utility_available` tinyint(1) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `utility`
--

INSERT INTO `utility` (`utility_id`, `utility_name`, `utility_website`, `utility_email`, `utility_phone`, `utility_postal`, `utility_address`, `utility_available`) VALUES
(1, 'kplc', 'kplc.com', 'kplc@mail.com', '020555789', 'p.o. box 67890, Eldama Ravine.   ', 'KPLC House, Eldama Ravine Branch.', 1),
(4, 'Chemosusu Water', 'chemosusuwatercompany.co.ke', 'freshwater@chemosusuwater.com', '568089', 'p.o. box 6789 -20103, Eldama Ravine ', 'water house, cbd', 1),
(5, 'Safaricom PostPaid', 'safaricom.co.ke', 'saf@mail.com', '987685', 'p.o. box 67098 ', 'safaricom house, westlands', 1),
(6, 'Zain PostPaid', 'zain.com', 'zain@mail.com', '9868765', 'p.o. box 757687 ', 'zain house, mombasa road', 1);

-- --------------------------------------------------------

--
-- Table structure for table `utility_member`
--

CREATE TABLE IF NOT EXISTS `utility_member` (
  `utility_member_utility_id` int(10) unsigned NOT NULL,
  `utility_member_member_id` int(10) unsigned NOT NULL,
  `utility_member_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `utility_member_account` varchar(64) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `utility_member`
--

INSERT INTO `utility_member` (`utility_member_utility_id`, `utility_member_member_id`, `utility_member_date`, `utility_member_account`) VALUES
(1, 7, '2011-02-13 12:51:13', 'G6-K8-5678'),
(4, 7, '0000-00-00 00:00:00', 'AF-56793'),
(6, 7, '0000-00-00 00:00:00', '9863548');

-- --------------------------------------------------------

--
-- Table structure for table `utility_payment`
--

CREATE TABLE IF NOT EXISTS `utility_payment` (
`utility_payment_id` int(10) unsigned NOT NULL,
  `utility_id` int(10) unsigned NOT NULL,
  `member_id` int(10) unsigned NOT NULL,
  `utility_payment_amount` decimal(11,2) NOT NULL,
  `utility_payment_charge` decimal(11,2) unsigned NOT NULL,
  `utility_payment_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `utility_payment`
--

INSERT INTO `utility_payment` (`utility_payment_id`, `utility_id`, `member_id`, `utility_payment_amount`, `utility_payment_charge`, `utility_payment_time`) VALUES
(1, 0, 7, '500.00', '10.00', '2011-02-22 12:11:47'),
(2, 4, 7, '50.00', '10.00', '2011-02-22 12:11:47'),
(3, 1, 7, '40.00', '10.00', '2011-02-22 12:11:47'),
(4, 1, 7, '0.00', '0.00', '2011-02-22 12:11:47'),
(5, 4, 7, '45.00', '10.00', '2011-02-22 12:16:35');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
 ADD PRIMARY KEY (`user_id`), ADD UNIQUE KEY `admin_login` (`admin_login`);

--
-- Indexes for table `country_list`
--
ALTER TABLE `country_list`
 ADD PRIMARY KEY (`country_id`);

--
-- Indexes for table `dividend_payments`
--
ALTER TABLE `dividend_payments`
 ADD PRIMARY KEY (`dividend_payments_id`);

--
-- Indexes for table `dividend_payout`
--
ALTER TABLE `dividend_payout`
 ADD PRIMARY KEY (`dividend_payout_id`);

--
-- Indexes for table `email`
--
ALTER TABLE `email`
 ADD PRIMARY KEY (`email_id`), ADD UNIQUE KEY `email_detail` (`email_detail`);

--
-- Indexes for table `fund_account`
--
ALTER TABLE `fund_account`
 ADD PRIMARY KEY (`fund_account_id`);

--
-- Indexes for table `fund_transaction`
--
ALTER TABLE `fund_transaction`
 ADD PRIMARY KEY (`fund_transaction_id`);

--
-- Indexes for table `fund_trans_charges`
--
ALTER TABLE `fund_trans_charges`
 ADD PRIMARY KEY (`fund_trans_charge_id`);

--
-- Indexes for table `kin`
--
ALTER TABLE `kin`
 ADD PRIMARY KEY (`kin_id`), ADD KEY `kin_name` (`kin_name`);

--
-- Indexes for table `loan`
--
ALTER TABLE `loan`
 ADD PRIMARY KEY (`loan_id`);

--
-- Indexes for table `loan_payment`
--
ALTER TABLE `loan_payment`
 ADD PRIMARY KEY (`loan_payment_id`), ADD KEY `loan_id` (`loan_id`);

--
-- Indexes for table `loan_types`
--
ALTER TABLE `loan_types`
 ADD PRIMARY KEY (`loan_type_id`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
 ADD PRIMARY KEY (`member_id`), ADD UNIQUE KEY `member_work_id` (`member_work_id`), ADD KEY `member_name` (`member_name`);

--
-- Indexes for table `member_query`
--
ALTER TABLE `member_query`
 ADD PRIMARY KEY (`member_query_id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
 ADD PRIMARY KEY (`news_id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
 ADD PRIMARY KEY (`page_id`);

--
-- Indexes for table `phone`
--
ALTER TABLE `phone`
 ADD PRIMARY KEY (`phone_id`), ADD UNIQUE KEY `phone_detail` (`phone_detail`);

--
-- Indexes for table `phyaddress`
--
ALTER TABLE `phyaddress`
 ADD PRIMARY KEY (`phyAddress_id`), ADD KEY `postal_detail` (`phyAddress_detail`);

--
-- Indexes for table `postal`
--
ALTER TABLE `postal`
 ADD PRIMARY KEY (`postal_id`), ADD KEY `postal_detail` (`postal_detail`);

--
-- Indexes for table `share_account`
--
ALTER TABLE `share_account`
 ADD PRIMARY KEY (`share_account_id`);

--
-- Indexes for table `share_purchase`
--
ALTER TABLE `share_purchase`
 ADD PRIMARY KEY (`share_purchase_id`);

--
-- Indexes for table `share_sale_transaction`
--
ALTER TABLE `share_sale_transaction`
 ADD PRIMARY KEY (`share_transaction_id`);

--
-- Indexes for table `share_sale_trans_charges`
--
ALTER TABLE `share_sale_trans_charges`
 ADD PRIMARY KEY (`share_trans_charge_id`);

--
-- Indexes for table `share_transaction`
--
ALTER TABLE `share_transaction`
 ADD PRIMARY KEY (`share_transaction_id`);

--
-- Indexes for table `share_trans_charges`
--
ALTER TABLE `share_trans_charges`
 ADD PRIMARY KEY (`share_trans_charge_id`);

--
-- Indexes for table `site_configs`
--
ALTER TABLE `site_configs`
 ADD UNIQUE KEY `config_name_2` (`config_name`);

--
-- Indexes for table `tmp_sale_share_transaction`
--
ALTER TABLE `tmp_sale_share_transaction`
 ADD PRIMARY KEY (`tmp_share_transaction_id`);

--
-- Indexes for table `tmp_share_purchase`
--
ALTER TABLE `tmp_share_purchase`
 ADD PRIMARY KEY (`share_purchase_id`);

--
-- Indexes for table `tmp_share_transaction`
--
ALTER TABLE `tmp_share_transaction`
 ADD PRIMARY KEY (`tmp_share_transaction_id`);

--
-- Indexes for table `utility`
--
ALTER TABLE `utility`
 ADD PRIMARY KEY (`utility_id`), ADD UNIQUE KEY `utility_name` (`utility_name`);

--
-- Indexes for table `utility_member`
--
ALTER TABLE `utility_member`
 ADD UNIQUE KEY `utility_member_utility_id` (`utility_member_utility_id`,`utility_member_member_id`);

--
-- Indexes for table `utility_payment`
--
ALTER TABLE `utility_payment`
 ADD PRIMARY KEY (`utility_payment_id`), ADD KEY `utility_id` (`utility_id`,`member_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
MODIFY `user_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `country_list`
--
ALTER TABLE `country_list`
MODIFY `country_id` tinyint(4) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=240;
--
-- AUTO_INCREMENT for table `dividend_payments`
--
ALTER TABLE `dividend_payments`
MODIFY `dividend_payments_id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `dividend_payout`
--
ALTER TABLE `dividend_payout`
MODIFY `dividend_payout_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `email`
--
ALTER TABLE `email`
MODIFY `email_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=114;
--
-- AUTO_INCREMENT for table `fund_account`
--
ALTER TABLE `fund_account`
MODIFY `fund_account_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=104;
--
-- AUTO_INCREMENT for table `fund_transaction`
--
ALTER TABLE `fund_transaction`
MODIFY `fund_transaction_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `fund_trans_charges`
--
ALTER TABLE `fund_trans_charges`
MODIFY `fund_trans_charge_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `kin`
--
ALTER TABLE `kin`
MODIFY `kin_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `loan`
--
ALTER TABLE `loan`
MODIFY `loan_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `loan_payment`
--
ALTER TABLE `loan_payment`
MODIFY `loan_payment_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `loan_types`
--
ALTER TABLE `loan_types`
MODIFY `loan_type_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
MODIFY `member_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=105;
--
-- AUTO_INCREMENT for table `member_query`
--
ALTER TABLE `member_query`
MODIFY `member_query_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
MODIFY `news_id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
MODIFY `page_id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `phone`
--
ALTER TABLE `phone`
MODIFY `phone_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=108;
--
-- AUTO_INCREMENT for table `phyaddress`
--
ALTER TABLE `phyaddress`
MODIFY `phyAddress_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `postal`
--
ALTER TABLE `postal`
MODIFY `postal_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `share_account`
--
ALTER TABLE `share_account`
MODIFY `share_account_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=104;
--
-- AUTO_INCREMENT for table `share_purchase`
--
ALTER TABLE `share_purchase`
MODIFY `share_purchase_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `share_sale_transaction`
--
ALTER TABLE `share_sale_transaction`
MODIFY `share_transaction_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `share_sale_trans_charges`
--
ALTER TABLE `share_sale_trans_charges`
MODIFY `share_trans_charge_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `share_transaction`
--
ALTER TABLE `share_transaction`
MODIFY `share_transaction_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `share_trans_charges`
--
ALTER TABLE `share_trans_charges`
MODIFY `share_trans_charge_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tmp_sale_share_transaction`
--
ALTER TABLE `tmp_sale_share_transaction`
MODIFY `tmp_share_transaction_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `tmp_share_purchase`
--
ALTER TABLE `tmp_share_purchase`
MODIFY `share_purchase_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `tmp_share_transaction`
--
ALTER TABLE `tmp_share_transaction`
MODIFY `tmp_share_transaction_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `utility`
--
ALTER TABLE `utility`
MODIFY `utility_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `utility_payment`
--
ALTER TABLE `utility_payment`
MODIFY `utility_payment_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
