<?php

class m131209_165201_create_table_joker_tags extends CDbMigration
{
	public function up()
	{
        $this->execute('
				CREATE TABLE joker_tags(
					id INT(11) DEFAULT NULL,
					text VARCHAR(255) DEFAULT NULL,
					FULLTEXT INDEX search_text (text)
				  ) ENGINE = MYISAM
			'
		);

		return true;
	}

	public function down()
	{
		echo "m131209_165201_create_table_joker_tags does not support migration down.\n";
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