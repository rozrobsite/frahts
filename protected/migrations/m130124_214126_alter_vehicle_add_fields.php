<?php

class m130124_214126_alter_vehicle_add_fields extends CDbMigration
{
	public function safeUp()
	{
		$this->execute('
				ALTER TABLE vehicle ADD COLUMN license_plate varchar(32) NULL DEFAULT NULL;
				ALTER TABLE vehicle ADD COLUMN number_trailer varchar(32) NULL DEFAULT NULL;
				ALTER TABLE vehicle ADD COLUMN number_semitrailer varchar(32) NULL DEFAULT NULL;
			'
		);
		
		return true;
	}

	public function safeDown()
	{
		echo "m130124_214126_alter_vehicle_add_fields does not support migration down.\n";
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