-- 18.11.2013
CREATE TABLE IF NOT EXISTS `joker_users` (
					`id` bigint(20) NOT NULL AUTO_INCREMENT,
					`email` varchar(254) NOT NULL,
					`password` varchar(64) NOT NULL,
					`logins` int(10) unsigned DEFAULT 0,
					`last_login` int(10) unsigned DEFAULT NULL,
					`enabled` tinyint(2) NOT NULL DEFAULT 1,
					PRIMARY KEY (`id`)
				  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

-- 19.11.2013
ALTER TABLE joker_users ADD COLUMN s_code VARCHAR(32) NOT NULL;

-- 20.11.2013
CREATE TABLE IF NOT EXISTS `joker_profiles` (
					`id` bigint(20) NOT NULL AUTO_INCREMENT,
					`user_id` bigint(20) NOT NULL,
					`last_name` varchar(64) NOT NULL,
					`first_name` varchar(32) NOT NULL,
					`middle_name` varchar(64) DEFAULT NULL,
					`mobile` varchar(15) NOT NULL,
					`phone` varchar(25) DEFAULT NULL,
					`skype` varchar(25) DEFAULT NULL,
					`icq` varchar(32) DEFAULT NULL,
					PRIMARY KEY (`id`),
                                        KEY `user_id` (`user_id`)
				  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

ALTER TABLE `joker_profiles` ADD CONSTRAINT `joker_profiles_joker_users_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `joker_users` (`id`) ON DELETE CASCADE;

CREATE TABLE IF NOT EXISTS `joker_business_type` (
					`id` tinyint(2) NOT NULL,
					`name` varchar(64) NOT NULL,
					`order` tinyint(2) NOT NULL DEFAULT 0,
					PRIMARY KEY (`id`)
				  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

				  INSERT INTO `joker_business_type`(id, name) VALUES (1, "Автомагазин");
				  INSERT INTO `joker_business_type`(id, name) VALUES (2, "СТО");
				  INSERT INTO `joker_business_type`(id, name) VALUES (3, "Шиномонтаж");
				  INSERT INTO `joker_business_type`(id, name) VALUES (4, "Автомойка");
				  INSERT INTO `joker_business_type`(id, name) VALUES (5, "Кафе");
				  INSERT INTO `joker_business_type`(id, name) VALUES (6, "Гостиница");
				  INSERT INTO `joker_business_type`(id, name) VALUES (7, "GPS слежение");
				  INSERT INTO `joker_business_type`(id, name) VALUES (8, "Страхование");

CREATE TABLE IF NOT EXISTS `joker_organizations` (
					`id` bigint(20) NOT NULL AUTO_INCREMENT,
					`user_id` bigint(20) NOT NULL,
					`name` varchar(254) NOT NULL,
					`description` text(1024) NOT NULL,
					`country_id` int(10) unsigned DEFAULT NULL,
					`region_id` int(10) unsigned DEFAULT NULL,
					`city_id` int(11) unsigned DEFAULT NULL,
					`address` varchar(128) NOT NULL,
					`mobile` varchar(15) NOT NULL,
					`phone` varchar(25) DEFAULT NULL,
					`email` varchar(254) DEFAULT NULL,
					`skype` varchar(25) DEFAULT NULL,
					`site` varchar(254) DEFAULT NULL,
					`discount` float DEFAULT NULL,
					PRIMARY KEY (`id`),
					KEY `user_id` (`user_id`),
					KEY `country_id` (`country_id`),
					KEY `region_id` (`region_id`),
					KEY `city_id` (`city_id`)
				  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

ALTER TABLE `joker_organizations` ADD CONSTRAINT `joker_organizations_joker_users_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `joker_users` (`id`) ON DELETE CASCADE;
ALTER TABLE `joker_organizations` ADD CONSTRAINT `joker_organizations_joker_country_ibfk_3` FOREIGN KEY (`country_id`) REFERENCES `country` (`id`) ON DELETE SET NULL;
ALTER TABLE `joker_organizations` ADD CONSTRAINT `joker_organizations_joker_region_ibfk_4` FOREIGN KEY (`region_id`) REFERENCES `region` (`id`) ON DELETE SET NULL;
ALTER TABLE `joker_organizations` ADD CONSTRAINT `joker_organizations_joker_city_ibfk_5` FOREIGN KEY (`city_id`) REFERENCES `city` (`id`) ON DELETE SET NULL;

CREATE TABLE IF NOT EXISTS `joker_vendibles` (
					`id` int(11) NOT NULL AUTO_INCREMENT,
					`organization_id` bigint(20) NOT NULL,
					`name` varchar(254) NOT NULL,
					`description` varchar(254) NOT NULL,
					`cost` float NOT NULL,
					`discount` float DEFAULT NULL,
					PRIMARY KEY (`id`),
					KEY `organization_id` (`organization_id`)
				  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

ALTER TABLE `joker_vendibles` ADD CONSTRAINT `joker_vendibles_joker_organizations_ibfk_1` FOREIGN KEY (`organization_id`) REFERENCES `joker_organizations` (`id`) ON DELETE CASCADE;

ALTER TABLE joker_organizations ADD COLUMN latitude double NOT NULL;
ALTER TABLE joker_organizations ADD COLUMN longitude double NOT NULL;

-- 21.11.2013
ALTER TABLE joker_profiles ADD COLUMN created_at INT(11) NOT NULL;

ALTER TABLE joker_organizations ADD COLUMN logo VARCHAR(24) DEFAULT NULL;

-- 22.11.2013
CREATE TABLE IF NOT EXISTS `joker_organization_business_type` (
					`id` bigint(20) NOT NULL AUTO_INCREMENT,
					`organization_id` bigint(20) NOT NULL,
					`business_type_id` tinyint(2) NOT NULL,
					PRIMARY KEY (`organization_id`, `business_type_id`),
					KEY `id` (`id`)
				  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

ALTER TABLE `joker_organization_business_type` ADD CONSTRAINT `joker_organization_business_type_joker_organizations_ibfk_1` FOREIGN KEY (`organization_id`) REFERENCES `joker_organizations` (`id`) ON DELETE CASCADE;
ALTER TABLE `joker_organization_business_type` ADD CONSTRAINT `joker_organization_business_type_joker_business_type_ibfk_2` FOREIGN KEY (`business_type_id`) REFERENCES `joker_business_type` (`id`) ON DELETE CASCADE;

-- 02.12.2013
ALTER TABLE joker_employee ADD COLUMN created_at INT DEFAULT NULL;
ALTER TABLE joker_employee ADD COLUMN updated_at INT DEFAULT NULL;

-- 09.12.2013
ALTER TABLE joker_vendibles ADD COLUMN created_at INT DEFAULT NULL;
ALTER TABLE joker_vendibles ADD COLUMN updated_at INT DEFAULT NULL;

CREATE TABLE IF NOT EXISTS `joker_currency` (
					`id` INT NOT NULL AUTO_INCREMENT,
					`name` VARCHAR(32) NOT NULL,
					PRIMARY KEY (`id`)
				  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

                INSERT INTO joker_currency (name) VALUES ("грн.");
                INSERT INTO joker_currency (name) VALUES ("руб.");
                INSERT INTO joker_currency (name) VALUES ("$");
                INSERT INTO joker_currency (name) VALUES ("евро");
                INSERT INTO joker_currency (name) VALUES ("у.е.");

ALTER TABLE joker_vendibles ADD COLUMN currency_id INT DEFAULT NULL;
ALTER TABLE `joker_vendibles` ADD FOREIGN KEY (`currency_id`) REFERENCES `joker_currency`(`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

ALTER TABLE joker_organizations ADD COLUMN enabled TINYINT(1) DEFAULT 1;

CREATE TABLE joker_tags(
					id INT(11) DEFAULT NULL,
					text VARCHAR(255) DEFAULT NULL,
					FULLTEXT INDEX search_text (text)
				  ) ENGINE = MYISAM