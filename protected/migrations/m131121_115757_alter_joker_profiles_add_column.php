<?php

class m131121_115757_alter_joker_profiles_add_column extends CDbMigration
{
	public function up()
	{
		$this->execute('
				ALTER TABLE joker_organizations ADD COLUMN logo VARCHAR(24) DEFAULT NULL;
			'
		);
		
		return true;
	}

	public function down()
	{
		echo "m131121_115757_alter_joker_profiles_add_column does not support migration down.\n";
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