<?php

class DocsController extends AdminController
{

	public function __construct($id, $module = null)
	{
		parent::__construct($id, $module);
	}

	public function actionIndex()
	{
		$this->redirect('edit');
	}

	public function actionAdd()
	{
		$this->processForm();
	}

	public function actionEdit()
	{
		$id = isset($_GET['id']) ? $_GET['id'] : '';

		$model = News::model()->findByPk($id);

		if (!$model) throw new CHttpException(404, 'Данная новость не найдена.');

		$this->processForm($model);
	}

	public function processForm($model = null)
	{
		$model = $model == null ? new Docs() : $model;
		
		$docTypes = DocsType::model()->findAll();
		$listDocTypes = CHtml::listData($docTypes, 'id', 'name_ru');

		if (isset($_POST['Docs']))
		{
			echo "<pre>";
			print_r($_POST);
			echo "</pre>";exit;
			$model->attributes = $_POST['Docs'];

			if ($model->save())
			{
				Yii::app()->user->setFlash('_success', 'Документ добавлен в базу.');

				$this->redirect('/docs/list/');
			}
			else
			{
				Yii::app()->user->setFlash('_error',
						'Ошибки при добавлении документа в базу. Проверьте введенные данные и попробуйте еще раз.');
			}
		}

		$this->render('_docs', array(
			'model' => $model,
			'docTypes' => $listDocTypes,
		));
	}

}