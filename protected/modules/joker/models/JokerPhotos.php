<?php

/**
 * This is the model class for table "photos".
 *
 * The followings are the available columns in table 'photos':
 * @property string $id
 * @property string $vehicle_id
 * @property string $size_small
 * @property string $size_middle
 * @property string $size_big
 * @property string $size_superbig
 */
class Photos extends CActiveRecord
{
	const MAX_UPLOAD_FILES = 1;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Photos the static model class
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
		return 'photos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('vehicle_id', 'required'),
			array('vehicle_id', 'length', 'max'=>20),
			array('size_small, size_middle, size_big, size_superbig', 'length', 'max'=>32),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, vehicle_id, size_small, size_middle, size_big, size_superbig', 'safe', 'on'=>'search'),
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
			'vehicle' => array(self::BELONGS_TO, 'Vehicle', 'vehicle_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'vehicle_id' => 'Vehicle',
			'size_small' => 'Size 37x36',
			'size_middle' => 'Size 80x80',
			'size_big' => 'Size 500x250',
			'size_superbig' => 'Size 800x600',
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
		$criteria->compare('vehicle_id',$this->vehicle_id,true);
		$criteria->compare('size_small',$this->size_37x36,true);
		$criteria->compare('size_middle',$this->size_80x80,true);
		$criteria->compare('size_big',$this->size_500x250,true);
		$criteria->compare('size_superbig',$this->size_800x600,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function afterDelete()
	{
		parent::afterDelete();

		if (file_exists(Yii::app()->params['files']['photos'] . $this->size_big))
			unlink (Yii::app()->params['files']['photos'] . $this->size_big);
		if (file_exists(Yii::app()->params['files']['photos'] . $this->size_middle))
			unlink (Yii::app()->params['files']['photos'] . $this->size_middle);
		if (file_exists(Yii::app()->params['files']['photos'] . $this->size_small))
			unlink (Yii::app()->params['files']['photos'] . $this->size_small);
		if (file_exists(Yii::app()->params['files']['photos'] . $this->size_superbig))
			unlink (Yii::app()->params['files']['photos'] . $this->size_superbig);
	}
}