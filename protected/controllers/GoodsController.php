<?php

class GoodsController extends FrahtController
{
	public function __construct($id, $module = null)
	{
		parent::__construct($id, $module);

		if (!($this->user->profiles->user_type_id == UserTypes::SHIPPER || $this->user->profiles->user_type_id == UserTypes::DISPATCHER))
			throw new CHttpException(503, 'Вам не разрешен доступ к этой странице!');
	}

	public function actionIndex()
	{
//		$this->render('index', array(
//			'vehicles' => $vehicles,
//			'goodsActive' => Goods::model()->getActive(),
//			'goodsNoActive' => Goods::model()->getActive(Goods::NO_ACTIVE),
//		));

		$this->render('index');
	}

	public function actionInactive()
	{
		$this->render('inActive', array(
			'goodsActive' => Goods::model()->getActive(),
			'goodsNoActive' => Goods::model()->getActive(Goods::NO_ACTIVE),
		));
	}

	public function actionView()
	{
		$slug = isset($_GET['slug']) ? trim($_GET['slug']) : '';

		$model = Goods::model()->find('slug = "' . $slug . '" AND is_deleted = 0 AND date_to >= ' . time());
		$vehicleTypes = VehicleTypes::model()->findAll('id IN (' . $model->vehicle_types . ')');
		$vehicleTypesArray = CHtml::listData($vehicleTypes, 'id', 'name_ru');

		$bodyTypes = BodyTypes::model()->findAll('id IN (' . $model->body_types . ')');
		$bodyTypesArray = CHtml::listData($bodyTypes, 'id', 'name_ru');

		$shipments = Shipment::model()->findAll('id IN (' . $model->shipments . ')');
		$shipmentsArray = CHtml::listData($shipments, 'id', 'name_ru');

		$permissions = Permissions::model()->findAll('id IN (' . $model->permissions . ')');
		$permissionsArray = CHtml::listData($permissions, 'id', 'name_ru');
		if (array_key_exists(Permissions::ADR, $permissionsArray))
		{
			$permissionsArray[Permissions::ADR] = $permissionsArray[Permissions::ADR] . ' (' . $model->adr . ')';
		}
		
		if (!is_object($model))
			throw new CHttpException(404, 'Страница груза не найдена!');

		$this->render('view',array(
			'model' => $model,
			'vehicleTypes' => join(', ', $vehicleTypesArray),
			'bodyTypes' => join(', ', $bodyTypesArray),
			'shipments' => join(', ', $shipmentsArray),
			'permissions' => join(', ', $permissionsArray),
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