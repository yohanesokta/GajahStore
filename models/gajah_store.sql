-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: gcp.gajahweb.tech
-- Generation Time: Dec 09, 2025 at 12:13 AM
-- Server version: 12.1.2-MariaDB-ubu2404
-- PHP Version: 8.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gajah_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `games`
--

CREATE TABLE `games` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `genre` varchar(100) NOT NULL,
  `platform_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `currency` varchar(3) NOT NULL DEFAULT 'USD',
  `image_url` varchar(255) DEFAULT 'public/images/default_game.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `games`
--

INSERT INTO `games` (`id`, `title`, `genre`, `platform_id`, `price`, `currency`, `image_url`) VALUES
(1, 'The Witcher 3: Wild Hunt', 'RPG', 1, 200000, 'IDR', 'public/images/6936d79b1dec0_capsule_616x353.jpg'),
(2, 'Red Dead Redemption 2', 'Action-Adventure', 2, 550000, 'IDR', 'public/images/6936d790bd4b5_rdr.jpeg'),
(3, 'Genshin Impact', 'RPG', 5, 0, 'IDR', 'public/images/6936b8fd3d31a_gs.jpeg'),
(4, 'Valorant', 'FPS', 1, 0, 'IDR', 'public/images/6936d7a2455a8_731216ff2453134e530feabc9dbd3c44e480e352-1200x625.jpg'),
(5, 'CyberStrike 2077', 'Action RPG', 1, 599000, 'IDR', 'public/images/6936dbee53603_cyberstrike.jpeg'),
(6, 'Kingdoms of Valoria', 'Fantasy RPG', 2, 499000, 'IDR', 'public/images/6936dc7ee2465_KngdmOfVlr_thumbnail_0.jpg'),
(7, 'Star Racers Ultra', 'Racing', 3, 299000, 'IDR', 'public/images/6936dd4560cc6_allstarracer.jpg'),
(8, 'Battlefield Frontline', 'Shooter', 1, 699000, 'IDR', 'public/images/6936db8b1d4a4_bff.jpg'),
(9, 'Mystic Puzzle Quest', 'Puzzle', 4, 99000, 'IDR', 'public/images/6936dcb079700_021.jpeg'),
(10, 'Galaxy Explorer X', 'Adventure', 2, 149000, 'IDR', 'public/images/6936dc4f59590_ggx.jpeg'),
(11, 'Ultimate Football League', 'Sports', 3, 249000, 'IDR', 'public/images/6936dd6ccdaff_ultimatefootbal.webp'),
(12, 'Zombie Outbreak Survival', 'Horror', 1, 199000, 'IDR', 'public/images/6936dd95b6034_zos.jpeg'),
(13, 'Samurai Legends', 'Action', 4, 299000, 'IDR', 'public/images/6936dcd722eaa_samurailegens.jpeg'),
(14, 'Cosmic Chess Masters', 'Strategy', 2, 59000, 'IDR', 'public/images/6936dbc7c2251_ccc.jpeg'),
(15, 'Overwatch 2', 'Shooter', 1, 162057, 'IDR', 'public/images/Overwatch_2.jpg'),
(16, 'PUBG: BATTLEGROUNDS', 'Shooter', 1, 95891, 'IDR', 'public/images/PUBG:_BATTLEGROUNDS.jpg'),
(17, 'Enlisted', 'Shooter', 1, 36292, 'IDR', 'public/images/Enlisted.jpg'),
(18, 'FragPunk', 'Shooter', 1, 242062, 'IDR', 'public/images/FragPunk.jpg'),
(19, 'Throne And Liberty', 'MMORPG', 1, 243814, 'IDR', 'public/images/Throne_And_Liberty.jpg'),
(20, 'Fall Guys', 'Battle Royale', 1, 243733, 'IDR', 'public/images/Fall_Guys.jpg'),
(21, 'Game Of Thrones Winter Is Coming', 'Strategy', 2, 177921, 'IDR', 'public/images/Game_Of_Thrones_Winter_Is_Coming.jpg'),
(22, 'Elvenar', 'Strategy', 2, 148652, 'IDR', 'public/images/Elvenar.jpg'),
(23, 'Neverwinter', 'MMORPG', 1, 127030, 'IDR', 'public/images/Neverwinter.jpg'),
(24, 'Lost Ark', 'ARPG', 1, 245488, 'IDR', 'public/images/Lost_Ark.jpg'),
(25, 'Genshin Impact', 'Action RPG', 1, 166729, 'IDR', 'public/images/Genshin_Impact.jpg'),
(26, 'Hero Wars: Dominion Era', 'MMORPG', 2, 206790, 'IDR', 'public/images/Hero_Wars:_Dominion_Era.jpg'),
(27, 'World of Warships', 'Shooter', 1, 238946, 'IDR', 'public/images/World_of_Warships.jpg'),
(28, 'World of Tanks', 'Shooter', 1, 268904, 'IDR', 'public/images/World_of_Tanks.jpg'),
(29, 'Diablo Immortal', 'MMOARPG', 1, 152097, 'IDR', 'public/images/Diablo_Immortal.jpg'),
(30, 'Phantasy Star Online 2 New Genesis', 'MMORPG', 1, 242155, 'IDR', 'public/images/Phantasy_Star_Online_2_New_Genesis.jpg'),
(31, 'Crossout', 'Shooter', 1, 100353, 'IDR', 'public/images/Crossout.jpg'),
(32, 'War Thunder', 'Shooter', 1, 103374, 'IDR', 'public/images/War_Thunder.jpg'),
(33, 'Battlefield REDSEC', 'Shooter', 1, 111792, 'IDR', 'public/images/Battlefield_REDSEC.jpg'),
(34, 'Marvel Rivals', 'Shooter', 1, 41449, 'IDR', 'public/images/Marvel_Rivals.jpg'),
(35, 'Palia', 'MMORPG', 1, 282705, 'IDR', 'public/images/Palia.jpg'),
(36, 'League of Angels - Heaven\'s Fury', 'MMORPG', 2, 172773, 'IDR', 'public/images/League_of_Angels_-_Heaven\'s_Fury.jpg'),
(37, 'Forge of Empires', 'Strategy', 2, 214216, 'IDR', 'public/images/Forge_of_Empires.jpg'),
(38, 'Star Trek Online', 'MMORPG', 1, 50965, 'IDR', 'public/images/Star_Trek_Online.jpg'),
(39, 'Brighter Shores', 'MMORPG', 1, 108570, 'IDR', 'public/images/Brighter_Shores.jpg'),
(40, 'Halo Infinite', 'Shooter', 1, 171781, 'IDR', 'public/images/Halo_Infinite.jpg'),
(41, 'Valorant', 'Shooter', 1, 159366, 'IDR', 'public/images/Valorant.jpg'),
(42, 'Phantasy Star Online 2', 'MMORPG', 1, 290803, 'IDR', 'public/images/Phantasy_Star_Online_2.jpg'),
(43, 'Call of Duty: Warzone', 'Shooter', 1, 263380, 'IDR', 'public/images/Call_of_Duty:_Warzone.jpg'),
(44, 'Destiny 2', 'Shooter', 1, 118820, 'IDR', 'public/images/Destiny_2.jpg'),
(45, 'Apex Legends', 'Shooter', 1, 52862, 'IDR', 'public/images/Apex_Legends.jpg'),
(46, 'Fortnite', 'Shooter', 1, 257413, 'IDR', 'public/images/Fortnite.jpg'),
(47, 'Blade and Soul', 'MMORPG', 1, 116016, 'IDR', 'public/images/Blade_and_Soul.jpg'),
(48, 'Brawlhalla', 'Fighting', 1, 297140, 'IDR', 'public/images/Brawlhalla.jpg'),
(49, 'Trove', 'MMORPG', 1, 120042, 'IDR', 'public/images/Trove.jpg'),
(50, 'Guild Wars 2', 'MMORPG', 1, 245140, 'IDR', 'public/images/Guild_Wars_2.jpg'),
(51, 'Goodgame Empire', 'Strategy', 2, 174751, 'IDR', 'public/images/Goodgame_Empire.jpg'),
(52, 'RuneScape', 'MMORPG', 1, 265233, 'IDR', 'public/images/RuneScape.jpg'),
(53, 'Tibia', 'MMORPG', 1, 207750, 'IDR', 'public/images/Tibia.jpg'),
(54, 'RAID: Shadow Legends', 'RPG', 1, 143500, 'IDR', 'public/images/RAID:_Shadow_Legends.jpg'),
(55, 'Stronghold Kingdoms', 'Strategy', 2, 138616, 'IDR', 'public/images/Stronghold_Kingdoms.jpg'),
(56, 'Where Winds Meet', 'RPG', 1, 43544, 'IDR', 'public/images/Where_Winds_Meet.jpg'),
(57, '2XKO', 'Fighting', 1, 214727, 'IDR', 'public/images/2XKO.jpg'),
(58, 'Blue Protocol: Star Resonance', 'MMORPG', 1, 211380, 'IDR', 'public/images/Blue_Protocol:_Star_Resonance.jpg'),
(59, 'Raven2', 'MMORPG', 1, 85150, 'IDR', 'public/images/Raven2.jpg'),
(60, 'Superball', 'Sports', 1, 89632, 'IDR', 'public/images/Superball.jpg'),
(61, 'Arena Breakout: Infinite', 'Shooter', 1, 272166, 'IDR', 'public/images/Arena_Breakout:_Infinite.jpg'),
(62, 'Warborne Above Ashes', 'MMO', 1, 157707, 'IDR', 'public/images/Warborne_Above_Ashes.jpg'),
(63, 'Eterspire', 'MMORPG', 1, 159190, 'IDR', 'public/images/Eterspire.jpg'),
(64, 'skate.', 'Sports', 1, 150354, 'IDR', 'public/images/skate..jpg'),
(65, 'Blade & Soul Heroes', 'MMORPG', 1, 252255, 'IDR', 'public/images/Blade_&_Soul_Heroes.jpg'),
(66, 'Dfiance', 'Card Game', 1, 86718, 'IDR', 'public/images/Dfiance.jpg'),
(67, 'Dungeon Stalker', 'Dungeon Crawler', 1, 100749, 'IDR', 'public/images/Dungeon_Stalker.jpg'),
(68, 'Mecha BREAK', 'Shooter', 1, 132999, 'IDR', 'public/images/Mecha_BREAK.jpg'),
(69, 'Terminull Brigade', 'Shooter', 1, 196805, 'IDR', 'public/images/Terminull_Brigade.jpg'),
(70, 'Crystal Of Atlan', 'MMORPG', 1, 105579, 'IDR', 'public/images/Crystal_Of_Atlan.jpg'),
(71, 'Splitgate: Arena Reloaded', 'Shooter', 1, 187396, 'IDR', 'public/images/Splitgate:_Arena_Reloaded.jpg'),
(72, 'Steel Hunters', 'Shooter', 1, 123949, 'IDR', 'public/images/Steel_Hunters.jpg'),
(73, 'The Lost Glitches', 'Card Game', 1, 189710, 'IDR', 'public/images/The_Lost_Glitches.jpg'),
(74, 'Odin: Valhalla Rising', 'MMORPG', 1, 261603, 'IDR', 'public/images/Odin:_Valhalla_Rising.jpg'),
(75, 'War Robots: Frontiers', 'Shooter', 1, 208497, 'IDR', 'public/images/War_Robots:_Frontiers.jpg'),
(76, 'Delta Force', 'Shooter', 1, 88413, 'IDR', 'public/images/Delta_Force.jpg'),
(77, 'Strinova', 'Shooter', 1, 90322, 'IDR', 'public/images/Strinova.jpg'),
(78, 'SUPERVIVE', 'MOBA', 1, 145317, 'IDR', 'public/images/SUPERVIVE.jpg'),
(79, 'Starborne: Frontiers', 'Strategy', 1, 186323, 'IDR', 'public/images/Starborne:_Frontiers.jpg'),
(80, 'Return Alive', 'Shooter', 1, 77157, 'IDR', 'public/images/Return_Alive.jpg'),
(81, 'Spectre Divide', 'Shooter', 1, 31200, 'IDR', 'public/images/Spectre_Divide.jpg'),
(82, 'Vigor', 'Shooter', 1, 296280, 'IDR', 'public/images/Vigor.jpg'),
(83, 'Smite 2', 'MOBA', 1, 151278, 'IDR', 'public/images/Smite_2.jpg'),
(84, 'The First Descendant', 'Shooter', 1, 265845, 'IDR', 'public/images/The_First_Descendant.jpg'),
(85, 'Once Human', 'Shooter', 1, 139695, 'IDR', 'public/images/Once_Human.jpg'),
(86, 'Stormgate', 'Strategy', 1, 149441, 'IDR', 'public/images/Stormgate.jpg'),
(87, 'Battle Crush', 'Battle Royale', 1, 279202, 'IDR', 'public/images/Battle_Crush.jpg'),
(88, 'Screenplay CCG', 'Card Game', 1, 95243, 'IDR', 'public/images/Screenplay_CCG.jpg'),
(89, 'SolForge Fusion', 'Card Game', 1, 52362, 'IDR', 'public/images/SolForge_Fusion.jpg'),
(90, 'Sky: Children of the Light', 'MMORPG', 1, 261981, 'IDR', 'public/images/Sky:_Children_of_the_Light.jpg'),
(91, 'Predecessor', 'MOBA', 1, 209709, 'IDR', 'public/images/Predecessor.jpg'),
(92, 'Project Apidom', 'MOBA', 1, 98060, 'IDR', 'public/images/Project_Apidom.jpg'),
(93, 'Ravendawn', 'MMORPG', 1, 78652, 'IDR', 'public/images/Ravendawn.jpg'),
(94, 'One Punch Man: World', 'Action Game', 1, 261475, 'IDR', 'public/images/One_Punch_Man:_World.jpg'),
(95, 'Battle Teams 2', 'Shooter', 1, 259544, 'IDR', 'public/images/Battle_Teams_2.jpg'),
(96, 'The Finals', 'Shooter', 1, 21955, 'IDR', 'public/images/The_Finals.jpg'),
(97, 'Infinite Borders', 'Strategy', 1, 20147, 'IDR', 'public/images/Infinite_Borders.jpg'),
(98, 'Titan Revenge', 'MMORPG', 2, 222422, 'IDR', 'public/images/Titan_Revenge.jpg'),
(99, 'Destiny\'s Divide', 'Card Game', 1, 57252, 'IDR', 'public/images/Destiny\'s_Divide.jpg'),
(100, 'Warhammer 40,000: Warpforge', 'Card Game', 1, 273608, 'IDR', 'public/images/Warhammer_40,000:_Warpforge.jpg'),
(101, 'Microvolts: Recharged', 'Shooter', 1, 38494, 'IDR', 'public/images/Microvolts:_Recharged.jpg'),
(102, 'Deceit 2', 'Action', 1, 116459, 'IDR', 'public/images/Deceit_2.jpg'),
(103, 'Hawked', 'Shooter', 1, 93561, 'IDR', 'public/images/Hawked.jpg'),
(104, 'Tales Of Yore', 'MMORPG', 1, 290086, 'IDR', 'public/images/Tales_Of_Yore.jpg'),
(105, 'Waven', 'Strategy', 1, 33513, 'IDR', 'public/images/Waven.jpg'),
(106, 'Town of Salem 2', 'Strategy', 1, 184263, 'IDR', 'public/images/Town_of_Salem_2.jpg'),
(107, 'Naraka: Bladepoint', 'Battle Royale', 1, 100826, 'IDR', 'public/images/Naraka:_Bladepoint.jpg'),
(108, 'Undawn', 'Shooter', 1, 282553, 'IDR', 'public/images/Undawn.jpg'),
(109, 'Eden Eternal', 'MMORPG', 1, 215275, 'IDR', 'public/images/Eden_Eternal.jpg'),
(110, 'Veiled Experts', 'Shooter', 1, 286613, 'IDR', 'public/images/Veiled_Experts.jpg'),
(111, 'Jected - Rivals', 'Sports', 1, 231664, 'IDR', 'public/images/Jected_-_Rivals.jpg'),
(112, 'Ethyrial: Echoes of Yore', 'MMORPG', 1, 31263, 'IDR', 'public/images/Ethyrial:_Echoes_of_Yore.jpg'),
(113, 'Honkai: Star Rail', 'RPG', 1, 137512, 'IDR', 'public/images/Honkai:_Star_Rail.jpg'),
(114, 'Warlander', 'MOBA', 1, 280787, 'IDR', 'public/images/Warlander.jpg'),
(115, 'Stalcraft: X', 'Shooter', 1, 188933, 'IDR', 'public/images/Stalcraft:_X.jpg'),
(116, 'Fangs', 'MOBA', 1, 144586, 'IDR', 'public/images/Fangs.jpg'),
(117, 'Summoners War: Chronicles', 'MMORPG', 1, 165081, 'IDR', 'public/images/Summoners_War:_Chronicles.jpg'),
(118, 'Marvel Snap', 'Card Game', 1, 168912, 'IDR', 'public/images/Marvel_Snap.jpg'),
(119, 'World Boss', 'Shooter', 1, 254963, 'IDR', 'public/images/World_Boss.jpg'),
(120, 'Omega Strikers', 'Sports', 1, 81254, 'IDR', 'public/images/Omega_Strikers.jpg'),
(121, 'Gundam Evolution', 'Shooter', 1, 94537, 'IDR', 'public/images/Gundam_Evolution.jpg'),
(122, 'Galahad 3093', 'Shooter', 1, 266824, 'IDR', 'public/images/Galahad_3093.jpg'),
(123, 'Aero Tales Online', 'MMORPG', 1, 117485, 'IDR', 'public/images/Aero_Tales_Online.jpg'),
(124, 'Tower of Fantasy', 'MMORPG', 1, 123634, 'IDR', 'public/images/Tower_of_Fantasy.jpg'),
(125, 'Magic Spellslingers', 'Card Game', 1, 24326, 'IDR', 'public/images/Magic_Spellslingers.jpg'),
(126, 'A.V.A Global', 'Shooter', 1, 48457, 'IDR', 'public/images/A.V.A_Global.jpg'),
(127, 'Lost Light', 'Shooter', 1, 99576, 'IDR', 'public/images/Lost_Light.jpg'),
(128, 'Temperia: Soul of Majestic', 'Card Game', 1, 94408, 'IDR', 'public/images/Temperia:_Soul_of_Majestic.jpg'),
(129, 'Chimeraland', 'MMORPG', 1, 243415, 'IDR', 'public/images/Chimeraland.jpg'),
(130, 'Flyff Universe', 'MMORPG', 2, 119058, 'IDR', 'public/images/Flyff_Universe.jpg'),
(131, 'World of Runes', 'MMORPG', 2, 141485, 'IDR', 'public/images/World_of_Runes.jpg'),
(132, 'Roller Champions', 'Sports', 1, 168445, 'IDR', 'public/images/Roller_Champions.jpg'),
(133, 'Goose, Goose, DUCK', 'Strategy', 1, 155188, 'IDR', 'public/images/Goose,_Goose,_DUCK.jpg'),
(134, 'Super Squad', 'MOBA', 1, 103698, 'IDR', 'public/images/Super_Squad.jpg'),
(135, 'Sherwood Extreme', 'Shooter', 1, 113405, 'IDR', 'public/images/Sherwood_Extreme.jpg'),
(136, 'Smash Legends', 'Fighting', 1, 134503, 'IDR', 'public/images/Smash_Legends.jpg'),
(137, 'Primordials: Battle of Gods', 'Strategy', 1, 210625, 'IDR', 'public/images/Primordials:_Battle_of_Gods.jpg'),
(138, 'Super Mecha Champions', 'Shooter', 1, 184945, 'IDR', 'public/images/Super_Mecha_Champions.jpg'),
(139, 'Chroma: Bloom And Blight', 'Card Game', 1, 35124, 'IDR', 'public/images/Chroma:_Bloom_And_Blight.jpg'),
(140, 'Blankos Block Party', 'MMO', 1, 138679, 'IDR', 'public/images/Blankos_Block_Party.jpg'),
(141, 'Slapshot: Rebound', 'Sports', 1, 50660, 'IDR', 'public/images/Slapshot:_Rebound.jpg'),
(142, 'Rogue Company', 'Shooter', 1, 152235, 'IDR', 'public/images/Rogue_Company.jpg'),
(143, 'Eternal Return', 'MOBA', 1, 258215, 'IDR', 'public/images/Eternal_Return.jpg'),
(144, 'Blood of Steel', 'Strategy', 1, 250747, 'IDR', 'public/images/Blood_of_Steel.jpg'),
(145, 'Spellbreak', 'Battle Royale', 1, 262294, 'IDR', 'public/images/Spellbreak.jpg'),
(146, 'Rocket League', 'Sports', 1, 211729, 'IDR', 'public/images/Rocket_League.jpg'),
(147, 'Armor Valor', 'Strategy', 2, 290960, 'IDR', 'public/images/Armor_Valor.jpg'),
(148, 'Unfortunate Spacemen', 'Shooter', 1, 123518, 'IDR', 'public/images/Unfortunate_Spacemen.jpg'),
(149, 'Jade Goddess', 'MMORPG', 2, 211802, 'IDR', 'public/images/Jade_Goddess.jpg'),
(150, 'Shop Titans', 'Strategy', 1, 131244, 'IDR', 'public/images/Shop_Titans.jpg'),
(151, 'Survivor Legacy', 'Strategy', 2, 166649, 'IDR', 'public/images/Survivor_Legacy.jpg'),
(152, 'Bombergrounds: Battle Royale', 'Battle Royale', 1, 111278, 'IDR', 'public/images/Bombergrounds:_Battle_Royale.jpg'),
(153, 'Kakale Online', 'MMORPG', 1, 211209, 'IDR', 'public/images/Kakale_Online.jpg'),
(154, 'Darwin Project', 'Shooter', 1, 45946, 'IDR', 'public/images/Darwin_Project.jpg'),
(155, 'Legends of Runeterra', 'Card Game', 1, 131984, 'IDR', 'public/images/Legends_of_Runeterra.jpg'),
(156, 'CRSED: F.O.A.D.', 'Shooter', 1, 103104, 'IDR', 'public/images/CRSED:_F.O.A.D..jpg'),
(157, 'Mirage Online Classic', 'MMORPG', 2, 235386, 'IDR', 'public/images/Mirage_Online_Classic.jpg'),
(158, 'Inferna', 'MMORPG', 1, 148670, 'IDR', 'public/images/Inferna.jpg'),
(159, 'Ultimate Pirates', 'Strategy', 2, 125749, 'IDR', 'public/images/Ultimate_Pirates.jpg'),
(160, 'Stay Out', 'Shooter', 1, 59879, 'IDR', 'public/images/Stay_Out.jpg'),
(161, 'PC Futbol Legends', 'Sports', 1, 144470, 'IDR', 'public/images/PC_Futbol_Legends.jpg'),
(162, 'Vampire Empire', 'Strategy', 2, 77291, 'IDR', 'public/images/Vampire_Empire.jpg'),
(163, 'Firestone Idle RPG', 'Strategy', 2, 63972, 'IDR', 'public/images/Firestone_Idle_RPG.jpg'),
(164, 'Mythgard', 'Card Game', 1, 67491, 'IDR', 'public/images/Mythgard.jpg'),
(165, 'Legends of Aria', 'MMORPG', 1, 298929, 'IDR', 'public/images/Legends_of_Aria.jpg'),
(166, 'Crystal Clash', 'Strategy', 1, 168717, 'IDR', 'public/images/Crystal_Clash.jpg'),
(167, 'Dota Underlords', 'Strategy', 1, 100262, 'IDR', 'public/images/Dota_Underlords.jpg'),
(168, 'Minion Masters', 'Card Game', 1, 30846, 'IDR', 'public/images/Minion_Masters.jpg'),
(169, 'Splitgate', 'Shooter', 1, 68801, 'IDR', 'public/images/Splitgate.jpg'),
(170, 'Eternal Fury', 'MMORPG', 2, 82615, 'IDR', 'public/images/Eternal_Fury.jpg'),
(171, 'Conqueror\'s Blade', 'Strategy', 1, 250782, 'IDR', 'public/images/Conqueror\'s_Blade.jpg'),
(172, 'Stein.world', 'MMORPG', 2, 262506, 'IDR', 'public/images/Stein.world.jpg'),
(173, 'Kards', 'Card Game', 1, 242599, 'IDR', 'public/images/Kards.jpg'),
(174, 'KurtzPel', 'Fighting', 1, 238336, 'IDR', 'public/images/KurtzPel.jpg'),
(175, 'The Third Age', 'Strategy', 2, 112850, 'IDR', 'public/images/The_Third_Age.jpg'),
(176, 'Eternal', 'Card Game', 1, 298529, 'IDR', 'public/images/Eternal.jpg'),
(177, 'Artifact', 'Card Game', 1, 167836, 'IDR', 'public/images/Artifact.jpg'),
(178, 'World War 3', 'Shooter', 1, 23076, 'IDR', 'public/images/World_War_3.jpg'),
(179, 'Combat Arms: Reloaded', 'Shooter', 1, 185027, 'IDR', 'public/images/Combat_Arms:_Reloaded.jpg'),
(180, 'Dreadnought', 'Shooter', 1, 61389, 'IDR', 'public/images/Dreadnought.jpg'),
(181, 'Spacelords', 'Shooter', 1, 200989, 'IDR', 'public/images/Spacelords.jpg'),
(182, 'Battlerite Royale', 'MOBA', 1, 51278, 'IDR', 'public/images/Battlerite_Royale.jpg'),
(183, 'Magic: The Gathering Arena', 'Card Game', 1, 205402, 'IDR', 'public/images/Magic:_The_Gathering_Arena.jpg'),
(184, 'League of Angels 3', 'MMORPG', 2, 238854, 'IDR', 'public/images/League_of_Angels_3.jpg'),
(185, 'BlackShot: Revolution', 'Shooter', 1, 192496, 'IDR', 'public/images/BlackShot:_Revolution.jpg'),
(186, 'Cosmos Invictus', 'Card Game', 1, 144293, 'IDR', 'public/images/Cosmos_Invictus.jpg'),
(187, 'Empire: World War 3', 'Strategy', 2, 35126, 'IDR', 'public/images/Empire:_World_War_3.jpg'),
(188, 'Totally Accurate Battlegrounds', 'Shooter', 1, 121178, 'IDR', 'public/images/Totally_Accurate_Battlegrounds.jpg'),
(189, 'Will To Live', 'MMORPG', 1, 275403, 'IDR', 'public/images/Will_To_Live.jpg'),
(190, 'Battle Arena Heroes Adventure', 'Strategy', 2, 223242, 'IDR', 'public/images/Battle_Arena_Heroes_Adventure.jpg'),
(191, 'Spellsworn', 'MOBA', 1, 63907, 'IDR', 'public/images/Spellsworn.jpg'),
(192, 'Z1 Battle Royale', 'Shooter', 1, 209404, 'IDR', 'public/images/Z1_Battle_Royale.jpg'),
(193, 'Tale Of Toast', 'MMORPG', 1, 238792, 'IDR', 'public/images/Tale_Of_Toast.jpg'),
(194, 'SoulWorker', 'MMORPG', 1, 154197, 'IDR', 'public/images/SoulWorker.jpg'),
(195, 'Bombtag', 'Strategy', 1, 164666, 'IDR', 'public/images/Bombtag.jpg'),
(196, 'Ironsight', 'Shooter', 1, 196168, 'IDR', 'public/images/Ironsight.jpg'),
(197, 'Dead Maze', 'MMORPG', 1, 218270, 'IDR', 'public/images/Dead_Maze.jpg'),
(198, 'Scions of Fate', 'MMORPG', 1, 21753, 'IDR', 'public/images/Scions_of_Fate.jpg'),
(199, 'Wild Terra Online', 'MMORPG', 1, 238599, 'IDR', 'public/images/Wild_Terra_Online.jpg'),
(200, 'Global Adventures', 'MMORPG', 1, 49735, 'IDR', 'public/images/Global_Adventures.jpg'),
(201, 'Closers', 'MMORPG', 1, 176041, 'IDR', 'public/images/Closers.jpg'),
(202, 'La Tale Evolved', 'MMORPG', 1, 56472, 'IDR', 'public/images/La_Tale_Evolved.jpg'),
(203, 'Luna Online: Reborn', 'MMORPG', 1, 267626, 'IDR', 'public/images/Luna_Online:_Reborn.jpg'),
(204, 'The Ultimatest Battle', 'Fighting', 1, 220254, 'IDR', 'public/images/The_Ultimatest_Battle.jpg'),
(205, 'Insidia', 'Strategy', 1, 162841, 'IDR', 'public/images/Insidia.jpg'),
(206, 'Quake Champions', 'Shooter', 1, 87124, 'IDR', 'public/images/Quake_Champions.jpg'),
(207, 'Gods Origin Online', 'MMORPG', 2, 271150, 'IDR', 'public/images/Gods_Origin_Online.jpg'),
(208, 'Black Squad', 'Shooter', 1, 37125, 'IDR', 'public/images/Black_Squad.jpg'),
(209, 'Secret World Legends', 'MMORPG', 1, 46673, 'IDR', 'public/images/Secret_World_Legends.jpg'),
(210, 'Albion Online', 'MMORPG', 1, 269151, 'IDR', 'public/images/Albion_Online.jpg'),
(211, 'Argo', 'Shooter', 1, 246010, 'IDR', 'public/images/Argo.jpg'),
(212, 'Pixel Worlds', 'MMORPG', 1, 195298, 'IDR', 'public/images/Pixel_Worlds.jpg'),
(213, 'Deceit', 'Shooter', 1, 224314, 'IDR', 'public/images/Deceit.jpg'),
(214, 'Gwent: The Witcher Card Game', 'Card Game', 1, 117755, 'IDR', 'public/images/Gwent:_The_Witcher_Card_Game.jpg'),
(215, 'Awesomenauts', 'MOBA', 1, 101812, 'IDR', 'public/images/Awesomenauts.jpg'),
(216, 'Alien Swarm: Reactive Drop', 'Shooter', 1, 40299, 'IDR', 'public/images/Alien_Swarm:_Reactive_Drop.jpg'),
(217, 'Catan Universe', 'Card Game', 1, 260129, 'IDR', 'public/images/Catan_Universe.jpg'),
(218, 'Krosmaga', 'Card Game', 1, 243245, 'IDR', 'public/images/Krosmaga.jpg'),
(219, 'Chronicles of Eidola', 'MMORPG', 2, 102538, 'IDR', 'public/images/Chronicles_of_Eidola.jpg'),
(220, 'MU Legend', 'MMORPG', 1, 176038, 'IDR', 'public/images/MU_Legend.jpg'),
(221, 'Therian Saga', 'MMORPG', 1, 218634, 'IDR', 'public/images/Therian_Saga.jpg'),
(222, 'Cabals: Card Blitz', 'Card Game', 1, 174352, 'IDR', 'public/images/Cabals:_Card_Blitz.jpg'),
(223, 'Line of Sight', 'Shooter', 1, 57629, 'IDR', 'public/images/Line_of_Sight.jpg'),
(224, 'Dragon Awaken', 'MMORPG', 2, 166202, 'IDR', 'public/images/Dragon_Awaken.jpg'),
(225, 'Infestation: The New Z', 'Shooter', 1, 90625, 'IDR', 'public/images/Infestation:_The_New_Z.jpg'),
(226, 'One Tower', 'MOBA', 1, 153810, 'IDR', 'public/images/One_Tower.jpg'),
(227, 'Shadowverse', 'Card Game', 1, 248850, 'IDR', 'public/images/Shadowverse.jpg'),
(228, 'AdventureQuest 3D', 'MMORPG', 1, 85397, 'IDR', 'public/images/AdventureQuest_3D.jpg'),
(229, 'Riding Club Championships', 'Racing', 1, 34662, 'IDR', 'public/images/Riding_Club_Championships.jpg'),
(230, 'Battlerite', 'MOBA', 1, 55228, 'IDR', 'public/images/Battlerite.jpg'),
(231, 'Paladins', 'Shooter', 1, 180078, 'IDR', 'public/images/Paladins.jpg'),
(232, 'Star Crusade', 'Card Game', 1, 280125, 'IDR', 'public/images/Star_Crusade.jpg'),
(233, 'Omega Zodiac', 'MMORPG', 2, 204444, 'IDR', 'public/images/Omega_Zodiac.jpg'),
(234, 'The Elder Scrolls: Legends', 'Card Game', 1, 274898, 'IDR', 'public/images/The_Elder_Scrolls:_Legends.jpg'),
(235, 'Riders of Icarus', 'MMORPG', 1, 23078, 'IDR', 'public/images/Riders_of_Icarus.jpg'),
(236, 'Naruto Online', 'MMORPG', 2, 159588, 'IDR', 'public/images/Naruto_Online.jpg'),
(237, 'Zula', 'Shooter', 1, 243173, 'IDR', 'public/images/Zula.jpg'),
(238, 'LuckCatchers', 'MMORPG', 1, 84891, 'IDR', 'public/images/LuckCatchers.jpg'),
(239, 'UFO Online: Invasion', 'MMORPG', 1, 286083, 'IDR', 'public/images/UFO_Online:_Invasion.jpg'),
(240, 'Weapons Of Mythology', 'MMORPG', 1, 116075, 'IDR', 'public/images/Weapons_Of_Mythology.jpg'),
(241, 'Tree of Savior', 'MMORPG', 1, 136411, 'IDR', 'public/images/Tree_of_Savior.jpg'),
(242, 'Starbreak', 'MMORPG', 1, 297082, 'IDR', 'public/images/Starbreak.jpg'),
(243, 'Fantasy Tales Online', 'MMORPG', 1, 85616, 'IDR', 'public/images/Fantasy_Tales_Online.jpg'),
(244, 'Dragon Blood', 'MMORPG', 2, 248302, 'IDR', 'public/images/Dragon_Blood.jpg'),
(245, 'League of Angels 2', 'MMORPG', 2, 107422, 'IDR', 'public/images/League_of_Angels_2.jpg'),
(246, 'Astral Heroes', 'Card Game', 1, 287990, 'IDR', 'public/images/Astral_Heroes.jpg'),
(247, 'Holodrive', 'Shooter', 1, 44643, 'IDR', 'public/images/Holodrive.jpg'),
(248, 'Cabal Online', 'MMORPG', 1, 169794, 'IDR', 'public/images/Cabal_Online.jpg'),
(249, 'Atom Universe', 'Social', 1, 221042, 'IDR', 'public/images/Atom_Universe.jpg'),
(250, 'Spellweaver', 'Card Game', 1, 169533, 'IDR', 'public/images/Spellweaver.jpg'),
(251, 'Clash of Avatars', 'MMORPG', 2, 80665, 'IDR', 'public/images/Clash_of_Avatars.jpg'),
(252, 'War Trigger 3', 'Shooter', 1, 241421, 'IDR', 'public/images/War_Trigger_3.jpg'),
(253, 'VEGA Conflict', 'Strategy', 1, 229775, 'IDR', 'public/images/VEGA_Conflict.jpg'),
(254, 'Metal War Online: Retribution', 'Shooter', 1, 201410, 'IDR', 'public/images/Metal_War_Online:_Retribution.jpg'),
(255, 'Immortal Empire', 'MMORPG', 1, 69958, 'IDR', 'public/images/Immortal_Empire.jpg'),
(256, 'MechWarrior Online', 'Shooter', 1, 173738, 'IDR', 'public/images/MechWarrior_Online.jpg'),
(257, 'Armored Warfare', 'Shooter', 1, 120378, 'IDR', 'public/images/Armored_Warfare.jpg'),
(258, 'America’s Army: Proving Grounds', 'Shooter', 1, 72466, 'IDR', 'public/images/America’s_Army:_Proving_Grounds.jpg'),
(259, 'One Piece Online 2', 'MMORPG', 2, 26473, 'IDR', 'public/images/One_Piece_Online_2.jpg'),
(260, 'Forza Motorsport 6: Apex', 'Racing', 1, 245319, 'IDR', 'public/images/Forza_Motorsport_6:_Apex.jpg'),
(261, 'Legends of Honor', 'Strategy', 2, 31241, 'IDR', 'public/images/Legends_of_Honor.jpg'),
(262, 'Felspire', 'MMORPG', 2, 35261, 'IDR', 'public/images/Felspire.jpg'),
(263, 'WARMODE', 'Shooter', 1, 199883, 'IDR', 'public/images/WARMODE.jpg'),
(264, 'Sphere 3: Enchanted World', 'MMORPG', 1, 143514, 'IDR', 'public/images/Sphere_3:_Enchanted_World.jpg'),
(265, 'Fishing Planet', 'Sports', 1, 51749, 'IDR', 'public/images/Fishing_Planet.jpg'),
(266, 'Aberoth', ' MMORPG', 2, 138589, 'IDR', 'public/images/Aberoth.jpg'),
(267, 'Codename CURE', 'Shooter', 1, 43573, 'IDR', 'public/images/Codename_CURE.jpg'),
(268, 'Card Hunter', 'Card Game', 1, 198304, 'IDR', 'public/images/Card_Hunter.jpg'),
(269, 'Fallout Shelter', 'Strategy', 1, 170804, 'IDR', 'public/images/Fallout_Shelter.jpg'),
(270, 'Lord’s Road', 'MMORPG', 2, 87697, 'IDR', 'public/images/Lord’s_Road.jpg'),
(271, 'Salem', 'MMORPG', 1, 297117, 'IDR', 'public/images/Salem.jpg'),
(272, 'Heroes of the Storm', 'MOBA', 1, 84697, 'IDR', 'public/images/Heroes_of_the_Storm.jpg'),
(273, 'Dirty Bomb', 'Shooter', 1, 68374, 'IDR', 'public/images/Dirty_Bomb.jpg'),
(274, 'Vikings: War Of Clans', 'Strategy', 2, 226778, 'IDR', 'public/images/Vikings:_War_Of_Clans.jpg'),
(275, 'Star Trek: Alien Domain', 'Strategy', 2, 261823, 'IDR', 'public/images/Star_Trek:_Alien_Domain.jpg'),
(276, 'Survarium', 'Shooter', 1, 171656, 'IDR', 'public/images/Survarium.jpg'),
(277, 'Dungeon Fighter Online', 'Fighting', 1, 203916, 'IDR', 'public/images/Dungeon_Fighter_Online.jpg'),
(278, 'Grimoire: Manastorm', 'Shooter', 1, 292639, 'IDR', 'public/images/Grimoire:_Manastorm.jpg'),
(279, 'StarColony', 'Strategy', 2, 141941, 'IDR', 'public/images/StarColony.jpg'),
(280, 'One Piece Online', 'MMORPG', 2, 171023, 'IDR', 'public/images/One_Piece_Online.jpg'),
(281, 'Transformice', 'Fantasy', 1, 120618, 'IDR', 'public/images/Transformice.jpg'),
(282, 'Gear Up', 'Shooter', 1, 173398, 'IDR', 'public/images/Gear_Up.jpg'),
(283, '8BitMMO', 'MMORPG', 1, 293966, 'IDR', 'public/images/8BitMMO.jpg'),
(284, 'Siegelord', 'Strategy', 2, 211196, 'IDR', 'public/images/Siegelord.jpg'),
(285, 'Dungeon Defenders 2', 'Shooter', 1, 111927, 'IDR', 'public/images/Dungeon_Defenders_2.jpg'),
(286, 'Blockade 3D', 'Shooter', 1, 146154, 'IDR', 'public/images/Blockade_3D.jpg'),
(287, 'Eldevin', 'MMORPG', 1, 45828, 'IDR', 'public/images/Eldevin.jpg'),
(288, 'Double Action', 'Shooter', 1, 285817, 'IDR', 'public/images/Double_Action.jpg'),
(289, 'Pox Nora', 'Card Game', 1, 31995, 'IDR', 'public/images/Pox_Nora.jpg'),
(290, 'Counter-Strike Nexon', 'Shooter', 1, 176184, 'IDR', 'public/images/Counter-Strike_Nexon.jpg'),
(291, 'Uncharted Waters Online', 'MMORPG', 1, 41445, 'IDR', 'public/images/Uncharted_Waters_Online.jpg'),
(292, 'ArcheAge', 'MMORPG', 1, 274813, 'IDR', 'public/images/ArcheAge.jpg'),
(293, 'Tribal Wars 2', 'Strategy', 2, 71261, 'IDR', 'public/images/Tribal_Wars_2.jpg'),
(294, 'WAKFU', 'MMORPG', 1, 146599, 'IDR', 'public/images/WAKFU.jpg'),
(295, 'Infinity Wars', 'Card Game', 1, 157166, 'IDR', 'public/images/Infinity_Wars.jpg'),
(296, 'Divine Souls', 'MMORPG', 1, 287020, 'IDR', 'public/images/Divine_Souls.jpg'),
(297, 'Cubic Castles', 'MMO', 1, 23763, 'IDR', 'public/images/Cubic_Castles.jpg'),
(298, 'Creativerse', 'MMO', 1, 155371, 'IDR', 'public/images/Creativerse.jpg'),
(299, 'Royal Quest', 'MMORPG', 1, 196474, 'IDR', 'public/images/Royal_Quest.jpg'),
(300, 'Guns and Robots', 'Shooter', 1, 273256, 'IDR', 'public/images/Guns_and_Robots.jpg'),
(301, 'Bleach Online', 'MMORPG', 2, 208739, 'IDR', 'public/images/Bleach_Online.jpg'),
(302, 'Robocraft', 'MMO', 1, 219570, 'IDR', 'public/images/Robocraft.jpg'),
(303, 'Unturned', 'Shooter', 1, 131066, 'IDR', 'public/images/Unturned.jpg'),
(304, 'Warface', 'Shooter', 1, 87121, 'IDR', 'public/images/Warface.jpg'),
(305, 'Freestyle2: Street Basketball', 'Sports', 1, 87837, 'IDR', 'public/images/Freestyle2:_Street_Basketball.jpg'),
(306, 'Fistful of Frags', 'Shooter', 1, 62977, 'IDR', 'public/images/Fistful_of_Frags.jpg'),
(307, 'GunZ 2: The Second Duel', 'Shooter', 1, 48075, 'IDR', 'public/images/GunZ_2:_The_Second_Duel.jpg'),
(308, 'Archeblade', 'Fighting', 1, 41182, 'IDR', 'public/images/Archeblade.jpg'),
(309, 'Villagers and Heroes', 'MMORPG', 1, 124350, 'IDR', 'public/images/Villagers_and_Heroes.jpg'),
(310, 'Hex', 'Card Game', 1, 123484, 'IDR', 'public/images/Hex.jpg'),
(311, 'Pocket Starships', 'Strategy', 2, 25421, 'IDR', 'public/images/Pocket_Starships.jpg'),
(312, 'Sparta: War of Empires', 'Strategy', 2, 192196, 'IDR', 'public/images/Sparta:_War_of_Empires.jpg'),
(313, 'Smite', 'MOBA', 1, 217982, 'IDR', 'public/images/Smite.jpg'),
(314, 'Dogs of War Online', 'Strategy', 1, 110494, 'IDR', 'public/images/Dogs_of_War_Online.jpg'),
(315, 'Hearthstone: Heroes of Warcraft', 'Card Game', 1, 48705, 'IDR', 'public/images/Hearthstone:_Heroes_of_Warcraft.jpg'),
(316, 'Lucent Heart', 'MMORPG', 1, 292857, 'IDR', 'public/images/Lucent_Heart.jpg'),
(317, 'League of Angels', 'MMORPG', 2, 86573, 'IDR', 'public/images/League_of_Angels.jpg'),
(318, 'Aura Kingdom', 'MMORPG', 1, 153421, 'IDR', 'public/images/Aura_Kingdom.jpg'),
(319, 'Crystal Saga', 'MMORPG', 2, 130948, 'IDR', 'public/images/Crystal_Saga.jpg'),
(320, 'World of Warplanes', 'Shooter', 1, 244845, 'IDR', 'public/images/World_of_Warplanes.jpg'),
(321, 'RIFT', 'MMORPG', 1, 59933, 'IDR', 'public/images/RIFT.jpg'),
(322, 'Path of Exile', 'MMORPG', 1, 83192, 'IDR', 'public/images/Path_of_Exile.jpg'),
(323, 'Soldiers Inc.', 'Strategy', 2, 45347, 'IDR', 'public/images/Soldiers_Inc..jpg'),
(324, 'Nords: Heroes of the North', 'Strategy', 2, 135160, 'IDR', 'public/images/Nords:_Heroes_of_the_North.jpg'),
(325, 'Dota 2', 'MOBA', 1, 238362, 'IDR', 'public/images/Dota_2.jpg'),
(326, 'Ragnarok Online 2', 'MMORPG', 1, 33088, 'IDR', 'public/images/Ragnarok_Online_2.jpg'),
(327, 'Panzar', 'MOBA', 1, 157696, 'IDR', 'public/images/Panzar.jpg'),
(328, 'Kingdom Wars', 'Strategy', 1, 93660, 'IDR', 'public/images/Kingdom_Wars.jpg'),
(329, 'Warframe', 'Shooter', 1, 252515, 'IDR', 'public/images/Warframe.jpg'),
(330, 'Champions of Regnum', 'MMORPG', 1, 121507, 'IDR', 'public/images/Champions_of_Regnum.jpg'),
(331, 'Star Conflict', 'Shooter', 1, 199500, 'IDR', 'public/images/Star_Conflict.jpg'),
(332, 'Rail Nation', 'Strategy', 2, 250819, 'IDR', 'public/images/Rail_Nation.jpg'),
(333, 'Epic Cards Battle', 'Card Game', 1, 213046, 'IDR', 'public/images/Epic_Cards_Battle.jpg'),
(334, 'Age of Wushu', 'MMORPG', 1, 261553, 'IDR', 'public/images/Age_of_Wushu.jpg'),
(335, 'Everquest', 'MMORPG', 1, 235544, 'IDR', 'public/images/Everquest.jpg'),
(336, 'Mabinogi', 'MMORPG', 1, 183336, 'IDR', 'public/images/Mabinogi.jpg'),
(337, 'Stormfall: Age of War', 'Strategy', 2, 175453, 'IDR', 'public/images/Stormfall:_Age_of_War.jpg'),
(338, 'PlanetSide 2', 'Shooter', 1, 241957, 'IDR', 'public/images/PlanetSide_2.jpg'),
(339, 'AirMech', 'Strategy', 1, 114016, 'IDR', 'public/images/AirMech.jpg'),
(340, 'Big Farm', 'Strategy', 2, 267977, 'IDR', 'public/images/Big_Farm.jpg'),
(341, 'Wartune', 'MMORPG', 2, 167523, 'IDR', 'public/images/Wartune.jpg'),
(342, 'Pirate 101', 'MMORPG', 1, 143234, 'IDR', 'public/images/Pirate_101.jpg'),
(343, 'Dino Storm', 'MMORPG', 2, 61331, 'IDR', 'public/images/Dino_Storm.jpg'),
(344, 'The Settlers Online', 'Strategy', 2, 279328, 'IDR', 'public/images/The_Settlers_Online.jpg'),
(345, 'Continent of the Ninth Seal', 'MMORPG', 1, 215016, 'IDR', 'public/images/Continent_of_the_Ninth_Seal.jpg'),
(346, 'Counter-Strike 2', 'Shooter', 1, 272350, 'IDR', 'public/images/Counter-Strike_2.jpg'),
(347, 'Gotham City Impostors', 'Shooter', 1, 292636, 'IDR', 'public/images/Gotham_City_Impostors.jpg'),
(348, 'RPG MO', 'MMORPG', 1, 168936, 'IDR', 'public/images/RPG_MO.jpg'),
(349, 'Realm of the Mad God', 'MMORPG', 1, 62660, 'IDR', 'public/images/Realm_of_the_Mad_God.jpg'),
(350, 'Pirates: Tides of Fortune', 'Strategy', 2, 164849, 'IDR', 'public/images/Pirates:_Tides_of_Fortune.jpg'),
(351, 'Star Wars: The Old Republic', 'MMORPG', 1, 186753, 'IDR', 'public/images/Star_Wars:_The_Old_Republic.jpg'),
(352, 'No More Room in Hell', 'Shooter', 1, 138897, 'IDR', 'public/images/No_More_Room_in_Hell.jpg'),
(353, 'Digimon Masters Online', 'MMORPG', 1, 253702, 'IDR', 'public/images/Digimon_Masters_Online.jpg'),
(354, 'Dragon Nest', 'MMORPG', 1, 201921, 'IDR', 'public/images/Dragon_Nest.jpg'),
(355, 'Drakensang Online', 'MMORPG', 2, 111128, 'IDR', 'public/images/Drakensang_Online.jpg'),
(356, 'Mission Against Terror', 'Shooter', 1, 235112, 'IDR', 'public/images/Mission_Against_Terror.jpg'),
(357, 'Spiral Knights', 'MMORPG', 1, 246468, 'IDR', 'public/images/Spiral_Knights.jpg'),
(358, 'Steel Legions', 'Shooter', 2, 263110, 'IDR', 'public/images/Steel_Legions.jpg'),
(359, 'Asda Global', 'MMORPG', 1, 237513, 'IDR', 'public/images/Asda_Global.jpg'),
(360, 'Brink', 'Shooter', 1, 205351, 'IDR', 'public/images/Brink.jpg'),
(361, 'Allods Online', 'MMORPG', 1, 184957, 'IDR', 'public/images/Allods_Online.jpg'),
(362, 'Elsword', 'MMORPG', 1, 165877, 'IDR', 'public/images/Elsword.jpg'),
(363, 'DC Universe Online', 'MMORPG', 1, 285237, 'IDR', 'public/images/DC_Universe_Online.jpg'),
(364, 'Bloodline Champions', 'MOBA', 1, 204287, 'IDR', 'public/images/Bloodline_Champions.jpg'),
(365, 'GetAmped 2', 'Fighting', 1, 290899, 'IDR', 'public/images/GetAmped_2.jpg'),
(366, 'Dragon Saga', 'MMORPG', 1, 286933, 'IDR', 'public/images/Dragon_Saga.jpg'),
(367, 'Vindictus', 'MMORPG', 1, 36708, 'IDR', 'public/images/Vindictus.jpg'),
(368, 'Aika Online', 'MMORPG', 1, 249070, 'IDR', 'public/images/Aika_Online.jpg'),
(369, 'APB Reloaded', 'Shooter', 1, 56705, 'IDR', 'public/images/APB_Reloaded.jpg'),
(370, 'Mortal Online', 'MMORPG', 1, 94695, 'IDR', 'public/images/Mortal_Online.jpg'),
(371, 'Grand Fantasia', 'MMORPG', 1, 252520, 'IDR', 'public/images/Grand_Fantasia.jpg'),
(372, 'Grepolis', 'Strategy', 2, 230553, 'IDR', 'public/images/Grepolis.jpg'),
(373, 'League of Legends', 'MOBA', 1, 106580, 'IDR', 'public/images/League_of_Legends.jpg'),
(374, 'Twelve Sky 2', 'MMORPG', 1, 109733, 'IDR', 'public/images/Twelve_Sky_2.jpg'),
(375, 'Champions Online', 'MMORPG', 1, 274130, 'IDR', 'public/images/Champions_Online.jpg'),
(376, 'WolfTeam', 'Shooter', 1, 202652, 'IDR', 'public/images/WolfTeam.jpg'),
(377, 'Runes of Magic', 'MMORPG', 1, 274406, 'IDR', 'public/images/Runes_of_Magic.jpg'),
(378, 'theHunter', 'Shooter', 1, 183147, 'IDR', 'public/images/theHunter.jpg'),
(379, 'AION', 'MMORPG', 1, 223765, 'IDR', 'public/images/AION.jpg'),
(380, 'Atlantica Online', 'MMORPG', 1, 218088, 'IDR', 'public/images/Atlantica_Online.jpg'),
(381, 'Florensia', 'MMORPG', 1, 94981, 'IDR', 'public/images/Florensia.jpg'),
(382, '4Story', 'MMORPG', 1, 271980, 'IDR', 'public/images/4Story.jpg'),
(383, 'AdventureQuest Worlds', 'MMORPG', 2, 190950, 'IDR', 'public/images/AdventureQuest_Worlds.jpg'),
(384, 'S4 league', 'Shooter', 1, 170637, 'IDR', 'public/images/S4_league.jpg'),
(385, 'Wizard101', 'MMORPG', 1, 79420, 'IDR', 'public/images/Wizard101.jpg'),
(386, 'Perfect World International', 'MMORPG', 1, 148878, 'IDR', 'public/images/Perfect_World_International.jpg'),
(387, 'Ace Online', 'Shooter', 1, 44909, 'IDR', 'public/images/Ace_Online.jpg'),
(388, 'Rohan: Blood Feud', 'MMORPG', 1, 133874, 'IDR', 'public/images/Rohan:_Blood_Feud.jpg'),
(389, 'Age of Conan: Unchained', 'MMORPG', 1, 87577, 'IDR', 'public/images/Age_of_Conan:_Unchained.jpg'),
(390, 'Ikariam', 'Strategy', 2, 236648, 'IDR', 'public/images/Ikariam.jpg'),
(391, 'Saga', 'Strategy', 1, 229649, 'IDR', 'public/images/Saga.jpg'),
(392, 'Fiesta Online', 'MMORPG', 1, 298935, 'IDR', 'public/images/Fiesta_Online.jpg'),
(393, 'Shaiya', 'MMORPG', 1, 260057, 'IDR', 'public/images/Shaiya.jpg'),
(394, 'Angels Online', 'MMORPG', 1, 290600, 'IDR', 'public/images/Angels_Online.jpg'),
(395, 'Seal Online', 'MMORPG', 1, 142522, 'IDR', 'public/images/Seal_Online.jpg'),
(396, 'Team Fortress 2', 'Shooter', 1, 37691, 'IDR', 'public/images/Team_Fortress_2.jpg'),
(397, 'Rumble Fighter', 'Fighting', 1, 38323, 'IDR', 'public/images/Rumble_Fighter.jpg'),
(398, 'Granado Espada Online', 'MMORPG', 1, 131053, 'IDR', 'public/images/Granado_Espada_Online.jpg'),
(399, '9Dragons', 'MMORPG', 1, 157638, 'IDR', 'public/images/9Dragons.jpg'),
(400, 'Crossfire', 'Shooter', 1, 146178, 'IDR', 'public/images/Crossfire.jpg'),
(401, 'Teeworlds', 'Shooter', 1, 276828, 'IDR', 'public/images/Teeworlds.jpg'),
(402, 'Priston Tale', 'MMORPG', 1, 247321, 'IDR', 'public/images/Priston_Tale.jpg'),
(403, 'Audition Online', 'Social', 1, 146851, 'IDR', 'public/images/Audition_Online.jpg'),
(404, 'Roblox', 'MMO', 1, 58713, 'IDR', 'public/images/Roblox.jpg'),
(405, 'Voyage Century Online', 'MMORPG', 1, 282142, 'IDR', 'public/images/Voyage_Century_Online.jpg'),
(406, 'Metin2', 'MMORPG', 1, 254899, 'IDR', 'public/images/Metin2.jpg'),
(407, 'Dark Orbit Reloaded', 'Shooter', 2, 166214, 'IDR', 'public/images/Dark_Orbit_Reloaded.jpg'),
(408, 'Rappelz', 'MMORPG', 1, 25184, 'IDR', 'public/images/Rappelz.jpg'),
(409, 'Grand Prix Racing Online', 'Strategy', 2, 235437, 'IDR', 'public/images/Grand_Prix_Racing_Online.jpg'),
(410, 'Astro Empires', 'Strategy', 2, 274733, 'IDR', 'public/images/Astro_Empires.jpg'),
(411, 'Dungeons and Dragons Online', 'MMORPG', 1, 287574, 'IDR', 'public/images/Dungeons_and_Dragons_Online.jpg'),
(412, 'RF Online', 'MMORPG', 1, 240118, 'IDR', 'public/images/RF_Online.jpg'),
(413, 'Urban Rivals', 'Card Game', 2, 272803, 'IDR', 'public/images/Urban_Rivals.jpg'),
(414, 'Flyff: Fly For Fun', 'MMORPG', 1, 140111, 'IDR', 'public/images/Flyff:_Fly_For_Fun.jpg'),
(415, 'Dream of Mirror Online', 'MMORPG', 1, 292069, 'IDR', 'public/images/Dream_of_Mirror_Online.jpg'),
(416, 'Imperia Online', 'Strategy', 2, 229630, 'IDR', 'public/images/Imperia_Online.jpg'),
(417, 'MapleStory', 'MMORPG', 1, 257933, 'IDR', 'public/images/MapleStory.jpg'),
(418, 'Shot Online', 'Sports', 1, 162413, 'IDR', 'public/images/Shot_Online.jpg'),
(419, 'Everquest 2', 'MMORPG', 1, 69109, 'IDR', 'public/images/Everquest_2.jpg'),
(420, 'Dofus', 'MMORPG', 1, 192909, 'IDR', 'public/images/Dofus.jpg'),
(421, 'Travian', 'Strategy', 2, 291840, 'IDR', 'public/images/Travian.jpg'),
(422, 'Ryzom', 'MMORPG', 1, 250481, 'IDR', 'public/images/Ryzom.jpg'),
(423, 'Kal Online', 'MMORPG', 1, 123549, 'IDR', 'public/images/Kal_Online.jpg'),
(424, 'Lineage 2', 'MMORPG', 1, 55290, 'IDR', 'public/images/Lineage_2.jpg'),
(425, 'Red Stone Online', 'MMORPG', 1, 206066, 'IDR', 'public/images/Red_Stone_Online.jpg'),
(426, 'Mu Online', 'MMORPG', 1, 39739, 'IDR', 'public/images/Mu_Online.jpg'),
(427, 'Second Life', 'Social', 1, 186325, 'IDR', 'public/images/Second_Life.jpg'),
(428, 'Ragnarok Online', 'MMORPG', 1, 105565, 'IDR', 'public/images/Ragnarok_Online.jpg'),
(429, 'Entropia Universe', 'MMORPG', 1, 211217, 'IDR', 'public/images/Entropia_Universe.jpg'),
(430, 'Habbo', 'Social', 2, 85369, 'IDR', 'public/images/Habbo.jpg'),
(431, 'Anarchy Online', 'MMORPG', 1, 208645, 'IDR', 'public/images/Anarchy_Online.jpg'),
(432, 'The Lord of the Rings Online', 'MMORPG', 1, 38940, 'IDR', 'public/images/The_Lord_of_the_Rings_Online.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `order_uid` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `game_id` int(11) DEFAULT NULL,
  `amount` int(11) NOT NULL,
  `currency` varchar(3) NOT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `status` enum('pending','paid','cancelled') NOT NULL DEFAULT 'pending',
  `type` enum('game_purchase','top_up') NOT NULL DEFAULT 'game_purchase',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_uid`, `user_id`, `game_id`, `amount`, `currency`, `payment_method`, `status`, `type`, `created_at`, `updated_at`) VALUES
