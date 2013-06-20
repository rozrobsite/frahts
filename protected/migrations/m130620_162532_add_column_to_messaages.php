<?php

class m130620_162532_add_column_to_messaages extends CDbMigration
{
	public function up()
	{
		$this->execute('
				ALTER TABLE messages ADD COLUMN is_view tinyint(1) DEFAULT 0;
			'
		);
	}

	public function down()
	{
		echo "m130620_162532_add_column_to_messaages does not support migration down.\n";
		return false;
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