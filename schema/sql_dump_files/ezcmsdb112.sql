-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 27, 2015 at 01:19 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ezcmsdb112`
--

-- --------------------------------------------------------

--
-- Table structure for table `active_users`
--

CREATE TABLE IF NOT EXISTS `active_users` (
  `Username` varchar(45) NOT NULL,
  `Time_loggedin` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `banned_users`
--

CREATE TABLE IF NOT EXISTS `banned_users` (
  `Username` varchar(45) NOT NULL,
  `Date` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bizcategory`
--

CREATE TABLE IF NOT EXISTS `bizcategory` (
`Id` int(10) unsigned NOT NULL,
  `Category` varchar(50) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bizcategory`
--

INSERT INTO `bizcategory` (`Id`, `Category`) VALUES
(1, 'Agency'),
(2, 'Consultancy'),
(3, 'Trading Company'),
(4, 'Education'),
(5, 'Financial Institution'),
(6, 'IT Firm'),
(7, 'Non-Governmental Organisation (NGO)'),
(8, 'Health Care'),
(9, 'Transport'),
(10, 'Oil and Gas'),
(11, 'Mining'),
(12, 'Manufacturing'),
(13, 'Telecommunication Network'),
(14, 'Real Estate Developers');

-- --------------------------------------------------------

--
-- Table structure for table `businessdir`
--

CREATE TABLE IF NOT EXISTS `businessdir` (
`Id` int(10) unsigned NOT NULL,
  `Company` varchar(80) DEFAULT NULL,
  `Category` varchar(50) DEFAULT NULL,
  `Address` varchar(60) DEFAULT NULL,
  `Emailaddr` varchar(60) DEFAULT NULL,
  `Website` varchar(255) DEFAULT NULL,
  `Location` varchar(50) DEFAULT NULL,
  `Region` varchar(50) DEFAULT NULL,
  `Phone` varchar(20) DEFAULT NULL,
  `Fax` varchar(20) DEFAULT NULL,
  `Description` text,
  `Lastupdated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Position` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE IF NOT EXISTS `districts` (
`Id` int(10) unsigned NOT NULL,
  `District` varchar(30) NOT NULL,
  `Regionid` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `guest_users`
--

CREATE TABLE IF NOT EXISTS `guest_users` (
  `Ip` varchar(50) NOT NULL,
  `Guest_time` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `jobcategory`
--

CREATE TABLE IF NOT EXISTS `jobcategory` (
`Id` int(10) unsigned NOT NULL,
  `Category` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE IF NOT EXISTS `jobs` (
`Id` int(10) unsigned NOT NULL,
  `Company` varchar(255) DEFAULT NULL,
  `Title` varchar(255) DEFAULT NULL,
  `Empstatus` varchar(20) DEFAULT NULL,
  `Category` varchar(50) DEFAULT NULL,
  `Description` text,
  `Education` varchar(50) DEFAULT NULL,
  `Experience` varchar(50) DEFAULT NULL,
  `Location` varchar(50) DEFAULT NULL,
  `Region` varchar(50) DEFAULT NULL,
  `Contactaddr` tinytext,
  `Phone` varchar(15) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Website` varchar(200) DEFAULT NULL,
  `Deadline` date DEFAULT NULL,
  `Lastupdated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Listedby` int(11) DEFAULT NULL,
  `Position` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `maillinglist`
--

CREATE TABLE IF NOT EXISTS `maillinglist` (
`Id` int(10) unsigned NOT NULL,
  `EmailAddress` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pagecategory`
--

CREATE TABLE IF NOT EXISTS `pagecategory` (
`Id` int(10) unsigned NOT NULL,
  `Category` varchar(50) DEFAULT NULL,
  `Position` int(30) DEFAULT NULL,
  `Visible` enum('Y','N') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pagecategory`
--

INSERT INTO `pagecategory` (`Id`, `Category`, `Position`, `Visible`) VALUES
(1, 'News', 1, 'Y'),
(2, 'Blog', 2, 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `pageimgs`
--

CREATE TABLE IF NOT EXISTS `pageimgs` (
`Id` int(11) NOT NULL,
  `Imgname` varchar(50) DEFAULT NULL,
  `Width` int(5) DEFAULT NULL,
  `Height` int(5) DEFAULT NULL,
  `Imgcaption` tinytext,
  `Mimetype` varchar(50) DEFAULT NULL,
  `Extention` varchar(10) DEFAULT NULL,
  `Pageid` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pageimgs`
--

INSERT INTO `pageimgs` (`Id`, `Imgname`, `Width`, `Height`, `Imgcaption`, `Mimetype`, `Extention`, `Pageid`) VALUES
(1, '08', 480, 250, '', 'image/jpeg', 'jpg', 2),
(2, '04', 480, 250, '', 'image/jpeg', 'jpg', 3),
(3, '1', 480, 250, '', 'image/jpeg', 'jpg', 4);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
`Id` int(10) unsigned NOT NULL,
  `Title` varchar(255) DEFAULT NULL,
  `Content` text,
  `Source` tinytext,
  `Postedby` int(3) DEFAULT NULL,
  `Dateposted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Position` int(30) DEFAULT NULL,
  `Published` enum('Y','N') DEFAULT 'N',
  `Featured` enum('Y','N') DEFAULT 'N',
  `Views` int(30) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`Id`, `Title`, `Content`, `Source`, `Postedby`, `Dateposted`, `Position`, `Published`, `Featured`, `Views`) VALUES
(1, 'Example Page', '<p>Rasarp Multimedia Systems will provide District Assembly with a brand new web design that is easy to navigate and provides useful information to current customers. The design will also convey to potential customer that District Assembly is a reputable business and a reliable company they can depend on for their business. The design will integrate the current logo and colour palette so it will maintain a familiar look to current customers, but will at the same time show them that District Assembly is improving its web presence in order to serve them better.</p>', 'Sirenghana', 1, '2015-03-26 17:53:33', 1, 'Y', 'Y', 12),
(2, 'Example Page 2', '<p>District Assembly needs a website to reach out to its primary customers and also to serve and support the current District Assembly clients. Furthermore, District Assembly needs a website that can be maintained by a District Assembly employee, without the need to regularly employ Rasarp Multimedia Systems to make changes. The District Assembly employee needs to be able to add and revise both text and photos and additional pages if necessary.</p>', 'Sirenghana', 1, '2015-03-15 16:43:11', 1, 'Y', 'Y', 8),
(3, 'Example Page 3', '<p>Central to the new design from Rasarp Multimedia Systems will be a robust Content Management System (CMS) that will allow District Assembly to make changes easily to the website, without requiring a dedicated workstation or additional software. Not only will the CMS save District Assembly revision costs but it will also ensure that the website stays fresh and up to date.</p>', 'Sirenghana', 1, '2015-03-26 17:53:52', 2, 'Y', 'Y', 9),
(4, 'Example Page 4', '<p>this is new page for more stories</p>', 'Sirenghana', 1, '2015-03-26 17:53:42', 1, 'Y', 'Y', 4);

-- --------------------------------------------------------

--
-- Table structure for table `regions`
--

CREATE TABLE IF NOT EXISTS `regions` (
  `Id` int(10) unsigned NOT NULL DEFAULT '0',
  `Region` varchar(30) NOT NULL,
  `Capital` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `regions`
--

INSERT INTO `regions` (`Id`, `Region`, `Capital`) VALUES
(1, 'Upper East', 'Bolegatanga'),
(2, 'Upper West', 'Wa'),
(3, 'Northern', 'Tamale'),
(4, 'Brong Ahafo', 'Sunyani'),
(5, 'Ashanti', 'Kumasi'),
(6, 'Eastern', 'Koforidua'),
(7, 'Western', 'Takoradi'),
(8, 'Central', 'Cape Coast'),
(9, 'Greater Accra', 'Accra'),
(10, 'Volta', 'Ho');

-- --------------------------------------------------------

--
-- Table structure for table `sitemenu`
--

CREATE TABLE IF NOT EXISTS `sitemenu` (
`Id` int(11) unsigned NOT NULL,
  `Nav_name` varchar(20) NOT NULL,
  `Nav_type` varchar(20) DEFAULT NULL,
  `Nav_level` int(5) DEFAULT NULL,
  `Position` int(10) NOT NULL,
  `Visible` enum('Y','N') DEFAULT NULL,
  `Featured` enum('Yes','No') NOT NULL DEFAULT 'No'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sitemenu`
--

INSERT INTO `sitemenu` (`Id`, `Nav_name`, `Nav_type`, `Nav_level`, `Position`, `Visible`, `Featured`) VALUES
(1, 'News', 'Horizontal', 1, 1, 'Y', ''),
(2, 'Blog', 'Horizontal', 1, 2, 'Y', '');

-- --------------------------------------------------------

--
-- Table structure for table `sites`
--

CREATE TABLE IF NOT EXISTS `sites` (
  `Sitename` varchar(50) NOT NULL DEFAULT '',
  `Sitetemplate` varchar(50) DEFAULT NULL,
  `Siteurl` varchar(255) DEFAULT NULL,
  `Sitestatus` enum('active','inactive') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `submenu`
--

CREATE TABLE IF NOT EXISTS `submenu` (
`Id` int(11) unsigned NOT NULL,
  `Nav_id` int(11) DEFAULT NULL,
  `Sub_navname` varchar(20) NOT NULL,
  `Sub_navtype` varchar(20) DEFAULT NULL,
  `Sub_navlevel` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `subpagecat`
--

CREATE TABLE IF NOT EXISTS `subpagecat` (
`Id` int(10) unsigned NOT NULL,
  `CateId` int(11) DEFAULT NULL,
  `Subcategory` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`Id` int(10) unsigned NOT NULL,
  `Firstname` varchar(50) NOT NULL,
  `Lastname` varchar(40) NOT NULL,
  `Gender` varchar(6) DEFAULT NULL,
  `Username` varchar(45) NOT NULL,
  `Password` varchar(40) NOT NULL,
  `Email` varchar(50) DEFAULT 'admin@example.com',
  `Authlevel` int(2) DEFAULT NULL,
  `Status` enum('active','inactive','banned') DEFAULT 'active',
  `Lastupdated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Id`, `Firstname`, `Lastname`, `Gender`, `Username`, `Password`, `Email`, `Authlevel`, `Status`, `Lastupdated`) VALUES
(1, 'A-Rahman', 'Sarpong', 'M', 'Admin', '0192023a7bbd73250516f069df18b500', 'fadanash@gmail.com', 1, 'active', '2015-03-25 13:33:20'),
(2, 'Kojo', 'Kwame Ansah', 'M', 'kojoansah', 'e10adc3949ba59abbe56e057f20f883e', 'kojoansah@example.com', 2, 'active', '2015-03-26 17:17:08'),
(3, 'Samuel', 'Chibuike', 'M', 'samuelchibuike', '21232f297a57a5a743894a0e4a801fc3', 'bthemesandtricks@gmail.com', 1, 'active', '2015-03-27 12:17:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `active_users`
--
ALTER TABLE `active_users`
 ADD PRIMARY KEY (`Username`), ADD UNIQUE KEY `Username` (`Username`);

--
-- Indexes for table `banned_users`
--
ALTER TABLE `banned_users`
 ADD PRIMARY KEY (`Username`), ADD UNIQUE KEY `Username` (`Username`);

--
-- Indexes for table `bizcategory`
--
ALTER TABLE `bizcategory`
 ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `businessdir`
--
ALTER TABLE `businessdir`
 ADD PRIMARY KEY (`Id`), ADD UNIQUE KEY `Company` (`Company`);

--
-- Indexes for table `districts`
--
ALTER TABLE `districts`
 ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `guest_users`
--
ALTER TABLE `guest_users`
 ADD PRIMARY KEY (`Ip`), ADD UNIQUE KEY `Ip` (`Ip`);

--
-- Indexes for table `jobcategory`
--
ALTER TABLE `jobcategory`
 ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
 ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `maillinglist`
--
ALTER TABLE `maillinglist`
 ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `pagecategory`
--
ALTER TABLE `pagecategory`
 ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `pageimgs`
--
ALTER TABLE `pageimgs`
 ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
 ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `regions`
--
ALTER TABLE `regions`
 ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `sitemenu`
--
ALTER TABLE `sitemenu`
 ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `sites`
--
ALTER TABLE `sites`
 ADD PRIMARY KEY (`Sitename`), ADD UNIQUE KEY `Sitename` (`Sitename`);

--
-- Indexes for table `submenu`
--
ALTER TABLE `submenu`
 ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `subpagecat`
--
ALTER TABLE `subpagecat`
 ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`Id`), ADD UNIQUE KEY `unique_username` (`Username`), ADD KEY `Authlevel` (`Authlevel`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bizcategory`
--
ALTER TABLE `bizcategory`
MODIFY `Id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `businessdir`
--
ALTER TABLE `businessdir`
MODIFY `Id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
MODIFY `Id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `jobcategory`
--
ALTER TABLE `jobcategory`
MODIFY `Id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
MODIFY `Id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `maillinglist`
--
ALTER TABLE `maillinglist`
MODIFY `Id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pagecategory`
--
ALTER TABLE `pagecategory`
MODIFY `Id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `pageimgs`
--
ALTER TABLE `pageimgs`
MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
MODIFY `Id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `sitemenu`
--
ALTER TABLE `sitemenu`
MODIFY `Id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `submenu`
--
ALTER TABLE `submenu`
MODIFY `Id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `subpagecat`
--
ALTER TABLE `subpagecat`
MODIFY `Id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `Id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
