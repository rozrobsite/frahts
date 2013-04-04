<?php

/**
 * This is the model class for table "goods".
 *
 * The followings are the available columns in table 'goods':
 * @property integer $id
 * @property integer $user_id
 * @property integer $date_from
 * @property integer $date_to
 * @property string $name
 * @property integer $country_id_from
 * @property integer $region_id_from
 * @property integer $city_id_from
 * @property integer $country_id_to
 * @property integer $region_id_to
 * @property integer $city_id_to
 * @property string $vehicle_types
 * @property string $body_types
 * @property string $shipments
 * @property float $weight_from
 * @property float $weight_to
 * @property float $weight_exact_value
 * @property integer $capacity_from
 * @property integer $capacity_to
 * @property integer $capacity_exact_value
 * @property string $permissions
 * @property integer $cost
 * @property integer $currency_id
 * @property integer $payment_type_id
 * @property string $description
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $is_deleted
 * @property integer $adr
 * @property string $fee
 *
 * The followings are the available model relations:
 * @property PaymentType $paymentType
 * @property Country $countryIdFrom
 * @property Region $regionIdFrom
 * @property City $cityIdFrom
 * @property Country $countryIdTo
 * @property Region $regionIdTo
 * @property City $cityIdTo
 * @property Currency $currency
 */
class Goods extends CActiveRecord
{

	const ACTIVE = true;
	const NO_ACTIVE = false;

