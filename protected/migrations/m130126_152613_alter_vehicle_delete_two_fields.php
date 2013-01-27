<?php

class m130126_152613_alter_vehicle_delete_two_fields extends CDbMigration
{
	public function safeUp()
	{
		$this->execute('
				ALTER TABLE vehicle DROP COLUMN permission;
				ALTER TABLE vehicle DROP COLUMN kind_boot;
			'
		);
		
		return true;
	}

	public function safeDown()
	{
		echo "m130126_152613_alter_vehicle_delete_two_fields does not support migration down.\n";
		return true;
	}
}