<?php

class m131204_160842_alter_table_joker_vendibles_add_columns extends CDbMigration
{
	public function safeUp()
	{
        $this->execute('
				ALTER TABLE joker_vendibles ADD COLUMN created_at INT DEFAULT NULL;
				ALTER TABLE joker_vendibles ADD COLUMN updated_at INT DEFAULT NULL;
			'
		);

		return true;
	}

	public function safeDown()
	{
		echo "m131204_160842_alter_table_joker_vendibles_add_columns does not support migration down.\n";
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