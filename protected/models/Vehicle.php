<?php

/**
 * This is the model class for table "vehicle".
 *
 * The followings are the available columns in table 'vehicle':
 * @property string $id
 * @property string $user_id
 * @property integer $make_id
 * @property integer $vehicle_type_id
 * @property integer $model_id
 * @property integer $body_type_id
 * @property float $bearing_capacity
 * @property integer $body_capacity
 * @property string $license_plate
 * @property string $number_trailer
 * @property string $number_semitrailer
 * @property integer $is_deleted
 * @property integer $is_verification
 *
 * The followings are the available model relations:
 * @property BodyTypes $bodyType
 * @property Makes $make
 * @property Users $user
 * @property VehicleTypes $vehicleType
 * @property Models $model
 * @property string $permissions
 * @property string $shipments
 */
class Vehicle extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Vehicle the static model class
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
		return 'vehicle';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('make_id, vehicle_type_id, model_id, body_type_id, bearing_capacity, body_capacity, license_plate', 'required'),
			array('make_id, vehicle_type_id, model_id, body_type_id, body_capacity', 'numerical', 'integerOnly'=>true),
			array('user_id', 'length', 'max'=>11),
			array('bearing_capacity', 'numerical', 'min'=>0.5),
			array('body_capacity', 'numerical', 'min'=>1),
			array('license_plate, number_trailer, number_semitrailer', 'length', 'max'=>32),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, make_id, vehicle_type_id, model_id, body_type_id, bearing_capacity, body_capacity, license_plate, number_trailer, number_semitrailer, is_deleted, is_verification', 'safe', 'on'=>'search'),
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
			'bodyType' => array(self::BELONGS_TO, 'BodyTypes', 'body_type_id'),
			'make' => array(self::BELONGS_TO, 'Makes', 'make_id'),
			'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
			'vehicleType' => array(self::BELONGS_TO, 'VehicleTypes', 'vehicle_type_id'),
			'model' => array(self::BELONGS_TO, 'Models', 'model_id'),
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
			'make_id' => 'Марка',
			'vehicle_type_id' => 'Тип транспорта',
			'model_id' => 'Модель',
			'body_type_id' => 'Тип кузова',
			'bearing_capacity' => 'Грузоподъемность',
			'body_capacity' => 'Объем кузова',
			'license_plate' => 'Номер транспорта',
			'number_trailer' => 'Номер прицепа',
			'number_semitrailer' => 'Номер полуприцепа',
			'is_deleted' => 'Удалено из поиска',
			'is_verification' => 'Проверено',
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
		$criteria->compare('make_id',$this->make_id);
		$criteria->compare('vehicle_type_id',$this->vehicle_type_id);
		$criteria->compare('model_id',$this->model_id);
		$criteria->compare('body_type_id',$this->body_type_id);
		$criteria->compare('bearing_capacity',$this->bearing_capacity);
		$criteria->compare('body_capacity',$this->body_capacity);
		$criteria->compare('license_plate',$this->license_plate,true);
		$criteria->compare('number_trailer',$this->number_trailer,true);
		$criteria->compare('number_semitrailer',$this->number_semitrailer,true);
		$criteria->compare('is_deleted',$this->is_deleted);
		$criteria->compare('is_verification',$this->is_verification);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function findAllByDeleted($user_id, $is_deleted = true)
	{
		$condition = $is_deleted ? 'is_deleted = 1' : 'is_deleted = 0';
		$condition .= ' AND user_id = ' . $user_id;
		
		return $this->findAll($condition);
	}
	
	public function deleteFromSearch($is_deleted)
	{
		$this->is_deleted = $is_deleted ? 1 : 0;
		return $this->update(array('is_deleted'));
	}
}