	public $bodyTypeNames;
	public $shipmentsNames;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Goods the static model class
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'goods';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, cost, currency_id, payment_type_id, country_id_from, region_id_from, country_id_to, region_id_to, 
				city_id_from, city_id_to, shipments, body_types', 'required'),
			array('fee', 'checkFee'),
			array('date_from, date_to', 'required'),
			array('cost, currency_id, payment_type_id', 'numerical', 'integerOnly' => true),
			array('country_id_from, region_id_from, country_id_to, region_id_to', 'length', 'max' => 10),
			array('user_id', 'length', 'max' => 11),
			array('cost', 'length', 'max' => 6),
			array('city_id_from, city_id_to', 'length', 'max' => 11),
			array('shipments', 'length', 'max' => 32),
			array('name, body_types', 'length', 'max' => 255),
			array('name', 'length', 'max' => 25),
			array('description', 'safe'),
			array('description', 'length', 'max' => 1000),
//			array('capacity_from, capacity_to', 'numerical', 'min' => 1),
//			array('weight_from, weight_to', 'numerical', 'min' => 0.5),
			array('cost', 'compare', 'compareValue' => 0, 'operator' => '>'),
//			array('weight_to', 'compare', 'compareAttribute' => 'weight_from', 'operator' => '>='),
//			array('capacity_to', 'compare', 'compareAttribute' => 'capacity_from', 'operator' => '>='),
			array('adr', 'safe'),
			array('weight_to, weight_from, weight_exact_value', 'checkWeight'),
			array('capacity_from, capacity_to, capacity_exact_value', 'checkCapacity'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, date_from, date_to, name, country_id_from, region_id_from, city_id_from, country_id_to, region_id_to, city_id_to, vehicle_types, body_types, shipments, weight_from, weight_to, capacity_from, capacity_to, permissions, cost, currency_id, payment_type_id, description, adr, weight_exact_value, capacity_exact_value', 'safe', 'on' => 'search'),
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
			'paymentType' => array(self::BELONGS_TO, 'PaymentType', 'payment_type_id'),
			'countryFrom' => array(self::BELONGS_TO, 'Country', 'country_id_from'),
			'regionFrom' => array(self::BELONGS_TO, 'Region', 'region_id_from'),
			'cityFrom' => array(self::BELONGS_TO, 'City', 'city_id_from'),
			'countryTo' => array(self::BELONGS_TO, 'Country', 'country_id_to'),
			'regionTo' => array(self::BELONGS_TO, 'Region', 'region_id_to'),
			'cityTo' => array(self::BELONGS_TO, 'City', 'city_id_to'),
			'currency' => array(self::BELONGS_TO, 'Currency', 'currency_id'),
			'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'date_from' => '"Дата "С"',
			'date_to' => '"Дата "По"',
			'name' => '"Короткое название"',
			'country_id_from' => '"Страна отправления"',
			'region_id_from' => '"Регион отправления"',
			'city_id_from' => '"Населенный пункт отправления"',
			'country_id_to' => '"Страна прибытия"',
			'region_id_to' => '"Регион прибытия"',
			'city_id_to' => '"Населенный пункт прибытия"',
			'vehicle_types' => '"Тип транспорта"',
			'body_types' => '"Тип кузова"',
			'shipments' => '"Вид загрузки"',
			'weight_from' => '"Вес груза "От"',
			'weight_to' => '"Вес груза "До"',
			'weight_exact_value' => '"Точное значение',
			'capacity_from' => '"Объем груза "От"',
			'capacity_to' => '"Объем груза "По"',
			'capacity_to' => '"Точное значение"',
			'permissions' => '"Разрешения"',
			'cost' => '"Стоимость"',
			'currency_id' => '"Валюта"',
			'payment_type_id' => '"Вид оплаты"',
			'description' => '"Описание груза"',
			'created_at' => '"Дата добавления"',
			'updated_at' => '"Дата обновления"',
			'is_deleted' => '"Удалено из поиска"',
			'adr' => '"Допуск"',
			'fee' => '"Комиссия"',
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

		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('date_from', $this->date_from);
		$criteria->compare('date_to', $this->date_to);
		$criteria->compare('name', $this->name, true);
		$criteria->compare('country_id_from', $this->country_id_from);
		$criteria->compare('region_id_from', $this->region_id_from);
		$criteria->compare('city_id_from', $this->city_id_from);
		$criteria->compare('country_id_to', $this->country_id_to);
		$criteria->compare('region_id_to', $this->region_id_to);
		$criteria->compare('city_id_to', $this->city_id_to);
		$criteria->compare('vehicle_types', $this->vehicle_types, true);
		$criteria->compare('body_types', $this->body_types, true);
		$criteria->compare('shipments', $this->shipments, true);
		$criteria->compare('weight_from', $this->weight_from);
		$criteria->compare('weight_to', $this->weight_to);
		$criteria->compare('weight_exact_value', $this->weight_exact_value);
		$criteria->compare('capacity_from', $this->capacity_from);
		$criteria->compare('capacity_to', $this->capacity_to);
		$criteria->compare('capacity_exact_value', $this->capacity_exact_value);
		$criteria->compare('permissions', $this->permissions, true);
		$criteria->compare('cost', $this->cost);
		$criteria->compare('currency_id', $this->currency_id);
		$criteria->compare('payment_type_id', $this->payment_type_id);
		$criteria->compare('description', $this->description);
		$criteria->compare('created_at', $this->created_at);
		$criteria->compare('updated_at', $this->updated_at);
		$criteria->compare('is_deleted', $this->is_deleted);

		$criteria->order = 'created_at DESC';

		return new CActiveDataProvider($this, array(
					'criteria' => $criteria,
				));
	}

	public function getActive($is_active = true)
	{
		$currentTime = time();

		$criteria = new CDbCriteria();
		$criteria->condition = $is_active ? "user_id = " . Yii::app()->user->id . " AND date_to >= $currentTime"
					: "user_id = " . Yii::app()->user->id . " AND date_to < $currentTime";
		$criteria->order = 'created_at DESC';

		return new CActiveDataProvider($this,
						array(
							'criteria' => $criteria,
							'pagination' => array(
								'pageSize' => Yii::app()->params['pages']['goodsCount'],
								'pageVar' => 'goods',
							),
						)
		);
	}

	public function deleteFromSearch()
	{
		$command = Yii::app()->db->createCommand();
		return $command->update('goods',
						array(
					'date_to' => strtotime('-1 day'),
						), 'id = ' . $this->id . ' AND user_id = ' . Yii::app()->user->id);
	}

