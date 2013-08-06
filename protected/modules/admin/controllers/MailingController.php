<?php
set_time_limit(0);
class MailingController extends AdminController
{

	public function __construct($id, $module = null)
	{
		parent::__construct($id, $module);
	}

	public function actionIndex()
	{
		$this->redirect('/admin/mailing/mail');
	}

	public function actionMail()
	{
		$mailingModel = new Mailing();
		$this->render('mail', array(
			'parserEmails' => ParserEmails::model()->findAll(),
			'mailingModel' => $mailingModel,
		));
	}

	public function actionSendAll()
	{
		$subject = isset($_POST['Mailing']['subject']) ? trim($_POST['Mailing']['subject']) :'';
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