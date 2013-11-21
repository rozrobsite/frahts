<?php

/**
 * This is the model class for table "joker_organizations".
 *
 * The followings are the available columns in table 'joker_organizations':
 * @property string $id
 * @property string $user_id
 * @property string $name
 * @property string $description
 * @property integer $business_type_id
 * @property string $country_id
 * @property string $region_id
 * @property string $city_id
 * @property string $address
 * @property string $mobile
 * @property string $phone
 * @property string $email
 * @property string $skype
 * @property string $site
 * @property double $discount
 * @property double $latitude
 * @property double $longitude
 * @property string $logo
 *
 * The followings are the available model relations:
 * @property JokerBusinessType $businessType
 * @property City $city
 * @property Country $country
 * @property Region $region
 * @property JokerUsers $user
 * @property JokerVendibles[] $jokerVendibles
 */
class JokerOrganizations extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return JokerOrganizations the static model class
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
		return 'joker_organizations';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, name, description, address, mobile, latitude, longitude', 'required'),
			array('business_type_id', 'numerical', 'integerOnly'=>true),
			array('discount, latitude, longitude', 'numerical'),
			array('user_id', 'length', 'max'=>20),
			array('name, email, site', 'length', 'max'=>254),
			array('country_id, region_id', 'length', 'max'=>10),
			array('city_id', 'length', 'max'=>11),
			array('address', 'length', 'max'=>128),
			array('mobile', 'length', 'max'=>15),
			array('phone, skype', 'length', 'max'=>25),
			array('logo', 'length', 'max'=>24),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, name, description, business_type_id, country_id, region_id, city_id, address, mobile, phone, email, skype, site, discount, latitude, longitude, logo', 'safe', 'on'=>'search'),
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
			'businessType' => array(self::BELONGS_TO, 'JokerBusinessType', 'business_type_id'),
			'city' => array(self::BELONGS_TO, 'City', 'city_id'),
			'country' => array(self::BELONGS_TO, 'Country', 'country_id'),
			'region' => array(self::BELONGS_TO, 'Region', 'region_id'),
			'user' => array(self::BELONGS_TO, 'JokerUsers', 'user_id'),
			'vendibles' => array(self::HAS_MANY, 'JokerVendibles', 'organization_id'),
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
			'name' => 'Название',
			'description' => 'Описание',
			'business_type_id' => 'Вид деятельности',
			'country_id' => 'Страна',
			'region_id' => 'Регион',
			'city_id' => 'Населенный пункт',
			'address' => 'Адрес',
			'mobile' => 'Телефон мобильный',
			'phone' => 'Телефон/Факс',
			'email' => 'Элетронный адрес (E-mail)',
			'skype' => 'Skype',
			'site' => 'Сайт',
			'discount' => 'Скидка',
			'latitude' => 'Широта',
			'longitude' => 'Долгота',
			'logo' => 'Логотип',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('business_type_id',$this->business_type_id);
		$criteria->compare('country_id',$this->country_id,true);
		$criteria->compare('region_id',$this->region_id,true);
		$criteria->compare('city_id',$this->city_id,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('mobile',$this->mobile,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('skype',$this->skype,true);
		$criteria->compare('site',$this->site,true);
		$criteria->compare('discount',$this->discount);
		$criteria->compare('latitude',$this->latitude);
		$criteria->compare('longitude',$this->longitude);
		$criteria->compare('logo',$this->logo,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}