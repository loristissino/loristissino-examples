<?php

/**
 * This is the model class for table "picture".
 *
 * The followings are the available columns in table 'picture':
 * @property string $id
 * @property string $height
 * @property string $width
 * @property string $description
 * @property string $type
 * @property string $category_id
 *
 * The followings are the available model relations:
 * @property Person[] $people
 * @property Category $category
 * @property Tag[] $tags
 */
class Picture extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Picture the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
  
  public function __toString()
  {
    return sprintf('«%s» (%dx%d)', $this->description, $this->width, $this->height);
  }

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'picture';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('height, width, category_id', 'length', 'max'=>11),
      
      // Added some validators (LT)
      
      array('height', 'numerical', 'integerOnly'=>true),
      array('height', 'numerical', 'max'=>1000),
      array('width', 'numerical', 'integerOnly'=>true),
      array('height', 'numerical', 'max'=>1000),

      // This is a custom validator defined in the same class
      
      array('type', 'checktype'),

			array('description, type', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, height, width, description, type, category_id', 'safe', 'on'=>'search'),
		);
	}

  public function checktype($attribute,$params)
  {
      if(!in_array($this->$attribute, array('jpeg', 'gif', 'png')))
          $this->addError('type','Unsupported type.');
  }

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'people' => array(self::MANY_MANY, 'Person', 'person_picture(picture_id, person_id)'),
			'category' => array(self::BELONGS_TO, 'Category', 'category_id'),
			'tags' => array(self::MANY_MANY, 'Tag', 'picture_tag(picture_id, tag_id)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'height' => 'Height',
			'width' => 'Width',
			'description' => 'Description',
			'type' => 'Type',
			'category_id' => 'Category',
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
		$criteria->compare('height',$this->height,true);
		$criteria->compare('width',$this->width,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('category_id',$this->category_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
