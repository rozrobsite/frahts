<?php

class LocationController extends Controller
{
	public function actionRegion()
	{
		$country_id = (int) Yii::app()->request->getPost('country_id');
		$country = Country::model()->findByPk($country_id);
		
		$model = new Profiles();
		$listRegions = array();
		if ($country_id)
		{
			$listRegions = CHtml::listData($country->regions, 'id', 'name_ru');
		}
		
		echo CHtml::activeDropDownList($model, 'region_id', $listRegions, array('empty' => 'Выберите регион', 'class' => 'region'));
		
		Yii::app()->end();
	}
	
	public function actionCity()
	{
		$region_id = (int) Yii::app()->request->getParam('region_id');
		$region = Region::model()->findByPk($region_id);
		
		$region_model = Region::model();
		
		$model = new Profiles();
		$listCities = array();
		if ($region_id)
		{
			$listCities = CHtml::listData($region->cities, 'id', 'name_ru');
		}
		
		echo CHtml::activeDropDownList($model, 'city_id', $listCities, array('empty' => 'Выберите населенный пункт', 'class' => 'city'));
		
		Yii::app()->end();
	}
}