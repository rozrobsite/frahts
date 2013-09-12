<?php

class m130912_153513_alter_goods_add_column_distance extends CDbMigration
{
	public function up()
	{
		$this->execute('
				ALTER TABLE `goods` ADD `distance` INT(6) NULL DEFAULT 0;
			'
		);
	}

	public function down()
	{
		echo "m130912_153513_alter_goods_add_column_distance does not support migration down.\n";
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