(1, 'ORD-046D8DED9C058B29', 3, 3, 5, 'USD', 'qris_simulation', 'paid', 'game_purchase', '2025-12-08 11:40:29', '2025-12-08 11:40:33'),
(2, 'ORD-2DED9CEEE92239FE', 1, 3, 5, 'USD', NULL, 'pending', 'game_purchase', '2025-12-08 11:51:13', '2025-12-08 11:51:13'),
(3, 'ORD-8AE8492281462122', 1, 27, 238946, 'IDR', 'qris_simulation', 'paid', 'game_purchase', '2025-12-08 15:21:18', '2025-12-08 15:21:22'),
(4, 'ORD-CEE6C6ABF828BBD7', 4, 123, 117485, 'IDR', NULL, 'pending', 'game_purchase', '2025-12-08 21:34:25', '2025-12-08 21:34:25'),
(5, 'ORD-C25662740704AF64', 4, 57, 214727, 'IDR', 'qris_simulation', 'paid', 'game_purchase', '2025-12-08 21:35:45', '2025-12-08 21:36:20');

-- --------------------------------------------------------

--
-- Table structure for table `platforms`
--

CREATE TABLE `platforms` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `platforms`
--

INSERT INTO `platforms` (`id`, `name`) VALUES
(1, 'PC'),
(2, 'PlayStation'),
(3, 'Xbox'),
(4, 'Nintendo Switch'),
(5, 'Mobile');

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `rating` tinyint(1) NOT NULL CHECK (`rating` >= 1 and `rating` <= 5),
  `review` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`id`, `user_id`, `game_id`, `rating`, `review`, `created_at`) VALUES
