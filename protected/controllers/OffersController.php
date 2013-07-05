<?php

class OffersController extends FrahtController
{
	public function actionIndex()
	{
		$this->render('index');
	}

	public function actionAdd()
	{
		$receiving_user_id = isset($_POST['receiving_user_id']) ? (int) $_POST['receiving_user_id'] : 0;
		$model_id = isset($_POST['model_id']) ? (int) $_POST['model_id'] : 0;
		$model_type = isset($_POST['model_type']) ? (int) $_POST['model_type'] : 0;

		if (empty($receiving_user_id) || empty($model_id) || empty($model_type) || ($model_type != Offers::TYPE_GOOD && $model_type != Offers::TYPE_VEHICLE))
		{
			echo $this->respondJSON(array('error' => 1));

			Yii::app()->end();
		}

		$offer = new Offers();
		$offer->author_id = $this->user->id;
		$offer->receiving_user_id = $receiving_user_id;
		$offer->created_at = time();
		if ($model_type == Offers::TYPE_GOOD)
			$offer->good_id = $model_id;
		else
			$offer->vehicle_id = $model_id;

		if (!$offer->save())
		{
			echo $this->respondJSON(array('error' => 1, 'message'=>$offer->getErrors()));

			Yii::app()->end();
		}

		echo $this->respondJSON(array('error' => 0, 'id' => $offer->id));

		Yii::app()->end();

	}

	public function actionRefuse()
	{
		$id = isset($_POST['id']) ? (int) $_POST['id'] : 0;

		if (empty($id))
		{
			echo $this->respondJSON(array('error' => 1));

			Yii::app()->end();
		}

		$offer = Offers::model()->findByPk($id);
		if ($offer->author->id != $this->user->id && $offer->receivingUser->id != $this->user->id)
		{
			echo $this->respondJSON(array('error' => 1));

			Yii::app()->end();
		}

		if (!$offer->deleteByPk($id))
		{
			echo $this->respondJSON(array('error' => 1, 'message'=>$offer->getErrors()));

			Yii::app()->end();
		}

		echo $this->respondJSON(array('error' => 0));

		Yii::app()->end();

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