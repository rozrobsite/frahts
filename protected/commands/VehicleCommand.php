<?php
set_time_limit(0);
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

		$count = 1;
		foreach ($vehicles as $vehicle) {
			if ($count == 40) break;
//			if ($vehicle->id != 27146)
//				continue;

//			if ($count == 280) {
//				sleep(3660);
//
//				$count = 0;
//			}
//			else {
//				if ($count != 0 && $count % 20 == 0) {
//					sleep(180);
//				}

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
//			}

//			if ($count == 4)
//				break;

//			sleep(15);
			$count++;
		}
	}

}

?>
