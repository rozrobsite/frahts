<?php

class m130127_164141_alter_vehicle_change_field_type extends CDbMigration
{
	public function up()
	{
		$this->execute('
				ALTER TABLE vehicle MODIFY COLUMN `bearing_capacity` float;
			'
		);
		
		return true;
	}

	public function down()
	{
		echo "m130127_164141_alter_vehicle_change_field_type does not support migration down.\n";
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