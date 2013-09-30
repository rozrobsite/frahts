<?php

/**
 * This is the model class for table "profiles".
 *
 * The followings are the available columns in table 'profiles':
 * @property string $id
 * @property string $user_id
 * @property string $last_name
 * @property string $first_name
 * @property string $middle_name
 * @property string $mobile
 * @property string $country_id
 * @property string $region_id
 * @property string $city_id
 * @property string $address
 * @property string $phone
 * @property string $skype
 * @property string $icq
 * @property integer $rating
 * @property integer $user_type_id
 * @property integer $created_at
 * @property integer $updated_at
 *
 * The followings are the available model relations:
 * @property City $city
 * @property Users $user
 * @property UserTypes $userType
 * @property Country $country
 * @property Region $region
 */
class Profiles extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Profiles the static model class
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
		return 'profiles';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('last_name, first_name, middle_name, mobile, country_id, region_id, city_id, address, user_type_id', 'required'),
			array('user_type_id, country_id, region_id, city_id, created_at, updated_at', 'numerical', 'integerOnly'=>true),
			array('user_id, country_id, region_id, city_id', 'length', 'max'=>11),
			array('last_name', 'length', 'max'=>64),
			array('middle_name', 'length', 'max'=>20),
			array('first_name, icq', 'length', 'max'=>12),
			array('first_name, last_name, middle_name', 'match', 'pattern'=>'/^[A-Za-zА-Яа-яёЁєЄїЇіІ]+$/u', 'message'=>'Должны быть только буквы.'),
			array('mobile', 'length', 'max'=>15),
			array('address', 'length', 'max'=>128),
			array('phone, skype', 'length', 'max'=>25),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, last_name, first_name, middle_name, mobile, country_id, region_id, city_id, address, phone, skype, icq, rating, user_type_id', 'safe', 'on'=>'search'),
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
			'city' => array(self::BELONGS_TO, 'City', 'city_id'),
			'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
			'userType' => array(self::BELONGS_TO, 'UserTypes', 'user_type_id'),
			'country' => array(self::BELONGS_TO, 'Country', 'country_id'),
			'region' => array(self::BELONGS_TO, 'Region', 'region_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => 'Пользователь',
			'last_name' => 'Фамилия',
			'first_name' => 'Имя',
			'middle_name' => 'Отчество',
			'mobile' => 'Телефон мобильный',
			'country_id' => 'Страна',
			'region_id' => 'Регион',
			'city_id' => 'Населенный пункт',
			'address' => 'Адрес',
			'phone' => 'Телефон/Факс',
			'skype' => 'Скайп (Skype)',
			'icq' => 'Icq',
			'rating' => 'Рейтинг',
			'user_type_id' => 'Вид деятельности',
			'created_at' => 'Дата регистрации',
			'updated_at' => 'Дата обновления',
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
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('last_name',$this->last_name,true);
		$criteria->compare('first_name',$this->first_name,true);
		$criteria->compare('middle_name',$this->middle_name,true);
		$criteria->compare('mobile',$this->mobile,true);
		$criteria->compare('country_id',$this->country_id,true);
		$criteria->compare('region_id',$this->region_id,true);
		$criteria->compare('city_id',$this->city_id,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('skype',$this->skype,true);
		$criteria->compare('icq',$this->icq,true);
		$criteria->compare('rating',$this->rating);
		$criteria->compare('user_type_id',$this->user_type_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function fullName()
	{
		return $this->last_name . ' ' . $this->first_name . ' ' . $this->middle_name;
	}

	public function shortName()
	{
		return $this->first_name . ' ' . $this->last_name;
	}

	public function searchUsers($currentUser, $searchText)
	{
		$criteria = new CDbCriteria();

		if (!empty($searchText))
		{
//			$searchArray = explode(' ', $searchText);
			$criteria->condition = 'user_id <> ' . $currentUser->id . ' AND (first_name LIKE "%' . $searchText . '%" OR last_name LIKE "%' . $searchText . '%")';
		}

		$profiles = $this->findAll($criteria);

		$result = array();
		foreach($profiles as $profile)
		{
			$result[] = $profile->user;
		}

		return $result;
	}

	public function getUsers($currentUser)
	{
		$criteria = new CDbCriteria();
		$criteria->condition = 'user_id <> ' . $currentUser->id;
		$criteria->order = 'created_at DESC, user_id DESC';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function locationString()
	{
		return $this->country->name_ru . ', ' . $this->region->name_ru . ', ' . $this->city->name_ru;
	}

	public function shortLocationString()
	{
		return $this->country->name_ru . ', ' . $this->city->name_ru;
	}
}