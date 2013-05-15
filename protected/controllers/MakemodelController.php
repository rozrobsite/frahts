<?php

class MakemodelController extends Controller
{

	public function actionModel()
	{
		$make_id = (int) Yii::app()->request->getPost('make_id');
		$category_id = (int) Yii::app()->request->getPost('category_id');

		$make = Marka::model()->find('marka_id = ' . (int)$make_id . ' AND cat_id = ' . (int)$category_id);

		$model = new Vehicle();
		$listModels = array();
		if ($make_id)
		{
			$listModels = CHtml::listData($make->models, 'model_id', 'name');
		}

		echo CHtml::activeDropDownList($model, 'model_id', $listModels,
				array('empty' => 'Выберите модель', 'class' => 'model'));

		Yii::app()->end();
	}

	public function actionCategories()
	{
		$category_id = (int) Yii::app()->request->getPost('category_id');

		$category = Categories::model()->findByPk((int)$category_id);

		$model = new Vehicle();

		$listMakes = array();

		if ($category_id)
		{
			$listMakes = CHtml::listData($category->markas, 'marka_id', 'name');
		}

		echo CHtml::activeDropDownList($model, 'make_id', $listMakes,

				array('empty' => 'Выберите марку', 'class' => 'make'));

		Yii::app()->end();
	}

	public function actionDelete()
	{
		$id = isset($_POST['id']) ? (int) $_POST['id'] : 0;

		$model = Vehicle::model()->findByPk($id);
		if ($model)
		{
			if ($model->deleteFromSearch(true))
			{
				Yii::app()->user->setFlash('vehicle_success',

						'Транспортное средство "' . $model->bodyType->name_ru . ' ' . $model->marka->name . ' ' . $model->modeli->name . ', номер: ' . $model->license_plate . '" удалено из поиска.');

				$this->respondJSON(array('error' => 0, 'id' => $id));

				Yii::app()->end();
			}
			else
			{
				Yii::app()->user->setFlash('vehicle_error',

						'Транспортное средство "' . $model->bodyType->name_ru . ' ' . $model->marka->name . ' ' . $model->modeli->name . ', номер: ' . $model->license_plate . '" не было было удалено из поиска. Попробуйте еще раз.');

				$this->respondJSON(array('error' => 1, 'id' => $id));

				Yii::app()->end();
			}
		}
		else
		{
			Yii::app()->user->setFlash('vehicle_error',

					'Транспортное средство "' . $model->bodyType->name_ru . ' ' . $model->marka->name . ' ' . $model->modeli->name . ', номер: ' . $model->license_plate . '" не было было удалено из поиска. Попробуйте еще раз.');

			$this->respondJSON(array('error' => 1, 'id' => $id));

			Yii::app()->end();
		}
	}

	public function actionReturn()
	{
		$id = isset($_POST['id']) ? (int) $_POST['id'] : 0;

		$model = Vehicle::model()->findByPk($id);
		if ($model)
		{
			if ($model->deleteFromSearch(false))
			{
				Yii::app()->user->setFlash('vehicle_success',

						'Транспортное средство "' . $model->bodyType->name_ru . ' ' . $model->marka->name . ' ' . $model->modeli->name . ', номер: ' . $model->license_plate . '" принимает участие в поиске.');

				$this->respondJSON(array('error' => 0, 'id' => $id));

				Yii::app()->end();
			}
			else
			{
				Yii::app()->user->setFlash('vehicle_error',

						'Не удалось вернуть транспортное "' . $model->bodyType->name_ru . ' ' . $model->marka->name . ' ' . $model->modeli->name . ', номер: ' . $model->license_plate . '" средство для участия в поиске. Попробуйте еще раз.');

				$this->respondJSON(array('error' => 1, 'id' => $id));

				Yii::app()->end();
			}
		}
		else
		{
			Yii::app()->user->setFlash('vehicle_error',

					'Не удалось вернуть транспортное "' . $model->bodyType->name_ru . ' ' . $model->marka->name . ' ' . $model->modeli->name . ', номер: ' . $model->license_plate . '" средство для участия в поиске. Попробуйте еще раз.');

			$this->respondJSON(array('error' => 1, 'id' => $id));

			Yii::app()->end();
		}
	}
	
