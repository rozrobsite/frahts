
<?php

/*
 * Create Controller for table body_types
 *
 */

class CurrencyController extends AdminController
{

	public function __construct($id, $module = null)
	{
		parent::__construct($id, $module);
	}

	public function actionIndex()
	{
		$this->redirect('/admin/Currency/Currency');
	}

	public function actionCurrency()
	{
		$currency = new Currency();
		if (isset($_REQUEST['Currency']['name_ru']))
		{
			$currency->name_ru = $_REQUEST['Currency']['name_ru'];
		}
		$this->render('Currency',
				array(
			'Currency' => $currency,
		));
	}

	public function actionAdd()
	{
		if (isset($_POST['Currency']))
		{
			if (!empty($_POST['Currency']['name_ru']))
			{
				$currency = new Currency();

				$currency->name_ru = $_POST['Currency']['name_ru'];

				// Currency::model()->insert($_POST['Currency']['name_ru']);
				$currency->insert();
				unset($currency);
			}
		}

		$currency = new Currency();
		if (isset($_REQUEST['Currency']['name_ru']))
		{

			$currency->name_ru = $_REQUEST['Currency']['name_ru'];
		}
		$this->render('Currency',
				array(
			'Currency' => $currency,
		));

//            $this->redirect('/admin/Currency');
	}

	public function actionEditCurrency()
	{
		if (isset($_POST['name_ru']) && isset($_POST['pk']) && isset($_POST['value']))
		{
			Currency::model()->updateByPk((int) $_POST['pk'],
					array($_POST['name_ru'] => $_POST['value']));
		}
	}

	public function actionEdit()
	{
		$id = isset($_GET['id']) ? $_GET['id'] : '';
		
		$model = Currency::model()->findByPk($id);
		
		if (!$model) throw new CHttpException(404, 'Данная новость не найдена.');
		
		$this->processForm($model);
	}

	public function processForm($model = null)
	{
		//$model = $model == null ? new Currency('search') : $model;
		$model = $model == null ? new Currency() : $model;

		$currency = Currency::model()->findAll();
		$listBodyTypes = CHtml::listData($currency, 'id', 'name_ru');

		if (isset($_POST['Currency']))
		{
			$model->attributes = $_POST['Currency'];
			if ($model->isNewRecord) $model->created_at = time();

			if ($model->save())
			{
				Yii::app()->user->setFlash('_success', 'Документ добавлен в базу.');

				$stringHelper = new StringHelper();
				$model->slug = $stringHelper->convertToSlug($model->title . ' ' . $model->id);
				$model->update();
				unset($stringHelper);

				$this->redirect('/admin/docs/list/');
			}
			else
			{
				Yii::app()->user->setFlash('_error',
						'Ошибки при добавлении документа в базу. Проверьте введенные данные и попробуйте еще раз.');
			}
		}
		$currency = new Currency();
		if (isset($_GET['Currency']['name_ru']))
		{

			$currency->name_ru = $_GET['Currency']['name_ru'];
		}

		$this->render('_CurrencyType',
				array(
			// 'model' => $model,
			'Currency' => $currency,
		));
	}

	public function actionDelete()
	{
		if (isset($_GET['id']))
		{
			if (!empty($_GET['id']))
			{
				Currency::model()->deleteByPk((int) $_GET['id']);
			}
		}
	}

}