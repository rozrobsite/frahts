<?php

class m130911_155630_create_table_promua_parser extends CDbMigration
{
	public function up()
	{
		$this->execute('
				CREATE TABLE `parser_promua` (
						id INT NOT NULL ,
						name VARCHAR (255) DEFAULT NULL,
						email VARCHAR (255) DEFAULT NULL
					) ENGINE = INNODB CHARACTER SET utf8 COLLATE utf8_general_ci;
			'
		);
	}

	public function down()
	{
		echo "m130911_155630_create_table_promua_parser does not support migration down.\n";
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