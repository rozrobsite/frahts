<?php

class UserController extends JokerController
{

	public function __construct($id, $module = null)
	{
		parent::__construct($id, $module);

		if (!$this->jokerUser) $this->redirect('/joker/main/login');
	}

	public function actionIndex()
	{
		if (!$this->jokerUser->profiles)
				$this->jokerUser->profiles = new JokerProfiles();

		if (isset($_POST['JokerProfiles']))
		{
			$this->jokerUser->profiles->attributes = $_POST['JokerProfiles'];
			$this->jokerUser->profiles->user_id = $this->jokerUser->id;
			if ($this->jokerUser->profiles->isNewRecord)
			{
				$this->jokerUser->profiles->created_at = time();
			}

			if ($this->jokerUser->profiles->save())
			{
				Yii::app()->user->setFlash('_success', 'Ваши данные успешно сохранены.');
			}
			else
			{
				Yii::app()->user->setFlash('_error',
					'Ваши данные не были сохранены. Проверьте введенные данные и попробуйте еще раз.');
			}
		}

		$this->render('index');
	}

	public function actionChangeEmail()
	{
		$model = new JokerUsers(JokerUsers::SCENARIO_CHANGE_EMAIL);
		
		// if it is ajax validation request
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'changeEmail-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if (isset($_POST['JokerUsers']))
		{
			$model->email = trim($_POST['JokerUsers']['email']);
			$model->newEmail = trim($_POST['JokerUsers']['newEmail']);
			$model->newEmailRepeat = trim($_POST['JokerUsers']['newEmailRepeat']);
			
			if ($model->validate())
			{
				$this->jokerUser->email = trim($_POST['JokerUsers']['newEmail']);

				if ($this->jokerUser->update())
				{
					$message = new YiiMailMessage;
					$message->view = 'jokerChangeEmail';
					$message->setBody(array('user' => $this->jokerUser), 'text/html');
					$message->subject = 'Изменение электронного адреса (e-mail)';
					$message->addTo($this->jokerUser->email);
					$message->from = Yii::app()->params['adminEmail'];
					Yii::app()->mail->send($message);

					Yii::app()->user->setFlash('_success',
						'Ваш элетронный адрес (e-mail) изменен успешно.');
				}
				else
				{
					Yii::app()->user->setFlash('_error',
						'Ваш элетронный адрес (e-mail) не был изменен. Проверьте введенные данные и попробуйте еще раз.');
				}
			}
			else
			{
				Yii::app()->user->setFlash('_error',
						'Ваш элетронный адрес (e-mail) не был изменен. Проверьте введенные данные и попробуйте еще раз.');
			}
		}

		$this->redirect('/joker/user');
	}

	public function actionChangePassword()
	{
		$model = new JokerUsers(JokerUsers::SCENARIO_CHANGE_PASSWORD);
		$model->email = $this->jokerUser->email;

		// if it is ajax validation request
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'changePassword-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if (isset($_POST['JokerUsers']))
		{
			$this->jokerUser->newPassword = $_POST['JokerUsers']['newPassword'];
			$this->jokerUser->password = md5($_POST['JokerUsers']['newPassword']);

			// validate user input and redirect to the previous page if valid
			if ($this->jokerUser->validate())
			{
				if ($this->jokerUser->update())
				{
					$message = new YiiMailMessage;
					$message->view = 'jokerChangePassword';
					$message->setBody(array('user' => $this->jokerUser), 'text/html');
					$message->subject = 'Изменение пароля';
					$message->addTo($this->jokerUser->email);
					$message->from = Yii::app()->params['adminEmail'];
					Yii::app()->mail->send($message);

					Yii::app()->user->setFlash('_success', 'Ваш пароль изменен успешно.');
				}
				else
				{
					Yii::app()->user->setFlash('_error',
						'Ваш пароль не был изменен. Проверьте введенные данные и попробуйте еще раз.');
				}
			}
		}

		$this->redirect('/joker/user');
	}
	
	public function actionOrganization()
	{
		if (!$this->jokerUser->organizations)
			$this->jokerUser->organizations = new JokerOrganizations();

		// if it is ajax validation request
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'organizations-form')
		{
			echo CActiveForm::validate($this->jokerUser->organizations);
			Yii::app()->end();
		}

		if (isset($_POST['Organizations']))
		{
			$this->jokerUser->organizations->attributes = $_POST['Organizations'];
			$this->jokerUser->organizations->user_id = $this->user->id;

			if ($this->user->organizations->validate())
			{
				if ($this->user->organizations->id)
				{
					if ($this->user->organizations->update())
					{
						Yii::app()->user->setFlash('_success', 'Ваши данные успешно сохранены.');
					}
					else
					{
						Yii::app()->user->setFlash('_error',
								'Ваши данные не были сохранены. Проверьте введенные данные и попробуйте еще раз.');
					}
				}
				else if ($this->user->organizations->save())
				{
					Yii::app()->user->setFlash('_success', 'Ваши данные успешно сохранены.');
				}
				else
				{
					Yii::app()->user->setFlash('_error',
							'Ваши данные не были сохранены. Проверьте введенные данные и попробуйте еще раз.');
				}
			}
			else
			{
				Yii::app()->user->setFlash('_error',
						'Ваши данные не были сохранены. Проверьте введенные данные и попробуйте еще раз.');
			}
		}

		$businessType = JokerBusinessType::model()->findAll(array('order' => 'name'));
		$listBusinesTypes = CHtml::listData($businessType, 'id', 'name');
		
		$countries = Country::model()->findAll();
		$listCountries = CHtml::listData($countries, 'id', 'name_ru');

		$listRegions = array();
		if ($this->jokerUser->organizations->region_id)
		{
			$listRegions = CHtml::listData($this->jokerUser->organizations->country->regions, 'id', 'name_ru');
		}

		$listCities = array();
		if ($this->jokerUser->organizations->city_id)
		{
			$listCities = CHtml::listData($this->jokerUser->organizations->region->cities, 'id', 'name_ru');
		}

		$this->render('organization',
				array(
					'typeOrganizations' => $listBusinesTypes,
					'countries' => $listCountries,
					'regions' => $listRegions,
					'cities' => $listCities,
				));
	}

}