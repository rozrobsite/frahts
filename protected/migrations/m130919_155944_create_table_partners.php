<?php

class m130919_155944_create_table_partners extends CDbMigration
{
	public function safeUp()
	{
		$this->execute('
				CREATE TABLE partners (
						id INT NOT NULL AUTO_INCREMENT,
						user_id INT (11) UNSIGNED NOT NULL,
						partner_id INT(11) UNSIGNED NOT NULL,
						PRIMARY KEY (id),
						KEY user_id (user_id),
						KEY partner_id (partner_id)
					) ENGINE = InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

				ALTER TABLE partners ADD FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE ON UPDATE RESTRICT;
				ALTER TABLE partners ADD FOREIGN KEY (partner_id) REFERENCES users(id) ON DELETE CASCADE ON UPDATE RESTRICT;
			'
		);
	}

	public function safeDown()
	{
		echo "m130919_155944_create_table_partners does not support migration down.\n";
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