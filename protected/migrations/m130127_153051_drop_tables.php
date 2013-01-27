<?php

class m130127_153051_drop_tables extends CDbMigration
{
	public function safeUp()
	{
		$this->execute('
				DROP TABLE vehicle_permissions;
				DROP TABLE vehicle_shipment;
			'
		);
		
		return true;
	}

	public function safeDown()
	{
		echo "m130127_153051_drop_tables does not support migration down.\n";
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