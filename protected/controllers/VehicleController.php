<?php

class VehicleController extends FrahtController {

	public function __construct($id, $module = null) {
		parent::__construct($id, $module);

		if (!($this->user->profiles->user_type_id == UserTypes::FREIGHTER || $this->user->profiles->user_type_id == UserTypes::DISPATCHER))
			throw new CHttpException(503, 'Вам не разрешен доступ к этой странице!');

		Yii::app()->session['redirectUrl'] = Yii::app()->getRequest()->requestUri;
	}

	public function actionIndex() {
		$this->redirect('vehicle/active');
	}

	public function actionNew() {
		$this->processForm();
	}

	public function actionUpdate() {
		$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

//		$slug = isset($_GET['slug']) ? $_GET['slug'] : '';

		$model = Vehicle::model()->findByPk($id);
//		$model = Vehicle::model()->find('slug = "' . $slug . '"');

		if (!$model)
			throw new CHttpException(404, 'Данное транспортное средство не найдено в базе.');

		$this->processForm($model);
//		$this->processForm(isset($_GET['id']) ? $_GET['id'] : 0);
	}

	public function processForm($model = null) {
//		$model = empty($id) ? new Vehicle() : Vehicle::model()->findByPk($id);
		$model = $model == null ? new Vehicle() : $model;

		if (isset($_POST['Vehicle'])) {
			$model->attributes = $_POST['Vehicle'];
			$model->user_id = $this->user->id;
			$model->shipments = isset($_POST['Vehicle']['shipments']) ? join(',', array_keys($_POST['Vehicle']['shipments'])) : null;
			$model->permissions = isset($_POST['Vehicle']['permissions']) ? join(',', array_keys($_POST['Vehicle']['permissions'])) : null;
			$model->date_from = isset($_POST['Vehicle']['date_from']) ? strtotime($_POST['Vehicle']['date_from']) : null;
			$model->date_to = isset($_POST['Vehicle']['date_to']) ? strtotime($_POST['Vehicle']['date_to']) : null;
			if ($model->isNewRecord)
				$model->created_at = time();
			$model->updated_at = time();

//			$makeModel = Makes::model()->findByPk((int)$_POST['Vehicle']['make_id']);
//			$modelModel = Models::model()->findByPk((int)$_POST['Vehicle']['model_id']);
			$makeModel = Marka::model()->find('cat_id = ' . (int) $_POST['Vehicle']['category_id'] . ' AND marka_id = ' . (int) $_POST['Vehicle']['make_id']);
			$modelModel = Modeli::model()->find('model_id = ' . (int) $_POST['Vehicle']['model_id']);
//			$model->slugMake = $makeModel->name . ' ' . $modelModel->name;

			if ($model->validate()) {
				if ($model->save()) {
					if ($model->isNewRecord)
						Yii::app()->user->setFlash('_success', 'Транспортное средство добавлено в базу успешно.');
					else
						Yii::app()->user->setFlash('_success', 'Данные о транспортном средстве обновлены успешно.');
					if (isset($_POST['Photos'])) {
						$this->addPhotos($model->id, $_POST['Photos']);
					}

					$stringHelper = new StringHelper();
					$model->slug = $stringHelper->convertToSlug($makeModel->name . ' ' . $modelModel->name . ' ' . $model->id);
					$model->update();
					unset($stringHelper);

					$this->redirect((isset(Yii::app()->session['redirectUrl']) && !empty(Yii::app()->session['redirectUrl'])) ? Yii::app()->session['redirectUrl'] : '/vehicle/active/');
				}
				else {
					if ($model->isNewRecord)
						Yii::app()->user->setFlash('_error', 'Транспортное средство не было добавлено в базу. Проверьте вводимые данные и попробуйте еще раз.');
					else
						Yii::app()->user->setFlash('_error', 'Данные о транспортном средстве не были обновлены. Попробуйте еще раз');
				}
			}
			else {
				if ($model->isNewRecord)
					Yii::app()->user->setFlash('_error', 'Допущены ошибки при регистрации транспорта.');
				else
					Yii::app()->user->setFlash('_error', 'Допущены ошибки при обновлении данных о транспорте.');
			}
		}

		$vehicleTypes = VehicleTypes::model()->findAll(array('order' => 'name_ru'));
		$listVehicleTypes = CHtml::listData($vehicleTypes, 'id', 'name_ru');

		$categories = Categories::model()->getAll();
		$listCategories = CHtml::listData($categories, 'id', 'name');

//		$makes = Makes::model()->findAll(array('order' => 'name'));
//		$makes = Marka::model()->getAll();
		$listMakes = array();
		if ($model->make_id) {
			$listMakes = CHtml::listData($model->categories->markas, 'marka_id', 'name');
		}

		$listModels = array();
		if ($model->model_id) {
//			$listModels = CHtml::listData($model->make->models, 'id', 'name');
			$listModels = CHtml::listData($model->marka->models, 'model_id', 'name');
		}

		$bodyTypes = BodyTypes::model()->findAll(array('order' => 'order_by'));
		$listBodyTypes = CHtml::listData($bodyTypes, 'id', 'name_ru');

		$shipments = Shipment::model()->findAll(array('order' => 'name_ru'));

		$permissions = Permissions::model()->findAll(array('order' => 'name_ru'));

		$shipmentsChecked = $model->shipments ? explode(',', $model->shipments) : array();
		$permissionsChecked = $model->permissions ? explode(',', $model->permissions) : array();

		$countries = Country::model()->findAll();
		$listCountries = CHtml::listData($countries, 'id', 'name_ru');

		$listRegionsFrom = array();
		if (isset($model->country_id) && $model->country_id) {
			$listRegionsFrom = CHtml::listData($model->countries->regions, 'id', 'name_ru');
		}

		$listCitiesFrom = array();
		if (isset($model->region_id) && $model->region_id) {
			$listCitiesFrom = CHtml::listData($model->regions->cities, 'id', 'name_ru');
		}

		$listRegionsTo = array();
		if (isset($model->country_id_to) && $model->country_id_to) {
			$listRegionsTo = CHtml::listData($model->countriesTo->regions, 'id', 'name_ru');
		}

		$listCitiesTo = array();
		if (isset($model->region_id_to) && $model->region_id_to) {
			$listCitiesTo = CHtml::listData($model->regionsTo->cities, 'id', 'name_ru');
		}

		if (isset($model->id) && $model->id)
//			$this->keywords = $model->bodyType->name_ru . ',' . $model->make->name . ',' . $model->model->name;
			$this->keywords = $model->bodyType->name_ru . ',' . $model->marka->name . ',' . $model->modeli->name;

		$this->render('_vehicle', array(
			'vehicleTypes' => $listVehicleTypes,
			'categories' => $listCategories,
			'makes' => $listMakes,
			'models' => $listModels,
			'bodyTypes' => $listBodyTypes,
			'shipments' => $shipments,
			'permissions' => $permissions,
			'shipmentsChecked' => $shipmentsChecked,
			'permissionsChecked' => $permissionsChecked,
			'countries' => $listCountries,
			'regionsFrom' => $listRegionsFrom,
			'citiesFrom' => $listCitiesFrom,
			'regionsTo' => $listRegionsTo,
			'citiesTo' => $listCitiesTo,
			'model' => $model,
		));
	}

