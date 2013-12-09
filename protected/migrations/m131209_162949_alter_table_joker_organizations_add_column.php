<?php

class m131209_162949_alter_table_joker_organizations_add_column extends CDbMigration
{
	public function up()
	{
        $this->execute('
				ALTER TABLE joker_organizations ADD COLUMN enabled TINYINT(1) DEFAULT 1;
			'
		);

		return true;
	}

	public function down()
	{
		echo "m131209_162949_alter_table_joker_organizations_add_column does not support migration down.\n";
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