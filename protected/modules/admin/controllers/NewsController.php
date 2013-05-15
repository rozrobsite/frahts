<?php

class NewsController extends AdminController
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
		$model = $model == null ? new News() : $model;

		if (isset($_POST['News']))
		{
//			echo "<pre>";
//			print_r($_POST);
//			echo "</pre>";exit;
			$model->attributes = $_POST['News'];
//			$model->user_id = $this->user->id;
//			$model->shipments = isset($_POST['Vehicle']['shipments']) ? join(',',
//							array_keys($_POST['Vehicle']['shipments'])) : null;
//			$model->permissions = isset($_POST['Vehicle']['permissions']) ? join(',',
//							array_keys($_POST['Vehicle']['permissions'])) : null;
//			$model->created_at = $model->updated_at = time();
//			
//			$makeModel = Makes::model()->findByPk((int)$_POST['Vehicle']['make_id']);
//			$modelModel = Models::model()->findByPk((int)$_POST['Vehicle']['model_id']);
//			$model->slugMake = $makeModel->name . ' ' . $modelModel->name;

			if ($model->save())
			{
				Yii::app()->user->setFlash('_success', 'Новость добавлена в базу успешно.');

				$this->redirect('/news/list/');
			}
			else
			{
				Yii::app()->user->setFlash('_error',
						'Ошибки при добавлении новости в базу. Проверьте введенные данные и попробуйте еще раз.');
			}
		}

		$this->render('_news', array(
			'model' => $model,
		));
	}

}