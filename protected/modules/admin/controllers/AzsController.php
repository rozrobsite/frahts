<?php

/*
 * Create Controller for table
 *
 */

class AzsController extends AdminController {

	public function __construct($id, $module = null) {
		parent::__construct($id, $module);
	}

	public function actionIndex() {
		$this->render('index', array(
		));
	}

	public function actionUpdate() {
		Yii::import('ext.SimpleHTMLDOM.SimpleHTMLDOM');

		$azsTrademarkModel = new AzsTrademark();
		$azsTrademarkModel->deleteAll();

		$simpleHtml = new SimpleHTMLDOM();

		Yii::app()->curl->options['setOptions'][CURLOPT_USERAGENT] = Yii::app()->request->getUserAgent();

		$response = Yii::app()->curl->run('http://index.minfin.com.ua/fuel/detail.php');
		$html = $simpleHtml->str_get_html($response->getData());


		echo '<pre>';
		print_r($html);
		echo '</pre>';
	}

}