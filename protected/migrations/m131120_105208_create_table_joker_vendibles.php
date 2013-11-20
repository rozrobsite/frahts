<?php

class m131120_105208_create_table_joker_vendibles extends CDbMigration
{
	public function safeUp()
	{
		$this->execute('
				CREATE TABLE IF NOT EXISTS `joker_vendibles` (
					`id` int(11) NOT NULL AUTO_INCREMENT,
					`organization_id` bigint(20) NOT NULL,
					`name` varchar(254) NOT NULL,
					`description` varchar(254) NOT NULL,
					`cost` float NOT NULL,
					`discount` float DEFAULT NULL,
					PRIMARY KEY (`id`),
					KEY `organization_id` (`organization_id`)
				  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
                                  
				ALTER TABLE `joker_vendibles` ADD CONSTRAINT `joker_vendibles_joker_organizations_ibfk_1` FOREIGN KEY (`organization_id`) REFERENCES `joker_organizations` (`id`) ON DELETE CASCADE;
			'
		);
		
		return true;
	}

	public function safeDown()
	{
		echo "m131120_105208_create_table_joker_vendibles does not support migration down.\n";
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