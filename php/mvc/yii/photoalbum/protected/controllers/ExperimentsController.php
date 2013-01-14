<?php

class ExperimentsController extends Controller
{
	public function actionIndex()
	{

    $pictures = Picture::model()->findAll();
    $categories = Category::model()->findAll();

		$this->render('index', array('pictures'=>$pictures, 'categories'=>$categories));
    
    /* if we wanted to create a new Category:
     * (not good in a GET action)
    $category = new Category();
    $category->name = 'Test category';
    $category->save();
    */
    
	}
  
  public function actionI18n()
  {
    $this->render('i18n', array('path'=>'/foo/bar'));
  }

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}
