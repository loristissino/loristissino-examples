<?php

/**
 * This is the model class for table "tag".
 *
 * The followings are the available columns in table 'tag':
 * @property string $id
 * @property string $title
 *
 * The followings are the available model relations:
 * @property Picture[] $pictures
 */
class Tag extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Tag the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

  public function __toString()
  {
    return $this->title;
  }
  
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tag';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title', 'safe', 'on'=>'search'),
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
			'pictures' => array(self::MANY_MANY, 'Picture', 'picture_tag(tag_id, picture_id)'),
      'count' => array(self::STAT, 'Picture', 'picture_tag(tag_id, picture_id)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Title',
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
		$criteria->compare('title',$this->title,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
  
  
	/**
   * Retrieves tags that match a term.
   * @param string $term a term to use for matching tags.
	 * @return array tags titles that match the term.
	 */
  public function findMatches($term='')
  {
    if(''==$term)
    {
      return array();
    }
    $q = new CDbCriteria();
    $q->addSearchCondition('title', $term);
    $q->select=array('title');
    $tags = self::model()->findAll($q);

    $results=array();
    foreach($tags as $tag)
    {
      $results[]=$tag->title;
    }
    return $results;
  }

}
