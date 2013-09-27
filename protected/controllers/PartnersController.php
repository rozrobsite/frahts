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
		$countries = Country::model()->findAll();
//		$profiles = Profiles::model()->getUsers($this->user);

		$data = $_GET;
//		parse_str(Yii::app()->request->getPost('data'), $data);

		$attributes = array(
			'partnerSearchCountry' => isset($data['partnerSearchCountry']) ? (int)$data['partnerSearchCountry'] : 0,
			'partnerSearchRegion' => isset($data['partnerSearchRegion']) ? (int)$data['partnerSearchRegion'] : 0,
			'partnerSearchCity' => isset($data['partnerSearchCity']) ? (int)$data['partnerSearchCity'] : 0,
			'partnerSearchShipper' => isset($data['partnerSearchShipper']) ? true : false,
			'partnerSearchFreighter' => isset($data['partnerSearchFreighter']) ? true : false,
			'partnerSearchDispatcher' => isset($data['partnerSearchDispatcher']) ? true : false,
			'partnerSearchWords' => isset($data['partnerSearchWords']) ? trim(strip_tags($data['partnerSearchWords'])) : '',
		);

		$profiles = UserTags::model()->searchUsers($attributes);

		$this->render('search', array(
			'countries' => $countries,
			'profiles' => $profiles,
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