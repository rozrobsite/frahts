<?php

class MainController extends JokerController
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
		$model = new JokerUsers();
		if (isset($_POST['JokerUsers']))
		{
			$model->attributes = $_POST['JokerUsers'];
			if ($this->jokerUser = $model->login())
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
		
		$this->redirect('/');
	}
}