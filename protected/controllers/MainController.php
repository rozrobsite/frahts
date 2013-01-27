<?php

class MainController extends Controller
{

	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha' => array(
				'class' => 'CCaptchaAction',
				'backColor' => 0x404040,
				'foreColor' => 0xFFFFFF
			),
			// page action renders "static" pages stored under 'protected/views/main/pages'
			// They can be accessed via: index.php?r=main/page&view=FileName
			'page' => array(
				'class' => 'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/main/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
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

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model = new ContactForm;
		if (isset($_POST['ContactForm']))
		{
			$model->attributes = $_POST['ContactForm'];
			if ($model->validate())
			{
				$name = '=?UTF-8?B?' . base64_encode($model->name) . '?=';
				$subject = '=?UTF-8?B?' . base64_encode($model->subject) . '?=';
				$headers = "From: $name <{$model->email}>\r\n" .
						"Reply-To: {$model->email}\r\n" .
						"MIME-Version: 1.0\r\n" .
						"Content-type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'], $subject, $model->body, $headers);
				Yii::app()->user->setFlash('contact',
						'Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact', array('model' => $model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model = new Users(Users::SCENARIO_LOGIN);

		// if it is ajax validation request
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if (isset($_POST['Users']))
		{
			$model->attributes = $_POST['Users'];
			
			// validate user input and redirect to the previous page if valid
			if ($model->validate() && $model->login())
			{
				$user = Users::model()->findByPk((int)Yii::app()->user->id);
				
				if(!empty($user->code))
				{
					Yii::app()->user->logout();
					
					throw new CHttpException(503,'Извините, но вы еще не подтвердили свою регистрацию.');
					
					Yii::app()->end();
				}
				
				$user->logins = $user->logins + 1;
				$user->last_login = time();
				$user->update();
				
				$this->redirect('/user');
			}
		}
		// display the login form
		$this->render('login', array('model' => $model));
	}

	/**
	 * Displays the forgot page
	 */
	public function actionForgot()
	{
		$model = new Users('forgot');

		// if it is ajax validation request
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'forgot-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if (isset($_POST['Users']))
		{
			$model->attributes = $_POST['Users'];
			// validate user input and redirect to the previous page if valid
			if ($model->validate())
			{
				$email = $_POST['Users']['email'];
				$user = Users::model()->findByAttributes(array('email' => $email));
//				if (!$user)
//				{
//					throw new CHttpException(404,'Пользователь с элетронным адресом ' . $user->email . ' не найден.');
//					
//					Yii::app()->end();
//				}
				
				$user->password_repeat = Locallib::generate_password(6);
				$user->password = md5($user->password_repeat);
				
				if($user->save(false))
				{
					$message = new YiiMailMessage;
					$message->view = 'forgot';
					$message->setBody(array('user' => $user), 'text/plain');
					$message->subject = 'Востановление пароля';
					$message->addTo($user->email);
					$message->from = Yii::app()->params['adminEmail'];
					Yii::app()->mail->send($message);

					Yii::app()->user->setFlash('forgot',
							'На Ваш электронный адрес ' . $user->email . ' выслано письмо с новым паролем.');
					$this->refresh();
				}
			}
		}
		// display the login form
		$this->render('forgot', array('model' => $model));
	}

	public function actionRegister()
	{
		$model = new Users(Users::SCENARIO_REGISTER);

		// if it is ajax validation request
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'register-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if (isset($_POST['Users']))
		{
			$model->attributes = $_POST['Users'];
			// validate user input and redirect to the previous page if valid
			if ($model->validate())
			{
				$model->username = $model->email;
				$model->password = md5($model->password);
				$model->code = md5($model->email . $model->password . time());
				// Сохранить полученные данные
				// false нужен для того, чтобы не производить повторную проверку
				if ($model->save(false))
				{			
					$message = new YiiMailMessage;
					$message->view = 'register';
					$message->setBody(array('user' => $model), 'text/plain');
					$message->subject = 'Регистрация';
					$message->addTo($model->email);
					$message->from = Yii::app()->params['adminEmail'];
					Yii::app()->mail->send($message);
					
					Yii::app()->user->setFlash('register',
							'На Ваш электронный адрес ' . $model->email . ' выслано письмо с инструкциями для продолжения регистрации.');
					$this->refresh();
				}
			}
		}
		
		
		// display the login form
		$this->render('register', array('model' => $model, 'term' => Terms::model()->findByPk(1)));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
	
	public function actionCode()
	{
		$code = isset($_GET['code']) ? $_GET['code'] : '';
		$user = Users::model()->findByAttributes(array('code' => $code));
		
//		if(!$user)
//		{
//			throw new CHttpException(404,'Указанный код не найден. Попрубуйте еще раз или зарегистрируйтесь снова.');
//			
//			Yii::app()->end();
//		}
		
		if (isset($user) && $user->loginByCode($code))
		{
			$user->code = '';
			$user->logins = (int)$user->logins + 1;
			$user->last_login = time();
			
			if($user->save(false))
			{
				$this->redirect('/user');
			}
		}
		else
		{
			throw new CHttpException(404,'Указанный код не найден. Попрубуйте еще раз или зарегистрируйтесь снова.');
			
			Yii::app()->end();
		}
	}

}