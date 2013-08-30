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

		foreach ($vehicles as $vehicle)
		{
			$message = new YiiMailMessage;
			$message->view = 'update_vehicle';
			$message->setBody(array('vehicle' => $vehicle), 'text/html');
			$message->subject = 'Закончился срок загрузки';
			$message->from = Yii::app()->params['adminEmail'];
			$message->addTo($vehicle->user->email);

			Yii::log('Отправка пользователю #' . $vehicle->user->id . ' по поводу ТС #' . $vehicle->id);

			try {
				Yii::app()->mail->send($message);

				Yii::log('Сообщение отослано');
			}
			catch (CException $exc) {
				Yii::log('Ошибка отправки. Причина: ' . $exc->getMessage(), CLogger::LEVEL_ERROR);
			}

			break;
		}
	}

}

?>
