<?php

class MainController extends JokerController
{

	public function __construct($id, $module = null)
	{
		parent::__construct($id, $module);
	}

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

	public function actionIndex()
	{
		$this->render('index');
	}

	public function actionLogin()
	{
		$model = new JokerUsers();
		if (isset($_POST['JokerUsers']))
		{
			$model->attributes = $_POST['JokerUsers'];
			$model->password = $_POST['JokerUsers']['password'];

			if ($model->login())
			{
				$this->redirect('/joker');
			}
		}

		$this->render('login', array('model' => $model));
	}

	/**
	 * Displays the forgot page
	 */
	public function actionForgot()
	{
		$model = new JokerUsers(JokerUsers::SCENARIO_FORGOT);

		// collect user input data
		if (isset($_POST['JokerUsers']))
		{
			$model->attributes = $_POST['JokerUsers'];
			// validate user input and redirect to the previous page if valid
			if ($model->validate())
			{
				$email = $_POST['JokerUsers']['email'];
				$user = JokerUsers::model()->findByAttributes(array('email' => trim($email)));

				$user->password_repeat = Locallib::generate_password(6);
				$user->password = md5($user->password_repeat);

				if ($user->save(false))
				{
					$message = new YiiMailMessage;
					$message->view = 'joker_forgot';
					$message->setBody(array('user' => $user), 'text/html');
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
		$model = new JokerUsers(JokerUsers::SCENARIO_REGISTER);

		// collect user input data
		if (isset($_POST['JokerUsers']))
		{
			$model->attributes = $_POST['JokerUsers'];
			// validate user input and redirect to the previous page if valid
			if ($model->validate())
			{
				$model->password = md5($model->password);

				$cookie = new CHttpCookie('frahts_joker_user', md5(time() . $model->email));
				$cookie->expire = time() + 60 * 60 * 24 * 7;
				Yii::app()->request->cookies['frahts_joker_user'] = $cookie;

				$model->s_code = $cookie->value;

				// Сохранить полученные данные
				// false нужен для того, чтобы не производить повторную проверку
				if ($model->save(false))
				{
					$message = new YiiMailMessage;
					$message->view = 'joker_register';
					$message->setBody(array('user' => $model), 'text/html');
					$message->subject = 'Регистрация';
					$message->addTo($model->email);
					$message->from = Yii::app()->params['adminEmail'];
					Yii::app()->mail->send($message);

					Yii::app()->user->setFlash('register',
						'На Ваш электронный адрес ' . $model->email . ' выслано письмо с регистрационными данными.');

					$this->redirect('/joker/user');
				}
			}
		}


		// display the login form
		$this->render('register',
			array('model' => $model, 'term' => Terms::model()->findByPk(1)));
	}

	public function actionUseragreement()
	{
		$this->render('useragreement');
	}

	public function actionLogout()
	{
		Yii::app()->session->destroy();
		Yii::app()->user->logout(true);
		unset(Yii::app()->request->cookies['frahts_joker_user']);

		$this->redirect('/joker');
	}

}