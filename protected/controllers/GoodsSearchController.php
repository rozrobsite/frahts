<?php

class GoodsSearchController extends FrahtController
{
	public function __construct($id, $module = null)
	{
		parent::__construct($id, $module);
		
		if (!($this->user->profiles->user_type_id == UserTypes::SHIPPER || $this->user->profiles->user_type_id == UserTypes::DISPATCHER))
			throw new CHttpException(503, 'Вам не разрешен доступ к этой странице!');
	}
	
	public function actionIndex()
	{
//		$vehicles = Vehicle::model()->findAll(array('order' => 'created_at DESC'));
		$vehicles = array();
		$this->render('index', array(
			'vehicles' => $vehicles,
			'goodsActive' => Goods::model()->getActive(),
//			'goodsNoActive' => Goods::model()->getActive(Goods::NO_ACTIVE),
		));
	}
	
	public function actionNew()
	{
		$model = new Goods();
		
		$this->processForm($model);
	}
	
	public function actionUpdate()
	{
		$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
		$model = $this->loadModel($id);

		$this->processForm($model);
	}
	
	public function loadModel($id)
	{
		$model = Goods::model()->findByPk($id);
		if ($model === null)
			throw new CHttpException(404, 'Данный груз не найден в базе.');
		return $model;
	}
	
	public function actionDelete()
	{
		$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
		$model = $this->loadModel($id);
		
		if ($model->deleteFromSearch())
		{
			Yii::app()->user->setFlash('_success', 'Груз №' . $model->id . ' удален из поиска.');
		}
		else
		{
			Yii::app()->user->setFlash('_error', 'Груз №' . $model->id . ' не был удален из поиска.');
		}
		
		$this->redirect('/goods/search');
	}
	
	private function processForm(Goods $model)
	{
		if (isset($_POST['Goods']))
		{
			$data = $_POST['Goods'];
			$model->attributes = $data;
			$model->user_id = $this->user->id;
			$model->date_from = isset($data['date_from']) ? strtotime($data['date_from']) : null;
			$model->date_to = isset($data['date_to']) ? strtotime($data['date_to']) : null;
			$model->vehicle_types = isset($data['vehicle_types']) ? join(',', array_keys($data['vehicle_types'])) : null;
			$model->shipments = isset($data['shipments']) ? join(',', array_keys($data['shipments'])) : null;
			$model->body_types = isset($data['body_types']) ? join(',', array_values($data['body_types'])) : null;
			$model->permissions = isset($data['permissions']) ? join(',', array_keys($data['permissions'])) : null;
			$model->created_at = $model->updated_at = time();

			if (isset($_POST['ajax']) && $_POST['ajax'] === 'goodsForm')
			{
				echo CActiveForm::validate(array($model), null, false);
				Yii::app()->end();
			}
			
			if ($model->save())
			{
				if ($model->isNewRecord)
					Yii::app()->user->setFlash('_success',
						'Груз добавлен в базу успешно.');
				else
					Yii::app()->user->setFlash('_success',
						'Данные о грузе обновлены успешно.');
				$this->redirect('/goods/search');
			}
			else
			{
				if ($model->isNewRecord)
					Yii::app()->user->setFlash('_error',
						'Допущены ошибки при добавлении груза.');
				else
					Yii::app()->user->setFlash('_error',
						'Допущены ошибки при сохранении груза.');
			}
		}
		
		$vehicleTypes = VehicleTypes::model()->findAll(array('order' => 'name_ru'));
		$listVehicleTypes = CHtml::listData($vehicleTypes, 'id', 'name_ru');

		$countries = Country::model()->findAll();
		$listCountries = CHtml::listData($countries, 'id', 'name_ru');

		$listRegionsFrom = array();
		if (isset($model->region_id_from) && $model->region_id_from)
		{
			$listRegionsFrom = CHtml::listData($model->countryFrom->regions, 'id', 'name_ru');
		}

		$listCitiesFrom = array();
		if (isset($model->city_id_from) && $model->city_id_from)
		{
			$listCitiesFrom = CHtml::listData($model->regionFrom->cities, 'id', 'name_ru');
		}

		$listRegionsTo = array();
		if (isset($model->region_id_to) && $model->region_id_to)
		{
			$listRegionsTo = CHtml::listData($model->countryTo->regions, 'id', 'name_ru');
		}

		$listCitiesTo = array();
		if (isset($model->city_id_to) && $model->city_id_to)
		{
			$listCitiesTo = CHtml::listData($model->regionTo->cities, 'id', 'name_ru');
		}
		
		$bodyTypes = BodyTypes::model()->findAll(array('order' => 'order_by'));
		$listBodyTypes = CHtml::listData($bodyTypes, 'id', 'name_ru');

		$shipments = Shipment::model()->findAll(array('order' => 'name_ru'));

		$permissions = Permissions::model()->findAll(array('order' => 'name_ru'));

		$vehicleTypesChecked = $model->vehicle_types ? explode(',', $model->vehicle_types) : array();
		$shipmentsChecked = $model->shipments ? explode(',', $model->shipments) : array();
		$permissionsChecked = $model->permissions ? explode(',', $model->permissions) : array();
		$bodyTypesChecked = $model->body_types ? explode(',', $model->body_types) : array();
		
		$currencies = Currency::model()->findAll(array('order' => 'id'));
		$payments = PaymentType::model()->findAll(array('order' => 'name_ru'));
		
		$vehicles = array();
		
		$this->render('_goods', array(
			'vehicles' => $vehicles,
			'goodsActive' => Goods::model()->getActive(),
			'goodsNoActive' => Goods::model()->getActive(Goods::NO_ACTIVE),
			'vehicleTypes' => $vehicleTypes,
			'countries' => $listCountries,
			'regionsFrom' => $listRegionsFrom,
			'citiesFrom' => $listCitiesFrom,
			'regionsTo' => $listRegionsTo,
			'citiesTo' => $listCitiesTo,
			'bodyTypes' => $bodyTypes,
			'shipments' => $shipments,
			'permissions' => $permissions,
			'shipmentsChecked' => $shipmentsChecked,
			'permissionsChecked' => $permissionsChecked,
			'vehicleTypesChecked' => $vehicleTypesChecked,
			'bodyTypesChecked' => $bodyTypesChecked,
			'currencies' => CHtml::listData($currencies, 'id', 'name_ru'),
			'payments' => CHtml::listData($payments, 'id', 'name_ru'),
			'model' => $model,
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