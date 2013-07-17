<?php

class m130715_192330_create_table_parser extends CDbMigration
{
	public function safeUp()
	{
		$this->execute('
				CREATE TABLE IF NOT EXISTS `parser_emails` (
					`id` bigint(20) NOT NULL AUTO_INCREMENT,
					`email` varchar(32) DEFAULT NULL,
					PRIMARY KEY (`id`)
				  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
			'
		);
	}

	public function safeDown()
	{
		echo "m130715_192330_create_table_parser does not support migration down.\n";
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