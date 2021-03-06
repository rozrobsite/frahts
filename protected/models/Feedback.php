<?php

/**
 * This is the model class for table "feedback".
 *
 * The followings are the available columns in table 'feedback':
 * @property integer $id
 * @property string $subject
 * @property string $message
 * @property string $email
 * @property int $created_at
 */
class Feedback extends CActiveRecord
{

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Feedback the static model class
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
		return 'feedback';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('subject, message', 'required'),
			array('subject', 'length', 'max' => 60),
			array('message', 'length', 'max' => 1024),
			array('email, created_at', 'safe'),
//			array('message', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, subject, message, email', 'safe', 'on' => 'search'),
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
			'subject' => '"Тема сообщения"',
			'message' => '"Текст сообщения"',
			'email' => '"Электронный адрес"',
			'created_at' => '"Дата обращения"',
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
		$criteria->compare('subject', $this->subject, true);
		$criteria->compare('message', $this->message, true);
		$criteria->compare('email', $this->email, true);
		$criteria->compare('created_at', $this->created_at, true);

		return new CActiveDataProvider($this, array(
					'criteria' => $criteria,
				));
	}

//	public function beforeSave()
//	{
//		if (parent::beforeSave())
//		{
//			if ($this->isNewRecord)
//			{
//				$this->email = Yii::app()->user->email;
//			}
//			return true;
//		}
//		else return false;
//	}

}