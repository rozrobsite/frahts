<?php

class m130123_195037_create_file_types_table extends CDbMigration
{
	public function safeUp()
	{
		$this->execute('
				CREATE TABLE IF NOT EXISTS `file_types` (
					`id` tinyint(2) NOT NULL,
					`title` varchar(255) NOT NULL,
					PRIMARY KEY (`id`)
				  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 ;
				  
				INSERT INTO `file_types` (`id`, `title`) VALUES
					(1, "Форма регистрации"),
					(2, "Форма налогообложения"),
					(3, "Лицензия"),
					(4, "Разное")
				 ;
			'
		);
		
		return true;
	}

	public function safeDown()
	{
		$this->execute('DROP TABLE IF EXISTS `file_types`');
		
		return true;
	}
}