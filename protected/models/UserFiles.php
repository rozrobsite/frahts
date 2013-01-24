<?php

/**
 * This is the model class for table "user_files".
 *
 * The followings are the available columns in table 'user_files':
 * @property string $id
 * @property string $user_id
 * @property string $description
 * @property string $name
 * @property integer $file_type_id
 *
 * The followings are the available model relations:
 * @property Organizations[] $organizations
 * @property Organizations[] $organizations1
 */
class UserFiles extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UserFiles the static model class
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
		return 'user_files';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, file_type_id', 'required'),
			array('file_type_id', 'numerical', 'integerOnly'=>true),
			array('user_id', 'length', 'max'=>11),
			array('description, name', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, description, name, file_type_id', 'safe', 'on'=>'search'),
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
			'organizations' => array(self::HAS_MANY, 'Organizations', 'file_reg_id'),
			'organizations1' => array(self::HAS_MANY, 'Organizations', 'file_tax_id'),
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
			'description' => 'Description',
			'name' => 'Name',
			'file_type_id' => 'File Type',
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
		$criteria->compare('description',$this->description,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('file_type_id',$this->file_type_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}