<?php

/*
 * Create Controller for table
 *
 */

class PromuaController extends AdminController {

	const SITE_URL = 'http://prom.ua/';

	public function __construct($id, $module = null) {
		parent::__construct($id, $module);
	}

	public function actionIndex() {
		$this->render('index', array(
		));
	}

	public function actionRun() {
		Yii::import('ext.SimpleHTMLDOM.SimpleHTMLDOM');

		$azsTrademarkModel = new AzsTrademark();
		$azsTrademarkModel->deleteAll();

		$simpleHtml = new SimpleHTMLDOM();

//		Yii::app()->curl->options['setOptions'][CURLOPT_USERAGENT] = Yii::app()->request->getUserAgent();
//
//		$response = Yii::app()->curl->run('http://prom.ua/companies');
//		$html = $simpleHtml->str_get_html($response->getData());

		$html = $simpleHtml->file_get_html('http://prom.ua/companies');

echo $html;die();
//		echo '<pre>';
//		print_r($html);
//		echo '</pre>';die();
	}

}