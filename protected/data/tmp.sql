ALTER TABLE profiles ADD COLUMN created_at int(11) NULL DEFAULT NULL;
ALTER TABLE profiles ADD COLUMN updated_at int(11) NULL DEFAULT NULL;

CREATE TABLE IF NOT EXISTS `azs_trademark` (
					`id` int(11) NOT NULL AUTO_INCREMENT,
					`name_ru` varchar(128) NOT NULL,
					`name_ua` varchar(128) NOT NULL,
					PRIMARY KEY (`id`)
				  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

ALTER TABLE photos ADD COLUMN size_superbig varchar(32) NULL DEFAULT NULL;

ALTER TABLE city MODIFY COLUMN latitude DOUBLE;
ALTER TABLE city MODIFY COLUMN longitude DOUBLE;

CREATE TABLE IF NOT EXISTS `messages` (
					`id` bigint(20) NOT NULL AUTO_INCREMENT,
					`author_id` int(11) unsigned DEFAULT NULL,
					`receiving_user_id` int(11) unsigned DEFAULT NULL,
					`message` text DEFAULT "",
					`created_at` int(11) NOT NULL,
					`is_deleted` tinyint(2) DEFAULT 0,
					PRIMARY KEY (`id`),
					KEY `author_id` (`author_id`),
					KEY `receiving_user_id` (`receiving_user_id`)
				  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
ALTER TABLE `messages` ADD FOREIGN KEY (`author_id`) REFERENCES `users`(`id`) ON DELETE SET NULL ON UPDATE RESTRICT;
ALTER TABLE `messages` ADD FOREIGN KEY (`receiving_user_id`) REFERENCES `users`(`id`) ON DELETE SET NULL ON UPDATE RESTRICT;
ALTER TABLE messages ADD COLUMN is_view tinyint(1) DEFAULT 0;

CREATE TABLE IF NOT EXISTS `notes` (
					`id` bigint(20) NOT NULL AUTO_INCREMENT,
					`user_id` int(11) unsigned DEFAULT NULL,
					`type` VARCHAR(128) NOT NULL,
					`start` DATETIME NOT NULL,
					`end` DATETIME NOT NULL,
					`is_show` tinyint(2) DEFAULT 0,
					PRIMARY KEY (`id`),
					KEY `user_id` (`user_id`)
				  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
ALTER TABLE `notes` ADD FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE SET NULL ON UPDATE RESTRICT;