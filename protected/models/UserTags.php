<?php

/**
 * This is the model class for table "user_tags".
 *
 * The followings are the available columns in table 'user_tags':
 * @property integer $id
 * @property string $text
 */
class UserTags extends CActiveRecord {

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UserTags the static model class
	 */
	public static function model($className = __CLASS__) {
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName() {
		return 'user_tags';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id', 'numerical', 'integerOnly' => true),
			array('text', 'length', 'max' => 255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, text', 'safe', 'on' => 'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations() {
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return array(
			'id' => 'ID',
			'text' => 'Text',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search() {
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('text', $this->text, true);

		return new CActiveDataProvider($this, array(
				'criteria' => $criteria,
			));
	}

	public function searchUsers($attributes = null) {
		$onCondition = array();
		if ($attributes['partnerSearchCountry'])
			$onCondition[] = 'p.country_id = ' . $attributes['partnerSearchCountry'];
		if ($attributes['partnerSearchRegion'])
			$onCondition[] = 'p.region_id = ' . $attributes['partnerSearchRegion'];
		if ($attributes['partnerSearchCity'])
			$onCondition[] = 'p.city_id = ' . $attributes['partnerSearchCity'];

		$userTypeIds = array();
		if ($attributes['partnerSearchShipper'])
			$userTypeIds[] = UserTypes::SHIPPER;
		if ($attributes['partnerSearchFreighter'])
			$userTypeIds[] = UserTypes::FREIGHTER;
		if ($attributes['partnerSearchDispatcher'])
			$userTypeIds[] = UserTypes::DISPATCHER;

		$words_arr = explode(' ', trim($attributes['partnerSearchWords']));
		$tmpWordsArr = array();
		foreach ($words_arr as $word) {
			$tmpWordsArr[] = trim($word, ',. !@#$%^&*()_+=-{}[]\'"\\|/?><*') . '*';
		}
		$wordsStr = join(' ', $tmpWordsArr);

		$where = $attributes['partnerSearchWords'] ? ' WHERE MATCH(ut.text) AGAINST("' . $wordsStr . '" IN BOOLEAN MODE) > 0' : '';

		$on = count($onCondition) ? ' AND ' . join(' AND ', $onCondition) : '';
		$userTypes = count($userTypeIds) ? ' AND p.user_type_id IN (' . join(',', $userTypeIds) . ') ' : '';

		$query = 'SELECT ut.id, MATCH(ut.text) AGAINST("' . $wordsStr . '" IN BOOLEAN MODE) as relev FROM `user_tags` ut
					JOIN profiles p ON p.user_id = ut.id' . $on . $userTypes . $where . '
					GROUP BY ut.id
					ORDER BY count(*) DESC, relev DESC, ut.id ASC';

		$userIds = Yii::app()->db->createCommand($query)->queryAll();


		$userIds = array_map('self::getItems', $userIds);

		$criteria = new CDbCriteria();
		$criteria->condition = count($userIds) ? 't.id IN (' . join(',', $userIds) . ')' : 't.id = 0';
		$criteria->order = 'profiles.created_at DESC';
		$criteria->with = array('profiles');

		return new CActiveDataProvider('Users', array(
				'criteria' => $criteria,
				'pagination' => array(
					'pageSize' => 5,
				),
			));
	}

	private static function getItems($item) {
		return $item['id'];
	}

}