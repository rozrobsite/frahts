<?php

class m131119_162126_create_table_joker_profiles extends CDbMigration
{
	public function up()
	{
            $this->execute('
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
			'
		);
		
		return true;
	}

	public function down()
	{
		echo "m131119_162126_create_table_joker_profiles does not support migration down.\n";
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