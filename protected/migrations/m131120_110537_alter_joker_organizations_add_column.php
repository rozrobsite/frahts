<?php

class m131120_110537_alter_joker_organizations_add_column extends CDbMigration
{
	public function safeUp()
	{
		$this->execute('
				ALTER TABLE joker_organizations ADD COLUMN latitude double NOT NULL;
				ALTER TABLE joker_organizations ADD COLUMN longitude double NOT NULL;
			'
		);
		
		return true;
	}

	public function safeDown()
	{
		echo "m131120_110537_alter_joker_organizations_add_column does not support migration down.\n";
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