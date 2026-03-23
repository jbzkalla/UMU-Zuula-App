CREATE TABLE IF NOT EXISTS `item_images` (
  `id` bigint(30) NOT NULL AUTO_INCREMENT,
  `item_id` bigint(30) NOT NULL,
  `image_path` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  FOREIGN KEY (`item_id`) REFERENCES `item_list`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `claims` (
  `id` bigint(30) NOT NULL AUTO_INCREMENT,
  `item_id` bigint(30) NOT NULL,
  `user_id` int(50) NOT NULL,
  `proof_description` text NOT NULL,
  `proof_file_path` text DEFAULT NULL,
  `status` tinyint(2) NOT NULL DEFAULT 0 COMMENT '0:Pending, 1:Approved, 2:Rejected, 3:Collected',
  `admin_note` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  FOREIGN KEY (`item_id`) REFERENCES `item_list`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `messages` (
  `id` bigint(30) NOT NULL AUTO_INCREMENT,
  `sender_id` int(50) NOT NULL,
  `receiver_id` int(50) NOT NULL,
  `report_id` bigint(30) DEFAULT NULL,
  `claim_id` bigint(30) DEFAULT NULL,
  `message` text NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  FOREIGN KEY (`sender_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`receiver_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `notifications` (
  `id` bigint(30) NOT NULL AUTO_INCREMENT,
  `user_id` int(50) NOT NULL,
  `title` varchar(250) NOT NULL,
  `message` text NOT NULL,
  `link` text DEFAULT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `feedback` (
  `id` bigint(30) NOT NULL AUTO_INCREMENT,
  `user_id` int(50) DEFAULT NULL,
  `rating` int(1) NOT NULL,
  `category` varchar(100) NOT NULL,
  `comment` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `audit_logs` (
  `id` bigint(30) NOT NULL AUTO_INCREMENT,
  `user_id` int(50) DEFAULT NULL,
  `action` varchar(250) NOT NULL,
  `details` text DEFAULT NULL,
  `ip_address` varchar(50) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `password_resets` (
  `id` bigint(30) NOT NULL AUTO_INCREMENT,
  `email` varchar(250) NOT NULL,
  `token` varchar(64) NOT NULL,
  `expires_at` datetime NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(128) NOT NULL,
  `user_id` int(50) DEFAULT NULL,
  `ip_address` varchar(50) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `last_activity` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
