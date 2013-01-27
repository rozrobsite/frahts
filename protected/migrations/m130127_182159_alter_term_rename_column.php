<?php

class m130127_182159_alter_term_rename_column extends CDbMigration
{
	public function up()
	{
		$this->execute('
				ALTER TABLE terms DROP COLUMN `term-ua`;
			'
		);
		
		return true;
	}

	public function down()
	{
		echo "m130127_182159_alter_term_rename_column does not support migration down.\n";
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