<?php

class UserController extends JokerController
{
	public function __construct($id, $module = null)
	{
		parent::__construct($id, $module);
		
		if (!$this->jokerUser) $this->redirect('/joker/main/login');
	}
	
	public function actionIndex()
	{
		$this->render('index');
	}
}