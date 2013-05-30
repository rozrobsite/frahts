<?php

class DocsController extends AdminController
{

	public function actions()
	{
		return array(
			'fileUpload' => 'ext.redactor.actions.FileUpload',
			'imageUpload' => 'ext.redactor.actions.ImageUpload',
			'imageList' => 'ext.redactor.actions.ImageList',
		);
	}

	public function __construct($id, $module = null)
	{
		parent::__construct($id, $module);
	}

	public function actionIndex()
	{
		$this->redirect('/admin/docs/list');
	}

	public function actionAdd()
	{
		$this->processForm();
	}

	public function actionEdit()
	{
		$id = isset($_GET['id']) ? $_GET['id'] : '';
		$model = Docs::model()->findByPk($id);

		if (!$model) throw new CHttpException(404, 'Данная новость не найдена.');

		$this->processForm($model);
	}

	public function actionList()
	{
		$docTypes = DocsType::model()->findAll();
		$listDocTypes = CHtml::listData($docTypes, 'id', 'name_ru');
		
		$docs = new Docs('search');
		if (isset($_GET['Docs']))
			$docs->attributes = $_GET['Docs'];
		
		$this->render('list',
				array(
			'model' => $docs,
			'docTypes' => $listDocTypes,
		));
	}

	public function processForm($model = null)
	{
		$model = $model == null ? new Docs('search') : $model;

		$docTypes = DocsType::model()->findAll();
		$listDocTypes = CHtml::listData($docTypes, 'id', 'name_ru');

		if (isset($_POST['Docs']))
		{
			$model->attributes = $_POST['Docs'];
			if ($model->isNewRecord)
				$model->created_at = time();

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

		$this->render('_docs',
				array(
			'model' => $model,
			'docTypes' => $listDocTypes,
		));
	}
	
	
	public function actionDelete()
	{
		if (isset($_GET['id']))
		{
			if (!empty($_GET['id']))
			{
				Docs::model()->deleteByPk((int) $_GET['id']);
			}
		}
	}

}