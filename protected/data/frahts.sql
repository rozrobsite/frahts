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

ALTER TABLE `docs` CHANGE `text` `text` MEDIUMTEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;

--05.07.2013
CREATE TABLE IF NOT EXISTS `offers` (
					`id` bigint(20) NOT NULL AUTO_INCREMENT,
					`author_id` int(11) unsigned DEFAULT NULL,
					`receiving_user_id` int(11) unsigned DEFAULT NULL,
					`good_id` bigint(20) DEFAULT NULL,
					`vehicle_id` bigint(20) DEFAULT NULL,
					`created_at` int(11) NOT NULL,
					`result` tinyint(2) DEFAULT 1,
					`result_date_at` int(11) DEFAULT NULL,
					PRIMARY KEY (`id`),
					KEY `author_id` (`author_id`),
					KEY `receiving_user_id` (`receiving_user_id`),
					KEY `good_id` (`good_id`),
					KEY `vehicle_id` (`vehicle_id`)
				  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
ALTER TABLE `offers` ADD FOREIGN KEY (`author_id`) REFERENCES `users`(`id`) ON DELETE CASCADE ON UPDATE RESTRICT;
ALTER TABLE `offers` ADD FOREIGN KEY (`receiving_user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE ON UPDATE RESTRICT;
ALTER TABLE `offers` ADD FOREIGN KEY (`good_id`) REFERENCES `goods`(`id`) ON DELETE CASCADE ON UPDATE RESTRICT;
ALTER TABLE `offers` ADD FOREIGN KEY (`vehicle_id`) REFERENCES `vehicle`(`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--09.07.2013
ALTER TABLE offers ADD COLUMN is_view tinyint(1) DEFAULT 0;

--10.07.2013
ALTER TABLE `offers` ADD `cost` INT( 11 ) NULL DEFAULT NULL ,
					ADD `currency_id` INT( 11 ) NULL DEFAULT NULL ,
					ADD INDEX (`currency_id`);
ALTER TABLE `offers` ADD FOREIGN KEY (`currency_id`) REFERENCES  `currency` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--11.07.2013
ALTER TABLE `offers` ADD `offer_vehicle_id` BIGINT( 20 ) NULL DEFAULT NULL, ADD `offer_good_id` BIGINT( 20 ) NULL DEFAULT NULL;
ALTER TABLE `offers` ADD INDEX (`offer_vehicle_id`);
ALTER TABLE `offers` ADD INDEX (`offer_good_id`);
ALTER TABLE `offers` ADD FOREIGN KEY (`offer_vehicle_id`) REFERENCES `vehicle` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;
ALTER TABLE `offers` ADD FOREIGN KEY (`offer_good_id`) REFERENCES `goods` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--13.07.2013
CREATE TABLE IF NOT EXISTS `reviews` (
					`id` bigint(20) NOT NULL AUTO_INCREMENT,
					`author_id` int(11) unsigned DEFAULT NULL,
					`receiving_user_id` int(11) unsigned DEFAULT NULL,
					`rating` tinyint(2) DEFAULT 0,
					`text` text(560) DEFAULT "",
					`created_at` int(11) NOT NULL,
					`is_deleted` tinyint(2) DEFAULT 0,
					PRIMARY KEY (`id`),
					KEY `author_id` (`author_id`),
					KEY `receiving_user_id` (`receiving_user_id`)
				  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
ALTER TABLE `reviews` ADD FOREIGN KEY (`author_id`) REFERENCES `users`(`id`) ON DELETE SET NULL ON UPDATE RESTRICT;
ALTER TABLE `reviews` ADD FOREIGN KEY (`receiving_user_id`) REFERENCES `users`(`id`) ON DELETE SET NULL ON UPDATE RESTRICT;

--15.07.2013
CREATE TABLE IF NOT EXISTS `parser_emails` (
					`id` bigint(20) NOT NULL AUTO_INCREMENT,
					`email` varchar(32) DEFAULT NULL,
					PRIMARY KEY (`id`)
				  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

--21.07.2013
ALTER TABLE `offers` ADD `review_id` BIGINT( 20 ) NULL DEFAULT NULL;
ALTER TABLE `offers` ADD INDEX (`review_id`);
ALTER TABLE `offers` ADD FOREIGN KEY (`review_id`) REFERENCES `reviews` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--22.07.2013
CREATE TABLE IF NOT EXISTS `mailing` (
					`id` bigint(20) NOT NULL AUTO_INCREMENT,
					`subject` varchar(255) NOT NULL,
					`text` text NOT NULL,
					`created_at` int(11) NOT NULL,
					PRIMARY KEY (`id`)
				  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

--06.08.2013
ALTER TABLE `parser_emails` ADD `is_sent` TINYINT( 1 ) NULL DEFAULT 0;
UPDATE `parser_emails` SET is_sent = 1 WHERE id < 495

--05.09.2013
CREATE TABLE  `cron_mailing` (
					`id` INT NOT NULL ,
					`last_id` INT NOT NULL,
					created_at INT NOT NULL
					) ENGINE = INNODB CHARACTER SET utf8 COLLATE utf8_general_ci;

INSERT INTO cron_mailing (id) VALUES (1);
INSERT INTO cron_mailing (id) VALUES (2);
INSERT INTO cron_mailing (id) VALUES (3);

--11.09.2013
CREATE TABLE `parser_promua` (
						id INT NOT NULL ,
						name VARCHAR (255) DEFAULT NULL,
						email VARCHAR (255) DEFAULT NULL
					) ENGINE = INNODB CHARACTER SET utf8 COLLATE utf8_general_ci;

--12.09.2013
ALTER TABLE `goods` ADD `distance` INT(6) NULL DEFAULT 0;

--19.09.2013 no frahts.com
CREATE TABLE partners (
						id INT NOT NULL AUTO_INCREMENT,
						user_id INT (11) UNSIGNED NOT NULL,
						partner_id INT(11) UNSIGNED NOT NULL,
						PRIMARY KEY (id),
						KEY user_id (user_id),
						KEY partner_id (partner_id)
					) ENGINE = InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

ALTER TABLE partners ADD FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE ON UPDATE RESTRICT;
ALTER TABLE partners ADD FOREIGN KEY (partner_id) REFERENCES users(id) ON DELETE CASCADE ON UPDATE RESTRICT;

--20.09.2013
CREATE TABLE user_tags(
					id INT(11) DEFAULT NULL,
					text VARCHAR(255) DEFAULT NULL,
					FULLTEXT INDEX search_text (text)
				  ) ENGINE = MYISAM

--13.11.2011
ALTER TABLE `feedback` ADD `created_at` INT(11) NULL DEFAULT NULL;
