<?php

class PartnersController extends FrahtController
{
	const ERROR_NO = 0;
	const ERROR_NOT_AJAX = 1;

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
			'profiles' => $profiles,
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