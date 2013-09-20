<?php

/**
 * This is the model class for table "user_tags".
 *
 * The followings are the available columns in table 'user_tags':
 * @property integer $id
 * @property string $text
 */
class UserTags extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UserTags the static model class
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
		return 'user_tags';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id', 'numerical', 'integerOnly'=>true),
			array('text', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, text', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'text' => 'Text',
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
		$criteria->compare('text',$this->text,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function searchUsers($attributes = null)
	{
		$country_id = isset($attributes['country_id']) ? $attributes['country_id'] : 0;
		$region_id = isset($attributes['region_id']) ? $attributes['region_id'] : 0;
		$city_id = isset($attributes['city_id']) ? $attributes['city_id'] : 0;
		$term = isset($attributes['term']) ? trim($attributes['term']) : '';

		$onCondition = array();
		if ($country_id)
			$onCondition[] = 'p.country_id = ' . $country_id;
		if ($region_id)
			$onCondition[] = 'p.region_id = ' . $region_id;
		if ($city_id)
			$onCondition[] = 'p.city_id = ' . $city_id;

		$where = $term ? 'WHERE MATCH(ut.text) AGAINST("' . $term . '" IN BOOLEAN MODE) > 0' : '';

		$on = count($onCondition) ? ' AND ' . join(' AND ', $onCondition) : '';

		$query = 'SELECT ut.id FROM `user_tags` ut
					JOIN profiles p ON p.user_id = ut.id' . $on . $where . '
					GROUP BY ut.id
					ORDER BY count(*) DESC, ut.id ASC';
		$userIds = Yii::app()->db->createCommand($query)->queryAll();

		return Users::model()->findAllByAttributes(array('id' => array_map('self::getItems',$userIds)));
	}

	private static function getItems($item)
	{
		return $item['id'];
	}
}