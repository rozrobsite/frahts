<?php

class LocationController extends AdminController
{

	public function __construct($id, $module = null)
	{
		parent::__construct($id, $module);
	}

	public function actionIndex()
	{
		$this->redirect('/admin/location/countries');
	}

	public function actionCountries()
	{
		if (isset($_POST['Country']))
		{
			if (!empty($_POST['Country']['name_ru']))
			{
				$country = Country::model();

				$criteria = new CDbCriteria;
				$criteria->select = 'MAX(id) as maxid';

				$max_id = $country->find($criteria)->maxid;

				$newCountry = new Country();
				$newCountry->id = (int) $max_id + 1;
				$newCountry->name_ru = $_POST['Country']['name_ru'];
				$newCountry->insert();

				unset($newCountry);
				unset($country);
			}
		}

		$this->render('countries', array(
			'country' => new Country(),
		));
	}

	public function actionRegions()
	{
		if (isset($_POST['Region']))
		{
			if (!empty($_POST['Region']['name_ru']) && isset($_POST['Region']['country_id']))
			{
				$region = Region::model();

				$criteria = new CDbCriteria;
				$criteria->select = 'MAX(id) as maxid';

				$max_id = $region->find($criteria)->maxid;

				$newRegion = new Region();
				$newRegion->id = (int) $max_id + 1;
				$newRegion->country_id = (int) $_POST['Region']['country_id'];
				$newRegion->name_ru = $_POST['Region']['name_ru'];
				$newRegion->insert();

				unset($newRegion);
				unset($region);
			}
		}

		$region = new Region();
		if (isset($_REQUEST['Region']['country_id']))
		{
			$region->country_id = (int) $_REQUEST['Region']['country_id'];
		}

		$countries = Country::model()->findAll(array('order' => 'name_ru'));
		$listCountries = CHtml::listData($countries, 'id', 'name_ru');

		$this->render('regions',
				array(
			'countries' => $listCountries,
			'region' => $region,
		));
	}
	
	public function actionCities()
	{
		if (isset($_POST['City']))
		{
			if (!empty($_POST['City']['name_ru']) && isset($_POST['City']['country_id']) && isset($_POST['City']['region_id']))
			{
				$city = City::model();

				$criteria = new CDbCriteria;
				$criteria->select = 'MAX(id) as maxid';

				$max_id = $city->find($criteria)->maxid;

				$newCity = new City();
				$newCity->id = (int) $max_id + 1;
				$newCity->country_id = (int) $_POST['City']['country_id'];
				$newCity->region_id = (int) $_POST['City']['region_id'];
				$newCity->name_ru = $_POST['City']['name_ru'];
				$newCity->insert();

				unset($newCity);
				unset($city);
			}
		}

		$city = new City();
		$listRegions = array();
		if (isset($_REQUEST['City']['country_id']))
		{
			$city->country_id = (int) $_REQUEST['City']['country_id'];
			$listRegions = CHtml::listData($city->country->regions, 'id', 'name_ru');
		}
		if (isset($_REQUEST['City']['region_id']))
		{
			$city->region_id = (int) $_REQUEST['City']['region_id'];
		}

		$countries = Country::model()->findAll(array('order' => 'name_ru'));
		$listCountries = CHtml::listData($countries, 'id', 'name_ru');

		$this->render('cities',
				array(
			'countries' => $listCountries,
			'regions' => $listRegions,
			'city' => $city,
		));
	}

	public function actionCountryedit()
	{
		if (isset($_POST['name']) && isset($_POST['pk']) && isset($_POST['value']))
		{
			Country::model()->updateByPk((int) $_POST['pk'],
					array($_POST['name'] => $_POST['value']));
		}
	}

	public function actionRegionedit()
	{
		if (isset($_POST['name']) && isset($_POST['pk']) && isset($_POST['value']))
		{
			Region::model()->updateByPk((int) $_POST['pk'],
					array($_POST['name'] => $_POST['value']));
		}
	}

	public function actionCityedit()
	{
		if (isset($_POST['name']) && isset($_POST['pk']) && isset($_POST['value']))
		{
			City::model()->updateByPk((int) $_POST['pk'],
					array($_POST['name'] => $_POST['value']));
		}
	}

	public function actionDelete()
	{
		if (isset($_GET['id']) && isset($_GET['type']))
		{
			$type = $this->_getModel($_GET['type']);
			if ($type != null)
			{
				$type->deleteByPk((int) $_GET['id']);
			}
		}
	}

	private function _getModel($typeName)
	{
		switch ($typeName)
		{
			case 'Country':
				return Country::model();
			case 'Region':
				return Region::model();
			case 'City':
				return City::model();
			default :
				return null;
		}
	}

}