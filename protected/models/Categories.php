<?php

/**
 * This is the model class for table "categories".
 *
 * The followings are the available columns in table 'categories':
 * @property string $name
 * @property integer $id
 * @property integer $order_by
 *
 * The followings are the available model relations:
 * @property Marka[] $markas
 * @property MarkaCategories[] $markaCategories
 * @property Model[] $models
 * @property ModelMarkaCategories[] $modelMarkaCategories
 */
class Categories extends CActiveRecord
{
	const START_BIG_VEHICLES = 4;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Categories the static model class
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
		return 'categories';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required'),
			array('name', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('name, id', 'safe', 'on'=>'search'),
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
			'markas' => array(self::HAS_MANY, 'Marka', 'cat_id'),
			'markaCategories' => array(self::HAS_MANY, 'MarkaCategories', 'cat_id'),
			'models' => array(self::HAS_MANY, 'Modeli', 'cat_id'),
			'modelMarkaCategories' => array(self::HAS_MANY, 'ModelMarkaCategories', 'cat_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'name' => 'Name',
			'id' => 'ID',
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

		$criteria->compare('name',$this->name,true);
		$criteria->compare('id',$this->id);
		$criteria->compare('order_by',$this->order_by);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function getAll()
	{
		$criteria = new CDbCriteria();
		$criteria->condition = 'id > ' . Categories::START_BIG_VEHICLES;
		$criteria->order = 'order_by';

		return $this->findAll($criteria);
	}
}