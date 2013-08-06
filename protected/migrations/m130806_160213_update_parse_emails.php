<?php

class m130806_160213_update_parse_emails extends CDbMigration
{
	public function up()
	{
		$this->execute('
				ALTER TABLE `parser_emails` ADD `is_sent` TINYINT( 1 ) NULL DEFAULT 0;
			'
		);

		return true;
	}

	public function down()
	{
		echo "m130806_160213_update_parse_emails does not support migration down.\n";
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