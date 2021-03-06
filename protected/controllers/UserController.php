<?php

class UserController extends FrahtController
{
	private $_receivingUsers = array();

	public function __construct($id, $module = null)
	{
		parent::__construct($id, $module);

		$this->_receivingUsers = Messages::model()->getReceivingUsers($this->user);
	}

	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
		);
	}

	private function userSettings($profiles)
	{
		if ($this->user->vehicles && $this->user->goods)
			$userTypes = UserTypes::model()->findAll(array('order' => 'name_ru'));
		elseif ($this->user->vehicles)
			$userTypes = UserTypes::model()->findAll('id <> ' . UserTypes::SHIPPER, array('order' => 'name_ru'));
		elseif ($this->user->goods)
			$userTypes = UserTypes::model()->findAll('id <> ' . UserTypes::FREIGHTER, array('order' => 'name_ru'));
		else
			$userTypes = UserTypes::model()->findAll(array('order' => 'name_ru'));

		$listUserTypes = CHtml::listData($userTypes, 'id', 'name_ru');

		$countries = Country::model()->findAll();
		$listCountries = CHtml::listData($countries, 'id', 'name_ru');

		$listRegions = array();
		if ($profiles->region_id)
		{
			$listRegions = CHtml::listData($profiles->country->regions, 'id',
							'name_ru');
		}

		$listCities = array();
		if ($profiles->city_id)
		{
			$listCities = CHtml::listData($profiles->region->cities, 'id',
							'name_ru');
		}

		$this->user->organizations = isset($this->user->organizations->id) ? $this->user->organizations
					: new Organizations();
		$typeOrganizations = TypeOrganizations::model()->findAll(array('order' => 'name_ru'));
		$listTypeOrganizations = CHtml::listData($typeOrganizations, 'id', 'name_ru');
		$formOrganizations = FormOrganizations::model()->findAll(array('order' => 'name_ru'));
		$listFormOrganizations = CHtml::listData($formOrganizations, 'id', 'name_ru');

		$privateName = isset($this->user->profiles->id) ? $this->user->profiles->last_name
				. " " . strtoupper(mb_substr($this->user->profiles->first_name, 0, 1,
								'UTF-8'))
				. ". " . strtoupper(mb_substr($this->user->profiles->middle_name, 0, 1,
								'UTF-8')) . "." : '';

		$this->render('index',
				array(
			'model' => $profiles,
			'userTypes' => $listUserTypes,
			'countries' => $listCountries,
			'regions' => $listRegions,
			'cities' => $listCities,
			'user' => $this->user,
			'receivingUsers' => $this->_receivingUsers,
			'typeOrganizations' => $listTypeOrganizations,
			'formOrganizations' => $listFormOrganizations,
			'privateName' => $privateName,
		));
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		$this->user->profiles = isset($this->user->profiles->id) ? $this->user->profiles
						: new Profiles();

		if (isset($_POST['Profiles']))
		{
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
					$this->user->profiles->created_at = time();
					if ($this->user->profiles->save())
					{
						Yii::app()->user->setFlash('_success', 'Ваши данные успешно сохранены.');
					}
					else
					{
						Yii::app()->user->setFlash('_error',
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
					$image->resize(Yii::app()->params['images']['avatar']['width'],
							Yii::app()->params['images']['avatar']['height']);
					$image->save(Yii::app()->params['files']['avatars'] . $this->user->id . '.jpg');

					$image->resize(Yii::app()->params['images']['avatar']['small_width'],
							Yii::app()->params['images']['avatar']['small_height']);
					$image->save(Yii::app()->params['files']['avatars'] . $this->user->id . '_s.jpg');

					$this->user->profiles->save();
				}
			}
			else
			{
				Yii::app()->user->setFlash('_error',
						'Ваши данные не были сохранены. Проверьте введенные данные и попробуйте еще раз.');
			}
		}

		$this->userSettings($this->user->profiles);
	}

	public function actionOrganization()
	{
		$this->user->organizations = isset($this->user->organizations->id) ? $this->user->organizations
					: new Organizations();

		// if it is ajax validation request
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'organizations-form')
		{
			echo CActiveForm::validate($this->user->organizations);
			Yii::app()->end();
		}

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

		$this->redirect('/user');

//		$typeOrganizations = TypeOrganizations::model()->findAll(array('order' => 'name_ru'));
//		$listTypeOrganizations = CHtml::listData($typeOrganizations, 'id', 'name_ru');
//		$formOrganizations = FormOrganizations::model()->findAll(array('order' => 'name_ru'));
//		$listFormOrganizations = CHtml::listData($formOrganizations, 'id', 'name_ru');
//
//		$privateName = isset($this->user->profiles->id) ? $this->user->profiles->last_name
//				. " " . strtoupper(mb_substr($this->user->profiles->first_name, 0, 1,
//								'UTF-8'))
//				. ". " . strtoupper(mb_substr($this->user->profiles->middle_name, 0, 1,
//								'UTF-8')) . "." : '';

