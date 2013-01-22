<?php

/**
 * This is the model class for table "vehicle_ferrymans".
 *
 * The followings are the available columns in table 'vehicle_ferrymans':
 * @property string $id
 * @property string $user_id
 * @property integer $make_id
 * @property integer $vehicle_type_id
 * @property integer $model_id
 * @property integer $body_type_id
 * @property integer $bearing_capacity
 * @property integer $body_capacity
 * @property string $kind_boot
 * @property string $permission
 *
 * The followings are the available model relations:
 * @property VehicleTypes $vehicleType
 * @property Models $model
 * @property Users $user
 * @property BodyTypes $bodyType
 * @property Makes $make
 */
class VehicleFerrymans extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return VehicleFerrymans the static model class
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
		return 'vehicle_ferrymans';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, make_id, vehicle_type_id, model_id, body_type_id, bearing_capacity, body_capacity, kind_boot, permission', 'required'),
			array('make_id, vehicle_type_id, model_id, body_type_id, bearing_capacity, body_capacity', 'numerical', 'integerOnly'=>true),
			array('user_id', 'length', 'max'=>11),
			array('kind_boot, permission', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, make_id, vehicle_type_id, model_id, body_type_id, bearing_capacity, body_capacity, kind_boot, permission', 'safe', 'on'=>'search'),
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
			'vehicleType' => array(self::BELONGS_TO, 'VehicleTypes', 'vehicle_type_id'),
			'model' => array(self::BELONGS_TO, 'Models', 'model_id'),
			'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
			'bodyType' => array(self::BELONGS_TO, 'BodyTypes', 'body_type_id'),
			'make' => array(self::BELONGS_TO, 'Makes', 'make_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => 'User',
			'make_id' => 'Make',
			'vehicle_type_id' => 'Vehicle Type',
			'model_id' => 'Model',
			'body_type_id' => 'Body Type',
			'bearing_capacity' => 'Bearing Capacity',
			'body_capacity' => 'Body Capacity',
			'kind_boot' => 'Kind Boot',
			'permission' => 'Permission',
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
		$criteria->compare('kind_boot',$this->kind_boot,true);
		$criteria->compare('permission',$this->permission,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}