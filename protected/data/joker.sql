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

