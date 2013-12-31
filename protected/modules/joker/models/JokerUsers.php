<?php

/**
 * This is the model class for table "joker_users".
 *
 * The followings are the available columns in table 'joker_users':
 * @property string $id
 * @property string $email
 * @property string $password
 * @property string $logins
 * @property string $last_login
 * @property integer $enabled
 * @property string $s_code
 */
class JokerUsers extends ActiveRecord
{

	const SCENARIO_REGISTER = 'register';
	const SCENARIO_LOGIN = 'login';
	const SCENARIO_FORGOT = 'forgot';
	const SCENARIO_CHANGE_EMAIL = 'newEmail';
	const SCENARIO_CHANGE_PASSWORD = 'newPassword';

	public $rememberMe = 0;
	// для капчи
	public $verifyCode;
	// для поля "повтор пароля"
	public $password_repeat;
	// для изменения email
	public $newEmail;
	public $newEmailRepeat;
	// для изменения password
	public $oldPassword;
	public $newPassword;
	public $newPasswordRepeat;
	public $agree;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return JokerUsers the static model class
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'joker_users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('email', 'required', 'on' => self::SCENARIO_REGISTER . ', ' . self::SCENARIO_LOGIN . ', ' . self::SCENARIO_FORGOT . ', ' . self::SCENARIO_CHANGE_EMAIL),
			array('password', 'required', 'on' => self::SCENARIO_REGISTER . ', ' . self::SCENARIO_LOGIN),
			array('email', 'email'),
			array('email', 'forgot', 'on' => self::SCENARIO_FORGOT),
			array('email', 'unique', 'on' => self::SCENARIO_REGISTER),
			array('password', 'length', 'min' => 6, 'max' => 30, 'on' => self::SCENARIO_REGISTER . ', ' . self::SCENARIO_LOGIN),
			array('password', 'authenticate', 'on' => self::SCENARIO_LOGIN),
			array('password_repeat', 'compare', 'compareAttribute' => 'password', 'on' => self::SCENARIO_REGISTER),
			array('password_repeat, email', 'required', 'on' => self::SCENARIO_REGISTER),
			array('password_repeat', 'length', 'min' => 6, 'max' => 30),
			array('agree', 'mustCheck', 'on' => self::SCENARIO_REGISTER),
//			array('enabled', 'boolean'),
			array('verifyCode', 'captcha', 'on' => self::SCENARIO_REGISTER),
			array('email', 'forgot', 'on' => self::SCENARIO_CHANGE_EMAIL),
			array('newEmail, newEmailRepeat', 'required', 'on' => self::SCENARIO_CHANGE_EMAIL),
			array('newEmail, newEmailRepeat', 'email', 'on' => self::SCENARIO_CHANGE_EMAIL),
			array('newEmailRepeat', 'compare', 'compareAttribute' => 'newEmail', 'on' => self::SCENARIO_CHANGE_EMAIL),
			array('oldPassword, newPassword, newPasswordRepeat', 'length', 'min' => 6, 'max' => 30,
				'on' => self::SCENARIO_CHANGE_PASSWORD),
			array('oldPassword', 'changePassword', 'on' => self::SCENARIO_CHANGE_PASSWORD),
			array('oldPassword, newPassword, newPasswordRepeat', 'required', 'on' => self::SCENARIO_CHANGE_PASSWORD),
			array('newPasswordRepeat', 'compare', 'compareAttribute' => 'newPassword', 'on' => self::SCENARIO_CHANGE_PASSWORD),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'profiles' => array(self::HAS_ONE, 'JokerProfiles', 'user_id'),
			'organizations' => array(self::HAS_ONE, 'JokerOrganizations', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'email' => 'E-mail',
			'password' => 'Пароль',
			'logins' => 'Количество заходов на сайт',
			'last_login' => 'Последний раз заходил',
			'enabled' => 'Доступ',
			'verifyCode' => 'Код проверки',
			'newEmail' => '"Новый электронный адрес"',
			'newEmailRepeat' => '"Повторите новый электронный адрес"',
			'oldPassword' => '"Текущий пароль"',
			'newPassword' => '"Новый пароль"',
			'newPasswordRepeat' => '"Повторите новый пароль"',
			'agree' => 'Я согласен с <a id="term_modal_open">Условиями Пользовательского соглашения и Политики конфиденциальности</a>'
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id, true);
		$criteria->compare('email', $this->email, true);
		$criteria->compare('password', $this->password, true);
		$criteria->compare('logins', $this->logins, true);
		$criteria->compare('last_login', $this->last_login, true);
		$criteria->compare('enabled', $this->enabled);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}

	public function authenticate($attribute, $params)
	{
		if (!$this->hasErrors())
		{
			$user = $this->login();

			if (!$user)
			{
				$this->addError('email', 'Неправильно введены Email или Пароль');
			}
		}
	}

	public function login($s_code = null)
	{
		$result = $s_code
			? $this->findByAttributes(array('s_code' => $s_code))
			: $this->find('email = "' . trim($this->email) . '" AND password = "' . md5($this->password) . '"');

		if ($result && $result->enabled)
		{
			Yii::app()->session['joker_id'] = (int) $result->id;
			Yii::app()->session['joker_email'] = $result->email;

			$cookie = new CHttpCookie('frahts_joker_user', md5(time() . $result->email));
			$cookie->expire = time() + 60 * 60 * 24 * 7;
			Yii::app()->request->cookies['frahts_joker_user'] = $cookie;

			$result->last_login = time();
			$result->logins = $result->logins + 1;
			$result->s_code = $cookie->value;
			$result->update();
		}
		else
		{
			if ($result && !$result->enabled)
					$this->addError('email',
					'Вам заблокирован доступ на сайт. Свяжитесь с Администрацией сайта для консультирования.');
			else $this->addError('email', 'Неправильно введены Email или Пароль');
		}

		return $result;

//		if ($this->_identity === null)
//		{
//			$this->_identity = new UserIdentity($this->email, $this->password);
//			$this->_identity->authenticate();
//		}
//		if ($this->_identity->errorCode === UserIdentity::ERROR_NONE)
//		{
//			$duration = 3600 * 24 * 7; // 7 days
//			Yii::app()->user->login($this->_identity, $duration);
//			return true;
//		}
//		else return false;
	}

	public function changeSCode()
	{
		$cookie = new CHttpCookie('frahts_joker_user', md5(time() . $result->email));
		$cookie->expire = time() + 60 * 60 * 24 * 7;
		Yii::app()->request->cookies['frahts_joker_user'] = $cookie;

		$this->s_code = $cookie->value;
		$this->update();
	}

	public function forgot($attribute, $params)
	{
		if (!$this->hasErrors())
		{
			if (!$this->findByAttributes(array('email' => $this->email)))
					$this->addError('email',
					'Пользователь с таким элетронным адресом не найден.');
		}
	}

	public function changePassword($attribute, $params)
	{
		if (!$this->hasErrors())
		{
			if (!$this->find('email = "' . $this->email . '" AND password = "' . md5($this->oldPassword) . '"'))
					$this->addError('oldPassword', 'Вы неправильно ввели текущий пароль.');
		}
	}

	public function mustCheck($attribute, $params)
	{
		if (!$this->agree)
				$this->addError('agree',
				'Вы должны согласиться с условиями пользовательского соглашения.');
	}

}