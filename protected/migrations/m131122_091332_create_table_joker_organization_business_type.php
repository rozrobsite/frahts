<?php

class m131122_091332_create_table_joker_organization_business_type extends CDbMigration
{
	public function safeUp()
	{
		$this->execute('
				CREATE TABLE IF NOT EXISTS `joker_organization_business_type` (
					`id` bigint(20) NOT NULL AUTO_INCREMENT,
					`organization_id` bigint(20) NOT NULL,
					`business_type_id` tinyint(2) NOT NULL,
					PRIMARY KEY (`organization_id`, `business_type_id`),
					KEY `id` (`id`)
				  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
                                  
				ALTER TABLE `joker_organization_business_type` ADD CONSTRAINT `joker_organization_business_type_joker_organizations_ibfk_1` FOREIGN KEY (`organization_id`) REFERENCES `joker_organizations` (`id`) ON DELETE CASCADE;
				ALTER TABLE `joker_organization_business_type` ADD CONSTRAINT `joker_organization_business_type_joker_business_type_ibfk_2` FOREIGN KEY (`business_type_id`) REFERENCES `joker_business_type` (`id`) ON DELETE CASCADE;
			'
		);
		
		return true;
	}

	public function safeDown()
	{
		echo "m131122_091332_create_table_joker_organization_business_type does not support migration down.\n";
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