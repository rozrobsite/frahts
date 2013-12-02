<?php

class m131202_170900_alter_joker_employee_add_column extends CDbMigration
{
	public function safeUp()
	{
        $this->execute('
				ALTER TABLE joker_employee ADD COLUMN created_at INT DEFAULT NULL;
				ALTER TABLE joker_employee ADD COLUMN updated_at INT DEFAULT NULL;
			'
		);

		return true;
	}

	public function safeDown()
	{
		echo "m131202_170900_alter_joker_employee_add_column does not support migration down.\n";
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