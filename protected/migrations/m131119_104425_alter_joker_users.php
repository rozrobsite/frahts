<?php

class m131119_104425_alter_joker_users extends CDbMigration
{
	public function up()
	{
		$this->execute('
				ALTER TABLE joker_users ADD COLUMN s_code VARCHAR(32) NOT NULL;
			'
		);
		
		return true;
	}

	public function down()
	{
		echo "m131119_104425_alter_joker_users does not support migration down.\n";
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