<?php

class m130126_143636_insert_permissions extends CDbMigration
{
	public function safeUp()
	{
		$this->execute('
				INSERT INTO permissions (name_ru) VALUES ("CMR");
				INSERT INTO permissions (name_ru) VALUES ("TIR");
				INSERT INTO permissions (name_ru) VALUES ("T1");
				INSERT INTO permissions (name_ru) VALUES ("ADR");
				INSERT INTO permissions (name_ru) VALUES ("Санпаспорт");
				INSERT INTO permissions (name_ru) VALUES ("Таможенное свидетельство");
				INSERT INTO permissions (name_ru) VALUES ("Таможенный контроль");
			'
		);
		
		return true;
	}

	public function safeDown()
	{
		echo "m130126_143636_insert_permissions does not support migration down.\n";
		return true;
	}
}