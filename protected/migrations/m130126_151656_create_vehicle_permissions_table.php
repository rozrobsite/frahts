<?php

class m130126_151656_create_vehicle_permissions_table extends CDbMigration
{
	public function safeUp()
	{
		$this->execute('
				CREATE TABLE IF NOT EXISTS `vehicle_permissions` (
					`vehicle_id` bigint(20) NOT NULL,
					`permission_id` tinyint(4) NOT NULL,
					PRIMARY KEY (`vehicle_id`, `permission_id`)
				  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
				  
				ALTER TABLE `vehicle_permissions` ADD FOREIGN KEY (`vehicle_id`) REFERENCES `vehicle`(`id`) ON DELETE NO ACTION ;
				ALTER TABLE `vehicle_permissions` ADD FOREIGN KEY (`permission_id`) REFERENCES `permissions`(`id`) ON DELETE NO ACTION ;
			'
		);

		return true;
	}

	public function safeDown()
	{
		$this->execute('DROP TABLE IF EXISTS `vehicle_permissions`');
		
		return true;
	}
}