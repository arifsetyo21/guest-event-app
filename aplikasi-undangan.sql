-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Jan 04, 2021 at 07:55 AM
-- Server version: 5.7.26
-- PHP Version: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aplikasi-undangan`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `username`, `password`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `event_id` int(11) NOT NULL,
  `name` varchar(266) DEFAULT NULL,
  `start_at` timestamp NULL DEFAULT NULL,
  `end_at` timestamp NULL DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `notes` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`event_id`, `name`, `start_at`, `end_at`, `location`, `notes`) VALUES
(12, 'Tahun Baru 2021', '2020-12-30 20:39:00', '2021-01-01 20:40:00', 'Jl Dhuri', 'Bawa Makanan'),
(13, 'Tahun Baru 2022', '2021-01-08 20:48:00', '2021-01-09 20:48:00', 'Jl Dhuri', 'Bawa Makanan');

-- --------------------------------------------------------

--
-- Table structure for table `events_tamu`
--

CREATE TABLE `events_tamu` (
  `events_tamu_id` int(11) NOT NULL,
  `events_id` int(11) NOT NULL,
  `tamu_id` int(11) NOT NULL,
  `qr_code_img` varchar(255) DEFAULT NULL,
  `confirmation_status` varchar(255) DEFAULT 'belum datang',
  `time_attended` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `events_tamu`
--

INSERT INTO `events_tamu` (`events_tamu_id`, `events_id`, `tamu_id`, `qr_code_img`, `confirmation_status`, `time_attended`) VALUES
(86, 13, 8, '86.png', 'belum datang', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tamu`
--

CREATE TABLE `tamu` (
  `id_tamu` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `whatsapp` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `image_name` varchar(50) DEFAULT NULL,
  `konfirmasi` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tamu`
--

INSERT INTO `tamu` (`id_tamu`, `nama`, `whatsapp`, `email`, `alamat`, `image_name`, `konfirmasi`) VALUES
(8, 'ren', '0327430291', 'saya@gmail.com', 'yogyakarta', 'ren.png', 'datang'),
(9, 'aprilia', '085643642735', 'hanifnr123@gmail.com', 'yogyakarta', 'aprilia.png', 'belum datang'),
(10, 'mgh', '085643642735', 'apriliasafira9@gmail.com', 'yogyakarta', 'mgh.png', 'belum datang'),
(11, 'Arif Setyo Nugroho', '081225720280', 'arifsetyo19@gmail.com', 'byl', 'A.png', '1234'),
(14, 'Aulia Ghina Nugraheni', '081225720280', 'belong.zetzoe@gmail.com', 'Surakarta', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `events_tamu`
--
ALTER TABLE `events_tamu`
  ADD PRIMARY KEY (`events_tamu_id`),
  ADD UNIQUE KEY `events_id_and_tamu_id_unique_index` (`events_id`,`tamu_id`) USING BTREE,
  ADD KEY `tamu_id_constraint` (`tamu_id`);

--
-- Indexes for table `tamu`
--
ALTER TABLE `tamu`
  ADD PRIMARY KEY (`id_tamu`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `events_tamu`
--
ALTER TABLE `events_tamu`
  MODIFY `events_tamu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `tamu`
--
ALTER TABLE `tamu`
  MODIFY `id_tamu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `events_tamu`
--
ALTER TABLE `events_tamu`
  ADD CONSTRAINT `events_id_constraint` FOREIGN KEY (`events_id`) REFERENCES `events` (`event_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tamu_id_constraint` FOREIGN KEY (`tamu_id`) REFERENCES `tamu` (`id_tamu`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
