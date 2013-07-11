<?php

class OffersController extends FrahtController
{
	public function actionIndex()
	{
		$model = Offers::model();
		$userOffers = $model->getUsersOffers($this->user, Offers::OFFER_TYPE_USERS);
		$forUserOffers = $model->getUsersOffers($this->user, Offers::OFFER_TYPE_FOR_USERS);
		$newOffersCount = $model->count('receiving_user_id = ' . $this->user->id . ' AND is_view = 0');

		if ($newOffersCount)
			$model->updateAll(array('is_view' => 1), 'receiving_user_id = ' . $this->user->id);

		$this->render('index', array(
			'userOffers' => $userOffers,
			'forUserOffers' => $forUserOffers,
			'newOffersCount' => $newOffersCount,
		));
	}

	public function actionAdd()
	{
		$receivingUserId = isset($_POST['receiving_user_id']) ? (int) $_POST['receiving_user_id'] : 0;
		$modelId = isset($_POST['model_id']) ? (int) $_POST['model_id'] : 0;
		$modelType = isset($_POST['model_type']) ? (int) $_POST['model_type'] : 0;
		$offerVehicleId = isset($_POST['offer_vehicle']) ? (int) $_POST['offer_vehicle'] : 0;
		$offerCost = isset($_POST['offer_cost']) ? (int) $_POST['offer_cost'] : 0;
		$offerCurrencyId = isset($_POST['offer_currency']) ? (int) $_POST['offer_currency'] : 0;
		$offerGoodId = isset($_POST['offer_good']) ? (int) $_POST['offer_good'] : 0;

		if (empty($receivingUserId) || empty($modelId) || empty($modelType) || ($modelType != Offers::TYPE_GOOD && $modelType != Offers::TYPE_VEHICLE))
		{
			echo $this->respondJSON(array('error' => 1));

			Yii::app()->end();
		}

		if (($modelType == Offers::TYPE_GOOD && empty($offerVehicleId)) || ($modelType == Offers::TYPE_VEHICLE && empty($offerGoodId)) || empty($offerCurrencyId))
		{
			echo $this->respondJSON(array('error' => 2));

			Yii::app()->end();
		}

		if (empty($offerCost))
		{
			echo $this->respondJSON(array('error' => 3));

			Yii::app()->end();
		}

		$offer = new Offers();
		$offer->author_id = $this->user->id;
		$offer->receiving_user_id = $receivingUserId;
		$offer->created_at = time();
		$offer->cost = $offerCost;
		$offer->currency_id = $offerCurrencyId;

		if ($modelType == Offers::TYPE_GOOD)
		{
			$offer->good_id = $modelId;
			$offer->offer_vehicle_id = $offerVehicleId;
		}
		else
		{
			$offer->vehicle_id = $modelId;
			$offer->offer_good_id = $offerGoodId;
		}

		if (!$offer->save())
		{
			echo $this->respondJSON(array('error' => 4, 'message'=>$offer->getErrors()));

			Yii::app()->end();
		}

		echo $this->respondJSON(array('error' => 0, 'id' => $offer->id));

		Yii::app()->end();

	}

	public function actionCancel()
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

	public function actionAccept()
	{
		$id = isset($_POST['id']) ? (int) $_POST['id'] : 0;

		if (empty($id))
		{
			echo $this->respondJSON(array('error' => 1));

			Yii::app()->end();
		}

		$offer = Offers::model()->findByPk($id);
		if ($offer->receiving_user_id != $this->user->id)
		{
			echo $this->respondJSON(array('error' => 2));

			Yii::app()->end();
		}

		if ($offer->result == Offers::RESULT_IN_ACCEPT)
		{
			echo $this->respondJSON(array('error' => 3));

			Yii::app()->end();
		}

		$offer->result = Offers::RESULT_IN_ACCEPT;
		$offer->result_date_at = time();

		if (!$offer->save())
		{
			echo $this->respondJSON(array('error' => 4, 'message'=>$offer->getErrors()));

			Yii::app()->end();
		}

		$where = $offer->good_id ? 'good_id = ' . $offer->good_id : 'vehicle_id = ' . $offer->vehicle_id;

		Offers::model()->updateAll(array('result' => Offers::RESULT_IN_REFUSE, 'result_date_at' => time()), $where . ' AND receiving_user_id = ' . $offer->receiving_user_id . ' AND id <> ' . $offer->id);

		$offersRefuse = Offers::model()->findAll($where . ' AND receiving_user_id = ' . $offer->receiving_user_id . ' AND id <> ' . $offer->id);
		if (count($offersRefuse))
			$this->sendEmailRefuse($offersRefuse);

		$this->sendEmailAccept($offer);

		echo $this->respondJSON(array('error' => 0));

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
		if ($offer->receiving_user_id != $this->user->id)
		{
			echo $this->respondJSON(array('error' => 2));

			Yii::app()->end();
		}


		if ($offer->result == Offers::RESULT_IN_REFUSE)
		{
			echo $this->respondJSON(array('error' => 3));

			Yii::app()->end();
		}

		$offer->result = Offers::RESULT_IN_REFUSE;
		$offer->result_date_at = time();

		if (!$offer->save())
		{
			echo $this->respondJSON(array('error' => 4, 'message'=>$offer->getErrors()));

			Yii::app()->end();
		}

		$this->sendEmailRefuse(array($offer));

		echo $this->respondJSON(array('error' => 0));

		Yii::app()->end();
	}

	public function actionCancelForUsersOffer()
	{
		$id = isset($_POST['id']) ? (int) $_POST['id'] : 0;

		if (empty($id))
		{
			echo $this->respondJSON(array('error' => 1));

			Yii::app()->end();
		}

		$offer = Offers::model()->findByPk($id);
		if ($offer->receiving_user_id != $this->user->id)
		{
			echo $this->respondJSON(array('error' => 2));

			Yii::app()->end();
		}

		$offer->result = Offers::RESULT_IN_PROCESS;
		$offer->result_date_at = 0;

		if (!$offer->save())
		{
			echo $this->respondJSON(array('error' => 3, 'message'=>$offer->getErrors()));

			Yii::app()->end();
		}

		echo $this->respondJSON(array('error' => 0));

		Yii::app()->end();
	}

	public function actionCancelUsersOffer()
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

	private function sendEmailAccept($offer)
	{
		$message = new YiiMailMessage;

		$message->view = $offer->good_id ? 'messageGoodOwnerAccept' : 'messageVehicleOwnerAccept';
		$message->setBody(array('author' => $offer), 'text/plain');
		$message->subject = Yii::app()->params['siteName'] . ': Сообщение от пользователя';
		$message->addTo($offer->author->email);
		$message->from = Yii::app()->params['adminEmail'];

		Yii::app()->mail->send($message);
	}

	private function sendEmailRefuse($offersRefuse)
	{
		foreach ($offersRefuse as $offer)
		{
			$message = new YiiMailMessage;

			$message->view = $offer->good_id ? 'messageGoodOwnerRefuse' : 'messageVehicleOwnerRefuse';
			$message->setBody(array('author' => $offer), 'text/plain');
			$message->subject = Yii::app()->params['siteName'] . ': Сообщение от пользователя';
			$message->addTo($offer->author->email);
			$message->from = Yii::app()->params['adminEmail'];

			Yii::app()->mail->send($message);
		}
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