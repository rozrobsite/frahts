<?php

/**
 * This is the model class for table "joker_profiles".
 *
 * The followings are the available columns in table 'joker_profiles':
 * @property string $id
 * @property string $user_id
 * @property string $last_name
 * @property string $first_name
 * @property string $middle_name
 * @property string $mobile
 * @property string $phone
 * @property string $skype
 * @property string $icq
 * @property int $created_at
 *
 * The followings are the available model relations:
 * @property JokerUsers $user
 */
class JokerProfiles extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return JokerProfiles the static model class
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
		return 'joker_profiles';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, last_name, first_name, mobile', 'required'),
			array('user_id', 'length', 'max'=>20),
			array('last_name, middle_name', 'length', 'max'=>64),
			array('first_name, icq', 'length', 'max'=>32),
			array('mobile', 'length', 'max'=>15),
			array('phone, skype', 'length', 'max'=>25),
			array('first_name, last_name, middle_name', 'match', 'pattern'=>'/^[A-Za-zА-Яа-яёЁєЄїЇіІ]+$/u', 'message'=>'Должны быть только буквы.'),
			array('mobile', 'match', 'pattern'=>'/^[0-9]+$/u', 'message'=>'Должны быть только цифры.'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, last_name, first_name, middle_name, mobile, phone, skype, icq', 'safe', 'on'=>'search'),
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
			'jokerUser' => array(self::BELONGS_TO, 'JokerUsers', 'user_id'),
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
			'last_name' => 'Фамилия',
			'first_name' => 'Имя',
			'middle_name' => 'Отчество',
			'mobile' => 'Телефон мобильный',
			'phone' => 'Телефон/Факс',
			'skype' => 'Skype',
			'icq' => 'Icq',
			'created_at' => 'Дата регистрации',
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
		$criteria->compare('last_name',$this->last_name,true);
		$criteria->compare('first_name',$this->first_name,true);
		$criteria->compare('middle_name',$this->middle_name,true);
		$criteria->compare('mobile',$this->mobile,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('skype',$this->skype,true);
		$criteria->compare('icq',$this->icq,true);
		$criteria->compare('created_at',$this->icq,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function fullName()
	{
		$fullName = $this->last_name . ' ' . $this->first_name;
		
		if ($this->middle_name)
			$fullName .= ' ' . $this->middle_name;
		return ;
	}

	public function shortName()
	{
		return $this->first_name . ' ' . $this->last_name;
	}
}