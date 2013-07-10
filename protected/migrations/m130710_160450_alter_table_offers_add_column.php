<?php

class m130710_160450_alter_table_offers_add_column extends CDbMigration
{
	public function safeUp()
	{
		$this->execute('
				ALTER TABLE `offers` ADD `cost` INT( 11 ) NULL DEFAULT NULL ,
					ADD  `currency_id` INT( 11 ) NULL DEFAULT NULL ,
					ADD INDEX (`currency_id`);

				ALTER TABLE `offers` ADD FOREIGN KEY (`currency_id`) REFERENCES  `currency` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;
			'
		);

		return true;
	}

	public function down()
	{
		echo "m130710_160450_alter_table_offers_add_column does not support migration down.\n";
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