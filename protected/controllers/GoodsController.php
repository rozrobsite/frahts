<?php

class GoodsController extends FrahtController
{
	public function __construct($id, $module = null)
	{
		parent::__construct($id, $module);

		if (!($this->user->profiles->user_type_id == UserTypes::SHIPPER || $this->user->profiles->user_type_id == UserTypes::DISPATCHER))
			throw new CHttpException(503, 'Вам не разрешен доступ к этой странице!');
	}

	public function actionIndex()
	{
//		$this->render('index', array(
//			'vehicles' => $vehicles,
//			'goodsActive' => Goods::model()->getActive(),
//			'goodsNoActive' => Goods::model()->getActive(Goods::NO_ACTIVE),
//		));

		$this->render('index');
	}

	public function actionInactive()
	{
		$this->render('inActive', array(
			'goodsActive' => Goods::model()->getActive(),
			'goodsNoActive' => Goods::model()->getActive(Goods::NO_ACTIVE),
		));
	}

	public function actionView()
	{
		$slug = isset($_GET['slug']) ? trim($_GET['slug']) : '';

		$model = Goods::model()->find('slug = "' . $slug . '"');

		
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