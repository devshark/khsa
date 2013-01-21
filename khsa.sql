-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 20, 2013 at 06:13 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `khsa`
--
CREATE DATABASE `khsa` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `khsa`;

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions_admin`
--

CREATE TABLE IF NOT EXISTS `ci_sessions_admin` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `client_comments`
--

CREATE TABLE IF NOT EXISTS `client_comments` (
  `commentid` int(11) NOT NULL AUTO_INCREMENT,
  `clientid` int(11) NOT NULL,
  `comment` text NOT NULL,
  `date_submitted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`commentid`),
  KEY `clientid` (`clientid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `client_comments`
--

INSERT INTO `client_comments` (`commentid`, `clientid`, `comment`, `date_submitted`) VALUES
(1, 2, 'hello', '2013-01-20 14:53:03'),
(2, 2, 'si joanna po natutulog lng', '2013-01-20 14:53:20'),
(3, 3, 'may liwanag ang buhay', '2013-01-20 14:53:52');

-- --------------------------------------------------------

--
-- Table structure for table `tblclient`
--

CREATE TABLE IF NOT EXISTS `tblclient` (
  `Client_ID` int(11) NOT NULL AUTO_INCREMENT,
  `pwd` varchar(50) NOT NULL,
  `Client_Name` varchar(255) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `Contact_No` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Client_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tblclient`
--

INSERT INTO `tblclient` (`Client_ID`, `pwd`, `Client_Name`, `Address`, `Contact_No`) VALUES
(1, '12345678', 'AB Sandoval BLDG', 'Brgy. Oranbo, Pasig City', '6327637'),
(2, '87654321', 'hg', 'jkhj', '75779'),
(3, 'joannamarieliwanag', 'ddgf', 'hgyg', '889');

-- --------------------------------------------------------

--
-- Table structure for table `tblemployee`
--

CREATE TABLE IF NOT EXISTS `tblemployee` (
  `Emp_No` int(11) NOT NULL AUTO_INCREMENT,
  `Last_Name` varchar(255) DEFAULT NULL,
  `First_Name` varchar(255) DEFAULT NULL,
  `Middle_Name` varchar(255) DEFAULT NULL,
  `Br of Svc` varchar(255) DEFAULT NULL,
  `Rank` varchar(255) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `City` varchar(255) NOT NULL,
  `Provincial_Address` varchar(255) DEFAULT NULL,
  `Tel_No` int(11) DEFAULT NULL,
  `Mobile_No` int(11) DEFAULT NULL,
  `Language / Dialects` varchar(255) DEFAULT NULL,
  `DOB` datetime DEFAULT NULL,
  `POB` varchar(255) DEFAULT NULL,
  `Religion` varchar(255) DEFAULT NULL,
  `Gender` varchar(255) DEFAULT NULL,
  `Height (inch)` int(11) DEFAULT NULL,
  `Weight (kg)` int(11) DEFAULT NULL,
  `Blood_Type` varchar(255) DEFAULT NULL,
  `Complexion` varchar(255) DEFAULT NULL,
  `Marks` varchar(255) DEFAULT NULL,
  `Status` varchar(255) DEFAULT NULL,
  `Date_of_Marriage` datetime DEFAULT NULL,
  `No_of_Children` int(11) DEFAULT NULL,
  `Name_of_Children` varchar(255) DEFAULT NULL,
  `Children_Age` varchar(255) DEFAULT NULL,
  `Name of Spouse` varchar(255) DEFAULT NULL,
  `Spouse_Age` int(11) DEFAULT NULL,
  `Employer's_Name` varchar(255) DEFAULT NULL,
  `Occupation` varchar(255) DEFAULT NULL,
  `Employer's_Address` varchar(255) DEFAULT NULL,
  `Mother_Name` varchar(255) DEFAULT NULL,
  `Mother_Age` int(11) DEFAULT NULL,
  `Mother_Occupation` varchar(255) DEFAULT NULL,
  `Mother_Employer` varchar(255) DEFAULT NULL,
  `Father_Name` varchar(255) DEFAULT NULL,
  `Father_Age` int(11) DEFAULT NULL,
  `Father_Occupation` varchar(255) DEFAULT NULL,
  `Father_Employer` varchar(255) DEFAULT NULL,
  `Sister_Name` varchar(255) DEFAULT NULL,
  `Sister_Occupation` varchar(255) DEFAULT NULL,
  `Sister_DOB` datetime DEFAULT NULL,
  `Brother_Name` varchar(255) DEFAULT NULL,
  `Brother_Occupation` varchar(255) DEFAULT NULL,
  `Brother_DOB` datetime DEFAULT NULL,
  `Case_of_Emergency` varchar(255) DEFAULT NULL,
  `Case_of_Relationship` varchar(255) DEFAULT NULL,
  `Case_of_Address` varchar(255) DEFAULT NULL,
  `Case_of_Tel_No` int(11) DEFAULT NULL,
  `Attended_Name_of_High_School` varchar(255) DEFAULT NULL,
  `Attended_Location_of_High_School` varchar(255) DEFAULT NULL,
  `Attended_Inclusive_Date_in_High_School` datetime DEFAULT NULL,
  `Attended_Name_of_College` varchar(255) DEFAULT NULL,
  `Attended_Location_of_College` varchar(255) DEFAULT NULL,
  `Attended_Inclusive_Date_in_College` datetime DEFAULT NULL,
  `Attended_Course` varchar(255) DEFAULT NULL,
  `Attended_Vocational/Others` varchar(255) DEFAULT NULL,
  `educ_attainment` varchar(255) NOT NULL,
  `Training_Attended_Name_of_School` varchar(255) DEFAULT NULL,
  `Training_Attended_Address` varchar(255) DEFAULT NULL,
  `Training_Attended_Title_of_Training` varchar(255) DEFAULT NULL,
  `Training_Attended_Inclusive_Date` datetime DEFAULT NULL,
  `Training_Attended_Telephone_No` int(11) DEFAULT NULL,
  `ER_Company` varchar(255) DEFAULT NULL,
  `ER_From` datetime DEFAULT NULL,
  `ER_To` datetime DEFAULT NULL,
  `ER_Address` varchar(255) DEFAULT NULL,
  `ER_Tel_No/s` int(11) DEFAULT NULL,
  `ER_Position` varchar(255) DEFAULT NULL,
  `ER_Salary` int(11) DEFAULT NULL,
  `ER_Immediate_Superior` varchar(255) DEFAULT NULL,
  `ER_Reason_for_Leaving` varchar(255) DEFAULT NULL,
  `CR_Name` varchar(255) DEFAULT NULL,
  `CR_Occupation` varchar(255) DEFAULT NULL,
  `CR_Company_Name` varchar(255) DEFAULT NULL,
  `CR_Address` varchar(255) DEFAULT NULL,
  `CR_Tel_No/s` int(11) DEFAULT NULL,
  `CTC_Com_Tax_Certificate_No` int(11) DEFAULT NULL,
  `CTC_Issued_at` int(11) DEFAULT NULL,
  `CTC_Issued_on` int(11) DEFAULT NULL,
  `SL_Security_Licence_No` int(11) DEFAULT NULL,
  `SL_Date_of_Expiry` int(11) DEFAULT NULL,
  `SL_SBR_No` int(11) DEFAULT NULL,
  `SSS_No` int(11) DEFAULT NULL,
  `TIN_No` int(11) DEFAULT NULL,
  `PhilHealth_No` int(11) DEFAULT NULL,
  `PagIbig_No` int(11) DEFAULT NULL,
  `Picture 2x2` tinyint(1) DEFAULT '0',
  `License` tinyint(1) DEFAULT '0',
  `SBR` tinyint(1) DEFAULT '0',
  `SOSIA_Cert` tinyint(1) DEFAULT '0',
  `Training_Cert` tinyint(1) DEFAULT '0',
  `NBI_Clearance` tinyint(1) DEFAULT '0',
  `PNP_Clearance` tinyint(1) DEFAULT '0',
  `DI_Clearance` tinyint(1) DEFAULT '0',
  `Court_Clearance` tinyint(1) DEFAULT '0',
  `Brgy_Clearance` tinyint(1) DEFAULT '0',
  `Drug_Tesr` tinyint(1) DEFAULT '0',
  `Neuro_Test` tinyint(1) DEFAULT '0',
  `School_Diploma` tinyint(1) DEFAULT '0',
  `Birth_Cert` tinyint(1) DEFAULT '0',
  `Marriage_Cert` tinyint(1) DEFAULT '0',
  `Employment_Cert` tinyint(1) DEFAULT '0',
  `SSS_Static_Record` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`Emp_No`),
  KEY `City` (`City`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tblemployee`
--

INSERT INTO `tblemployee` (`Emp_No`, `Last_Name`, `First_Name`, `Middle_Name`, `Br of Svc`, `Rank`, `Address`, `City`, `Provincial_Address`, `Tel_No`, `Mobile_No`, `Language / Dialects`, `DOB`, `POB`, `Religion`, `Gender`, `Height (inch)`, `Weight (kg)`, `Blood_Type`, `Complexion`, `Marks`, `Status`, `Date_of_Marriage`, `No_of_Children`, `Name_of_Children`, `Children_Age`, `Name of Spouse`, `Spouse_Age`, `Employer's_Name`, `Occupation`, `Employer's_Address`, `Mother_Name`, `Mother_Age`, `Mother_Occupation`, `Mother_Employer`, `Father_Name`, `Father_Age`, `Father_Occupation`, `Father_Employer`, `Sister_Name`, `Sister_Occupation`, `Sister_DOB`, `Brother_Name`, `Brother_Occupation`, `Brother_DOB`, `Case_of_Emergency`, `Case_of_Relationship`, `Case_of_Address`, `Case_of_Tel_No`, `Attended_Name_of_High_School`, `Attended_Location_of_High_School`, `Attended_Inclusive_Date_in_High_School`, `Attended_Name_of_College`, `Attended_Location_of_College`, `Attended_Inclusive_Date_in_College`, `Attended_Course`, `Attended_Vocational/Others`, `educ_attainment`, `Training_Attended_Name_of_School`, `Training_Attended_Address`, `Training_Attended_Title_of_Training`, `Training_Attended_Inclusive_Date`, `Training_Attended_Telephone_No`, `ER_Company`, `ER_From`, `ER_To`, `ER_Address`, `ER_Tel_No/s`, `ER_Position`, `ER_Salary`, `ER_Immediate_Superior`, `ER_Reason_for_Leaving`, `CR_Name`, `CR_Occupation`, `CR_Company_Name`, `CR_Address`, `CR_Tel_No/s`, `CTC_Com_Tax_Certificate_No`, `CTC_Issued_at`, `CTC_Issued_on`, `SL_Security_Licence_No`, `SL_Date_of_Expiry`, `SL_SBR_No`, `SSS_No`, `TIN_No`, `PhilHealth_No`, `PagIbig_No`, `Picture 2x2`, `License`, `SBR`, `SOSIA_Cert`, `Training_Cert`, `NBI_Clearance`, `PNP_Clearance`, `DI_Clearance`, `Court_Clearance`, `Brgy_Clearance`, `Drug_Tesr`, `Neuro_Test`, `School_Diploma`, `Birth_Cert`, `Marriage_Cert`, `Employment_Cert`, `SSS_Static_Record`) VALUES
(1, 'Binuya', 'Emman', 'G.', NULL, NULL, 'Manggahan,', 'Pasig City', NULL, NULL, NULL, NULL, '1992-02-08 00:00:00', 'Quezon City', 'Born-Again Christian', 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'JCSGO Christian Academy', 'Quezon City', NULL, 'Pamantasan ng Lungsod ng Pasig', 'Kapasigan, Pasig City', NULL, NULL, NULL, 'hs', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 1, 0),
(2, 'Liwanag', 'Joanna Marie', 'Chupungco', NULL, NULL, 'Bambang', 'Pasig Ciy', NULL, NULL, NULL, 'Taglog', '1990-10-02 00:00:00', 'Mandaluyong', 'Roman Catholic', 'female', NULL, 48, 'o+', 'fair', NULL, 'single', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Nino Jesus House of Studies', 'Mercedes, San Miguel', NULL, 'Pamantasan ng Lungsod ng Pasig', 'Kapasigan, Pasig City', NULL, 'Bachelor of Science in Information Technology', NULL, 'hs', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(3, 'manjares', 'domingo', 'patingo', NULL, NULL, 'rosario,', 'pasig city', 'albay', 0, 0, NULL, '1990-08-19 00:00:00', NULL, NULL, 'male', 145, 56, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ehs', 'rosario, pasig city', '2009-03-23 00:00:00', 'Pamantasan ng Lungsod ng Pasig', 'Kapasigan, Pasig City', '2013-03-14 00:00:00', 'Bachelor of Science in Information Technology', NULL, 'hs', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tblequipment`
--

CREATE TABLE IF NOT EXISTS `tblequipment` (
  `Equipment_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Equipment_Desc` varchar(255) DEFAULT NULL,
  `Equipment_Serial_No` int(11) DEFAULT NULL,
  `Manufacturer_ID` int(11) DEFAULT NULL,
  PRIMARY KEY (`Equipment_ID`),
  KEY `Manufacturer_ID` (`Manufacturer_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tblfirearm`
--

CREATE TABLE IF NOT EXISTS `tblfirearm` (
  `FireArm_ID` int(11) NOT NULL AUTO_INCREMENT,
  `FireArm_Name` varchar(255) DEFAULT NULL,
  `Quantity` int(11) DEFAULT NULL,
  `Ammo_Quantity` int(11) DEFAULT NULL,
  `FireArm_Serial_No` int(11) DEFAULT NULL,
  `Manufactuer_ID` int(11) DEFAULT NULL,
  PRIMARY KEY (`FireArm_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tblfirearm`
--

INSERT INTO `tblfirearm` (`FireArm_ID`, `FireArm_Name`, `Quantity`, `Ammo_Quantity`, `FireArm_Serial_No`, `Manufactuer_ID`) VALUES
(1, 'Shotgun', 2, 45, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbllogin`
--

CREATE TABLE IF NOT EXISTS `tbllogin` (
  `Username` varchar(255) NOT NULL,
  `Password` longtext,
  `First_Name` varchar(255) DEFAULT NULL,
  `Middle_Initial` varchar(255) DEFAULT NULL,
  `Last_Name` varchar(255) DEFAULT NULL,
  `Account_Type` varchar(255) DEFAULT NULL,
  `Security Question` varchar(255) DEFAULT NULL,
  `Security Answer` varchar(255) DEFAULT NULL,
  `Date_Created` datetime DEFAULT NULL,
  `Deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`Username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbllogin`
--

INSERT INTO `tbllogin` (`Username`, `Password`, `First_Name`, `Middle_Initial`, `Last_Name`, `Account_Type`, `Security Question`, `Security Answer`, `Date_Created`, `Deleted`) VALUES
('peggy0445', '12345', 'Joanna Marie', NULL, 'Liwanag', 'Admin', 'Who?', 'Me', '2012-12-03 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tblmanufacturer`
--

CREATE TABLE IF NOT EXISTS `tblmanufacturer` (
  `Manufacturer_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Manufacturer_Name` varchar(255) DEFAULT NULL,
  `Manufacturer_Desc` varchar(255) DEFAULT NULL,
  `Contact_Person` varchar(255) DEFAULT NULL,
  `Contact_No` int(11) DEFAULT NULL,
  PRIMARY KEY (`Manufacturer_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tblschedule`
--

CREATE TABLE IF NOT EXISTS `tblschedule` (
  `Sched_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Date_From` datetime DEFAULT NULL,
  `Date_To` datetime DEFAULT NULL,
  `Emp_No` int(11) DEFAULT NULL,
  `Client_ID` int(11) DEFAULT NULL,
  `FireArm_ID` int(11) DEFAULT NULL,
  PRIMARY KEY (`Sched_ID`),
  KEY `Client_ID` (`Client_ID`),
  KEY `FireArm_ID` (`FireArm_ID`),
  KEY `Emp_No` (`Emp_No`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tblschedule`
--

INSERT INTO `tblschedule` (`Sched_ID`, `Date_From`, `Date_To`, `Emp_No`, `Client_ID`, `FireArm_ID`) VALUES
(2, '2012-12-03 00:00:00', '2012-12-22 00:00:00', 1, 1, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
