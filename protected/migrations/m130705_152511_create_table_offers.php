<?php

class m130705_152511_create_table_offers extends CDbMigration
{
	public function safeUp()
	{
		$this->execute('
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

			'
		);

		return true;
	}

	public function safeDown()
	{
		$this->execute('DROP TABLE IF EXISTS `offers`');

		return true;
	}
}