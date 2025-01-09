-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 08, 2025 at 07:36 PM
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
-- Database: `db_smep`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_project`
--

CREATE TABLE `tb_project` (
  `id_project` int(11) NOT NULL,
  `project_name` varchar(30) NOT NULL,
  `status` varchar(30) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `budget` float(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_project`
--

INSERT INTO `tb_project` (`id_project`, `project_name`, `status`, `start_date`, `end_date`, `budget`) VALUES
(17, 'Mall AEON', 'On-Progress', '2025-01-30', '2025-01-31', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_report`
--

CREATE TABLE `tb_report` (
  `id_report` int(11) NOT NULL,
  `project_name` varchar(255) DEFAULT NULL,
  `report_date` date NOT NULL,
  `status` varchar(30) NOT NULL,
  `id_project` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_report`
--

INSERT INTO `tb_report` (`id_report`, `project_name`, `report_date`, `status`, `id_project`) VALUES
(20, NULL, '2025-01-09', 'Menunggu Pagi', 16),
(21, NULL, '2025-02-09', 'on progres', 16),
(23, NULL, '2025-01-16', 'Menunggu Material', 17);

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `username`, `password`) VALUES
(1, 'guan', '$2y$10$AzZAPUGHSzDMFeQm.1wjROw1YqANjX1ZjweHcPIT1Xwb/oWXOUDcm'),
(2, 'alikzainulmuchibin', '$2y$10$mEzpA5M3jG0HpAYqewUHyeWSv5iCKTsreVrv0ArtVT/Xq2SoDLl32'),
(3, 'hendra', '$2y$10$8ScUqw4K3.JRjL0UalYNVOnIGnw.mHkGng1I/cOY0VEbefjDsMvSO');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_project`
--
ALTER TABLE `tb_project`
  ADD PRIMARY KEY (`id_project`),
  ADD UNIQUE KEY `project_name` (`project_name`),
  ADD UNIQUE KEY `project_name_2` (`project_name`),
  ADD UNIQUE KEY `unique_project_name` (`project_name`);

--
-- Indexes for table `tb_report`
--
ALTER TABLE `tb_report`
  ADD PRIMARY KEY (`id_report`),
  ADD UNIQUE KEY `project_name` (`project_name`),
  ADD UNIQUE KEY `project_name_2` (`project_name`),
  ADD KEY `fk_id_project` (`project_name`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_project`
--
ALTER TABLE `tb_project`
  MODIFY `id_project` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tb_report`
--
ALTER TABLE `tb_report`
  MODIFY `id_report` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_report`
--
ALTER TABLE `tb_report`
  ADD CONSTRAINT `fk_project_name` FOREIGN KEY (`project_name`) REFERENCES `tb_project` (`project_name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tb_report_project_name` FOREIGN KEY (`project_name`) REFERENCES `tb_project` (`project_name`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
