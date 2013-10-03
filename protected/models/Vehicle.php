<?php

/**
 * This is the model class for table "vehicle".
 *
 * The followings are the available columns in table 'vehicle':
 * @property string $id
 * @property integer $user_id
 * @property integer $category_id
 * @property integer $make_id
 * @property integer $vehicle_type_id
 * @property integer $model_id
 * @property integer $body_type_id
 * @property float $bearing_capacity
 * @property integer $body_capacity
 * @property string $license_plate
 * @property string $number_trailer
 * @property string $number_semitrailer
 * @property integer $is_deleted
 * @property integer $is_verification
 * @property integer $adr
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $country_id
 * @property integer $region_id
 * @property integer $city_id
 * @property integer $date_to
 * @property integer $date_from
 * @property integer $country_id_to
 * @property integer $region_id_to
 * @property integer $city_id_to
 *
 * The followings are the available model relations:
 * @property BodyTypes $bodyType
 * @property Categories $categories
 * @property Makes $make
 * @property Users $user
 * @property VehicleTypes $vehicleType
 * @property Models $model
 * @property string $permissions
 * @property string $shipments
 */
class Vehicle extends CActiveRecord
{
	public $shipmentsNames;
	public $slugMake;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Vehicle the static model class
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
		return 'vehicle';
	}

