<?php

class VehicleSearchController extends FrahtController
{
	public function __construct($id, $module = null)
	{
		parent::__construct($id, $module);

		if (!($this->user->profiles->user_type_id == UserTypes::FREIGHTER || $this->user->profiles->user_type_id == UserTypes::DISPATCHER))
				throw new CHttpException(503, 'Вам не разрешен доступ к этой странице!');

		Yii::app()->session['redirectUrl'] = Yii::app()->getRequest()->requestUri;
	}

	public function actionIndex()
	{
		Yii::app()->session['redirectUrl'] = Yii::app()->getRequest()->requestUri;

		$filter = new SearchFilter();

		if (isset($_GET))
		{
			$filter->vid = isset($_GET['vid']) ? (int) $_GET['vid'] : null;
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

		$filter->vehicle = isset($_GET['vid']) ? Vehicle::model()->findByPk((int) $_GET['vid']) : null;

		if (is_object($filter->vehicle) && isset($_GET['fs']) && $_GET['fs'] == 1)
		{
			$filter->date_from = Yii::app()->dateFormatter->format('dd.MM.yyyy', $filter->vehicle->date_from);
			$filter->date_to = Yii::app()->dateFormatter->format('dd.MM.yyyy', $filter->vehicle->date_to);

			$filter->country_id = $filter->vehicle->country_id;
			$filter->region_id = $filter->vehicle->region_id;
			$filter->city_id = $filter->vehicle->city_id;

			if ($filter->vehicle->country_id_to)
			{
				$filter->country_search_id = $filter->vehicle->country_id_to;
			}
			if ($filter->vehicle->region_id_to)
			{
				$filter->region_search_id = $filter->vehicle->region_id_to;
			}
			if ($filter->vehicle->city_id_to)
			{
				$filter->city_search_id = $filter->vehicle->city_id_to;
			}
		}

		$goods = Goods::model()->getAll($filter);

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
			'count' => $goods['count'],
			'page' => $filter->page,
			'pages' => ceil(($goods['count'] / (int) Yii::app()->params['pages']['searchCount'])),
			'sort' => isset($_GET['sort']) ? (int) $_GET['sort'] : SearchFilter::SORT_CREATED_AT,
			'direct' => isset($_GET['direct']) ? (int) $_GET['direct'] : SearchFilter::DIRECTION_DESC,
		);

		$settings = Settings::model();
//		$settings->getAutoupdate();

		$this->render('index',
				array(
			'vid' => $filter->vid,
			'vehicleActive' => Vehicle::model()->findAllByDeleted(false),
			'goods' => $goods['goods'],
			'model' => $filter->vehicle,
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

	public function actionLocation()
	{
		if (isset($_GET))
		{
			$vid = isset($_GET['vid']) ? (int) $_GET['vid'] : null;
			$country_id = isset($_GET['vcoid']) ? (int) $_GET['vcoid'] : null;
			$region_id = isset($_GET['vrid']) ? (int) $_GET['vrid'] : null;
			$city_id = isset($_GET['vcid']) ? (int) $_GET['vcid'] : null;

			if (!$country_id || !$region_id || !$city_id)
			{
				Yii::app()->user->setFlash('_error',
						'Не правильно указано текущее расположение транспорта!');
			}
			else
			{
				$rows = Vehicle::model()->updateAll(
						array('country_id' => $country_id, 'region_id' => $region_id, 'city_id' => $city_id, 'updated_at' => time()),
						"id = $vid"
				);

				if (isset($rows) && $rows)
						Yii::app()->user->setFlash('_success',
							'Текущее расположение транспорта изменено.');
			}
		}

		$this->redirect('/vehicle/search/vid/' . $vid);
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