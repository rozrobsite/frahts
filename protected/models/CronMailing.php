<?php

/**
 * This is the model class for table "cron_mailing".
 *
 * The followings are the available columns in table 'cron_mailing':
 * @property integer $id
 * @property integer $last_id
 */
class CronMailing extends CActiveRecord
{
	const UPDATE_VEHICLE = 1;

	const MAX_EMAIL_PER_CONNECTION = 18;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CronMailing the static model class
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
		return 'cron_mailing';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, last_id', 'required'),
			array('id, last_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, last_id', 'safe', 'on'=>'search'),
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
			'last_id' => 'Last',
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
		$criteria->compare('last_id',$this->last_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}