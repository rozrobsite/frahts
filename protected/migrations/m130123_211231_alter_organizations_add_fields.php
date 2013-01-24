<?php

class m130123_211231_alter_organizations_add_fields extends CDbMigration
{
	public function safeUp()
	{
		$this->execute('
				ALTER TABLE organizations ADD COLUMN address varchar(128) NULL DEFAULT NULL;
				ALTER TABLE organizations ADD COLUMN account_number varchar(64) NULL DEFAULT NULL;
				ALTER TABLE organizations ADD COLUMN edrpou varchar(32) NULL DEFAULT NULL;
				ALTER TABLE organizations ADD COLUMN bank varchar(32) NULL DEFAULT NULL;
				ALTER TABLE organizations ADD COLUMN city varchar(32) NULL DEFAULT NULL;
				ALTER TABLE organizations ADD COLUMN mfo varchar(32) NULL DEFAULT NULL;
				ALTER TABLE organizations ADD COLUMN inn varchar(32) NULL DEFAULT NULL;
				ALTER TABLE organizations ADD COLUMN certificate varchar(32) NULL DEFAULT NULL;
				ALTER TABLE organizations ADD COLUMN phone varchar(255) NULL DEFAULT NULL;
			'
		);
		
		return true;
	}

	public function safeDown()
	{
		echo "m130123_211231_alter_organizations_add_fields does not support migration down.\n";
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