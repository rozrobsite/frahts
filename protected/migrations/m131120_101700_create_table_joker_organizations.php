<?php

class m131120_101700_create_table_joker_organizations extends CDbMigration
{
	public function safeUp()
	{
		$this->execute('
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
					KEY `business_type_id` (`business_type_id`),
					KEY `country_id` (`country_id`),
					KEY `region_id` (`region_id`),
					KEY `city_id` (`city_id`)
				  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
                                  
				ALTER TABLE `joker_organizations` ADD CONSTRAINT `joker_organizations_joker_users_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `joker_users` (`id`) ON DELETE CASCADE;
				ALTER TABLE `joker_organizations` ADD CONSTRAINT `joker_organizations_joker_country_ibfk_3` FOREIGN KEY (`country_id`) REFERENCES `country` (`id`) ON DELETE SET NULL;
				ALTER TABLE `joker_organizations` ADD CONSTRAINT `joker_organizations_joker_region_ibfk_4` FOREIGN KEY (`region_id`) REFERENCES `region` (`id`) ON DELETE SET NULL;
				ALTER TABLE `joker_organizations` ADD CONSTRAINT `joker_organizations_joker_city_ibfk_5` FOREIGN KEY (`city_id`) REFERENCES `city` (`id`) ON DELETE SET NULL;
			'
		);
		
		return true;
	}

	public function safeDown()
	{
		echo "m131120_101700_create_table_joker_organizations does not support migration down.\n";
		return true;
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}