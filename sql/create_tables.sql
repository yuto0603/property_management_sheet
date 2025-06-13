-- create_tables.sql
-- monitor_box テーブルの作成
CREATE TABLE `monitor_box` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `label` varchar(20) NOT NULL,
  `status` enum('貸出中','空き') NOT NULL DEFAULT '空き',
  `current_user` varchar(50) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- monitor_log テーブルの作成
CREATE TABLE `monitor_log` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `monitor_id` int(11) UNSIGNED NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `action` enum('貸出','返却') NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_monitor_id` (`monitor_id`),
  CONSTRAINT `fk_monitor_id` FOREIGN KEY (`monitor_id`) REFERENCES `monitor_box` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;