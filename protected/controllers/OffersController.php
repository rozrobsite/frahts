<?php

class OffersController extends FrahtController
{
	public function actionIndex()
	{
		$model = Offers::model();
		$userOffers = $model->getUsersOffers($this->user, Offers::OFFER_TYPE_USERS);
		$forUserOffers = $model->getUsersOffers($this->user, Offers::OFFER_TYPE_FOR_USERS);
		
		$this->render('index', array(
			'userOffers' => $userOffers,
			'forUserOffers' => $forUserOffers,
		));
	}

	public function actionAdd()
	{
		$receivingUserId = isset($_POST['receiving_user_id']) ? (int) $_POST['receiving_user_id'] : 0;
		$modelId = isset($_POST['model_id']) ? (int) $_POST['model_id'] : 0;
		$modelType = isset($_POST['model_type']) ? (int) $_POST['model_type'] : 0;

		if (empty($receivingUserId) || empty($modelId) || empty($modelType) || ($modelType != Offers::TYPE_GOOD && $modelType != Offers::TYPE_VEHICLE))
		{
			echo $this->respondJSON(array('error' => 1));

			Yii::app()->end();
		}

		$offer = new Offers();
		$offer->author_id = $this->user->id;
		$offer->receiving_user_id = $receivingUserId;
		$offer->created_at = time();
		if ($modelType == Offers::TYPE_GOOD)
			$offer->good_id = $modelId;
		else
			$offer->vehicle_id = $modelId;

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
		if ($offer->author_id != $this->user->id)
		{
			echo $this->respondJSON(array('error' => 2));

			Yii::app()->end();
		}

		if (!$offer->deleteByPk($id))
		{
			echo $this->respondJSON(array('error' => 3, 'message'=>$offer->getErrors()));

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