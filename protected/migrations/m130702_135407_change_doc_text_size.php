<?php

class m130702_135407_change_doc_text_size extends CDbMigration
{
	public function up()
	{
	
		$this->execute('
			ALTER TABLE  `docs` CHANGE  `text`  `text` MEDIUMTEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;
			'
		);
		
		return true;
	
	}

	public function down()
	{
		echo "m130702_135407_change_doc_text_size does not support migration down.\n";
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