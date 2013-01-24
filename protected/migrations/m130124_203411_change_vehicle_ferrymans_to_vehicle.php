<?php

class m130124_203411_change_vehicle_ferrymans_to_vehicle extends CDbMigration
{
	public function up()
	{
		$this->execute('
				RENAME TABLE vehicle_ferrymans TO vehicle ;
			'
		);
		
		return true;
	}

	public function down()
	{
		echo "m130124_203411_change_vehicle_ferrymans_to_vehicle does not support migration down.\n";
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