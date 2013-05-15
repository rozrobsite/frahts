<?php

/**
 * This is the model class for table "organizations".
 *
 * The followings are the available columns in table 'organizations':
 * @property integer $id
 * @property integer $type_org_id
 * @property string $form_tax
 * @property integer $form_org_id
 * @property string $name_org
 * @property string $license
 * @property string $user_id
 * @property string $address
 * @property string $account_number
 * @property string $edrpou
 * @property string $bank
 * @property string $city
 * @property string $mfo
 * @property string $inn
 * @property string $certificate
 * @property string $phone
 *
 * The followings are the available model relations:
 * @property TypeOrganizations $typeOrg
 * @property Users $user
 */
class Organizations extends CActiveRecord
{
	const TYPE_PRIVATE = 1;
	const TYPE_CORPORATE = 2;
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
			array('form_tax, form_org_id, name_org', 'required'),
			array('type_org_id, form_org_id', 'numerical', 'integerOnly'=>true),
			array('form_tax, name_org, license, phone', 'length', 'max'=>255),
			array('user_id', 'length', 'max'=>11),
			array('address', 'length', 'max'=>128),
			array('account_number', 'length', 'max'=>64),
			array('edrpou, bank, city, mfo, inn, certificate', 'length', 'max'=>32),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, type_org_id, form_tax, name_org, license, user_id, address, account_number, edrpou, bank, city, mfo, inn, certificate, phone', 'safe', 'on'=>'search'),
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
			'typeOrg' => array(self::BELONGS_TO, 'TypeOrganizations', 'type_org_id'),
			'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
			'formOrganizations' => array(self::BELONGS_TO, 'FormOrganizations', 'form_org_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'type_org_id' => 'Type Org',
			'form_tax' => 'Form Tax',
			'form_org_id' => 'Форма организация',
			'name_org' => 'Name Org',
			'license' => 'License',
			'user_id' => 'User',
			'address' => 'Address',
			'account_number' => 'Account Number',
			'edrpou' => 'Edrpou',
			'bank' => 'Bank',
			'city' => 'City',
			'mfo' => 'Mfo',
			'inn' => 'ИНН',
			'certificate' => 'Certificate',
			'phone' => 'Phone',
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
		$criteria->compare('form_org_id',$this->form_org_id);
		$criteria->compare('name_org',$this->name_org,true);
		$criteria->compare('license',$this->license,true);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('account_number',$this->account_number,true);
		$criteria->compare('edrpou',$this->edrpou,true);
		$criteria->compare('bank',$this->bank,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('mfo',$this->mfo,true);
		$criteria->compare('inn',$this->inn,true);
		$criteria->compare('certificate',$this->certificate,true);
		$criteria->compare('phone',$this->phone,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}