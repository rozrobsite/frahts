<?php

class CatalogController extends JokerController
{

    public function __construct($id, $module = null)
    {
        parent::__construct($id, $module);
    }

    public function actionIndex()
    {
        $data = $_GET;

        $attributes = array(
            'serviceCountry' => isset($data['serviceCountry']) ? (int) $data['serviceCountry'] : 0,
            'serviceRegion' => isset($data['serviceRegion']) ? (int) $data['serviceRegion'] : 0,
            'serviceCity' => isset($data['serviceCity']) ? (int) $data['serviceCity'] : 0,
            'serviceRouteCountry' => isset($data['serviceRouteCountry']) ? (int) $data['serviceRouteCountry'] : 0,
            'serviceRouteRegion' => isset($data['serviceRouteRegion']) ? (int) $data['serviceRouteRegion'] : 0,
            'serviceRouteCity' => isset($data['serviceRouteCity']) ? (int) $data['serviceRouteCity'] : 0,
            'serviceBusinessTypes' => isset($data['serviceBusinessTypes']) ? $data['serviceBusinessTypes'] : array(),
            'serviceWords' => isset($data['serviceWords']) ? trim(strip_tags($data['serviceWords'])) : '',
        );

        $serviceSearch = new JokerSearch($attributes);

        $businessTypes = JokerBusinessType::model()->getAllArray();

        $countries = CHtml::listData(Country::model()->findAll(), 'id', 'name_ru');
        $regions = array();
        if ($serviceSearch->serviceCountry) {
            $country = Country::model()->findByPk($serviceSearch->serviceCountry);
            $regions = CHtml::listData($country->regions, 'id', 'name_ru');
        }
        $cities = array();
        if ($serviceSearch->serviceRegion) {
            $region = Region::model()->findByPk($serviceSearch->serviceRegion);
            $cities = CHtml::listData($region->cities, 'id', 'name_ru');
        }

        $countriesRoute = CHtml::listData(Country::model()->findAll(), 'id', 'name_ru');
        $regionsRoute = array();
        if ($serviceSearch->serviceRouteCountry) {
            $country = Country::model()->findByPk($serviceSearch->serviceRouteCountry);
            $regions = CHtml::listData($country->regions, 'id', 'name_ru');
        }
        $citiesRoute = array();
        if ($serviceSearch->serviceRouteRegion) {
            $region = Region::model()->findByPk($serviceSearch->serviceRouteRegion);
            $cities = CHtml::listData($region->cities, 'id', 'name_ru');
        }

        $this->render('index', array(
            'countries' => $countries,
            'regions' => $regions,
            'cities' => $cities,
            'countriesRoute' => $countriesRoute,
            'regionsRoute' => $regionsRoute,
            'citiesRoute' => $citiesRoute,
            'businessTypes' => $businessTypes,
            'model' => $serviceSearch,
        ));
    }
}