	public function checkFee($attribute, $params)
	{
		$user = Users::model()->findByPk(Yii::app()->user->id);
		if ($user->profiles->user_type_id == UserTypes::DISPATCHER && empty($this->fee))
		{
			$this->addError('fee', 'Введите комиссию');
		}
	}
	public function checkWeight($attribute, $params)
	{
		if ($this->weight_exact_value == 0 && ($this->weight_from == 0 || $this->weight_to == 0))
		{
			$this->addError('weight_from', 'Заполните "Вес груза"');
			
			return;
		}
		if ($this->weight_from > $this->weight_to)
		{
			$this->addError('weight_from', 'Неверно. Вес груза "От" больше чем "До"');
		}
	}
	public function checkCapacity($attribute, $params)
	{
//		if ($this->capacity_exact_value == 0 && ($this->capacity_from == 0 || $this->capacity_to == 0))
//		{
//			$this->addError('capacity_from', 'Заполните "Объем груза"');
//			
//			return;
//		}
		if ($this->capacity_from > $this->capacity_to)
		{
			$this->addError('capacity_from', 'Неверно. Объем груза "От" больше чем "До"');
		}
	}

	public function getAll(SearchFilter $filter)
	{
		$where = $this->createCondition($filter);
		$criteria = new CDbCriteria();

		$criteria->select = 't.*, 
			(SELECT GROUP_CONCAT(body_types.name_ru SEPARATOR ", ") FROM body_types WHERE FIND_IN_SET(body_types.id, t.body_types) > 0) as bodyTypeNames, 
			(SELECT GROUP_CONCAT(shipment.name_ru SEPARATOR ", ") FROM shipment WHERE FIND_IN_SET(shipment.id, t.shipments) > 0) as shipmentsNames';

		$criteria->condition = $where;
		$criteria->limit = Yii::app()->params['pages']['searchCount'];
		$criteria->offset = ($filter->page - 1) * Yii::app()->params['pages']['searchCount'];
		
		$direction = isset($filter->direction) && $filter->direction ? ' ASC' : ' DESC';
		
		$criteria->order = isset($filter->sort) && $filter->sort ? "t.cost $direction, t.updated_at DESC" : "t.updated_at $direction, t.cost DESC";

		$vehicles = $this->findAll($criteria);
		$count = $this->count($criteria);

		return array(
			'vehicles' => $vehicles,
			'count' => $count,
		);
//		return $this->findAll($criteria);
//		return $this->findAll(array('condition' => 'date_to >= ' . time(), 'order' => 'created_at DESC'));
	}

