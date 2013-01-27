<?php

class m130126_141651_alter_body_types_drop_key_insert extends CDbMigration
{
	public function safeUp()
	{
		$this->execute('
				ALTER TABLE `body_types` DROP FOREIGN KEY `body_types_ibfk_1` ;
				INSERT INTO body_types (name_ru) VALUES ("тент");
				INSERT INTO body_types (name_ru) VALUES ("изотерм");
				INSERT INTO body_types (name_ru) VALUES ("цельномет.");
				INSERT INTO body_types (name_ru) VALUES ("рефрижератор");
				INSERT INTO body_types (name_ru) VALUES ("автовоз");
				INSERT INTO body_types (name_ru) VALUES ("автокран");
				INSERT INTO body_types (name_ru) VALUES ("бензовоз");
				INSERT INTO body_types (name_ru) VALUES ("битумовоз");
				INSERT INTO body_types (name_ru) VALUES ("бортовая");
				INSERT INTO body_types (name_ru) VALUES ("зерновоз");
				INSERT INTO body_types (name_ru) VALUES ("изотерм");
				INSERT INTO body_types (name_ru) VALUES ("контейнер");
				INSERT INTO body_types (name_ru) VALUES ("контейнеровоз");
				INSERT INTO body_types (name_ru) VALUES ("лесовоз");
				INSERT INTO body_types (name_ru) VALUES ("масловоз");
				INSERT INTO body_types (name_ru) VALUES ("меблевоз");
				INSERT INTO body_types (name_ru) VALUES ("микроавтобус");
				INSERT INTO body_types (name_ru) VALUES ("муковоз");
				INSERT INTO body_types (name_ru) VALUES ("негабарит");
				INSERT INTO body_types (name_ru) VALUES ("открытая");
				INSERT INTO body_types (name_ru) VALUES ("панелевоз");
				INSERT INTO body_types (name_ru) VALUES ("платформа");
				INSERT INTO body_types (name_ru) VALUES ("рефрижератор");
				INSERT INTO body_types (name_ru) VALUES ("самосвал");
				INSERT INTO body_types (name_ru) VALUES ("скотовоз");
				INSERT INTO body_types (name_ru) VALUES ("спецмашина");
				INSERT INTO body_types (name_ru) VALUES ("трал");
				INSERT INTO body_types (name_ru) VALUES ("трубовоз");
				INSERT INTO body_types (name_ru) VALUES ("тягач");
				INSERT INTO body_types (name_ru) VALUES ("цельнопластик");
				INSERT INTO body_types (name_ru) VALUES ("цементовоз");
				INSERT INTO body_types (name_ru) VALUES ("цистерна пищ.");
				INSERT INTO body_types (name_ru) VALUES ("цистерна хим.");
				INSERT INTO body_types (name_ru) VALUES ("эвакуатор");
				INSERT INTO body_types (name_ru) VALUES ("экскаватор");
			'
		);
		
		return true;
	}

	public function safeDown()
	{
		echo "m130126_141651_alter_body_types_drop_key_insert does not support migration down.\n";
		return true;
	}

}