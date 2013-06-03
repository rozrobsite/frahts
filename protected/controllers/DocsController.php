<?php

class DocsController extends FrahtController
{
	public function actionIndex()
	{
		$this->viewDocs($_GET);
	}
	
	public function actionType()
	{
		$this->viewDocs($_GET);
	}
	
	public function actionView()
	{
		$slug = isset($_GET['slug']) ? trim($_GET['slug']) : '';
		
		$model = Docs::model()->find('slug = "' . $slug . '"');
		if ($model === null)
			throw new CHttpException(404, 'Данный документ не найден в базе.');
		
		$docsType = DocsType::model()->findAll();
		
		$this->render('view', array(
			'model' => $model,
			'docsType' => $docsType,
		));
	}
	
	private function viewDocs($data)
	{
		$currentDocType_id = isset($data['id']) ? (int)$data['id'] : 1;
		$docs = Docs::model()->findAll('docs_type_id = :docs_type_id', array('docs_type_id' => $currentDocType_id));
		$docsType = DocsType::model()->findAll();
		
		$this->render('index', array(
			'docs' => $docs,
			'docsType' => $docsType,
			'currentDocType_id' => $currentDocType_id,
		));
	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}