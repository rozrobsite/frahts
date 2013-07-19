<?php

class m130719_155634_alter_table_offers_add_column extends CDbMigration
{
	public function safeUp()
	{
		$this->execute('
				ALTER TABLE `offers` ADD `review_id` BIGINT( 20 ) NULL DEFAULT NULL;

				ALTER TABLE `offers` ADD INDEX (`review_id`);

				ALTER TABLE `offers` ADD FOREIGN KEY (`review_id`) REFERENCES `reviews` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;
			'
		);

		return true;
	}

	public function safeDown()
	{
		echo "m130719_155634_alter_table_offers_add_column does not support migration down.\n";
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