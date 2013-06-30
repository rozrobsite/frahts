<?php

/**
 * This is the model class for table "notes".
 *
 * The followings are the available columns in table 'notes':
 * @property string $id
 * @property string $user_id
 * @property string $type
 * @property string $start
 * @property string $end
 * @property integer $is_show
 *
 * The followings are the available model relations:
 * @property Users $user
 */
class Notes extends CActiveRecord
{

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Notes the static model class
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
		return 'notes';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('type, start, end', 'required'),
			array('is_show', 'numerical', 'integerOnly' => true),
			array('user_id', 'length', 'max' => 11),
			array('type', 'length', 'max' => 128),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, type, start, end, is_show', 'safe', 'on' => 'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => 'User',
			'type' => 'Type',
			'start' => 'Start',
			'end' => 'End',
			'is_show' => 'Is Show',
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
		$criteria->compare('type', $this->type, true);
		$criteria->compare('start', $this->start, true);
		$criteria->compare('end', $this->end, true);
		$criteria->compare('is_show', $this->is_show);

		return new CActiveDataProvider($this, array(
					'criteria' => $criteria,
				));
	}

	public function getAll($user)
	{
		$criteria = new CDbCriteria();
		$criteria->condition = 'user_id = ' . $user->id;

		$notes = $this->findAll($criteria);

		$result = array();
		foreach ($notes as $note)
		{
			$result[] = array(
				'id' => $note->id,
				'title' => $note->type,
				'start' => $note->start,
				'end' => $note->end,
				'allDay' => false
			);
		}

		return $result;
	}
}