<?php

class NotesController extends FrahtController
{
	public function actionIndex()
	{
//		$this->render('index');
	}
	
	public function actionAdd()
	{
		$start = isset($_POST['start']) ? date("Y-m-d H:i:s", strtotime($_POST['start'])) : 0;
		$end = isset($_POST['end']) ? date("Y-m-d H:i:s", strtotime($_POST['end'])) : 0;
		$type = isset($_POST['type']) ? trim($_POST['type']) : '';
		
		if (empty($type) || empty($start) || empty($end))
		{
			echo $this->respondJSON(array('error' => 1));
		
			Yii::app()->end();
		}
		
		$model = new Notes();
		$model->user_id = $this->user->id;
		$model->start = $start;
		$model->end = $end;
		$model->type = $type;
		$model->is_show = 0;
		
		if (!$model->save())
		{
			echo $this->respondJSON(array('error' => 2));
		
			Yii::app()->end();
		}
		else
		{
			echo $this->respondJSON(array('error' => 0, 'id' => $model->id, 'start' => $model->start, 'end' => $model->end));
		
			Yii::app()->end();
		}
	}
	
	public function actionEdit()
	{
		$id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
		$start = isset($_POST['start']) ? date("Y-m-d H:i:s", strtotime($_POST['start'])) : 0;
		$end = isset($_POST['end']) ? date("Y-m-d H:i:s", strtotime($_POST['end'])) : 0;
		$type = isset($_POST['type']) ? trim($_POST['type']) : '';
		
		if (empty($id) || empty($type) || empty($start) || empty($end))
		{
			echo $this->respondJSON(array('error' => 1));
		
			Yii::app()->end();
		}
		
		$model = Notes::model()->findByPk($id);
		$model->start = $start;
		$model->end = $end;
		$model->type = $type;
		
		if (!$model->save())
		{
			echo $this->respondJSON(array('error' => 2));
		
			Yii::app()->end();
		}
		else
		{
			echo $this->respondJSON(array('error' => 0));
		
			Yii::app()->end();
		}
	}
	
	public function actionDelete()
	{
		$id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
		
		if (empty($id))
		{
			echo $this->respondJSON(array('error' => 1));
		
			Yii::app()->end();
		}
		
		$model = Notes::model()->findByPk($id);
		
		if (!$model->delete())
		{
			echo $this->respondJSON(array('error' => 2));
		
			Yii::app()->end();
		}
		else
		{
			echo $this->respondJSON(array('error' => 0, 'id' => $id));
		
			Yii::app()->end();
		}
	}
	
	public function actionGet()
	{
		$notes = Notes::model()->getAll($this->user);
		
		echo $this->respondJSON($notes);
		
		Yii::app()->end();
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