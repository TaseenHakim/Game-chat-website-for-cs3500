-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2022 at 08:17 PM
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
-- Database: `playnchat`
--

-- --------------------------------------------------------

--
-- Table structure for table `game`
--

CREATE TABLE `game` (
  `gameId` int(11) NOT NULL,
  `p1` int(11) DEFAULT NULL,
  `p2` int(11) DEFAULT NULL,
  `turn` int(11) DEFAULT NULL,
  `board` varchar(50) DEFAULT NULL,
  `wins` int(11) DEFAULT NULL,
  `losses` int(11) DEFAULT NULL,
  `draws` int(11) DEFAULT NULL,
  `gameType` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `game`
--

INSERT INTO `game` (`gameId`, `p1`, `p2`, `turn`, `board`, `wins`, `losses`, `draws`, `gameType`) VALUES
(1670646839, 4, NULL, NULL, '---------', NULL, NULL, NULL, 1),
(1670648139, 1, NULL, NULL, '---------', NULL, NULL, NULL, 1),
(1671135786, 2, NULL, NULL, '---------', NULL, NULL, NULL, 1),
(1671135912, 2, NULL, NULL, '---------', NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `invite`
--

CREATE TABLE `invite` (
  `inviteId` int(11) NOT NULL,
  `invitee` int(11) NOT NULL,
  `inviter` int(11) NOT NULL,
  `gameId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `invite`
--

INSERT INTO `invite` (`inviteId`, `invitee`, `inviter`, `gameId`) VALUES
(10, 1, 4, 1670646839),
(11, 2, 1, 1670648139),
(12, 1, 2, 1671135786),
(13, 1, 2, 1671135912);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `Id` int(11) NOT NULL,
  `FirstName` varchar(30) NOT NULL,
  `LastName` varchar(30) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `Password` longtext NOT NULL,
  `isPlaying` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`Id`, `FirstName`, `LastName`, `Email`, `Password`, `isPlaying`) VALUES
(1, 'Paul', 'Palok', 'md.palok@gmail.com', '$2y$10$2R12ps3pviE1A/V9EZuT/OJz3V1I2pO030tBkF8aswJ3yv1BNrpqa', 0),
(2, 'Tarin', 'Nurany', 'tarin@gmail.com', '$2y$10$axlJrOF606ybXpRuKrkojuRWhtEdhPUIpfQYP1MG9zPOpc3nMTQmu', 0),
(3, 'Abir', 'Palok', 'abir.palok@hotmail.com', '$2y$10$FavdV/0BQh35tA6Ws9PoD.R3dkYjoHPRAlArIjGbQ91Qjf3VveXRG', 0),
(4, 'Taseen', 'Hakim', 'taseen.hakim@gmail.com', '$2y$10$/qrwdKeWJq5d0okFpljDLexZdjVG.5aIPWx4GfoVuAGLgNZlfqu4a', 0),
(5, 'Steaming', 'Pilot', 'steaming.pilot@gmail', '$2y$10$qulG9KT857nqYWpDOGXJseQlm418YjTZVHDsgmX8Yo7P16lRLFyou', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `game`
--
ALTER TABLE `game`
  ADD PRIMARY KEY (`gameId`),
  ADD KEY `p1` (`p1`),
  ADD KEY `p2` (`p2`),
  ADD KEY `turn` (`turn`);

--
-- Indexes for table `invite`
--
ALTER TABLE `invite`
  ADD PRIMARY KEY (`inviteId`),
  ADD KEY `invitee` (`invitee`),
  ADD KEY `inviter` (`inviter`),
  ADD KEY `gameId` (`gameId`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `UniqueEmail` (`Email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `invite`
--
ALTER TABLE `invite`
  MODIFY `inviteId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `game`
--
ALTER TABLE `game`
  ADD CONSTRAINT `game_ibfk_1` FOREIGN KEY (`p1`) REFERENCES `user` (`Id`),
  ADD CONSTRAINT `game_ibfk_2` FOREIGN KEY (`p2`) REFERENCES `user` (`Id`),
  ADD CONSTRAINT `game_ibfk_3` FOREIGN KEY (`turn`) REFERENCES `user` (`Id`);

--
-- Constraints for table `invite`
--
ALTER TABLE `invite`
  ADD CONSTRAINT `gameId` FOREIGN KEY (`gameId`) REFERENCES `game` (`gameId`),
  ADD CONSTRAINT `invitee` FOREIGN KEY (`invitee`) REFERENCES `user` (`Id`),
  ADD CONSTRAINT `inviter` FOREIGN KEY (`inviter`) REFERENCES `user` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
