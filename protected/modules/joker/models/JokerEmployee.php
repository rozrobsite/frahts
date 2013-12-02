<?php

/**
 * This is the model class for table "joker_employee".
 *
 * The followings are the available columns in table 'joker_employee':
 * @property string $id
 * @property string $organization_id
 * @property string $position
 * @property string $fio
 * @property string $mobile
 * @property string $email
 * @property integer $created_at
 * @property integer $updated_at
 *
 * The followings are the available model relations:
 * @property JokerOrganizations $organization
 */
class JokerEmployee extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return JokerEmployee the static model class
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
		return 'joker_employee';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('position, fio, mobile, email', 'required'),
			array('organization_id', 'length', 'max'=>20),
			array('position, fio, email', 'length', 'max'=>254),
			array('mobile', 'length', 'max'=>15),
			array('mobile', 'length', 'min'=>10),
			array('mobile', 'match', 'pattern'=>'/^[0-9]+$/u', 'message'=>'Должны быть только цифры'),
			array('email', 'email', 'message' => 'Неправильный E-mail адрес'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, organization_id, position, fio, mobile, email', 'safe', 'on'=>'search'),
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
			'organization' => array(self::BELONGS_TO, 'JokerOrganizations', 'organization_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'organization_id' => 'Организация',
			'position' => 'Должность(отдел)',
			'fio' => 'ФИО',
			'mobile' => 'Телефон мобильный',
			'email' => 'Электронный алрес (E-mail)',
			'created_at' => 'Дата добавления',
			'updated_at' => 'Дата обновления',
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
		$criteria->compare('organization_id',$this->organization_id,true);
		$criteria->compare('position',$this->position,true);
		$criteria->compare('fio',$this->fio,true);
		$criteria->compare('mobile',$this->mobile,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('updated-at',$this->updated_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function prepare($data)
    {
        foreach ($data as $attribute => $item) {
            if ($attribute == 'id') continue;

            $this->{$attribute} = $item;

            if ($this->created_at) {
                $this->updated_at = time();
            } else {
                $this->created_at = time();
            }
        }
    }
}