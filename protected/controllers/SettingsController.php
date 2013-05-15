<?php

class SettingsController extends FrahtController
{

	public function __construct($id, $module = null)
	{
		parent::__construct($id, $module);
	}

	public function actionAutoupdate()
	{
		$settings = Settings::model();

		if (isset($_POST['autoupdate']) && isset($_POST['timer']))
		{
			$settings->autoupdate = (int) $_POST['autoupdate'];
			$settings->timer = !(int) $_POST['timer'];
			$settings->setAutoupdate();
		}

		$this->respondJSON(array(
			'timer' => (int) $settings->timer));
	}

//	public function actionStartAutoupdate()
//	{
//		$settings = Settings::model();
//		
//		if (isset($_POST['autoupdate']))
//		{
//			$settings->autoupdate = (int) $_POST['autoupdate'];
//			$settings->setAutoupdate();
//		}
//	}
//	
//	public function actionStopAutoupdate()
//	{
//		$settings = Settings::model();
//		
//		if (isset($_POST['autoupdate']))
//		{
//			$settings->autoupdate = (int) $_POST['autoupdate'];
//			$settings->setAutoupdate();
//		}
//	}
}