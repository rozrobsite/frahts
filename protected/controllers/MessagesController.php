<?php

class MessagesController extends FrahtController {

	public function __construct($id, $module = null) {
		parent::__construct($id, $module);

		Yii::app()->session['redirectUrl'] = Yii::app()->getRequest()->requestUri;
	}

	public function actionIndex() {
//		$this->render('index');
	}

	public function actionSend() {
		$params = $_POST;
		$message = isset($params['message']) ? trim($params['message']) : '';
		$receiving_id = isset($params['receiving_id']) ? (int) $params['receiving_id'] : 0;
		$good_id = isset($params['good_id']) ? (int) $params['good_id'] : 0;

		if (!$receiving_id || !$message || !$good_id) {
			echo CJavaScript::jsonEncode(array('error' => 1));

			Yii::app()->end();
		}

		$model = new Messages();
		$model->author_id = $this->user->id;
		$model->receiving_user_id = $receiving_id;
		$model->message = $message;
		$model->created_at = time();

		if (!$model->save()) {
			echo CJavaScript::jsonEncode(array('error' => 2));

			Yii::app()->end();
		}

		$good = Goods::model()->findByPk($good_id);
		if (!$this->sendEmail($model, $good))
		{
			echo CJavaScript::jsonEncode(array('error' => 3));

			Yii::app()->end();
		}

		echo CJavaScript::jsonEncode(array('error' => 0));

		Yii::app()->end();
	}

	private function sendEmail($model, $good)
	{
		$message = new YiiMailMessage;
		$message->view = 'messageOwner';
		$message->setBody(array('model' => $model, 'good' => $good), 'text/plain');
		$message->subject = Yii::app()->params['siteName'] . ': Сообщение от пользователя';
		$message->addTo($model->receivingUser->email);
		$message->from = Yii::app()->params['adminEmail'];

		return Yii::app()->mail->send($message);
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