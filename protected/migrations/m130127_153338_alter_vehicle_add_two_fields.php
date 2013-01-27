<?php

class m130127_153338_alter_vehicle_add_two_fields extends CDbMigration
{
	public function safeUp()
	{
		$this->execute('
				ALTER TABLE vehicle ADD COLUMN permissions varchar(255) NULL DEFAULT NULL;
				ALTER TABLE vehicle ADD COLUMN shipments varchar(255) NULL DEFAULT NULL;
			'
		);
		
		return true;
	}

	public function safeDown()
	{
		echo "m130127_153338_alter_vehicle_add_two_fields does not support migration down.\n";
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