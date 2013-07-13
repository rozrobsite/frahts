<?php

/**
 * This is the model class for table "reviews".
 *
 * The followings are the available columns in table 'reviews':
 * @property string $id
 * @property string $author_id
 * @property string $receiving_user_id
 * @property integer $rating
 * @property string $text
 * @property integer $created_at
 * @property integer $is_deleted
 *
 * The followings are the available model relations:
 * @property Users $receivingUser
 * @property Users $author
 */
class Reviews extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Reviews the static model class
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
		return 'reviews';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('author_id, receiving_user_id, rating, created_at', 'required'),
			array('rating, created_at, is_deleted', 'numerical', 'integerOnly'=>true),
			array('author_id, receiving_user_id', 'length', 'max'=>11),
			array('text', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, author_id, receiving_user_id, rating, text, created_at, is_deleted', 'safe', 'on'=>'search'),
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
			'author_id' => 'Author',
			'receiving_user_id' => 'Receiving User',
			'rating' => 'Rating',
			'text' => 'Text',
			'created_at' => 'Created At',
			'is_deleted' => 'Is Deleted',
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
		$criteria->compare('rating',$this->rating);
		$criteria->compare('text',$this->text,true);
		$criteria->compare('created_at',$this->created_at);
		$criteria->compare('is_deleted',$this->is_deleted);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}