	public function actionActive() {
		Yii::app()->session['redirectUrl'] = Yii::app()->getRequest()->requestUri;

		$model = Vehicle::model();
		$this->render('_active', array(
			'activeVehicles' => $model->findAllByDeleted(false),
		));
	}

	public function actionInactive() {
		Yii::app()->session['redirectUrl'] = Yii::app()->getRequest()->requestUri;

		$model = Vehicle::model();
		$this->render('_inactive', array(
			'noactiveVehicles' => $model->findAllByDeleted(),
		));
	}

	public function actionUpload() {
		Yii::import("ext.EAjaxUpload.qqFileUploader");

		$uploader = new qqFileUploader(Yii::app()->params['images']['allowedExtensions'], Yii::app()->params['images']['sizeLimit']);
		$result = $uploader->handleUpload(Yii::app()->params['files']['tmp']);

		$this->respondJSON($result);

		if (file_exists(Yii::app()->params['files']['tmp'])) {
			unlink(Yii::app()->params['files']['tmp']);
		}

		Yii::app()->end();
	}

	private function addPhotos($vehicle_id, $data) {
		if (!$data)
			return;

		$countPhotos = Photos::model()->count('vehicle_id = ' . (int) $vehicle_id);
		$data = array_slice($data, 0, Photos::MAX_UPLOAD_FILES - $countPhotos);

		$count = 0;
		foreach ($data as $photo) {
			$photoPath = Yii::app()->params['files']['tmp'] . $photo;
			echo $photoPath."<br/>";
			$image = Yii::app()->image->load($photoPath);

			if (!$image)
				continue;

			$model = new Photos();
			$model->vehicle_id = (int) $vehicle_id;
			if ($model->save()) {
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

	public function actionView() {
		$slug = isset($_GET['slug']) ? trim($_GET['slug']) : '';

		$model = Vehicle::model()->find('slug = "' . $slug . '" AND is_deleted = 0');

		$shipments = Shipment::model()->findAll('id IN (' . $model->shipments . ')');
		$shipmentsArray = CHtml::listData($shipments, 'id', 'name_ru');

		$permissions = Permissions::model()->findAll('id IN (' . $model->permissions . ')');
		$permissionsArray = CHtml::listData($permissions, 'id', 'name_ru');
		if (array_key_exists(Permissions::ADR, $permissionsArray)) {
			$permissionsArray[Permissions::ADR] = $permissionsArray[Permissions::ADR] . ' (' . $model->adr . ')';
		}

		if (!is_object($model))
			throw new CHttpException(404, 'Страница груза не найдена!');

		$this->render('view', array(
			'model' => $model,
			'shipments' => join(', ', $shipmentsArray),
			'permissions' => join(', ', $permissionsArray),
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