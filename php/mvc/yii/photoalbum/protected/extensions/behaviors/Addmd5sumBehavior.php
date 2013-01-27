<?php

class Addmd5sumBehavior extends CActiveRecordBehavior
{
  public $md5sumAttribute = 'md5sum';
  
  public function beforeSave($event)
  {
    if(!$this->owner->isNewRecord)
    {
      try
      {
        $md5sum=md5_file($this->owner->getFile());
      }
      catch (Exception $e)
      {
        $md5sum=null;
      }
    }
    $this->owner->md5sum=$md5sum;
  }
}
