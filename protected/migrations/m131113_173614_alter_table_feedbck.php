<?php

class m131113_173614_alter_table_feedbck extends CDbMigration
{
	public function up()
	{
		$this->execute('
				ALTER TABLE `feedback` ADD `created_at` INT(11) NULL DEFAULT NULL;
			'
		);
	}

	public function down()
	{
		echo "m131113_173614_alter_table_feedbck does not support migration down.\n";
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