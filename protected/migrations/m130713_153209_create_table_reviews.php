<?php

class m130713_153209_create_table_reviews extends CDbMigration
{
	public function safeUp()
	{
		$this->execute('
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

			'
		);
	}

	public function safeDown()
	{
		echo "m130713_153209_create_table_reviews does not support migration down.\n";
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