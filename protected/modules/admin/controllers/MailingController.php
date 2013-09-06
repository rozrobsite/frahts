<?php

set_time_limit(0);

class MailingController extends AdminController {

	public function __construct($id, $module = null) {
		parent::__construct($id, $module);
	}

	public function actionIndex() {
		$this->redirect('/admin/mailing/mail');
	}

	public function actionMail() {
		$mailingModel = new Mailing();
		$this->render('mail', array(
			'parserEmails' => ParserEmails::model()->findAll(),
			'mailingModel' => $mailingModel,
		));
	}

	public function actionSendAll() {
		$subject = isset($_POST['Mailing']['subject']) ? trim($_POST['Mailing']['subject']) : '';
		$body = isset($_POST['Mailing']['text']) ? nl2br(trim($_POST['Mailing']['text'])) : '';

		if (empty($subject) || empty($body))
			return;

		$mailingModel = new Mailing();
		$parserEmails = ParserEmails::model()->findAll('is_sent = 0');

		$count = 0;
		foreach ($parserEmails as $email) {
			$message = new YiiMailMessage;

			$message->view = 'mailing';
			$message->setBody(array('body' => $body), 'text/html');
			$message->subject = $subject;
			$message->addTo($email->email);
			$message->from = Yii::app()->params['adminEmail'];

			if (Yii::app()->mail->send($message))
				$count++;
		}

		$this->render('mail', array(
			'parserEmails' => ParserEmails::model()->findAll(),
			'mailingModel' => $mailingModel,
			'count' => $count,
		));
	}

	public function actionAddMail() {
		$countAdded = 0;
		$countAll = 0;
		$errorAdd = 0;

		if (isset($_POST['emails'])) {
			$emails_arr = explode("\r\n", $_POST['emails']);
			$countAll = count($emails_arr);

			$values = array();
			foreach ($emails_arr as $email) {
				$email = trim($email, ' ;"\'!!@#$%^&*()-=_+}{[]:\\|?/><.,');
				if (filter_var($email, FILTER_VALIDATE_EMAIL))
					$values[] = '("' . $email . '", 0)';
			}

			if (count($values)) {
				$values_str = join(',', $values);
				$sql = 'INSERT INTO parser_emails (email, is_sent) VALUES ' . $values_str;
				try {
					$command = Yii::app()->db->createCommand($sql);
					$countAdded = $command->execute();
				}
				catch (CDbException $exc) {
					$errorAdd++;
				}
			}
		}

		$this->render('addMail', array(
			'countAdded' => $countAdded,
			'countAll' => $countAll,
			'errorAdd' => $errorAdd,
		));
	}

	public function actionInputtedMail() {
		$countSended = 0;
		$countAll = 0;

		if (isset($_POST['emails'])) {
			$subject = isset($_POST['subject']) ? trim($_POST['subject']) : '';
			$body = isset($_POST['text']) ? nl2br(trim($_POST['text'])) : '';

			if (empty($subject) || empty($body))
				return;

			$emails_arr = explode("\r\n", $_POST['emails']);
			$countAll = count($emails_arr);

			$emails = array();
			foreach ($emails_arr as $email) {
				$email = trim($email, ' ;"\'!!@#$%^&*()-=_+}{[]:\\|?/><.,');
				if (filter_var($email, FILTER_VALIDATE_EMAIL))
					$emails[] = $email;
			}

			$countSended = $countAll = count($emails);
			if ($countAll) {
				$count = 1;
				foreach ($emails as $email) {
					if ($count == 280) {
						sleep(3660);

						$count = 1;
					}
					else {
						if ($count != 0 && $count % 20 == 0) {
							sleep(180);
						}

						$message = new YiiMailMessage;
						$message->view = 'mailing';
						$message->setBody(array('body' => $body), 'text/html');
						$message->subject = $subject;
						$message->from = Yii::app()->params['adminEmail'];
						$message->addTo($email);

						try {
							Yii::app()->mail->send($message);
						}
						catch (CException $exc) {
							$countSended--;
						}
					}

					$count++;
				}
			}
		}

		$this->render('inputtedMail', array(
			'countSended' => $countSended,
			'countAll' => $countAll,
		));
	}

	public function actionCronMailing() {
		$type = isset($_POST['cron_mailing_type']) ? (int) $_POST['cron_mailing_type'] : 0;

		switch ($type) {
			case CronMailing::UPDATE_VEHICLE :
				return $this->sendUpdateVehicle();
		}

		$this->render('cronMailing', array(
		));
	}

	private function sendUpdateVehicle() {
		$startId = CronMailing::model()->find('id = ' . CronMailing::UPDATE_VEHICLE)->last_id;

		$criteria = new CDbCriteria();

		$criteria->condition = 'date_to < ' . time() . ' AND id > ' . $startId;
		$criteria->limit = CronMailing::MAX_EMAIL_PER_CONNECTION;

		$vehicles = Vehicle::model()->findAll($criteria);

		$count = 0;
		$errorEmails = array();

		if (!count($vehicles))
		{
			CronMailing::model()->updateAll(array('last_id' => 0), 'id = ' . CronMailing::UPDATE_VEHICLE);

			return $this->respondJSON(array(
				'count' => $count,
				'errorEmails' => $errorEmails
			));
		}

		foreach ($vehicles as $vehicle) {
			$message = new YiiMailMessage;
			$message->view = 'update_vehicle';
			$message->setBody(array('vehicle' => $vehicle), 'text/html');
			$message->subject = 'Закончился срок загрузки';
			$message->from = Yii::app()->params['adminEmail'];
			$message->addTo($vehicle->user->email);

			try {
				Yii::app()->mail->send($message);

				$count++;
			}
			catch (CException $exc) {
				$errorEmails[] = $startId;
			}
		}

		$lastId = $vehicles[count($vehicles) - 1]->id;

		CronMailing::model()->updateAll(array('last_id' => $lastId, 'id = ' . CronMailing::UPDATE_VEHICLE));

		return $this->respondJSON(array(
			'count' => $count,
			'errorEmails' => $errorEmails
			));
	}

	// Uncomment the following methods and override them if needed
	/*
	  public function filters()
	  {
	  // return the filter configuration for this controller, e.g.:
	  return array(
	  'inlineFilterName',
	  array(
	  'class'=>'path.to.FilterClass',
	  'propertyName'=>'propertyValue',
	  ),
	  );
	  }

	  public function actions()
	  {
	  // return external action classes, e.g.:
	  return array(
	  'action1'=>'path.to.ActionClass',
	  'action2'=>array(
	  'class'=>'path.to.AnotherActionClass',
	  'propertyName'=>'propertyValue',
	  ),
	  );
	  }
	 */
}