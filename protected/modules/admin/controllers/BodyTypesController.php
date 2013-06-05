<?php

/*
 * Create Controller for table body_types
 *
 */

class BodyTypesController extends AdminController
{

	public function __construct($id, $module = null)
	{
		parent::__construct($id, $module);
	}

	public function actionIndex()
	{
		$this->redirect('/admin/BodyTypes/BodyTypes');
	}

	public function actionBodyTypes()
	{
		$bodyTypes = new BodyTypes();

		if (isset($_REQUEST['BodyTypes']['name_ru']))
		{
			$bodyTypes->name_ru = $_REQUEST['BodyTypes']['name_ru'];
		}
		$this->render('BodyTypes',
				array(
			'BodyType' => $bodyTypes,
		));
	}

	public function actionAdd()
	{
		if (isset($_POST['BodyTypes']))
		{
			if (!empty($_POST['BodyTypes']['name_ru']))
			{
				$bodyType = new BodyTypes();

				$bodyType->name_ru = $_POST['BodyTypes']['name_ru'];

				// BodyTypes::model()->insert($_POST['BodyTypes']['name_ru']);
				$bodyType->insert();
				unset($bodyType);
			}
		}

		$bodyTypes = new BodyTypes();
		if (isset($_REQUEST['BodyTypes']['name_ru']))
		{

			$bodyTypes->name_ru = $_REQUEST['BodyTypes']['name_ru'];
		}
		$this->render('BodyTypes',
				array(
			'BodyType' => $bodyTypes,
		));

//            $this->redirect('/admin/BodyTypes');
	}

	public function actionEditBodyTypes()
	{
		if (isset($_POST['name_ru']) && isset($_POST['pk']) && isset($_POST['value']))
		{
			BodyTypes::model()->updateByPk((int) $_POST['pk'],
					array($_POST['name_ru'] => $_POST['value']));
		}
	}

	public function actionEdit()
	{
		$id = isset($_GET['id']) ? $_GET['id'] : '';

		$model = BodyTypes::model()->findByPk($id);

		if (!$model) throw new CHttpException(404, 'Данный тип кузова не найден.');

		$this->processForm($model);
	}

	public function processForm($model = null)
	{
		//$model = $model == null ? new BodyTypes('search') : $model;
		$model = $model == null ? new BodyTypes() : $model;

		$bodyTypes = BodyTypes::model()->findAll();
		$listBodyTypes = CHtml::listData($bodyTypes, 'id', 'name_ru');

		if (isset($_POST['BodyTypes']))
		{
			$model->attributes = $_POST['BodyTypes'];
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
		
		$bodyTypes = new BodyTypes();
		if (isset($_GET['BodyTypes']['name_ru']))
		{

			$bodyTypes->name_ru = $_GET['BodyTypes']['name_ru'];
		}

		$this->render('_BodyType',
				array(
			// 'model' => $model,
			'BodyType' => $bodyTypes,
		));
	}

	public function actionDelete()
	{
		if (isset($_GET['id']))
		{
			if (!empty($_GET['id']))
			{
				BodyTypes::model()->deleteByPk((int) $_GET['id']);
			}
		}
	}

}