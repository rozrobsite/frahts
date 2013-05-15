<?php

class DefaultController extends AdminController
{

	public function __construct($id, $module = null)
	{
		parent::__construct($id, $module);
	}

	public function actionIndex()
	{
		$this->render('index');
	}

	public function actionLogin()
	{
		$model = new AdminUsers();
		if (isset($_POST['AdminUsers']))
		{
			$model->attributes = $_POST['AdminUsers'];
			if ($this->adminUser = $model->login())
			{
				$this->redirect('index');
			}
			else
			{
				Yii::app()->controller->layout = false;
			}
		}

		$this->render('login', array('model' => $model));
	}
	
	public function actionLogout()
	{
		Yii::app()->session->destroy();
		
		$this->redirect('/admin/');
	}

}