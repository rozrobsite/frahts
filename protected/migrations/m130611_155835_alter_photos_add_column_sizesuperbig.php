<?php

class m130611_155835_alter_photos_add_column_sizesuperbig extends CDbMigration
{

	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
		$this->execute('
				ALTER TABLE photos ADD COLUMN size_superbig varchar(32) NULL DEFAULT NULL;
			'
		);
	}

	public function safeDown()
	{
		return true;
	}
}