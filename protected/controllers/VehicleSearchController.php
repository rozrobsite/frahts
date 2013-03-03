<?php

class VehicleSearchController extends FrahtController
{
	public function __construct($id, $module = null)
	{
		parent::__construct($id, $module);
		
		if (!($this->user->profiles->user_type_id == UserTypes::FREIGHTER || $this->user->profiles->user_type_id == UserTypes::DISPATCHER))
			throw new CHttpException(503, 'Вам не разрешен доступ к этой странице!');
	}
	
	public function actionIndex()
	{
		$this->render('index', array(
			'vehicleActive' => Vehicle::model()->findAllByDeleted(false),
			'goods' => array(),
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