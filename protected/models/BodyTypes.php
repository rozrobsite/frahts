<?php

/**
 * This is the model class for table "body_types".
 *
 * The followings are the available columns in table 'body_types':
 * @property integer $id
 * @property integer $vehicle_type_id
 * @property string $name_ru
 * @property string $name_ua
 * @property integer $order_by
 *
 * The followings are the available model relations:
 * @property VehicleTypes $vehicleType
 * @property VehicleFerrymans[] $vehicleFerrymans
 */
class BodyTypes extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return BodyTypes the static model class
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
		return 'body_types';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('vehicle_type_id, name_ru, name_ua', 'required'),
			array('vehicle_type_id', 'numerical', 'integerOnly'=>true),
			array('name_ru, name_ua', 'length', 'max'=>64),
			array('order_by', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, vehicle_type_id, name_ru, name_ua, order_by', 'safe', 'on'=>'search'),
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
			'vehicleFerrymans' => array(self::HAS_MANY, 'VehicleFerrymans', 'body_type_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'vehicle_type_id' => 'Vehicle Type',
			'name_ru' => 'Name Ru',
			'name_ua' => 'Name Ua',
			'order_by' => 'Порядок сортировки',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('vehicle_type_id',$this->vehicle_type_id);
		$criteria->compare('name_ru',$this->name_ru,true);
		$criteria->compare('name_ua',$this->name_ua,true);
		$criteria->compare('order_by',$this->order_by,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}