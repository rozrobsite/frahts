<?php

/**
 * This is the model class for table "organizations".
 *
 * The followings are the available columns in table 'organizations':
 * @property integer $id
 * @property integer $type_org_id
 * @property string $form_tax
 * @property string $name_org
 * @property string $license
 * @property string $user_id
 * @property integer $scan_form_registration
 * @property integer $scan_form_tax
 * @property integer $scan_license
 *
 * The followings are the available model relations:
 * @property Users $user
 * @property TypeOrganizations $typeOrg
 */
class Organizations extends CActiveRecord
{
	public $file1;
	public $file2;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Organizations the static model class
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
		return 'organizations';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('type_org_id, form_tax, file1, file2', 'required'),
			array('type_org_id', 'numerical', 'integerOnly'=>true),
			array('form_tax, name_org, license', 'length', 'max'=>255),
			array('file1, file2', 'file', 'maxSize'=>1024 * 1024 * 3),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, type_org_id, form_tax, name_org, user_id, scan_form_registration, scan_form_tax', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
			'typeOrg' => array(self::BELONGS_TO, 'TypeOrganizations', 'type_org_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'type_org_id' => '"Форма организации"',
			'form_tax' => '"Форма налогообложения"',
			'name_org' => '"Название организации"',
			'user_id' => 'Пользователь',
			'scan_form_registration' => '"Скан формы организации"',
			'scan_form_tax' => '"Скан формы налогообложения"',
			'license' => '"Лицензия"',
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
		$criteria->compare('type_org_id',$this->type_org_id);
		$criteria->compare('form_tax',$this->form_tax,true);
		$criteria->compare('name_org',$this->name_org,true);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('scan_form_registration',$this->scan_form_registration);
		$criteria->compare('scan_form_tax',$this->scan_form_tax);
		$criteria->compare('lincense',$this->license);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}