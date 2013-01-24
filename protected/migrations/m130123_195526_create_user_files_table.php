<?php

class m130123_195526_create_user_files_table extends CDbMigration
{
	public function safeUp()
	{
		$this->execute('
				CREATE TABLE IF NOT EXISTS `user_files` (
					`id` bigint(20) NOT NULL AUTO_INCREMENT,
					`user_id` int(11) unsigned DEFAULT NULL,
					`description` varchar(255) DEFAULT "",
					`name` varchar(255) NOT NULL,
					`file_type_id` tinyint(2) NOT NULL,
					PRIMARY KEY (`id`),
					KEY `user_id` (`user_id`),
					KEY `file_type_id` (`file_type_id`)
				  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
				  
				ALTER TABLE `user_files`
					ADD CONSTRAINT `user_files_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
					ADD CONSTRAINT `user_files_ibfk_2` FOREIGN KEY (`file_type_id`) REFERENCES `file_types` (`id`) ON DELETE SET NULL;
			'
		);

		return true;
	}

	public function safeDown()
	{
		$this->execute('DROP TABLE IF EXISTS `user_files`');
		
		return true;
	}
}