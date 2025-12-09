--
-- Skema Basis Data untuk Aplikasi Persewaan Kaset Game
--

-- --------------------------------------------------------

--
-- Struktur tabel untuk `pengguna`
--
CREATE TABLE `pengguna` (
  `IDPengguna` int(11) NOT NULL AUTO_INCREMENT,
  `Nama` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Role` enum('user','admin') NOT NULL DEFAULT 'user',
  PRIMARY KEY (`IDPengguna`),
  UNIQUE KEY `Email` (`Email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur tabel untuk `platform`
--
CREATE TABLE `platform` (
  `IDPlatform` int(11) NOT NULL AUTO_INCREMENT,
  `NamaPlatform` varchar(100) NOT NULL,
  PRIMARY KEY (`IDPlatform`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- --------------------------------------------------------

--
-- Struktur tabel untuk `game`
--
CREATE TABLE `game` (
  `IDGame` int(11) NOT NULL AUTO_INCREMENT,
  `Judul` varchar(150) NOT NULL,
  `Genre` varchar(100) DEFAULT NULL,
  `IDPlatform` int(11) NOT NULL,
  `URLGambar` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`IDGame`),
  KEY `fk_game_platform` (`IDPlatform`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur tabel untuk `kaset` (Inventaris)
--
CREATE TABLE `kaset` (
  `IDKaset` int(11) NOT NULL AUTO_INCREMENT,
  `IDGame` int(11) NOT NULL,
  `Status` enum('Tersedia','Disewa') NOT NULL DEFAULT 'Tersedia',
  PRIMARY KEY (`IDKaset`),
  KEY `fk_kaset_game` (`IDGame`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur tabel untuk `transaksisewa` (Header Transaksi)
--
CREATE TABLE `transaksisewa` (
  `NomorNota` varchar(32) NOT NULL,
  `IDPengguna` int(11) NOT NULL,
  `TglSewa` date NOT NULL,
  `TglWajibKembali` date NOT NULL,
  `Status` enum('active','completed','cancelled','pending') NOT NULL DEFAULT 'pending',
  `TglTransaksi` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`NomorNota`),
  KEY `fk_transaksi_pengguna` (`IDPengguna`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur tabel untuk `detailsewa` (Detail Transaksi)
--
CREATE TABLE `detailsewa` (
  `NomorNota` varchar(32) NOT NULL,
  `IDKaset` int(11) NOT NULL,
  PRIMARY KEY (`NomorNota`, `IDKaset`),
  KEY `fk_detail_kaset` (`IDKaset`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur tabel untuk `rating`
--
CREATE TABLE `rating` (
  `IDRating` int(11) NOT NULL AUTO_INCREMENT,
  `IDPengguna` int(11) NOT NULL,
  `IDGame` int(11) NOT NULL,
  `Skor` int(11) DEFAULT NULL CHECK (`Skor` between 1 and 5),
  `Ulasan` text DEFAULT NULL,
  `TglRating` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`IDRating`),
  KEY `fk_rating_pengguna` (`IDPengguna`),
  KEY `fk_rating_game` (`IDGame`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


--
-- Constraints
--

ALTER TABLE `game`
  ADD CONSTRAINT `fk_game_platform` FOREIGN KEY (`IDPlatform`) REFERENCES `platform` (`IDPlatform`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `kaset`
  ADD CONSTRAINT `fk_kaset_game` FOREIGN KEY (`IDGame`) REFERENCES `game` (`IDGame`) ON DELETE CASCADE ON UPDATE CASCADE;
  
ALTER TABLE `transaksisewa`
  ADD CONSTRAINT `fk_transaksi_pengguna` FOREIGN KEY (`IDPengguna`) REFERENCES `pengguna` (`IDPengguna`) ON UPDATE CASCADE;

ALTER TABLE `detailsewa`
  ADD CONSTRAINT `fk_detail_kaset` FOREIGN KEY (`IDKaset`) REFERENCES `kaset` (`IDKaset`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_detail_transaksi` FOREIGN KEY (`NomorNota`) REFERENCES `transaksisewa` (`NomorNota`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `rating`
  ADD CONSTRAINT `fk_rating_game` FOREIGN KEY (`IDGame`) REFERENCES `game` (`IDGame`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_rating_pengguna` FOREIGN KEY (`IDPengguna`) REFERENCES `pengguna` (`IDPengguna`) ON DELETE CASCADE ON UPDATE CASCADE;

COMMIT;
