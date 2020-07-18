-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 18, 2020 at 02:17 AM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uas`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `spMS_Login_GetAdmin` ()  NO SQL
SELECT * FROM ms_login where isAdmin = '1'$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spMS_Personal_DeletePersonalByEmail` (IN `emailValue` VARCHAR(50))  NO SQL
DELETE from ms_personal where email = emailValue$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spMS_Personal_GetPersonalData` ()  NO SQL
SELECT *  FROM ms_personal$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spMS_Personal_GetPersonalDataByEmail` (IN `emailValue` VARCHAR(50))  NO SQL
SELECT * FROM ms_personal where email = emailvalue$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spMS_Personal_InsertPersonal` (IN `fullNameValue` VARCHAR(50), IN `emailValue` VARCHAR(20), IN `addressValue` VARCHAR(200), IN `provinceNameValue` VARCHAR(50), IN `phoneValue` VARCHAR(13), IN `skillValue` VARCHAR(50))  NO SQL
INSERT INTO ms_personal (fullName, email, address, provinceName, phone, skill, inputTime, inputUN, modifTime, modifUN) VALUES (fullNameValue, emailValue, addressValue, provinceNameValue, phoneValue, skillValue, now(), 'agus.maulana', now(), 'agus.maulana')$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spMS_Personal_UpdatePersonal` (IN `fullNameValue` VARCHAR(50), IN `emailValue` VARCHAR(50), IN `addressValue` VARCHAR(200), IN `provinceNameValue` VARCHAR(50), IN `phoneValue` VARCHAR(13), IN `skillValue` VARCHAR(50))  NO SQL
UPDATE ms_personal set fullName = fullNameValue, address = addressValue, provinceName = provinceNameValue, phone = phoneValue, skill = skillValue, modifTime = now(), modifUN = 'agus.maulana' where email = emailValue$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `ms_login`
--

CREATE TABLE `ms_login` (
  `userName` varchar(20) NOT NULL,
  `password` varchar(512) NOT NULL,
  `userDisplayName` varchar(50) NOT NULL,
  `isAdmin` bit(1) NOT NULL,
  `inputTime` datetime NOT NULL,
  `InputUN` varchar(50) NOT NULL,
  `modifTime` datetime NOT NULL,
  `modifUN` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ms_login`
--

INSERT INTO `ms_login` (`userName`, `password`, `userDisplayName`, `isAdmin`, `inputTime`, `InputUN`, `modifTime`, `modifUN`) VALUES
('agus.maulana', '1234', 'Agus Maulana', b'1', '2020-07-14 00:36:27', 'agus.maulana', '2020-07-14 00:36:54', 'agus.maulana');

-- --------------------------------------------------------

--
-- Table structure for table `ms_personal`
--

CREATE TABLE `ms_personal` (
  `fullName` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `address` varchar(200) DEFAULT NULL,
  `provinceName` varchar(50) DEFAULT NULL,
  `phone` varchar(13) DEFAULT NULL,
  `skill` varchar(20) DEFAULT NULL,
  `inputTime` datetime DEFAULT NULL,
  `inputUN` varchar(50) DEFAULT NULL,
  `modifTime` datetime DEFAULT NULL,
  `modifUN` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ms_personal`
--

INSERT INTO `ms_personal` (`fullName`, `email`, `address`, `provinceName`, `phone`, `skill`, `inputTime`, `inputUN`, `modifTime`, `modifUN`) VALUES
('Agus Maulana', 'agus.maulana@eienone.com', 'Tangerang Selatan', 'Banten', '082129099658', 'C#', '2020-07-14 00:20:05', 'agus.maulana', '2020-07-18 06:38:54', 'agus.maulana');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ms_login`
--
ALTER TABLE `ms_login`
  ADD PRIMARY KEY (`userName`,`password`);

--
-- Indexes for table `ms_personal`
--
ALTER TABLE `ms_personal`
  ADD PRIMARY KEY (`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