	private function createCondition($filter)
	{
		$result = array();
		$result[] = 't.user_id <> ' . (isset(Yii::app()->user->id) ? (int) Yii::app()->user->id : 0);
		
		if (isset($filter->vehicle) && $filter->vehicle->id)
		{
			$filter->country_id = (int) $filter->vehicle->country_id;
			$filter->region_id = (int) $filter->vehicle->region_id;
			$filter->city_id = (int) $filter->vehicle->city_id;
		}
		
		if (empty($filter->city_id))
		{
			if (!empty($filter->country_id))
			{
				$result[] = 't.country_id_from = ' . (int) $filter->country_id;
			}

			if (!empty($filter->region_id))
			{
				$result[] = 't.region_id_from = ' . (int) $filter->region_id;
			}
		}

//		if (!empty($filter->city_id))
//		{
//			$result[] = 't.city_id_from = ' . (int) $filter->city_id;
//		}

		if (empty($filter->city_search_id))
		{
			if (!empty($filter->country_search_id))
			{
				$result[] = 't.country_id_to = ' . (int) $filter->country_search_id;
			}

			if (!empty($filter->region_search_id))
			{
				$result[] = 't.region_id_to = ' . (int) $filter->region_search_id;
			}
		}

//		if (!empty($filter->city_search_id))
//		{
//			$result[] = 't.city_id_to = ' . (int) $filter->city_search_id;
//		}

		if (!empty($filter->date_from) && !empty($filter->date_to))
		{
			$result[] = 't.date_to >= ' . strtotime($filter->date_from) . ' AND t.date_to <= ' . strtotime($filter->date_to);
		}
		elseif (!empty($filter->date_from) && empty($filter->date_to))
		{
			$result[] = strtotime($filter->date_from) . ' <= t.date_to';
		}
		elseif (empty($filter->date_from) && !empty($filter->date_to))
		{
			$result[] = strtotime($filter->date_to) . ' >= t.date_to';
		}

		$result[] = 'date_to >= ' . time();

		if (isset($filter->vehicle))
		{
			if ($filter->vehicle->permissions)
			{
				$permissions = array();
				$permissionsArray = explode(',', $filter->vehicle->permissions);
				foreach ($permissionsArray as $permission)
				{
					$permissions[] = 'FIND_IN_SET(' . $permission . ', t.permissions) > 0';
				}
				
				$result[] = '(' . join(' OR ', $permissions) . ' OR t.permissions IS NULL)';
			}
			if ($filter->vehicle->shipments)
			{
				$shipments = array();
				$shipmentsArray = explode(',', $filter->vehicle->shipments);
				foreach ($shipmentsArray as $shipment)
				{
					$shipments[] = 'FIND_IN_SET(' . $shipment . ', t.shipments) > 0';
				}
				
				$result[] = '(' . join(' OR ', $shipments) . ')';
			}
			$result[] = '(FIND_IN_SET(' . $filter->vehicle->vehicle_type_id . ', t.vehicle_types) > 0  OR t.vehicle_types IS NULL)';
			$result[] = 'FIND_IN_SET(' . $filter->vehicle->body_type_id . ', t.body_types) > 0';
			
			$result[] = '(' . $filter->vehicle->bearing_capacity . ' >= t.weight_exact_value OR ' . $filter->vehicle->bearing_capacity . ' >= t.weight_from OR ' . $filter->vehicle->bearing_capacity . ' >= t.weight_to)';
			$result[] = '(' . $filter->vehicle->body_capacity . ' >= t.capacity_exact_value OR ' . $filter->vehicle->body_capacity . ' >= t.capacity_from OR ' . $filter->vehicle->body_capacity . ' >= t.capacity_to)';
			if ($filter->vehicle->adr) $result[] = 'adr <= ' . $filter->vehicle->adr;
		}

//		$where = join(' AND ', $result);
		
		if (isset($filter->radius) && $filter->radius)
		{
			$inRadius = array();
			if (isset($filter->city_id) && $filter->city_id)
			{
				$city = City::model()->findByPk((int) $filter->city_id);
				$inRadius[] = 't.city_id_from IN ( SELECT id 
					FROM city WHERE (6371 * acos( cos( radians(' . $city->latitude . ') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(' . $city->longitude . ') ) + sin( radians(' . $city->latitude . ') ) * sin( radians( latitude ) ) ) ) < ' . (int) $filter->radius . ')';
				
//				$where .= ' OR ' . $inRadius;
				unset($city);
			}
			
			if (isset($filter->city_search_id) && $filter->city_search_id)
			{
				$city = City::model()->findByPk((int) $filter->city_search_id);
				$inRadius[] = 't.city_id_to IN ( SELECT id 
					FROM city WHERE (6371 * acos( cos( radians(' . $city->latitude . ') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(' . $city->longitude . ') ) + sin( radians(' . $city->latitude . ') ) * sin( radians( latitude ) ) ) ) < ' . (int) $filter->radius . ')';
				
//				$where .= ' OR ' . $inRadius;
				unset($city);
			}
			
			if (!empty($inRadius)) $result[] = '(' . join(' OR ', $inRadius) . ')';
//			$where .= ' AND ' . join(' OR ', $inRadius) . '';
		}
		
		return join(' AND ', $result);
	}

}