//	public function behaviors()
//	{
//		return array(
//			'SlugBehavior' => array(
//				'class' => 'ext.aii.behaviors.SlugBehavior',
//				'sourceAttribute' => 'slugMake',
//				'slugAttribute' => 'slug',
//				'mode' => 'translate',
//			),
//		);
//	}
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('category_id, make_id, vehicle_type_id, body_type_id, bearing_capacity, body_capacity, license_plate, country_id, region_id, city_id', 'required'),
			array('date_from, date_to', 'required'),
			array('category_id, make_id, vehicle_type_id, model_id, body_type_id, body_capacity', 'numerical', 'integerOnly' => true),
			array('user_id', 'length', 'max' => 11),
			array('bearing_capacity', 'numerical', 'min' => 0.5),
			array('body_capacity', 'numerical', 'min' => 1),
			array('license_plate, number_trailer, number_semitrailer', 'length', 'max' => 32),
			array('country_id_to, region_id_to, city_id_to', 'default', 'setOnEmpty' => true, 'value' => null),
			array('adr', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, category_id, make_id, vehicle_type_id, model_id, body_type_id, bearing_capacity, body_capacity, license_plate, number_trailer, date_from, date_to, number_semitrailer, is_deleted, is_verification', 'safe', 'on' => 'search'),
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
			'bodyType' => array(self::BELONGS_TO, 'BodyTypes', 'body_type_id'),
			'categories' => array(self::BELONGS_TO, 'Categories', 'category_id'),
			'make' => array(self::BELONGS_TO, 'Makes', 'make_id'),
			'marka' => array(self::BELONGS_TO, 'Marka', 'make_id'),
			'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
			'vehicleType' => array(self::BELONGS_TO, 'VehicleTypes', 'vehicle_type_id'),
			'model' => array(self::BELONGS_TO, 'Models', 'model_id'),
			'modeli' => array(self::BELONGS_TO, 'Modeli', 'model_id'),
			'photos' => array(self::HAS_MANY, 'Photos', 'vehicle_id'),
			'countries' => array(self::BELONGS_TO, 'Country', 'country_id'),
			'regions' => array(self::BELONGS_TO, 'Region', 'region_id'),
			'cities' => array(self::BELONGS_TO, 'City', 'city_id'),
			'countriesTo' => array(self::BELONGS_TO, 'Country', 'country_id_to'),
			'regionsTo' => array(self::BELONGS_TO, 'Region', 'region_id_to'),
			'citiesTo' => array(self::BELONGS_TO, 'City', 'city_id_to'),
			'offers' => array(self::HAS_MANY, 'Offers', 'vehicle_id'),
			'vehicleOffer' => array(self::HAS_MANY, 'Offers', 'offer_vehicle_id'),
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
			'category_id' => 'Вид транспорта',
			'make_id' => 'Марка',
			'vehicle_type_id' => 'Тип транспорта',
			'model_id' => 'Модель',
			'body_type_id' => 'Тип кузова',
			'bearing_capacity' => 'Грузоподъемность',
			'body_capacity' => 'Объем кузова',
			'license_plate' => 'Номер транспорта',
			'number_trailer' => 'Номер прицепа',
			'number_semitrailer' => 'Номер полуприцепа',
			'country_id' => 'Страна',
			'region_id' => 'Регион',
			'city_id' => 'Населенный пункт',
			'date_from' => '"Дата "С"',
			'date_to' => '"Дата "По"',
			'country_id_to' => '"Страна прибытия"',
			'region_id_to' => '"Регион прибытия"',
			'city_id_to' => '"Населенный пункт прибытия"',
			'is_deleted' => 'Удалено из поиска',
			'is_verification' => 'Проверено',
			'created_at' => 'Дата регистрации',
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

		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id, true);
		$criteria->compare('user_id', $this->user_id, true);
		$criteria->compare('category_id', $this->category_id);
		$criteria->compare('make_id', $this->make_id);
		$criteria->compare('vehicle_type_id', $this->vehicle_type_id);
		$criteria->compare('model_id', $this->model_id);
		$criteria->compare('body_type_id', $this->body_type_id);
		$criteria->compare('bearing_capacity', $this->bearing_capacity);
		$criteria->compare('body_capacity', $this->body_capacity);
		$criteria->compare('license_plate', $this->license_plate, true);
		$criteria->compare('number_trailer', $this->number_trailer, true);
		$criteria->compare('number_semitrailer', $this->number_semitrailer, true);
		$criteria->compare('is_deleted', $this->is_deleted);
		$criteria->compare('is_verification', $this->is_verification);
		$criteria->compare('country_id', $this->country_id);
		$criteria->compare('region_id', $this->region_id);
		$criteria->compare('city_id', $this->city_id);
		$criteria->compare('country_id_to', $this->country_id_to);
		$criteria->compare('region_id_to', $this->region_id_to);
		$criteria->compare('city_id_to', $this->city_id_to);
		$criteria->compare('created_at', $this->created_at);
		$criteria->compare('updated_at', $this->updated_at);

		return new CActiveDataProvider($this, array(
					'criteria' => $criteria,
				));
	}

	public function findAllByDeleted($is_deleted = true)
	{
//		$condition = $is_deleted ? 'is_deleted = 1' : 'is_deleted = 0';
//		$condition .= ' AND user_id = ' . Yii::app()->user->id;
		$condition = 'user_id = ' . Yii::app()->user->id;

		return $this->findAll($condition . ' ORDER BY created_at DESC');
	}

	public function deleteFromSearch($is_deleted)
	{
		$this->is_deleted = $is_deleted ? 1 : 0;
		return $this->update(array('is_deleted'));
	}

	public function deleteManySearch($ids)
	{
		$command = Yii::app()->db->createCommand();
		$command->update('vehicle', array(
			'is_deleted' => 1,
				), 'id IN (' . trim($ids, ',') . ')');
	}

	public function returnManySearch($ids)
	{
		$command = Yii::app()->db->createCommand();
		$command->update('vehicle', array(
			'is_deleted' => 0,
				), 'id IN (' . trim($ids, ',') . ')');
	}

	public function getAll(SearchFilter $filter)
	{
		$where = $this->createCondition($filter);
		$criteria = new CDbCriteria();

//		$criteria->select = 't.*,
//			(SELECT GROUP_CONCAT(shipment.name_ru SEPARATOR ", ") FROM shipment WHERE FIND_IN_SET(shipment.id, t.shipments) > 0) as shipmentsNames';
		$criteria->select = array('t.*', '(SELECT GROUP_CONCAT(shipment.name_ru SEPARATOR ", ") FROM shipment WHERE FIND_IN_SET(shipment.id, t.shipments) > 0) as shipmentsNames');

		$criteria->condition = $where;
		$criteria->limit = Yii::app()->params['pages']['searchCount'];
		$criteria->offset = ($filter->page - 1) * Yii::app()->params['pages']['searchCount'];
		$criteria->with = array('user.profiles');

		$direction = isset($filter->direction) && $filter->direction ? ' ASC' : ' DESC';

		$criteria->group = 't.id';
		$criteria->order = "t.updated_at $direction";
//		$criteria->order = isset($filter->sort) && $filter->sort ? "t.cost $direction, t.updated_at DESC"
//					: "t.updated_at $direction, t.cost DESC";

//		$goods = $this->findAll($criteria);
//		$count = $this->count($criteria);

		return array(
			'vehicles' => $this->findAll($criteria),
			'count' => $this->count($criteria),
		);
//		return $this->findAll($criteria);
//		return $this->findAll(array('condition' => 'date_to >= ' . time(), 'order' => 'created_at DESC'));
	}

	private function createCondition($filter)
	{
		$result = array();
		$result[] = 't.user_id <> ' . (isset(Yii::app()->user->id) ? (int) Yii::app()->user->id : 0);

		if (!empty($filter->check_dispatcher))
			$result[] = 'profiles.user_type_id <>' . UserTypes::DISPATCHER;

		if (empty($filter->city_id))
		{
			if (!empty($filter->country_id))
			{
				$result[] = 't.country_id = ' . (int) $filter->country_id;
			}

			if (!empty($filter->region_id))
			{
				$result[] = 't.region_id = ' . (int) $filter->region_id;
			}
		}

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

		if (!empty($filter->date_from) || !empty($filter->date_to))
		{
			$date_from = $date_to = time();

			if (!empty($filter->date_from))
			{
				$date_from = strtotime($filter->date_from);
			}

			if (!empty($filter->date_to))
			{
				$date_to = strtotime($filter->date_to);
			}

			$result[] = 'NOT ((' . $date_from . ' < t.date_from AND ' . $date_to . ' < t.date_from) OR (' . $date_from . ' > t.date_to AND ' . $date_to . ' < t.date_to))';
		}

		$result[] = 'date_to >= ' . time();

		if (isset($filter->good->id))
		{
			if ($filter->good->permissions)
			{
				$permissions = array();
				$permissionsArray = explode(',', $filter->good->permissions);
				foreach ($permissionsArray as $permission)
				{
					$permissions[] = 'FIND_IN_SET(' . $permission . ', t.permissions) > 0';
				}

				$result[] = '(' . join(' OR ', $permissions) . ' OR t.permissions IS NULL)';
			}
			if ($filter->good->shipments)
			{
				$shipments = array();
				$shipmentsArray = explode(',', $filter->good->shipments);
				foreach ($shipmentsArray as $shipment)
				{
					$shipments[] = 'FIND_IN_SET(' . $shipment . ', t.shipments) > 0';
				}

				$result[] = '(' . join(' OR ', $shipments) . ')';
			}

			if ($filter->good->vehicle_types)
				$result[] = '(FIND_IN_SET(t.vehicle_type_id, "' . $filter->good->vehicle_types . '") > 0)';

			if ($filter->good->body_types)
				$result[] = '(FIND_IN_SET(t.body_type_id, "' . $filter->good->body_types . '") > 0)';

			$result[] = '(' . $filter->good->weight_exact_value . '<= t.bearing_capacity OR (' . $filter->good->weight_exact_value . ' = 0 AND (' . $filter->good->weight_from . ' <= t.bearing_capacity OR ' . $filter->good->weight_to . ' <= t.bearing_capacity)))';
			$result[] = '(' . $filter->good->capacity_exact_value . ' <= t.body_capacity OR (' . $filter->good->capacity_exact_value . ' = 0 AND (' . $filter->good->capacity_from . ' <= t.body_capacity OR ' . $filter->good->capacity_to . ' <= t.body_capacity)))';
			if ($filter->good->adr) $result[] = 'adr >= ' . $filter->good->adr;
		}

		if (isset($filter->radius) && $filter->radius)
		{
			$inRadius = array();
			$city_id_from = 0;
			if (!empty($filter->city_id))
			{
				$city_id_from = (int)$filter->city_id;

				$city = City::model()->findByPk($city_id_from);
				$inRadius[] = 't.city_id IN ( SELECT id
					FROM city WHERE (6371 * acos( cos( radians(' . $city->latitude . ') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(' . $city->longitude . ') ) + sin( radians(' . $city->latitude . ') ) * sin( radians( latitude ) ) ) ) < ' . (int) $filter->radius . ')';

				unset($city);
			}

			$city_id_to = 0;
			if (!empty($filter->city_search_id))
			{
				$city_id_to = (int)$filter->city_search_id;

				$city = City::model()->findByPk($city_id_to);

				$inRadius[] = '((CASE
					WHEN t.country_id_to IS NULL THEN 1
					WHEN t.region_id_to IS NULL AND t.country_id_to = ' . $city->country->id . ' THEN 1
					WHEN t.city_id_to IS NULL AND t.country_id_to = ' . $city->country->id . ' AND t.region_id_to = ' . $city->region->id . ' THEN 1 END) = 1
					OR t.city_id_to IN ( SELECT id
					FROM city WHERE (6371 * acos( cos( radians(' . $city->latitude . ') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(' . $city->longitude . ') ) + sin( radians(' . $city->latitude . ') ) * sin( radians( latitude ) ) ) ) < ' . (int) $filter->radius . '))';

//				$inRadius[] = 't.city_id_to IN ( SELECT id
//					FROM city WHERE (6371 * acos( cos( radians(' . $city->latitude . ') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(' . $city->longitude . ') ) + sin( radians(' . $city->latitude . ') ) * sin( radians( latitude ) ) ) ) < ' . (int) $filter->radius . ')';

				unset($city);
			}

			if (!empty($inRadius)) $result[] = '(' . join(' AND ', $inRadius) . ')';
		}

		$result[] = 'is_deleted = 0';

		return join(' AND ', $result);
	}

	public function shortName()
	{
		return $this->bodyType->name_ru . ' ' . $this->marka->name . ' ' . $this->modeli->name;
	}
}