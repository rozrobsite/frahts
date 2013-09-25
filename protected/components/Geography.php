<?php
class Geography {

	public static function getDistanceByGoogle($latFrom, $lngFrom, $latTo, $lngTo)
	{
		$results = file_get_contents('http://maps.googleapis.com/maps/api/directions/json?origin=' . $latFrom . ',' . $lngFrom . '&destination=' . $latTo . ',' . $lngTo . '&sensor=false&language=ru');
		$result = json_decode($results);

		return $result->routes[0]->legs[0]->distance->text;
	}

	public static function getDistanceByYandex($latFrom, $lngFrom, $latTo, $lngTo)
	{
		$results = file_get_contents('http://maps.googleapis.com/maps/api/directions/json?origin=' . $latFrom . ',' . $lngFrom . '&destination=' . $latTo . ',' . $lngTo . '&sensor=false&language=ru');
		$results = file_get_contents('http://maps.yandex.ua/?rll=' . $latFrom . '%2C' . $lngFrom . '~' . $latTo . '%2C' . $lngTo . '&output=json&locale=ru');
		$result = json_decode($results);

		$distance = isset($result->vpage->data->response->data->features[0]->properties->RouteMetaData->Distance->value) ? $result->vpage->data->response->data->features[0]->properties->RouteMetaData->Distance->value / 1000 : 0;
		return round($distance);
	}
}

?>
