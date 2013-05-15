<?php

/**
 * This is the model class for table "marka".
 *
 * The followings are the available columns in table 'marka':
 * @property integer $id
 * @property integer $cat_id
 * @property string $name
 * @property integer $marka_id
 *
 * The followings are the available model relations:
 * @property Categories $cat
 * @property MarkaCategories[] $markaCategories
 * @property Model[] $models
 * @property ModelMarkaCategories[] $modelMarkaCategories
 */
class Marka extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Marka the static model class
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
		return 'marka';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cat_id, name, marka_id', 'required'),
			array('cat_id, marka_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, cat_id, name, marka_id', 'safe', 'on'=>'search'),
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
			'cat' => array(self::BELONGS_TO, 'Categories', 'cat_id'),
			'markaCategories' => array(self::HAS_MANY, 'MarkaCategories', 'marka_id'),
			'models' => array(self::HAS_MANY, 'Modeli', 'marka_id'),
			'modelMarkaCategories' => array(self::HAS_MANY, 'ModelMarkaCategories', 'marka_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'cat_id' => 'Cat',
			'name' => 'Name',
			'marka_id' => 'Marka',
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
		$criteria->compare('cat_id',$this->cat_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('marka_id',$this->marka_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function getAll()
	{
		$criteria = new CDbCriteria();
		$criteria->condition = 'cat_id > ' . Categories::START_BIG_VEHICLES;
		$criteria->order = 'cat.order_by, t.name';
		$criteria->with = array('cat');

		return $this->findAll($criteria);
	}
}