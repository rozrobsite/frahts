<?php

class m130722_161513_create_table_mailing extends CDbMigration
{
	public function safeUp()
	{
		$this->execute('
				CREATE TABLE IF NOT EXISTS `mailing` (
					`id` bigint(20) NOT NULL AUTO_INCREMENT,
					`subject` varchar(255) NOT NULL,
					`text` text NOT NULL,
					`created_at` int(11) NOT NULL,
					PRIMARY KEY (`id`)
				  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
			'
		);
	}

	public function safeDown()
	{
		echo "m130722_161513_create_table_mailing does not support migration down.\n";
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