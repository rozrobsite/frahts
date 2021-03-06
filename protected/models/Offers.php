<?php

/**
 * This is the model class for table "offers".
 *
 * The followings are the available columns in table 'offers':
 * @property string $id
 * @property string $author_id
 * @property string $receiving_user_id
 * @property string $good_id
 * @property string $vehicle_id
 * @property integer $created_at
 * @property integer $result
 * @property integer $result_date_at
 * @property integer $cost
 * @property integer $currency_id
 * @property integer $offer_vehicle_id
 * @property integer $offer_good_id
 *
 * The followings are the available model relations:
 * @property Vehicle $vehicle
 * @property Users $author
 * @property Users $receivingUser
 * @property Goods $good
 * @property Currency $currency
 * @property Vehicle $offerVehicle
 * @property Goods $offerGood
 */
class Offers extends CActiveRecord
{
	const TYPE_GOOD = 1;
	const TYPE_VEHICLE = 2;
	const RESULT_IN_PROCESS = 1;
	const RESULT_IN_ACCEPT = 2;
	const RESULT_IN_REFUSE = 3;
	const OFFER_TYPE_USERS = 1;
	const OFFER_TYPE_FOR_USERS = 2;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Offers the static model class
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
		return 'offers';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('author_id, receiving_user_id, created_at', 'required'),
			array('created_at, result, result_date_at', 'numerical', 'integerOnly'=>true),
			array('author_id, receiving_user_id', 'length', 'max'=>11),
			array('good_id, vehicle_id', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, author_id, receiving_user_id, good_id, vehicle_id, created_at, result, result_date_at', 'safe', 'on'=>'search'),
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
			'author' => array(self::BELONGS_TO, 'Users', 'author_id'),
			'receivingUser' => array(self::BELONGS_TO, 'Users', 'receiving_user_id'),
			'good' => array(self::BELONGS_TO, 'Goods', 'good_id'),
			'currency' => array(self::BELONGS_TO, 'Currency', 'currency_id'),
			'offerVehicle' => array(self::BELONGS_TO, 'Vehicle', 'offer_vehicle_id'),
			'offerGood' => array(self::BELONGS_TO, 'Goods', 'offer_good_id'),
			'reviews' => array(self::BELONGS_TO, 'Reviews', 'review_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'author_id' => 'Author',
			'receiving_user_id' => 'Receiving User',
			'good_id' => 'Good',
			'vehicle_id' => 'Vehicle',
			'created_at' => 'Created At',
			'result' => 'Result',
			'result_date_at' => 'Result Date At',
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
		$criteria->compare('author_id',$this->author_id,true);
		$criteria->compare('receiving_user_id',$this->receiving_user_id,true);
		$criteria->compare('good_id',$this->good_id,true);
		$criteria->compare('vehicle_id',$this->vehicle_id,true);
		$criteria->compare('created_at',$this->created_at);
		$criteria->compare('result',$this->result);
		$criteria->compare('result_date_at',$this->result_date_at);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function getUsersOffers($user, $offerType = self::OFFER_TYPE_USERS)
	{
		$condition = 'created_at >= UNIX_TIMESTAMP(CURRENT_DATE - INTERVAL 1 MONTH) AND created_at < UNIX_TIMESTAMP(CURRENT_DATE + INTERVAL 1 DAY)';
		$condition .= $offerType == self::OFFER_TYPE_USERS
				? ' AND author_id = ' . $user->id
				: ' AND receiving_user_id = ' . $user->id;

		$criteria = new CDbCriteria();
		$criteria->condition = $condition;
		$criteria->order = 'created_at DESC';

		return $this->findAll($criteria);
	}

	public function getCost()
	{
		return $this->cost . ' ' . $this->currency->name_ru;
	}

	public function madeDeal($currentUser, $user, $offer_id)
	{
		return $this->find('((author_id = ' . $currentUser->id . ' AND receiving_user_id = ' . $user->id . ')
			OR (author_id = ' . $user->id . ' AND receiving_user_id = ' . $currentUser->id . '))
			AND (result = ' . self::RESULT_IN_ACCEPT . ' OR result = ' . self::RESULT_IN_REFUSE . ')
			AND id = ' . $offer_id);
	}

//	public function getForUsersOffers($user)
//	{
//		$criteria = new CDbCriteria();
//		$criteria->condition = 'receiving_user_id = ' . $user->id . ' AND created_at >= UNIX_TIMESTAMP(CURRENT_DATE - INTERVAL 1 MONTH) AND created_at < UNIX_TIMESTAMP(CURRENT_DATE + INTERVAL 1 DAY)';
//
//		return $this->findAll($criteria);
//	}
}