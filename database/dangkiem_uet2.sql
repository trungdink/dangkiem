-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 04, 2023 at 02:26 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dangkiem_uet2`
--

-- --------------------------------------------------------

--
-- Table structure for table `dangkiem`
--

CREATE TABLE `dangkiem` (
  `dangKiemId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `carId` int(11) NOT NULL,
  `registerDate` date NOT NULL,
  `expireDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dangkiem`
--

INSERT INTO `dangkiem` (`dangKiemId`, `userId`, `carId`, `registerDate`, `expireDate`) VALUES
(2, 2, 2, '2023-02-01', '2023-12-31'),
(3, 3, 3, '2023-03-01', '2023-12-31'),
(4, 1, 1, '2022-01-04', '2023-12-29'),
(5, 1, 2, '2023-01-04', '2023-12-31'),
(6, 1, 3, '2023-06-01', '2023-12-31'),
(7, 1, 4, '2023-07-01', '2023-12-31'),
(8, 1, 5, '2023-08-01', '2023-12-31'),
(9, 1, 6, '2023-09-01', '2023-12-31'),
(10, 1, 1, '2023-10-01', '2023-12-31');

-- --------------------------------------------------------

--
-- Table structure for table `driver`
--

CREATE TABLE `driver` (
  `driverId` int(11) NOT NULL,
  `driverName` varchar(50) NOT NULL DEFAULT 'Nguyễn Bá Quyết',
  `phoneNumber` int(11) NOT NULL,
  `address` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `driver`
--

INSERT INTO `driver` (`driverId`, `driverName`, `phoneNumber`, `address`) VALUES
(1, 'Nguyễn Bá Quyết', 123456789, 0),
(2, 'Nguyễn Bá Quyết', 987654321, 0),
(3, 'Nguyễn Bá Quyết', 555555555, 0),
(4, 'Nguyễn Bá Quyết', 111111111, 0),
(5, 'Nguyễn Bá Quyết', 222222222, 0),
(6, 'Nguyễn Bá Quyết', 333333333, 0),
(7, 'Nguyễn Bá Quyết', 444444444, 0),
(8, 'Nguyễn Bá Quyết', 555555555, 0),
(9, 'Nguyễn Bá Quyết', 666666666, 0);

-- --------------------------------------------------------

--
-- Table structure for table `oto`
--

CREATE TABLE `oto` (
  `carId` int(11) NOT NULL,
  `driverId` int(11) NOT NULL,
  `number_car` varchar(50) NOT NULL,
  `registerDate` date NOT NULL,
  `brand` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `oto`
--

INSERT INTO `oto` (`carId`, `driverId`, `number_car`, `registerDate`, `brand`) VALUES
(1, 1, 'ABC123', '2023-01-01', 'Brand 1'),
(2, 2, 'DEF456', '2023-02-01', 'Brand 2'),
(3, 3, 'GHI789', '2023-03-01', 'Brand 3'),
(4, 4, 'JKL012', '2023-04-01', 'Brand 4'),
(5, 5, 'MNO345', '2023-05-01', 'Brand 5'),
(6, 6, 'PQR678', '2023-06-01', 'Brand 6'),
(7, 7, 'STU901', '2023-07-01', 'Brand 7'),
(8, 8, 'VWX234', '2023-08-01', 'Brand 8'),
(9, 9, 'YZA567', '2023-09-01', 'Brand 9');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userId` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userId`, `username`, `password`, `role`) VALUES
(1, 'user1', 'password1', b'1'),
(2, 'user2', 'password2', b'0'),
(3, 'user3', 'password3', b'0'),
(4, 'user4', 'password4', b'0'),
(5, 'user5', 'password5', b'0'),
(6, 'user6', 'password6', b'0'),
(7, 'user7', 'password7', b'0'),
(8, 'user8', 'password8', b'0'),
(9, 'user9', 'password9', b'0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dangkiem`
--
ALTER TABLE `dangkiem`
  ADD PRIMARY KEY (`dangKiemId`),
  ADD KEY `fk_dk_car` (`carId`),
  ADD KEY `fk_dk_user` (`userId`);

--
-- Indexes for table `driver`
--
ALTER TABLE `driver`
  ADD PRIMARY KEY (`driverId`);

--
-- Indexes for table `oto`
--
ALTER TABLE `oto`
  ADD PRIMARY KEY (`carId`),
  ADD KEY `fk_oto_driver` (`driverId`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userId`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dangkiem`
--
ALTER TABLE `dangkiem`
  ADD CONSTRAINT `fk_dk_car` FOREIGN KEY (`carId`) REFERENCES `oto` (`carId`),
  ADD CONSTRAINT `fk_dk_user` FOREIGN KEY (`userId`) REFERENCES `user` (`userId`);

--
-- Constraints for table `oto`
--
ALTER TABLE `oto`
  ADD CONSTRAINT `fk_oto_driver` FOREIGN KEY (`driverId`) REFERENCES `driver` (`driverId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
