<?php

class m131121_092810_alter_joker_profiles_add_column extends CDbMigration
{
	public function up()
	{
		$this->execute('
				ALTER TABLE joker_profiles ADD COLUMN created_at INT(11) NOT NULL;
			'
		);
		
		return true;
	}

	public function down()
	{
		echo "m131121_092810_alter_joker_profiles_add_column does not support migration down.\n";
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