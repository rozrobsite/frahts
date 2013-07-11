<?php

class m130711_162844_alter_table_offers_add_columns extends CDbMigration
{
	public function safeUp()
	{
		$this->execute('
				ALTER TABLE `offers` ADD `offer_vehicle_id` BIGINT( 20 ) NULL DEFAULT NULL,
					ADD `offer_good_id` BIGINT( 20 ) NULL DEFAULT NULL;

				ALTER TABLE `offers` ADD INDEX (`offer_vehicle_id`);
				ALTER TABLE `offers` ADD INDEX (`offer_good_id`);

				ALTER TABLE `offers` ADD FOREIGN KEY (`offer_vehicle_id`) REFERENCES `vehicle` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;
				ALTER TABLE `offers` ADD FOREIGN KEY (`offer_good_id`) REFERENCES `goods` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;
			'
		);

		return true;
	}

	public function safeDown()
	{
		echo "m130711_162844_alter_table_offers_add_columns does not support migration down.\n";
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