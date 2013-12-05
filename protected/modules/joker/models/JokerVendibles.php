<?php

/**
 * This is the model class for table "joker_vendibles".
 *
 * The followings are the available columns in table 'joker_vendibles':
 * @property integer $id
 * @property string $organization_id
 * @property string $name
 * @property string $description
 * @property double $cost
 * @property double $discount
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $currency_id
 *
 * The followings are the available model relations:
 * @property JokerOrganizations $organization
 */
class JokerVendibles extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return JokerVendibles the static model class
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
		return 'joker_vendibles';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('organization_id, name, description, cost', 'required'),
			array('created_at, updated_at, currency_id', 'numerical', 'integerOnly'=>true),
			array('cost, discount', 'numerical'),
			array('organization_id', 'length', 'max'=>20),
			array('name, description', 'length', 'max'=>254),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, organization_id, name, description, cost, discount, created_at, updated_at, currency_id', 'safe', 'on'=>'search'),
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
			'currency' => array(self::BELONGS_TO, 'JokerCurrency', 'currency_id'),
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
			'name' => 'Наименование',
			'description' => 'Краткое описание',
			'cost' => 'Цена',
			'discount' => 'Скидка',
			'created_at' => 'Добавлен',
			'updated_at' => 'Обновлен',
			'currency_id' => 'Валюта',
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
		$criteria->compare('organization_id',$this->organization_id,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('cost',$this->cost);
		$criteria->compare('discount',$this->discount);
		$criteria->compare('created_at',$this->created_at);
		$criteria->compare('updated_at',$this->updated_at);
		$criteria->compare('currency',$this->currency_id);

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