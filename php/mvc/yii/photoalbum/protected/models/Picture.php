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
 * @property string $create_time
 * @property string $update_time
 *
 * The followings are the available model relations:
 * @property Person[] $people
 * @property Category $category
 * @property Tag[] $tags
 * 
 * The followings are for internal use:
 * @property boolean $valid
 * @property boolean $realwidth
 * @property boolean $realheight
 * @property boolean $realtype
 * 
 */
class Picture extends CActiveRecord
{
  
  private $valid;
  public $realwidth;
  private $realheight;
  private $realtype;
  public $uploadedfile;
  
  /**
	 * This method is invoked after a model instance is created by new operator.
	 * The default implementation raises the {@link onAfterConstruct} event.
	 * It is here overridden to do postprocessing after model creation.
	 * We call the parent implementation so that the event is raised properly.
	 */  
  protected function afterConstruct()
  {
    parent::afterConstruct();
    $this->realwidth = 200;
    // This is just to show that we can do something on object creation.
    // It is better to avoid overriding the __construct() method, because
    // of some events raised.
    // A proper object is created with something like
    // $picture = new Picture();
    // But if we create an object with
    // $picture = Picture::model()
    // (which does not make sense, but is technically possible)
    // the events would not be fired
  }
  
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
   * Returns the number of pixels in the picture.
   * This is here to show how virtual attributes work.
   * See http://www.yiiframework.com/wiki/167/understanding-virtual-attributes-and-get-set-methods/
   * We can call $picture->getPixels() or directly $picture->pixels.
   * 
	 * @return integer the number of pixels in the picture
	 */
  public function getPixels()
  {
    return $this->width * $this->height;
  }
  
  public function getFile($path)
  {
    return $path . '/' . $this->id;
  }
  
  public function getUploadedfile()
  {
    return $this->uploadedfile;
  }
  
  public function saveUploadedfile($path)
  {
    if(!$this->uploadedfile instanceof CUploadedFile)
    {
      throw new Exception('This function only works with just uploaded files.');
    }
    if($this->uploadedfile->saveAs($path . DIRECTORY_SEPARATOR . $this->id))
    {
      $this->retrieveInformation($path);
      $this->height=$this->realheight;
      $this->width=$this->realwidth;
      $this->save();
    }
  }

  protected function retrieveInformation($path)
  {
    $info=@getimagesize($this->getFile($path));
    $this->valid=is_array($info);
    if(!$this->valid)
    {
      return;
    }
    $this->realwidth=$info[0];
    $this->realheight=$info[1];
    list($type,$subtype) = explode('/', $info['mime']);
    if($type!='image')
    {
      $this->valid=false;
    }
    $this->realtype=$subtype;
  }
  
  public function checkFile($path, $storeInformation=false)
  {
    $this->retrieveInformation($path);
    $errors=array();
    if(!$this->valid)
    {
      $errors['valid'] = array('message'=>'do not match', 'got'=>'valid', 'found'=>'invalid');
      return $errors;
    }
    foreach(array(
      array('got'=>'width', 'found'=>'realwidth'),
      array('got'=>'height', 'found'=>'realheight'),
      array('got'=>'type', 'found'=>'realtype'),
      ) as $check)
    {
      if($this->$check['got'] !=$this->$check['found'])
      {
        $errors[$check['got']]=array('message'=>'do not match', 'got'=>$this->$check['got'], 'found'=>$this->$check['found']);
      }
    }
    
    if($storeInformation)
    {
      foreach($errors as $property=>$values)
      {
        $this->$property = $values['found'];
      }
      $this->save();
    }
    
    return $errors;
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
      array('description', 'required'),
			array('height, width, category_id', 'length', 'max'=>11),
      
      // Added some validators (LT)
      
      array('height', 'numerical', 'integerOnly'=>true),
      array('height', 'numerical', 'min'=>1, 'on'=>'informationRetrieval'),
      array('width', 'numerical', 'integerOnly'=>true),
      array('height', 'numerical', 'min'=>1, 'on'=>'informationRetrieval'),

      // This is a custom validator defined in the same class
      
      array('type', 'checktype'),

			array('description, type', 'length', 'max'=>255),
      
			array('uploadedfile', 
					'file',
					'allowEmpty' => true,  // if it is in the list of required fields above, this must be set to true here
					'maxSize'=>1024 * 100, // 100KiB
					'tooLarge'=>'The file was larger than 100KiB. Please upload a smaller file.',
			),
      
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
			'create_time' => 'Create Time',
			'update_time' => 'Update Time',
    );
	}

  public function addTag($values=array())
  {
    if($values['picture_id']!=$this->id)
    {
      return false;
    }
    
    $tag = new Tag();
    $tag->title = $values['tag'];
    try
    {
      $tag->save();
    }
    catch (Exception $e)
    {
      return false;
    }
    
    $picture_tag = new PictureTag();
    $picture_tag->picture_id = $this->id;
    $picture_tag->tag_id = $tag->id;
    try
    {
      $picture_tag->save();
    }
    catch (Exception $e)
    {
      return false;
    }
    return true;
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
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('update_time',$this->update_time,true);
    
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
  
  public function behaviors()
  {
    return array(
        'CTimestampBehavior'=>array(
          'class'=>'zii.behaviors.CTimestampBehavior',
          'createAttribute'=>'create_time',
          'updateAttribute'=>'update_time',
        ),
    );
  }
  
}
