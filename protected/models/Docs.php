<?php

/**
 * This is the model class for table "docs".
 *
 * The followings are the available columns in table 'docs':
 * @property integer $id
 * @property integer $docs_type_id
 * @property integer $created_at
 * @property string $title
 * @property string $text
 * @property string $slug
 *
 * The followings are the available model relations:
 * @property DocsType $docsType
 */
class Docs extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Docs the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
//	public function behaviors()
//	{
//		return array(
//			'SlugBehavior' => array(
//				'class' => 'ext.aii.behaviors.SlugBehavior',
//				'sourceAttribute' => 'title',
//				'slugAttribute' => 'slug',
//				'mode' => SlugBehavior::MODE_TRANSLIT,
//			),
//		);
//	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'docs';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('docs_type_id, created_at, title, text', 'required'),
			array('docs_type_id, created_at', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>255),
			array('slug', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, docs_type_id, created_at, title, text, slug', 'safe', 'on'=>'search'),
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
			'docsType' => array(self::BELONGS_TO, 'DocsType', 'docs_type_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'docs_type_id' => '"Тип документа"',
			'created_at' => '"Дата добавления"',
			'title' => '"Название документа"',
			'text' => '"Текст"',
			'slug' => '"Slug"',
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
		$criteria->compare('docs_type_id',$this->docs_type_id);
		$criteria->compare('created_at',$this->created_at);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('text',$this->text,true);
		$criteria->compare('slug',$this->slug,true);
		
		$criteria->order = 'created_at DESC';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}