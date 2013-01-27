<?php

class m130126_125555_alter_vehicle_add_columns extends CDbMigration
{
	public function safeUp()
	{
		$this->execute('
				ALTER TABLE vehicle ADD COLUMN is_deleted tinyint(1) NOT NULL DEFAULT 0;
				ALTER TABLE vehicle ADD COLUMN is_verification tinyint(1) NOT NULL DEFAULT 1;
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