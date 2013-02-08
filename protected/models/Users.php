<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property string $id
 * @property string $email
 * @property string $username
 * @property string $password
 * @property string $logins
 * @property string $last_login
 * @property string $code
 * @property string $enabled
 * @property integer $balance
 *
 * The followings are the available model relations:
 * @property Organizations[] $organizations
 * @property Profiles[] $profiles
 * @property VehicleFerrymans[] $vehicleFerrymans
 */
class Users extends CActiveRecord
{
	// Сценарий регистрации

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
	private $_identity;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Users the static model class
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
		return 'users';
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
			array('oldPassword, newPassword, newPasswordRepeat', 'length', 'min' => 6, 'max' => 30, 'on' => self::SCENARIO_CHANGE_PASSWORD),
			array('oldPassword', 'changePassword', 'on' => self::SCENARIO_CHANGE_PASSWORD),
			array('oldPassword, newPassword, newPasswordRepeat', 'required', 'on' => self::SCENARIO_CHANGE_PASSWORD),
			array('newPasswordRepeat', 'compare', 'compareAttribute' => 'newPassword', 'on' => self::SCENARIO_CHANGE_PASSWORD),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, email, username, password, logins, last_login, code, enabled, balance', 'safe', 'on' => 'search'),
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
			'organizations' => array(self::HAS_ONE, 'Organizations', 'user_id'),
			'profiles' => array(self::HAS_ONE, 'Profiles', 'user_id'),
			'vehicles' => array(self::HAS_MANY, 'Vehicle', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'email' => 'Элетронный адрес',
			'username' => 'Логин',
			'password' => 'Пароль',
			'password_repeat' => 'Повторите пароль',
			'logins' => 'Количество входов',
			'last_login' => 'Последний раз входил',
			'enabled' => 'Проверенный',
			'rememberMe' => 'Запомнить',
			'balance' => 'Баланс',
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
		$criteria->compare('username', $this->username, true);
		$criteria->compare('password', $this->password, true);
		$criteria->compare('enabled', $this->enabled, true);

		return new CActiveDataProvider($this, array(
					'criteria' => $criteria,
				));
	}

	// Метод, который будет вызываться до сохранения данных в БД
//    protected function beforeSave()
//    {
//         if(parent::beforeSave())
//         {
//            if($this->isNewRecord)
//            {
//                // Хешировать пароль
//                $this->password = $this->hashPassword($this->password);
//            }
//
//            return true;
//         }
//
//        return false;
//    }
//
//    public function hashPassword($password)
//    {
//        return md5($password);
//    }

	/**
	 * Authenticates the password.
	 * This is the 'authenticate' validator as declared in rules().
	 */
	public function authenticate($attribute, $params)
	{
		if (!$this->hasErrors())
		{
			$this->_identity = new UserIdentity($this->email, $this->password);
			if (!$this->_identity->authenticate())
					$this->addError('email', 'Неправильно введены Электронный адрес или Пароль');
		}
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
			if (!$this->find('email = "' . Yii::app()->user->email . '" AND password = "' . md5($this->oldPassword) . '"'))
					$this->addError('oldPassword', 'Вы неправильно ввели текущий пароль.');
		}
	}

	public function mustCheck($attribute, $params)
	{
		if (!$this->agree)
				$this->addError('agree',
					'Вы должны согласиться с условиями пользовательского соглашения.');
	}

	/**
	 * Logs in the user using the given username and password in the model.
	 * @return boolean whether login is successful
	 */
	public function login()
	{
		if ($this->_identity === null)
		{
			$this->_identity = new UserIdentity($this->email, $this->password);
			$this->_identity->authenticate();
		}
		if ($this->_identity->errorCode === UserIdentity::ERROR_NONE)
		{
			$duration = $this->rememberMe ? 3600 * 24 * 30 : 0; // 30 days
			Yii::app()->user->login($this->_identity, $duration);
			return true;
		}
		else return false;
	}

	public function loginByCode($code)
	{
		if ($this->_identity === null)
		{
			$this->_identity = new UserIdentity($this->email, $this->password);
			$this->_identity->code = $code;
			$this->_identity->authenticateByCode();
		}
		if ($this->_identity->errorCode === UserIdentity::ERROR_NONE)
		{
			$duration = $this->rememberMe ? 3600 * 24 * 30 : 0; // 30 days
			Yii::app()->user->login($this->_identity, $duration);
			return true;
		}
		else return false;
	}

}