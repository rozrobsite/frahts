<?php

class TestDataController extends Controller
{

	public function actionCoordinates()
	{
		CityTestData::model()->getCoordinates();
	}

}
?>
