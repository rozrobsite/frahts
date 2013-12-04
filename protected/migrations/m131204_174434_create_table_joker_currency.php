<?php

class m131204_174434_create_table_joker_currency extends CDbMigration
{
	public function safeUp()
	{
        $this->execute('
				CREATE TABLE IF NOT EXISTS `joker_currency` (
					`id` INT NOT NULL AUTO_INCREMENT,
					`name` VARCHAR(32) NOT NULL,
					PRIMARY KEY (`id`)
				  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

                INSERT INTO joker_currency (name) VALUES ("грн.");
                INSERT INTO joker_currency (name) VALUES ("руб.");
                INSERT INTO joker_currency (name) VALUES ("$");
                INSERT INTO joker_currency (name) VALUES ("евро");
                INSERT INTO joker_currency (name) VALUES ("у.е.");

                ALTER TABLE joker_vendibles ADD COLUMN currency_id INT DEFAULT NULL;
				ALTER TABLE `joker_vendibles` ADD FOREIGN KEY (`currency_id`) REFERENCES `joker_currency`(`id`) ON DELETE CASCADE ON UPDATE RESTRICT;
			'
		);

		return true;
	}

	public function safeDown()
	{
		echo "m131204_174434_create_table_joker_currency does not support migration down.\n";
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