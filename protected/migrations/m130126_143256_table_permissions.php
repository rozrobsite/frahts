<?php

class m130126_143256_table_permissions extends CDbMigration
{
	public function safeUp()
	{
		$this->execute('
				CREATE TABLE IF NOT EXISTS `permissions` (
					`id` tinyint(4) NOT NULL AUTO_INCREMENT,
					`name_ru` varchar(255) NOT NULL,
					`name_ua` varchar(255) NOT NULL,
					PRIMARY KEY (`id`)
				  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
			'
		);

		return true;
	}

	public function safeDown()
	{
		$this->execute('DROP TABLE IF EXISTS `permissions`');
		
		return true;
	}
}