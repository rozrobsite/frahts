<?php


class Geography {

	public static function getDistanceByGoogle($latFrom, $lngFrom, $latTo, $lngTo)
	{
		$results = file_get_contents('http://maps.googleapis.com/maps/api/directions/json?origin=' . $latFrom . ',' . $lngFrom . '&destination=' . $latTo . ',' . $lngTo . '&sensor=false&language=ru');
		$result = json_decode($results);

		echo $result->routes[0]->legs[0]->distance->text;
	}

}

?>
