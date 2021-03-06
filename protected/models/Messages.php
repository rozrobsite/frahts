<?php

/**
 * This is the model class for table "messages".
 *
 * The followings are the available columns in table 'messages':
 * @property string $id
 * @property string $author_id
 * @property string $receiving_user_id
 * @property string $message
 * @property integer $created_at
 * @property integer $is_deleted
 *
 * The followings are the available model relations:
 * @property Users $receivingUser
 * @property Users $author
 */
class Messages extends CActiveRecord
{
	const GOOD = 1;
	const VEHICLE = 2;
	const TYPE_LAST = 1;
	const TYPE_WEEK = 2;
	const TYPE_MONTH = 3;
	const TYPE_3_MONTH = 4;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Messages the static model class
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
		return 'messages';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('author_id, receiving_user_id, message, created_at', 'required'),
			array('created_at, is_deleted', 'numerical', 'integerOnly'=>true),
			array('author_id, receiving_user_id', 'length', 'max'=>11),
//			array('message', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, author_id, receiving_user_id, message, created_at, is_deleted', 'safe', 'on'=>'search'),
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
			'receivingUser' => array(self::BELONGS_TO, 'Users', 'receiving_user_id'),
			'author' => array(self::BELONGS_TO, 'Users', 'author_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'author_id' => 'От кого',
			'receiving_user_id' => 'Кому',
			'message' => 'Сообщение',
			'created_at' => 'Дата создания',
			'is_deleted' => 'Удалено',
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
		$criteria->compare('message',$this->message,true);
		$criteria->compare('created_at',$this->created_at);
		$criteria->compare('is_deleted',$this->is_deleted);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function getMessages($user, $receivingUser, $type)
	{
		$condition = 'is_deleted = 0';
		switch($type)
		{
			case self::TYPE_LAST:
				break;
			case self::TYPE_WEEK:
				$condition .= '
					AND created_at >= UNIX_TIMESTAMP(CURRENT_DATE - INTERVAL 7 DAY)
					AND created_at < UNIX_TIMESTAMP(CURRENT_DATE + INTERVAL 1 DAY)';
				break;
			case self::TYPE_MONTH:
				$condition .= '
					AND created_at >= UNIX_TIMESTAMP(CURRENT_DATE - INTERVAL 1 MONTH)
					AND created_at < UNIX_TIMESTAMP(CURRENT_DATE + INTERVAL 1 DAY)';
				break;
			case self::TYPE_3_MONTH:
				$condition .= '
					AND created_at >= UNIX_TIMESTAMP(CURRENT_DATE - INTERVAL 3 MONTH)
					AND created_at < UNIX_TIMESTAMP(CURRENT_DATE + INTERVAL 1 DAY)';
				break;
		}

		$criteria = new CDbCriteria();

		if (!$receivingUser)
		{
			$criteria->condition = $condition . ' AND (receiving_user_id = ' . $user->id . ' OR author_id = ' . $user->id . ')';
			$criteria->order = 'created_at DESC';

			if ($type == self::TYPE_LAST)
				$criteria->limit = Yii::app()->params['messages_by_page'];

			return $this->findAll($criteria);
		}

		$criteria->condition = $condition . ' AND ((receiving_user_id = ' . $user->id . ' AND author_id = ' . $receivingUser->id . ')
			OR (author_id = ' . $user->id . ' AND receiving_user_id = ' . $receivingUser->id . '))';
		$criteria->order = 'created_at DESC';

		return $this->findAll($criteria);
	}

	public function getReceivingUsers($currentUser, $receivingUser = null)
	{
		$users = array();

		if ($receivingUser)
			$users[] = $receivingUser;

		$messages = array_merge($currentUser->messagesReceiving, $currentUser->messagesAuthor);

		foreach ($messages as $message)
		{
			if ($currentUser->id == $message->author->id)
			{
				$users[] = $message->receivingUser;
			}
			if ($currentUser->id == $message->receivingUser->id)
			{
				$users[] = $message->author;
			}
		}

		$result = array();
		$currentUserIds = array();
		foreach ($users as $user)
		{
			if (!in_array($user->id, $currentUserIds))
			{
				$result[] = $user;
				$currentUserIds[] = $user->id;
			}
		}

		return $result;
	}
}