<?php

class m130709_152806_alter_offers_add_column extends CDbMigration
{
	public function up()
	{
		$this->execute('
				ALTER TABLE offers ADD COLUMN is_view tinyint(1) DEFAULT 0;
			'
		);

		return true;
	}

	public function down()
	{
		echo "m130709_152806_alter_offers_add_column does not support migration down.\n";
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