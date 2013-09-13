<?php

class ParserController extends AdminController {

	public function __construct($id, $module = null) {
		parent::__construct($id, $module);
	}

	public function actionIndex() {
		$this->render('index');
	}

	public function actionEmails() {
		$model = new ParserEmails();

		if (isset($_POST['ParserEmails'])) {
			$model->attributes = $_POST['ParserEmails'];

			if ($model->save()) {

			}
//			if (!empty($_POST['ParserEmails']['email']))
//			{
//				$newParserEmails = new ParserEmails();
//				$newParserEmails->email = $_POST['ParserEmails']['email'];
//				$newParserEmails->insert();
//
//				unset($newParserEmails);
//			}
		}

//		$parserEmails = new ParserEmails();
//		if (isset($_REQUEST['ParserEmails']['email']))
//		{
//			$parserEmails->email = $_REQUEST['ParserEmails']['email'];
//		}

		$this->render('emails', array(
//			'parserEmails' => $parserEmails
			'parserEmails' => $model
		));
	}

	public function actionEmailEdit() {
		if (isset($_POST['name']) && isset($_POST['pk']) && isset($_POST['value'])) {
			ParserEmails::model()->updateByPk((int) $_POST['pk'], array($_POST['name'] => $_POST['value']));
		}
	}

	public function actionDelete() {
		if (isset($_GET['id'])) {
			ParserEmails::model()->deleteByPk((int) $_GET['id']);
		}
	}

	public function actionWellary() {
		$SITE_URL = 'http://wellary.com';
		$pages = 74;

		Yii::import('ext.SimpleHTMLDOM.SimpleHTMLDOM');

		$simpleHtml = new SimpleHTMLDOM();

		if (file_exists(Yii::app()->params['files']['tmp2'] . 'wlry.txt'))
			unlink (Yii::app()->params['files']['tmp2'] . 'wlry.txt');

		$file = fopen(Yii::app()->params['files']['tmp2'] . 'wlry.txt', 'a');
		foreach (range(1, $pages) as $page) {
			$html = $simpleHtml->file_get_html('http://wellary.com/ru/firmscatalog-r_is_4-ic_is_220-page_is_' . $page . '.html');

			$count = 0;
			foreach ($html->find('div.divWhiteContent table td a') as $element) {
				$companyHtml = $simpleHtml->file_get_html($SITE_URL . $element->href);

				$tmp = array();
				foreach ($companyHtml->find('div.divWhiteContent table td') as $item) {
					preg_match_all('/([A-Za-z0-9_\-]+\.)*[A-Za-z0-9_\-]+@([A-Za-z0-9][A-Za-z0-9\-]*[A-Za-z0-9]\.)+[A-Za-z]{2,4}/u', $item->innertext, $tds);

					foreach ($tds as $td)
					{
						if (isset($td[0]) && filter_var($td[0], FILTER_VALIDATE_EMAIL))
						{
							fwrite($file, $td[0] . "\r\n");
						}
					}
				}

				if (++$count == 5)
					break;
			}

			break;
		}

		fclose($file);
		die();
	}
}