<?php

class m130630_100353_create_table_notes extends CDbMigration
{

	public function safeUp()
	{
		$this->execute('
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
			'
		);

		return true;
	}

	public function safeDown()
	{
		$this->execute('DROP TABLE IF EXISTS `notes`');

		return true;
	}

}