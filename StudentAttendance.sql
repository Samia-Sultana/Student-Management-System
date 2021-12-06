-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 05, 2021 at 06:35 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `student_attendance_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `enrollmentId` int(11) DEFAULT NULL,
  `attendanceDate` varchar(20) DEFAULT NULL,
  `attendance` varchar(20) DEFAULT NULL,
  `attId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`enrollmentId`, `attendanceDate`, `attendance`, `attId`) VALUES
(2, '2021/09/05', 'present', 41),
(0, '2021/08/04', 'present', 42),
(0, '2021/08/10', 'present', 43),
(0, '2021/08/24', 'present', 44),
(0, '2021/08/25', 'present', 45),
(4, '2021/08/01', 'present', 46),
(4, '2021/08/22', 'present', 47),
(4, '2021/08/10', 'present', 48),
(5, '2021/08/30', 'present', 49),
(5, '2021/08/01', 'present', 50),
(5, '2021/08/29', 'present', 51),
(7, '2021/08/22', 'present', 52),
(7, '2021/08/29', 'present', 53),
(7, '2021/08/31', 'present', 54),
(10, '2021/08/04', 'present', 55),
(10, '2021/08/17', 'present', 56),
(10, '2021/08/31', 'present', 57),
(12, '2021/08/15', 'present', 58),
(12, '2021/08/16', 'present', 59),
(12, '2021/08/30', 'present', 60),
(16, '2021/08/26', 'present', 61),
(16, '2021/08/25', 'present', 62),
(13, '2021/08/04', 'present', 63),
(13, '2021/08/05', 'present', 64),
(13, '2021/08/26', 'present', 65),
(14, '2021/08/29', 'present', 66),
(14, '2021/08/31', 'present', 67),
(13, '2021/09/01', 'present', 68),
(13, '2021/09/02', 'present', 69);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`attId`),
  ADD KEY `enrollmentId` (`enrollmentId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `attId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`enrollmentId`) REFERENCES `enrolled` (`enrollmentId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
