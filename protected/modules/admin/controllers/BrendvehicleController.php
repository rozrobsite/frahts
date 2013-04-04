<?php

class BrendvehicleController extends AdminController
{

	public function __construct($id, $module = null)
	{
		parent::__construct($id, $module);
	}

	public function actionIndex()
	{
		$this->redirect('/admin/brendvehicle/makes');
	}

	public function actionMakes()
	{
		if (isset($_POST['Makes']))
		{
			if (!empty($_POST['Makes']['name']))
			{
				$newMake = new Makes();
				$newMake->name = $_POST['Makes']['name'];
				$newMake->insert();

				unset($newMake);
			}
		}
		
		$make = new Makes();
		if (isset($_REQUEST['Makes']['name']))
		{
			$make->name = $_REQUEST['Makes']['name'];
		}

		$this->render('makes', array(
			'make' => $make,
		));
	}

	public function actionModels()
	{
		if (isset($_POST['Models']))
		{
			if (!empty($_POST['Models']['name']) && isset($_POST['Models']['make_id']))
			{
				$newModel = new Models();
				$newModel->make_id = (int) $_POST['Models']['make_id'];
				$newModel->name = $_POST['Models']['name'];
				$newModel->insert();

				unset($newModel);
			}
		}

		$models = new Models();
		if (isset($_REQUEST['Models']['make_id']))
		{
			$models->make_id = (int) $_REQUEST['Models']['make_id'];
		}
		if (isset($_REQUEST['Models']['name']))
		{
			$models->name = $_REQUEST['Models']['name'];
		}

		$makes = Makes::model()->findAll(array('order' => 'name'));
		$listMakes = CHtml::listData($makes, 'id', 'name');
		
		$this->render('models',
				array(
			'makes' => $listMakes,
			'model' => $models,
		));
	}
	
	public function actionMakesedit()
	{
		if (isset($_POST['name']) && isset($_POST['pk']) && isset($_POST['value']))
		{
			Makes::model()->updateByPk((int) $_POST['pk'],
					array($_POST['name'] => $_POST['value']));
		}
	}

	public function actionModelsedit()
	{
		if (isset($_POST['name']) && isset($_POST['pk']) && isset($_POST['value']))
		{
			Models::model()->updateByPk((int) $_POST['pk'],
					array($_POST['name'] => $_POST['value']));
		}
	}

	public function actionDelete()
	{
		if (isset($_GET['id']) && isset($_GET['type']))
		{
			$type = $this->_getModel($_GET['type']);
			if ($type != null)
			{
				$type->deleteByPk((int) $_GET['id']);
			}
		}
	}

	private function _getModel($typeName)
	{
		switch ($typeName)
		{
			case 'Makes':
				return Makes::model();
			case 'Models':
				return Models::model();
			default :
				return null;
		}
	}

}