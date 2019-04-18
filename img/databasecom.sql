-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 23, 2018 at 06:59 PM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `databasecom`
--

-- --------------------------------------------------------

--
-- Table structure for table `booked`
--

CREATE TABLE `booked` (
  `bookedID` int(11) NOT NULL,
  `bookingDate` date NOT NULL,
  `bookingTime` time NOT NULL,
  `openBookingID` int(11) NOT NULL,
  `stdID` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `booked`
--

INSERT INTO `booked` (`bookedID`, `bookingDate`, `bookingTime`, `openBookingID`, `stdID`) VALUES
(5, '2018-09-23', '01:13:16', 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `openBookingID` int(11) NOT NULL,
  `companyID` int(11) NOT NULL,
  `setQuota` int(11) NOT NULL,
  `reserved` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`openBookingID`, `companyID`, `setQuota`, `reserved`) VALUES
(1, 10, 2, 2),
(3, 6, 2, 0),
(4, 7, 2, 0),
(5, 8, 2, 0),
(6, 9, 7, 2);

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `companyID` int(11) NOT NULL,
  `companyName` varchar(50) NOT NULL,
  `companyAddress` varchar(60) NOT NULL,
  `companyTambol` varchar(20) NOT NULL,
  `companyAmpo` varchar(20) NOT NULL,
  `companyChangwat` varchar(20) NOT NULL,
  `companyZipCode` varchar(10) NOT NULL,
  `companyPhonet` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`companyID`, `companyName`, `companyAddress`, `companyTambol`, `companyAmpo`, `companyChangwat`, `companyZipCode`, `companyPhonet`) VALUES
(3, 'ฟูจิตสึ (ประเทศไทย) จำกัด', '60/90 นิคมอุตสาหกรรมนวนคร หมู่ที่ 19 ซ.นวนครโครงการ 3 ถนนพหล', '', '', '', '', '0-2529-263'),
(5, 'บริษัทไอที โซลูชั่นส์ (ไทยแลนด์) จำกัด', '194/182 หมู่ที่ 6 ซอยเพนียดช้าง 11', 'หนองปรือ  ', 'หนองปรือ ชลบุรี', 'ชลบุรี', '20150', '038716132,'),
(6, 'บริษัทโมโน เทคโนโลยี จำกัด', 'หมู่ที่ 4 อาคารจัสมิน อินเตอร์เนชั่นแนล ทาวเวอร์ ชั้น 16 ถนน', 'ปากเกร็ด   นนทบุรี ', 'ปากเกร็ด', 'นนทบุรี', '11120', ' 025020774'),
(7, 'บริษัทโปรเฟสชันแนลวัน จำกัด', '388 ตึก IBM ชั้น 16 ถนนพหลโยธิน  ', 'สามเสนใน', 'สามเสนใน', ' กรุงเทพมหานคร', '10400', '02-6192161'),
(8, 'ฟูจิตสึ (ประเทศไทย) จำกัด', ' 60/90 นิคมอุตสาหกรรมนวนคร หมู่ที่ 19', 'คลองหลวงแพ่ง', 'เมืองฉะเชิงเทรา', 'ฉะเชิงเทรา', '24000', '0-2529-263'),
(9, 'บริษัท ไซเทค สเปเชียลตี้ เคมิคอลส์ (ประเทศไทย)', 'เลขที่ 2/1 ซ. จี 2   ', 'ลาดกระบัง', 'ลาดกระบัง', 'กรุงเทพมหานคร', '10520', '038-685920'),
(10, 'ศาลจังหวัดตรัง', 'ศาลจังหวัดตรัง ถ.พัทลุง   ', 'ทับเที่ยง', 'เมือง', 'ตรัง', ' 92000', '075-218052'),
(11, 'การไฟฟ้าฝ่ายผลิตแห่งประเทศไทย สำนักงานหาดใหญ่', '1685 ถ.เพชรเกษม ', 'หาดใหญ่', 'หาดใหญ่', 'สงขลา', '90110', ' 076-37588'),
(12, 'บริษัท ริมเพ เมเนจเมนท์ จำกัด ', '33/4 ซอยสุขุมวิท 46 ถ.สุขุมวิท ', 'อนุสาวรีย์', 'บางเขน', 'กรุงเทพมหานคร', '10220', '02-7122915'),
(14, 'ที่ว่าการอำเภอเมืองตรัง', '101 ถ.วิเศษกุล ', 'ทับเที่ยง', ' เมือง ', 'ตรัง ', '92000', '075-216947'),
(17, 'kodenamzz', '37/6 Trang', 'คชสิทธิ์', 'หนองแค', 'สระบุรี', '18250', '0930531834');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `userID` int(3) UNSIGNED ZEROFILL NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`userID`, `username`, `password`, `status`) VALUES
(001, 'admin', 'admin', 'admin'),
(003, '5850116061', '12345', 'std'),
(004, 'kode', '12345', 'std'),
(005, 'meera', '1234', 'std'),
(006, '1234', '1234', 'std'),
(007, 'dee', '1234', 'std'),
(008, '5850110012', '12345', 'std');

