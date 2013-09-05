<?php

class m130905_161754_create_table_cron_mailing extends CDbMigration
{
	public function safeUp()
	{
		$this->execute('
				CREATE TABLE  `cron_mailing` (
					`id` INT NOT NULL ,
					`last_id` INT NOT NULL
					) ENGINE = INNODB CHARACTER SET utf8 COLLATE utf8_general_ci;

				INSERT INTO cron_mailing (id) VALUES (1);
				INSERT INTO cron_mailing (id) VALUES (2);
				INSERT INTO cron_mailing (id) VALUES (3);
			'
		);
	}

	public function safeDown()
	{
		echo "m130905_161754_create_table_cron_mailing does not support migration down.\n";
		return true;
	}
}