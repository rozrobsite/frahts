<?php

class m130126_151545_create_vehicle_shipment_table extends CDbMigration
{
	public function safeUp()
	{
		$this->execute('
				CREATE TABLE IF NOT EXISTS `vehicle_shipment` (
					`vehicle_id` bigint(20) NOT NULL,
					`shipment_id` tinyint(4) NOT NULL,
					PRIMARY KEY (`vehicle_id`, `shipment_id`)
				  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
				  
				ALTER TABLE `vehicle_shipment` ADD FOREIGN KEY (`vehicle_id`) REFERENCES `vehicle`(`id`) ON DELETE NO ACTION ;
				ALTER TABLE `vehicle_shipment` ADD FOREIGN KEY (`shipment_id`) REFERENCES `shipment`(`id`) ON DELETE NO ACTION ;
			'
		);

		return true;
	}

	public function safeDown()
	{
		$this->execute('DROP TABLE IF EXISTS `vehicle_shipment`');
		
		return true;
	}
}