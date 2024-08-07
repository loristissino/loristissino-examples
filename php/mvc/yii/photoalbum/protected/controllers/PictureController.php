<?php

class PictureController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','serve'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','addtag'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','fix'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Serves an image via HTTP.
	 * @param integer $id the ID of the picture to be displayed
	 */
	public function actionServe($id)
	{
    $picture = $this->loadModel($id);
    $this->serveFile('image/' . $picture->type, $picture->getFile(Yii::app()->params['picturesDirectory']));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Picture;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Picture']))
		{
			$model->attributes=$_POST['Picture'];
      
      $file=CUploadedFile::getInstance($model, 'uploadedfile');
      if (is_object($file) && get_class($file)==='CUploadedFile')
      {          
  	    $model->uploadedfile = $file;
    	}
      
			if($model->save() && $model->saveUploadedfile(Yii::app()->params['picturesDirectory']))
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	public function actionFix($id)
	{
    $model=$this->loadModel($id);

		if($_SERVER['REQUEST_METHOD']=='POST')
		{
			$model->checkFile(Yii::app()->params['picturesDirectory'], true);
      $this->redirect(array('view','id'=>$model->id));
		}

		$this->render('fix',array(
			'model'=>$model,
		));
    
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Picture']))
		{
			$model->attributes=$_POST['Picture'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	public function actionAddtag($id)
	{
		$model=$this->loadModel($id);
    
    $tagform = new PictureAddTagForm;
    $tagform->picture_id = $model->id;
    $tagform->tag = 'write your tag here';

		if(isset($_POST['PictureAddTagForm']))
		{
      $tagform->attributes=$_POST['PictureAddTagForm'];
			if($tagform->validate())
      {
        if($model->addTag($_POST['PictureAddTagForm']))
        {
          $this->redirect(array('view','id'=>$model->id));
        }
      }
		}

		$this->render('addtag',array(
			'model'=>$model,
      'tagform'=>$tagform,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Picture');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Picture('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Picture']))
			$model->attributes=$_GET['Picture'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Picture the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Picture::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Picture $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='picture-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
