<?php

set_time_limit(0);

/**
 * Description of VehicleCommand
 *
 * @author Геннадий
 */
class UsersCommand extends CConsoleCommand {

	public function run($args) {
		UserTags::model()->deleteAll();

		$query = 'INSERT INTO user_tags (id, text)
					SELECT users.id as id, profiles.first_name as text FROM users, profiles WHERE users.id = profiles.user_id
					UNION
					SELECT users.id as id, profiles.last_name as text FROM users, profiles WHERE users.id = profiles.user_id
					UNION
					SELECT users.id as id, profiles.middle_name as text FROM users, profiles WHERE users.id = profiles.user_id
					UNION
					SELECT users.id as id, organizations.name_org as text FROM users, organizations WHERE users.id = organizations.user_id';

		$command = Yii::app()->db->createCommand($query)->execute();
	}

}

?>
