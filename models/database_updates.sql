-- SQL additions for database.sql

-- 1. Modify 'games' table for multi-currency support
ALTER TABLE `games`
  ADD `currency` VARCHAR(3) NOT NULL DEFAULT 'USD' AFTER `price`,
  MODIFY `price` INT(11) NOT NULL;

-- This command is optional but recommended to convert existing prices.
-- It assumes your old prices were in major units (e.g., dollars) and converts them to minor units (e.g., cents).
-- UPDATE `games` SET `price` = `price` * 100 WHERE `currency` IN ('USD', 'EUR');

-- 2. Re-create the 'orders' table for the new payment system
DROP TABLE IF EXISTS `orders`;

CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_uid` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `game_id` int(11) DEFAULT NULL,
  `amount` int(11) NOT NULL,
  `currency` varchar(3) NOT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `status` enum('pending','paid','cancelled') NOT NULL DEFAULT 'pending',
  `type` enum('game_purchase','top_up') NOT NULL DEFAULT 'game_purchase',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `order_uid` (`order_uid`),
  KEY `user_id` (`user_id`),
  KEY `game_id` (`game_id`),
  CONSTRAINT `orders_fk_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `orders_fk_game` FOREIGN KEY (`game_id`) REFERENCES `games` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
