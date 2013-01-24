<?php

class m130123_191029_delete_column_organizations extends CDbMigration
{
	public function safeUp()
	{
		$this->execute('
				ALTER TABLE organizations DROP COLUMN scan_form_registration;
				ALTER TABLE organizations DROP COLUMN scan_form_tax;
				ALTER TABLE organizations DROP COLUMN scan_license;
			'
		);
		
		return true;
	}

	public function safeDown()
	{
		echo "m130123_191029_delete_column_organizations does not support migration down.\n";
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