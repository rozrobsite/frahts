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
				$message = new YiiMailMessage;
				$message->view = 'mailing';
				$message->setBody(array('body' => $body), 'text/html');
				$message->subject = $subject;
				$message->from = Yii::app()->params['adminEmail'];

				foreach ($emails as $email) {
					$message->addTo($email);

					try {
						Yii::app()->mail->send($message);
					}
					catch (CException $exc) {
						$countSended--;
					}
				}
			}
		}

		$this->render('inputtedMail', array(
			'countSended' => $countSended,
			'countAll' => $countAll,
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