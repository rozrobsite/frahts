<?php

class VehicleController extends FrahtController
{
	const MAX_UPLOAD_NUMBER = 9;
	static $current_upload_num = 0;
	
	public function actionIndex()
	{
		$this->redirect('vehicle/active');
	}

	public function actionNew()
	{
		$this->processForm();
	}

	public function actionUpdate()
	{
		$id = isset($_GET['id']) ? $_GET['id'] : 0;

		$model = Vehicle::model()->findByPk($id);

		if (!$model)
				throw new CHttpException(404, 'Данное транспортное средство не найдено в базе.');

		$this->processForm(isset($_GET['id']) ? $_GET['id'] : 0);
	}

	public function processForm($id = 0)
	{
		$model = empty($id) ? new Vehicle() : Vehicle::model()->findByPk($id);
		
		if (isset($_POST['Vehicle']))
		{
			$model->attributes = $_POST['Vehicle'];
			$model->user_id = $this->user->id;
			$model->shipments = isset($_POST['Vehicle']['shipments']) ? join(',',
							array_keys($_POST['Vehicle']['shipments'])) : null;
			$model->permissions = isset($_POST['Vehicle']['permissions']) ? join(',',
							array_keys($_POST['Vehicle']['permissions'])) : null;
			if ($model->isNewRecord) $model->created_at = time();
			else $model->updated_at = time();

			if ($model->validate())
			{
				if ($model->save())
				{
					if (isset($_POST['Photos']))
					{
						$this->addPhotos($model->id, $_POST['Photos']);
					}
					
					if ($model->isNewRecord)
							Yii::app()->user->setFlash('vehicle_success',
								'Транспортное средство добавлено в базу успешно.');
					else
							Yii::app()->user->setFlash('vehicle_success',
								'Данные о транспортном средстве обновлены успешно.');

					$this->redirect('/vehicle/update/' . $model->id);
				}
				else
				{
					if ($model->isNewRecord)
							Yii::app()->user->setFlash('vehicle_error',
								'Транспортное средство не было добавлено в базу. Проверьте вводимые данные и попробуйте еще раз.');
					else
							Yii::app()->user->setFlash('vehicle_error',
								'Данные о транспортном средстве не были обновлены. Попробуйте еще раз');
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

		$this->render('_vehicle',
				array(
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

	public function actionActive()
	{
		$model = Vehicle::model();
		$this->render('_active',
				array(
			'activeVehicles' => $model->findAllByDeleted($this->user->id, false),
		));
	}

	public function actionInactive()
	{
		$model = Vehicle::model();
		$this->render('_inactive',
				array(
			'noactiveVehicles' => $model->findAllByDeleted($this->user->id),
		));
	}
	
	public function actionUpload()
	{
		Yii::import("ext.EAjaxUpload.qqFileUploader");

		$uploader = new qqFileUploader(Yii::app()->params['images']['allowedExtensions'], Yii::app()->params['images']['sizeLimit']);
		$result = $uploader->handleUpload(Yii::app()->params['files']['tmp']);
		
		$this->respondJSON($result);
		
		Yii::app()->end();
	}
	
	private function addPhotos($vehicle_id, $data)
	{
		if (!$data) return;
		
		$countPhotos = Photos::model()->count('vehicle_id = ' . (int)$vehicle_id);
		$data = array_slice($data, 0, Photos::MAX_UPLOAD_FILES - $countPhotos);
		
		foreach ($data as $photo)
		{
			$photoPath = Yii::app()->params['files']['tmp'] . $photo;
			$image = Yii::app()->image->load($photoPath);
			if (!$image) continue;
			
			$model = new Photos();
			$model->vehicle_id = (int)$vehicle_id;
			if ($model->save())
			{
				$model->size_big = $vehicle_id . '_' . $model->id . '_b' . '_' . $photo;
				$image->resize(Yii::app()->params['images']['big']['width'], Yii::app()->params['images']['big']['height']);
				$image->save(Yii::app()->params['files']['photos'] . $vehicle_id . '_' . $model->id . '_b' . '_' . $photo);
				
				$model->size_middle = $vehicle_id . '_' . $model->id . '_m' . '_' . $photo;
				$image->resize(Yii::app()->params['images']['middle']['width'], Yii::app()->params['images']['middle']['height']);
				$image->save(Yii::app()->params['files']['photos'] . $vehicle_id . '_' . $model->id . '_m' . '_' . $photo);
				
				$model->size_small = $vehicle_id . '_' . $model->id . '_s' . '_' . $photo;
				$image->resize(Yii::app()->params['images']['small']['width'], Yii::app()->params['images']['small']['height']);
				$image->save(Yii::app()->params['files']['photos'] . $vehicle_id . '_' . $model->id . '_s' . '_' . $photo);
				
				$model->save();
			}
			
			@unlink($photoPath);
			
			unset($model);
		}
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