-- --------------------------------------------------------

--
-- Table structure for table `studentcomgpa`
--

CREATE TABLE `studentcomgpa` (
  `comgpaid` int(11) NOT NULL,
  `stdID` int(11) NOT NULL,
  `comtest` int(11) DEFAULT NULL,
  `comtestfile` int(11) NOT NULL,
  `gpa` int(11) NOT NULL,
  `gpafile` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `student_data`
--

CREATE TABLE `student_data` (
  `stdID` int(4) NOT NULL,
  `userID` int(3) UNSIGNED ZEROFILL NOT NULL,
  `stdNumber` varchar(255) NOT NULL,
  `stdFirstname` varchar(255) NOT NULL,
  `stdLastname` varchar(255) NOT NULL,
  `stdEmail` varchar(255) NOT NULL,
  `stdPhone` varchar(20) NOT NULL,
  `stdFacebook` varchar(255) NOT NULL,
  `stdMajor` varchar(255) NOT NULL,
  `stdPhoto` varchar(255) DEFAULT 'nothing.jpg',
  `gender` varchar(10) NOT NULL,
  `stdRegisdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student_data`
--

INSERT INTO `student_data` (`stdID`, `userID`, `stdNumber`, `stdFirstname`, `stdLastname`, `stdEmail`, `stdPhone`, `stdFacebook`, `stdMajor`, `stdPhoto`, `gender`, `stdRegisdate`) VALUES
(1, 003, '5850116061', 'อับดุลกอเดร์', 'เปาะลอ', 'kode4028@gmail.com', '123456789', 'kodenamee', 'ICM', '5850116061.jpg', 'ชาย', '2018-09-16'),
(3, 004, 'kode', 'kode', 'kode', 'kode4028@gmail.com', '930531834', 'kode', 'การจัดการสารสนเทศและคอมพิวเตอร์', 'kode.jpg', 'none', '2018-09-23'),
(4, 005, 'meera', 'me', 'ra', 'kode4028@gmail.com', '930531834', 'fb', 'การจัดการพาณิชย์อิเล็กทรอนิกส์', NULL, '', '2018-09-23'),
(5, 006, '1234', '1234', '1234', 'kode4028@gmail.com', '930531834', 'fb', 'การจัดการพาณิชย์อิเล็กทรอนิกส์', 'nothing.jpg', '', '2018-09-23'),
(6, 007, 'dee', 'dee', 'dee', 'kode4028@gmail.com', '930531834', 'dee', 'การจัดการสารสนเทศและคอมพิวเตอร์', 'dee.jpg', 'none', '2018-09-23'),
(7, 008, '5850110012', 'Fiya', 'Bueto', 'fiya@mail.com', '0987654321', 'fiya beuto', 'การจัดการสารสนเทศและคอมพิวเตอร์', '5850110012.jpg', 'หญิง', '2018-09-23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booked`
--
ALTER TABLE `booked`
  ADD PRIMARY KEY (`bookedID`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`openBookingID`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`companyID`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`userID`);

--
-- Indexes for table `studentcomgpa`
--
ALTER TABLE `studentcomgpa`
  ADD PRIMARY KEY (`comgpaid`);

--
-- Indexes for table `student_data`
--
ALTER TABLE `student_data`
  ADD PRIMARY KEY (`stdID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booked`
--
ALTER TABLE `booked`
  MODIFY `bookedID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `openBookingID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `companyID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `userID` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `studentcomgpa`
--
ALTER TABLE `studentcomgpa`
  MODIFY `comgpaid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_data`
--
ALTER TABLE `student_data`
  MODIFY `stdID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
