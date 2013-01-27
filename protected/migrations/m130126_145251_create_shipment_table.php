<?php

class m130126_145251_create_shipment_table extends CDbMigration
{
	public function safeUp()
	{
		$this->execute('
				CREATE TABLE IF NOT EXISTS `shipment` (
					`id` tinyint(4) NOT NULL AUTO_INCREMENT,
					`name_ru` varchar(255) NOT NULL,
					`name_ua` varchar(255) NOT NULL,
					PRIMARY KEY (`id`)
				  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
				  
				INSERT INTO shipment (name_ru) VALUES ("Боковая");
				INSERT INTO shipment (name_ru) VALUES ("Верхняя");
				INSERT INTO shipment (name_ru) VALUES ("Задняя");
				INSERT INTO shipment (name_ru) VALUES ("Растентовка");
				INSERT INTO shipment (name_ru) VALUES ("Постоянно");
				INSERT INTO shipment (name_ru) VALUES ("Ежедневно");
				INSERT INTO shipment (name_ru) VALUES ("Круглосуточно");
				INSERT INTO shipment (name_ru) VALUES ("Полуприцеп");
				INSERT INTO shipment (name_ru) VALUES ("Сцепка");
				INSERT INTO shipment (name_ru) VALUES ("Иномарка");
				INSERT INTO shipment (name_ru) VALUES ("Пневмоход");
				INSERT INTO shipment (name_ru) VALUES ("Гидроборт");
				INSERT INTO shipment (name_ru) VALUES ("Штора");
				INSERT INTO shipment (name_ru) VALUES ("Пирамида");
			'
		);

		return true;
	}

	public function safeDown()
	{
		$this->execute('DROP TABLE IF EXISTS `shipment`');
		
		return true;
	}
}