	public function actionDeletemany()
	{
		$ids = isset($_POST['ids']) ? trim($_POST['ids'], ',;') : '';

		$model = Vehicle::model();
		if ($model)
		{
			if ($model->deleteManySearch($ids))
			{
				$message = 'Выбранные транспортные средства удалены из поиска.';
				
				Yii::app()->user->setFlash('vehicle_success', $message);

				$this->respondJSON(array('error' => 0));

				Yii::app()->end();
			}
			else
			{
				$message = 'Не удалось удалить выбранные транспортные средства. Попробуйте еще раз.';
				
				Yii::app()->user->setFlash('vehicle_error', $message);

				$this->respondJSON(array('error' => 1));

				Yii::app()->end();
			}
		}
		else
		{
			$message = 'Не удалось удалить выбранные транспортные средства. Попробуйте еще раз.';
				
			Yii::app()->user->setFlash('vehicle_error', $message);

			$this->respondJSON(array('error' => 1));

			Yii::app()->end();
		}
	}
	
	public function actionReturnmany()
	{
		$ids = isset($_POST['ids']) ? trim($_POST['ids'], ',;') : '';

		$model = Vehicle::model();
		if ($model)
		{
			if ($model->returnManySearch($ids))
			{
				$message = 'Выбранные транспортные средства добавлены в поиск.';
				
				Yii::app()->user->setFlash('vehicle_success', $message);

				$this->respondJSON(array('error' => 0));

				Yii::app()->end();
			}
			else
			{
				$message = 'Не удалось добавить выбранные транспортные средства в поиск. Попробуйте еще раз.';
				
				Yii::app()->user->setFlash('vehicle_error', $message);

				$this->respondJSON(array('error' => 1));

				Yii::app()->end();
			}
		}
		else
		{
			$message = 'Не удалось добавить выбранные транспортные средства в поиск. Попробуйте еще раз.';
				
			Yii::app()->user->setFlash('vehicle_error', $message);

			$this->respondJSON(array('error' => 1));

			Yii::app()->end();
		}
	}
	
	
	public function actionDeletebase()
	{
		$id = isset($_POST['id']) ? (int) $_POST['id'] : 0;

		$model = Vehicle::model()->findByPk($id);
		$vehicleName = $model->bodyType->name_ru . ' ' . $model->make->name . ' ' . $model->model->name . ', номер: ' . $model->license_plate;
		if ($model)
		{
			if ($model->delete())
			{
				Yii::app()->user->setFlash('vehicle_success',
						'Транспортное средство "' . $vehicleName . '" удалено из базы.');

				$this->respondJSON(array('error' => 0, 'id' => $id));

				Yii::app()->end();
			}
			else
			{
				Yii::app()->user->setFlash('vehicle_error',
						'Транспортное средство "' . $vehicleName . '" не было было удалено из базы. Попробуйте еще раз.');

				$this->respondJSON(array('error' => 1, 'id' => $id));

				Yii::app()->end();
			}
		}
		else
		{
			Yii::app()->user->setFlash('vehicle_error',
					'Транспортное средство "' . $vehicleName . '" не было было удалено из базы. Попробуйте еще раз.');

			$this->respondJSON(array('error' => 1, 'id' => $id));

			Yii::app()->end();
		}
	}
	
	public function actionDeletePreviewUpload()
	{
		$filename = isset($_POST['filename']) ? trim($_POST['filename'], ';') : '';
		
		$result = false;
		if ($filename && file_exists(Yii::app()->params['files']['tmp'] . $filename))
		{
			$result = unlink(Yii::app()->params['files']['tmp'] . $filename);
		}
		
		$this->respondJSON($result);
		
		Yii::app()->end();
	}
	
	public function actionDeletePhoto()
	{
		$id = isset($_POST['id']) ? (int) $_POST['id'] : 0;
		
		$model = Photos::model()->findByPk($id);
		
		$this->respondJSON($model ? $model->delete() : false);
		
		Yii::app()->end();
	}

}