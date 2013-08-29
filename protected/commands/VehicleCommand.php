<?php
/**
 * Description of VehicleCommand
 *
 * @author Геннадий
 */
class VehicleCommand extends CConsoleCommand {
	public function run($args) {
		Yii::log('Задача: рассылка e-mail-напоминания всем грузоперевозчикам у которых вышел срок "Транспорт свободен".');
		$vehicles = Vehicle::model()->findAll('date_to < ' . time());
		Yii::log('Найденное количество грузоперевозчиков: ' . count($vehicles));

		if (!count($vehicles))
			return;
	}

}

?>
