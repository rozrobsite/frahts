<?php

class m131126_202906_create_table_joker_employee extends CDbMigration
{
	public function safeUp()
	{
		$this->execute('
				CREATE TABLE IF NOT EXISTS `joker_employee` (
					`id` bigint(20) NOT NULL AUTO_INCREMENT,
					`organization_id` bigint(20) DEFAULT NULL,
					`position` varchar(254) NOT NULL,
					`fio` varchar(254) NOT NULL,
					`mobile` varchar(15) NOT NULL,
					`email` varchar(254) DEFAULT NULL,
					PRIMARY KEY (`id`),
					KEY `organization_id` (`organization_id`)
				  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

				ALTER TABLE `joker_employee` ADD FOREIGN KEY (`organization_id`) REFERENCES `joker_organizations`(`id`) ON DELETE CASCADE ON UPDATE RESTRICT;
			'
		);

		return true;
	}

	public function safeDown()
	{
		echo "m131126_202906_create_table_joker_employee does not support migration down.\n";
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