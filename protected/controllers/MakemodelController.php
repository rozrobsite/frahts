<?php

class MakemodelController extends Controller
{

	public function actionModel()
	{
		$make_id = (int) Yii::app()->request->getPost('make_id');
		$make = Makes::model()->findByPk($make_id);

		$model = new Vehicle();
		$listModels = array();
		if ($make_id)
		{
			$listModels = CHtml::listData($make->models, 'id', 'name');
		}

		echo CHtml::activeDropDownList($model, 'model_id', $listModels,
				array('empty' => 'Выберите модель', 'class' => 'model'));

		Yii::app()->end();
	}

	public function actionDelete()
	{
		$id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
		
		$model = Vehicle::model()->findByPk($id);
		if ($model)
		{
			if ($model->deleteFromSearch(true))
			{
				if ($model->isNewRecord)
					Yii::app()->user->setFlash('vehicle_success', 'Транспортное средство удалено из поиска.');
				else
					Yii::app()->user->setFlash('vehicle_error', 'Транспортное средство не было было удалено из поиска. Попробуйте еще раз.');
					
				$this->respondJSON(array('error' => 0, 'id' => $id));

				Yii::app()->end();
			}
			else
			{
				if ($model->isNewRecord)
					Yii::app()->user->setFlash('vehicle_success', 'Транспортное средство удалено из поиска.');
				else
					Yii::app()->user->setFlash('vehicle_error', 'Транспортное средство не было было удалено из поиска. Попробуйте еще раз.');
				
				$this->respondJSON(array('error' => 1, 'id' => $id));

				Yii::app()->end();
			}
		}
		else
		{
			if ($model->isNewRecord)
				Yii::app()->user->setFlash('vehicle_success', 'Транспортное средство удалено из поиска.');
			else
				Yii::app()->user->setFlash('vehicle_error', 'Транспортное средство не было было удалено из поиска. Попробуйте еще раз.');
				
			$this->respondJSON(array('error' => 1, 'id' => $id));

			Yii::app()->end();
		}
	}

	public function actionReturn()
	{
		$id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
		
		$model = Vehicle::model()->findByPk($id);
		if ($model)
		{
			if ($model->deleteFromSearch(false))
			{
				Yii::app()->user->setFlash('vehicle_success', 'Транспортное средство принимает участие в поиске.');
					
				$this->respondJSON(array('error' => 0, 'id' => $id));

				Yii::app()->end();
			}
			else
			{
				Yii::app()->user->setFlash('vehicle_error', 'Не удалось вернуть транспортное средство для участия в поиске. Попробуйте еще раз.');
				
				$this->respondJSON(array('error' => 1, 'id' => $id));

				Yii::app()->end();
			}
		}
		else
		{
			Yii::app()->user->setFlash('vehicle_error', 'Не удалось вернуть транспортное средство для участия в поиске. Попробуйте еще раз.');
			
			$this->respondJSON(array('error' => 1, 'id' => $id));

			Yii::app()->end();
		}
	}

}