(1, 3, 3, 4, 'Hmmm 🥰 , Wangi Wangi', '2025-12-08 11:49:56');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`) VALUES
(1, 'Admin User', 'admin@gmail.com', '$2y$12$u8H.68ZbwamAkPVqlvDLXOtLz0QZQE5wk4F.kEeWZhrpgsA7BWyHa', 'admin'),
(2, 'Regular User', 'user@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user'),
(3, 'yohanesoktanio', 'yohanesoktanio@outlook.com', '$2y$10$QEemEoSJm7mN9UQckn6DDeAbgjBnDb0hDBzb8WaIDSGsI8MWDqH12', 'user'),
(4, 'Ahmad Dhani', 'Ahmaddhani@gmail.com', '$2y$10$JH1WfnUsqoZkLsXpH94G5OyykSYYgspoCTGyD5oMMo2/zGVHP3GNa', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`id`),
  ADD KEY `platform_id` (`platform_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `order_uid` (`order_uid`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `game_id` (`game_id`);

--
-- Indexes for table `platforms`
--
ALTER TABLE `platforms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_game_rating` (`user_id`,`game_id`),
  ADD KEY `game_id` (`game_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `games`
--
ALTER TABLE `games`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=433;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `platforms`
--
ALTER TABLE `platforms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `games`
--
ALTER TABLE `games`
  ADD CONSTRAINT `games_ibfk_1` FOREIGN KEY (`platform_id`) REFERENCES `platforms` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_fk_game` FOREIGN KEY (`game_id`) REFERENCES `games` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `orders_fk_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `ratings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ratings_ibfk_2` FOREIGN KEY (`game_id`) REFERENCES `games` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
