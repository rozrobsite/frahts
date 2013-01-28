<?php

class m130128_210840_alter_profiles_add_fields extends CDbMigration
{
	public function safeUp()
	{
		$this->execute('
				ALTER TABLE profiles ADD COLUMN created_at int(11) NULL DEFAULT NULL;
				ALTER TABLE profiles ADD COLUMN updated_at int(11) NULL DEFAULT NULL;
			'
		);
		
		return true;
	}

	public function safeDown()
	{
		echo "m130128_210840_alter_profiles_add_fields does not support migration down.\n";
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