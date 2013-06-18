<?php

class GoodsController extends FrahtController
{

	public function __construct($id, $module = null)
	{
		parent::__construct($id, $module);

		if (!($this->user->profiles->user_type_id == UserTypes::SHIPPER || $this->user->profiles->user_type_id == UserTypes::DISPATCHER))
				throw new CHttpException(503, 'Вам не разрешен доступ к этой странице!');

		Yii::app()->session['redirectUrl'] = Yii::app()->getRequest()->requestUri;
	}

	public function actionIndex()
	{
		$this->render('index');
	}

	public function actionInactive()
	{
		$this->render('inActive',
				array(
			'goodsActive' => Goods::model()->getActive(),
			'goodsNoActive' => Goods::model()->getActive(Goods::NO_ACTIVE),
		));
	}

	public function actionView()
	{
		$slug = isset($_GET['slug']) ? trim($_GET['slug']) : '';

		$model = Goods::model()->find('slug = "' . $slug . '" AND is_deleted = 0 AND date_to >= ' . time());
		if (!is_object($model))
				throw new CHttpException(404, 'Страница груза не найдена!');
		
		$vehicleTypes = '';
		$vehicleTypesArray = array();
		if ($model->vehicle_types)
		{
			$vehicleTypes = VehicleTypes::model()->findAll('id IN (' . $model->vehicle_types . ')');
			$vehicleTypesArray = CHtml::listData($vehicleTypes, 'id', 'name_ru');
		}
		
		$bodyTypes = '';
		$bodyTypesArray = array();
		if ($model->body_types)
		{
			$bodyTypes = BodyTypes::model()->findAll('id IN (' . $model->body_types . ')');
			$bodyTypesArray = CHtml::listData($bodyTypes, 'id', 'name_ru');
		}

		$shipments = '';
		$shipmentsArray = array();
		if ($model->shipments)
		{
			$shipments = Shipment::model()->findAll('id IN (' . $model->shipments . ')');
			$shipmentsArray = CHtml::listData($shipments, 'id', 'name_ru');
		}

		$permissions = '';
		$permissionsArray = array();
		if ($model->permissions)
		{
			$permissions = Permissions::model()->findAll('id IN (' . $model->permissions . ')');
			$permissionsArray = CHtml::listData($permissions, 'id', 'name_ru');
			if (array_key_exists(Permissions::ADR, $permissionsArray))
			{
				$permissionsArray[Permissions::ADR] = $permissionsArray[Permissions::ADR] . ' (' . $model->adr . ')';
			}
		}

		Yii::app()->session['good_id'] = (int) $model->id;

		$this->render('view',
				array(
			'model' => $model,
			'vehicleTypes' => join(', ', $vehicleTypesArray),
			'bodyTypes' => join(', ', $bodyTypesArray),
			'shipments' => join(', ', $shipmentsArray),
			'permissions' => join(', ', $permissionsArray),
		));
	}

	public function actionIncidental()
	{
		$coordinatesStr = isset($_POST['coordinates']) ? $_POST['coordinates'] : array();
		$coordinatesArrayStr = explode(';', $coordinatesStr);

		$coordinates = array();
		foreach ($coordinatesArrayStr as $coordinate)
		{
			$tmpArray = explode(',', $coordinate);

			if (!isset($tmpArray[0]) || !isset($tmpArray[1])) continue;

			$coordinates[] = array((float) $tmpArray[0], (float) $tmpArray[1]);
		}

		$firstCoordinates = array_shift($coordinates);

		if (!$firstCoordinates)
		{
			echo CJavaScript::jsonEncode(array('error' => 1));

			Yii::app()->end();

			return;
		}

//		$desiredCoordinates = array($coordinates[0]);
		$desiredCoordinates = array();

		$currentLatitude = $coordinates[0][0];
		$currentLongitude = $coordinates[0][1];
		$countCoordinates = count($coordinates);
		for ($index = 1; $index < $countCoordinates; $index++)
		{
			$distance = FHelper::distance($currentLatitude, $currentLongitude,
							$coordinates[$index][0], $coordinates[$index][1]);
			if ($distance < (Yii::app()->params['defaultRadius'] * 2)) continue;

			$desiredCoordinates[] = $coordinates[$index];
			$currentLatitude = $coordinates[$index][0];
			$currentLongitude = $coordinates[$index][1];
		}

//		$desiredCoordinates[] = $coordinates[$countCoordinates - 1];

		$good_id = isset(Yii::app()->session['good_id']) ? (int) Yii::app()->session['good_id']
					: 0;
		$vehicle_id = isset(Yii::app()->session['vehicle_id']) ? (int) Yii::app()->session['vehicle_id']
					: 0;
		$date_from = isset(Yii::app()->session['date_from']) ? Yii::app()->session['date_from']
					: '';
		$date_to = isset(Yii::app()->session['date_to']) ? Yii::app()->session['date_to']
					: '';

		if (!$good_id)
		{
			echo CJavaScript::jsonEncode(array('error' => 1));

			Yii::app()->end();

			return;
		}

		$good = Goods::model()->findByPk($good_id);
		$incidentalGoods = $good->searchIncidental($vehicle_id, $desiredCoordinates,
				$date_from, $date_to);

		echo CJavaScript::jsonEncode(array('error' => 0, 'goods' => $incidentalGoods));

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