<?php

class GoodsSearchController extends FrahtController
{
	public function __construct($id, $module = null)
	{
		parent::__construct($id, $module);

//		if (!($this->user->profiles->user_type_id == UserTypes::SHIPPER || $this->user->profiles->user_type_id == UserTypes::DISPATCHER))
//			throw new CHttpException(503, 'Вам не разрешен доступ к этой странице!');

		Yii::app()->session['redirectUrl'] = Yii::app()->getRequest()->requestUri;
	}

	public function actionIndex()
	{
		$filter = new SearchFilter();
		$listFilterRegions = array();
		$listFilterCities = array();

		if (isset($_GET))
		{
			$filter->vid = isset($_GET['vid']) ? (int) $_GET['vid'] : null;
			$filter->check_dispatcher = isset($_GET['check_dispatcher']) ? $_GET['check_dispatcher'] : '';
			$filter->date_from = isset($_GET['date_from']) ? $_GET['date_from'] : '';
			$filter->date_to = isset($_GET['date_to']) ? $_GET['date_to'] : '';
			$filter->country_id = isset($_GET['vcoid']) ? (int) $_GET['vcoid'] : null;
			$filter->region_id = isset($_GET['vrid']) ? (int) $_GET['vrid'] : null;
			$filter->city_id = isset($_GET['vcid']) ? (int) $_GET['vcid'] : null;
			$filter->country_search_id = isset($_GET['fvcoid']) ? (int) $_GET['fvcoid'] : '';
			$filter->region_search_id = isset($_GET['fvrid']) ? (int) $_GET['fvrid'] : '';
			$filter->city_search_id = isset($_GET['fvcid']) ? (int) $_GET['fvcid'] : '';
			$filter->radius = isset($_GET['radius']) && (int) $_GET['radius'] ? (int) $_GET['radius'] : 60;
			$filter->sort = isset($_GET['sort']) && (int) $_GET['sort'] ? (int) $_GET['sort'] : 0;
			$filter->direction = isset($_GET['direct']) && (int) $_GET['direct'] ? (int) $_GET['direct'] : 0;
			$filter->page = isset($_GET['page']) && (int) $_GET['page'] ? (int) $_GET['page'] : 1;
		}

		$filter->good = isset($_GET['vid']) ? Goods::model()->findByPk((int) $_GET['vid']) : null;

		if (is_object($filter->good) && isset($_GET['fs']) && $_GET['fs'] == 1)
		{
			$filter->date_from = Yii::app()->dateFormatter->format('dd.MM.yyyy', $filter->good->date_from);
			$filter->date_to = Yii::app()->dateFormatter->format('dd.MM.yyyy', $filter->good->date_to);

			$filter->country_id = $filter->good->country_id_from;
			$filter->region_id = $filter->good->region_id_from;
			$filter->city_id = $filter->good->city_id_from;

			$filter->country_search_id = $filter->good->country_id_to;
			$filter->region_search_id = $filter->good->region_id_to;
			$filter->city_search_id = $filter->good->city_id_to;
		}

		$vehicles = Vehicle::model()->getAll($filter);

		$countries = Country::model()->findAll();
		$listCountries = CHtml::listData($countries, 'id', 'name_ru');

		$listRegions = array();
		if (isset($filter->country_id) && $filter->country_id)
		{
			$listRegions = CHtml::listData(Region::model()->findAll('country_id = ' . $filter->country_id),
								'id', 'name_ru');
		}

		$listCities = array();
		if (isset($filter->region_id) && $filter->region_id)
		{
			$listCities = CHtml::listData(City::model()->findAll('region_id = ' . $filter->region_id),
								'id', 'name_ru');
		}

		$listFilterRegions = array();
		if (isset($filter->country_search_id) && $filter->country_search_id)
		{
			$listFilterRegions = CHtml::listData(Region::model()->findAll('country_id = ' . $filter->country_search_id),
							'id', 'name_ru');
		}

		$listFilterCities = array();
		if (isset($filter->region_search_id) && $filter->region_search_id)
		{
			$listFilterCities = CHtml::listData(City::model()->findAll('region_id = ' . $filter->region_search_id),
							'id', 'name_ru');
		}

		$pageSettings = array(
			'count' => $vehicles['count'],
			'page' => $filter->page,
			'pages' => ceil(($vehicles['count'] / (int) Yii::app()->params['pages']['searchCount'])),
			'sort' => isset($_GET['sort']) ? (int) $_GET['sort'] : SearchFilter::SORT_CREATED_AT,
			'direct' => isset($_GET['direct']) ? (int) $_GET['direct'] : SearchFilter::DIRECTION_DESC,
		);

		$settings = Settings::model();
//		$settings->getAutoupdate();

		$this->render('index', array(
			'vid' => $filter->vid,
			'vehicles' => $vehicles['vehicles'],
			'model' => $filter->good,
			'goodsActive' => Goods::model()->getActive(),
			'countries' => $listCountries,
			'regions' => $listRegions,
			'cities' => $listCities,
			'filterRegions' => $listFilterRegions,
			'filterCities' => $listFilterCities,
			'pageSettings' => $pageSettings,
			'filter' => $filter,
			'settings' => $settings,
		));
	}

	public function actionNew()
	{
		$model = new Goods();

		$this->processForm($model);
	}

	public function actionUpdate()
	{
//		$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
		$slug = isset($_GET['slug']) ? $_GET['slug'] : '';
//		$model = $this->loadModel($id);
		$model = $this->loadModel($slug);

		$this->processForm($model);
	}

	public function loadModel($slug)
	{
		$model = Goods::model()->find('slug = "' . $slug . '"');
		if ($model === null)
			throw new CHttpException(404, 'Данный груз не найден в базе.');
		return $model;
	}
	public function loadModelId($id)
	{
		$model = Goods::model()->findByPk($id);
		if ($model === null)
			throw new CHttpException(404, 'Данный груз не найден в базе.');
		return $model;
	}

	public function actionDelete()
	{
		$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
		$model = $this->loadModelId($id);

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
			$model->date_from = isset($data['date_from']) ? strtotime($data['date_from'] . ' 00:01') : null;
			$model->date_to = isset($data['date_to']) ? strtotime($data['date_to'] . ' 23:59') : null;
			$model->vehicle_types = isset($data['vehicle_types']) ? join(',', array_keys($data['vehicle_types'])) : null;
			$model->shipments = isset($data['shipments']) ? join(',', array_keys($data['shipments'])) : null;
			$model->body_types = isset($data['body_types']) ? join(',', array_values($data['body_types'])) : null;
			$model->permissions = isset($data['permissions']) ? join(',', array_keys($data['permissions'])) : null;
			if ($model->isNewRecord) $model->created_at = time();
			$model->updated_at = time();

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
		if (isset($model->country_id_from) && $model->country_id_from)
		{
			$listRegionsFrom = CHtml::listData($model->countryFrom->regions, 'id', 'name_ru');
		}

		$listCitiesFrom = array();
		if (isset($model->region_id_from) && $model->region_id_from)
		{
			$listCitiesFrom = CHtml::listData($model->regionFrom->cities, 'id', 'name_ru');
		}

		$listRegionsTo = array();
		if (isset($model->country_id_to) && $model->country_id_to)
		{
			$listRegionsTo = CHtml::listData($model->countryTo->regions, 'id', 'name_ru');
		}

		$listCitiesTo = array();
		if (isset($model->region_id_to) && $model->region_id_to)
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

		if (isset($model->id) && $model->id)
			$this->keywords = $model->name;

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