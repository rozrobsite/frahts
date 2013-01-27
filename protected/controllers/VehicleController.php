<?php

class VehicleController extends FrahtController
{
	public function actionIndex()
	{
		$this->redirect('vehicle/new');
	}
	
	public function actionNew()
	{
		$this->processForm();
	}
	
	public function actionUpdate($id)
	{
		$this->processForm($id);
	}
	
	public function processForm($id = '')
	{
		$model = empty($id) ? new Vehicle() : Vehicle::model()->findByPk($id);
		
		if (isset($_POST['Vehicle']))
		{
			$model->attributes = $_POST['Vehicle'];
			$model->user_id = $this->user->id;
			$model->shipments = isset($_POST['Vehicle']['shipments']) ? join(',', array_keys($_POST['Vehicle']['shipments'])) : null;
			$model->permissions = isset($_POST['Vehicle']['permissions']) ? join(',', array_keys($_POST['Vehicle']['permissions'])) : null;
			
			if ($model->validate())
			{
				if ($model->save())
				{
					if ($model->isNewRecord)
						Yii::app()->user->setFlash('vehicle_success', 'Транспортное средство добавлено в базу успешно.');
					else
						Yii::app()->user->setFlash('vehicle_success', 'Данные о транспортном средстве обновлены успешно.');
					
					$this->redirect('/vehicle/update/' . $model->id);
				}
				else
				{
					if ($model->isNewRecord)
						Yii::app()->user->setFlash('vehicle_error', 'Транспортное средство не было добавлено в базу. Проверьте вводимые данные и попробуйте еще раз.');
					else
						Yii::app()->user->setFlash('vehicle_error', 'Данные о транспортном средстве не были обновлены. Попробуйте еще раз');
				}
			}
		}
		
		$vehicleTypes = VehicleTypes::model()->findAll(array('order' => 'name_ru'));
		$listVehicleTypes = CHtml::listData($vehicleTypes, 'id', 'name_ru');
		
		$makes = Makes::model()->findAll(array('order' => 'name'));
		$listMakes = CHtml::listData($makes, 'id', 'name');
		
		$listModels = array();
		if ($model->model_id)
		{
			$listModels = CHtml::listData($model->make->models, 'id', 'name');
		}
		
		$bodyTypes = BodyTypes::model()->findAll(array('order' => 'name_ru'));
		$listBodyTypes = CHtml::listData($bodyTypes, 'id', 'name_ru');
		
		$shipments = Shipment::model()->findAll(array('order' => 'name_ru'));
		
		$permissions = Permissions::model()->findAll(array('order' => 'name_ru'));
		
		$shipmentsChecked = $model->shipments ? explode(',', $model->shipments) : array();
		$permissionsChecked = $model->permissions ? explode(',', $model->permissions) : array();
		
		$this->render('index', array(
			'activeVehicles' => $model->findAllByDeleted($this->user->id,false),
			'noactiveVehicles' => $model->findAllByDeleted($this->user->id),
			'vehicleTypes' => $listVehicleTypes,
			'makes' => $listMakes,
			'models' => $listModels,
			'bodyTypes' => $listBodyTypes,
			'shipments' => $shipments,
			'permissions' => $permissions,
			'shipmentsChecked' => $shipmentsChecked,
			'permissionsChecked' => $permissionsChecked,
			'model' => $model,
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