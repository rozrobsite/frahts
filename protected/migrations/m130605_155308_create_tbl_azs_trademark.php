<?php

class m130605_155308_create_tbl_azs_trademark extends CDbMigration
{
	public function up()
	{
		$this->execute('
				CREATE TABLE IF NOT EXISTS `azs_trademark` (
					`id` int(11) NOT NULL AUTO_INCREMENT,
					`name_ru` varchar(128) NOT NULL,
					`name_ua` varchar(128) NOT NULL,
					PRIMARY KEY (`id`)
				  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
			'
		);

		return true;
	}

	public function down()
	{
		$this->execute('DROP TABLE IF EXISTS `azs_trademark`');

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