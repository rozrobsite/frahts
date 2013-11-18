<?php

class m131118_085619_create_table_joker_users extends CDbMigration
{
	public function up()
	{
		$this->execute('
				CREATE TABLE IF NOT EXISTS `joker_users` (
					`id` bigint(20) NOT NULL AUTO_INCREMENT,
					`email` varchar(254) NOT NULL,
					`password` varchar(64) NOT NULL,
					`logins` int(10) unsigned DEFAULT 0,
					`last_login` int(10) unsigned DEFAULT NULL,
					`enabled` tinyint(2) NOT NULL DEFAULT 1,
					PRIMARY KEY (`id`)
				  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
			'
		);
		
		return true;
	}

	public function down()
	{
		$this->execute('DROP TABLE IF EXISTS joker_users');
		
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