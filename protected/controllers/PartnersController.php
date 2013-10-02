<?php

class PartnersController extends FrahtController
{
	const ERROR_NO = 0;
	const ERROR_NOT_AJAX = 1;
	const ERROR_WRONG_ID = 2;
	const ERROR_NOT_FOUND = 3;

	public function actionIndex()
	{
		$countries = Country::model()->findAll();
		$profiles = Profiles::model()->getUsers($this->user);

		$this->render('index', array(
			'countries' => $countries,
			'profiles' => $profiles,
		));
	}

	public function actionSearch()
	{
		$data = $_GET;

		$attributes = array(
			'partnerSearchCountry' => isset($data['partnerSearchCountry']) ? (int)$data['partnerSearchCountry'] : 0,
			'partnerSearchRegion' => isset($data['partnerSearchRegion']) ? (int)$data['partnerSearchRegion'] : 0,
			'partnerSearchCity' => isset($data['partnerSearchCity']) ? (int)$data['partnerSearchCity'] : 0,
			'partnerSearchShipper' => isset($data['partnerSearchShipper']) && $data['partnerSearchShipper'] ? true : false,
			'partnerSearchFreighter' => isset($data['partnerSearchFreighter']) && $data['partnerSearchFreighter'] ? true : false,
			'partnerSearchDispatcher' => isset($data['partnerSearchDispatcher']) && $data['partnerSearchDispatcher'] ? true : false,
			'partnerSearchWords' => isset($data['partnerSearchWords']) ? trim(strip_tags($data['partnerSearchWords'])) : '',
		);

		$searchPartners = new SearchPartners($attributes);

		$profiles = UserTags::model()->searchUsers($attributes);

		$countries = CHtml::listData(Country::model()->findAll(), 'id', 'name_ru');
		$regions = array();
		if ($searchPartners->partnerSearchCountry)
		{
			$country = Country::model()->findByPk($searchPartners->partnerSearchCountry);
			$regions = CHtml::listData($country->regions, 'id', 'name_ru');
		}
		$cities = array();
		if ($searchPartners->partnerSearchRegion)
		{
			$region = Region::model()->findByPk($searchPartners->partnerSearchRegion);
			$cities = CHtml::listData($region->cities, 'id', 'name_ru');
		}

		$this->render('search', array(
			'countries' => $countries,
			'regions' => $regions,
			'cities' => $cities,
			'profiles' => $profiles['profiles'],
			'pages' => $profiles['pages'],
			'model' => $searchPartners,
		));
	}

	public function actionFind()
	{
		if (!Yii::app()->request->isAjaxRequest || !Yii::app()->request->isPostRequest)
		{
			echo $this->respondJSON(array('error' => self::ERROR_NOT_AJAX));

			Yii::app()->end();
		}

		$data = array();
		parse_str(Yii::app()->request->getPost('data'), $data);

		$attributes = array(
			'partnerSearchCountry' => isset($data['partnerSearchCountry']) ? (int)$data['partnerSearchCountry'] : 0,
			'partnerSearchRegion' => isset($data['partnerSearchRegion']) ? (int)$data['partnerSearchRegion'] : 0,
			'partnerSearchCity' => isset($data['partnerSearchCity']) ? (int)$data['partnerSearchCity'] : 0,
			'partnerSearchShipper' => isset($data['partnerSearchShipper']) ? true : false,
			'partnerSearchFreighter' => isset($data['partnerSearchFreighter']) ? true : false,
			'partnerSearchDispatcher' => isset($data['partnerSearchDispatcher']) ? true : false,
			'partnerSearchWords' => isset($data['partnerSearchWords']) ? trim(strip_tags($data['partnerSearchWords'])) : '',
		);

		$users = UserTags::model()->searchUsers($attributes);

		echo $this->respondJSON(array('error' => self::ERROR_NO, 'response' => $searchList));

		Yii::app()->end();
	}

	public function actionAdd()
	{
		if (!Yii::app()->request->isAjaxRequest || !Yii::app()->request->isPostRequest)
		{
			echo $this->respondJSON(array('error' => self::ERROR_NOT_AJAX));

			Yii::app()->end();
		}

		$partnerId = isset($_POST['partner_id']) ? (int) $_POST['partner_id'] : 0;

		if (!$partnerId)
		{
			echo $this->respondJSON(array('error' => self::ERROR_WRONG_ID));

			Yii::app()->end();
		}

		$user = Users::model()->findByPk($partnerId);

		if (!is_object($user))
		{
			echo $this->respondJSON(array('error' => self::ERROR_NOT_FOUND));

			Yii::app()->end();
		}

		$partner = new Partners();
		$partner->user_id = $this->user->id;
		$partner->partner_id = $partnerId;

		$isAdd = $partner->insert();

		echo $this->respondJSON(array('error' => self::ERROR_NO, 'isAdd' => $isAdd));

		Yii::app()->end();
	}

	public function actionRemove()
	{
		if (!Yii::app()->request->isAjaxRequest || !Yii::app()->request->isPostRequest)
		{
			echo $this->respondJSON(array('error' => self::ERROR_NOT_AJAX));

			Yii::app()->end();
		}

		$partnerId = isset($_POST['partner_id']) ? (int) $_POST['partner_id'] : 0;

		if (!$partnerId)
		{
			echo $this->respondJSON(array('error' => self::ERROR_WRONG_ID));

			Yii::app()->end();
		}

		$user = Users::model()->findByPk($partnerId);

		if (!is_object($user))
		{
			echo $this->respondJSON(array('error' => self::ERROR_NOT_FOUND));

			Yii::app()->end();
		}

		$isRemove = Partners::model()->deleteAll('user_id = ' . $this->user->id . ' AND partner_id = ' . $partnerId);

		echo $this->respondJSON(array('error' => self::ERROR_NO, 'isRemove' => $isRemove));

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