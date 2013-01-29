<?php

Yii::import('zii.widgets.CPortlet');
 
class TagCloud extends CPortlet
{
    public function init()
    {
        parent::init();
    }
 
    protected function renderContent()
    {
      $tags = Tag::model()->with('count')->findAll();
      $this->render('tagCloud', array('tags'=>$tags));
    }
}
