<?php

class m131120_100148_create_table_joker_business_type extends CDbMigration
{
	public function safeUp()
	{
		$this->execute('
				CREATE TABLE IF NOT EXISTS `joker_business_type` (
					`id` tinyint(2) NOT NULL,
					`name` varchar(64) NOT NULL,
					`order` tinyint(2) NOT NULL DEFAULT 0,
					PRIMARY KEY (`id`)
				  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
				  
				  INSERT INTO `joker_business_type`(id, name) VALUES (1, "Автомагазин");
				  INSERT INTO `joker_business_type`(id, name) VALUES (2, "СТО");
				  INSERT INTO `joker_business_type`(id, name) VALUES (3, "Шиномонтаж");
				  INSERT INTO `joker_business_type`(id, name) VALUES (4, "Автомойка");
				  INSERT INTO `joker_business_type`(id, name) VALUES (5, "Кафе");
				  INSERT INTO `joker_business_type`(id, name) VALUES (6, "Гостиница");
				  INSERT INTO `joker_business_type`(id, name) VALUES (7, "GPS слежение");
			'
		);
		
		return true;
	}

	public function safeDown()
	{
		echo "m131120_100148_create_table_joker_business_type does not support migration down.\n";
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