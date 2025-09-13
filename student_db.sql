-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 13, 2025 at 08:42 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `student_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

DROP TABLE IF EXISTS `students`;
CREATE TABLE IF NOT EXISTS `students` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `roll` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `department` varchar(50) DEFAULT NULL,
  `profile_photo` varchar(255) DEFAULT NULL,
  `role` enum('student','admin') DEFAULT 'student',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `roll`, `username`, `password`, `name`, `email`, `department`, `profile_photo`, `role`) VALUES
(1, '', 'admin', '0192023a7bbd73250516f069df18b500', 'System Admin', 'admin@gmail.com', 'N/A', 'uploads/admin.jpg', 'admin'),
(2, '2131314', 'sifat', '827ccb0eea8a706c4c34a16891f84e7b', 'Tanvir Sifat', 'sifat@gmail.com', 'BBA', 'uploads/sifat.jpg', 'student'),
(4, '34523534', 'siam', '9323f80e6e98e38151c342e38c5f6454', 'Siam Rahman', 'sr.siam121@gmail.com', 'CSE', 'uploads/1757254011_7.gif', 'student'),
(7, '453636346', 'tahmid', 'b24a4c8f8220404b9bf2724b41f95c53', 'tahmid', 'tahmid@gg.gg', 'CSE', 'uploads/1757255262_Untitled-2.jpg', 'student'),
(10, '21458701', 'sifat1', '10829368795e1fc91a092c6b86c0dccd', 'Sifat', 'tanvirsifat51@gmail.com', 'BBA', 'public/uploads/1757758645_505546618_3020709538090602_6968465340272249243_n.jpg', 'student'),
(11, '5623462346', 'sifat2', '9937b9cb7bb992426633e9c878363ab7', 'xyz', 'fa@gnmai.com', 'CSE', 'uploads/1757271800_download.jpg', 'student'),
(12, '3425246', 'sifat3', '5f4d5513f191a347deffbda6418ccb7a', 'Sifat3', 'sifat3@gmail.com', 'EEE', 'uploads/1757441410_download.jpg', 'student'),
(13, '3253232', 'sifat4', 'd7520125057de45c376da0e2c034a515', 'sifat4', 'sifat4@gmail.com', 'ENGLISH', 'uploads/1757745414_1000550_8217574_mm2_magazine.jpg', 'student'),
(14, '436262446', 'siam3', 'd76ab385e638336d05f1e114340802a1', 'siam3', 'siam3@df.sf', 'CSE', 'public/uploads/1757786546_download (456).jpg', 'student');


--
-- Metadata
--
USE `phpmyadmin`;

--
-- Metadata for table admin
--

--
-- Metadata for table students
--

--
-- Metadata for database student_db
--
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
