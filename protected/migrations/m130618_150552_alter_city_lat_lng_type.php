<?php

class m130618_150552_alter_city_lat_lng_type extends CDbMigration
{
	public function safeUp()
	{
		$this->execute(
			'
				ALTER TABLE city MODIFY COLUMN latitude DOUBLE;
				ALTER TABLE city MODIFY COLUMN longitude DOUBLE;
			'
		);

		return true;
	}

	public function safeDown()
	{
		echo "m130618_150552_alter_city_lat_lng_type does not support migration down.\n";
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