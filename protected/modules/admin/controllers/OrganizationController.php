<?php

class OrganizationController extends AdminController
{

	public function __construct($id, $module = null)
	{
		parent::__construct($id, $module);
	}

	public function actionIndex()
	{
		$this->redirect('/admin/organization/formOrganizations');
	}

	public function actionFormOrganizations()
	{
		if (isset($_POST['FormOrganizations']))
		{
			if (!empty($_POST['FormOrganizations']['name_ru']))
			{
				$newFormOrg = new FormOrganizations();
				$newFormOrg->name_ru = $_POST['FormOrganizations']['name_ru'];
				$newFormOrg->insert();

				unset($newFormOrg);
			}
		}
		
		$formOrganization = new FormOrganizations();
		if (isset($_REQUEST['FormOrganizations']['name_ru']))
		{
			$formOrganization->name_ru = $_REQUEST['FormOrganizations']['name_ru'];
		}

		$this->render('formOrganizations', array(
			'formOrganization' => $formOrganization,
		));
	}

	public function actionFormOrganizationsedit()
	{
		if (isset($_POST['name']) && isset($_POST['pk']) && isset($_POST['value']))
		{
			FormOrganizations::model()->updateByPk((int) $_POST['pk'],
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
			case 'FormOrganizations':
				return FormOrganizations::model();
			default :
				return null;
		}
	}

}