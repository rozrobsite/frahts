<?php

class MessagesController extends FrahtController {

	public function __construct($id, $module = null) {
		parent::__construct($id, $module);

//		Yii::app()->session['redirectUrl'] = Yii::app()->getRequest()->requestUri;
	}

	public function actionIndex() {
//		$this->render('index');
	}

	public function actionAdd() {
		$params = $_POST;
		$message = isset($params['message']) ? trim($params['message']) : '';
		$receiving_id = isset($params['receiving_id']) ? (int) $params['receiving_id'] : 0;
//		$object_id = isset($params['object_id']) ? (int) $params['object_id'] : 0;
//		$object_type = isset($params['object_type']) ? (int) $params['object_type'] : 0;

		if (!$receiving_id || !$message) {
			echo $this->respondJSON(array('error' => 1));

			Yii::app()->end();
		}

		$model = new Messages();
		$model->author_id = $this->user->id;
		$model->receiving_user_id = $receiving_id;
		$model->message = nl2br($message);
		$model->created_at = time();

		if (!$model->save()) {
			echo $this->respondJSON(array('error' => 2));

			Yii::app()->end();
		}

//		$object = $object_type == Messages::GOOD ? Goods::model()->findByPk($object_id) : Vehicle::model()->findByPk($object_id);
//		if (!$this->sendEmail($model, $object))
//		{
//			echo CJavaScript::jsonEncode(array('error' => 3));
//
//			Yii::app()->end();
//		}

		$this->sendEmail($model);

		echo $this->respondJSON(array('error' => 0));

		Yii::app()->end();
	}

	public function actionDelete()
	{
		$message_id = isset($_POST['message_id']) ? (int)$_POST['message_id'] : 0;

		if (empty($message_id))
		{
			echo CJavaScript::jsonEncode(array('error' => 1));

			Yii::app()->end();
		}

		Messages::model()->updateByPk($message_id, array('is_deleted' => 1));

		echo CJavaScript::jsonEncode(array('error' => 0));

		Yii::app()->end();

	}

	private function sendEmail($model)
	{
		$message = new YiiMailMessage;

		$message->view = 'message';
		$message->setBody(array('model' => $model), 'text/html');
		$message->subject = 'Сообщение от пользователя';
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