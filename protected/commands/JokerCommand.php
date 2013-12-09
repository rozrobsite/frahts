<?php

set_time_limit(0);

/**
 * Description of VehicleCommand
 *
 * @author Геннадий
 */
class JokerCommand extends CConsoleCommand {

	public function run($args) {
		JokerTags::model()->deleteAll();

        $query = '
            ALTER TABLE `joker_tags` AUTO_INCREMENT = 1;
            INSERT INTO joker_tags (id, text)
            SELECT joker_organizations.id as id, joker_organizations.name as text FROM joker_organizations
            UNION
            SELECT joker_organizations.id as id, joker_vendibles.name as text
            FROM joker_organizations
            LEFT JOIN joker_vendibles ON joker_vendibles.organization_id = joker_organizations.id
            UNION
            SELECT joker_organizations.id as id, joker_business_type.name as text
            FROM joker_organizations, joker_business_type, joker_organization_business_type
            WHERE joker_organization_business_type.organization_id = joker_organizations.id AND joker_business_type.id = joker_organization_business_type.business_type_id;
            ';

		$command = Yii::app()->db->createCommand($query)->execute();
	}

}

?>