//		$this->render('organization',
//				array(
//			'model' => $this->user->organizations,
//			'typeOrganizations' => $listTypeOrganizations,
//			'formOrganizations' => $listFormOrganizations,
//			'privateName' => $privateName,
//			'receivingUsers' => $this->_receivingUsers,
//		));
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
			$model->created_at = time();

			// validate user input and redirect to the previous page if valid
			if ($model->validate())
			{
				if ($model->save())
				{
					$adminEmail = array_keys(Yii::app()->params['adminEmail']);

					$message = new YiiMailMessage;
					$message->setBody($model->message, 'text/plain');
					$message->subject = 'frahts.com: Обратная связь (' . $model->subject . ')';
					$message->addTo($adminEmail[0]);
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
			$model->email = $_POST['Users']['newEmail'];
			$model->username = $_POST['Users']['newEmail'];

			// validate user input and redirect to the previous page if valid
//			echo '<pre>';
//			print_r($this->user->validate());
//			echo '</pre>';die();
			if ($model->validate())
			{
				$this->user->email = $_POST['Users']['newEmail'];
				$this->user->username = $_POST['Users']['newEmail'];

				if ($this->user->update())
				{
					$message = new YiiMailMessage;
					$message->view = 'changeEmail';
					$message->setBody(array('user' => $this->user), 'text/plain');
					$message->subject = 'Изменение электронного адреса';
					$message->addTo($this->user->email);
					$message->from = Yii::app()->params['adminEmail'];
					Yii::app()->mail->send($message);

					Yii::app()->user->setFlash('_success',
							'Ваш элетронный адрес изменен успешно.');
				}
				else
				{
					Yii::app()->user->setFlash('_error',
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

					Yii::app()->user->setFlash('_success', 'Ваш пароль изменен успешно.');
				}
				else
				{
					Yii::app()->user->setFlash('_error',
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

	public function actionFaq()
	{
		$this->render('faq');
	}

	private function addPhotos($path)
	{
		if (empty($path)) return;
	}

	public function actionMessages()
	{
		$usersModel = Users::model();
		$messagesModel = Messages::model();

		$user_id = isset($_GET['user']) ? (int) $_GET['user'] : 0;
		$type = isset($_GET['type']) ? (int) $_GET['type'] : Messages::TYPE_LAST;

		$receivingUser = $usersModel->findByPk($user_id);
		$receivingUsers = $messagesModel->getReceivingUsers($this->user, $receivingUser);
		$models = Messages::model()->getMessages($this->user, $receivingUser, $type);

		if ($this->messagesCount)
				$messagesModel->updateAll(array('is_view' => 1),
					'receiving_user_id = ' . $this->user->id);

		$this->render('messages',
				array(
			'receivingUser' => $receivingUser,
			'receivingUsers' => $receivingUsers,
			'models' => $models,
			'message' => $messagesModel
		));
	}

	public function actionSearchUsers()
	{
		$searchText = isset($_POST['searchText']) ? trim($_POST['searchText']) : '';

		if (empty($searchText))
		{
			echo $this->respondJSON(array('error' => 1));

			Yii::app()->end();
		}

		$users = Profiles::model()->searchUsers($this->user, $searchText);
		$userList = $this->renderPartial('_userList',
				array('receivingUsers' => $users), TRUE);

		echo $this->respondJSON(array('error' => 0, 'userList' => $userList));

		Yii::app()->end();
	}

	public function actionNotes()
	{
		if ($this->notesCount)
				Notes::model()->updateAll(array('is_show' => 1),
					'user_id = ' . $this->user->id);

		$models = Notes::model()->findAll();

		$this->render('notes',
				array(
			'models' => $models,
			'receivingUsers' => $this->_receivingUsers,
		));
	}

	public function actionView()
	{
		$userid = isset($_GET['id']) ? trim($_GET['id']) : 0;
		$offer_id = isset($_GET['offer']) ? (int) $_GET['offer'] : 0;

		if ($userid == $this->user->id)
			$this->redirect('/user');

		$user = Users::model()->find('id = "' . $userid . '"');

		if (!is_object($user))
				throw new CHttpException(404, 'Страница пользователя не найдена!');

		$offer = Offers::model()->madeDeal($this->user, $user, $offer_id);

		$this->render('view', array(
			'model' => $user,
			'offer' => $offer,
			'offer_id' => $offer_id,
			'canWrite' => $offer && !$offer->review_id,
		));
	}

	public function actionReviews()
	{
		$this->render('reviews', array(
			'receivingUsers' => $this->_receivingUsers,
		));
	}

	public function actionReview()
	{
		$receivingUserId = isset($_POST['receiving_user_id']) ? (int)$_POST['receiving_user_id'] : 0;
		$reviewText = isset($_POST['review_text']) ? trim($_POST['review_text']) : '';
		$rating = isset($_POST['rating']) ? (int) $_POST['rating'] : 0;
		$offer_id = isset($_POST['offer_id']) ? (int) $_POST['offer_id'] : 0;

		if (empty($receivingUserId) || empty($reviewText) || empty($rating))
		{
			echo $this->respondJSON(array('error' => 1));

			Yii::app()->end();
		}

		$review = new Reviews();
		$review->author_id = $this->user->id;
		$review->receiving_user_id = $receivingUserId;
		$review->rating = $rating;
		$review->text = nl2br($reviewText);
		$review->created_at = time();

		if (!$review->save())
		{
			echo $this->respondJSON(array('error' => 2, 'errors_text' => $review->getErrors()));

			Yii::app()->end();
		}

		if ($offer_id)
			Offers::model()->updateByPk($offer_id, array('review_id' => $review->id));

		echo $this->respondJSON(array('error' => 0));

		Yii::app()->end();
	}

}