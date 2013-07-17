<?php

class ParserController extends AdminController
{

	public function __construct($id, $module = null)
	{
		parent::__construct($id, $module);
	}

	public function actionIndex()
	{
		$this->redirect('/admin/parser/emails');
	}

	public function actionEmails()
	{
		if (isset($_POST['ParserEmails']))
		{
			if (!empty($_POST['ParserEmails']['email']))
			{
				$newParserEmails = new ParserEmails();
				$newParserEmails->email = $_POST['ParserEmails']['email'];
				$newParserEmails->insert();

				unset($newParserEmails);
			}
		}
		
		$parserEmails = new ParserEmails();
		if (isset($_REQUEST['ParserEmails']['email']))
		{
			$parserEmails->email = $_REQUEST['ParserEmails']['email'];
		}

		$this->render('emails', array(
			'parserEmails' => $parserEmails
		));
	}

	public function actionEmailEdit()
	{
		if (isset($_POST['name']) && isset($_POST['pk']) && isset($_POST['value']))
		{
			ParserEmails::model()->updateByPk((int) $_POST['pk'], array($_POST['name'] => $_POST['value']));
		}
	}

	public function actionDelete()
	{
		if (isset($_GET['id']))
		{
			ParserEmails::model()->deleteByPk((int) $_GET['id']);
		}
	}
}