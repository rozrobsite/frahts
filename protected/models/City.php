<?php

/**
 * This is the model class for table "city".
 *
 * The followings are the available columns in table 'city':
 * @property ineger $id
 * @property string $country_id
 * @property string $region_id
 * @property string $name_ru
 * @property integer $latitude
 * @property integer $longitude
 *
 * The followings are the available model relations:
 * @property Country $country
 * @property Region $region
 * @property Profiles[] $profiles
 */
class City extends CActiveRecord
{
	public $maxid;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return City the static model class
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
		return 'city';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('country_id', 'length', 'max'=>11),
			array('region_id', 'length', 'max'=>10),
			array('name_ru', 'length', 'max'=>128),
			array('latitude,longitude', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, country_id, region_id, name_ru,latitude,longitude', 'safe', 'on'=>'search'),
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
			'country' => array(self::BELONGS_TO, 'Country', 'country_id'),
			'region' => array(self::BELONGS_TO, 'Region', 'region_id'),
			'profiles' => array(self::HAS_MANY, 'Profiles', 'city_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'country_id' => 'Страна',
			'region_id' => 'Регион',
			'name_ru' => 'Название',
			'latitude' => 'Широта (latitude)',
			'longitude' => 'Долгота (longitude)',
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
		$criteria->compare('country_id',$this->country_id,true);
		$criteria->compare('region_id',$this->region_id,true);
		$criteria->compare('name_ru',$this->name_ru,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
				'pageSize'=>15,
			),
		));
	}
}