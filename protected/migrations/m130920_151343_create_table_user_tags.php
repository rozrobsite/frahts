<?php

class m130920_151343_create_table_user_tags extends CDbMigration
{
	public function safeUp()
	{
		$this->execute('
				CREATE TABLE user_tags(
					id INT(11) DEFAULT NULL,
					text VARCHAR(255) DEFAULT NULL,
					FULLTEXT INDEX search_text (text)
				  ) ENGINE = MYISAM
			'
		);
	}

	public function safeDown()
	{
		echo "m130920_151343_create_table_user_tags does not support migration down.\n";
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