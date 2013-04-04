<?php

class UserController extends FrahtController
{

	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
		);
	}

	private function userSettings()
	{
		$userTypes = UserTypes::model()->findAll(array('order' => 'name_ru'));
		$listUserTypes = CHtml::listData($userTypes, 'id', 'name_ru');

		$countries = Country::model()->findAll();
		$listCountries = CHtml::listData($countries, 'id', 'name_ru');

		$listRegions = array();
		if (isset($this->user->profiles->region_id))
		{
			$listRegions = CHtml::listData($this->user->profiles->country->regions, 'id',
							'name_ru');
		}

		$listCities = array();
		if (isset($this->user->profiles->city_id))
		{
			$listCities = CHtml::listData($this->user->profiles->region->cities, 'id',
							'name_ru');
		}

		$this->render('index',
				array(
			'model' => isset($this->user->profiles->id) ? $this->user->profiles : new Profiles(),
			'userTypes' => $listUserTypes,
			'countries' => $listCountries,
			'regions' => $listRegions,
			'cities' => $listCities,
			'user' => $this->user,
		));
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		if (isset($_POST['Profiles']))
		{
			$this->user->profiles = isset($this->user->profiles->id) ? $this->user->profiles
						: new Profiles();
			$this->user->profiles->attributes = $_POST['Profiles'];
			$this->user->profiles->user_id = $this->user->id;

			if (isset($_POST['ajax']) && $_POST['ajax'] === 'profile-form')
			{
				echo CActiveForm::validate($this->user->profiles);
				Yii::app()->end();
			}

			if ($this->user->profiles->validate())
			{
				if ($this->user->profiles->id)
				{
					$this->user->profiles->updated_at = time();
					if ($this->user->profiles->update())
					{
						Yii::app()->user->setFlash('user_action_success',
								'Ваши данные успешно сохранены.');
					}
					else
					{
						Yii::app()->user->setFlash('user_action_error',
								'Ваши данные не были сохранены. Проверьте введенные данные и попробуйте еще раз.');
					}
				}
				else
				{
					$this->user->profiles->created_at = time();
					if ($this->user->profiles->save())
					{
						Yii::app()->user->setFlash('user_action_success',
								'Ваши данные успешно сохранены.');
					}
					else
					{
						Yii::app()->user->setFlash('user_action_error',
								'Ваши данные не были сохранены. Проверьте введенные данные и попробуйте еще раз.');
					}
				}
				
				if (isset($_POST['Photos']['avatar']) && !empty($_POST['Photos']['avatar']) && isset($this->user->profiles->id) && $this->user->profiles)
				{
//					$photo = $_POST['Photos']['avatar'];
					$photoPath = Yii::app()->params['files']['tmp'] . $_POST['Photos']['avatar'];
					$image = Yii::app()->image->load($photoPath);

					if (!$image) return;

					$this->user->profiles->avatar = $this->user->id . '.jpg';
					$image->resize(Yii::app()->params['images']['avatar']['width'], Yii::app()->params['images']['avatar']['height']);
					$image->save(Yii::app()->params['files']['avatars'] . $this->user->id . '.jpg');
					
					$this->user->profiles->save();
				}
			}
		}

		$this->userSettings();
	}

	public function actionOrganization()
	{
		$this->user->organizations = isset($this->user->organizations->id) ? $this->user->organizations
					: new Organizations();

		if (isset($_POST['Organizations']))
		{
			$this->user->organizations->attributes = $_POST['Organizations'];
			$this->user->organizations->user_id = $this->user->id;
			$this->user->organizations->edrpou = $this->user->organizations->type_org_id == Organizations::TYPE_PRIVATE
						? null : $_POST['Organizations']['edrpou'];

//			if (isset($_POST['ajax']) && $_POST['ajax'] === 'organizations-form')
//			{
//				echo CActiveForm::validate($this->user->organizations);
//				Yii::app()->end();
//			}

			if ($this->user->organizations->validate())
			{
				if ($this->user->organizations->id)
				{
					if ($this->user->organizations->update())
					{
						Yii::app()->user->setFlash('user_action_success',
								'Ваши данные успешно сохранены.');
					}
					else
					{
						Yii::app()->user->setFlash('user_action_error',
								'Ваши данные не были сохранены. Проверьте введенные данные и попробуйте еще раз.');
					}
				}
				else if ($this->user->organizations->save())
				{
					Yii::app()->user->setFlash('user_action_success',
							'Ваши данные успешно сохранены.');
				}
				else
				{
					Yii::app()->user->setFlash('user_action_error',
							'Ваши данные не были сохранены. Проверьте введенные данные и попробуйте еще раз.');
				}
			}
		}

		$typeOrganizations = TypeOrganizations::model()->findAll(array('order' => 'name_ru'));
		$listTypeOrganizations = CHtml::listData($typeOrganizations, 'id', 'name_ru');

		$privateName = isset($this->user->profiles->id) ? $this->user->profiles->last_name
				. " " . strtoupper(mb_substr($this->user->profiles->first_name, 0, 1,
								'UTF-8'))
				. ". " . strtoupper(mb_substr($this->user->profiles->middle_name, 0, 1,
								'UTF-8')) . "." : '';

		$this->render('organization',
				array(
			'model' => $this->user->organizations,
			'typeOrganizations' => $listTypeOrganizations,
			'privateName' => $privateName,
		));
	}

	public function actionEmployee()
	{
		$this->render('employee', array());
	}

	public function actionFeedback()
	{
		$model = new Feedback();

		// if it is ajax validation request
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'feedback-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if (isset($_POST['Feedback']))
		{
			$model->attributes = $_POST['Feedback'];
			$model->email = $this->user->email;

			// validate user input and redirect to the previous page if valid
			if ($model->validate())
			{
				if ($model->save())
				{
					$message = new YiiMailMessage;
					$message->setBody($model->message, 'text/plain');
					$message->subject = 'frahts.com: Обратная связь';
					$message->addTo(Yii::app()->params['adminEmail']);
					$message->addTo('imperia1991@gmail.com');
					$message->from = $this->user->email;
					if (Yii::app()->mail->send($message))
							Yii::app()->user->setFlash('feedback_success',
								'Ваше сообщение успешно отправлено.');
					else
							Yii::app()->user->setFlash('feedback_failure',
								'Сообщение не было отправлено. Повторите еще раз.');

					$this->refresh();
				}

				$this->redirect('/user');
			}
		}

		$this->render('feedback', array('userFeedback' => true, 'model' => $model));
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if ($error = Yii::app()->errorHandler->error)
		{
			if (Yii::app()->request->isAjaxRequest) echo $error['message'];
			else $this->render('error' . $error['code'], $error);
		}
	}

	public function actionChangeEmail()
	{
		$model = new Users(Users::SCENARIO_CHANGE_EMAIL);

		// if it is ajax validation request
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'changeEmail-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if (isset($_POST['Users']))
		{
			$this->user->email = $_POST['Users']['newEmail'];
			$this->user->username = $_POST['Users']['newEmail'];

			// validate user input and redirect to the previous page if valid
			if ($this->user->validate())
			{
				if ($this->user->update())
				{
					$message = new YiiMailMessage;
					$message->view = 'changeEmail';
					$message->setBody(array('user' => $this->user), 'text/plain');
					$message->subject = 'Изменение электронного адреса';
					$message->addTo($this->user->email);
					$message->from = Yii::app()->params['adminEmail'];
					Yii::app()->mail->send($message);

					Yii::app()->user->setFlash('user_action_success',
							'Ваш элетронный адрес изменен успешно.');
				}
				else
				{
					Yii::app()->user->setFlash('user_action_error',
							'Ваш элетронный адрес не был изменен. Проверьте введенные данные и попробуйте еще раз.');
				}
			}
		}

		$this->redirect('/user');
	}

	public function actionChangePassword()
	{
		$model = new Users(Users::SCENARIO_CHANGE_PASSWORD);

		// if it is ajax validation request
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'changePassword-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if (isset($_POST['Users']))
		{
			$this->user->newPassword = $_POST['Users']['newPassword'];
			$this->user->password = md5($_POST['Users']['newPassword']);

			// validate user input and redirect to the previous page if valid
			if ($this->user->validate())
			{
				if ($this->user->update())
				{
					$message = new YiiMailMessage;
					$message->view = 'changePassword';
					$message->setBody(array('user' => $this->user), 'text/plain');
					$message->subject = 'Изменение пароля';
					$message->addTo($this->user->email);
					$message->from = Yii::app()->params['adminEmail'];
					Yii::app()->mail->send($message);

					Yii::app()->user->setFlash('user_action_success',
							'Ваш пароль изменен успешно.');
				}
				else
				{
					Yii::app()->user->setFlash('user_action_error',
							'Ваш пароль не был изменен. Проверьте введенные данные и попробуйте еще раз.');
				}
			}
		}

		$this->redirect('/user');
	}

	public function actionUpload()
	{
		Yii::import("ext.EAjaxUpload.qqFileUploader");

		$uploader = new qqFileUploader(Yii::app()->params['images']['allowedExtensions'], Yii::app()->params['images']['sizeAvatarLimit']);
		$result = $uploader->handleUpload(Yii::app()->params['files']['tmp']);

		$this->respondJSON($result);

//		if (file_exists(Yii::app()->params['files']['tmp'] . $result['filename']))
//		{
//			unlink(Yii::app()->params['files']['tmp'] . $result['filename']);
//		}

		Yii::app()->end();
	}

	private function addPhotos($path)
	{
		if (empty($path)) return;
	}

}