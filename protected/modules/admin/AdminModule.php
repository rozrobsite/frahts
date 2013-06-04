<?php

class AdminModule extends CWebModule
{
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'admin.models.*',
			'admin.components.*',
		));
        $this->layoutPath;
		
		Yii::app()->setComponents(array(
			'bootstrap' => array('class' => 'ext.bootstrap.components.Bootstrap'),
        ));
	}

	public function beforeControllerAction($controller, $action)
	{
		if (parent::beforeControllerAction($controller, $action))
		{

            $app = Yii::app();
			// Allow authorized users only
			// TODO: specify exact login form action instead of any post request
			if (!$app->request->isPostRequest && !isset(Yii::app()->session['admin_id']))
			{
				$app->controller->layout = false;
				$app->controller->render('/default/login', array('model' => new AdminUsers()));
				$app->end();
			}
			else
			{
				return true;
			}
		}
		return false;
	}
}
