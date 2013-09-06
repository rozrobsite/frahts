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

		$start = 0;
		$criteria = new CDbCriteria();
		$criteria->condition = 'date_to < ' . time();
		$criteria->limit = 20;
		$criteria->offset = $start;

		$vehicles = Vehicle::model()->findAll($criteria);
		unset($criteria);
//		$vehicles = Vehicle::model()->findAll('date_to < ' . time());
//		Yii::log('Найденное количество грузоперевозчиков: ' . count($vehicles));

		$count = 1;
		while (count($vehicles))
		{
			if ($count == 3)
				break;

			foreach ($vehicles as $vehicle) {
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
			}

			sleep(60);

			$start += 20;
			$criteria = new CDbCriteria();
			$criteria->condition = 'date_to < ' . time();
			$criteria->limit = 20;
			$criteria->offset = $start;
			echo '<pre>';
			print_r(Yii::app()->db);
			echo '</pre>';
			$vehicles = Vehicle::model()->findAll($criteria);
			unset($criteria);

			$count++;
		}
	}

}

?>
