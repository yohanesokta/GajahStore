-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 08, 2025 at 03:30 PM
-- Server version: 12.0.2-MariaDB
-- PHP Version: 8.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `basdat_game`
--

-- --------------------------------------------------------

--
-- Table structure for table `detailsewa`
--

CREATE TABLE `detailsewa` (
  `NomorNota` varchar(20) NOT NULL,
  `IDKaset` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `detailsewa`
--

INSERT INTO `detailsewa` (`NomorNota`, `IDKaset`) VALUES
('N001', 2),
('N006', 2),
('N004', 3),
('N002', 7),
('N004', 8),
('N003', 11);

-- --------------------------------------------------------

--
-- Table structure for table `game`
--

CREATE TABLE `game` (
  `KodeGame` varchar(20) NOT NULL,
  `Judul` varchar(150) NOT NULL,
  `Genre` varchar(100) DEFAULT NULL,
  `IDPlatform` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `game`
--

INSERT INTO `game` (`KodeGame`, `Judul`, `Genre`, `IDPlatform`) VALUES
('G001', 'The Last of Us Part II', 'Action', 1),
('G002', 'Ghost of Tsushima', 'Adventure', 1),
('G003', 'God of War Ragnarok', 'Action', 2),
('G004', 'Forza Horizon 5', 'Racing', 5),
('G005', 'Halo Infinite', 'Shooter', 3),
('G006', 'Zelda: Breath of the Wild', 'Adventure', 4),
('G007', 'Mario Kart 8 Deluxe', 'Racing', 4),
('G008', 'Cyberpunk 2077', 'RPG', 5),
('G009', 'FIFA 24', 'Sports', 2),
('G010', 'Spider-Man 2', 'Action', 2);

-- --------------------------------------------------------

--
-- Table structure for table `kaset`
--

CREATE TABLE `kaset` (
  `IDKaset` int(11) NOT NULL,
  `KodeGame` varchar(20) NOT NULL,
  `Status` varchar(50) DEFAULT 'Tersedia'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `kaset`
--

INSERT INTO `kaset` (`IDKaset`, `KodeGame`, `Status`) VALUES
(1, 'G001', 'Tersedia'),
(2, 'G001', 'Disewa'),
(3, 'G002', 'Tersedia'),
(4, 'G003', 'Tersedia'),
(5, 'G003', 'Rusak'),
(6, 'G004', 'Tersedia'),
(7, 'G005', 'Disewa'),
(8, 'G006', 'Tersedia'),
(9, 'G007', 'Tersedia'),
(10, 'G008', 'Tersedia'),
(11, 'G009', 'Disewa'),
(12, 'G010', 'Tersedia'),
(13, 'G010', 'Tersedia'),
(14, 'G002', 'Tersedia'),
(15, 'G009', 'Tersedia');

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `IDPengguna` int(11) NOT NULL,
  `Nama` varchar(150) NOT NULL,
  `Email` varchar(150) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Role` enum('admin','member') DEFAULT 'member'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`IDPengguna`, `Nama`, `Email`, `Password`, `Role`) VALUES
(1, 'Admin Utama', 'admin@game.com', 'admin123', 'admin'),
(2, 'Yohanes Okta', 'yohanes@gmail.com', 'pass123', 'member'),
(3, 'Budi Santoso', 'budi@gmail.com', 'budi321', 'member'),
(4, 'Siti Aminah', 'siti@gmail.com', 'siti111', 'member'),
(5, 'Rizky Mahendra', 'rizky@gmail.com', 'rizky333', 'member');

-- --------------------------------------------------------

--
-- Table structure for table `platform`
--

CREATE TABLE `platform` (
  `IDPlatform` int(11) NOT NULL,
  `NamaPlatform` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `platform`
--

INSERT INTO `platform` (`IDPlatform`, `NamaPlatform`) VALUES
(1, 'PlayStation 4'),
(2, 'PlayStation 5'),
(3, 'Xbox One'),
(4, 'Nintendo Switch'),
(5, 'PC');

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `IDRating` int(11) NOT NULL,
  `IDPengguna` int(11) NOT NULL,
  `KodeGame` varchar(20) NOT NULL,
  `Skor` int(11) DEFAULT NULL CHECK (`Skor` between 1 and 5),
  `Ulasan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`IDRating`, `IDPengguna`, `KodeGame`, `Skor`, `Ulasan`) VALUES
(1, 2, 'G001', 5, 'Cerita sangat bagus, melekat sekali.'),
(2, 2, 'G002', 4, 'Grafis mantap, combat keren.'),
(3, 3, 'G006', 5, 'Open world terbaik di Switch.'),
(4, 4, 'G009', 3, 'Lumayan, tapi banyak bug.'),
(5, 5, 'G004', 4, 'Mobilnya detail dan map sangat luas.'),
(6, 3, 'G010', 5, 'Game superhero terbaik!');

-- --------------------------------------------------------

--
-- Table structure for table `transaksisewa`
--

CREATE TABLE `transaksisewa` (
  `NomorNota` varchar(20) NOT NULL,
  `IDPengguna` int(11) NOT NULL,
  `TglSewa` date NOT NULL,
  `TglWajibKembali` date NOT NULL,
  `status` enum('active','disable','cancel') NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `transaksisewa`
--

INSERT INTO `transaksisewa` (`NomorNota`, `IDPengguna`, `TglSewa`, `TglWajibKembali`, `status`) VALUES
('N001', 2, '2025-01-10', '2025-01-15', 'active'),
('N002', 3, '2025-01-12', '2025-01-17', 'active'),
('N003', 4, '2025-01-13', '2025-01-18', 'active'),
('N004', 5, '2025-01-14', '2025-01-19', 'active'),
('N005', 3, '2025-01-20', '2025-01-25', 'active'),
('N006', 1, '2024-09-25', '2025-01-25', 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detailsewa`
--
ALTER TABLE `detailsewa`
  ADD PRIMARY KEY (`NomorNota`,`IDKaset`),
  ADD KEY `fk_detail_kaset` (`IDKaset`);

--
-- Indexes for table `game`
--
ALTER TABLE `game`
  ADD PRIMARY KEY (`KodeGame`),
  ADD KEY `fk_game_platform` (`IDPlatform`);

--
-- Indexes for table `kaset`
--
ALTER TABLE `kaset`
  ADD PRIMARY KEY (`IDKaset`),
  ADD KEY `fk_kaset_game` (`KodeGame`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`IDPengguna`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexes for table `platform`
--
ALTER TABLE `platform`
  ADD PRIMARY KEY (`IDPlatform`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`IDRating`),
  ADD KEY `fk_rating_pengguna` (`IDPengguna`),
  ADD KEY `fk_rating_game` (`KodeGame`);

--
-- Indexes for table `transaksisewa`
--
ALTER TABLE `transaksisewa`
  ADD PRIMARY KEY (`NomorNota`),
  ADD KEY `fk_transaksi_pengguna` (`IDPengguna`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kaset`
--
ALTER TABLE `kaset`
  MODIFY `IDKaset` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `IDPengguna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `platform`
--
ALTER TABLE `platform`
  MODIFY `IDPlatform` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `IDRating` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detailsewa`
--
ALTER TABLE `detailsewa`
  ADD CONSTRAINT `fk_detail_kaset` FOREIGN KEY (`IDKaset`) REFERENCES `kaset` (`IDKaset`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_detail_transaksi` FOREIGN KEY (`NomorNota`) REFERENCES `transaksisewa` (`NomorNota`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `game`
--
ALTER TABLE `game`
  ADD CONSTRAINT `fk_game_platform` FOREIGN KEY (`IDPlatform`) REFERENCES `platform` (`IDPlatform`) ON UPDATE CASCADE;

--
-- Constraints for table `kaset`
--
ALTER TABLE `kaset`
  ADD CONSTRAINT `fk_kaset_game` FOREIGN KEY (`KodeGame`) REFERENCES `game` (`KodeGame`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rating`
--
ALTER TABLE `rating`
  ADD CONSTRAINT `fk_rating_game` FOREIGN KEY (`KodeGame`) REFERENCES `game` (`KodeGame`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_rating_pengguna` FOREIGN KEY (`IDPengguna`) REFERENCES `pengguna` (`IDPengguna`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaksisewa`
--
ALTER TABLE `transaksisewa`
  ADD CONSTRAINT `fk_transaksi_pengguna` FOREIGN KEY (`IDPengguna`) REFERENCES `pengguna` (`IDPengguna`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
