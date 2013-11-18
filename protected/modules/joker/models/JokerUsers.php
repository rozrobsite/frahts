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
 */
class JokerUsers extends ActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return JokerUsers the static model class
	 */
	public static function model($className=__CLASS__)
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
			array('email, password', 'required'),
			array('enabled', 'numerical', 'integerOnly'=>true),
			array('email', 'length', 'max'=>254),
			array('password', 'length', 'max'=>64),
			array('password', 'authenticate'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, email, password, logins, last_login, enabled', 'safe', 'on'=>'search'),
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

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('logins',$this->logins,true);
		$criteria->compare('last_login',$this->last_login,true);
		$criteria->compare('enabled',$this->enabled);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function authenticate($attribute, $params)
	{
		if (!$this->hasErrors())
		{
			$user = $this->login();
			
			if (!$user)
					$this->addError('email', 'Неправильно введены Email или Пароль');
		}
	}
	
	public function login()
	{
		$result = $this->find('email = "' . trim($this->email) . '" AND password = "' . md5($this->password) . '"');
		
		if ($result && $result->enabled)
		{
			Yii::app()->session['joker_id'] = (int) $result->id;
			Yii::app()->session['joker_email'] = $result->email;
			
			$result->last_login = time();
			$result->logins = $result->logins++;
			$result->update();
		}
		else
		{
			if (!$result->enabled)
				$this->addError('email', 'Вам заблокирован доступ на сайт. Свяжитесь с Администрацией сайта для консультирования.');
			else
				$this->addError('email', 'Неправильно введены Email или Пароль');
		}
		
		return $result;
	}
}